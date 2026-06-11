@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Edit Product</h1>
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-slate-200 dark:border-gray-800 p-6">
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.products.update', $product) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Nama Product</label>
                <input name="name" value="{{ old('name', $product->name) }}" class="w-full border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-[#DA291C] focus:border-[#DA291C] outline-none">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Kategori</label>
                <select name="category_id" class="w-full border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-[#DA291C] focus:border-[#DA291C] outline-none">
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" @selected($product->category_id == $c->id)>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-[#DA291C] focus:border-[#DA291C] outline-none">{{ old('description', $product->description) }}</textarea>
            </div>

            <div>
                <h3 class="font-bold text-sm text-slate-900 dark:text-white mb-2">Gambar Saat Ini</h3>
                <div class="flex gap-3 flex-wrap">
                    @foreach($product->images as $img)
                        <label class="relative cursor-pointer">
                            <img src="{{ asset('storage/'.$img->image) }}" class="w-24 h-24 object-cover rounded-lg border border-slate-200 dark:border-gray-700">
                            <input type="checkbox" name="delete_images[]" value="{{ $img->id }}" class="absolute top-1 right-1 accent-red-600">
                            <span class="absolute top-1 right-7 bg-red-600 text-white text-[10px] px-1 rounded font-semibold">Hapus</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Tambah Gambar Baru</label>
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
                    @foreach($product->variants as $i => $v)
                        <div class="grid grid-cols-5 gap-2 variant-item">
                            <input name="variants[{{ $i }}][color]" value="{{ $v->color }}" class="border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2 text-sm outline-none focus:ring-2 focus:ring-[#DA291C]">
                            <input name="variants[{{ $i }}][size]" value="{{ $v->size }}" class="border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2 text-sm outline-none focus:ring-2 focus:ring-[#DA291C]">
                            <input name="variants[{{ $i }}][price]" value="{{ $v->price }}" class="border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2 text-sm outline-none focus:ring-2 focus:ring-[#DA291C]">
                            <input name="variants[{{ $i }}][stock]" value="{{ $v->stock }}" class="border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2 text-sm outline-none focus:ring-2 focus:ring-[#DA291C]">
                            <button type="button" onclick="removeVariant(this)" class="bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-bold transition">X</button>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-between items-center pt-2">
                <a href="{{ route('admin.products.index') }}" class="text-sm font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 transition">
                    &larr; Kembali
                </a>
                <button class="px-6 py-2.5 bg-[#DA291C] text-white rounded-lg text-sm font-bold hover:bg-[#B91C1C] transition shadow-lg shadow-red-900/20">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
let variantIndex = {{ $product->variants->count() }};
function addVariant() {
    const wrapper = document.getElementById('variant-wrapper');
    wrapper.insertAdjacentHTML('beforeend', `
        <div class="grid grid-cols-5 gap-2 variant-item">
            <input name="variants[${variantIndex}][color]" class="border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2 text-sm outline-none focus:ring-2 focus:ring-[#DA291C]">
            <input name="variants[${variantIndex}][size]" class="border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2 text-sm outline-none focus:ring-2 focus:ring-[#DA291C]">
            <input name="variants[${variantIndex}][price]" class="border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2 text-sm outline-none focus:ring-2 focus:ring-[#DA291C]">
            <input name="variants[${variantIndex}][stock]" class="border border-slate-200 dark:border-gray-700 bg-slate-50 dark:bg-gray-800 rounded-lg p-2 text-sm outline-none focus:ring-2 focus:ring-[#DA291C]">
            <button type="button" onclick="removeVariant(this)" class="bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-bold transition">X</button>
        </div>
    `);
    variantIndex++;
}
function removeVariant(btn) {
    btn.closest('.variant-item').remove();
}
</script>
@endpush
@endsection
