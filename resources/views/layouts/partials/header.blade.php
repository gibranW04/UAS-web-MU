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
                {{-- Search --}}
                <div class="relative" id="searchContainer">
                    <button onclick="toggleSearch()" class="text-white hover:text-yellow-400 transition" id="searchIconBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                    <div id="searchBar" class="hidden absolute right-0 top-full mt-2 w-72">
                        <form action="{{ route('home') }}" method="GET" class="flex items-center bg-gray-900 border border-red-400/30 rounded-full overflow-hidden shadow-xl">
                            <input
                                type="text"
                                name="search"
                                placeholder="Cari produk..."
                                value="{{ request('search') }}"
                                class="w-full bg-transparent text-white px-4 py-2.5 text-sm focus:outline-none placeholder-gray-400"
                                id="searchInput"
                            >
                            <button type="submit" class="px-4 py-2.5 text-yellow-400 hover:text-yellow-300 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- User Icon + Dropdown --}}
                <div class="relative" id="userDropdown">
                    <button onclick="toggleUserDropdown()" class="text-white hover:text-yellow-400 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </button>
                    <div id="userDropdownMenu" class="hidden absolute right-0 top-full mt-3 w-64 bg-white rounded-2xl shadow-2xl border border-gray-200">
                        @guest
                            <div class="p-5">
                                <a href="{{ route('login') }}" class="block w-full text-center rounded-full bg-red-600 px-4 py-3 text-sm font-bold text-white hover:bg-red-700 transition shadow-md">
                                    LOG IN
                                </a>
                                <p class="mt-4 text-center text-sm text-gray-600">
                                    Don't have an account?
                                    <a href="{{ route('register') }}" class="text-red-600 font-semibold hover:text-red-700">Sign Up</a>
                                </p>
                            </div>
                        @endguest
                        @auth
                            @php
                                $dashboardRoute = auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('user.dashboard');
                            @endphp
                            <div class="p-3">
                                <a href="{{ $dashboardRoute }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-100 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                    Dashboard
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-3 w-full rounded-xl px-4 py-3 text-sm font-semibold text-red-600 hover:bg-red-50 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        @endauth
                    </div>
                </div>

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
            <form action="{{ route('home') }}" method="GET" class="flex items-center bg-gray-800 border border-gray-700 rounded-lg overflow-hidden">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari produk..."
                    value="{{ request('search') }}"
                    class="w-full bg-transparent text-white px-3 py-2 text-sm focus:outline-none placeholder-gray-400"
                >
                <button type="submit" class="px-3 py-2 text-yellow-400 hover:text-yellow-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </form>
            @guest
                <a href="{{ route('login') }}" class="flex items-center gap-2 py-2 text-white hover:text-yellow-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Login
                </a>
            @endguest
            @auth
                @php
                    $mobileRoute = auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('user.dashboard');
                @endphp
                <a href="{{ $mobileRoute }}" class="flex items-center gap-2 py-2 text-white hover:text-yellow-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 w-full text-left py-2 text-white hover:text-yellow-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>
</header>

<script>
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHeader);
} else {
    initHeader();
}

function initHeader() {
    const searchBtn = document.getElementById('searchIconBtn');
    const userBtn = document.querySelectorAll('[onclick*="toggleUserDropdown"]')[0];
    const mobileBtn = document.querySelectorAll('[onclick*="toggle"]').length > 0;

    if (searchBtn) {
        searchBtn.addEventListener('click', toggleSearch);
    }
    if (userBtn) {
        userBtn.addEventListener('click', toggleUserDropdown);
    }
    if (mobileBtn) {
        document.addEventListener('click', closeDropdowns);
    }
}

function toggleSearch(e) {
    e.stopPropagation();
    const bar = document.getElementById('searchBar');
    if (bar) {
        bar.classList.toggle('hidden');
        if (!bar.classList.contains('hidden')) {
            const input = document.getElementById('searchInput');
            if (input) input.focus();
        }
    }
}

function toggleUserDropdown(e) {
    e.stopPropagation();
    const menu = document.getElementById('userDropdownMenu');
    if (menu) menu.classList.toggle('hidden');
}

function closeDropdowns(e) {
    const searchContainer = document.getElementById('searchContainer');
    const userDropdown = document.getElementById('userDropdown');

    if (searchContainer && !searchContainer.contains(e.target)) {
        const bar = document.getElementById('searchBar');
        if (bar) bar.classList.add('hidden');
    }
    if (userDropdown && !userDropdown.contains(e.target)) {
        const menu = document.getElementById('userDropdownMenu');
        if (menu) menu.classList.add('hidden');
    }
}
</script>
