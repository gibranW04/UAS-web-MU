<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $addresses = $user->addresses()->latest()->get();
        $defaultAddress = $user->addresses()->latest()->first();

        $orders = Order::where('user_id', $user->id)
            ->with('items')
            ->latest()
            ->take(5)
            ->get();

        $totalOrders = Order::where('user_id', $user->id)->count();
        $pendingOrders = Order::where('user_id', $user->id)->where('status', 'pending')->count();
        $shippedOrders = Order::where('user_id', $user->id)->where('status', 'shipped')->count();
        $completedOrders = Order::where('user_id', $user->id)->where('status', 'delivered')->count();

        $wishlists = Wishlist::where('user_id', $user->id)
            ->with('product.images')
            ->latest()
            ->take(4)
            ->get();

        return view('user.dashboard', compact(
            'user',
            'addresses',
            'defaultAddress',
            'orders',
            'totalOrders',
            'pendingOrders',
            'shippedOrders',
            'completedOrders',
            'wishlists'
        ));
    }
}
