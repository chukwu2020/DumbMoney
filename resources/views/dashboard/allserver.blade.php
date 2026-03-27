@extends('layout.user')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-2 mb-6 p-6">
    <h6 class="font-semibold mb-0" style="color: #0c3a30;">Active Servers</h6>
    <ul class="flex items-center gap-[6px]">
        <li class="font-medium">
            <a href="{{ route('user_dashboard') }}"
                class="flex items-center gap-2 text-[#0C3A30] hover-text"
                onmouseover="this.style.color='#9EDD05';"
                onmouseout="this.style.color='#0C3A30';">
                <iconify-icon icon="solar:home-smile-angle-outline" style="color: #0c3a30;" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li class="text-[#0C3A30]">-</li>
        <li class="font-medium text-[#0C3A30]">Servers</li>
    </ul>
</div>

<div class="max-w-5xl mx-auto mt-8" style="background-image: url(assets/images/hero/hero-image-1.svg);">

    @if($feeds->count() > 0)

    <div class="rounded-2xl shadow-xl overflow-hidden border border-emerald-200"
         style="border-top: 4px solid #8bc905;">

        <div class="p-6 bg-white/80 backdrop-blur-md rounded-2xl">

            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h4 class="text-sm font-semibold text-[#0C3A30]">
                        ALL SERVERS
                    </h4>
                    <p class="text-xs text-gray-500 mt-1">
                        Complete list of available trading servers
                    </p>
                </div>

                <div class="p-3 bg-[#9EDD05]/10 rounded-xl text-[#9EDD05]">
                    <i class="fa-solid fa-server text-lg"></i>
                </div>
            </div>

            <!-- Server List -->
            <div class="space-y-4">

                @foreach($feeds as $feed)
                @php
                    $winRate = $feed->win_rate ?? 0;
                    $profitMargin = $feed->profit_margin ?? 0;
                    
                    // Win rate class and colors
                    $winRateClass = 'low';
                    $winRateBg = '#fee2e2';
                    $winRateColor = '#b91c1c';
                    if ($winRate >= 70) {
                        $winRateClass = 'high';
                        $winRateBg = '#dcfce7';
                        $winRateColor = '#166534';
                    } elseif ($winRate >= 50) {
                        $winRateClass = 'medium';
                        $winRateBg = '#fef9c3';
                        $winRateColor = '#a16207';
                    }
                    
                    // Profit class and colors
                    $profitClass = $profitMargin >= 0 ? 'positive' : 'negative';
                    $profitBg = $profitMargin >= 0 ? '#dcfce7' : '#fee2e2';
                    $profitColor = $profitMargin >= 0 ? '#166534' : '#b91c1c';
                @endphp

                <div class="p-5 bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition">

                    <div class="grid md:grid-cols-2 gap-6">

                        <!-- SERVER SECTION -->
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0">
                                @if($feed->server_profile_image)
                                <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-[#8bc905] flex items-center justify-center">
                                    <img src="{{ asset('storage/servers/'.$feed->server_profile_image) }}"
                                         class="min-w-full min-h-full object-cover object-center">
                                </div>
                                @else
                                <div class="w-12 h-12 rounded-full flex items-center justify-center bg-[#9EDD05] text-[#0C3A30] border-2 border-[#8bc905]">
                                    <i class="fa-solid fa-server text-lg"></i>
                                </div>
                                @endif
                            </div>

                            <div>
                                <h5 class="text-base font-semibold text-[#0C3A30]">
                                    {{ $feed->server_name }}
                                </h5>
                                <p class="text-sm text-gray-500 mt-1">
                                    <i class="fa-solid fa-users mr-1"></i>
                                    Active Members: {{ number_format($feed->active_members) }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    <i class="fa-solid fa-copy mr-1"></i>
                                    {{ number_format($feed->copying_trades ?? 0) }} Copying Trades
                                </p>
                            </div>
                        </div>

                        <!-- ADMIN SECTION -->
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0">
                                @if($feed->admin_profile_image)
                                <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-[#8bc905] flex items-center justify-center">
                                    <img src="{{ asset('storage/admins/'.$feed->admin_profile_image) }}"
                                         class="min-w-full min-h-full object-cover object-center">
                                </div>
                                @else
                                <div class="w-12 h-12 rounded-full flex items-center justify-center bg-[#9EDD05] text-[#0C3A30] border-2 border-[#8bc905]">
                                    <i class="fa-solid fa-user text-lg"></i>
                                </div>
                                @endif
                            </div>

                            <div class="flex-1">
                                <h5 class="text-base font-semibold text-[#0C3A30]">
                                    {{ $feed->admin_name }}
                                </h5>
                                <p class="text-sm text-gray-500 mt-1">
                                    <i class="fa-solid fa-badge-check mr-1"></i>
                                    Server Admin
                                </p>
                                
                                <!-- Stats Row - Profit and Win Rate Badges -->
                                <div class="flex flex-wrap gap-2 mt-2">
                                    <!-- Profit Badge -->
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold"
                                        style="background: {{ $profitBg }}; color: {{ $profitColor }};">
                                        <i class="fa-solid fa-chart-line text-[10px]"></i>
                                        Profit: ${{ number_format(abs($profitMargin), 2) }}
                                    </span>
                                    
                                    <!-- Win Rate Badge -->
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold"
                                        style="background: {{ $winRateBg }}; color: {{ $winRateColor }};">
                                        <i class="fa-solid fa-trophy text-[10px]"></i>
                                        Win Rate: {{ number_format($winRate, 1) }}%
                                    </span>
                                </div>
                                
                                @if($feed->admin_bio)
                                <p class="text-xs text-gray-400 mt-2 truncate" title="{{ $feed->admin_bio }}">
                                    <i class="fa-solid fa-quote-left mr-1"></i>
                                    {{ Str::limit($feed->admin_bio, 50) }}
                                </p>
                                @endif
                            </div>
                        </div>

                    </div>

                </div>
                @endforeach

            </div>

        </div>

    </div>

    @else

    <div class="rounded-2xl shadow-xl overflow-hidden border border-emerald-200 p-10 text-center bg-white">
        <div class="p-4 bg-[#9EDD05]/10 rounded-xl text-[#9EDD05] inline-block mb-4">
            <i class="fa-solid fa-server text-xl"></i>
        </div>
        <h4 class="text-lg font-semibold text-[#0C3A30] mb-2">
            No Servers Found
        </h4>
        <p class="text-sm text-gray-500">
            There are currently no trading servers available.
        </p>
    </div>

    @endif

</div>

<style>
    /* Additional styles for better visual appeal */
    .hover\:shadow-md:hover {
        box-shadow: 0 4px 12px rgba(139, 201, 5, 0.15);
        border-color: #8bc905;
    }
    
    /* Optional: Add pulse animation for active badges */
    @keyframes softPulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }
    
    .fa-circle-check {
        animation: softPulse 2s infinite;
    }
</style>
@endsection