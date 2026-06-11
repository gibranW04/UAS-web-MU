<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors('Gagal login dengan ' . $provider);
        }

        $user = User::where('provider', $provider)
            ->where('provider_id', $socialUser->getId())
            ->first();

        if (! $user) {
            // If email exists, link provider
            if ($socialUser->getEmail()) {
                $user = User::where('email', $socialUser->getEmail())->first();
            }
        }

        if ($user) {
            $user->update([
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
            ]);

            if (! $user->roles()->exists()) {
                $user->assignRole(Role::firstOrCreate(['name' => 'user']));
            }
        } else {
            $usernameBase = Str::slug($socialUser->getNickname() ?? $socialUser->getName() ?? 'user') ?: 'user';
            $username = $usernameBase;
            $counter = 1;

            while (User::where('username', $username)->exists()) {
                $username = $usernameBase . '-' . $counter;
                $counter++;
            }

            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User',
                'username' => $username,
                'email' => $socialUser->getEmail() ?? ('no-email+' . Str::random(8) . '@example.com'),
                'password' => Hash::make(Str::random(24)),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
            ]);

            $user->assignRole(Role::firstOrCreate(['name' => 'user']));
        }

        Auth::login($user, true);

        Alert::toast('Login berhasil! Selamat datang, ' . $user->name . '!', 'success');

        if ($user->hasRole('admin')) {
            return redirect()->intended('/admin/dashboard');
        }

        return redirect()->intended('/user/dashboard');
    }
}
