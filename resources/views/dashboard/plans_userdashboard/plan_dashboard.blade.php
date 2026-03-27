{{-- resources/views/dashboard/plans_userdashboard/plan_dashboard.blade.php --}}
@extends('layout.user')

@section('content')
<style>
    :root {
        --primary-green: #9EDD05;
        --dark-green: #0C3A30;
        --accent-green: #8AC304;
    }
    
    /* Fix overflow issues */
    * {
        box-sizing: border-box;
    }
    
    .dashboard-main-body {
        max-width: 100%;
        overflow-x: hidden;
    }
    
    .plan-card {
        border: 2px solid #e5e7eb;
        border-radius: 16px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        background: white;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        max-width: 100%;
         background-size: cover;
        background-position: center;
        display: flex;
        flex-direction: column;
        height: 100%;
        background-image: url({{ asset('assets/images/hero/hero-image-1.svg') }});
       
    }
    
    .plan-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-green), var(--accent-green));
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 16px 16px 0 0;
    }
    
    .plan-card:hover {
        transform: translateY(-4px);
        border-color: var(--primary-green);
        box-shadow: 0 12px 24px rgba(158, 221, 5, 0.15);
    }
    
    .plan-card:hover::before {
        opacity: 1;
    }
    
    .plan-card.selected {
        border-color: var(--primary-green);
        background: linear-gradient(135deg, #ffffff 0%, #f0f7ed 100%);
        box-shadow: 0 12px 24px rgba(158, 221, 5, 0.2);
    }
    
    .plan-card.selected::before {
        opacity: 1;
    }
    
    .plan-checkmark {
        position: absolute;
        top: 1rem;
        right: 1rem;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: var(--primary-green);
        display: none;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 12px;
        font-weight: bold;
        z-index: 10;
    }
    
    .plan-card.selected .plan-checkmark {
        display: flex;
        animation: checkPop 0.3s ease;
    }
    
    .custom-badge {
        position: absolute;
        top: 0;
        left: 0;
        background: linear-gradient(135deg, #ff6b6b, #ff4757);
        color: white;
        padding: 6px 16px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.5px;
        border-radius: 16px 0 16px 0;
        box-shadow: 0 4px 12px rgba(255, 71, 87, 0.4);
        z-index: 5;
        text-transform: uppercase;
    }
    
    @keyframes checkPop {
        0% { transform: scale(0); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }
    
    .trading-style-tag {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }
    
    .feature-tag {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        background: #f3f4f6;
        border-radius: 20px;
        font-size: 11px;
        color: #374151;
        margin-right: 4px;
        margin-bottom: 4px;
    }
    
    .feature-tag i {
        font-size: 12px;
    }
    
    .plan-heading {
        color: #0C3A30;
    }
    
    .custom-btn {
        background-color: #9EDD05;
        color: #0C3A30;
        padding: 0.75rem 1.5rem;
        font-weight: bold; 
        text-align: center;
        border-radius: 9999px;
        transition: all 0.3s ease;
        display: inline-block;
        width: 100%;
        text-decoration: none;
        border: none;
        cursor: pointer;
        margin-top: auto;
    }
    
    .custom-btn:hover {
        background-color: #89C604;
        box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        transform: translateY(-2px);
    }
    
    /* Responsive fixes */
    @media (max-width: 768px) {
        .plan-card {
            padding: 1.25rem;
        }
    }
    
    /* Animation for marquee */
    @keyframes scrollText {
        0% { transform: translateX(100%); }
        100% { transform: translateX(-100%); }
    }

    .animate-marquee {
        animation: scrollText 10s linear infinite !important;
        white-space: nowrap !important;
    }

    .animate-marquee:hover {
        animation-play-state: paused !important;
    }
</style>

<div class="dashboard-main-body">
 
<div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold mb-0">Investment Plans</h6>
        <ul class="flex items-center gap-[6px] text-sm">
            <li>
                <a href="{{ route('admin_dashboard') }}" class="flex items-center gap-2 hover:text-primary-600">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li>
                <a href="{{ route('admin_dashboard') }}" class="flex items-center gap-2 hover:text-primary-600">
                    <iconify-icon icon="solar:users-group-rounded" class="text-lg"></iconify-icon>
                  plans
                </a>
            </li>
        </ul>
    </div>
   

    <!-- Available Balance Alert -->
    @if(auth()->user()->available_balance > 0)
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-3 mb-6 flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center">
                <iconify-icon icon="ph:wallet-fill" class="text-white text-xl"></iconify-icon>
            </div>
            <div>
                <span class="text-green-800 font-semibold text-sm">Available  Balance</span>
                <div class="text-xl font-bold text-green-600">${{ number_format(auth()->user()->available_balance, 2) }}</div>
            </div>
        </div>
        <a href="{{ route('user.deposit') }}" class="bg-green-600 text-white px-5 py-2.5 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
            <iconify-icon icon="ph:plus-circle-fill"></iconify-icon>
            Add Funds
        </a>
    </div>
    @endif

    <div class="text-center mb-12">
        <h4 class="text-2xl md:text-5xl font-extrabold mt-3 mb-3 leading-tight" style="color: #0C3A30;">
            Choose Your Trading Style
        </h4>
        <p class="text-gray-600 max-w-2xl mx-auto">
            Select a plan that matches your trading goals and risk tolerance. All plans include professional copy trading features.
        </p>
    </div>

    <!-- Plan Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
            $sortedPlans = $plans->sortBy('minimum_amount');
            $secondLowestPlan = $sortedPlans->skip(1)->first();
        @endphp
        
        @foreach($plans as $plan)
        <div class="plan-card" data-plan-id="{{ $plan->id }}" 
             data-min="{{ $plan->minimum_amount }}" 
             data-max="{{ $plan->maximum_amount }}"
             data-rate="{{ rtrim(rtrim($plan->interest_rate, '0'), '.') }}"
             data-duration="{{ $plan->duration }}">
            
            @if($plan->popular_badge || ($secondLowestPlan && $plan->id == $secondLowestPlan->id))
            <div class="custom-badge">
                ⭐ Popular
            </div>
            @endif
            
            <div class="plan-checkmark">✓</div>
            
            <!-- Plan Name & Badges -->
            <div class="mb-4" style="margin-top: {{ ($plan->popular_badge || ($secondLowestPlan && $plan->id == $secondLowestPlan->id)) ? '20px' : '0' }};">
                <h3 class="text-2xl font-bold" style="color: #0C3A30;">{{ $plan->name }}</h3>
                
                <!-- Trading Style & Risk Badges -->
                <div class="flex flex-wrap gap-2 mt-2">
                    @if($plan->trading_style)
                    <span class="trading-style-tag {{ $plan->trading_style_color }}">
                        <iconify-icon icon="ph:chart-line-up-fill" class="mr-1"></iconify-icon>
                        {{ $plan->trading_style }}
                    </span>
                    @endif
                    
                    @if($plan->risk_level)
                    <span class="trading-style-tag {{ $plan->risk_level_color }}">
                        <iconify-icon icon="ph:shield-check-fill" class="mr-1"></iconify-icon>
                        {{ $plan->risk_level }} Risk
                    </span>
                    @endif
                </div>

                <!-- Recommended For -->
                @if($plan->recommended_for)
                <p class="text-xs text-gray-500 mt-2">
                    <iconify-icon icon="ph:user-star-fill" class="mr-1 text-yellow-500"></iconify-icon>
                    Recommended for: <span class="font-semibold">{{ $plan->recommended_for }}</span>
                </p>
                @endif
            </div>

            <!-- Returns & Duration Card -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-4 mb-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm text-gray-600">Expected Returns</span>
                    <span class="text-2xl font-bold text-green-600">
                        {{ rtrim(rtrim($plan->interest_rate, '0'), '.') }}%
                    </span>
                </div>
                
                @if($plan->expected_roi_range)
                <div class="flex justify-between items-center text-xs text-gray-500 mb-1">
                    <span>ROI Range</span>
                    <span class="font-semibold text-gray-700">{{ $plan->expected_roi_range }}</span>
                </div>
                @endif
                
                <div class="flex justify-between items-center text-xs text-gray-500 mb-1">
                    <span>Duration</span>
                    <span class="font-semibold text-gray-700">{{ $plan->duration }} Days</span>
                </div>
                
                @if($plan->min_duration)
                <div class="flex justify-between items-center text-xs text-gray-500 mb-1">
                    <span>Min. Duration</span>
                    <span class="font-semibold text-gray-700">{{ $plan->min_duration }}</span>
                </div>
                @endif
                
                <div class="flex justify-between items-center text-xs text-gray-500">
                    <span>Profit Frequency</span>
                    <span class="font-semibold capitalize text-gray-700">{{ $plan->profit_frequency }}</span>
                </div>
            </div>

            <!-- Investment Range -->
            <div class="mb-4">
                <div class="flex justify-between text-sm mb-1">
                    <span class="text-gray-600">Minimum Investment</span>
                    <span class="font-bold plan-min" data-usd="{{ $plan->minimum_amount }}" style="color: #0C3A30;">
                        ${{ number_format($plan->minimum_amount) }}
                    </span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Maximum Investment</span>
                    <span class="font-bold plan-max" data-usd="{{ $plan->maximum_amount }}" style="color: #0C3A30;">
                        ${{ number_format($plan->maximum_amount) }}
                    </span>
                </div>
            </div>

            <!-- Assets Traded -->
            @if($plan->assets_list && count($plan->assets_list) > 0)
            <div class="mb-4">
                <p class="text-xs font-semibold text-gray-500 mb-2">Assets Traded:</p>
                <div class="flex flex-wrap gap-1">
                    @foreach($plan->assets_list as $asset)
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded-full">
                        {{ $asset }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Strategy -->
            @if($plan->strategy)
            <div class="mb-4">
                <p class="text-xs font-semibold text-gray-500 mb-1">Strategy:</p>
                <p class="text-sm text-gray-600 line-clamp-2">{{ $plan->strategy }}</p>
            </div>
            @endif

            <!-- Dynamic Features -->
            @if($plan->features_list && count($plan->features_list) > 0)
            <div class="mb-4 flex-1">
                <p class="text-xs font-semibold text-gray-500 mb-2">Plan Features:</p>
                <div class="flex flex-wrap gap-2">
                    @foreach($plan->features_list as $feature)
                    <div class="feature-tag">
                        <iconify-icon icon="ph:check-circle-fill" style="color: #9EDD05;"></iconify-icon>
                        <span>{{ $feature }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Fees -->
            @if($plan->management_fee > 0 || $plan->performance_fee > 0)
            <div class="mb-4 text-xs text-gray-500 border-t border-gray-100 pt-3">
                @if($plan->management_fee > 0)
                <div class="flex justify-between">
                    <span>Management Fee:</span>
                    <span class="font-semibold">{{ $plan->management_fee }}%</span>
                </div>
                @endif
                @if($plan->performance_fee > 0)
                <div class="flex justify-between">
                    <span>Performance Fee:</span>
                    <span class="font-semibold">{{ $plan->performance_fee }}%</span>
                </div>
                @endif
            </div>
            @endif

            <!-- Start Trading Button -->
            <a href="{{ route('user.deposit', ['plan_id' => $plan->id]) }}" class="custom-btn">
                Start Trading <iconify-icon icon="ph:arrow-right-up-bold" class="ml-1"></iconify-icon>
            </a>
        </div>
        @endforeach
    </div>

    <!-- Help Section -->
    <div class="mt-12 text-center">
        <p class="text-gray-500 mb-4">Need help choosing a plan?</p>
        <a href="#" onclick="openHelp()" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
            <iconify-icon icon="ph:chat-circle-fill" style="color: #9EDD05;"></iconify-icon>
            Contact Support
        </a>
    </div>
</div>

<script>
function openHelp() {
    // You can implement help modal or redirect to support
    alert('Please contact support via email or live chat for assistance with plan selection.');
}
</script>

@endsection