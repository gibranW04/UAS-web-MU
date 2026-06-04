<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

$email = 'testuser@example.com';
$password = 'password123';

if (User::where('email', $email)->exists()) {
    echo "User with email {$email} already exists.\n";
    exit(0);
}

$user = User::create([
    'name' => 'Test User',
    'username' => 'testuser',
    'email' => $email,
    'password' => app('hash')->make($password),
]);

$role = Role::firstOrCreate(['name' => 'user']);
$user->assignRole($role);

echo "Created test user: {$email} with password: {$password}\n";
