<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items'])->latest()->paginate(15);
        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'items.variant.product.images', 'shippingAddress'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
}
