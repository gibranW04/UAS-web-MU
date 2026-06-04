@extends('layouts.app')

@section('title', 'Manchester United Store')

@section('content')
<div class="min-h-screen bg-[linear-gradient(135deg,#040404_0%,#120202_35%,#2b0505_65%,#040404_100%)] text-white">
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.10),_transparent_25%),radial-gradient(circle_at_right,_rgba(220,38,38,0.16),_transparent_20%),linear-gradient(135deg,#080808_0%,#170303_45%,#050505_100%)]"></div>
        <div class="absolute inset-0 opacity-30" style="background-image: linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="relative max-w-7xl mx-auto px-4 py-10 md:py-16">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-10">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center rounded-full border border-red-400/40 bg-red-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-red-200">
                        Manchester United Official Store
                    </span>
                    <h1 class="mt-5 text-4xl md:text-6xl font-extrabold leading-tight">
                        Jersey, merchandise, dan koleksi resmi <span class="text-red-400">The Red Devils</span>
                    </h1>
                    <p class="mt-5 text-lg text-gray-200 max-w-xl">
                        Temukan produk terbaru MU dengan kualitas resmi, desain premium, dan pengalaman belanja yang mudah.
                    </p>

                    <div class="mt-8 flex flex-wrap items-center gap-3">
                        @guest
                            <a href="{{ route('login') }}" class="rounded-full bg-red-500 px-5 py-3 text-sm font-bold text-white hover:bg-red-600 transition">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="rounded-full border border-white/30 px-5 py-3 text-sm font-bold text-white hover:bg-white/10 transition">
                                Register
                            </a>
                        @endguest

                        @auth
                            @php
                                $dashboardRoute = auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('user.dashboard');
                            @endphp
                            <a href="{{ $dashboardRoute }}" class="rounded-full bg-yellow-400 px-5 py-3 text-sm font-bold text-black hover:bg-yellow-300 transition">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="rounded-full border border-white/30 px-5 py-3 text-sm font-bold text-white hover:bg-white/10 transition">
                                    Logout
                                </button>
                            </form>
                        @endauth
                    </div>

                    <div class="mt-8 grid grid-cols-3 gap-3 max-w-md">
                        <div class="rounded-2xl border border-red-400/20 bg-black/35 px-4 py-3 shadow-[0_8px_25px_rgba(127,29,29,0.18)] backdrop-blur-md">
                            <p class="text-2xl font-bold text-white">100+</p>
                            <p class="text-xs text-gray-300">Produk resmi</p>
                        </div>
                        <div class="rounded-2xl border border-red-400/20 bg-black/35 px-4 py-3 shadow-[0_8px_25px_rgba(127,29,29,0.18)] backdrop-blur-md">
                            <p class="text-2xl font-bold text-white">24/7</p>
                            <p class="text-xs text-gray-300">Layanan pelanggan</p>
                        </div>
                        <div class="rounded-2xl border border-red-400/20 bg-black/35 px-4 py-3 shadow-[0_8px_25px_rgba(127,29,29,0.18)] backdrop-blur-md">
                            <p class="text-2xl font-bold text-white">4.9/5</p>
                            <p class="text-xs text-gray-300">Kepuasan fans</p>
                        </div>
                    </div>
                </div>

                <div class="w-full max-w-xl rounded-3xl border border-red-400/30 bg-black/30 p-4 shadow-[0_20px_60px_rgba(0,0,0,0.45)] backdrop-blur-xl">
                    <div class="grid grid-cols-2 gap-3">
                        <div class="rounded-2xl bg-gradient-to-br from-red-900 via-black to-red-950 p-3 text-white shadow-[0_12px_35px_rgba(127,29,29,0.25)]">
                            <img src="https://www.softfootball.com/wp-content/uploads/2026/01/Matheus-Cunha1.jpg">
                            <p class="mt-3 text-sm font-semibold text-center">Cunha Selebration</p>
                        </div>
                        <div class="rounded-2xl bg-gradient-to-br from-red-900 via-black to-red-950 p-3 text-white shadow-[0_12px_35px_rgba(127,29,29,0.25)]">
                            <img src="https://tse4.mm.bing.net/th/id/OIP.3TmfK-HGfK7lwIIAtrp1_gHaE9?cb=thfvnextfalcon&rs=1&pid=ImgDetMain&o=7&rm=3">
                            <p class="mt-3 text-sm font-semibold text-center">We Are UNITED</p>
                        </div>
                        <div class="rounded-2xl bg-gradient-to-br from-red-900 via-black to-red-950 p-3 text-white col-span-2 shadow-[0_12px_35px_rgba(127,29,29,0.25)]">
                            <img src="https://wallpaperaccess.com/full/9136504.jpg">
                            <p class="mt-3 text-sm font-semibold text-center">Legendary Stadium</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h2 class="text-3xl font-bold text-white">
                    Produk Terbaru
                </h2>
                <p class="text-gray-300 mt-1">
                    Populer, fresh, dan siap dibawa pulang
                </p>
            </div>

            <form method="GET">
                <select
                    name="category"
                    onchange="this.form.submit()"
                    class="border border-gray-700 rounded-lg px-4 py-2 bg-gray-900 text-gray-100 focus:ring-2 focus:ring-red-500 focus:outline-none"
                >
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->slug }}"
                            {{ request('category') == $category->slug ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        @if ($products->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    @php
                        $imagePath = $product->images->first()?->image;
                        $fallbackImage = 'https://images.pexels.com/photos/3617696/pexels-photo-3617696.jpeg?auto=compress&cs=tinysrgb&w=800';
                    @endphp
                    <a href="{{ route('product.show', $product->slug) }}"
                       class="group border border-red-400/10 rounded-xl overflow-hidden bg-gradient-to-b from-gray-950 to-black shadow-[0_16px_40px_rgba(0,0,0,0.35)] hover:border-red-400/30 hover:shadow-[0_18px_45px_rgba(127,29,29,0.25)] transition duration-300">
                        <div class="h-48 bg-gray-800 overflow-hidden">
                            <img
                                src="{{ $imagePath ? asset('storage/' . $imagePath) : $fallbackImage }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                            >
                        </div>

                        <div class="p-4">
                            <p class="text-sm text-red-300 font-medium">
                                {{ $product->category->name ?? 'Kategori' }}
                            </p>

                            <h3 class="text-lg font-semibold text-white mt-1 line-clamp-2">
                                {{ $product->name }}
                            </h3>

                            <p class="text-sm text-gray-300 mt-1">
                                Mulai dari
                            </p>

                            <p class="text-lg font-bold text-red-300">
                                @php
                                    $minPrice = $product->variants->min('price');
                                @endphp
                                Rp {{ number_format($minPrice ? (float)$minPrice : 0) }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $products->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-gray-300 text-lg">
                    Produk belum tersedia
                </p>
            </div>
        @endif
    </div>

    <footer class="border-t border-red-400/10 bg-[linear-gradient(180deg,#070707_0%,#130202_100%)]">
        <div class="max-w-7xl mx-auto px-4 py-10 text-sm text-gray-300">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <p class="font-semibold text-white text-base">Manchester United Store</p>
                    <p class="mt-2 text-gray-400">Official merchandise & koleksi resmi The Red Devils.</p>
                </div>
                <div>
                    <p class="font-semibold text-white text-base">Tautan</p>
                    <ul class="mt-2 space-y-2">
                        <li><a href="{{ route('home') }}" class="hover:text-red-300">Home</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-red-300">Login</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-red-300">Register</a></li>
                    </ul>
                </div>
                <div>
                    <p class="font-semibold text-white text-base">Kontak</p>
                    <ul class="mt-2 space-y-2 text-gray-400">
                        <li>Email: support@manchesterunitedstore.com</li>
                        <li>WhatsApp: +62 812-3456-7890</li>
                        <li>Alamat: Jakarta, Indonesia</li>
                    </ul>
                    <div class="mt-4 flex gap-3 text-gray-300">
                        <a href="https://instagram.com" target="_blank" rel="noopener" class="hover:text-red-300">Instagram</a>
                        <a href="https://facebook.com" target="_blank" rel="noopener" class="hover:text-red-300">Facebook</a>
                        <a href="https://x.com" target="_blank" rel="noopener" class="hover:text-red-300">X / Twitter</a>
                    </div>
                </div>
            </div>
            <div class="mt-8 border-t border-white/10 pt-4 text-gray-400 text-xs">
                © 2026 Manchester United Store. Semua hak dilindungi.
            </div>
        </div>
    </footer>
</div>
@endsection
