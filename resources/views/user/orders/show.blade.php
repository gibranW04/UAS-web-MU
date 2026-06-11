<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->order_number }} - Manchester United Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .badge { display: inline-flex; align-items: center; padding: 2px 10px; border-radius: 9999px; font-size: 11px; font-weight: 600; letter-spacing: 0.025em; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in-up { animation: fadeInUp 0.6s ease forwards; }
    </style>
</head>
<body class="bg-[#f1f5f9] text-slate-800 antialiased">
    <div class="max-w-4xl mx-auto px-4 py-10 space-y-6">
        <a href="{{ route('user.orders.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#DA291C] hover:text-[#B91C1C] transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
            Back to Orders
        </a>

        <div class="rounded-xl bg-white border border-slate-200/60 shadow-sm overflow-hidden animate-fade-in-up">
            <div class="bg-gradient-to-r from-[#DA291C] to-[#991B1B] px-6 py-5 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-xl font-black">Order #{{ $order->order_number }}</h1>
                        <p class="text-white/70 text-sm mt-1">Placed on {{ $order->created_at->format('d F Y H:i') }}</p>
                    </div>
                    <span class="badge bg-white/20 text-white text-xs">{{ ucfirst($order->status) }}</span>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="p-4 rounded-lg bg-slate-50">
                        <p class="text-xs text-slate-500 uppercase tracking-wide font-semibold">Status</p>
                        <p class="text-sm font-bold text-slate-900 mt-1 capitalize">{{ $order->status }}</p>
                    </div>
                    <div class="p-4 rounded-lg bg-slate-50">
                        <p class="text-xs text-slate-500 uppercase tracking-wide font-semibold">Payment</p>
                        <p class="text-sm font-bold text-slate-900 mt-1 capitalize">{{ $order->payment_status }}</p>
                    </div>
                    <div class="p-4 rounded-lg bg-slate-50">
                        <p class="text-xs text-slate-500 uppercase tracking-wide font-semibold">Payment Type</p>
                        <p class="text-sm font-bold text-slate-900 mt-1">{{ $order->payment_type ?? '—' }}</p>
                    </div>
                    <div class="p-4 rounded-lg bg-slate-50">
                        <p class="text-xs text-slate-500 uppercase tracking-wide font-semibold">Total</p>
                        <p class="text-sm font-bold text-slate-900 mt-1">Rp {{ number_format($order->total_amount) }}</p>
                    </div>
                </div>

                @if($order->shippingAddress)
                <div>
                    <h3 class="text-sm font-bold text-slate-900 mb-3">Shipping Address</h3>
                    <div class="p-4 rounded-lg bg-slate-50 text-sm">
                        <p class="font-semibold text-slate-900">{{ $order->shippingAddress->name }}</p>
                        <p class="text-slate-600 mt-1">{{ $order->shippingAddress->address }}, {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->province }} {{ $order->shippingAddress->postal_code }}</p>
                        <p class="text-slate-500 mt-1">{{ $order->shippingAddress->phone }}</p>
                    </div>
                </div>
                @endif

                <div>
                    <h3 class="text-sm font-bold text-slate-900 mb-3">Order Items</h3>
                    <div class="divide-y divide-slate-100">
                        @foreach($order->items as $item)
                            <div class="flex items-center justify-between py-3">
                                <div>
                                    <p class="font-medium text-slate-900">{{ $item->product_name }}</p>
                                    @if($item->variant_label)
                                        <p class="text-xs text-slate-500 mt-0.5">{{ $item->variant_label }}</p>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <p class="font-medium text-slate-900">{{ $item->qty }}x Rp {{ number_format($item->price) }}</p>
                                    <p class="text-xs text-slate-500">Rp {{ number_format($item->subtotal) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="border-t border-slate-200 pt-4 flex justify-between items-center">
                    <span class="font-bold text-slate-900">Total</span>
                    <span class="font-black text-xl text-[#DA291C]">Rp {{ number_format($order->total_amount) }}</span>
                </div>
            </div>
        </div>

        <div class="text-center py-4">
            <p class="text-xs text-slate-400">&copy; {{ date('Y') }} Manchester United Store. All rights reserved.</p>
        </div>
    </div>

    @include('partials.sweetalert')
</body>
</html>
