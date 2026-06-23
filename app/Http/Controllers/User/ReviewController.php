<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_item_id' => 'required|exists:order_items,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $item = OrderItem::where('id', $validated['order_item_id'])
            ->whereHas('order', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->with('variant.product')
            ->firstOrFail();

        if ($item->review()->exists()) {
            return back()->with('error', 'Produk ini sudah pernah direview.');
        }

        Review::create([
            'order_id' => $item->order_id,
            'user_id' => Auth::id(),
            'product_id' => $item->variant->product_id,
            'order_item_id' => $item->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return back()->with('success', 'Review berhasil dikirim! Terima kasih atas penilaian Anda.');
    }
}
