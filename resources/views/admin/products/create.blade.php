@extends('admin.layouts.app')

@section('title', 'Tambah Product')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Tambah Product</h1>
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-slate-200 dark:border-gray-800 p-6">
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.products.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Nama Product</label>
                <input name="name" value="{{ old('name') }}" required class="w-full border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-[#DA291C] focus:border-[#DA291C] outline-none" placeholder="Nama Product">
                @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Kategori</label>
                <select name="category_id" required class="w-full border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-[#DA291C] focus:border-[#DA291C] outline-none">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Deskripsi</label>
                <textarea name="description" rows="4" required class="w-full border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-[#DA291C] focus:border-[#DA291C] outline-none" placeholder="Deskripsi product">{{ old('description') }}</textarea>
                @error('description')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Gambar Product</label>
                <input type="file" name="images[]" multiple class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#DA291C] file:text-white hover:file:bg-[#B91C1C]">
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <h3 class="font-bold text-lg text-slate-900 dark:text-white">Variant Product</h3>
                    <button type="button" onclick="addVariant()" class="bg-green-600 text-white px-3 py-1 rounded-lg text-sm font-semibold hover:bg-green-700 transition">
                        + Tambah Variant
                    </button>
                </div>
                <div id="variant-wrapper" class="space-y-2">
                    <div class="grid grid-cols-5 gap-2 variant-item">
                        <input name="variants[0][color]" placeholder="Warna" class="border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2 text-sm outline-none focus:ring-2 focus:ring-[#DA291C]">
                        <input name="variants[0][size]" placeholder="Ukuran" class="border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2 text-sm outline-none focus:ring-2 focus:ring-[#DA291C]">
                        <input name="variants[0][price]" type="number" min="0" step="0.01" required placeholder="Harga" class="border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2 text-sm outline-none focus:ring-2 focus:ring-[#DA291C]">
                        <input name="variants[0][stock]" type="number" min="0" required placeholder="Stok" class="border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2 text-sm outline-none focus:ring-2 focus:ring-[#DA291C]">
                        <button type="button" onclick="removeVariant(this)" class="bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-bold transition">X</button>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <button class="px-6 py-2.5 bg-[#DA291C] text-white rounded-lg text-sm font-bold hover:bg-[#B91C1C] transition shadow-lg shadow-red-900/20">
                    Simpan Product
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
let variantIndex = 1;
function addVariant() {
    const wrapper = document.getElementById('variant-wrapper');
    const html = `
        <div class="grid grid-cols-5 gap-2 variant-item">
            <input name="variants[${variantIndex}][color]" placeholder="Warna" class="border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2 text-sm outline-none focus:ring-2 focus:ring-[#DA291C]">
            <input name="variants[${variantIndex}][size]" placeholder="Ukuran" class="border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2 text-sm outline-none focus:ring-2 focus:ring-[#DA291C]">
            <input name="variants[${variantIndex}][price]" type="number" min="0" step="0.01" required placeholder="Harga" class="border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2 text-sm outline-none focus:ring-2 focus:ring-[#DA291C]">
            <input name="variants[${variantIndex}][stock]" type="number" min="0" required placeholder="Stok" class="border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2 text-sm outline-none focus:ring-2 focus:ring-[#DA291C]">
            <button type="button" onclick="removeVariant(this)" class="bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-bold transition">X</button>
        </div>
    `;
    wrapper.insertAdjacentHTML('beforeend', html);
    variantIndex++;
}
function removeVariant(button) {
    button.closest('.variant-item').remove();
}
</script>
@endpush
@endsection
