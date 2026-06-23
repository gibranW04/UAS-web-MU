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

        @if($order->status !== 'pending')
        <div class="rounded-xl bg-white border border-slate-200/60 shadow-sm p-6 animate-fade-in-up">
            @include('partials.order-stepper')
        </div>
        @endif

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

        @if($order->status === 'pending')
        <div class="rounded-xl bg-white border border-slate-200/60 shadow-sm p-6 animate-fade-in-up">
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <button id="payButton"
                    class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl bg-emerald-500 text-white text-sm font-bold hover:bg-emerald-600 transition-colors shadow-lg shadow-emerald-900/20">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/>
                    </svg>
                    Bayar Sekarang
                </button>
                <form action="{{ route('user.orders.cancel', $order->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                    @csrf
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl bg-red-50 text-red-600 text-sm font-bold hover:bg-red-100 transition-colors border border-red-200">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                        </svg>
                        Batalkan Pesanan
                    </button>
                </form>
            </div>
        </div>
        @endif

        @if($order->status === 'shipped')
        <div class="rounded-xl bg-white border border-slate-200/60 shadow-sm p-6 animate-fade-in-up">
            <div class="text-center">
                <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Pesanan Sedang Dalam Perjalanan</h3>
                <p class="text-sm text-slate-500 mt-1">Konfirmasi jika barang sudah sampai di tangan Anda.</p>
                <form action="{{ route('user.orders.receive', $order->id) }}" method="POST" class="mt-5">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-xl bg-emerald-500 text-white text-sm font-bold hover:bg-emerald-600 transition-colors shadow-lg shadow-emerald-900/20">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                        </svg>
                        Konfirmasi Barang Sudah Sampai
                    </button>
                </form>
            </div>
        </div>
        @endif

        @if($order->status === 'delivered')
        <div class="rounded-xl bg-white border border-slate-200/60 shadow-sm p-6 animate-fade-in-up">
            <div class="text-center mb-6">
                <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Pesanan Selesai</h3>
                <p class="text-sm text-slate-500 mt-1">Terima kasih! Silakan berikan penilaian untuk produk yang Anda beli.</p>
            </div>

            @php $hasUnreviewed = $order->items->contains(fn($item) => !$item->review) @endphp

            @if($hasUnreviewed)
            <div class="divide-y divide-slate-100">
                @foreach($order->items as $item)
                    @if(!$item->review)
                    <div class="py-5">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <p class="font-semibold text-slate-900">{{ $item->product_name }}</p>
                                @if($item->variant_label)
                                    <p class="text-xs text-slate-500">{{ $item->variant_label }}</p>
                                @endif
                            </div>
                            <span class="text-sm font-medium text-slate-500">{{ $item->qty }}x Rp {{ number_format($item->price) }}</span>
                        </div>

                        <form action="{{ route('user.reviews.store') }}" method="POST" class="space-y-3">
                            @csrf
                            <input type="hidden" name="order_item_id" value="{{ $item->id }}">

                            <div>
                                <p class="text-sm font-medium text-slate-700 mb-2">Rating</p>
                                <div class="flex gap-1 star-rating" data-input="rating-{{ $item->id }}">
                                    @for($i = 1; $i <= 5; $i++)
                                    <button type="button" data-star="{{ $i }}"
                                        class="star-btn text-2xl text-slate-300 hover:text-amber-400 transition-colors">
                                        ★
                                    </button>
                                    @endfor
                                    <input type="hidden" name="rating" id="rating-{{ $item->id }}" required>
                                </div>
                                @error('rating')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="text-sm font-medium text-slate-700">Komentar <span class="text-slate-400">(opsional)</span></label>
                                <textarea name="comment" rows="2" maxlength="1000"
                                    class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-[#DA291C]/20 focus:border-[#DA291C] outline-none resize-none"
                                    placeholder="Bagikan pengalaman Anda menggunakan produk ini..."></textarea>
                            </div>

                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-[#DA291C] text-white text-sm font-bold hover:bg-[#B91C1C] transition-colors">
                                Kirim Review
                            </button>
                        </form>
                    </div>
                    @endif
                @endforeach
            </div>
            @else
            <div class="text-center py-4">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-50 text-emerald-600 text-sm font-semibold">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                    </svg>
                    Semua produk sudah direview. Terima kasih!
                </div>
            </div>
            @endif
        </div>
        @endif

        <div class="text-center py-4">
            <p class="text-xs text-slate-400">&copy; {{ date('Y') }} Manchester United Store. All rights reserved.</p>
        </div>
    </div>

    @include('partials.sweetalert')

    @if($order->status === 'pending' && $order->snap_token)
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script>
        document.getElementById('payButton')?.addEventListener('click', function (e) {
            e.preventDefault();
            const btn = this;
            btn.innerHTML = '<span class="animate-pulse">Memproses...</span>';
            btn.disabled = true;

            snap.pay('{{ $order->snap_token }}', {
                onSuccess: function(result) {
                    fetch("{{ route('payment.success') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            order_id: result.order_id,
                            payment_type: result.payment_type
                        })
                    }).then(function(res) { return res.json(); })
                      .then(function(data) {
                          window.location.href = '{{ route("payment.status", ":id") }}'.replace(':id', data.order_id);
                      });
                },
                onPending: function(result) {
                    alert("Menunggu pembayaran...");
                    location.reload();
                },
                onError: function(result) {
                    alert("Pembayaran gagal! Silakan coba lagi.");
                    btn.innerHTML = 'Bayar Sekarang';
                    btn.disabled = false;
                },
                onClose: function() {
                    btn.innerHTML = 'Bayar Sekarang';
                    btn.disabled = false;
                }
            });
        });
    </script>
    @endif

    <script>
        document.querySelectorAll('.star-rating').forEach(function(container) {
            const inputId = container.dataset.input;
            const input = document.getElementById(inputId);
            const btns = container.querySelectorAll('.star-btn');

            btns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const value = parseInt(this.dataset.star);
                    input.value = value;

                    btns.forEach(function(b, i) {
                        if (i < value) {
                            b.classList.remove('text-slate-300');
                            b.classList.add('text-amber-400');
                        } else {
                            b.classList.remove('text-amber-400');
                            b.classList.add('text-slate-300');
                        }
                    });
                });

                btn.addEventListener('mouseenter', function() {
                    const value = parseInt(this.dataset.star);
                    btns.forEach(function(b, i) {
                        if (i < value) {
                            b.classList.remove('text-slate-300');
                            b.classList.add('text-amber-300');
                        } else {
                            b.classList.remove('text-amber-300', 'text-amber-400');
                            if (!b.classList.contains('selected')) {
                                b.classList.add('text-slate-300');
                            }
                        }
                    });
                });

                btn.addEventListener('mouseleave', function() {
                    const selected = parseInt(input.value) || 0;
                    btns.forEach(function(b, i) {
                        b.classList.remove('text-amber-300');
                        if (i < selected) {
                            b.classList.remove('text-slate-300');
                            b.classList.add('text-amber-400');
                        } else {
                            b.classList.remove('text-amber-400');
                            b.classList.add('text-slate-300');
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
