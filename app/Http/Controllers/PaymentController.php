<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function success(Request $request)
    {
        $order = Order::where('order_number', $request->order_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $order->update([
            'status' => 'paid',
            'payment_status' => 'success',
            'payment_type' => $request->payment_type ?? 'unknown',
            'paid_at' => now(),
        ]);

        return response()->json([
            'message' => 'Payment confirmed',
            'order_id' => $order->id,
        ]);
    }

    public function status($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with('items', 'shippingAddress')
            ->findOrFail($id);

        return view('payment.success', compact('order'));
    }
}
