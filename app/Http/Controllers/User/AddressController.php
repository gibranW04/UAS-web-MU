<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Tampilkan semua alamat milik user
     */
    public function index()
    {
        $addresses = Address::where(
            'user_id',
            Auth::id()
        )->latest()->get();

        return view(
            'user.address.index',
            compact('addresses')
        );
    }

    /**
     * Form tambah alamat
     */
    public function create()
    {
        return view('user.address.create');
    }

    /**
     * Simpan alamat baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'postal_code' => 'required',
        ]);

        $validated['user_id'] = Auth::id();

        Address::create($validated);

        return redirect()
            ->route('user.addresses.index')
            ->with(
                'success',
                'Alamat berhasil ditambahkan'
            );
    }

    /**
     * Form edit alamat
     */
    public function edit(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        return view(
            'user.address.edit',
            compact('address')
        );
    }

    /**
     * Update alamat
     */
    public function update(
        Request $request,
        Address $address
    ) {

        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'postal_code' => 'required',
        ]);

        $address->update($validated);

        return redirect()
            ->route('user.addresses.index')
            ->with(
                'success',
                'Alamat berhasil diperbarui'
            );
    }

    /**
     * Hapus alamat
     */
    public function destroy(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        $address->delete();

        return redirect()
            ->route('user.addresses.index')
            ->with(
                'success',
                'Alamat berhasil dihapus'
            );
    }
}
