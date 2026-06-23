<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Manchester United Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .glass {
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        .glass-dark {
            background: rgba(10,10,10,0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.06);
        }
        .stat-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -8px rgba(0,0,0,0.12);
        }
        .nav-link {
            transition: all 0.2s ease;
            position: relative;
        }
        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 0;
            background: #DA291C;
            border-radius: 0 4px 4px 0;
            transition: height 0.2s ease;
        }
        .nav-link:hover::before,
        .nav-link.active::before {
            height: 60%;
        }
        .nav-link.active {
            background: rgba(218,41,28,0.1);
            color: #DA291C;
        }
        .nav-link.active svg { color: #DA291C; }
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 2px 10px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.025em;
        }
        .status-step { transition: all 0.4s ease; }
        .status-step.active { box-shadow: 0 0 0 4px rgba(218,41,28,0.15); }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes countUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fadeInUp 0.6s ease forwards; }
        .animate-count { animation: countUp 0.8s ease forwards; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        @media (max-width: 1023px) {
            .sidebar-open #sidebar { transform: translateX(0); }
            .sidebar-open #sidebarOverlay { display: block; }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            window.toggleSidebar = function () {
                document.body.classList.toggle('sidebar-open');
            };
            const counters = document.querySelectorAll('.stat-number');
            counters.forEach(function (el) {
                var target = parseInt(el.dataset.target);
                var duration = 800;
                var start = 0;
                var startTime = null;
                function step(timestamp) {
                    if (!startTime) startTime = timestamp;
                    var progress = Math.min((timestamp - startTime) / duration, 1);
                    var eased = 1 - Math.pow(1 - progress, 3);
                    el.textContent = Math.floor(eased * target);
                    if (progress < 1) requestAnimationFrame(step);
                }
                requestAnimationFrame(step);
            });
            var navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(function (link) {
                link.addEventListener('click', function () {
                    navLinks.forEach(function (l) { l.classList.remove('active'); });
                    this.classList.add('active');
                    if (window.innerWidth < 1024) toggleSidebar();
                });
            });
        });
    </script>
</head>
<body class="bg-[#f1f5f9] text-slate-800 antialiased">
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

    @include('user.partials.sidebar')

    {{-- MAIN WRAPPER --}}
    <div class="lg:pl-[280px] min-h-screen">
        {{-- TOP BAR --}}
        <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-xl border-b border-slate-200/60">
            <div class="flex items-center justify-between px-4 md:px-6 h-16">
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 -ml-2 rounded-lg hover:bg-slate-100 transition-colors">
                        <svg class="w-5 h-5 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                    </button>
                    <div>
                        <h1 class="text-base font-bold text-slate-900">Dashboard</h1>
                        <p class="text-xs text-slate-500">{{ now()->format('l, d F Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ url('/') }}" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                        Homepage
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="hidden sm:block">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-semibold text-white bg-[#DA291C] hover:bg-[#B91C1C] transition-colors shadow-lg shadow-red-900/20">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        {{-- MAIN CONTENT --}}
        <main class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">

            {{-- WELCOME CARD --}}
            <section class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#DA291C] via-[#B91C1C] to-[#7F1D1D] p-6 md:p-8 text-white animate-fade-in-up">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/3 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/3 blur-3xl"></div>
                <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-xs font-semibold tracking-wide mb-3">
                            <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                            Account Active
                        </div>
                        <h2 class="text-2xl md:text-3xl font-black tracking-tight">Welcome back, {{ $user->name }}!</h2>
                        <p class="mt-2 text-white/70 text-sm md:text-base max-w-xl">Welcome back to Manchester United Store. Manage your orders, wishlist, and account settings all in one place.</p>
                    </div>
                    <div class="flex gap-3 flex-shrink-0">
                        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white text-[#DA291C] font-bold text-sm hover:bg-white/90 transition-all shadow-lg shadow-black/20">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/></svg>
                            Shop Now
                        </a>
                        <a href="{{ route('user.orders.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white/10 text-white font-semibold text-sm hover:bg-white/20 transition-all border border-white/20">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z"/></svg>
                            View Orders
                        </a>
                    </div>
                </div>
            </section>

            {{-- STATISTICS CARDS --}}
            <section class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                @php
                    $maxStat = max($totalOrders, 1);
                    $stats = [
                        ['label' => 'Total Orders', 'value' => $totalOrders, 'pct' => ($totalOrders / $maxStat) * 100, 'icon' => 'M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z', 'color' => 'from-[#DA291C] to-[#991B1B]', 'bg' => 'bg-red-50', 'iconBg' => 'bg-red-100', 'iconColor' => 'text-[#DA291C]', 'delay' => 'delay-100'],
                        ['label' => 'Pending Orders', 'value' => $pendingOrders, 'pct' => ($pendingOrders / $maxStat) * 100, 'icon' => 'M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z', 'color' => 'from-amber-500 to-orange-600', 'bg' => 'bg-amber-50', 'iconBg' => 'bg-amber-100', 'iconColor' => 'text-amber-600', 'delay' => 'delay-200'],
                        ['label' => 'Shipped Orders', 'value' => $shippedOrders, 'pct' => ($shippedOrders / $maxStat) * 100, 'icon' => 'M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12', 'color' => 'from-blue-500 to-indigo-600', 'bg' => 'bg-blue-50', 'iconBg' => 'bg-blue-100', 'iconColor' => 'text-blue-600', 'delay' => 'delay-300'],
                        ['label' => 'Completed Orders', 'value' => $completedOrders, 'pct' => ($completedOrders / $maxStat) * 100, 'icon' => 'M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z', 'color' => 'from-emerald-500 to-teal-600', 'bg' => 'bg-emerald-50', 'iconBg' => 'bg-emerald-100', 'iconColor' => 'text-emerald-600', 'delay' => 'delay-400'],
                    ];
                @endphp
                @foreach($stats as $stat)
                <div class="stat-card rounded-xl bg-white p-5 border border-slate-200/60 shadow-sm animate-fade-in-up {{ $stat['delay'] }}">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-lg {{ $stat['iconBg'] }} {{ $stat['iconColor'] }} flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}"/></svg>
                        </div>
                        <span class="text-2xl font-black text-slate-900 stat-number" data-target="{{ $stat['value'] }}">{{ $stat['value'] }}</span>
                    </div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">{{ $stat['label'] }}</p>
                    <div class="mt-3 h-1.5 rounded-full bg-slate-100 overflow-hidden">
                        <div class="h-full rounded-full bg-gradient-to-r {{ $stat['color'] }}" style="width: {{ min($stat['pct'], 100) }}%"></div>
                    </div>
                </div>
                @endforeach
            </section>

            {{-- RECENT ORDERS + WISHLIST --}}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                {{-- RECENT ORDERS TABLE --}}
                <section class="xl:col-span-2 rounded-xl bg-white border border-slate-200/60 shadow-sm overflow-hidden animate-fade-in-up delay-200">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-red-50 text-[#DA291C] flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z"/></svg>
                            </div>
                            <h3 class="text-sm font-bold text-slate-900">Recent Orders</h3>
                        </div>
                        <a href="{{ route('user.orders.index') }}" class="text-xs font-semibold text-[#DA291C] hover:text-[#B91C1C] transition-colors">View All</a>
                    </div>
                    @if($orders->isNotEmpty())
                    <div class="divide-y divide-slate-100">
                        @foreach($orders as $order)
                        <a href="{{ route('user.orders.show', $order->id) }}" class="flex items-center justify-between px-5 py-3.5 hover:bg-slate-50 transition-colors">
                            <div>
                                <p class="text-sm font-semibold text-slate-900">{{ $order->order_number }}</p>
                                <p class="text-xs text-slate-500 mt-0.5">{{ $order->items->count() }} item(s) &middot; {{ $order->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="text-right">
                                <span class="badge
                                    @switch($order->status)
                                        @case('pending') bg-amber-100 text-amber-700 @break
                                        @case('paid') bg-blue-100 text-blue-700 @break
                                        @case('processing') bg-indigo-100 text-indigo-700 @break
                                        @case('shipped') bg-purple-100 text-purple-700 @break
                                        @case('delivered') bg-emerald-100 text-emerald-700 @break
                                        @case('cancelled') bg-red-100 text-red-700 @break
                                        @default bg-slate-100 text-slate-700
                                    @endswitch
                                ">{{ ucfirst($order->status) }}</span>
                                <p class="text-sm font-bold text-slate-900 mt-1">Rp {{ number_format($order->total_amount) }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @else
                    <div class="p-6 text-center">
                        <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                        </div>
                        <h4 class="text-sm font-semibold text-slate-900 mb-1">No orders yet</h4>
                        <p class="text-xs text-slate-500 mb-4 max-w-xs mx-auto">When you place orders, they will appear here. Start shopping to see your order history.</p>
                        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#DA291C] text-white text-xs font-bold hover:bg-[#B91C1C] transition-colors shadow-lg shadow-red-900/20">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/></svg>
                            Start Shopping
                        </a>
                    </div>
                    @endif
                </section>

                {{-- WISHLIST PREVIEW --}}
                <section class="rounded-xl bg-white border border-slate-200/60 shadow-sm overflow-hidden animate-fade-in-up delay-300">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-red-50 text-[#DA291C] flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg>
                            </div>
                            <h3 class="text-sm font-bold text-slate-900">Wishlist</h3>
                        </div>
                        <a href="{{ route('user.wishlists.index') }}" class="text-xs font-semibold text-[#DA291C] hover:text-[#B91C1C] transition-colors">View All</a>
                    </div>
                    @if($wishlists->isNotEmpty())
                    <div class="divide-y divide-slate-100">
                        @foreach($wishlists as $item)
                        <div class="flex items-center gap-3 px-5 py-3">
                            <div class="w-12 h-12 rounded-lg bg-slate-50 flex-shrink-0 overflow-hidden">
                                @if($item->product->images->first())
                                <img src="{{ asset('storage/' . $item->product->images->first()->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-contain">
                                @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                                </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-slate-900 truncate">{{ $item->product->name }}</p>
                                <p class="text-xs text-[#DA291C] font-semibold">Rp {{ number_format($item->product->variants->min('price') ?? 0) }}</p>
                            </div>
                            <form action="{{ route('user.wishlists.destroy', $item->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="button" onclick="confirmDelete(this)" class="p-1.5 rounded-lg text-slate-300 hover:text-red-500 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="p-6 text-center">
                        <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg>
                        </div>
                        <h4 class="text-sm font-semibold text-slate-900 mb-1">Your wishlist is empty</h4>
                        <p class="text-xs text-slate-500 mb-4 max-w-xs mx-auto">Save your favourite Manchester United merchandise here for quick access.</p>
                        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#DA291C] text-white text-xs font-bold hover:bg-[#B91C1C] transition-colors shadow-lg shadow-red-900/20">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                            Browse Products
                        </a>
                    </div>
                    @endif
                </section>
            </div>

            {{-- PROFILE + ADDRESS --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- PROFILE SUMMARY --}}
                <section class="rounded-xl bg-white border border-slate-200/60 shadow-sm overflow-hidden animate-fade-in-up delay-300">
                    <div class="flex items-center gap-3 px-5 py-4 border-b border-slate-100">
                        <div class="w-8 h-8 rounded-lg bg-red-50 text-[#DA291C] flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                        </div>
                        <h3 class="text-sm font-bold text-slate-900">Profile Summary</h3>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-4 mb-5">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-[#DA291C] to-[#991B1B] flex items-center justify-center text-white font-black text-xl shadow-lg shadow-red-900/20">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900">{{ $user->name }}</h4>
                                <p class="text-xs text-slate-500 mt-0.5">{{ $user->email }}</p>
                                @if($user->username)
                                <p class="text-xs text-slate-400">&#64;{{ $user->username }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 p-3 rounded-lg bg-slate-50">
                                <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                                <div>
                                    <p class="text-xs text-slate-500">Email</p>
                                    <p class="text-sm font-medium text-slate-900">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-3 rounded-lg bg-slate-50">
                                <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                                <div>
                                    <p class="text-xs text-slate-500">Phone</p>
                                    <p class="text-sm font-medium text-slate-900">{{ $defaultAddress->phone ?? '—' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- SHIPPING ADDRESS --}}
                <section class="rounded-xl bg-white border border-slate-200/60 shadow-sm overflow-hidden animate-fade-in-up delay-400">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-red-50 text-[#DA291C] flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                            </div>
                            <h3 class="text-sm font-bold text-slate-900">Shipping Address</h3>
                        </div>
                        <a href="{{ route('user.addresses.index') }}" class="text-xs font-semibold text-[#DA291C] hover:text-[#B91C1C] transition-colors">Manage</a>
                    </div>
                    <div class="p-5">
                        @if($defaultAddress)
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#DA291C] to-[#991B1B] flex items-center justify-center text-white flex-shrink-0 mt-0.5">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-slate-900 text-sm">{{ $defaultAddress->name }}</h4>
                                <p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $defaultAddress->address }}, {{ $defaultAddress->city }}, {{ $defaultAddress->province }} {{ $defaultAddress->postal_code }}</p>
                                <p class="text-xs text-slate-400 mt-1">{{ $defaultAddress->phone }}</p>
                                <a href="{{ route('user.addresses.edit', $defaultAddress->id) }}" class="inline-flex items-center gap-1.5 mt-3 px-3 py-1.5 rounded-full bg-red-50 text-[#DA291C] text-xs font-semibold hover:bg-red-100 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/></svg>
                                    Edit Address
                                </a>
                            </div>
                        </div>
                        @else
                        <div class="text-center py-6">
                            <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                            </div>
                            <h4 class="text-sm font-semibold text-slate-900 mb-1">No address added</h4>
                            <p class="text-xs text-slate-500 mb-4 max-w-xs mx-auto">Add a shipping address to proceed with checkout smoothly.</p>
                            <a href="{{ route('user.addresses.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#DA291C] text-white text-xs font-bold hover:bg-[#B91C1C] transition-colors shadow-lg shadow-red-900/20">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                Add Address
                            </a>
                        </div>
                        @endif
                    </div>
                </section>
            </div>

            {{-- FOOTER --}}
            <div class="text-center py-4 animate-fade-in-up delay-400">
                <p class="text-xs text-slate-400">&copy; {{ date('Y') }} Manchester United Store. All rights reserved.</p>
            </div>
        </main>
    </div>

    @include('partials.sweetalert')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(function (link) {
                link.addEventListener('click', function () {
                    navLinks.forEach(function (l) { l.classList.remove('active'); });
                    this.classList.add('active');
                    if (window.innerWidth < 1024) {
                        document.body.classList.remove('sidebar-open');
                    }
                });
            });
        });

        function confirmDelete(btn) {
            Swal.fire({
                title: 'Yakin hapus?',
                text: 'Produk ini akan dihapus dari wishlist Anda!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DA291C',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.closest('form').submit();
                }
            });
        }
    </script>
</body>
</html>
