@extends('layouts.app')


@section('content')
<div class="max-w-6xl mx-auto px-4 py-10 bg-slate-50">
    <div class="mb-10 rounded-[2rem] bg-gradient-to-r from-slate-950 via-slate-900 to-slate-950 p-8 shadow-[0_30px_80px_rgba(15,23,42,0.25)] text-white overflow-hidden">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div>
                <span class="inline-flex items-center rounded-full bg-amber-400/15 px-4 py-2 text-sm font-semibold tracking-wide text-amber-200 ring-1 ring-amber-200/20">Luxury Cart</span>
                <h1 class="mt-4 text-4xl font-extrabold tracking-tight">Keranjang Belanja Premium</h1>
                <p class="mt-3 max-w-2xl text-sm text-slate-300">Nikmati pengalaman checkout dengan tampilan mewah, ringkas, dan elegan. Setiap detail dibuat untuk menghadirkan kesan berkualitas.</p>
            </div>
            <div class="rounded-3xl bg-slate-800/60 border border-white/10 p-6 shadow-xl backdrop-blur-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Ringkasan</p>
                <p class="mt-3 text-3xl font-black text-amber-300">{{ collect($cart)->sum('qty') }} produk</p>
                <p class="mt-1 text-sm text-slate-400">Total estimasi sebelum checkout.</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- LIST ITEM --}}
        <div class="lg:col-span-2 space-y-5">
            @forelse ($cart as $item)
                <div class="cart-item rounded-[2rem] border border-slate-200/60 bg-white/90 p-6 shadow-[0_30px_60px_rgba(15,23,42,0.08)] backdrop-blur-sm transition hover:-translate-y-1 hover:shadow-[0_35px_80px_rgba(15,23,42,0.12)]">
                    <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                        <div class="flex items-start gap-5">
                            <div class="relative h-32 w-32 overflow-hidden rounded-3xl shadow-sm bg-white">
                                <img
                                    src="{{ $item['product_image'] ?? 'https://images.pexels.com/photos/3617696/pexels-photo-3617696.jpeg?auto=compress&cs=tinysrgb&w=800' }}"
                                    alt="{{ $item['product_name'] }}"
                                    class="h-full w-full object-contain"
                                >
                            </div>
                            <div class="space-y-3">
                                <span class="inline-flex rounded-full bg-amber-100/80 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-amber-700">Item Eksklusif</span>
                                <h3 class="text-2xl font-bold tracking-tight text-slate-900">{{ $item['product_name'] }}</h3>
                                <div class="flex flex-wrap gap-2 text-sm text-slate-500">
                                    <span class="rounded-full bg-slate-100 px-3 py-1">{{ $item['variant_label'] ?: 'Standard' }}</span>
                                    <span class="rounded-full bg-slate-100 px-3 py-1">Qty: {{ $item['qty'] }}</span>
                                </div>
                                <p class="text-base text-slate-500">Harga satuan premium dengan kualitas terbaik di setiap pemesanan.</p>
                            </div>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-[auto_auto] sm:items-center">
                            <div class="flex items-center rounded-3xl border border-slate-200 bg-slate-50 px-3 py-2 shadow-sm">
                                <form action="{{ route('cart.update') }}" method="POST" class="cart-qty-form flex items-center gap-2">
                                    @csrf
                                    <input type="hidden" name="variant_id" value="{{ $item['variant_id'] }}">
                                    <button type="submit" name="qty" value="{{ $item['qty'] - 1 }}" class="qty-button h-10 w-10 rounded-2xl text-slate-600 transition duration-200 transform hover:scale-105 hover:bg-slate-100 hover:text-slate-900 active:scale-95">−</button>
                                    <span class="qty-value w-14 text-center font-bold text-slate-900 transition duration-200">{{ $item['qty'] }}</span>
                                    <button type="submit" name="qty" value="{{ $item['qty'] + 1 }}" class="qty-button h-10 w-10 rounded-2xl text-slate-600 transition duration-200 transform hover:scale-105 hover:bg-slate-100 hover:text-slate-900 active:scale-95">+</button>
                                </form>
                            </div>

                            <div class="rounded-3xl bg-slate-950 px-5 py-4 text-right text-white shadow-[0_20px_40px_rgba(15,23,42,0.15)]">
                                <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Subtotal</p>
                                <p class="mt-2 text-xl font-bold text-amber-300">Rp {{ number_format($item['price'] * $item['qty']) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-wrap items-center justify-between gap-4 border-t border-slate-200/70 pt-4 text-sm text-slate-600">
                        <p class="font-semibold text-slate-700">Harga: Rp {{ number_format($item['price']) }} / pcs</p>
                        <form action="{{ route('cart.remove', $item['variant_id']) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="rounded-full border border-red-100 bg-red-50 px-4 py-2 text-red-600 transition hover:bg-red-100 hover:text-red-800">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="rounded-[2rem] border border-dashed border-slate-300 bg-white/90 p-16 text-center shadow-[0_20px_40px_rgba(15,23,42,0.08)]">
                    <p class="text-lg font-semibold text-slate-700">Keranjang Anda masih kosong.</p>
                    <p class="mt-2 text-sm text-slate-500">Tambahkan produk terbaik dan lanjutkan dengan pengalaman belanja mewah.</p>
                    <a href="{{ route('home') }}" class="mt-6 inline-flex rounded-full bg-amber-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-amber-300/30 transition hover:bg-amber-400">Mulai Belanja →</a>
                </div>
            @endforelse
        </div>

        {{-- SUMMARY & CHECKOUT --}}
        <div class="space-y-6">
            <div class="rounded-[2rem] bg-slate-950 p-8 text-white shadow-[0_35px_80px_rgba(15,23,42,0.2)] sticky top-6">
                <div class="mb-6 flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Checkout Details</p>
                        <h2 class="mt-3 text-3xl font-black text-amber-300">Selesaikan Pesanan</h2>
                    </div>
                    <span class="inline-flex rounded-3xl bg-amber-400/10 px-4 py-2 text-sm font-semibold text-amber-300">Premium</span>
                </div>

                {{-- PILIH ALAMAT --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold uppercase tracking-[0.2em] text-slate-400 mb-3">Alamat Pengiriman</label>
                    <select id="addressSelector" class="w-full rounded-3xl border border-slate-800 bg-slate-900 px-4 py-3 text-sm text-white outline-none transition focus:border-amber-300 focus:ring-2 focus:ring-amber-300/20">
                        <option value="" class="text-slate-700">-- Pilih Alamat Tersimpan --</option>
                        @foreach($addresses as $addr)
                            <option value="{{ $addr->id }}">{{ $addr->name }} ({{ $addr->city }})</option>
                        @endforeach
                    </select>
                    <div class="mt-3">
                        @php
                            $routeAdd = auth()->user()->hasRole('admin') ? route('admin.addresses.create') : route('user.addresses.create');
                        @endphp
                        <a href="{{ $routeAdd }}" class="text-xs font-semibold uppercase tracking-[0.16em] text-amber-300 hover:text-amber-100">+ Tambah alamat baru</a>
                    </div>
                </div>

                <div class="space-y-4 rounded-[1.5rem] bg-slate-900/80 p-5 border border-slate-800">
                    <div class="flex justify-between text-sm text-slate-400">
                        <span>Total Barang</span>
                        <span>{{ collect($cart)->sum('qty') }} pcs</span>
                    </div>
                    <div class="flex justify-between text-sm text-slate-400">
                        <span>Biaya kirim</span>
                        <span>Gratis</span>
                    </div>
                    <div class="flex items-center justify-between border-t border-slate-800 pt-4 text-xl font-black text-white">
                        <span>Total Bayar</span>
                        <span>Rp {{ number_format(collect($cart)->sum(fn($i) => $i['price'] * $i['qty'])) }}</span>
                    </div>
                </div>

                <button id="payButton"
                    class="mt-6 w-full rounded-3xl bg-amber-400 px-6 py-4 text-lg font-bold text-slate-950 shadow-[0_25px_45px_rgba(251,191,36,0.35)] transition hover:bg-amber-300 active:scale-[0.99] disabled:cursor-not-allowed disabled:opacity-50"
                    {{ empty($cart) ? 'disabled' : '' }}>
                    Bayar Sekarang
                </button>
            </div>
        </div>

    </div>
</div>


{{-- MIDTRANS SNAP JS --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('services.midtrans.clientKey') }}"></script>


<script>
document.getElementById('payButton')?.addEventListener('click', function (e) {
    e.preventDefault();
    const addressId = document.getElementById('addressSelector').value;


    if (!addressId) {
        alert('Mohon pilih alamat pengiriman terlebih dahulu!');
        return;
    }


    const btn = this;
    btn.innerHTML = `<span class="animate-pulse">Processing...</span>`;
    btn.disabled = true;


    fetch("{{ route('checkout.store') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify({
            address_id: addressId
        })
    })
    .then(async res => {
        const data = await res.json();
        if (!res.ok) throw new Error(data.error || 'Server Error');
        return data;
    })
    .then(data => {
        snap.pay(data.snap_token, {
            onSuccess: function(result) {
                alert("Pembayaran Berhasil!");
                window.location.href = '/';
            },
            onPending: function(result) {
                alert("Menunggu pembayaran...");
                location.reload();
            },
            onError: function(result) {
                alert("Pembayaran gagal!");
                btn.innerHTML = "Bayar Sekarang";
                btn.disabled = false;
            },
            onClose: function() {
                btn.innerHTML = "Bayar Sekarang";
                btn.disabled = false;
            }
        });
    })
    .catch(err => {
        alert(err.message);
        btn.innerHTML = "Bayar Sekarang";
        btn.disabled = false;
    });
});

// Animasi kecil saat tombol quantity diklik
document.querySelectorAll('.qty-button').forEach(btn => {
    btn.addEventListener('click', function () {
        const qtyValue = this.closest('.cart-qty-form')?.querySelector('.qty-value');
        if (!qtyValue) return;

        qtyValue.classList.add('scale-110', 'text-amber-500');
        setTimeout(() => qtyValue.classList.remove('scale-110', 'text-amber-500'), 200);
    });
});
</script>
@endsection
