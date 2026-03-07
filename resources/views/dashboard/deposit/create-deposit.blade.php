@extends('layout.user')

@section('content')

<!-- Reinvestment Mode Alert -->
@if(session('reinvestment_mode') && session('reinvestment_expires') > now())
<div class="alert alert-warning mb-4 px-6" style="background-color:#9EDD05 !important;">
    <div class="flex items-center">
        <iconify-icon icon="solar:refresh-circle-outline" class="mr-2"></iconify-icon>
        <span>You are in reinvestment mode. Available balance (<span id="availableBalanceDisplay">${{ number_format(auth()->user()->available_balance, 2) }}</span>).</span>
        <button
            onclick="location.href='{{ route('user_dashboard') }}'"
            class="ml-4 text-sm underline font-semibold hover:text-red-600 transition-colors duration-200"
            style="color: #000000;">
            Cancel
        </button>
    </div>
</div>
@endif

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
        background-image: url(assets/images/hero/hero-image-1.svg);
        background-size: cover;
        background-position: center;
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
    
    .popular-badge {
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
    
    .deposit-form-area {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease, opacity 0.3s ease;
        opacity: 0;
        max-width: 100%;
    }
    
    .deposit-form-area.active {
        max-height: 1200px;
        opacity: 1;
        margin-top: 2rem;
    }
    
    .form-container {
        background-image: url(assets/images/hero/hero-image-1.svg);
        background-size: cover;
        background-position: center;
        border-radius: 16px;
        padding: 2rem;
        max-width: 100%;
    }
    
    select.form-control, .form-control {
        border: none;
        border-top: 4px solid #8AC304;
        border-radius: 0.5rem;
        background-color: white !important;
        font-weight: 600;
        color: #0C3A30;
        padding: 0.75rem 1rem;
        width: 100%;
    }
    
    select.form-control:focus, .form-control:focus {
        outline: none;
        border-top-color: var(--primary-green);
        box-shadow: 0 0 0 3px rgba(158, 221, 5, 0.3);
    }
    
    /* Enhanced dropdown option styling - Works best in Webkit browsers (Chrome, Edge, Safari) */
    select.form-control option,
    .currency-switcher option {
        background-color: white !important;
        color: #0C3A30;
        padding: 2px;
        font-weight: 600;
    }
    
    /* Chrome, Safari, newer Edge */
    select.form-control option:hover,
    .currency-switcher option:hover {
        background-color: #8AC304 !important;
        background: #8AC304 !important;
        color: white !important;
    }
    
    select.form-control option:checked,
    .currency-switcher option:checked {
        background-color: #9EDD05 !important;
        background: linear-gradient(#9EDD05, #9EDD05) !important;
        color: #0C3A30 !important;
        font-weight: 700;
    }
    
    /* Firefox-specific styling */
    @-moz-document url-prefix() {
        select.form-control option:hover,
        .currency-switcher option:hover {
            background-color: #8AC304 !important;
        }
        
        select.form-control option:checked,
        .currency-switcher option:checked {
            background-color: #9EDD05 !important;
        }
    }
    
    /* Webkit specific (Chrome/Safari) */
    select.form-control option:checked,
    .currency-switcher option:checked {
        background: #9EDD05 !important;
        background-color: #9EDD05 !important;
    }
    
    /* Additional targeting for better browser support */
    select.form-control:focus option:checked,
    .currency-switcher:focus option:checked {
        background: linear-gradient(0deg, #9EDD05 0%, #9EDD05 100%) !important;
        color: #0C3A30 !important;
    }
    
    /* Style the select when opened (focus state) */
    select.form-control:focus,
    .currency-switcher:focus {
        border-top-color: var(--primary-green);
        box-shadow: 0 0 0 3px rgba(158, 221, 5, 0.3);
    }
    
    .amount-preset-btn {
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-weight: 600;
        color: #0C3A30;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    
    .amount-preset-btn:hover {
        border-color: var(--primary-green);
        background: #f8faf7;
    }
    
    .amount-preset-btn.active {
        background: var(--primary-green);
        border-color: var(--primary-green);
        color: #0C3A30;
    }
    
    .guide-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.8);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }
    
    .guide-modal.active {
        display: flex;
    }
    
    .guide-modal-content {
        background: white;
        border-radius: 16px;
        max-width: 600px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        padding: 1rem;
    }
    
    .guide-step {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
        padding: 1rem;
        background: #f9fafb;
        border-radius: 10px;
    }
    
    .step-number {
        width: 32px;
        height: 32px;
        background: var(--primary-green);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        flex-shrink: 0;
    }
    
    .guide-note {
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1rem;
        display: flex;
        gap: 0.75rem;
    }
    
    .warning-note {
        background: #fef3c7;
        border: 1px solid #fde68a;
    }
    
    .tip-note {
        background: #dbeafe;
        border: 1px solid #93c5fd;
    }

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
    
    .selected-plan-indicator {
        background: linear-gradient(135deg, var(--primary-green), var(--accent-green));
        color: var(--dark-green);
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-left: 10px;
    }
    
    .currency-switcher {
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-weight: 600;
        color: #0C3A30;
        background: white;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .currency-switcher:hover {
        border-color: var(--primary-green);
    }
    
    .continue-btn {
        background: var(--primary-green);
        color: var(--dark-green);
        font-weight: 600;
        padding: 0.75rem 2.5rem;
        border-radius: 0.5rem;
        transition: background-color 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .continue-btn:hover {
        background: var(--accent-green);
    }
    
    .continue-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .plan-feature {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0;
        font-size: 0.875rem;
        color: #6b7280;
    }
    
    .plan-feature iconify-icon {
        color: var(--primary-green);
        font-size: 1.1rem;
    }
    
    .web3-heading {
        font-size: 1rem;
        font-weight: 700;
        color: #0C3A30;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    .profit-display {
        background: linear-gradient(135deg, rgba(158, 221, 5, 0.1), rgba(138, 195, 4, 0.1));
        border: 2px solid var(--primary-green);
        border-radius: 12px;
        padding: 1rem;
        margin-top: 1rem;
    }
    
    .profit-amount {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-green);
    }
    
    /* Responsive fixes */
    @media (max-width: 768px) {
        .form-container {
            padding: 1.5rem;
        }
        
        .plan-card {
            padding: 1.25rem;
        }
        
        .animate-marquee {
            font-size: 0.875rem;
        }
        
        .selected-plan-indicator {
            font-size: 0.875rem;
            padding: 4px 10px;
        }
        
        .web3-heading {
            font-size: 1.2rem;
        }
    }
    
    @media (max-width: 640px) {
        .amount-preset-btn {
            flex: 1 1 calc(50% - 0.5rem);
            min-width: 0;
        }
    }
</style>

<div class="dashboard-main-body">

    <!-- Breadcrumb -->
    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h5 class="font-semibold mb-0" style="color: #0C3A30;">Deposit</h5>
        <ul class="flex items-center gap-[6px]">
            <li>
                <a href="{{ route('user_dashboard') }}"
                    class="flex items-center gap-2 hover:text-[#9EDD05]"
                    style="color: #0C3A30;">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="font-medium" style="color: #9EDD05;">Deposit</li>
        </ul>
    </div>

 <!-- Investment Status Banner -->
@php
$totalInvested = (float) auth()->user()->amount_invested;
@endphp

@if($totalInvested == 0)
<div class="relative overflow-hidden rounded-xl bg-gradient-to-r from-orange-100 to-white mb-4"
    style="box-shadow: 0 4px 24px rgba(249, 115, 22, 0.15); border: 1px solid rgba(249, 115, 22, 0.3) !important; max-width: 100%;">
    <div class="absolute inset-y-0 left-0 w-16 bg-gradient-to-r from-orange-100 to-transparent z-10 pointer-events-none"></div>
    <div class="absolute inset-y-0 right-0 w-16 bg-gradient-to-l from-orange-100 to-transparent z-10 pointer-events-none"></div>
    <div class="py-3 overflow-hidden bg-white">
        <div class="animate-marquee inline-flex items-center will-change-transform">
            <span class="inline-flex items-center px-6 text-base font-medium text-orange-800 tracking-tight">
                <span class="text-orange-500/90 mr-3 text-lg">🚀</span>
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-orange-400 to-orange-700 font-semibold">
                    Your trading account is not yet active — complete setup to begin.
                </span>
                <span class="mx-4 text-orange-400">•</span>
                <span>
                    Once your account is funded, trade updates and notifications will be mirrored automatically based on your selected settings.
                </span>
                <span class="ml-4 px-3 py-0.5 rounded-full text-orange-700 text-xs font-bold border border-orange-400/20"
                    style="background-color: rgba(249, 115, 22, 0.1) !important;">
                    ACTIVATE TRADING
                </span>
            </span>
        </div>
    </div>
</div>

@elseif($totalInvested >= 100)
<div class="relative overflow-hidden rounded-xl bg-gradient-to-r from-indigo-100 to-white mb-4"
    style="box-shadow: 0 4px 24px rgba(99, 102, 241, 0.15); border: 1px solid rgba(99, 102, 241, 0.3) !important; max-width: 100%;">
    <div class="absolute inset-y-0 left-0 w-16 bg-gradient-to-r from-indigo-100 to-transparent z-10 pointer-events-none"></div>
    <div class="absolute inset-y-0 right-0 w-16 bg-gradient-to-l from-indigo-100 to-transparent z-10 pointer-events-none"></div>
    <div class="py-3 overflow-hidden bg-white">
        <div class="animate-marquee inline-flex items-center will-change-transform">
            <span class="inline-flex items-center px-6 text-base font-medium text-gray-700 tracking-tight">
                <span class="text-indigo-600/90 mr-3 text-lg">💎💎💎</span>
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-600 font-semibold">
                    Advanced Trading Access Enabled
                </span>
                <span class="mx-4 text-indigo-300">•</span>
                <span>
                    Higher capital allows proportional position sizing and broader access to active trading strategies.
                </span>
                <span class="ml-4 px-3 py-0.5 rounded-full text-indigo-700 text-xs font-bold border border-indigo-400/20"
                    style="background-color: rgba(99, 102, 241, 0.1) !important;">
                    VIEW TRADE ACCESS
                </span>
            </span>
        </div>
    </div>
</div>

@else
<div class="relative overflow-hidden rounded-xl bg-gradient-to-r from-emerald-50 to-white mb-4"
    style="box-shadow: 0 4px 24px rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.2) !important; max-width: 100%;">
    <div class="absolute inset-y-0 left-0 w-16 bg-gradient-to-r from-emerald-50 to-transparent z-10 pointer-events-none"></div>
    <div class="absolute inset-y-0 right-0 w-16 bg-gradient-to-l from-emerald-50 to-transparent z-10 pointer-events-none"></div>
    <div class="py-3 overflow-hidden bg-white">
        <div class="animate-marquee inline-flex items-center will-change-transform">
            <span class="inline-flex items-center px-6 text-base font-medium text-gray-600 tracking-tight">
                <span class="text-emerald-500/90 mr-3 text-lg">📈</span>
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-emerald-400 to-green-600 font-semibold">
                    Your trading setup is active and progressing
                </span>
                <span class="mx-4 text-emerald-300">•</span>
                <span>
                    Increasing capital improves trade allocation and flexibility, while maintaining risk controls.
                </span>
                <span class="ml-4 px-3 py-0.5 rounded-full text-emerald-700 text-xs font-bold border border-emerald-400/20"
                    style="background-color: rgba(16, 185, 129, 0.1) !important;">
                   ADJUST CAPITAL
                </span>
            </span>
        </div>
    </div>
</div>
@endif
    <!-- Header with Currency Switcher and Help Guide -->
    <div class="flex items-center justify-between gap-4 mb-6">
        <button type="button" onclick="openGuide()" class="flex items-center gap-2 px-1 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition">
            <iconify-icon icon="ph:question-fill" class="text-lg"></iconify-icon>
            <span class="font-semibold">How to Fund Account</span>
        </button>
        
        <div class="flex items-center gap-2">
            <select id="currencySwitcher" class="currency-switcher">
                <option value="USD" selected>USD</option>
                <option value="EUR">🇪🇺 EUR</option>
                <option value="GBP">🇬🇧 GBP</option>
                <option value="NGN">🇳🇬 NGN</option>
                <option value="AUD">🇦🇺 AUD</option>
                <option value="CAD">🇨🇦 CAD</option>
                <option value="TWD">🇹🇼 TWD</option>
                <option value="JPY">🇯🇵 JPY</option>
                <option value="CNY">🇨🇳 CNY</option>
                <option value="INR">🇮🇳 INR</option>
                
                <option value="BRL">🇧🇷 BRL</option>
                <option value="MXN">🇲🇽 MXN</option>
                <option value="RUB">🇷🇺 RUB</option>
                <option value="ZAR">🇿🇦 ZAR</option>
                <option value="CHF">🇨🇭 CHF</option>
                <option value="AED">🇦🇪 AED</option>
                <option value="SAR">🇸🇦 SAR</option>
                <option value="SGD">🇸🇬 SGD</option>
                <option value="HKD">🇭🇰 HKD</option>
                <option value="KRW">🇰🇷 KRW</option>
                <option value="NZD">🇳🇿 NZD</option>
                <option value="THB">🇹🇭 THB</option>
                <option value="MYR">🇲🇾 MYR</option>
                <option value="PHP">🇵🇭 PHP</option>
                <option value="IDR">🇮🇩 IDR</option>
                <option value="VND">🇻🇳 VND</option>
                <option value="EGP">🇪🇬 EGP</option>
                <option value="KES">🇰🇪 KES</option>
                <option value="GHS">🇬🇭 GHS</option>
                <option value="TRY">🇹🇷 TRY</option>
                <option value="PLN">🇵🇱 PLN</option>
                <option value="SEK">🇸🇪 SEK</option>
                <option value="NOK">🇳🇴 NOK</option>
                <option value="DKK">🇩🇰 DKK</option>
            </select>
        </div>
    </div>

    <!-- Investment Plans Cards -->
    <div class="mb-6">
        <h3 class="text-xl font-bold mb-4" style="color: #0C3A30;">Select  Trading Plan</h3>
        
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
                 data-duration="{{ $plan->duration }}"
                 onclick="selectPlan(this)">
                
                @if($secondLowestPlan && $plan->id == $secondLowestPlan->id)
                <div class="popular-badge">
                    ⭐ Popular
                </div>
                @endif
                
                <div class="plan-checkmark">✓</div>
                
                <div class="flex justify-between items-start mb-3" style="margin-top: {{ $secondLowestPlan && $plan->id == $secondLowestPlan->id ? '20px' : '0' }};">
                    <div>
                        <h4 class="text-lg font-bold" style="color: #0C3A30;">{{ ucfirst($plan->name) }}</h4>
                        <div class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold mt-1">
                            {{ rtrim(rtrim($plan->interest_rate, '0'), '.') }}% ROE Returns
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-500">Trading Period</div>
                        <div class="font-bold" style="color: #0C3A30;">{{ $plan->duration }} Days</div>
                    </div>
                </div>

                <div class="space-y-2 mb-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600 text-sm">Minimum Capital</span>
                        <span class="font-bold plan-min" data-usd="{{ $plan->minimum_amount }}">${{ number_format($plan->minimum_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 text-sm">Maximum Capital</span>
                        <span class="font-bold plan-max" data-usd="{{ $plan->maximum_amount }}">${{ number_format($plan->maximum_amount, 2) }}</span>
                    </div>
                </div>

                <!-- Additional Plan Features -->
                <div class="border-t border-gray-100 pt-3 space-y-2">
                    <div class="plan-feature">
                        <iconify-icon icon="ph:chart-line-up-fill"></iconify-icon>
                        <span>Daily profit tracking</span>
                    </div>
                    <div class="plan-feature">
                        <iconify-icon icon="ph:shield-check-fill"></iconify-icon>
                        <span>Automated risk management</span>
                    </div>
                    <div class="plan-feature">
                        <iconify-icon icon="ph:users-three-fill"></iconify-icon>
                        <span>Access the live tradings</span>
                    </div>
                    <div class="plan-feature">
                        <iconify-icon icon="ph:wallet-fill"></iconify-icon>
                        <span>Instant withdrawals</span>
                    </div>
                </div>

                <div class="text-center pt-3 mt-3 border-t border-gray-100" >
                    <span style="font-size:1rem !important; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;" class="text-sm text-gray-500 :">Click to select trading plan</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Deposit Form (Hidden Initially) -->
    <div class="deposit-form-area" id="depositFormArea">
        <div class="form-container">
            <div class="flex items-center gap-4 mb-6" style="flex-wrap: nowrap;">
                <div class="flex-1" style="display: flex; flex-wrap:nowrap;">
                    <h3 class="web3-heading">You Selected </h3>
                    <div id="selectedPlanDisplay" class="selected-plan-indicator">
                        <iconify-icon icon="ph:check-circle-fill"></iconify-icon>
                        <span id="selectedPlanText">Plan Selected</span>
                    </div>
                </div>
            </div>

            <form action="{{ route('user.make-deposit') }}" method="POST" id="depositForm" 
                  @if(session('reinvestment_mode') && session('reinvestment_expires')> now()) onsubmit="return validateReinvestment()" @endif>
                @csrf
                <input type="hidden" name="plan_id" id="plan_id_input">
                <input type="hidden" name="interest_rate" id="interest_rate_input">
                <input type="hidden" name="amount_usd" id="amount_usd_input">
                
                @if(session('reinvestment_mode') && session('reinvestment_expires') > now())
                <input type="hidden" name="reinvestment" value="1">
                @endif

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Wallet Select -->
                    <div>
                        <label for="wallet_id" class="block mb-2 font-bold text-neutral-900">
                            Select Your Account Wallet <span class="text-red-600">*</span>
                        </label>
                        <select name="wallet_id" id="wallet_id" class="form-control w-full" required>
                            <option value="" disabled selected class="text-gray-500 font-medium">Choose Cryptocurrency Wallet</option>
                            @foreach($wallets as $wallet)
                            <option value="{{ $wallet->id }}">
                                {{ ucfirst($wallet->crypto_name) }} Wallet
                            </option>
                            @endforeach
                        </select>
                        @error('wallet_id')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <!-- Amount Input -->
                    <div>
                        <label for="amount_input" class="block mb-2 font-bold text-neutral-900">
                          Trading Capital <span class="text-red-600">*</span>
                        </label>
                        <input type="number" name="amount" id="amount_input" step="0.01" 
                               class="form-control w-full" 
                               placeholder="Enter capital amount" 
                               oninput="calculateProfit()" required>
                        <div class="text-sm text-gray-500 mt-1">
                            Min: <span id="currencySymbolMin"></span><span id="minAmountDisplay">0</span> • Max: <span id="currencySymbolMax"></span><span id="maxAmountDisplay">0</span>
                        </div>
                        @error('amount')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <!-- Expected Profit Display -->
                    <div class="md:col-span-2" id="profitDisplaySection" style="display: none;">
                        <div class="profit-display">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-sm text-gray-600 font-semibold">Expected Profit After <span id="planDuration">0</span> Days</div>
                                    <div class="profit-amount"><span id="currencySymbolProfit"></span><span id="expectedProfit">0.00</span></div>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm text-gray-600 font-semibold">Total Return</div>
                                    <div class="text-xl font-bold" style="color: #0C3A30;"><span id="currencySymbolReturn"></span><span id="totalReturn">0.00</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Amounts -->
                    <div class="md:col-span-2">
                        <label class="block mb-2 font-bold text-neutral-900">Quick Capital Select</label>
                        <div class="flex flex-wrap gap-2" id="quickAmountButtons">
                            <!-- Buttons will be dynamically generated -->
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="md:col-span-2 flex flex-wrap justify-center gap-4 mt-8 pt-6 border-t border-gray-200">
                        <button type="button" onclick="resetForm()" 
                                class="px-10 py-3 border-2 border-red-600 text-red-600 rounded-lg hover:bg-red-100 transition">
                            Reset
                        </button>
                        <button type="submit" id="submitButton" class="continue-btn" disabled>
                            Continue to Fund
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- Funding Guide Modal -->
<div class="guide-modal" id="guideModal" onclick="if(event.target === this) closeGuide()">
    <div class="guide-modal-content">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold" style="color: #0C3A30;">How to Fund Your Copy Trading Account</h3>
            <button onclick="closeGuide()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>

        <div class="space-y-3">
            <div class="guide-step">
                <div class="step-number">1</div>
                <div>
                    <div class="font-bold">Select Copy Trading Plan Just By Clicking </div>
                    <div class="text-sm text-gray-600">Choose your capital tier for copying </div>
                </div>
            </div>

            <div class="guide-step">
                <div class="step-number">2</div>
                <div>
                    <div class="font-bold">Choose Cryptocurrency Wallet</div>
                    <div class="text-sm text-gray-600">Pick from available crypto wallets (USDT, BTC, ETH, etc.)</div>
                </div>
            </div>

            <div class="guide-step">
                <div class="step-number">3</div>
                <div>
                    <div class="font-bold">Enter Trading Capital Amount And Click Continue</div>
                    <div class="text-sm text-gray-600">Input your copy trading capital within plan limits</div>
                </div>
            </div>

            <div class="guide-step">
                <div class="step-number">4</div>
                <div>
                    <div class="font-bold">Copy Generated Wallet Address</div>
                    <div class="text-sm text-gray-600">Next page shows unique wallet address for your deposit</div>
                </div>
            </div>

            <div class="guide-step">
                <div class="step-number">5</div>
                <div>
                    <div class="font-bold">Open Your Crypto Exchange</div>
                    <div class="text-sm text-gray-600">Go to Binance, Bybit, OKX, Trust-wallet, Crypto.com, Coinbase, or your preferred exchange</div>
                </div>
            </div>

            <div class="guide-step">
                <div class="step-number">6</div>
                <div>
                    <div class="font-bold">Initiate Withdrawal</div>
                    <div class="text-sm text-gray-600">Select matching cryptocurrency and paste wallet address</div>
                </div>
            </div>

            <div class="guide-step">
                <div class="step-number">7</div>
                <div>
                    <div class="font-bold">Complete Transaction</div>
                    <div class="text-sm text-gray-600">Confirm and send your copy trading capital</div>
                </div>
            </div>

            <div class="guide-step">
                <div class="step-number">8</div>
                <div>
                    <div class="font-bold">Capture Transaction Proof</div>
                    <div class="text-sm text-gray-600">Screenshot the transaction confirmation</div>
                </div>
            </div>

            <div class="guide-step">
                <div class="step-number">9</div>
                <div>
                    <div class="font-bold">Upload Proof of Payment</div>
                    <div class="text-sm text-gray-600">Return and upload your screenshot for verification</div>
                </div>
            </div>

            <div class="guide-step">
                <div class="step-number">10</div>
                <div>
                    <div class="font-bold">Start Copy Trading</div>
                    <div class="text-sm text-gray-600">Get notified when confirmed — copy trading begins!</div>
                </div>
            </div>

            <div class="guide-note warning-note">
                <span class="text-xl">⏱️</span>
                <div>
                    <strong>Processing Time:</strong> 1-10 minutes (network dependent). Copy trading activates instantly after approval.
                </div>
            </div>

            <div class="guide-note tip-note">
                <span class="text-xl">💡</span>
                <div>
                    <strong>Pro Tip:</strong> Larger capital = Better copy positions with elite traders = Higher potential returns!
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const rates = {};
let selectedPlanId = null;
let minAmount = 0;
let maxAmount = 0;
let selectedPlanName = '';
let selectedPlanRate = 0;
let selectedPlanDuration = 0;
let currentCurrency = 'USD';

// Quick amount presets in USD
const quickAmountsUSD = [500, 1000, 2000, 5000, 10000];

// Fetch exchange rates
fetch('https://v6.exchangerate-api.com/v6/a8e67b756f551b68d4ada293/latest/USD')
    .then(response => response.json())
    .then(data => {
        if (data.result === 'success') {
            Object.assign(rates, data.conversion_rates);
            // Initialize quick amount buttons after rates are loaded
            updateQuickAmountButtons();
        }
    })
    .catch(error => {
        console.error('Error fetching exchange rates:', error);
        // Set default rates if API fails
        rates.USD = 1;
        rates.EUR = 0.92;
        rates.GBP = 0.79;
        rates.NGN = 1500;
        updateQuickAmountButtons();
    });

// Currency switcher
document.getElementById('currencySwitcher').addEventListener('change', function() {
    currentCurrency = this.value;
    updateCurrencyDisplay(currentCurrency);
});

function updateCurrencyDisplay(currency) {
    const rate = rates[currency] || 1;
    const symbol = getCurrencySymbol(currency);
    
    // Update plan cards
    document.querySelectorAll('.plan-card').forEach(card => {
        const minSpan = card.querySelector('.plan-min');
        const maxSpan = card.querySelector('.plan-max');
        
        if (minSpan && maxSpan) {
            const minUsd = parseFloat(minSpan.dataset.usd);
            const maxUsd = parseFloat(maxSpan.dataset.usd);
            
            minSpan.textContent = symbol + formatNumber(minUsd * rate);
            maxSpan.textContent = symbol + formatNumber(maxUsd * rate);
        }
    });
    
    // Update form display if plan is selected
    if (selectedPlanId) {
        const minDisplay = document.getElementById('minAmountDisplay');
        const maxDisplay = document.getElementById('maxAmountDisplay');
        
        if (minDisplay && maxDisplay) {
            document.getElementById('currencySymbolMin').textContent = symbol;
            document.getElementById('currencySymbolMax').textContent = symbol;
            minDisplay.textContent = formatNumber(minAmount * rate);
            maxDisplay.textContent = formatNumber(maxAmount * rate);
        }
        
        calculateProfit();
    }
    
    // Update quick amount buttons
    updateQuickAmountButtons();
    
    // Update available balance display if in reinvestment mode
    @if(session('reinvestment_mode') && session('reinvestment_expires') > now())
    const availableBalance = {{ auth()->user()->available_balance }};
    const balanceDisplay = document.getElementById('availableBalanceDisplay');
    if (balanceDisplay) {
        balanceDisplay.textContent = symbol + formatNumber(availableBalance * rate);
    }
    @endif
}

function updateQuickAmountButtons() {
    const currency = currentCurrency;
    const rate = rates[currency] || 1;
    const symbol = getCurrencySymbol(currency);
    const container = document.getElementById('quickAmountButtons');
    
    if (!container) return;
    
    container.innerHTML = '';
    
    quickAmountsUSD.forEach(amountUSD => {
        const convertedAmount = amountUSD * rate;
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'amount-preset-btn';
        button.onclick = function() { setAmount(amountUSD); };
        button.textContent = symbol + formatNumber(convertedAmount);
        container.appendChild(button);
    });
}

function getCurrencySymbol(currency) {
    const symbols = {
        USD: '$', EUR: '€', GBP: '£', NGN: '₦', AUD: 'A$', CAD: 'C$',  TWD: 'NT$',
        JPY: '¥', CNY: '¥', INR: '₹', BRL: 'R$', MXN: 'MX$', RUB: '₽',
        ZAR: 'R', CHF: 'CHF ', AED: 'د.إ', SAR: 'ر.س', SGD: 'S$', HKD: 'HK$',
        KRW: '₩', NZD: 'NZ$', THB: '฿', MYR: 'RM', PHP: '₱', IDR: 'Rp',
        VND: '₫', EGP: 'E£', KES: 'KSh', GHS: '₵', TRY: '₺', PLN: 'zł',
        SEK: 'kr', NOK: 'kr', DKK: 'kr'
    };
    return symbols[currency] || currency + ' ';
}

function formatNumber(num) {
    return num.toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}

function selectPlan(card) {
    // Remove selected class from all cards
    document.querySelectorAll('.plan-card').forEach(c => c.classList.remove('selected'));
    
    // Add selected class to clicked card
    card.classList.add('selected');
    
    // Get plan data
    selectedPlanId = card.dataset.planId;
    minAmount = parseFloat(card.dataset.min);
    maxAmount = parseFloat(card.dataset.max);
    selectedPlanRate = parseFloat(card.dataset.rate);
    selectedPlanDuration = parseInt(card.dataset.duration);
    selectedPlanName = card.querySelector('h4').textContent.trim();
    
    // Update form
    document.getElementById('plan_id_input').value = selectedPlanId;
    document.getElementById('interest_rate_input').value = selectedPlanRate;
    document.getElementById('selectedPlanText').textContent = selectedPlanName;
    document.getElementById('planDuration').textContent = selectedPlanDuration;
    
    // Get current currency
    const rate = rates[currentCurrency] || 1;
    const symbol = getCurrencySymbol(currentCurrency);
    
    // Update min/max display
    document.getElementById('currencySymbolMin').textContent = symbol;
    document.getElementById('currencySymbolMax').textContent = symbol;
    document.getElementById('minAmountDisplay').textContent = formatNumber(minAmount * rate);
    document.getElementById('maxAmountDisplay').textContent = formatNumber(maxAmount * rate);
    
    // Show deposit form
    const depositForm = document.getElementById('depositFormArea');
    depositForm.classList.add('active');
    
    // Scroll to form
    setTimeout(() => {
        depositForm.scrollIntoView({behavior: 'smooth', block: 'center'});
    }, 300);
    
    // Calculate profit if amount already entered
    calculateProfit();
    
    // Validate form
    validateForm();
}

function calculateProfit() {
    const amountInput = document.getElementById('amount_input');
    const profitSection = document.getElementById('profitDisplaySection');
    
    if (!amountInput || !selectedPlanRate) return;
    
    const amount = parseFloat(amountInput.value) || 0;
    
    if (amount > 0) {
        // Get current currency rate
        const rate = rates[currentCurrency] || 1;
        const symbol = getCurrencySymbol(currentCurrency);
        
        // Convert amount to USD for calculation (since it's entered in selected currency)
        const amountUSD = amount / rate;
        
        // Calculate profit in USD
        const profitUSD = (amountUSD * selectedPlanRate) / 100;
        const totalReturnUSD = amountUSD + profitUSD;
        
        // Convert back to selected currency for display
        const profit = profitUSD * rate;
        const totalReturn = totalReturnUSD * rate;
        
        // Update currency symbols
        document.getElementById('currencySymbolProfit').textContent = symbol;
        document.getElementById('currencySymbolReturn').textContent = symbol;
        
        // Update amounts
        document.getElementById('expectedProfit').textContent = formatNumber(profit);
        document.getElementById('totalReturn').textContent = formatNumber(totalReturn);
        
        // Store USD amount for form submission
        document.getElementById('amount_usd_input').value = amountUSD.toFixed(2);
        
        profitSection.style.display = 'block';
    } else {
        profitSection.style.display = 'none';
    }
}

function setAmount(valueUSD) {
    const rate = rates[currentCurrency] || 1;
    const convertedAmount = valueUSD * rate;
    document.getElementById('amount_input').value = convertedAmount.toFixed(2);
    
    // Remove active class from all preset buttons
    document.querySelectorAll('.amount-preset-btn').forEach(btn => btn.classList.remove('active'));
    
    // Add active class to clicked button
    event.target.classList.add('active');
    
    calculateProfit();
    validateForm();
}

function validateForm() {
    const submitButton = document.getElementById('submitButton');
    const amountInput = document.getElementById('amount_input');
    const walletSelect = document.getElementById('wallet_id');
    
    if (!selectedPlanId || !amountInput || !walletSelect) {
        submitButton.disabled = true;
        return;
    }
    
    const amount = parseFloat(amountInput.value) || 0;
    const walletSelected = walletSelect.value !== '';
    
    // Get current currency conversion
    const rate = rates[currentCurrency] || 1;
    const convertedMin = minAmount * rate;
    const convertedMax = maxAmount * rate;
    
    if (amount >= convertedMin && amount <= convertedMax && walletSelected) {
        submitButton.disabled = false;
    } else {
        submitButton.disabled = true;
    }
}

// Add event listeners for form validation
document.addEventListener('DOMContentLoaded', function() {
    const amountInput = document.getElementById('amount_input');
    const walletSelect = document.getElementById('wallet_id');
    
    if (amountInput) {
        amountInput.addEventListener('input', function() {
            calculateProfit();
            validateForm();
        });
    }
    
    if (walletSelect) {
        walletSelect.addEventListener('change', validateForm);
    }
    
    // Initialize quick amount buttons
    updateQuickAmountButtons();
});

function resetForm() {
    // Reset plan selection
    document.querySelectorAll('.plan-card').forEach(c => c.classList.remove('selected'));
    selectedPlanId = null;
    minAmount = 0;
    maxAmount = 0;
    selectedPlanRate = 0;
    
    // Reset form
    document.getElementById('depositForm').reset();
    document.getElementById('depositFormArea').classList.remove('active');
    document.getElementById('profitDisplaySection').style.display = 'none';
    
    // Remove active class from preset buttons
    document.querySelectorAll('.amount-preset-btn').forEach(btn => btn.classList.remove('active'));
    
    // Disable submit button
    document.getElementById('submitButton').disabled = true;
}

function openGuide() {
    document.getElementById('guideModal').classList.add('active');
}

function closeGuide() {
    document.getElementById('guideModal').classList.remove('active');
}

// Reinvestment validation
@if(session('reinvestment_mode') && session('reinvestment_expires') > now())
window.validateReinvestment = function() {
    const amount = parseFloat(document.getElementById('amount_input').value);
    const rate = rates[currentCurrency] || 1;
    const amountUSD = amount / rate;
    const availableBalance = parseFloat({{ auth()->user()->available_balance }});

    if (amountUSD > availableBalance) {
        const symbol = getCurrencySymbol(currentCurrency);
        alert('Reinvestment amount cannot exceed your available balance of ' + symbol + formatNumber(availableBalance * rate));
        return false;
    }
    return true;
}
@endif
</script>

@endsection