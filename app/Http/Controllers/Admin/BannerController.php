<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('sort_order')->latest()->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|max:2048',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only([
            'title', 'description', 'button_text', 'button_link',
            'sort_order', 'is_active',
        ]);

        $data['image'] = $request->file('image')->store('banners', 'public');

        if (!isset($data['is_active'])) {
            $data['is_active'] = false;
        }

        Banner::create($data);

        Alert::toast('Banner berhasil ditambahkan!', 'success');

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner berhasil ditambahkan');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only([
            'title', 'description', 'button_text', 'button_link',
            'sort_order', 'is_active',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($banner->image);
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        if (!isset($data['is_active'])) {
            $data['is_active'] = false;
        }

        $banner->update($data);

        Alert::toast('Banner berhasil diperbarui!', 'success');

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner berhasil diperbarui');
    }

    public function destroy(Banner $banner)
    {
        Storage::disk('public')->delete($banner->image);
        $banner->delete();

        Alert::toast('Banner berhasil dihapus!', 'success');

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner berhasil dihapus');
    }
}
