<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class AddressController extends Controller
{
    public function index()
    {
        // Hanya ambil alamat milik admin yang sedang login
        $addresses = Address::where('user_id', Auth::id())->latest()->get();
        return view('admin.address.index', compact('addresses'));
    }


    public function create()
    {
        return view('admin.address.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'postal_code' => 'required',
        ]);


        // Masukkan user_id otomatis dari ID Admin yang login
        Address::create($request->all() + ['user_id' => Auth::id()]);

        Alert::toast('Alamat berhasil ditambahkan!', 'success');

        return redirect()->route('admin.addresses.index')->with('success', 'Alamat Anda berhasil ditambahkan');
    }


    public function edit(Address $address)
    {
        // Keamanan: Pastikan admin tidak mengedit alamat milik user lain via URL
        if ($address->user_id !== Auth::id()) abort(403);


        return view('admin.address.edit', compact('address'));
    }


    public function update(Request $request, Address $address)
    {
        if ($address->user_id !== Auth::id()) abort(403);


        $address->update($request->all());
        Alert::toast('Alamat berhasil diperbarui!', 'success');
        return redirect()->route('admin.addresses.index')->with('success', 'Alamat Anda berhasil diperbarui');
    }


    public function destroy(Address $address)
    {
        if ($address->user_id !== Auth::id()) abort(403);


        $address->delete();
        Alert::toast('Alamat berhasil dihapus!', 'success');
        return back()->with('success', 'Alamat berhasil dihapus');
    }
}
