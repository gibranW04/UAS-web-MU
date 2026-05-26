<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="max-w-4xl mx-auto mt-16 bg-white p-8 rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
            <p class="text-gray-600 mt-1">Selamat datang, {{ auth()->user()->name }} 👋</p>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm transition">
                Logout
            </button>
        </form>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ route('admin.categories.index') }}" class="block p-6 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition">
            📂 Category
        </a>
        <a href="{{ route('admin.products.index') }}" class="block p-6 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition">
            📦 Product
        </a>
    </div>
</div>
</body>
</html>
