<!DOCTYPE html>
<html lang="id" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Manchester United Store')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/admin.js'])
    @stack('styles')
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
        .badge { display: inline-flex; align-items: center; padding: 2px 10px; border-radius: 9999px; font-size: 11px; font-weight: 600; letter-spacing: 0.025em; }
        .pagination { display: flex; gap: 4px; justify-content: center; }
        .pagination a, .pagination span { padding: 6px 12px; border-radius: 8px; font-size: 13px; font-weight: 500; background: white; color: #374151; border: 1px solid #e2e8f0; transition: all 0.15s ease; }
        .dark .pagination a, .dark .pagination span { background: #1e293b; color: #cbd5e1; border-color: #334155; }
        .pagination a:hover { background: #DA291C; color: white; border-color: #DA291C; }
        .pagination .active span { background: #DA291C; color: white; border-color: #DA291C; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in-up { animation: fadeInUp 0.6s ease forwards; }
        @media (max-width: 1023px) {
            .sidebar-open #sidebar { transform: translateX(0); }
            .sidebar-open #sidebarOverlay { display: block; }
        }
    </style>
    <script>
        if (localStorage.getItem('darkMode') === 'true' || (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="bg-slate-50 dark:bg-gray-950 text-slate-800 dark:text-slate-100 antialiased transition-colors">

<div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

@include('admin.partials.sidebar')

<div class="flex-1 lg:pl-[280px] min-h-screen">
    @include('admin.partials.topnav', ['title' => $title ?? 'Admin'])

    <main class="p-4 md:p-6 lg:p-8 max-w-7xl mx-auto">
        @yield('content')
    </main>
</div>

@include('partials.sweetalert')
@stack('scripts')

</body>
</html>
