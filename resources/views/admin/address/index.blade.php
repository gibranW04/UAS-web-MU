@extends('layouts.app')


@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
        <section class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-[0_30px_100px_rgba(15,23,42,0.08)]">
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <span class="inline-flex rounded-full bg-amber-100 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-amber-700">Admin Address</span>
                    <h1 class="mt-4 text-4xl font-black tracking-tight text-slate-950">Daftar Alamat Pengiriman</h1>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-500">Kelola alamat pengiriman dengan tampilan premium untuk pengalaman admin yang lebih profesional.</p>
                </div>
                <a href="{{ route('admin.addresses.create') }}" class="inline-flex items-center justify-center rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800 shadow-lg shadow-slate-200/20">+ Tambah Alamat</a>
            </div>

            @if(session('success'))
                <div class="mb-6 rounded-[1.5rem] bg-emerald-50 border border-emerald-200 p-4 text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid gap-6">
                @forelse($addresses as $address)
                    <article class="rounded-[1.75rem] border border-slate-200 bg-slate-50 p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-[0_25px_60px_rgba(15,23,42,0.08)]">
                        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                            <div class="space-y-3">
                                <div class="flex flex-wrap items-center gap-3">
                                    <h2 class="text-xl font-bold text-slate-950">{{ $address->name }}</h2>
                                    <span class="rounded-full bg-white px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-slate-500 shadow-sm">Alamat Admin</span>
                                </div>
                                <p class="text-sm text-slate-600">{{ $address->address }}, {{ $address->city }}, {{ $address->province }} {{ $address->postal_code }}</p>
                                <p class="text-sm font-semibold text-slate-800">{{ $address->phone }}</p>
                            </div>

                            <div class="flex flex-wrap items-center gap-3">
                                <a href="{{ route('admin.addresses.edit', $address->id) }}" class="inline-flex rounded-full bg-amber-400 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-amber-300">Edit</a>
                                <form action="{{ route('admin.addresses.destroy', $address->id) }}" method="POST" onsubmit="return confirm('Hapus alamat ini?')" class="inline-block">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="inline-flex rounded-full bg-rose-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-rose-400">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rounded-[1.75rem] border border-dashed border-slate-300 bg-white p-12 text-center text-slate-500">
                        <p class="text-lg font-semibold text-slate-900">Belum ada alamat yang ditambahkan.</p>
                        <p class="mt-2 text-sm">Klik tombol Tambah Alamat untuk membuat alamat baru.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <aside class="rounded-[2rem] border border-slate-200 bg-gradient-to-br from-slate-950 to-slate-900 p-8 text-white shadow-[0_30px_80px_rgba(15,23,42,0.25)]">
            <div class="space-y-6">
                <div class="rounded-[1.75rem] bg-white/5 p-6">
                    <p class="text-sm uppercase tracking-[0.32em] text-amber-300">Statistik</p>
                    <h3 class="mt-4 text-3xl font-black text-white">Total Alamat</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-300">Anda memiliki <span class="font-semibold text-white">{{ $addresses->count() }}</span> alamat tersimpan.</p>
                </div>

                <div class="rounded-[1.75rem] bg-white/5 p-6">
                    <p class="text-sm uppercase tracking-[0.28em] text-slate-400">Panduan</p>
                    <ul class="mt-4 space-y-3 text-sm text-slate-300">
                        <li class="flex items-start gap-3"><span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-amber-300"></span><span>Jaga detail alamat tetap lengkap dan akurat.</span></li>
                        <li class="flex items-start gap-3"><span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-amber-300"></span><span>Gunakan nama penerima yang mudah dikenali.</span></li>
                        <li class="flex items-start gap-3"><span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-amber-300"></span><span>Hapus alamat yang sudah tidak terpakai agar daftar tetap bersih.</span></li>
                    </ul>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
