<!DOCTYPE html>
<html lang="id" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->order_number }} - Admin Manchester United Store</title>
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
            @include('admin.partials.topnav', ['title' => 'Order #'.$order->order_number])

            <main class="p-4 md:p-6 lg:p-8 max-w-5xl mx-auto space-y-6">
                <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 hover:text-[#DA291C] transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Back to Orders
                </a>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 space-y-6">
                        <div class="rounded-xl bg-white dark:bg-gray-900 border border-slate-200 dark:border-gray-800 shadow-sm p-6">
                            <h3 class="font-bold text-slate-900 dark:text-white mb-4">Order Items</h3>
                            <div class="divide-y divide-slate-100 dark:divide-gray-800">
                                @foreach($order->items as $item)
                                <div class="flex items-center gap-4 py-3">
                                    <div class="w-14 h-14 rounded-lg bg-slate-50 dark:bg-gray-800 flex-shrink-0 overflow-hidden">
                                        @if($item->variant && $item->variant->product && $item->variant->product->images->first())
                                        <img src="{{ $item->variant->product->images->first()->image }}" alt="{{ $item->product_name }}" class="w-full h-full object-contain">
                                        @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300 dark:text-slate-600">
                                            <i data-lucide="box" class="w-6 h-6"></i>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-sm text-slate-900 dark:text-white truncate">{{ $item->product_name }}</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">{{ $item->variant_label }} &times; {{ $item->qty }}</p>
                                    </div>
                                    <p class="font-semibold text-sm text-slate-900 dark:text-white">Rp {{ number_format($item->subtotal) }}</p>
                                </div>
                                @endforeach
                            </div>
                            <div class="border-t border-slate-100 dark:border-gray-800 pt-4 mt-2 flex justify-between items-center">
                                <span class="font-bold text-slate-900 dark:text-white">Total</span>
                                <span class="font-bold text-lg text-[#DA291C]">Rp {{ number_format($order->total_amount) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="rounded-xl bg-white dark:bg-gray-900 border border-slate-200 dark:border-gray-800 shadow-sm p-6">
                            <h3 class="font-bold text-slate-900 dark:text-white mb-4">Order Details</h3>
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-slate-500 dark:text-slate-400">Status</span>
                                    @php $colors = ['pending' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400', 'processing' => 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400', 'shipped' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400', 'delivered' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400', 'cancelled' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400']; @endphp
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $colors[$order->status] ?? 'bg-slate-100 text-slate-700' }}">{{ ucfirst($order->status) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500 dark:text-slate-400">Payment</span>
                                    <span class="font-medium">{{ ucfirst($order->payment_type ?? '-') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500 dark:text-slate-400">Payment Status</span>
                                    <span class="font-medium">{{ ucfirst($order->payment_status ?? '-') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500 dark:text-slate-400">Date</span>
                                    <span class="font-medium">{{ $order->created_at->format('d M Y H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-xl bg-white dark:bg-gray-900 border border-slate-200 dark:border-gray-800 shadow-sm p-6">
                            <h3 class="font-bold text-slate-900 dark:text-white mb-4">Customer</h3>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#DA291C] to-[#991B1B] flex items-center justify-center text-white font-bold text-sm">
                                    {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-sm text-slate-900 dark:text-white">{{ $order->user->name }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $order->user->email }}</p>
                                </div>
                            </div>
                        </div>

                        @if($order->shippingAddress)
                        <div class="rounded-xl bg-white dark:bg-gray-900 border border-slate-200 dark:border-gray-800 shadow-sm p-6">
                            <h3 class="font-bold text-slate-900 dark:text-white mb-4">Shipping Address</h3>
                            <div class="text-sm text-slate-600 dark:text-slate-300 space-y-1">
                                <p class="font-semibold">{{ $order->shippingAddress->name }}</p>
                                <p>{{ $order->shippingAddress->phone }}</p>
                                <p>{{ $order->shippingAddress->address }}</p>
                                <p>{{ $order->shippingAddress->city }}, {{ $order->shippingAddress->province }} {{ $order->shippingAddress->postal_code }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
