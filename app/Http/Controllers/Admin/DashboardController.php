<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCustomers = User::count();
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total_amount');

        $recentOrders = Order::with(['user', 'items'])->latest()->take(8)->get();

        $topProducts = OrderItem::selectRaw('product_variant_id, product_name, SUM(qty) as total_sold, SUM(subtotal) as revenue')
            ->groupBy('product_variant_id', 'product_name')
            ->orderByDesc('total_sold')
            ->take(5)
            ->with('variant.product.images')
            ->get();

        $latestCustomers = User::latest()->take(5)->get();

        $allStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        $statusCounts = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $lowStockVariants = ProductVariant::where('stock', '<', 10)
            ->with('product.images')
            ->get();

        return view('admin.dashboard', compact(
            'user', 'totalProducts', 'totalOrders', 'totalCustomers', 'totalRevenue',
            'recentOrders', 'topProducts', 'latestCustomers', 'statusCounts',
            'lowStockVariants', 'allStatuses'
        ));
    }
}
