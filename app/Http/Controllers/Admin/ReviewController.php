<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user', 'product', 'order'])
            ->latest()
            ->paginate(15);

        $averageRating = Review::avg('rating');
        $totalReviews = Review::count();

        return view('admin.reviews.index', compact('reviews', 'averageRating', 'totalReviews'));
    }
}
