@extends('admin.layouts.app')

@section('title', 'Tambah Category')

@section('content')
<div class="max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-6">Tambah Category</h1>
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-slate-200 dark:border-gray-800 p-6">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Nama Category</label>
            <input type="text" name="name" placeholder="Nama Category" class="w-full border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-[#DA291C] focus:border-[#DA291C] outline-none mb-1" required>
            @error('name')
                <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
            @enderror
            <div class="flex justify-end gap-2 mt-4">
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 border border-slate-200 dark:border-gray-700 rounded-lg text-sm font-semibold text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-gray-800 transition">
                    Batal
                </a>
                <button class="px-4 py-2 bg-[#DA291C] text-white rounded-lg text-sm font-semibold hover:bg-[#B91C1C] transition shadow-lg shadow-red-900/20">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
