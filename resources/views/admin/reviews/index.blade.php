@extends('admin.layouts.app')

@php $title = 'Reviews'; @endphp

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="rounded-xl bg-white p-5 border shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>
                    </svg>
                </div>
                <span class="text-2xl font-black text-slate-900">{{ number_format($averageRating, 1) }}</span>
            </div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Average Rating</p>
        </div>
        <div class="rounded-xl bg-white p-5 border shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
                    </svg>
                </div>
                <span class="text-2xl font-black text-slate-900">{{ $totalReviews }}</span>
            </div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Total Reviews</p>
        </div>
    </div>

    <div class="rounded-xl bg-white border shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b">
            <h3 class="text-sm font-bold text-slate-900">All Reviews</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b bg-slate-50">
                        <th class="text-left px-5 py-3.5 font-semibold text-slate-600">Product</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-slate-600">Customer</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-slate-600">Rating</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-slate-600">Comment</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-slate-600">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-slate-900">
                    @forelse($reviews as $review)
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-4 font-semibold">{{ $review->product->name }}</td>
                        <td class="px-5 py-4">{{ $review->user->name }}</td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-0.5">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="text-sm {{ $i <= $review->rating ? 'text-amber-400' : 'text-slate-300' }}">★</span>
                                @endfor
                            </div>
                        </td>
                        <td class="px-5 py-4 text-slate-600 max-w-xs truncate">{{ $review->comment ?? '—' }}</td>
                        <td class="px-5 py-4 text-slate-500 whitespace-nowrap">{{ $review->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center text-slate-500">No reviews yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($reviews->hasPages())
        <div class="px-5 py-4 border-t">
            {{ $reviews->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
