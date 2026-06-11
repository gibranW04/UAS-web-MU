@extends('admin.layouts.app')

@section('title', 'Banners')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Banner Hero</h1>
        <a href="{{ route('admin.banners.create') }}" class="px-4 py-2 bg-[#DA291C] text-white rounded-lg hover:bg-[#B91C1C] text-sm font-semibold transition shadow-lg shadow-red-900/20">
            + Tambah Banner
        </a>
    </div>
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-slate-200 dark:border-gray-800 overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-50 dark:bg-gray-800">
                <tr>
                    <th class="p-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">No</th>
                    <th class="p-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Gambar</th>
                    <th class="p-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Judul</th>
                    <th class="p-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Urutan</th>
                    <th class="p-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Status</th>
                    <th class="p-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-gray-800">
                @forelse ($banners as $banner)
                    <tr class="hover:bg-slate-50 dark:hover:bg-gray-800/50 transition">
                        <td class="p-3 text-sm text-slate-600 dark:text-slate-400">{{ $loop->iteration }}</td>
                        <td class="p-3">
                            <img src="{{ asset('storage/' . $banner->image) }}" class="w-24 h-16 object-cover rounded-lg border border-slate-200 dark:border-gray-700">
                        </td>
                        <td class="p-3 text-sm font-medium text-slate-900 dark:text-white">{{ $banner->title }}</td>
                        <td class="p-3 text-sm text-slate-500 dark:text-slate-400">{{ $banner->sort_order }}</td>
                        <td class="p-3">
                            @if ($banner->is_active)
                                <span class="badge bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Aktif</span>
                            @else
                                <span class="badge bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400">Nonaktif</span>
                            @endif
                        </td>
                        <td class="p-3 text-sm">
                            <a href="{{ route('admin.banners.edit', $banner) }}" class="text-blue-600 hover:text-blue-700 dark:text-blue-400 font-semibold mr-3">Edit</a>
                            <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus banner ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:text-red-700 dark:text-red-400 font-semibold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-6 text-center text-sm text-slate-500 dark:text-slate-400">Belum ada banner</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
