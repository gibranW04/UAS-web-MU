<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items'])->latest()->paginate(15);
        $statuses = ['pending', 'paid', 'processing', 'shipped', 'delivered', 'cancelled'];
        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'items.variant.product.images', 'shippingAddress'])->findOrFail($id);
        $statuses = ['pending', 'paid', 'processing', 'shipped', 'delivered', 'cancelled'];
        return view('admin.orders.show', compact('order', 'statuses'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => ['required', Rule::in(['pending', 'paid', 'processing', 'shipped', 'delivered', 'cancelled'])],
        ]);

        $newStatus = $validated['status'];
        $timestampField = $newStatus . '_at';

        $order->status = $newStatus;
        if (in_array($timestampField, ['paid_at', 'processed_at', 'shipped_at', 'delivered_at', 'cancelled_at'])) {
            $order->$timestampField = now();
        }
        $order->save();

        return redirect()->route('admin.orders.show', $order->id)
            ->with('success', 'Status pesanan berhasil diubah menjadi ' . ucfirst($newStatus) . '.');
    }
}
