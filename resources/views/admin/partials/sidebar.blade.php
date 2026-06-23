<aside id="sidebar" class="fixed top-0 left-0 z-50 h-full w-[280px] -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-out bg-[#0a0a0a] border-r border-white/5 flex flex-col">
    <div class="p-6 border-b border-white/5">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#DA291C] to-[#991B1B] flex items-center justify-center text-white font-black text-sm shadow-lg shadow-red-900/30">MU</div>
            <div>
                <h2 class="text-white font-bold text-sm leading-tight">Manchester United</h2>
                <p class="text-white/40 text-xs mt-0.5">Admin Panel</p>
            </div>
        </div>
    </div>

    <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">
        <p class="px-3 text-[10px] font-semibold uppercase tracking-[0.2em] text-white/20 mb-2">Menu</p>

        <a href="{{ route('admin.dashboard') }}" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-white/60 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i data-lucide="layout-dashboard" class="w-5 h-5 flex-shrink-0"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.products.index') }}" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-white/60 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <i data-lucide="package" class="w-5 h-5 flex-shrink-0"></i>
            <span>Products</span>
        </a>
        <a href="{{ route('admin.categories.index') }}" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-white/60 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i data-lucide="layers" class="w-5 h-5 flex-shrink-0"></i>
            <span>Categories</span>
        </a>
        <a href="{{ route('admin.orders.index') }}" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-white/60 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
            <i data-lucide="shopping-cart" class="w-5 h-5 flex-shrink-0"></i>
            <span>Orders</span>
        </a>
        <a href="{{ route('admin.customers.index') }}" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-white/60 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
            <i data-lucide="users" class="w-5 h-5 flex-shrink-0"></i>
            <span>Customers</span>
        </a>
        <a href="{{ route('admin.reviews.index') }}" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-white/60 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
            <i data-lucide="star" class="w-5 h-5 flex-shrink-0"></i>
            <span>Reviews</span>
        </a>

        <div class="border-t border-white/5 my-3"></div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-all">
                <i data-lucide="log-out" class="w-5 h-5 flex-shrink-0"></i>
                <span>Logout</span>
            </button>
        </form>
    </nav>

    <div class="p-4 border-t border-white/5">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-[#DA291C] to-[#991B1B] flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-red-900/20">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-white text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                <p class="text-white/40 text-xs truncate">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </div>
</aside>
