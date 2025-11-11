@extends('layout.user')

@section('content')
@php
$profile = auth()->user()->profile;

// Fetch cryptocurrency wallets
$bitcoin = $profile->bitcoin_address ?? null;
$etherium = $profile->etherium_address ?? null;
$usdt = $profile->usdt_address ?? null;

// Fetch bank details - ALL 6 FIELDS
$recipientName = $profile->recipient_name ?? null;
$bankName = $profile->bank_name ?? null;
$accountNumber = $profile->account_number ?? null;
$iban = $profile->iban ?? null;
$swiftBic = $profile->swift_bic ?? null;
$bankAddress = $profile->bank_address ?? null;

// Check if user has complete bank info
$hasBankInfo = $recipientName && $bankName && ($accountNumber || $iban) && $swiftBic;

// Check if user has any crypto wallet
$hasCryptoWallet = $bitcoin || $etherium || $usdt;
@endphp

@if(!$hasCryptoWallet && !$hasBankInfo)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        alert('You must add a payment method before withdrawing.');
    });
</script>
@endif

{{-- Flash messages --}}
@if(session('success'))
<div class="mb-4 p-3 rounded-lg bg-green-50 text-green-700 border border-green-200 flex justify-between items-center">
    <span>{{ session('success') }}</span>
    @if(session('success') === 'Withdrawal card generated!')
    <a href="{{ route('user.viewCard') }}"
        class="ml-4 px-3 py-1 text-sm rounded-full bg-[#8AC304] text-[#0C3A30] hover:bg-[#7bb502] transition">
        View Card
    </a>
    @endif
</div>
@endif

@if($errors->any())
<div class="mb-4 p-3 rounded-lg bg-red-50 text-red-700 border border-red-200 flex justify-between items-center">
    <span>{{ $errors->first() }}</span>
    @if($errors->first() === 'Please generate your withdrawal card before proceeding.')
    <form method="POST" action="{{ route('withdrawals.generateCard') }}">
        @csrf
        <button type="submit"
            class="ml-4 px-3 py-1 text-sm rounded-full bg-[#8AC304] text-[#0C3A30] hover:bg-[#7bb502] transition">
            Generate Card
        </button>
    </form>
    @endif
</div>
@endif

<div class="max-w-xl mx-auto mt-10 p-6 rounded-2xl shadow-xl border">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-lg font-semibold text-[#0C3A30]">Withdraw Funds</h1>
        <a href="{{ route('user_dashboard') }}" class="text-sm text-gray-600 hover:text-lime-500">← Back to Dashboard</a>
    </div>

    <form action="{{ route('user.balance.withdraw') }}" method="POST" class="space-y-6" id="withdraw-form">
        @csrf

        {{-- Amount --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Withdrawal Amount</label>
            <div class="relative">
                <span class="absolute left-3 top-3 text-gray-500">$</span>
                <input type="number" name="amount" min="1" max="{{ auth()->user()->available_balance }}" 
                    value="{{ old('amount') }}"
                    class="w-full pl-8 pr-4 py-3 rounded-lg border focus:outline-none" 
                    style="border-color: #8AC304;" required>
            </div>
            <p class="mt-1 text-xs text-gray-500">Available: <strong>${{ number_format(auth()->user()->total_income, 2) }}</strong></p>
        </div>

        {{-- Transfer Method --}}
        <div class="relative">
            <label class="block mb-1 text-sm font-medium text-gray-700">Transfer Method</label>
            <div id="custom-dropdown" tabindex="0" 
                class="w-full px-4 py-3 rounded-lg border cursor-pointer flex justify-between items-center hover:border-[#0C3A30]" 
                style="border-color: #8AC304;">
                <span id="selected-option-text">Select transfer method</span>
                <svg class="w-5 h-5 text-gray-400" id="dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>

            <input type="hidden" id="payment_method" name="payment_method" required>

            <div id="dropdown-options" class="absolute mt-1 w-full border rounded-lg shadow-lg hidden z-50"
                style="border-color: #8AC304; background-color: white !important;">
                @if($hasCryptoWallet)
                <div class="option-item px-4 py-3 cursor-pointer hover:bg-[#8AC304] hover:text-[#0C3A30]" data-value="cryptocurrency">
                  Cryptocurrency Wallet
                </div>
                @endif
                @if($hasBankInfo)
                <div class="option-item px-4 py-3 cursor-pointer hover:bg-[#8AC304] hover:text-[#0C3A30]" data-value="digital_wallet">
                     Bank Transfer
                </div>
                @endif
            </div>
        </div>

        {{-- Wallet/Bank Selection --}}
        <div id="wallet-info" class="hidden mt-4 relative"></div>

        {{-- Hidden input for wallet/bank choice --}}
        <input type="hidden" name="wallet_choice" id="wallet_choice_input">

        {{-- PIN --}}
        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Security PIN</label>
            <div class="grid grid-cols-4 gap-2">
                @for ($i = 1; $i <= 4; $i++)
                <input type="password" name="digit{{ $i }}" maxlength="1" required inputmode="numeric"
                    class="pin-input h-12 text-center text-xl rounded-lg border" style="border-color: #8AC304;">
                @endfor
            </div>
        </div>

        {{-- Submit --}}
        <button type="submit" id="submitBtn" 
            class="w-full flex items-center justify-center py-3 px-4 rounded-lg font-medium shadow hover:shadow-md transition" 
            style="background-color: #8AC304; color:#0C3A30; margin-top:2rem;">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
            </svg>
            Initiate Withdrawal
        </button>
    </form>
</div>

{{-- SCRIPT --}}
<script>
    const hasBankInfo = @json($hasBankInfo);
    const hasCryptoWallet = @json($hasCryptoWallet);
    const profileUrl = "{{ route('profile.show') }}";

    // Bank details from database - ALL 6 FIELDS
    const bankDetails = {
        recipientName: @json($recipientName),
        bankName: @json($bankName),
        accountNumber: @json($accountNumber),
        iban: @json($iban),
        swiftBic: @json($swiftBic),
        bankAddress: @json($bankAddress)
    };

    // Crypto wallets
    const cryptoWallets = {
        bitcoin: @json($bitcoin),
        etherium: @json($etherium),
        usdt: @json($usdt)
    };

    document.addEventListener('DOMContentLoaded', () => {
        // Disable submit button on form submit
        document.getElementById('withdraw-form').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Processing...';
            submitBtn.style.backgroundColor = '#B2B2B2';
            submitBtn.style.color = '#333';
        });

        // Handle custom dropdown for payment method
        const dropdown = document.getElementById('custom-dropdown');
        const options = document.getElementById('dropdown-options');
        const selectedText = document.getElementById('selected-option-text');
        const paymentMethodInput = document.getElementById('payment_method');
        const walletInfo = document.getElementById('wallet-info');

        dropdown.addEventListener('click', (e) => {
            options.classList.toggle('hidden');
            e.stopPropagation();
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!dropdown.contains(event.target) && !options.contains(event.target)) {
                options.classList.add('hidden');
            }
        });

        document.querySelectorAll('.option-item').forEach(option => {
            option.addEventListener('click', function() {
                const value = this.dataset.value;
                selectedText.textContent = this.textContent;
                paymentMethodInput.value = value;
                options.classList.add('hidden');

                if (value === 'cryptocurrency') {
                    showCryptoWalletSelection();
                } else if (value === 'digital_wallet') {
                    showBankSelection();
                } else {
                    walletInfo.classList.add('hidden');
                    walletInfo.innerHTML = '';
                }
            });
        });

        // CRYPTOCURRENCY SELECTION
        function showCryptoWalletSelection() {
            walletInfo.classList.remove('hidden');
            walletInfo.innerHTML = `
                <label class="block mb-1 text-sm font-medium text-gray-700">Select Cryptocurrency Wallet</label>
                <div id="wallet-dropdown" tabindex="0"
                    class="w-full px-4 py-3 rounded-lg border cursor-pointer flex justify-between items-center"
                    style="border-color: #8AC304; background-color: white;">
                    <span id="wallet-text">Choose wallet address</span>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>

                <div id="wallet-options" class="absolute z-20 mt-1 border rounded-lg shadow-lg hidden bg-white text-gray-800 w-full max-w-full overflow-auto" style="border-color: #8AC304;">
                    ${cryptoWallets.bitcoin ? `<div class="wallet-item px-4 py-3 cursor-pointer hover:bg-gray-100" data-wallet="bitcoin">🟢 BTC - ${cryptoWallets.bitcoin}</div>` : ''}
                    ${cryptoWallets.etherium ? `<div class="wallet-item px-4 py-3 cursor-pointer hover:bg-gray-100" data-wallet="etherium">🟢 ETH - ${cryptoWallets.etherium}</div>` : ''}
                    ${cryptoWallets.usdt ? `<div class="wallet-item px-4 py-3 cursor-pointer hover:bg-gray-100" data-wallet="usdt">🟢 USDT - ${cryptoWallets.usdt}</div>` : ''}
                    ${!hasCryptoWallet ? `
                        <div class="text-sm text-gray-800 bg-yellow-50 border border-yellow-300 p-4 rounded-lg shadow-sm">
                            <p class="font-semibold text-yellow-800 mb-2">⚠️ Crypto Wallet Required</p>
                            <p class="mb-3">Please add your wallet details to use cryptocurrency payment withdrawal.</p>
                            <a href="${profileUrl}" class="inline-block px-4 py-2 rounded-lg text-white font-medium" style="background-color: #8AC304;">
                                Go to Profile →
                            </a>
                        </div>
                    ` : ''}
                </div>
            `;
            setupWalletDropdownEvents();
        }

        // BANK SELECTION WITH 5% COMMISSION WARNING
        function showBankSelection() {
            walletInfo.classList.remove('hidden');
            walletInfo.innerHTML = `
                <!-- 5% Commission Warning -->
                <div class="mb-4 p-3 rounded-xl border-2 shadow-md" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 50%, #fbbf24 100%); border-color: #f59e0b;">
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center" style="background-color: #f59e0b;">
                            <span class="text-xl">⚠️</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs font-bold text-amber-900 mb-1">5% Bank Transfer Fee Applies</p>
                            <p class="text-xs text-amber-800">
                                bank transfers incur a <strong>5% processing fee</strong>. Crypto withdrawals are <strong>commission-free</strong>.
                            </p>
                        </div>
                    </div>
                </div>

               <label class="block mb-2 text-sm font-medium text-gray-700">Your Bank Account</label>
<div id="bank-dropdown" tabindex="0"
    class="w-full px-4 py-3 rounded-lg border cursor-pointer flex justify-between items-center transition-all duration-200 hover:border-[#8AC304] hover:shadow-md"
    style="border-color: #8AC304; background-color: white;">
    <div class="flex items-center gap-2">
        <div class="w-6 h-6 rounded-md bg-[#8AC304] flex items-center justify-center">
            <span class="text-white text-xs">🏦</span>
        </div>
        <span id="bank-text" class="text-gray-600">View bank details</span>
    </div>
    <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
    </svg>
</div>

<div id="bank-options" class="absolute z-20 mt-1 border rounded-lg shadow-lg hidden bg-white text-gray-800 w-full max-w-full overflow-hidden" style="border-color: #8AC304; max-height: 300px; overflow-y: auto;">
    ${hasBankInfo ? `
        <div class="bank-item cursor-pointer transition-colors duration-150 hover:bg-gray-50 active:bg-gray-100" data-bank="primary">
            <div class="p-4">
                <!-- Bank Header -->
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-[#8AC304] flex items-center justify-center">
                        <span class="text-white text-base">🏦</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-[#0C3A30] text-sm">${bankDetails.bankName || 'Bank Name'}  <span class="inline-block px-2 py-1 rounded text-xs font-medium text-white mt-1" style="background-color: #8AC304;" >Verified</span></p>
                       
                    </div>
                </div>

                <!-- Bank Details -->
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600 font-medium">Recipient:</span>
                        <span class="text-[#0C3A30] font-semibold text-right">${bankDetails.recipientName || 'N/A'}</span>
                    </div>

                    ${bankDetails.accountNumber ? `
                    <div class="flex justify-between">
                        <span class="text-gray-600 font-medium">Account:</span>
                        <span class="text-[#0C3A30] font-mono text-xs text-right break-all">${bankDetails.accountNumber}</span>
                    </div>
                    ` : ''}
                    
                    ${bankDetails.iban ? `
                    <div class="flex justify-between">
                        <span class="text-gray-600 font-medium">IBAN:</span>
                        <span class="text-[#0C3A30] font-mono text-xs text-right break-all">${bankDetails.iban}</span>
                    </div>
                    ` : ''}

                    ${bankDetails.swiftBic ? `
                    <div class="flex justify-between">
                        <span class="text-gray-600 font-medium">SWIFT:</span>
                        <span class="text-[#0C3A30] font-mono text-xs text-right">${bankDetails.swiftBic}</span>
                    </div>
                    ` : ''}
                </div>

                <!-- Selection Hint -->
                <div class="mt-3 pt-3 border-t border-gray-200">
                    <p class="text-xs text-[#8AC304] text-center font-medium" style="background-color: #8AC304; border-radius:7px;">
                        ✓ Click to select
                    </p>
                </div>
            </div>
        </div>
    ` : `
        <div class="p-4 text-center bg-yellow-50 border-b border-yellow-200">
            <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-yellow-100 flex items-center justify-center">
                <span class="text-yellow-600 text-lg">⚠️</span>
            </div>
            <p class="font-semibold text-yellow-800 text-sm mb-1">Bank Info Required</p>
            <p class="text-xs text-yellow-700 mb-3">Add your bank details to withdraw funds</p>
            <a href="${profileUrl}" class="inline-flex items-center px-4 py-2 rounded-lg text-white text-sm font-medium transition-colors duration-200 hover:bg-[#7bb502]" style="background-color: #8AC304;">
                Add Bank Details
            </a>
        </div>
    `}
</div>
            `;
            setupBankDropdownEvents();
        }

        // Wallet dropdown logic
        function setupWalletDropdownEvents() {
            const walletDropdown = document.getElementById('wallet-dropdown');
            const walletOptions = document.getElementById('wallet-options');
            const walletText = document.getElementById('wallet-text');
            const walletChoiceInput = document.getElementById('wallet_choice_input');

            if (!walletDropdown || !walletOptions) return;

            walletDropdown.addEventListener('click', function(e) {
                walletOptions.classList.toggle('hidden');
                e.stopPropagation();
            });

            document.addEventListener('click', function(event) {
                if (!walletDropdown.contains(event.target) && !walletOptions.contains(event.target)) {
                    walletOptions.classList.add('hidden');
                }
            });

            document.querySelectorAll('.wallet-item').forEach(item => {
                item.addEventListener('click', function() {
                    const text = this.textContent;
                    const val = this.dataset.wallet;
                    walletText.textContent = text;
                    walletChoiceInput.value = val;
                    walletOptions.classList.add('hidden');
                });
            });
        }

        // Bank dropdown logic
        function setupBankDropdownEvents() {
            const bankDropdown = document.getElementById('bank-dropdown');
            const bankOptions = document.getElementById('bank-options');
            const bankText = document.getElementById('bank-text');
            const walletChoiceInput = document.getElementById('wallet_choice_input');

            if (!bankDropdown || !bankOptions) return;

            bankDropdown.addEventListener('click', function(e) {
                bankOptions.classList.toggle('hidden');
                e.stopPropagation();
            });

            document.addEventListener('click', function(event) {
                if (!bankDropdown.contains(event.target) && !bankOptions.contains(event.target)) {
                    bankOptions.classList.add('hidden');
                }
            });

            document.querySelectorAll('.bank-item').forEach(item => {
                item.addEventListener('click', function() {
                    const val = this.dataset.bank;
                    const displayText = `${bankDetails.bankName} - ${bankDetails.accountNumber || bankDetails.iban}`;
                    bankText.textContent = displayText;
                    bankText.classList.remove('text-gray-500');
                    bankText.classList.add('text-gray-800');
                    walletChoiceInput.value = val;
                    bankOptions.classList.add('hidden');
                });
            });
        }

        // PIN auto-jump logic + paste support
        const pinInputs = document.querySelectorAll('.pin-input');
        pinInputs.forEach((input, idx) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && idx < pinInputs.length - 1) {
                    pinInputs[idx + 1].focus();
                }
            });
            input.addEventListener('keydown', e => {
                if (e.key === 'Backspace' && input.value === '' && idx > 0) {
                    pinInputs[idx - 1].focus();
                }
            });
        });

        // Allow pasting full PIN
        pinInputs[0].addEventListener('paste', (e) => {
            e.preventDefault();
            const pasteData = (e.clipboardData || window.clipboardData).getData('text');
            const digits = pasteData.replace(/\D/g, '').split('').slice(0, pinInputs.length);

            digits.forEach((digit, i) => {
                pinInputs[i].value = digit;
            });

            if (digits.length === pinInputs.length) {
                pinInputs[pinInputs.length - 1].focus();
            } else if (digits.length > 0) {
                pinInputs[digits.length].focus();
            }
        });
    });
</script>

<style>
    .option-item:hover,
    .wallet-item:hover {
        background-color: #8AC304 !important;
        color: #0C3A30 !important;
    }

    .bank-item:hover {
        background-color: #f0fde4 !important;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(138, 195, 4, 0.15);
    }

    .bank-dropdown:hover {
        border-color: #8AC304 !important;
        box-shadow: 0 0 0 3px rgba(138, 195, 4, 0.1);
    }

    select:focus,
    input:focus,
    #custom-dropdown:focus,
    #wallet-dropdown:focus,
    #bank-dropdown:focus {
        outline: none !important;
        box-shadow: 0 0 0 2px rgba(138, 195, 4, 0.3) !important;
        border-color: #8AC304 !important;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    #bank-options:not(.hidden),
    #wallet-options:not(.hidden),
    #dropdown-options:not(.hidden) {
        animation: slideDown 0.2s ease-out;
    }

    /* Compact scrollbar */
    #bank-options::-webkit-scrollbar {
        width: 4px;
    }

    #bank-options::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 2px;
    }

    #bank-options::-webkit-scrollbar-thumb {
        background: #8AC304;
        border-radius: 2px;
    }
</style>

@endsection