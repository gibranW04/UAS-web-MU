<header class="bg-gradient-to-r from-red-900 via-black to-red-900/90 backdrop-blur border-b border-red-700/40 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <img src="/images/image.png" alt="Manchester United Logo" class="h-12 w-12 border border-red-600 shadow-md bg-white/90 object-contain transition group-hover:scale-105 p-0.5">
                <span class="text-2xl md:text-3xl font-extrabold text-white tracking-wide drop-shadow-lg">
                    Manchester United Store
                </span>
            </a>

            {{-- Navigation (Desktop) --}}
            <nav class="hidden md:flex items-center gap-6">
                <a href="{{ route('home') }}"
                   class="text-white/90 hover:text-yellow-400 font-semibold transition text-lg">
                    Home
                </a>
            </nav>

            {{-- Right Section --}}
            <div class="flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="hidden md:inline-flex rounded-full bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-yellow-400 hover:text-black transition shadow-md">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="hidden md:inline-flex rounded-full border border-yellow-400 px-4 py-2 text-sm font-semibold text-yellow-300 hover:bg-yellow-400 hover:text-black transition shadow-md">
                        Register
                    </a>
                @endguest

                @auth
                    @php
                        $dashboardRoute = auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('user.dashboard');
                    @endphp
                    <a href="{{ $dashboardRoute }}" class="hidden md:inline-flex rounded-full bg-yellow-400 px-4 py-2 text-sm font-bold text-black hover:bg-yellow-300 transition shadow-md">
                        Dashboard
                    </a>
                @endauth

                {{-- Cart --}}
                <a href="{{ route('cart.index') }}"
                   class="relative text-white hover:text-yellow-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.293 2.293A1 1 0 007.618 17H17m0 0a2 2 0 100 4 2 2 0 000-4zm-10 2a2 2 0 100 4 2 2 0 000-4z" />
                    </svg>

                    @php
                        $cartCount = session('cart')
                            ? collect(session('cart'))->sum('qty')
                            : 0;
                    @endphp

                    @if ($cartCount > 0)
                        <span
                            class="absolute -top-2 -right-2 bg-yellow-400 text-black text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center shadow">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                {{-- Mobile Menu Button --}}
                <button class="md:hidden text-white focus:outline-none"
                        onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobileMenu" class="hidden md:hidden pb-4 space-y-2">
            <a href="{{ route('home') }}"
               class="block py-2 text-white hover:text-yellow-400 font-semibold">
                Home
            </a>
            @guest
                <a href="{{ route('login') }}" class="block py-2 text-white hover:text-yellow-400">Login</a>
                <a href="{{ route('register') }}" class="block py-2 text-white hover:text-yellow-400">Register</a>
            @endguest
            @auth
                <a href="{{ $dashboardRoute ?? route('user.dashboard') }}" class="block py-2 text-white hover:text-yellow-400">Dashboard</a>
            @endauth
        </div>
    </div>
</header>
