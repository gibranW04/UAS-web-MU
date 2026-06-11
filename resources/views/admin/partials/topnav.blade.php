<header class="sticky top-0 z-30 bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl border-b border-slate-200/60 dark:border-gray-800">
    <div class="flex items-center justify-between px-4 md:px-6 h-16">
        <div class="flex items-center gap-4">
            <button onclick="toggleSidebar()" class="lg:hidden p-2 -ml-2 rounded-lg hover:bg-slate-100 dark:hover:bg-gray-800 transition-colors">
                <i data-lucide="menu" class="w-5 h-5 text-slate-700 dark:text-slate-300"></i>
            </button>
            <div>
                <h1 class="text-base font-bold text-slate-900 dark:text-white">{{ $title ?? 'Dashboard' }}</h1>
                <p class="text-xs text-slate-500 dark:text-slate-400">{{ now()->format('l, d F Y') }}</p>
            </div>
        </div>
        <div class="flex items-center gap-2 md:gap-3">
            <button onclick="toggleDarkMode()" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-gray-800 transition-colors" title="Toggle dark mode">
                <i data-lucide="moon" class="w-5 h-5 text-slate-600 dark:text-slate-300 dark-mode-icon"></i>
            </button>
            <a href="{{ url('/') }}" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-semibold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-gray-800 hover:bg-slate-200 dark:hover:bg-gray-700 transition-colors">
                <i data-lucide="home" class="w-4 h-4"></i>
                Homepage
            </a>
            <form method="POST" action="{{ route('logout') }}" class="hidden sm:block">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-semibold text-white bg-[#DA291C] hover:bg-[#B91C1C] transition-colors shadow-lg shadow-red-900/20">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>

<script>
    function toggleDarkMode() {
        const isDark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('darkMode', isDark);
        const icons = document.querySelectorAll('.dark-mode-icon');
        icons.forEach(function(icon) {
            icon.setAttribute('data-lucide', isDark ? 'sun' : 'moon');
        });
        if (window.lucideCreateIcons) window.lucideCreateIcons();
    }

    function toggleSidebar() {
        document.body.classList.toggle('sidebar-open');
    }
</script>
