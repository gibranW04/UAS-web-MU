<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        $user = auth()->user();

        Alert::toast('Registrasi berhasil! Selamat datang, ' . $user->name . '!', 'success');

        if ($user && $user->hasRole('admin')) {
            return redirect('/admin/dashboard');
        }

        return redirect('/user/dashboard');
    }
}
