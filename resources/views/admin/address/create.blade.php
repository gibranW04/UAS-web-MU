@extends('layouts.app')


@section('content')
<div class="max-w-6xl mx-auto px-4 py-12">
    <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr]">
        <div class="rounded-[2rem] border border-slate-200 bg-white p-10 shadow-[0_30px_100px_rgba(15,23,42,0.08)]">
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <span class="inline-flex rounded-full bg-amber-100 px-4 py-2 text-xs font-semibold uppercase tracking-[0.28em] text-amber-700">Admin Address</span>
                    <h1 class="mt-4 text-4xl font-black tracking-tight text-slate-950">Tambah Alamat Pengiriman</h1>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-500">Tambahkan alamat baru dengan cepat, agar proses pengiriman lebih lancar dan terlihat premium untuk pelanggan.</p>
                </div>
                <a href="{{ route('admin.addresses.index') }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-slate-50 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Kembali ke Daftar</a>
            </div>

            <form action="{{ route('admin.addresses.store') }}" method="POST" class="space-y-8">
                @csrf
                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Nama Penerima / Label Alamat</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Rumah Utama / Kantor"
                            class="w-full rounded-[1.75rem] border border-slate-200 bg-slate-50 px-5 py-4 text-sm text-slate-900 outline-none transition focus:border-amber-300 focus:ring-2 focus:ring-amber-100" required>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Nomor Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="0812xxxxxxxx"
                            class="w-full rounded-[1.75rem] border border-slate-200 bg-slate-50 px-5 py-4 text-sm text-slate-900 outline-none transition focus:border-amber-300 focus:ring-2 focus:ring-amber-100" required>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">Alamat Lengkap</label>
                    <textarea name="address" rows="4" placeholder="Nama jalan, blok, nomor rumah..."
                        class="w-full rounded-[1.75rem] border border-slate-200 bg-slate-50 px-5 py-4 text-sm text-slate-900 outline-none transition focus:border-amber-300 focus:ring-2 focus:ring-amber-100" required>{{ old('address') }}</textarea>
                </div>

                <div class="grid gap-6 sm:grid-cols-3">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Kota/Kabupaten</label>
                        <input type="text" name="city" value="{{ old('city') }}"
                            class="w-full rounded-[1.75rem] border border-slate-200 bg-slate-50 px-5 py-4 text-sm text-slate-900 outline-none transition focus:border-amber-300 focus:ring-2 focus:ring-amber-100" required>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Provinsi</label>
                        <input type="text" name="province" value="{{ old('province') }}"
                            class="w-full rounded-[1.75rem] border border-slate-200 bg-slate-50 px-5 py-4 text-sm text-slate-900 outline-none transition focus:border-amber-300 focus:ring-2 focus:ring-amber-100" required>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Kode Pos</label>
                        <input type="text" name="postal_code" value="{{ old('postal_code') }}"
                            class="w-full rounded-[1.75rem] border border-slate-200 bg-slate-50 px-5 py-4 text-sm text-slate-900 outline-none transition focus:border-amber-300 focus:ring-2 focus:ring-amber-100" required>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-[1fr_auto] sm:items-center">
                    <div class="rounded-[1.75rem] bg-slate-50 p-6 text-sm text-slate-600 shadow-sm">
                        <p class="font-semibold text-slate-900">Catatan Pengiriman</p>
                        <p class="mt-2">Dengan alamat ini, kamu bisa mengatur pengiriman dengan tampilan checkout yang lebih profesional untuk pelanggan.</p>
                    </div>
                    <button type="submit" class="inline-flex items-center justify-center rounded-3xl bg-amber-400 px-8 py-4 text-sm font-bold uppercase tracking-[0.18em] text-slate-950 shadow-lg shadow-amber-300/30 transition hover:bg-amber-300 active:scale-[0.98]">
                        Simpan Alamat
                    </button>
                </div>
            </form>
        </div>

        <aside class="rounded-[2rem] border border-slate-200 bg-gradient-to-br from-slate-950 to-slate-900 p-8 text-white shadow-[0_30px_80px_rgba(15,23,42,0.25)]">
            <div class="space-y-6">
                <div class="rounded-[1.75rem] bg-white/5 p-6">
                    <p class="text-sm uppercase tracking-[0.32em] text-amber-300">Fitur Admin</p>
                    <h3 class="mt-4 text-3xl font-black text-white">Pengelolaan Alamat Premium</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-300">Tambah dan kelola alamat dengan pengalaman visual yang rapi untuk admin dan pelanggan.</p>
                </div>

                <div class="rounded-[1.75rem] bg-white/5 p-6">
                    <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Tips</p>
                    <ul class="mt-4 space-y-3 text-sm text-slate-300">
                        <li class="flex items-start gap-3"><span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-amber-300"></span><span>Lengkapi nama penerima supaya mudah diidentifikasi.</span></li>
                        <li class="flex items-start gap-3"><span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-amber-300"></span><span>Gunakan nomor telepon yang valid untuk notifikasi kurir.</span></li>
                        <li class="flex items-start gap-3"><span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-amber-300"></span><span>Pastikan kode pos benar untuk mempercepat pengiriman.</span></li>
                    </ul>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
