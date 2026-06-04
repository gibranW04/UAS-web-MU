<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        $user = auth()->user();

        if ($user && $user->hasRole('admin')) {
            return redirect('/admin/dashboard');
        }

        return redirect('/user/dashboard');
    }
}
