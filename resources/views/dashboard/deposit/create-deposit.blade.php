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

    * {
        box-sizing: border-box;
    }

    .dashboard-main-body {
        max-width: 100%;
        overflow-x: hidden;
    }

    .deposit-card {
        border: 2px solid #e5e7eb;
        border-radius: 16px;
        padding: 2rem;
        transition: all 0.3s ease;
        background: white;
        position: relative;
        overflow: hidden;
        background-size: cover;
        background-position: center;
        margin-bottom: 1.5rem;
        background-image: url('{{ asset('assets/images/hero/hero-image-1.svg') }}');
    }

    .deposit-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-green), var(--accent-green));
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .deposit-card:hover::before {
        opacity: 1;
    }

    .generator-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        text-align: center;
    }

    .generate-btn {
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%);
        color: var(--dark-green);
        font-weight: 700;
        padding: 1rem 2rem;
        border-radius: 50px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1.1rem;
        box-shadow: 0 4px 15px rgba(158, 221, 5, 0.3);
    }

    .generate-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(158, 221, 5, 0.4);
    }

    .generate-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .generation-messages {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1rem;
        margin-top: 1.5rem;
        text-align: left;
        border-left: 3px solid var(--primary-green);
    }

    .message-item {
        padding: 0.25rem 0;
        font-size: 0.8rem;
        color: #4a5568;
        font-family: monospace;
    }

    .wallet-option {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 1rem;
        cursor: pointer;
        transition: all 0.2s ease;
        background: white;
        position: relative;
        height: 100%;
        display: block;
    }

    .wallet-option:hover {
        border-color: var(--primary-green);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(158, 221, 5, 0.1);
    }

    .wallet-option.selected {
        border-color: var(--primary-green);
        background: linear-gradient(135deg, #ffffff 0%, #f0f7ed 100%);
        box-shadow: 0 4px 12px rgba(158, 221, 5, 0.2);
    }

    .wallet-option input[type="radio"] {
        display: none;
    }

    .wallet-checkmark {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: var(--primary-green);
        display: none;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 12px;
    }

    .wallet-option.selected .wallet-checkmark {
        display: flex;
        animation: checkPop 0.3s ease;
    }

    @keyframes checkPop {
        0%   { transform: scale(0); }
        50%  { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    .crypto-logo-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        flex-shrink: 0;
    }

    .crypto-logo-wrapper img {
        width: 34px;
        height: 34px;
        object-fit: contain;
    }

    .amount-preset-btn {
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-weight: 600;
        color: var(--dark-green);
        transition: all 0.2s ease;
        cursor: pointer;
        min-width: 80px;
    }

    .amount-preset-btn:hover {
        border-color: var(--primary-green);
        background: #f8faf7;
    }

    .amount-preset-btn.active {
        background: var(--primary-green);
        border-color: var(--primary-green);
        color: var(--dark-green);
    }

    .continue-btn {
        background: var(--primary-green);
        color: var(--dark-green);
        font-weight: 600;
        padding: 0.75rem 2.5rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .continue-btn:hover {
        background: var(--accent-green);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(158, 221, 5, 0.3);
    }

    .continue-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }

    .info-box {
        background: linear-gradient(135deg, #f8faf7 0%, #eef7ea 100%);
        border-radius: 12px;
        padding: 1.5rem;
        border-left: 4px solid var(--primary-green);
    }

    .step-indicator {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .step {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .step-number {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #e5e7eb;
        color: #6b7280;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .step.active .step-number {
        background: var(--primary-green);
        color: var(--dark-green);
    }

    .step-line {
        width: 50px;
        height: 2px;
        background: #e5e7eb;
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
        max-width: 500px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        padding: 2rem;
    }

    .guide-step {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
        padding: 1rem;
        background: #f9fafb;
        border-radius: 10px;
    }

    .guide-step .step-number {
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

    .toast-notification {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: linear-gradient(135deg, var(--primary-green), var(--accent-green));
        color: var(--dark-green);
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        z-index: 9999;
        animation: slideInRight 0.3s ease-out;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(100px); }
        to   { opacity: 1; transform: translateX(0); }
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>

<div class="dashboard-main-body">

    <!-- Breadcrumb -->
    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h5 class="font-semibold mb-0" style="color: #0C3A30;">Deposit Funds</h5>
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

    <!-- Step Indicator -->
    <div class="step-indicator mt-3">
        <div class="step active">
            <div class="step-number">1</div>
            <span class="text-sm font-medium" style="color: var(--dark-green);">Choose Wallet</span>
        </div>
        <div class="step-line"></div>
        <div class="step">
            <div class="step-number">2</div>
            <span class="text-sm text-gray-500">Enter Amount</span>
        </div>
        <div class="step-line"></div>
        <div class="step">
            <div class="step-number">3</div>
            <span class="text-sm text-gray-500">Confirm</span>
        </div>
    </div>

    <!-- Header with Help Guide -->
    <div class="flex items-center justify-between gap-4 mb-6">
        <button type="button" onclick="openGuide()" class="flex items-center gap-2 px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition">
            <iconify-icon icon="ph:question-fill" class="text-lg"></iconify-icon>
            <span class="font-semibold">How to Deposit</span>
        </button>
    </div>

    <!-- Main Deposit Card -->
    <div class="deposit-card">
        <form action="{{ route('user.make-deposit') }}" method="POST" id="depositForm">
            @csrf

            <!-- Generator Section -->
            <div id="generatorSection" class="generator-section">
                <h3 class="text-2xl font-bold mb-2" style="color: var(--dark-green);">Generate Your Secure Wallet</h3>
                <p class="text-gray-600 mb-4">Click the button below to generate your personal deposit wallets</p>
                <button type="button" onclick="generateWallets()" class="generate-btn" id="generateBtn">
                    Generate Secure Wallet
                </button>
                <div id="generationMessages" style="display: none;" class="generation-messages">
                    <div id="messagesList"></div>
                </div>
                <button type="button" onclick="handleOtherPayment()" 
    class="generate-btn" 
    style="background: #e5e7eb; color: #0C3A30; box-shadow: none;">
    
    Other Payment Methods
</button>
            </div>

            <!-- Step 1: Select Wallet (Hidden initially) -->
            <div class="mb-8" id="walletSection" style="display: none;">
                <h4 class="text-lg font-semibold mb-4" style="color: #0C3A30;">1. Choose Payment Method</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4" id="walletOptionsGrid">
                    <!-- Wallet options populated by JS -->
                </div>
                @error('wallet_id')
                    <span class="text-red-600 text-sm mt-2 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Step 2: Enter Amount (Hidden initially) -->
            <div class="mb-8" id="amountSection" style="display: none;">
                <h4 class="text-lg font-semibold mb-4" style="color: #0C3A30;">2. Enter Amount</h4>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">Amount to Deposit</label>
                        <div class="relative">
                            <span class="absolute left-3 top-3 text-gray-500 font-semibold" id="inputCurrencySymbol">$</span>
                            <input type="number" name="amount" id="amount_input" step="0.01"
                                class="w-full p-3 pl-8 border-2 border-gray-200 rounded-lg focus:border-[#9EDD05] focus:outline-none"
                                placeholder="0.00" required>
                        </div>
                        <input type="hidden" name="amount_usd" id="amount_usd_input">
                        <div class="flex justify-between mt-2 text-sm">
                            <span class="text-gray-500">No minimum</span>
                            <span class="text-gray-500">No maximum</span>
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">Quick Select</label>
                        <div class="flex flex-wrap gap-2" id="quickAmountButtons"></div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons (Hidden initially) -->
            <div class="flex justify-center gap-4 mt-8 pt-6 border-t border-gray-200" id="actionButtons" style="display: none;">
                <button type="button" onclick="resetForm()"
                    class="px-8 py-3 border-2 border-red-500 text-red-500 rounded-lg hover:bg-red-50 transition">
                    Reset
                </button>
                <button type="submit" id="submitButton" class="continue-btn" disabled>
                    Continue to Payment
                </button>
            </div>
        </form>
    </div>

    <!-- Info Card -->
    <div class="info-box">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-[#9EDD05] bg-opacity-20 flex items-center justify-center flex-shrink-0">
                <iconify-icon icon="ph:info-fill" style="color: #9EDD05;" class="text-xl"></iconify-icon>
            </div>
            <div>
                <h5 class="font-semibold mb-2" style="color: #0C3A30;">Deposit Information</h5>
                <p class="text-sm text-gray-600">
                    After clicking Continue, you'll receive a wallet address to send your payment.
                    Deposits are processed within 1–10 minutes after blockchain confirmation from your trader.
                    Funds will be added to your available balance once approved.
                </p>
            </div>
        </div>
    </div>

</div>

<!-- Funding Guide Modal -->
<div class="guide-modal" id="guideModal" onclick="if(event.target === this) closeGuide()">
    <div class="guide-modal-content">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold" style="color: #0C3A30;">Deposit Guide</h3>
            <button onclick="closeGuide()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <div class="space-y-3">
            <div class="guide-step">
                <div class="step-number">1</div>
                <div>
                    <div class="font-bold">Choose Payment Method</div>
                    <div class="text-sm text-gray-600">Select your preferred cryptocurrency wallet</div>
                </div>
            </div>
            <div class="guide-step">
                <div class="step-number">2</div>
                <div>
                    <div class="font-bold">Enter Amount</div>
                    <div class="text-sm text-gray-600">Input the amount you want to deposit</div>
                </div>
            </div>
            <div class="guide-step">
                <div class="step-number">3</div>
                <div>
                    <div class="font-bold">Copy Wallet Address</div>
                    <div class="text-sm text-gray-600">Copy the generated wallet address</div>
                </div>
            </div>
            <div class="guide-step">
                <div class="step-number">4</div>
                <div>
                    <div class="font-bold">Send Payment</div>
                    <div class="text-sm text-gray-600">Send crypto from your exchange or wallet</div>
                </div>
            </div>
            <div class="guide-step">
                <div class="step-number">5</div>
                <div>
                    <div class="font-bold">Upload Proof</div>
                    <div class="text-sm text-gray-600">Submit transaction screenshot for verification</div>
                </div>
            </div>
        </div>
        <div class="mt-6 p-4 bg-yellow-50 rounded-lg">
            <p class="text-sm text-yellow-800">
                <strong>⏱️ Processing Time:</strong> 1–10 minutes after network confirmation
            </p>
        </div>
    </div>
</div>

<script>
    const rates = {};
    let currentCurrency = 'USD';
    let selectedWallet = null;

    const quickAmountsUSD = [1000, 2000, 5000, 10000];

    const generationMessages = [
        "Initializing secure wallet generator...",
        "Connecting to blockchain network...",
        "Establishing secure encryption...",
        "Secure connection established",
        "Generating Bitcoin wallet...",
        "Bitcoin wallet generated successfully",
        "Generating Ethereum wallet...",
        "Ethereum wallet generated successfully",
        "Generating USDT wallet...",
        "USDT wallet generated successfully",
        "Securing wallets with multi-layer encryption...",
        "All wallets generated successfully."
    ];

    // -------------------------------------------------------
    // CRYPTO LOGO HELPER
    // The spothq CDN uses lowercase filenames (btc.png, eth.png).
    // We convert whatever comes from the DB to lowercase and build
    // the URL dynamically. If the coin is not in the supported list
    // we fall back to generic.png so you never see a broken image.
    // -------------------------------------------------------
    const supportedCoins = [
        'btc','eth','usdt','bnb','sol','xrp','ada','doge','ltc','trx',
        'matic','link','dot','avax','uni','atom','xlm','algo','vet','icp',
        'fil','egld','theta','xtz','eos','cake','aave','grt','mkr','comp',
        'snx','crv','yfi','bat','zec','dash','xmr','neo','waves','hbar',
        'near','ftm','one','usdc','busd','shib','apt','arb','op','sui'
    ];

    function getCryptoLogo(symbol) {
        const lower = (symbol || '').toLowerCase().trim();
        const base  = 'https://cdn.jsdelivr.net/gh/spothq/cryptocurrency-icons@master/128/color/';
        return supportedCoins.includes(lower)
            ? base + lower + '.png'
            : base + 'generic.png';
    }

    // -------------------------------------------------------
    // EXCHANGE RATES
    // -------------------------------------------------------
    fetch('https://v6.exchangerate-api.com/v6/a8e67b756f551b68d4ada293/latest/USD')
        .then(r => r.json())
        .then(data => {
            if (data.result === 'success') {
                Object.assign(rates, data.conversion_rates);
                updateQuickAmountButtons();
            }
        })
        .catch(() => {
            rates.USD = 1;
            rates.EUR = 0.92;
            rates.GBP = 0.79;
            rates.NGN = 1500;
            updateQuickAmountButtons();
        });

    function getCurrencySymbol(currency) {
        return { USD: '$', EUR: '€', GBP: '£', NGN: '₦' }[currency] || '$';
    }

    function updateCurrencySymbol() {
        const el = document.getElementById('inputCurrencySymbol');
        if (el) el.textContent = getCurrencySymbol(currentCurrency);
    }

    function formatNumber(num) {
        return num.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function updateQuickAmountButtons() {
        const rate     = rates[currentCurrency] || 1;
        const symbol   = getCurrencySymbol(currentCurrency);
        const container = document.getElementById('quickAmountButtons');
        if (!container) return;
        container.innerHTML = '';
        quickAmountsUSD.forEach(amountUSD => {
            const btn = document.createElement('button');
            btn.type      = 'button';
            btn.className = 'amount-preset-btn';
            btn.onclick   = (e) => setAmount(amountUSD, e);
            btn.textContent = symbol + formatNumber(amountUSD * rate);
            container.appendChild(btn);
        });
    }

    function setAmount(valueUSD, event) {
        const rate = rates[currentCurrency] || 1;
        document.getElementById('amount_input').value    = (valueUSD * rate).toFixed(2);
        document.getElementById('amount_usd_input').value = valueUSD.toFixed(2);
        document.querySelectorAll('.amount-preset-btn').forEach(b => b.classList.remove('active'));
        event.target.classList.add('active');
        validateForm();
    }


    function handleOtherPayment() {
    showToast("Other payment system is not available now. Please proceed to use cryptocurrency payment to fund your account.");
}   


    function validateForm() {
        const submitBtn = document.getElementById('submitButton');
        const amount    = parseFloat(document.getElementById('amount_input').value) || 0;
        if (submitBtn) submitBtn.disabled = !(selectedWallet !== null && amount > 0);
    }

    // -------------------------------------------------------
    // WALLET GENERATION
    // -------------------------------------------------------
    async function generateWallets() {
        const btn          = document.getElementById('generateBtn');
        const messagesDiv  = document.getElementById('generationMessages');
        const messagesList = document.getElementById('messagesList');

        btn.disabled    = true;
        btn.textContent = 'Generating...';
        messagesList.innerHTML = '';
        messagesDiv.style.display = 'block';

        for (const message of generationMessages) {
            await addMessage(message);
            await delay(500);
        }

        await fetchWallets();
        playSound();

        setTimeout(() => {
            document.getElementById('generatorSection').style.display = 'none';
            document.getElementById('walletSection').style.display    = 'block';
            document.getElementById('actionButtons').style.display    = 'flex';
            localStorage.setItem('wallets_generated', 'true');
        }, 500);
    }

    async function addMessage(message) {
        const messagesList = document.getElementById('messagesList');
        if (!messagesList) return;
        const div = document.createElement('div');
        div.className   = 'message-item';
        div.textContent = message;
        messagesList.appendChild(div);
        div.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        await delay(100);
    }

    async function fetchWallets() {
        try {
            const response = await fetch("{{ route('user.wallets.generate') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();
            if (data.success && data.wallets) {
                displayWallets(data.wallets);
            }
        } catch (error) {
            console.error('Error fetching wallets:', error);
        }
    }

    // -------------------------------------------------------
    // DISPLAY WALLETS — uses getCryptoLogo()
    // -------------------------------------------------------
    function displayWallets(wallets) {
        const grid = document.getElementById('walletOptionsGrid');
        if (!grid) return;
        grid.innerHTML = '';

        if (!wallets || wallets.length === 0) {
            grid.innerHTML = '<div class="col-span-full text-center text-gray-500">No wallets available</div>';
            return;
        }

        wallets.forEach(wallet => {
            const cryptoName = wallet.crypto_name;
            const logoUrl    = getCryptoLogo(cryptoName);   // ← dynamic, lowercase-safe

            const option = document.createElement('label');
            option.className = 'wallet-option';
            option.setAttribute('data-wallet-id', wallet.id);
            option.onclick = () => selectWallet(wallet.id);

            option.innerHTML = `
                <input type="radio" name="wallet_id" value="${wallet.id}" required>
                <div class="wallet-checkmark">✓</div>
                <div class="flex items-center gap-3">
                    <div class="crypto-logo-wrapper">
                        <img
                            src="${logoUrl}"
                            alt="${cryptoName} logo"
                            onerror="this.src='https://cdn.jsdelivr.net/gh/spothq/cryptocurrency-icons@master/128/color/generic.png'"
                        >
                    </div>
                    <div>
                        <h6 class="font-bold" style="color: #0C3A30;">${cryptoName}</h6>
                        <p class="text-xs text-gray-500">Mainnet</p>
                    </div>
                </div>
                <div class="mt-3 text-xs text-gray-400 flex items-center gap-1">
                    <iconify-icon icon="ph:lightning-fill" style="color: #9EDD05;"></iconify-icon>
                    <span>Instant settlement</span>
                </div>
            `;

            grid.appendChild(option);
        });
    }

    function selectWallet(walletId) {
        document.querySelectorAll('.wallet-option').forEach(opt => opt.classList.remove('selected'));

        const selected = document.querySelector(`.wallet-option[data-wallet-id="${walletId}"]`);
        if (selected) {
            selected.classList.add('selected');
            const radio = selected.querySelector('input[type="radio"]');
            if (radio) radio.checked = true;
        }

        selectedWallet = walletId;

        const amountSection = document.getElementById('amountSection');
        if (amountSection) amountSection.style.display = 'block';

        const steps = document.querySelectorAll('.step');
        if (steps[1]) steps[1].classList.add('active');

        validateForm();
    }

    function playSound() {
        try {
            const ctx  = new (window.AudioContext || window.webkitAudioContext)();
            const osc  = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.connect(gain);
            gain.connect(ctx.destination);
            osc.frequency.value = 523.25;
            gain.gain.value     = 0.3;
            osc.start();
            gain.gain.exponentialRampToValueAtTime(0.00001, ctx.currentTime + 0.5);
            osc.stop(ctx.currentTime + 0.5);
        } catch (e) {}
    }

    function delay(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    function showToast(message) {
        const toast = document.createElement('div');
        toast.className   = 'toast-notification';
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 300);
        }, 2000);
    }

    function resetForm() {
        document.getElementById('depositForm').reset();
        document.querySelectorAll('.wallet-option').forEach(w => w.classList.remove('selected'));
        document.getElementById('amountSection').style.display = 'none';
        document.getElementById('submitButton').disabled       = true;
        document.querySelectorAll('.amount-preset-btn').forEach(b => b.classList.remove('active'));
        selectedWallet = null;
        const steps = document.querySelectorAll('.step');
        if (steps[1]) steps[1].classList.remove('active');
    }

    function openGuide() {
        document.getElementById('guideModal').classList.add('active');
    }

    function closeGuide() {
        document.getElementById('guideModal').classList.remove('active');
    }

    // Amount input listener
    const amountInput = document.getElementById('amount_input');
    if (amountInput) {
        amountInput.addEventListener('input', function () {
            const rate = rates[currentCurrency] || 1;
            const amount = parseFloat(this.value) || 0;
            const usdInput = document.getElementById('amount_usd_input');
            if (usdInput) usdInput.value = (amount / rate).toFixed(2);
            validateForm();
        });
    }

    // -------------------------------------------------------
    // INIT
    // -------------------------------------------------------
    document.addEventListener('DOMContentLoaded', function () {
        updateCurrencySymbol();
        updateQuickAmountButtons();

        if (localStorage.getItem('wallets_generated') === 'true') {
            document.getElementById('generatorSection').style.display = 'none';
            document.getElementById('walletSection').style.display    = 'block';
            document.getElementById('actionButtons').style.display    = 'flex';
            fetchWallets();
        }

        @if(session('reinvestment_mode') && session('reinvestment_expires') > now())
        updateReinvestmentBalance();
        @endif
    });
</script>

@endsection