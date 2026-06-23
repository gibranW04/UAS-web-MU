@php
    $steps = [
        'pending'    => ['label' => 'Dipesan',    'icon' => 'M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z'],
        'paid'       => ['label' => 'Dibayar',    'icon' => 'M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z'],
        'processing' => ['label' => 'Diproses',   'icon' => 'M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.063-.374-.313-.686-.645-.87a6.47 6.47 0 0 1-.22-.127c-.325-.196-.72-.257-1.075-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z'],
        'shipped'    => ['label' => 'Dikirim',    'icon' => 'M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12'],
        'delivered'  => ['label' => 'Selesai',    'icon' => 'M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'],
    ];

    $orderStatus = $order->status;
    $statusOrder = array_keys($steps);
    $currentIndex = array_search($orderStatus, $statusOrder);
    if ($currentIndex === false) $currentIndex = -1;
@endphp

<div class="w-full">
    <div class="flex items-start justify-between">
        @foreach($steps as $key => $step)
            @php
                $stepIndex = array_search($key, $statusOrder);
                $isCompleted = $stepIndex < $currentIndex;
                $isCurrent = $stepIndex === $currentIndex;
                $isCancelled = $orderStatus === 'cancelled';
                $stepDate = $order->{$key . '_at'};
            @endphp
            <div class="flex flex-col items-center flex-1 relative">
                {{-- Connector line --}}
                @if(!$loop->first)
                    <div class="absolute top-5 right-1/2 w-full h-0.5 -translate-y-1/2
                        {{ ($isCompleted || ($isCurrent && !$isCancelled)) && !$loop->first
                            ? 'bg-emerald-500'
                            : ($isCancelled ? 'bg-red-300' : 'bg-slate-200') }}">
                    </div>
                @endif

                {{-- Circle --}}
                <div class="relative z-10 w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold
                    {{ $isCancelled && $isCurrent
                        ? 'bg-red-500 text-white'
                        : ($isCompleted || ($isCurrent && $key !== 'delivered')
                            ? ($isCurrent && $key !== 'delivered' ? 'bg-[#DA291C] text-white ring-4 ring-red-100' : 'bg-emerald-500 text-white')
                            : ($isCurrent
                                ? 'bg-emerald-500 text-white'
                                : 'bg-slate-100 text-slate-400')) }}">
                    @if($isCompleted || ($isCurrent && $key === 'delivered'))
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                        </svg>
                    @elseif($isCancelled && $isCurrent)
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                        </svg>
                    @else
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}"/>
                        </svg>
                    @endif
                </div>

                {{-- Label --}}
                <p class="mt-2 text-xs font-semibold text-center
                    {{ $isCancelled && $isCurrent ? 'text-red-500' : ($isCompleted || $isCurrent ? 'text-slate-900' : 'text-slate-400') }}">
                    {{ $step['label'] }}
                </p>
                @if($stepDate)
                    <p class="text-[10px] text-slate-400 text-center mt-0.5">{{ $stepDate->format('d M H:i') }}</p>
                @endif
            </div>
        @endforeach
    </div>
</div>
