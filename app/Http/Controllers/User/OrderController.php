<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with(['items.review', 'items.variant.product', 'shippingAddress'])
            ->findOrFail($id);

        return view('user.orders.show', compact('order'));
    }

    public function cancel($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->findOrFail($id);

        $order->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);

        return redirect()->route('user.orders.show', $order->id)
            ->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function receive($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->where('status', 'shipped')
            ->findOrFail($id);

        $order->update([
            'status' => 'delivered',
            'delivered_at' => now(),
        ]);

        return redirect()->route('user.orders.show', $order->id)
            ->with('success', 'Barang sudah sampai! Silakan berikan rating dan review untuk produk yang Anda beli.');
    }
}
