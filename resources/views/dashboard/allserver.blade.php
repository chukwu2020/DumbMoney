@extends('layout.user')

@section('content')
<style>
    /* Additional styles for profile images */
    .admin-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid var(--primary-green);
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f3f4f6;
        flex-shrink: 0;
    }
    
    .admin-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
    
    /* Responsive profile images */
    @media (max-width: 768px) {
        .admin-avatar {
            width: 40px;
            height: 40px;
        }
    }
    
    @media (max-width: 480px) {
        .admin-avatar {
            width: 36px;
            height: 36px;
        }
    }
    
    /* Server card styling */
    .server-card {
        transition: all 0.3s ease;
    }
    
    .server-card:hover {
        transform: translateY(-2px);
    }
    
    /* Badge animations */
    @keyframes softPulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }
    
    .badge-pulse {
        animation: softPulse 2s infinite;
    }
</style>

<div class="flex flex-wrap items-center justify-between gap-2 mb-6 p-6">
    <h6 class="font-semibold mb-0" style="color: #0c3a30;">Active Servers</h6>
    <ul class="flex items-center gap-[6px]">
        <li class="font-medium">
            <a href="{{ route('user_dashboard') }}"
                class="flex items-center gap-2 text-[#0C3A30] hover:text-[#9EDD05] transition-colors duration-200"
                onmouseover="this.style.color='#9EDD05';"
                onmouseout="this.style.color='#0C3A30';">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li class="text-[#0C3A30]">-</li>
        <li class="font-medium text-[#0C3A30]">Servers</li>
    </ul>
</div>

<div class="max-w-5xl mx-auto mt-8" style="background-image: url(assets/images/hero/hero-image-1.svg); background-size: cover; background-position: center; border-radius: 24px;">

    @if($feeds->count() > 0)

    <div class="rounded-2xl shadow-xl overflow-hidden border border-emerald-200"
         style="border-top: 4px solid #8bc905; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(2px);">

        <div class="p-6">

            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h4 class="text-sm font-semibold text-[#0C3A30] uppercase tracking-wider">
                        ALL SERVERS
                    </h4>
                    <p class="text-xs text-gray-500 mt-1">
                        {{ $feeds->count() }} active server{{ $feeds->count() > 1 ? 's' : '' }} available for copy trading
                    </p>
                </div>

                <div class="p-2 bg-[#9EDD05]/10 rounded-xl text-[#9EDD05]">
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
                    if ($winRate >= 70) {
                        $winRateClass = 'high';
                        $winRateBg = 'linear-gradient(135deg, #dcfce7, #bbf7d0)';
                        $winRateColor = '#166534';
                        $winRateIcon = 'fa-solid fa-chart-line';
                    } elseif ($winRate >= 50) {
                        $winRateClass = 'medium';
                        $winRateBg = 'linear-gradient(135deg, #fef9c3, #fef08a)';
                        $winRateColor = '#854d0e';
                        $winRateIcon = 'fa-solid fa-chart-simple';
                    } else {
                        $winRateClass = 'low';
                        $winRateBg = 'linear-gradient(135deg, #fee2e2, #fecaca)';
                        $winRateColor = '#991b1b';
                        $winRateIcon = 'fa-solid fa-chart-line';
                    }
                    
                    // Profit styling
                    $profitColor = $profitMargin >= 0 ? '#15803d' : '#b91c1c';
                    $profitBg = $profitMargin >= 0 ? '#dcfce7' : '#fee2e2';
                    $profitIcon = $profitMargin >= 0 ? 'fa-solid fa-arrow-trend-up' : 'fa-solid fa-arrow-trend-down';
                    $profitSign = $profitMargin >= 0 ? '+' : '';
                @endphp

                <div class="server-card bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                    
                    <div class="p-5">
                        <div class="grid md:grid-cols-2 gap-6">

                            <!-- SERVER SECTION with profile-style image -->
                            <div class="flex items-center gap-4">
                                <!-- Server Image - Profile Style (small circular) -->
                                <div class="admin-avatar">
                                    @if($feed->server_profile_image)
                                   <img src="{{ asset('uploads/servers/'.$feed->server_profile_image) }}"
                                         alt="{{ $feed->server_name }}"
                                         class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#9EDD05] to-[#8AC304]">
                                        <i class="fa-solid fa-server text-white text-lg"></i>
                                    </div>
                                    @endif
                                </div>

                                <div>
                                    <h5 class="text-base font-semibold text-[#0C3A30] mb-1">
                                        {{ $feed->server_name }}
                                    </h5>
                                    <div class="flex flex-wrap gap-3 text-xs text-gray-500">
                                        <span><i class="fa-solid fa-users mr-1"></i> {{ number_format($feed->active_members) }} active</span>
                                        <span><i class="fa-solid fa-copy mr-1"></i> {{ number_format($feed->copying_trades ?? 0) }} copying</span>
                                    </div>
                                </div>
                            </div>

                            <!-- ADMIN SECTION with profile-style image -->
                            <div class="flex items-center gap-4">
                                <!-- Admin Image - Profile Style (small circular) -->
                                <div class="admin-avatar">
                                    @if($feed->admin_profile_image)
                                    <img src="{{ asset('uploads/admins/'.$feed->admin_profile_image) }}"
                                         alt="{{ $feed->admin_name }}"
                                         class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#9EDD05] to-[#8AC304]">
                                        <i class="fa-solid fa-user text-white text-lg"></i>
                                    </div>
                                    @endif
                                </div>

                                <div class="flex-1">
                                    <h5 class="text-base font-semibold text-[#0C3A30] mb-1">
                                        {{ $feed->admin_name }}
                                    </h5>
                                    <p class="text-xs text-gray-500 mb-2">
                                        <i class="fa-solid fa-shield-halved mr-1"></i>
                                        Server Administrator
                                    </p>
                                    
                                    <!-- Stats Badges -->
                                    <div class="flex flex-wrap gap-2">
                                        <!-- Win Rate Badge -->
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold"
                                            style="background: {{ $winRateBg }}; color: {{ $winRateColor }};">
                                            <i class="{{ $winRateIcon }} text-[10px]"></i>
                                            Win: {{ number_format($winRate, 1) }}%
                                        </span>
                                        
                                        <!-- Profit Badge -->
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold"
                                            style="background: {{ $profitBg }}; color: {{ $profitColor }};">
                                            <i class="{{ $profitIcon }} text-[10px]"></i>
                                            Profit: {{ $profitSign }}${{ number_format(abs($profitMargin), 2) }}
                                        </span>
                                    </div>
                                    
                                    @if($feed->admin_bio)
                                    <p class="text-xs text-gray-400 mt-2 truncate max-w-[200px]" title="{{ $feed->admin_bio }}">
                                        <i class="fa-solid fa-quote-left mr-1 text-[#8bc905]"></i>
                                        {{ Str::limit($feed->admin_bio, 40) }}
                                    </p>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                    
                    <!-- Action Button -->
                    <div class="px-5 pb-5 pt-2 border-t border-gray-100 bg-gray-50/30">
                        <button onclick="window.location.href='{{ route('copy-trading.index') }}'"
                                class="w-full py-2 rounded-lg font-semibold text-sm transition-all duration-200 flex items-center justify-center gap-2 hover:gap-3"
                                style="background: linear-gradient(135deg, #9EDD05, #8AC304); color: #0C3A30;">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                            Start Copy Trading
                            <i class="fa-solid fa-chevron-right text-xs transition-transform duration-200 group-hover:translate-x-1"></i>
                        </button>
                    </div>
                    
                </div>
                @endforeach

            </div>

        </div>

    </div>

    @else

    <div class="rounded-2xl shadow-xl overflow-hidden border border-emerald-200 p-12 text-center bg-white/95 backdrop-blur-sm">
        <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gradient-to-br from-[#9EDD05] to-[#8AC304] flex items-center justify-center shadow-lg">
            <i class="fa-solid fa-server text-white text-3xl"></i>
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
    /* Additional styles for hover effects */
    .server-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .server-card:hover {
        transform: translateY(-2px);
        border-color: #8bc905;
    }
    
    /* Profile image hover effect */
    .admin-avatar {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .server-card:hover .admin-avatar {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(158, 221, 5, 0.3);
    }
    
    /* Button hover effect */
    button i:last-child {
        transition: transform 0.2s ease;
    }
    
    button:hover i:last-child {
        transform: translateX(4px);
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #8AC304;
        border-radius: 3px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #9EDD05;
    }
</style>
@endsection