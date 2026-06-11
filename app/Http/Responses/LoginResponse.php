<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use RealRashid\SweetAlert\Facades\Alert;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = auth()->user();

        Alert::toast(
            'Selamat datang kembali, ' . $user->name . '!',
            'success'
        );

        if ($user && $user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user && $user->hasRole('user')) {
            return redirect()->route('user.dashboard');
        }

        return redirect()->route('home');
    }
}
