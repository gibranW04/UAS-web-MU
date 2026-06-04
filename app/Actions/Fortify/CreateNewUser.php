<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'role' => ['required', 'string', Rule::in(['user', 'admin'])],
            'admin_code' => ['required_if:role,admin', 'string', 'in:' . env('ADMIN_REGISTRATION_CODE', 'MUADMIN2026')],
        ])->validate();

        $roleName = $input['role'] ?? 'user';

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'username' => $this->generateUniqueUsername($input['name']),
            'password' => Hash::make($input['password']),
        ]);

        // Ensure the role exists (create if missing) then assign
        $role = Role::firstOrCreate(['name' => $roleName]);
        $user->assignRole($role);

        return $user;
    }

    /**
     * Generate a unique username based on the user's name.
     */
    protected function generateUniqueUsername(string $name): string
    {
        $base = Str::slug($name) ?: 'user';
        $username = $base;
        $i = 1;

        while (User::where('username', $username)->exists()) {
            $username = $base.'-'.$i++;
        }

        return $username;
    }
}
