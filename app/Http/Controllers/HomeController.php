<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::with([
            'category',
            'images',
            'variants'
        ])
        ->when($request->category, function ($query) use ($request) {
            $query->whereHas(
                'category',
                function ($q) use ($request) {
                    $q->where(
                        'slug',
                        $request->category
                    );
                }
            );
        })
        ->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })
        ->latest()
        ->paginate(12);

        $slides = Banner::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $wishlistIds = Auth::check()
            ? Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray()
            : [];

        return view(
            'home.index',
            compact(
                'products',
                'categories',
                'slides',
                'wishlistIds'
            )
        );
    }

    public function show($slug)
    {
        $product = Product::with([
            'category',
            'images',
            'variants',
            'reviews.user'
        ])
        ->where(
            'slug',
            $slug
        )
        ->firstOrFail();

        $inWishlist = Auth::check()
            ? Wishlist::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->exists()
            : false;

        return view(
            'home.show',
            compact('product', 'inWishlist')
        );
    }
}
