<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Gibran Wicaksono',
            'username' => 'gbrnwcksno',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('aquarius2004'),
        ]);

        $role = Role::where('name', 'admin')->first();

        if ($role) {
            $user->assignRole($role);
        }
    }
}
