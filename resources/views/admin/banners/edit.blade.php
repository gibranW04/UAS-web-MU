@extends('admin.layouts.app')

@section('title', 'Edit Banner')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Edit Banner</h1>
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-slate-200 dark:border-gray-800 p-6">
        <form method="POST" action="{{ route('admin.banners.update', $banner) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Judul</label>
                <input type="text" name="title" value="{{ old('title', $banner->title) }}" class="w-full border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-[#DA291C] focus:border-[#DA291C] outline-none" required>
                @error('title')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-[#DA291C] focus:border-[#DA291C] outline-none">{{ old('description', $banner->description) }}</textarea>
                @error('description')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Gambar (1920&times;900 px, max 2MB)</label>
                @if ($banner->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $banner->image) }}" class="w-48 h-32 object-cover rounded-lg border border-slate-200 dark:border-gray-700">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#DA291C] file:text-white hover:file:bg-[#B91C1C]">
                <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengganti gambar</p>
                @error('image')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Teks Tombol</label>
                    <input type="text" name="button_text" value="{{ old('button_text', $banner->button_text) }}" class="w-full border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-[#DA291C] focus:border-[#DA291C] outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Link Tombol</label>
                    <input type="text" name="button_link" value="{{ old('button_link', $banner->button_link) }}" class="w-full border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-[#DA291C] focus:border-[#DA291C] outline-none" placeholder="{{ url('/') }}">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Urutan</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $banner->sort_order) }}" class="w-full border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-[#DA291C] focus:border-[#DA291C] outline-none" min="0">
                </div>
                <div class="flex items-end pb-2.5">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $banner->is_active) ? 'checked' : '' }} class="accent-[#DA291C] w-4 h-4">
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Aktif</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <a href="{{ route('admin.banners.index') }}" class="px-4 py-2 border border-slate-200 dark:border-gray-700 rounded-lg text-sm font-semibold text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-gray-800 transition">
                    Batal
                </a>
                <button class="px-4 py-2 bg-[#DA291C] text-white rounded-lg text-sm font-semibold hover:bg-[#B91C1C] transition shadow-lg shadow-red-900/20">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
