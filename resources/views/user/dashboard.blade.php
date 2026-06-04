<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="max-w-4xl mx-auto mt-16 bg-white p-8 rounded-lg shadow">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Dashboard User</h1>
            <p class="text-gray-600 mt-1">Selamat datang, {{ auth()->user()->name }} 👋</p>
        </div>
        <div class="flex gap-3 flex-wrap">
            <a href="{{ url('/') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-md text-sm font-semibold transition">Homepage</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm transition">
                    Logout
                </button>
            </form>
        </div>
    </div>
    <div class="space-y-4">
        <div class="p-6 bg-gray-50 rounded-lg border border-gray-200">
            <h2 class="font-semibold text-lg text-gray-800">Akun Anda</h2>
            <p class="text-gray-600 mt-2">Email: {{ auth()->user()->email }}</p>
            <p class="text-gray-600">Peran: {{ auth()->user()->getRoleNames()->join(', ') }}</p>
        </div>
        <div class="p-6 bg-gray-50 rounded-lg border border-gray-200">
            <p class="text-gray-700">Gunakan dashboard ini untuk melihat informasi akun dan kembali ke toko Manchester United.</p>
            <a href="{{ url('/') }}" class="inline-block mt-4 text-red-600 hover:text-red-700">Kembali ke toko</a>
        </div>
    </div>
</div>
</body>
</html>
