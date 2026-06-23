<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist - Manchester United Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
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
                        <h1 class="text-base font-bold text-slate-900">Wishlist</h1>
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
            @if($wishlists->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach($wishlists as $wishlist)
                        <div class="rounded-xl bg-white border border-slate-200/60 shadow-sm overflow-hidden animate-fade-in-up group">
                            <div class="aspect-square bg-slate-50 flex items-center justify-center p-6">
                                @if($wishlist->product->images->first())
                                    <img src="{{ asset('storage/' . $wishlist->product->images->first()->image) }}" alt="{{ $wishlist->product->name }}" class="w-full h-full object-contain">
                                @else
                                    <svg class="w-16 h-16 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-slate-900 text-sm truncate">{{ $wishlist->product->name }}</h3>
                                <p class="text-sm font-semibold text-[#DA291C] mt-1">
                                    Rp {{ number_format($wishlist->product->variants->min('price') ?? 0) }}
                                </p>
                                <div class="flex items-center gap-2 mt-3">
                                    <a href="{{ route('product.show', $wishlist->product->slug) }}" class="flex-1 text-center px-3 py-2 rounded-lg bg-[#DA291C] text-white text-xs font-bold hover:bg-[#B91C1C] transition-colors">
                                        View Product
                                    </a>
                                    <form action="{{ route('user.wishlists.destroy', $wishlist->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="button" onclick="confirmDelete(this)" class="p-2 rounded-lg text-slate-400 hover:text-red-500 hover:bg-red-50 transition-colors">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="rounded-xl bg-white border border-slate-200/60 shadow-sm p-12 text-center animate-fade-in-up">
                    <div class="w-20 h-20 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-5">
                        <svg class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Your wishlist is empty</h3>
                    <p class="text-sm text-slate-500 mb-6 max-w-md mx-auto">Save your favourite Manchester United merchandise here for quick access.</p>
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#DA291C] text-white text-sm font-bold hover:bg-[#B91C1C] transition-colors shadow-lg shadow-red-900/20">
                        Browse Products
                    </a>
                </div>
            @endif

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
