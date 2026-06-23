@extends('admin.layouts.app')

@php $title = 'Dashboard'; @endphp

@section('content')
<div class="space-y-6">
    <div class="rounded-2xl bg-gradient-to-br from-[#DA291C] via-[#B91C1C] to-[#7F1D1D] p-6 text-white">
        <h2 class="text-2xl font-black">Welcome back, {{ $user->name }}!</h2>
        <p class="mt-2 text-white/70">Manage your Manchester United Store.</p>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="rounded-xl bg-white p-5 border shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-lg bg-red-50 text-[#DA291C] flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <span class="text-2xl font-black text-slate-900">{{ $totalProducts }}</span>
            </div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Total Products</p>
        </div>
        <div class="rounded-xl bg-white p-5 border shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                </div>
                <span class="text-2xl font-black text-slate-900">{{ $totalOrders }}</span>
            </div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Total Orders</p>
        </div>
        <div class="rounded-xl bg-white p-5 border shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/></svg>
                </div>
                <span class="text-2xl font-black text-slate-900">{{ $totalCustomers }}</span>
            </div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Total Customers</p>
        </div>
        <div class="rounded-xl bg-white p-5 border shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Z"/></svg>
                </div>
                <span class="text-2xl font-black text-slate-900">Rp {{ number_format($totalRevenue) }}</span>
            </div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Total Revenue</p>
        </div>
    </div>

    <div class="rounded-xl bg-white border shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b">
            <h3 class="text-sm font-bold text-slate-900">Recent Orders</h3>
            <a href="{{ route('admin.orders.index') }}" class="text-xs font-semibold text-[#DA291C]">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b bg-slate-50">
                        <th class="text-left px-5 py-3.5 font-semibold text-slate-600">Order</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-slate-600">Customer</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-slate-600">Total</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-slate-600">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-slate-900">
                    @forelse($recentOrders as $order)
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-4 font-semibold">#{{ $order->order_number }}</td>
                        <td class="px-5 py-4">{{ $order->user->name }}</td>
                        <td class="px-5 py-4 font-semibold">Rp {{ number_format($order->total_amount) }}</td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold
                                @switch($order->status)
                                    @case('pending') bg-amber-100 text-amber-700 @break
                                    @case('processing') bg-indigo-100 text-indigo-700 @break
                                    @case('shipped') bg-purple-100 text-purple-700 @break
                                    @case('delivered') bg-emerald-100 text-emerald-700 @break
                                    @case('cancelled') bg-red-100 text-red-700 @break
                                    @default bg-slate-100 text-slate-700
                                @endswitch
                            ">{{ ucfirst($order->status) }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-5 py-12 text-center text-slate-500">No orders yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
