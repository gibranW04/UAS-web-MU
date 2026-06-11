<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Midtrans\Snap;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class CheckoutController extends Controller
{
    /**
     * CART / SHOW
     */
   public function index()
    {
        $cart = session('cart', []);
        // Ambil alamat milik user yang sedang login (baik admin/user biasa)
        $addresses = Address::where('user_id', Auth::id())->get();


        return view('cart.index', compact('cart', 'addresses'));
    }


/**
     * ADD TO CART
     */
    public function addToCart(Request $request)
    {
        // Validasi input
        $request->validate([
            'variant_id'    => 'required',
            'product_name'  => 'required',
            'product_image' => 'nullable|string',
            'variant_label' => 'nullable|string',
            'price'         => 'required|numeric',
            'qty'           => 'required|integer|min:1',
        ]);

        $cart = session('cart', []);

        // Jika produk sudah ada di cart, tambahkan qty nya saja
        if (isset($cart[$request->variant_id])) {
            $cart[$request->variant_id]['qty'] += $request->qty;
        } else {
            // Jika belum ada, masukkan data baru
            $cart[$request->variant_id] = [
                'variant_id'    => $request->variant_id,
                'product_name'  => $request->product_name,
                'product_image' => $request->product_image,
                'variant_label' => $request->variant_label ?? '',
                'price'         => $request->price,
                'qty'           => $request->qty,
            ];
        }

        session(['cart' => $cart]);

        Alert::toast('Produk berhasil ditambah ke keranjang!', 'success');

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambah ke keranjang!');
    }


    /**
     * UPDATE QTY (+ / -)
     */
    public function updateQty(Request $request)
    {
        $cart = session('cart', []);


        if (isset($cart[$request->variant_id])) {
            $cart[$request->variant_id]['qty'] = max(1, $request->qty);
        }


        session(['cart' => $cart]);


        return back();
    }


    /**
     * REMOVE ITEM
     */
    public function remove($variantId)
    {
        $cart = session('cart', []);
        unset($cart[$variantId]);


        session(['cart' => $cart]);


        return back();
    }


    /**
     * MIDTRANS CHECKOUT
     */
    public function store(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return response()->json(['error' => 'Keranjang kosong'], 400);
        }

        $request->validate([
            'address_id' => 'required|exists:addresses,id'
        ]);

        $address = Address::findOrFail($request->address_id);
        $total = collect($cart)->sum(fn ($i) => $i['price'] * $i['qty']);

        $orderNumber = 'ORD-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => $orderNumber,
            'status' => 'pending',
            'total_amount' => $total,
            'shipping_address_id' => $address->id,
            'payment_status' => 'pending',
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_variant_id' => $item['variant_id'],
                'product_name' => $item['product_name'],
                'variant_label' => $item['variant_label'] ?? null,
                'price' => $item['price'],
                'qty' => $item['qty'],
                'subtotal' => $item['price'] * $item['qty'],
            ]);
        }

        $params = [
            'transaction_details' => [
                'order_id' => $orderNumber,
                'gross_amount' => (int) $total,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => $address->phone,
                'shipping_address' => [
                    'first_name' => $address->name,
                    'phone' => $address->phone,
                    'address' => $address->address,
                    'city' => $address->city,
                    'postal_code' => $address->postal_code,
                    'country_code' => 'IDN'
                ],
            ],
            'item_details' => collect($cart)->map(function($item) {
                return [
                    'id' => $item['variant_id'],
                    'price' => (int) $item['price'],
                    'quantity' => (int) $item['qty'],
                    'name' => $item['product_name']
                ];
            })->values()->all(),
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $order->update(['snap_token' => $snapToken]);
            session()->forget('cart');
            return response()->json(['snap_token' => $snapToken, 'order_id' => $order->id]);
        } catch (\Exception $e) {
            $order->update(['status' => 'failed', 'notes' => 'Midtrans error: ' . $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
