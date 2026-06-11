<!DOCTYPE html>
<html lang="id" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers - Admin Manchester United Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/admin.js'])
    <style>
        * { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .dark ::-webkit-scrollbar-thumb { background: #475569; }
        .nav-link { transition: all 0.2s ease; position: relative; }
        .nav-link::before { content: ''; position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 3px; height: 0; background: #DA291C; border-radius: 0 4px 4px 0; transition: height 0.2s ease; }
        .nav-link:hover::before, .nav-link.active::before { height: 60%; }
        .nav-link.active { background: rgba(218,41,28,0.1); color: #DA291C; }
        .nav-link.active i { color: #DA291C; }
        .dark .nav-link.active { background: rgba(218,41,28,0.15); }
        .pagination { display: flex; gap: 4px; justify-content: center; }
        .pagination a, .pagination span { padding: 6px 12px; border-radius: 8px; font-size: 13px; font-weight: 500; background: white; color: #374151; border: 1px solid #e2e8f0; transition: all 0.15s ease; }
        .dark .pagination a, .dark .pagination span { background: #1e293b; color: #cbd5e1; border-color: #334155; }
        .pagination a:hover { background: #DA291C; color: white; border-color: #DA291C; }
        .pagination .active span { background: #DA291C; color: white; border-color: #DA291C; }
    </style>
    <script>
        if (localStorage.getItem('darkMode') === 'true' || (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="bg-slate-50 dark:bg-gray-950 text-slate-800 dark:text-slate-100 antialiased transition-colors">
    <div class="flex min-h-screen">
        @include('admin.partials.sidebar')

        <div class="flex-1 lg:pl-[280px]">
            @include('admin.partials.topnav', ['title' => 'Customers'])

            <main class="p-4 md:p-6 lg:p-8 max-w-7xl mx-auto">
                <div class="rounded-xl bg-white dark:bg-gray-900 border border-slate-200 dark:border-gray-800 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-slate-100 dark:border-gray-800 bg-slate-50 dark:bg-gray-800/50">
                                    <th class="text-left px-5 py-4 font-semibold text-slate-600 dark:text-slate-400">Customer</th>
                                    <th class="text-left px-5 py-4 font-semibold text-slate-600 dark:text-slate-400">Email</th>
                                    <th class="text-left px-5 py-4 font-semibold text-slate-600 dark:text-slate-400">Registered</th>
                                    <th class="text-left px-5 py-4 font-semibold text-slate-600 dark:text-slate-400">Orders</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-gray-800">
                                @forelse($users as $u)
                                <tr class="hover:bg-slate-50 dark:hover:bg-gray-800/30 transition-colors">
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-[#DA291C] to-[#991B1B] flex items-center justify-center text-white font-bold text-xs">
                                                {{ strtoupper(substr($u->name, 0, 1)) }}
                                            </div>
                                            <span class="font-semibold">{{ $u->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 text-slate-500 dark:text-slate-400">{{ $u->email }}</td>
                                    <td class="px-5 py-4 text-slate-500 dark:text-slate-400">{{ $u->created_at->format('d M Y') }}</td>
                                    <td class="px-5 py-4">
                                        <span class="font-semibold">{{ $u->orders_count }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-12 text-center text-slate-500 dark:text-slate-400">No customers found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </main>
        </div>
    </div>
</body>
</html>
