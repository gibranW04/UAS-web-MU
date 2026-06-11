<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Manchester United Store</title>
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
        .nav-link { transition: all 0.2s ease; position: relative; }
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
        .nav-link.active::before { height: 60%; }
        .nav-link.active { background: rgba(218,41,28,0.1); color: #DA291C; }
        .nav-link.active svg { color: #DA291C; }
        .badge { display: inline-flex; align-items: center; padding: 2px 10px; border-radius: 9999px; font-size: 11px; font-weight: 600; letter-spacing: 0.025em; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in-up { animation: fadeInUp 0.6s ease forwards; }
    </style>
</head>
<body class="bg-[#f1f5f9] text-slate-800 antialiased">
    <div class="lg:pl-[280px] min-h-screen">
        @include('user.partials.sidebar')

        <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-xl border-b border-slate-200/60">
            <div class="flex items-center justify-between px-4 md:px-6 h-16">
                <div class="flex items-center gap-4">
                    <button onclick="document.body.classList.toggle('sidebar-open')" class="lg:hidden p-2 -ml-2 rounded-lg hover:bg-slate-100 transition-colors">
                        <svg class="w-5 h-5 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                    </button>
                    <div>
                        <h1 class="text-base font-bold text-slate-900">My Orders</h1>
                        <p class="text-xs text-slate-500">{{ now()->format('l, d F Y') }}</p>
                    </div>
                </div>
                <a href="{{ url('/') }}" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                    Homepage
                </a>
            </div>
        </header>

        <main class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
            @forelse($orders as $order)
                <div class="rounded-xl bg-white border border-slate-200/60 shadow-sm overflow-hidden animate-fade-in-up">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100 bg-slate-50/50">
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-bold text-slate-900">{{ $order->order_number }}</span>
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
                            <span class="badge
                                @if($order->payment_status === 'success') bg-emerald-100 text-emerald-700
                                @elseif($order->payment_status === 'pending') bg-amber-100 text-amber-700
                                @else bg-red-100 text-red-700
                                @endif
                            ">Payment: {{ ucfirst($order->payment_status) }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-bold text-slate-900">Rp {{ number_format($order->total_amount) }}</span>
                            <a href="{{ route('user.orders.show', $order->id) }}" class="text-xs font-semibold text-[#DA291C] hover:text-[#B91C1C] transition-colors">Detail</a>
                        </div>
                    </div>
                    <div class="px-5 py-4">
                        <div class="space-y-2">
                            @foreach($order->items as $item)
                                <div class="flex items-center justify-between text-sm">
                                    <div>
                                        <span class="font-medium text-slate-900">{{ $item->product_name }}</span>
                                        @if($item->variant_label)
                                            <span class="text-slate-400 ml-2">({{ $item->variant_label }})</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-4 text-slate-600">
                                        <span>{{ $item->qty }}x</span>
                                        <span>Rp {{ number_format($item->price) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="px-5 py-3 border-t border-slate-100 bg-slate-50/50 text-xs text-slate-400">
                        {{ $order->created_at->format('d M Y H:i') }}
                    </div>
                </div>
            @empty
                <div class="rounded-xl bg-white border border-slate-200/60 shadow-sm p-12 text-center animate-fade-in-up">
                    <div class="w-20 h-20 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-5">
                        <svg class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">No orders yet</h3>
                    <p class="text-sm text-slate-500 mb-6 max-w-md mx-auto">You haven't placed any orders yet. Start shopping to see your order history here.</p>
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#DA291C] text-white text-sm font-bold hover:bg-[#B91C1C] transition-colors shadow-lg shadow-red-900/20">
                        Start Shopping
                    </a>
                </div>
            @endforelse

            <div class="text-center py-4">
                <p class="text-xs text-slate-400">&copy; {{ date('Y') }} Manchester United Store. All rights reserved.</p>
            </div>
        </main>
    </div>

    @include('partials.sweetalert')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var navLinks = document.querySelectorAll('.nav-link');
            var currentPath = window.location.pathname;
            navLinks.forEach(function (link) {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
                link.addEventListener('click', function () {
                    navLinks.forEach(function (l) { l.classList.remove('active'); });
                    this.classList.add('active');
                    if (window.innerWidth < 1024) {
                        document.body.classList.remove('sidebar-open');
                    }
                });
            });
        });
    </script>
</body>
</html>
