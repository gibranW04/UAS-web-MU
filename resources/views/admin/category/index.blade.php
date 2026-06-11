@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Categories</h1>
        <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-[#DA291C] text-white rounded-lg hover:bg-[#B91C1C] text-sm font-semibold transition shadow-lg shadow-red-900/20">
            + Tambah Category
        </a>
    </div>
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-slate-200 dark:border-gray-800 overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-50 dark:bg-gray-800">
                <tr>
                    <th class="p-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">No</th>
                    <th class="p-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Nama</th>
                    <th class="p-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Slug</th>
                    <th class="p-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-gray-800">
                @forelse ($categories as $category)
                    <tr class="hover:bg-slate-50 dark:hover:bg-gray-800/50 transition">
                        <td class="p-3 text-sm text-slate-600 dark:text-slate-400">{{ $loop->iteration }}</td>
                        <td class="p-3 text-sm font-medium text-slate-900 dark:text-white">{{ $category->name }}</td>
                        <td class="p-3 text-sm text-slate-500 dark:text-slate-400">{{ $category->slug }}</td>
                        <td class="p-3 text-sm">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-600 hover:text-blue-700 dark:text-blue-400 font-semibold mr-3">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:text-red-700 dark:text-red-400 font-semibold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-6 text-center text-sm text-slate-500 dark:text-slate-400">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
