@extends('layout.user')

@section('content')




<!-- Add this near the top of the file, after the breadcrumb -->
@if(session('reinvestment_mode') && session('reinvestment_expires') > now())
<div class="alert alert-warning mb-4 px-6" style="background-color:#9EDD05 !important; ">
    <div class="flex items-center">
        <iconify-icon icon="solar:refresh-circle-outline" class="mr-2"></iconify-icon>
        <span>You are in reinvestment mode. available balance (${{ number_format(auth()->user()->available_balance, 2) }}).</span>
        <button
            onclick="location.href='{{ route('user_dashboard') }}'"
            class="ml-4 text-sm underline font-semibold hover:text-red-600 transition-colors duration-200"
            style="color: #000000;">
            Cancel
        </button>
    </div>
</div>
@endif

<!-- Modify the form opening tag -->
<form action="{{ route('user.make-deposit') }}" method="POST" class="space-y-6"
    @if(session('reinvestment_mode') && session('reinvestment_expires')> now()) onsubmit="return validateReinvestment()" @endif>
    @csrf

    @if(session('reinvestment_mode') && session('reinvestment_expires') > now())
    <input type="hidden" name="reinvestment" value="1">
    @endif

    <!-- Rest of the form -->
</form>

<!-- Add this script at the bottom -->
<script>
    function validateReinvestment() {
        const amount = parseFloat(document.getElementById('amount').value);
        const availableBalance = parseFloat({
            {
                auth() - > user() - > available_balance
            }
        });

        if (amount > availableBalance) {
            alert('Reinvestment amount cannot exceed your available balance of $' + availableBalance.toFixed(2));
            return false;
        }
        return true;
    }
</script>

<!-- Choices.js CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

<style>
    .choices__item--selectable.is-highlighted,
    .choices__item--selectable.is-selected {
        background-color: #8AC304 !important;
        color: #0C3A30 !important;
    }

    select.form-control,
    .form-control {
        border: none;
        border-top: 4px solid #8AC304;
        border-radius: 0.5rem;
        background-color: white;
        font-weight: 600;
        color: #0C3A30;
    }

    input#amount.form-control {
        border: 1.5px solid #9EDD05;
        font-weight: 600;
    }

    input#amount.form-control:hover,
    input#amount.form-control:focus {
        border-color: #9EDD05;
        box-shadow: 0 0 5px rgba(158, 221, 5, 0.6);
        outline: none;
        background-color: white;
        color: #0C3A30;
    }

    .choices__inner {
        border: none !important;
        border-top: 4px solid #8AC304 !important;
        border-radius: 0.5rem !important;
        background-color: white !important;
        font-weight: bold;
        color: #0C3A30 !important;
    }

    .choices__placeholder {
        color: #0C3A30 !important;
        opacity: 0.7;
    }

    .btn-custom {
        background-color: #9EDD05;
        color: #0C3A30;
        font-weight: 600;
        padding: 0.75rem 2.5rem;
        border-radius: 0.5rem;
        transition: background-color 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-custom:hover {
        background-color: #8AC304;
        color: #0C3A30;
    }

    /* Extra styling for disabled spacer options */
    select option[disabled] {
        color: transparent;
        background-color: transparent;
        cursor: default;
        /* You can add spacing with line-height */
        line-height: 1.8;
        user-select: none;
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

    <!-- Plans Table -->
    <!-- Plans Table -->
    <div class="grid grid-cols-12 mb-8">
        <div class="col-span-12">
            <div class="card rounded-xl p-6" style="background-image: url(assets/images/hero/hero-image-1.svg);">

                <!-- ✅ Marquee banner placed OUTSIDE scrollable area -->


                @php
                $totalInvested = (float) auth()->user()->amount_invested;
                @endphp

                <style>
                    @keyframes scrollText {
                        0% {
                            transform: translateX(100%);
                        }

                        100% {
                            transform: translateX(-100%);
                        }
                    }

                    .animate-marquee {
                        animation: scrollText 10s linear infinite !important;
                        white-space: nowrap !important;
                    }

                    .animate-marquee:hover {
                        animation-play-state: paused !important;
                    }
                </style>

                @if($totalInvested == 0)
                <!-- Banner for users who have not yet invested -->
                <div class="relative overflow-hidden rounded-xl bg-gradient-to-r from-yellow-100 to-white mb-4"
                    style="box-shadow: 0 4px 24px rgba(234, 179, 8, 0.15); border: 1px solid rgba(234, 179, 8, 0.3) !important;">
                    <div class="absolute inset-y-0 left-0 w-16 bg-gradient-to-r from-yellow-100 to-transparent z-10 pointer-events-none"></div>
                    <div class="absolute inset-y-0 right-0 w-16 bg-gradient-to-l from-yellow-100 to-transparent z-10 pointer-events-none"></div>
                    <div class="py-3 overflow-hidden bg-white">
                        <div class="animate-marquee inline-flex items-center will-change-transform">
                            <span class="inline-flex items-center px-6 text-base font-medium text-yellow-800 tracking-tight">
                                <span class="text-yellow-500/90 mr-3 text-lg">⚠️</span>
                                <span class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-yellow-700 font-semibold" style="background-clip: text !important; -webkit-background-clip: text !important;">
                                    You haven’t started investing yet. Start strong to see strong returns!
                                </span>
                                <span class="mx-4 text-yellow-400">•</span>
                                <span>Top investors began with $20,000+ and earn $10k+ daily! Trust the process.</span>
                                <span class="ml-4 px-3 py-0.5 rounded-full text-yellow-700 text-xs font-bold border border-yellow-400/20"
                                    style="background-color: rgba(234, 179, 8, 0.1) !important;">
                                    GET STARTED
                                </span>
                            </span>
                        </div>
                    </div>
                </div>

                @elseif($totalInvested >= 80000)
                <!-- Premium Banner for users who invested >= 80,000 -->
                <div class="relative overflow-hidden rounded-xl bg-gradient-to-r from-purple-100 to-white mb-4"
                    style="box-shadow: 0 4px 24px rgba(139, 92, 246, 0.15); border: 1px solid rgba(139, 92, 246, 0.3) !important;">
                    <div class="absolute inset-y-0 left-0 w-16 bg-gradient-to-r from-purple-100 to-transparent z-10 pointer-events-none"></div>
                    <div class="absolute inset-y-0 right-0 w-16 bg-gradient-to-l from-purple-100 to-transparent z-10 pointer-events-none"></div>
                    <div class="py-3 overflow-hidden bg-white">
                        <div class="animate-marquee inline-flex items-center will-change-transform">
                            <span class="inline-flex items-center px-6 text-base font-medium text-gray-700 tracking-tight">
                                <span class="text-purple-600/90 mr-3 text-lg">🌟🌟🌟🌟🌟</span>
                                <span class="bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-indigo-600 font-semibold" style="background-clip: text !important; -webkit-background-clip: text !important;">
                                    You're eligible to become a shareholder — unlock premium investor benefits now!
                                </span>
                                <span class="mx-4 text-purple-300">•</span>
                                <span>Contact us to join the inner circle of investors</span>
                                <span class="ml-4 px-3 py-0.5 rounded-full text-purple-700 text-xs font-bold border border-purple-400/20"
                                    style="background-color: rgba(139, 92, 246, 0.1) !important;">
                                    ANBASSADORSHIP
                                </span>
                            </span>
                        </div>
                    </div>
                </div>

                @else
                <!-- Mid-tier banner -->
                <div class="relative overflow-hidden rounded-xl bg-gradient-to-r from-amber-50 to-white mb-4"
                    style="box-shadow: 0 4px 24px rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.2) !important;">
                    <div class="absolute inset-y-0 left-0 w-16 bg-gradient-to-r from-amber-50 to-transparent z-10 pointer-events-none"></div>
                    <div class="absolute inset-y-0 right-0 w-16 bg-gradient-to-l from-amber-50 to-transparent z-10 pointer-events-none"></div>
                    <div class="py-3 overflow-hidden bg-white">
                        <div class="animate-marquee inline-flex items-center will-change-transform">
                            <span class="inline-flex items-center px-6 text-base font-medium text-gray-600 tracking-tight">
                                <span class="text-amber-500/90 mr-3 text-lg" style="color: #ffef0eff;">✦ ✦ ✦ ✦ ✦</span>
                                <span class="bg-clip-text text-transparent bg-gradient-to-r from-amber-400 to-yellow-600 font-semibold" style="background-clip: text !important; -webkit-background-clip: text !important;">
                                    Reinvestment unlocked at $50,000 and above
                                </span>
                                <span class="mx-4 text-amber-300">•</span>
                                <span>Exclusive Ambassadorship features available</span>
                                <span class="ml-4 px-3 py-0.5 rounded-full text-amber-700 text-xs font-bold border border-amber-400/20"
                                    style="background-color: rgba(245, 158, 11, 0.1) !important;">
                                    NEW
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                @endif


                <!-- ✅ Scrollable table area -->
                <!-- ✅ Currency Switcher Above Table -->
               <div class="flex justify-end items-center mb-4">
    <label for="currency" class="mr-2 font-semibold text-gray-700">Currency:</label>
    <select id="currencySwitcher" class="border rounded-lg px-2 py-1 text-sm">
        <option value="USD" selected>🇺🇸 USD</option>
        <option value="EUR">🇪🇺 EUR</option>
        <option value="GBP">🇬🇧 GBP</option>
        <option value="NGN">🇳🇬 NGN</option>
        <option value="AUD">🇦🇺 AUD</option>
        <option value="CAD">🇨🇦 CAD</option>
        <option value="JPY">🇯🇵 JPY</option>
        <option value="CNY">🇨🇳 CNY</option>
        <option value="INR">🇮🇳 INR</option>
        <option value="BRL">🇧🇷 BRL</option>
        <option value="MXN">🇲🇽 MXN</option>
        <option value="RUB">🇷🇺 RUB</option>
        <option value="ZAR">🇿🇦 ZAR</option>
        <option value="CHF">🇨🇭 CHF</option>
        <option value="AED">🇦🇪 AED</option>
        <option value="AFN">🇦🇫 AFN</option>
        <option value="ALL">🇦🇱 ALL</option>
        <option value="AMD">🇦🇲 AMD</option>
        <option value="ARS">🇦🇷 ARS</option>
        <option value="AZN">🇦🇿 AZN</option>
        <option value="BDT">🇧🇩 BDT</option>
        <option value="BGN">🇧🇬 BGN</option>
        <option value="BHD">🇧🇭 BHD</option>
        <option value="BMD">🇧🇲 BMD</option>
        <option value="BOB">🇧🇴 BOB</option>
        <option value="CLP">🇨🇱 CLP</option>
        <option value="COP">🇨🇴 COP</option>
        <option value="CRC">🇨🇷 CRC</option>
        <option value="CZK">🇨🇿 CZK</option>
        <option value="DKK">🇩🇰 DKK</option>
        <option value="DOP">🇩🇴 DOP</option>
        <option value="EGP">🇪🇬 EGP</option>
        <option value="FJD">🇫🇯 FJD</option>
        <option value="GHS">🇬🇭 GHS</option>
        <option value="HKD">🇭🇰 HKD</option>
        <option value="HUF">🇭🇺 HUF</option>
        <option value="IDR">🇮🇩 IDR</option>
        <option value="ILS">🇮🇱 ILS</option>
        <option value="IQD">🇮🇶 IQD</option>
        <option value="ISK">🇮🇸 ISK</option>
        <option value="JOD">🇯🇴 JOD</option>
        <option value="KES">🇰🇪 KES</option>
        <option value="KRW">🇰🇷 KRW</option>
        <option value="KWD">🇰🇼 KWD</option>
        <option value="KZT">🇰🇿 KZT</option>
        <option value="LBP">🇱🇧 LBP</option>
        <option value="LKR">🇱🇰 LKR</option>
        <option value="MAD">🇲🇦 MAD</option>
        <option value="MYR">🇲🇾 MYR</option>
        <option value="NGN">🇳🇬 NGN</option>
        <option value="NOK">🇳🇴 NOK</option>
        <option value="NZD">🇳🇿 NZD</option>
        <option value="OMR">🇴🇲 OMR</option>
        <option value="PEN">🇵🇪 PEN</option>
        <option value="PHP">🇵🇭 PHP</option>
        <option value="PKR">🇵🇰 PKR</option>
        <option value="PLN">🇵🇱 PLN</option>
        <option value="QAR">🇶🇦 QAR</option>
        <option value="RON">🇷🇴 RON</option>
        <option value="SAR">🇸🇦 SAR</option>
        <option value="SEK">🇸🇪 SEK</option>
        <option value="SGD">🇸🇬 SGD</option>
        <option value="THB">🇹🇭 THB</option>
        <option value="TRY">🇹🇷 TRY</option>
        <option value="UAH">🇺🇦 UAH</option>
        <option value="UYU">🇺🇾 UYU</option>
        <option value="VEF">🇻🇪 VEF</option>
        <option value="VND">🇻🇳 VND</option>
        <option value="XAF">🇨🇲 XAF</option>
        <option value="XOF">🇸🇳 XOF</option>
        <option value="YER">🇾🇪 YER</option>
        <option value="ZMW">🇿🇲 ZMW</option>
        <!-- Add more currencies if needed -->
    </select>
</div>


                <!-- ✅ Scrollable Table Area -->
                <div class="overflow-x-auto w-full">
                    <div class="w-full min-w-[600px] sm:min-w-0">
                        <table class="table w-full whitespace-nowrap text-sm">
                            <thead style="background: #fff !important;">
                                <tr>
                                    <th class="text-left">#</th>
                                    <th class="text-left">Plan Name</th>
                                    <th class="text-left">Min Deposit (<span id="currencySymbol">$</span>)</th>
                                    <th class="text-left">Max Deposit (<span id="currencySymbol2">$</span>)</th>
                                    <th class="text-left">Duration</th>
                                    <th class="text-left">Interest Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plans as $index => $plan)
                                <tr class="hover:bg-green-50">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ ucfirst($plan->name) }}</td>
                                    <td class="min-amount" data-usd="{{ $plan->minimum_amount }}">
                                        {{ number_format($plan->minimum_amount, 2) }}
                                    </td>
                                    <td class="max-amount" data-usd="{{ $plan->maximum_amount }}">
                                        {{ number_format($plan->maximum_amount, 2) }}
                                    </td>
                                    <td>{{ $plan->duration }} Day{{ $plan->duration > 1 ? 's' : '' }}</td>
                                    <td>{{ rtrim(rtrim($plan->interest_rate, '0'), '.') }}%</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ✅ Script for Currency Conversion -->
                <script>
                    const rates = {};

                    // Fetch exchange rates from ExchangeRate-API
                 
                    fetch('https://v6.exchangerate-api.com/v6/a8e67b756f551b68d4ada293/latest/USD')
                        .then(response => response.json())
                        .then(data => {
                            if (data.result === 'success') {
                                Object.assign(rates, data.conversion_rates);
                                document.getElementById('currencySwitcher').disabled = false;
                            } else {
                                console.error('Failed to fetch exchange rates:', data.error);
                            }
                        })
                        .catch(error => console.error('Error fetching exchange rates:', error));

                    // Event listener for currency selection
                    document.getElementById('currencySwitcher').addEventListener('change', function() {
                        const currency = this.value;
                        const symbol = getCurrencySymbol(currency);
                        document.getElementById('currencySymbol').textContent = symbol;
                        document.getElementById('currencySymbol2').textContent = symbol;

                        // Update table with converted values
                        document.querySelectorAll('.min-amount').forEach(td => {
                            const usd = parseFloat(td.dataset.usd);
                            td.textContent = (usd * rates[currency]).toLocaleString(undefined, {
                                minimumFractionDigits: 2
                            });
                        });

                        document.querySelectorAll('.max-amount').forEach(td => {
                            const usd = parseFloat(td.dataset.usd);
                            td.textContent = (usd * rates[currency]).toLocaleString(undefined, {
                                minimumFractionDigits: 2
                            });
                        });
                    });

                    // Function to get currency symbol
                    function getCurrencySymbol(currency) {
                        const symbols = {
                            USD: '$',
                            EUR: '€',
                            GBP: '£',
                            NGN: '₦',
                            // Add more symbols as needed
                        };
                        return symbols[currency] || currency;
                    }
                </script>


            </div>
        </div>
    </div>




    <style>
        th,
        td {
            border-right: 1px solid #ccc;
        }

        th:last-child,
        td:last-child {
            border-right: none;
            /* optional: hide last right border */
        }
    </style>
    <!-- Deposit Form -->
    <div class="card p-10 max-w-3xl mx-auto" style="background-image: url(assets/images/hero/hero-image-1.svg);">
        <p class="mb-6 text-lg font-semibold text-neutral-900">Choose An Investment Plan to Deposit</p>

        <form action="{{ route('user.make-deposit') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid md:grid-cols-2 gap-6">

                <!-- Package Select -->
                <div>
                    <label for="plan_id" class="block mb-2 font-bold text-neutral-900">
                        Select Package <span class="text-red-600">*</span>
                    </label>

                    <select name="plan_id" id="plan_id" class="w-full px-4 py-3 border-0 bg-gray-100 rounded-xl focus:ring-2 focus:ring-purple-500 focus:bg-white transition-all shadow-inner">
                        <option value="" disabled selected class="text-gray-500 font-medium py-3">📈 Choose Investment Package</option>

                        @foreach($plans->groupBy('duration') as $duration => $durationPlans)
                        <optgroup label="⏳ {{ $duration }} Day Plan • {{ $durationPlans->count() }} Options"

                            class="text-lg font-bold" style="background-color: #eefdea; padding: 15px 20px; margin: 20px 0; border-bottom: 2px solid #0C3A30;">
                            @foreach($durationPlans as $plan)
                            @php
                            $label = $plan->name . ' → ' . rtrim(rtrim($plan->interest_rate, '0'), '.') . '%';
                            @endphp

                            <option value="{{ $plan->id }}"
                                {{ old('plan_id') == $plan->id ? 'selected' : '' }}
                                class="py-3 px-4 my-2 rounded-lg hover:bg-green-50 transition-all duration-200">
                                <div class="flex justify-between items-center">
                                    <span class="font-medium">📈 {{ ucfirst($plan->name) }}</span>
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-bold">
                                        {{ rtrim(rtrim($plan->interest_rate, '0'), '.') }}%
                                    </span>
                                </div>
                            </option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>

                    <style>
                        select {
                            border-radius: 12px !important;
                        }

                        select optgroup {
                            padding: 15px 20px;
                            margin: 25px 0 10px 0 !important;
                            background-color: #f8faf7;
                            font-weight: bold;
                            font-size: 1.05rem;
                            color: #0C3A30;
                            border-top: 2px solid #9EDD05;
                            border-bottom: 2px solid #9EDD05;
                        }

                        select optgroup+optgroup {
                            margin-bottom: 35px !important;
                        }

                        select option {
                            padding: 12px 15px !important;
                            margin: 2px 0 !important;
                            border-radius: 8px;
                            transition: all 0.2s ease;
                        }

                        select option:hover {
                            background-color: #f0f7ed !important;
                        }

                        select option:checked {
                            background-color: #9EDD05 !important;
                            color: white !important;
                        }
                    </style>

                    <span class="text-red-600 text-sm mt-1 block">@error('plan_id'){{ $message }}@enderror</span>
                </div>

                <!-- Wallet Select -->
                <div>
                    <label for="wallet_id" class="block mb-2 font-bold text-neutral-900">
                        Select Wallet To Deposit <span class="text-red-600">*</span>
                    </label>
                    <select name="wallet_id" id="wallet_id" class="form-control">
                        <option selected disabled class="text-gray-500 font-medium">Choose Wallet </option>
                        @foreach($wallets as $wallet)
                        <option value="{{ $wallet->id }}" {{ old('wallet_id') == $wallet->id ? 'selected' : '' }}>
                            🔗 {{ ucfirst($wallet->crypto_name) }}
                        </option>
                        @endforeach
                    </select>
                    <span class="text-red-600 text-sm mt-1 block">@error('wallet_id'){{ $message }}@enderror</span>
                </div>

                <!-- Amount -->
                <div class="md:col-span-2">
                    <label for="amount" class="block mb-2 font-bold text-neutral-900">
                        Amount <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="amount" id="amount"
                        class="form-control w-full px-3 py-2"
                        value="{{ old('amount') }}" placeholder="Enter amount">
                    <span class="text-red-600 text-sm mt-1 block">@error('amount'){{ $message }}@enderror</span>

                    <!-- Preset Amount Buttons -->
                    <div class="flex flex-wrap gap-2 mb-3">
                        @foreach([500, 1000, 2000, 5000, 10000] as $preset)
                        <button type="button"
                            onclick="addToAmount({{ $preset }})"
                            class="px-3 py-1.5 bg-gray-100 text-gray-800 rounded-lg hover:bg-green-100 border border-gray-300 text-sm shadow-sm transition">
                            ${{ number_format($preset) }}
                        </button>
                        @endforeach
                    </div>
                </div>

                <!-- Buttons -->
                <div class="md:col-span-2 flex justify-center gap-6 mt-4">
                    <button type="reset"
                        class="px-10 py-3 border-2 border-red-600 text-red-600 rounded-lg hover:bg-red-100 transition">
                        Reset
                    </button>
                    <button type="submit" class="btn-custom">
                        Continue
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Choices.js -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Choices('#plan_id', {
            searchEnabled: false,
            itemSelectText: '',
            shouldSort: false
        });

        new Choices('#wallet_id', {
            searchEnabled: false,
            itemSelectText: '',
            shouldSort: false
        });
    });

    function addToAmount(value) {
        const input = document.getElementById('amount');
        const current = parseInt(input.value.replace(/[^\d]/g, '')) || 0;
        input.value = current + value;
    }
</script>

@endsection