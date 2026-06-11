@extends('admin.layouts.app')

@section('title', 'Detail Product - ' . $product->name)

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 transition mb-6">
        &larr; Kembali ke Products
    </a>

    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-slate-200 dark:border-gray-800 overflow-hidden">
        <div class="bg-gradient-to-r from-[#DA291C] to-[#991B1B] px-6 py-5 text-white">
            <h1 class="text-2xl font-black">{{ $product->name }}</h1>
            <p class="text-white/70 text-sm mt-1">{{ $product->category->name }}</p>
        </div>

        <div class="p-6 space-y-6">
            <div>
                <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-2">Deskripsi</h3>
                <p class="text-sm text-slate-600 dark:text-slate-400">{{ $product->description }}</p>
            </div>

            <div>
                <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-3">Gambar</h3>
                <div class="flex gap-3 flex-wrap">
                    @foreach ($product->images as $img)
                        <img src="{{ asset('storage/' . $img->image) }}" class="w-24 h-24 object-cover rounded-lg border border-slate-200 dark:border-gray-700">
                    @endforeach
                </div>
            </div>

            <div>
                <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-3">Variant</h3>
                <div class="overflow-hidden rounded-lg border border-slate-200 dark:border-gray-700">
                    <table class="w-full">
                        <thead class="bg-slate-50 dark:bg-gray-800">
                            <tr>
                                <th class="p-2 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Warna</th>
                                <th class="p-2 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Ukuran</th>
                                <th class="p-2 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Harga</th>
                                <th class="p-2 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Stok</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-gray-800">
                            @foreach ($product->variants as $v)
                                <tr class="hover:bg-slate-50 dark:hover:bg-gray-800/50">
                                    <td class="p-2 text-sm text-slate-600 dark:text-slate-400">{{ $v->color }}</td>
                                    <td class="p-2 text-sm text-slate-600 dark:text-slate-400">{{ $v->size }}</td>
                                    <td class="p-2 text-sm font-semibold text-slate-900 dark:text-white">Rp {{ number_format($v->price) }}</td>
                                    <td class="p-2 text-sm text-slate-600 dark:text-slate-400">{{ $v->stock }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
