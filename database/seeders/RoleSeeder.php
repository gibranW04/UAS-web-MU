<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        collect([
            ['name' => 'admin'],
            ['name' => 'member'],
            ['name' => 'author'],
        ])->each(fn ($data) => Role::create($data));
    }
}
