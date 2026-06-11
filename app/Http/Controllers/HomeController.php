<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;
use Illuminate\Http\Request;

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

        return view(
            'home.index',
            compact(
                'products',
                'categories',
                'slides'
            )
        );
    }

    public function show($slug)
    {
        $product = Product::with([
            'category',
            'images',
            'variants'
        ])
        ->where(
            'slug',
            $slug
        )
        ->firstOrFail();

        return view(
            'home.show',
            compact('product')
        );
    }
}
