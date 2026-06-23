<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil - Manchester United Store</title>
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
        @keyframes checkmark { 0% { stroke-dashoffset: 100; } 100% { stroke-dashoffset: 0; } }
        .checkmark-circle { stroke-dasharray: 166; stroke-dashoffset: 166; stroke-width: 2; stroke-miterlimit: 10; fill: none; animation: checkmark 0.6s ease forwards; }
        .checkmark-check { stroke-dasharray: 48; stroke-dashoffset: 48; animation: checkmark 0.3s 0.6s ease forwards; }
        @keyframes scaleIn { 0% { transform: scale(0); } 50% { transform: scale(1.1); } 100% { transform: scale(1); } }
        .success-icon { animation: scaleIn 0.4s ease forwards; }
    </style>
</head>
<body class="bg-[#f1f5f9] text-slate-800 antialiased">
    <div class="max-w-4xl mx-auto px-4 py-10 space-y-6">
        {{-- SUCCESS HEADER --}}
        <div class="rounded-xl bg-white border border-slate-200/60 shadow-sm overflow-hidden animate-fade-in-up">
            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-8 text-center text-white">
                <div class="success-icon mx-auto mb-4 w-20 h-20 rounded-full bg-white/20 flex items-center justify-center">
                    <svg class="w-12 h-12" viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg">
                        <circle class="checkmark-circle" cx="26" cy="26" r="25" stroke="white" fill="none"/>
                        <path class="checkmark-check" fill="none" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" d="M14 27l7 7 16-16"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-black tracking-tight">Pembayaran Berhasil!</h1>
                <p class="text-white/80 text-sm mt-2">Terima kasih, pesanan Anda telah dikonfirmasi.</p>
            </div>

            <div class="p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    <div>
                        <p class="text-xs text-slate-500 uppercase tracking-wide font-semibold">Nomor Pesanan</p>
                        <p class="text-lg font-black text-slate-900 mt-1">{{ $order->order_number }}</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="badge bg-emerald-100 text-emerald-700 text-xs">{{ ucfirst($order->status) }}</span>
                        <span class="badge @if($order->payment_status === 'success') bg-emerald-100 text-emerald-700 @else bg-amber-100 text-amber-700 @endif text-xs">Payment: {{ ucfirst($order->payment_status) }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
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
                <div class="mb-6">
                    <h3 class="text-sm font-bold text-slate-900 mb-3">Alamat Pengiriman</h3>
                    <div class="p-4 rounded-lg bg-slate-50 text-sm">
                        <p class="font-semibold text-slate-900">{{ $order->shippingAddress->name }}</p>
                        <p class="text-slate-600 mt-1">{{ $order->shippingAddress->address }}, {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->province }} {{ $order->shippingAddress->postal_code }}</p>
                        <p class="text-slate-500 mt-1">{{ $order->shippingAddress->phone }}</p>
                    </div>
                </div>
                @endif

                <div class="mb-6">
                    <h3 class="text-sm font-bold text-slate-900 mb-3">Pesanan Anda</h3>
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
                    <span class="font-bold text-slate-900">Total Pembayaran</span>
                    <span class="font-black text-xl text-emerald-600">Rp {{ number_format($order->total_amount) }}</span>
                </div>
            </div>
        </div>

        {{-- STATUS TRACKER --}}
        <div class="rounded-xl bg-white border border-slate-200/60 shadow-sm p-6 animate-fade-in-up">
            @include('partials.order-stepper')
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up">
            <a href="{{ route('user.orders.show', $order->id) }}"
               class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl bg-[#DA291C] text-white text-sm font-bold hover:bg-[#B91C1C] transition-colors shadow-lg shadow-red-900/20">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/>
                </svg>
                Lihat Detail Pesanan
            </a>
            <a href="{{ route('home') }}"
               class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl bg-slate-100 text-slate-700 text-sm font-bold hover:bg-slate-200 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z"/>
                </svg>
                Belanja Lagi
            </a>
        </div>

        <div class="text-center py-4">
            <p class="text-xs text-slate-400">&copy; {{ date('Y') }} Manchester United Store. All rights reserved.</p>
        </div>
    </div>

    @include('partials.sweetalert')
</body>
</html>
