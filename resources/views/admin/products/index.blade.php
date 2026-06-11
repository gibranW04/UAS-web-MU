@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Products</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-[#DA291C] text-white rounded-lg hover:bg-[#B91C1C] text-sm font-semibold transition shadow-lg shadow-red-900/20">
                + Tambah Product
            </a>
        </div>
    </div>
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-slate-200 dark:border-gray-800 overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-50 dark:bg-gray-800">
                <tr>
                    <th class="p-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Nama</th>
                    <th class="p-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Kategori</th>
                    <th class="p-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Variant</th>
                    <th class="p-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Harga Mulai</th>
                    <th class="p-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-gray-800">
                @foreach($products as $product)
                <tr class="hover:bg-slate-50 dark:hover:bg-gray-800/50 transition">
                    <td class="p-3 text-sm font-medium text-slate-900 dark:text-white">{{ $product->name }}</td>
                    <td class="p-3 text-sm text-slate-500 dark:text-slate-400">{{ $product->category->name }}</td>
                    <td class="p-3 text-sm text-slate-500 dark:text-slate-400">{{ $product->variants->count() }}</td>
                    <td class="p-3 text-sm text-slate-500 dark:text-slate-400">Rp {{ number_format($product->variants->min('price') ?? 0) }}</td>
                    <td class="p-3 text-sm space-x-2">
                        <a href="{{ route('admin.products.show', $product) }}" class="text-blue-600 hover:text-blue-700 dark:text-blue-400 font-semibold">Detail</a>
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-yellow-600 hover:text-yellow-700 dark:text-yellow-400 font-semibold">Edit</a>
                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline" onsubmit="return confirm('Hapus product ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:text-red-700 dark:text-red-400 font-semibold">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
