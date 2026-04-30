@extends('layout.user')

@section('content')

<!-- Reinvestment Mode Alert -->
@if(session('reinvestment_mode') && session('reinvestment_expires') > now())
<div class="alert alert-warning mb-4 px-6" style="background-color:#9EDD05 !important;">
    <div class="flex items-center">
        <iconify-icon icon="solar:refresh-circle-outline" class="mr-2"></iconify-icon>
        <span>Reinvestment mode. Available balance:
            <strong><span id="availableBalanceDisplay">${{ number_format(auth()->user()->available_balance, 2) }}</span></strong>
        </span>
        <button onclick="location.href='{{ route('user_dashboard') }}'"
            class="ml-4 text-sm underline font-semibold hover:text-red-600"
            style="color:#000;">Cancel</button>
    </div>
</div>
@endif

<style>
    :root {
        --pg: #9EDD05;
        --dg: #0C3A30;
        --ag: #8AC304;
    }

    * {
        box-sizing: border-box;
    }

    .dashboard-main-body {
        max-width: 100%;
        overflow-x: hidden;
    }

    /* ── Method cards ── */
    .method-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    @media(max-width:640px) {
        .method-grid {
            grid-template-columns: 1fr;
        }
    }

    .method-card {
        border: 2px solid #e5e7eb;
        border-radius: 16px;
        padding: 1.5rem 1rem;
        cursor: pointer;
        transition: all .25s ease;
        background: white;
        text-align: center;
        position: relative;
        overflow: hidden;
        user-select: none;
    }

    .method-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--pg), var(--ag));
        transform: scaleX(0);
        transition: transform .25s ease;
        transform-origin: left;
    }

    .method-card:hover {
        border-color: var(--pg);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(158, 221, 5, .15);
    }

    .method-card:hover::after {
        transform: scaleX(1);
    }

    .method-card.selected {
        border-color: var(--pg);
        background: linear-gradient(135deg, #f9fffe, #f0f7ed);
        box-shadow: 0 6px 16px rgba(158, 221, 5, .2);
    }

    .method-card.selected::after {
        transform: scaleX(1);
    }

    .mc-icon {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        margin: 0 auto .75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.7rem;
        transition: transform .2s ease;
    }

    .method-card:hover .mc-icon {
        transform: scale(1.1);
    }

    .mc-name {
        font-weight: 700;
        font-size: .9rem;
        color: var(--dg);
        margin-bottom: .2rem;
    }

    .mc-desc {
        font-size: .72rem;
        color: #9ca3af;
    }

    .mc-badge {
        position: absolute;
        top: .5rem;
        right: .5rem;
        font-size: .58rem;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .badge-live {
        background: #dcfce7;
        color: #15803d;
    }

    .badge-soon {
        background: #fef9c3;
        color: #854d0e;
    }

    .mc-check {
        position: absolute;
        top: .5rem;
        left: .5rem;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: var(--pg);
        color: var(--dg);
        display: none;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
    }

    .method-card.selected .mc-check {
        display: flex;
        animation: cpop .3s ease;
    }

    @keyframes cpop {
        0% {
            transform: scale(0)
        }

        60% {
            transform: scale(1.3)
        }

        100% {
            transform: scale(1)
        }
    }

    /* ── Panels ── */
    .pay-panel {
        display: none;
    }

    .pay-panel.active {
        display: block;
        animation: fadein .3s ease;
    }

    @keyframes fadein {
        from {
            opacity: 0;
            transform: translateY(8px)
        }

        to {
            opacity: 1;
            transform: translateY(0)
        }
    }

    .panel-card {
        border: 2px solid #e5e7eb;
        border-radius: 16px;
        padding: 2rem;
        background: white;
        background-image:url('{{ asset(' assets/images/hero/hero-image-1.svg') }}');
        background-size: cover;
        background-position: center;
        margin-bottom: 1.5rem;
    }

    /* ── Generator ── */
    .gen-section {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .gen-btn {
        background: linear-gradient(135deg, var(--pg), var(--ag));
        color: var(--dg);
        font-weight: 700;
        padding: .9rem 2.5rem;
        border-radius: 50px;
        border: none;
        cursor: pointer;
        font-size: .95rem;
        box-shadow: 0 4px 15px rgba(158, 221, 5, .3);
        transition: all .25s ease;
    }

    .gen-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(158, 221, 5, .4);
    }

    .gen-btn:disabled {
        opacity: .6;
        cursor: not-allowed;
        transform: none;
    }

    .gen-log {
        padding: 1rem 1.25rem;
        margin-top: 1.25rem;
        text-align: left;
        max-height: 190px;
        overflow-y: auto;
        background: #ffffff !important;
        border: 1px solid #e5e7eb !important;
    }

    .log-line {
        padding: .15rem 0;
        font-size: .78rem;
        color: #0C3A30 !important;
        font-family: monospace;
    }

    /* ── Wallet options ── */
    .wallet-opt {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 1rem;
        cursor: pointer;
        transition: all .2s ease;
        background: white;
        position: relative;
        display: block;
    }

    .wallet-opt:hover {
        border-color: var(--pg);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(158, 221, 5, .1);
    }

    .wallet-opt.selected {
        border-color: var(--pg);
        background: linear-gradient(135deg, #fff, #f0f7ed);
        box-shadow: 0 4px 12px rgba(158, 221, 5, .2);
    }

    .wallet-opt input[type="radio"] {
        display: none;
    }

    .wcheck {
        position: absolute;
        top: .5rem;
        right: .5rem;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: var(--pg);
        color: white;
        display: none;
        align-items: center;
        justify-content: center;
        font-size: 11px;
    }

    .wallet-opt.selected .wcheck {
        display: flex;
        animation: cpop .3s ease;
    }

    .clogo {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        flex-shrink: 0;
    }

    .clogo img {
        width: 30px;
        height: 30px;
        object-fit: contain;
    }

    /* ── Gift card types ── */
    .gc-type {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: .85rem .5rem;
        cursor: pointer;
        transition: all .2s ease;
        background: white;
        text-align: center;
        position: relative;
    }

    .gc-type:hover {
        border-color: var(--pg);
    }

    .gc-type.selected {
        border-color: var(--pg);
        background: #f0f7ed;
    }

    .gc-type input[type="radio"] {
        display: none;
    }

    /* little checkmark on card type */
    .gc-type .gc-check {
        position: absolute;
        top: .35rem;
        right: .35rem;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: var(--pg);
        color: var(--dg);
        display: none;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        font-weight: 700;
    }

    .gc-type.selected .gc-check {
        display: flex;
        animation: cpop .3s ease;
    }

    /* ── Upload zone ── */
    .upload-zone {
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        transition: all .25s ease;
        cursor: pointer;
        background: #fafafa;
    }

    .upload-zone:hover {
        border-color: var(--pg);
        background: #f8faf7;
    }

    .upload-zone.has-file {
        border-color: var(--pg);
        background: #f0fdf4;
        border-style: solid;
    }

    /* ── Inputs ── */
    .f-input {
        width: 100%;
        padding: .75rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: .875rem;
        color: #111827;
        background: white;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .f-input:focus {
        border-color: var(--pg);
        box-shadow: 0 0 0 3px rgba(158, 221, 5, .15);
    }

    .f-label {
        display: block;
        font-size: .78rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: .35rem;
    }

    .preset-btn {
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: .4rem .9rem;
        font-weight: 600;
        font-size: .82rem;
        color: var(--dg);
        cursor: pointer;
        transition: all .2s ease;
    }

    .preset-btn:hover {
        border-color: var(--pg);
        background: #f8faf7;
    }

    .preset-btn.active {
        background: var(--pg);
        border-color: var(--pg);
        color: var(--dg);
    }

    /* ── Buttons ── */
    .btn-continue {
        background: var(--pg);
        color: var(--dg);
        font-weight: 700;
        padding: .85rem 2.5rem;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        font-size: .95rem;
        box-shadow: 0 4px 12px rgba(158, 221, 5, .3);
        transition: all .25s ease;
        position: relative;
    }

    .btn-continue:hover:not(:disabled) {
        background: var(--ag);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(158, 221, 5, .4);
    }

    .btn-continue:disabled {
        opacity: .45;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .btn-continue.submitting {
        opacity: .8;
        cursor: not-allowed;
        pointer-events: none;
    }

    .btn-reset {
        padding: .85rem 2rem;
        border: 2px solid #fca5a5;
        color: #ef4444;
        border-radius: 10px;
        font-weight: 600;
        background: white;
        cursor: pointer;
        transition: all .2s ease;
    }

    .btn-reset:hover {
        background: #fef2f2;
    }

    .info-box {
        background: linear-gradient(135deg, #f8faf7, #eef7ea);
        border-radius: 12px;
        padding: 1.25rem 1.5rem;
        border-left: 4px solid var(--pg);
    }

    .info-box.warn {
        background: linear-gradient(135deg, #fef9c3, #fef3c7);
        border-left-color: #f59e0b;
    }

    /* ── Steps ── */
    .steps {
        display: flex;
        align-items: center;
        gap: .75rem;
        margin-bottom: 1.75rem;
        flex-wrap: nowrap;
    }

    .step {
        display: flex;
        align-items: center;
        gap: 2.5rem;
    }

    .snum {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #e5e7eb;
        color: #6b7280;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: .8rem;
        transition: all .25s;
    }

    .step.active .snum {
        background: var(--pg);
        color: var(--dg);
    }

    .sline {
        width: 40px;
        height: 2px;
        background: #e5e7eb;
    }

    /* ── Toast ── */
    .toast {
        position: fixed;
        bottom: 24px;
        right: 24px;
        background: #0d1117;
        color: var(--pg);
        padding: 1rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: .875rem;
        z-index: 9999;
        max-width: 380px;
        line-height: 1.5;
        border-left: 4px solid var(--pg);
        box-shadow: 0 8px 24px rgba(0, 0, 0, .35);
        animation: slideIn .3s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(80px)
        }

        to {
            opacity: 1;
            transform: translateX(0)
        }
    }

    /* ── Guide modal ── */
    .gmodal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .8);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .gmodal.active {
        display: flex;
    }

    .gmodal-body {
        background: white;
        border-radius: 16px;
        max-width: 480px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        padding: 2rem;
    }

    .gstep {
        display: flex;
        gap: 1rem;
        margin-bottom: .65rem;
        padding: .85rem 1rem;
        background: #f9fafb;
        border-radius: 10px;
    }

    .gsnum {
        width: 28px;
        height: 28px;
        background: var(--pg);
        color: var(--dg);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: .8rem;
        flex-shrink: 0;
    }

    /* ── Selected card summary badge ── */
    .selected-gc-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        border-radius: 20px;
        background: #f0f7ed;
        border: 1px solid var(--pg);
        font-size: .8rem;
        font-weight: 600;
        color: var(--dg);
        margin-bottom: 1rem;
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
        <h5 class="font-semibold mb-0" style="color:#0C3A30;">Deposit Funds</h5>
        <ul class="flex items-center gap-[6px]">
            <li>
                <a href="{{ route('user_dashboard') }}" class="flex items-center gap-2 hover:text-[#9EDD05]" style="color:#0C3A30;">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="text-lg"></iconify-icon> Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="font-medium" style="color:#9EDD05;">Deposit</li>
        </ul>
    </div>

    <!-- Step Indicator -->
    <div class="steps">
        <div class="step active" id="s1">
            <div class="snum">1</div><span class="text-sm font-medium" style="color:#0C3A30;">Choose Method</span>
        </div>
        <div class="sline"></div>
        <div class="step" id="s2">
            <div class="snum">2</div><span class="text-sm text-gray-400">Fill Details</span>
        </div>
        <div class="sline"></div>
        <div class="step" id="s3">
            <div class="snum">3</div><span class="text-sm text-gray-400">Confirm</span>
        </div>
    </div>

    <!-- Header row -->
    <div class="flex items-center justify-between gap-4 mb-5">
        <p class="text-sm text-gray-800">Select funding Method</p>
        <button type="button" onclick="openGuide()" class="flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition text-sm font-semibold">
            <iconify-icon icon="ph:question-fill" class="text-base"></iconify-icon> How it works
        </button>
    </div>

    <!-- ══ STEP 1 — CHOOSE METHOD ══ -->
    <div class="method-grid">

        <div class="method-card" id="mc-crypto" onclick="chooseMethod('crypto')">
            <div class="mc-check">✓</div>
            <span class="mc-badge badge-live">Live</span>
            <div class="mc-icon" style="background:linear-gradient(135deg,#f0f7ed,#dcfce7);">
                <span class="crypto-icon">
                    <iconify-icon icon="ph:stack-bold" style="color:#0C3A30;"></iconify-icon>

                    
                </span>
            </div>
     <style>.crypto-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    position: relative;
    transition: all 0.25s ease;
    animation: cryptoBreath 3.5s ease-in-out infinite;
}

/* 🔥 idle breathing effect */
@keyframes cryptoBreath {
    0%, 100% {
        transform: translateY(0px) scale(1);
    }
    50% {
        transform: translateY(-2px) scale(1.03);
    }
}

/* 💚 hover glow + pulse */
.crypto-icon:hover {
    animation: cryptoPulse 1s ease-in-out infinite;
    cursor: pointer;
}

/* pulse glow */
@keyframes cryptoPulse {
    0% {
        transform: scale(1);
        filter: drop-shadow(0 0 0 rgba(158, 221, 5, 0));
    }
    50% {
        transform: scale(1.15);
        filter: drop-shadow(0 0 12px rgba(158, 221, 5, 0.7));
    }
    100% {
        transform: scale(1);
        filter: drop-shadow(0 0 0 rgba(158, 221, 5, 0));
    }
}

/* 🟢 click feedback */
.crypto-icon:active {
    transform: scale(0.92);
}
.crypto-icon::after {
    content: "";
    position: absolute;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid rgba(158,221,5,0.4);
    animation: ringPulse 2.5s infinite;
}

@keyframes ringPulse {
    0% {
        transform: scale(0.8);
        opacity: 0.8;
    }
    100% {
        transform: scale(1.6);
        opacity: 0;
    }
}
</style>
            <div class="mc-name">Cryptocurrency</div>
            <div class="mc-desc">BTC · ETH · USDT & more</div>
        </div>

        <div class="method-card" id="mc-giftcard" onclick="chooseMethod('giftcard')">
            <div class="mc-check">✓</div>
            <span class="mc-badge badge-live">Live</span>
            <div class="mc-icon" style="background:linear-gradient(135deg,#fef9c3,#fde68a);">
                <iconify-icon icon="ph:gift-bold" style="color:#92400e;"></iconify-icon>
            </div>
            <div class="mc-name">Gift Card</div>
            <div class="mc-desc">Amazon · iTunes · Google Play</div>
        </div>

        <div class="method-card" id="mc-bank" onclick="chooseMethod('bank')" style="opacity:.65;">
            <div class="mc-check">✓</div>
            <span class="mc-badge badge-soon">Not Available Now</span>
            <div class="mc-icon" style="background:linear-gradient(135deg,#f3f4f6,#e5e7eb);">
                <iconify-icon icon="ph:bank-bold" style="color:#9ca3af;"></iconify-icon>
            </div>
            <div class="mc-name">Bank Transfer</div>
            <div class="mc-desc">Wire &amp; local transfers</div>
        </div>
    </div>

    <!-- ══ PANEL — CRYPTO ══ -->
    <div class="pay-panel" id="panel-crypto" >
        <div class="panel-card" style="background-image: url({{ asset('assets/images/hero/hero-image-1.svg') }}); background-repeat: no-repeat; background-size: cover; background-position: center;">
            <form action="{{ route('user.make-deposit') }}" method="POST" id="cryptoForm" onsubmit="return handleCryptoSubmit(this)">
                @csrf
                <input type="hidden" name="payment_method" value="crypto">

                <!-- Generator -->
                <div id="genSection" class="gen-section">
                    <iconify-icon icon="ph:shield-checkered-fill" style="font-size:2.5rem;color:#0C3A30;display:block;margin-bottom:.5rem;"></iconify-icon>
                    <h3 class="text-xl font-bold mb-1" style="color:#0C3A30;">Generate Your Secure Wallet</h3>
                    <p class="text-sm text-gray-500 mb-5">Click below to generate your personal encrypted deposit wallets</p>
                    <button type="button" onclick="generateWallets()" class="gen-btn" id="genBtn">
                        <iconify-icon icon="ph:lock-key-fill" class="mr-1"></iconify-icon>
                        Generate Secure Wallet
                    </button>
                    <div id="genLog" style="display:none;" class="gen-log">
                        <div id="logLines"></div>
                    </div>

                </div>

                <!-- Wallet Selection -->
                <div id="walletSection" style="display:none;" class="mb-6">
                    
                    <h4 class="text-base font-bold mb-4" style="color:#0C3A30;">
                        <iconify-icon icon="ph:wallet-bold" class="mr-1" style="color:var(--pg);"></iconify-icon>
                        Select Cryptocurrency
                    </h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3" id="walletGrid" ></div>
                    @error('wallet_id')
                    <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Amount -->
                <div id="cryptoAmountSection" style="display:none;" class="mb-6">
                    <h4 class="text-base font-bold mb-4" style="color:#0C3A30;">
                        <iconify-icon icon="ph:currency-dollar-bold" class="mr-1" style="color:var(--pg);"></iconify-icon>
                        Enter Amount
                    </h4>
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label class="f-label">Deposit Amount (USD) <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 font-bold">$</span>
                                <input type="number" name="amount" id="crypto_amt" step="0.01" min="0.01"
                                    class="f-input pl-8" placeholder="0.00" required oninput="syncCryptoAmt()">
                            </div>
                            <input type="hidden" name="amount_usd" id="crypto_amt_usd">
                            <p class="text-xs text-gray-400 mt-1">No minimum · No maximum</p>
                        </div>
                        <div>
                            <label class="f-label">Quick Select</label>
                            <div class="flex flex-wrap gap-2" id="cryptoPresets"></div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div id="cryptoActions" style="display:none;" class="flex justify-center gap-3 pt-5 border-t border-gray-200">
                    <button type="button" onclick="resetCrypto()" class="btn-reset">Reset</button>
                    <button type="submit" id="cryptoSubmit" class="btn-continue" disabled>
                        <span id="cryptoSubmitText">Continue to Payment →</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ══ PANEL — GIFT CARD ══ -->
    <div class="pay-panel" id="panel-giftcard"  >
        <div class="panel-card" style="background-image: url({{ asset('assets/images/hero/hero-image-1.svg') }}); background-repeat: no-repeat; background-size: cover; background-position: center;">
            <form action="{{ route('deposit.giftcard.submit') }}" method="POST" enctype="multipart/form-data" id="gcForm" onsubmit="return handleGcSubmit(this)">
                @csrf
                <input type="hidden" name="payment_method" value="giftcard">
                {{-- This hidden field carries the resolved card name (either the preset or the custom "other" name) --}}

                <input type="hidden" name="card_type_label" id="gc_type_label" value="Amazon">

                <div class="mb-5">
                    <h4 class="text-base font-bold mb-1" style="color:#0C3A30;">
                        <iconify-icon icon="ph:gift-bold" class="mr-1" style="color:var(--pg);"></iconify-icon>
                        Gift Card Deposit
                    </h4>
                    <p class="text-sm text-gray-500">Submit your gift card details. Our team reviews and credits your account within 1 minutes – 6 hours.</p>
                </div>

                <!-- 1. Card Type Selector -->
                <div class="mb-5">
                    <label class="f-label">Gift Card Type <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-3 sm:grid-cols-6 gap-3" id="gcTypeGrid">

                        @foreach([
                        ['amazon', 'Amazon', 'ph:shopping-cart-bold', '#f97316', '#fff7ed'],
                        ['itunes', 'iTunes', 'ph:music-notes-bold', '#ec4899', '#fdf2f8'],
                        ['google', 'Google Play','ph:google-play-logo-bold','#16a34a', '#f0fdf4'],
                        ['steam', 'Steam', 'ph:game-controller-bold', '#2563eb', '#eff6ff'],

                        ['other', 'Other', 'ph:gift-bold', '#8b5cf6', '#f5f3ff'],
                        ] as [$val, $lbl, $ico, $col, $bg])
                        <label class="gc-type {{ $loop->first ? 'selected' : '' }}" id="gct-{{ $val }}" onclick="selectGcType('{{ $val }}', '{{ $lbl }}')">
                            <input type="radio" name="card_type" value="{{ $val }}" {{ $loop->first ? 'checked' : '' }}>
                            <div class="gc-check">✓</div>
                            <div style="width:40px;height:40px;border-radius:10px;background:{{ $bg }};display:flex;align-items:center;justify-content:center;margin:0 auto .4rem;">
                                <iconify-icon icon="{{ $ico }}" style="font-size:1.3rem;color:{{ $col }};"></iconify-icon>
                            </div>
                            <div style="font-size:.72rem;font-weight:600;color:#374151;">{{ $lbl }}</div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- "Other" card name input — shown only when Other is selected -->
                <div id="otherCardNameWrap" style="display:none;" class="mb-5">
                    <label class="f-label">Card Name <span class="text-red-500">*</span> <span class="text-gray-400 font-normal">(type the gift card brand)</span></label>
                    <input type="text" id="other_card_name" name="other_card_name"
                        class="f-input" placeholder="e.g. Visa Gift Card, Razer Gold, PSN Card..."
                        oninput="validateGc()">
                    <p class="text-xs text-gray-400 mt-1">Enter the exact name of the gift card you have</p>
                </div>

                <!-- Selected card summary — shows what card was chosen -->
                <div id="gcSelectedSummary" class="selected-gc-badge" style="display:none;">
                    <iconify-icon id="gcSummaryIcon" icon="ph:gift-bold" style="font-size:1rem;"></iconify-icon>
                    <span id="gcSummaryName">Amazon Gift Card</span>
                    <span style="color:#9ca3af;">selected</span>
                </div>

                <!-- 2. Code + Amount -->
                <div class="grid md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <label class="f-label">Card Code / Redemption Number <span class="text-red-500">*</span></label>
                        <input type="text" name="card_code" id="gc_code" class="f-input"
                            placeholder="e.g. XXXX-XXXX-XXXX-XXXX" required oninput="validateGc()">
                        <p class="text-xs text-gray-400 mt-1" style="color:linear-gradient(135deg,#fef9c3,#fde68a);">The code printed or scratched at the back of your card</p>
                    </div>
                    <div>
                        <label class="f-label">Card Value (USD) <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 font-bold">$</span>
                            <input type="number" name="amount_deposited" id="gc_amt" step="0.01" min="1"
                                class="f-input pl-8" placeholder="0.00" required oninput="validateGc()">
                        </div>
                        <div class="flex flex-wrap gap-2 mt-2" id="gcPresets"></div>
                    </div>
                </div>

                <!-- 3. Upload image -->
                <div class="mb-5">
                    <label class="f-label">Upload Gift Card Back Photo / Screenshot <span class="text-red-500">*</span></label>
                    <div class="upload-zone" id="gcZone" onclick="document.getElementById('gc_img').click()">
                        <iconify-icon icon="ph:gift" style="font-size:2.5rem;color:#d1d5db;display:block;margin:0 auto .5rem;"></iconify-icon>
                        <p class="text-sm font-medium text-gray-500">Click to upload your gift card image</p>
                        <p class="text-xs text-gray-400 mt-1">PNG · JPG · WEBP — max 10MB</p>
                    </div>
                    <input type="file" id="gc_img" name="card_image" class="hidden" accept="image/*" onchange="handleGcImg(this)">
                    @error('card_image') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- 4. Notes -->
                <div class="mb-5">
                    <label class="f-label">Additional Notes <span class="text-gray-400 font-normal">(optional)</span></label>
                    <textarea name="notes" rows="2" class="f-input" placeholder="Any extra info about this card..."></textarea>
                </div>



                <div class="flex justify-center gap-3 pt-5 border-t border-gray-200">
                    <button type="button" onclick="resetGc()" class="btn-reset">Reset</button>
                    <button type="submit" id="gcSubmit" class="btn-continue" disabled>
                        <span id="gcSubmitText">Submit Gift Card →</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Info box -->
    <div class="info-box">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0" style="background:rgba(158,221,5,.15);">
                <iconify-icon icon="ph:info-fill" style="color:var(--pg);font-size:1.25rem;"></iconify-icon>
            </div>
            <div>
                <h5 class="font-semibold mb-1" style="color:#0C3A30;">Deposit Information</h5>
                <p class="text-sm text-gray-600">
                    Crypto deposits are processed within <strong>1–10 minutes</strong> after blockchain confirmation.
                    Gift card deposits are manually reviewed within <strong>30 minutes – 12 hours</strong>.
                    Funds are added to your available balance once approved.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Guide Modal -->
<div class="gmodal" id="gmodal" onclick="if(event.target===this)closeGuide()">
    <div class="gmodal-body">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-xl font-bold" style="color:#0C3A30;">Deposit Guide</h3>
            <button onclick="closeGuide()" class="text-gray-400 hover:text-gray-700 text-2xl leading-none">&times;</button>
        </div>
        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Crypto</p>
        @foreach(['Select your cryptocurrency wallet','Enter the amount you want to deposit','Copy the wallet address on the next page','Send crypto from your exchange or personal wallet','Upload a screenshot of the transaction as proof'] as $i => $s)
        <div class="gstep">
            <div class="gsnum">{{ $i+1 }}</div>
            <p class="text-sm text-gray-600 self-center">{{ $s }}</p>
        </div>
        @endforeach
        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-5 mb-3">Gift Card</p>
        @foreach(['Choose your gift card brand (select Other if yours is not listed)','Enter the exact name if you chose Other','Enter the card serial / redemption code','Type the exact face value (USD) of the card','Upload a clear photo of the gift card and submit'] as $i => $s)
        <div class="gstep">
            <div class="gsnum">{{ $i+1 }}</div>
            <p class="text-sm text-gray-600 self-center">{{ $s }}</p>
        </div>
        @endforeach
        <div class="mt-5 p-3 bg-yellow-50 rounded-lg">
            <p class="text-xs text-yellow-800"><strong>⏱ Processing times:</strong> Crypto: 1–10 min · Gift Card: 30 min–12 hrs</p>
        </div>
    </div>
</div>

<script>
    /* ── STATE ── */
    const rates = {};
    let cryptoWallet = null;
    let gcType = 'amazon';
    let gcTypeLabel = 'Amazon';
    const QUICK = [500, 1000, 2000, 5000];

    /* Gift card meta — icon + colour per brand */
    const GC_META = {
        amazon: {
            icon: 'ph:shopping-cart-bold',
            color: '#f97316',
            label: 'Amazon Gift Card'
        },
        itunes: {
            icon: 'ph:music-notes-bold',
            color: '#ec4899',
            label: 'iTunes Gift Card'
        },
        google: {
            icon: 'ph:google-play-logo-bold',
            color: '#16a34a',
            label: 'Google Play Gift Card'
        },
        steam: {
            icon: 'ph:game-controller-bold',
            color: '#2563eb',
            label: 'Steam Gift Card'
        },

        other: {
            icon: 'ph:gift-bold',
            color: '#8b5cf6',
            label: 'Other Gift Card'
        },
    };

    const LOG_MSGS = [
        "Initializing secure wallet generator...",
        "Connecting to blockchain network...",
        "Establishing encrypted channel...",
        "Secure connection established ✓",
        "Generating Bitcoin wallet...",
        "Bitcoin wallet ready ✓",
        "Generating Ethereum wallet...",
        "Ethereum wallet ready ✓",
        "Generating USDT wallet...",
        "USDT wallet ready ✓",
        "Applying multi-layer encryption...",
        "All wallets generated successfully ✓"
    ];

    const COINS = ['btc', 'eth', 'usdt', 'bnb', 'sol', 'xrp', 'ada', 'doge', 'ltc', 'trx', 'matic', 'link', 'dot', 'avax', 'uni', 'atom', 'xlm', 'algo', 'vet', 'icp', 'fil', 'egld', 'theta', 'xtz', 'eos', 'cake', 'aave', 'grt', 'mkr', 'comp', 'snx', 'crv', 'yfi', 'bat', 'zec', 'dash', 'xmr', 'neo', 'waves', 'hbar', 'near', 'ftm', 'one', 'usdc', 'busd', 'shib', 'apt', 'arb', 'op', 'sui'];

    function logoUrl(sym) {
        const s = (sym || '').toLowerCase().trim();
        return 'https://cdn.jsdelivr.net/gh/spothq/cryptocurrency-icons@master/128/color/' + (COINS.includes(s) ? s : 'generic') + '.png';
    }

    function fmt(n) {
        return n.toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    /* ── EXCHANGE RATES ── */
    fetch('https://v6.exchangerate-api.com/v6/a8e67b756f551b68d4ada293/latest/USD')
        .then(r => r.json()).then(d => {
            if (d.result === 'success') Object.assign(rates, d.conversion_rates);
        })
        .catch(() => {
            rates.USD = 1;
        });

    /* ── METHOD SELECTION ── */
    function chooseMethod(m) {
        if (m === 'bank') {
            showToast('Bank Transfer is not yet available. Please use Cryptocurrency or Gift Card to fund your account.');
            return;
        }
        document.querySelectorAll('.method-card').forEach(c => c.classList.remove('selected'));
        document.querySelectorAll('.pay-panel').forEach(p => p.classList.remove('active'));
        document.getElementById('mc-' + m).classList.add('selected');
        document.getElementById('panel-' + m).classList.add('active');
        document.getElementById('s2').classList.add('active');
        if (m === 'crypto') buildPresets('cryptoPresets', 'crypto');
        if (m === 'giftcard') {
            buildPresets('gcPresets', 'gc');
            selectGcType('amazon', 'Amazon');
        }
        document.getElementById('panel-' + m).scrollIntoView({
            behavior: 'smooth',
            block: 'nearest'
        });
    }

    /* ── PRESETS ── */
    function buildPresets(containerId, type) {
        const c = document.getElementById(containerId);
        if (!c || c.children.length) return;
        QUICK.forEach(v => {
            const b = document.createElement('button');
            b.type = 'button';
            b.className = 'preset-btn';
            b.textContent = '$' + fmt(v);
            b.onclick = () => {
                if (type === 'crypto') {
                    document.getElementById('crypto_amt').value = v.toFixed(2);
                    document.getElementById('crypto_amt_usd').value = v.toFixed(2);
                    validateCrypto();
                } else {
                    document.getElementById('gc_amt').value = v.toFixed(2);
                    validateGc();
                }
                c.querySelectorAll('.preset-btn').forEach(x => x.classList.remove('active'));
                b.classList.add('active');
            };
            c.appendChild(b);
        });
    }

    /* ── CRYPTO ── */
    async function generateWallets() {
        const btn = document.getElementById('genBtn'),
            logDiv = document.getElementById('genLog'),
            logBody = document.getElementById('logLines');
        btn.disabled = true;
        btn.textContent = 'Generating...';
        logBody.innerHTML = '';
        logDiv.style.display = 'block';
        for (const msg of LOG_MSGS) {
            await addLog(msg);
            await wait(450);
        }
        await fetchWallets();
        beep();
        setTimeout(() => {
            document.getElementById('genSection').style.display = 'none';
            document.getElementById('walletSection').style.display = 'block';
            document.getElementById('cryptoActions').style.display = 'flex';
            localStorage.setItem('wallets_generated', 'true');
        }, 400);
    }

    async function addLog(msg) {
        const body = document.getElementById('logLines');
        if (!body) return;
        const d = document.createElement('div');
        d.className = 'log-line';
        d.textContent = '> ' + msg;
        body.appendChild(d);
        d.scrollIntoView({
            behavior: 'smooth',
            block: 'nearest'
        });
        await wait(60);
    }

    async function fetchWallets() {
        try {
            const r = await fetch("{{ route('user.wallets.generate') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept': 'application/json'
                }
            });
            const data = await r.json();
            if (data.success && data.wallets) renderWallets(data.wallets);
        } catch (e) {
            console.error(e);
        }
    }

    function renderWallets(wallets) {
        const grid = document.getElementById('walletGrid');
        if (!grid) return;
        grid.innerHTML = '';
        if (!wallets?.length) {
            grid.innerHTML = '<div class="col-span-full text-center text-gray-400 text-sm py-6">No wallets available.</div>';
            return;
        }
        wallets.forEach(w => {
            const lbl = document.createElement('label');
            lbl.className = 'wallet-opt';
            lbl.setAttribute('data-wid', w.id);
            lbl.onclick = () => pickWallet(w.id);
            lbl.innerHTML = `
            <input type="radio" name="wallet_id" value="${w.id}" required>
            <div class="wcheck">✓</div>
            <div style="display:flex;align-items:center;gap:10px;">
                <div class="clogo">
                    <img src="${logoUrl(w.crypto_name)}" alt="${w.crypto_name}"
                         onerror="this.src='https://cdn.jsdelivr.net/gh/spothq/cryptocurrency-icons@master/128/color/generic.png'">
                </div>
                <div>
                    <p style="font-weight:700;color:#0C3A30;margin:0;font-size:.875rem;">${w.crypto_name}</p>
                    <p style="font-size:.7rem;color:#9ca3af;margin:0;">Mainnet</p>
                </div>
            </div>
            <div style="margin-top:.6rem;font-size:.7rem;color:#9ca3af;display:flex;align-items:center;gap:4px;">
                <iconify-icon icon="ph:lightning-fill" style="color:#9EDD05;"></iconify-icon> Instant settlement
            </div>`;
            grid.appendChild(lbl);
        });
    }

    function pickWallet(id) {
        document.querySelectorAll('.wallet-opt').forEach(o => o.classList.remove('selected'));
        const w = document.querySelector(`.wallet-opt[data-wid="${id}"]`);
        if (w) {
            w.classList.add('selected');
            w.querySelector('input').checked = true;
        }
        cryptoWallet = id;
        document.getElementById('cryptoAmountSection').style.display = 'block';
        document.getElementById('s3').classList.add('active');
        buildPresets('cryptoPresets', 'crypto');
        validateCrypto();
    }

    function syncCryptoAmt() {
        document.getElementById('crypto_amt_usd').value = document.getElementById('crypto_amt').value;
        validateCrypto();
    }

    function validateCrypto() {
        const amt = parseFloat(document.getElementById('crypto_amt').value) || 0;
        document.getElementById('cryptoSubmit').disabled = !(cryptoWallet && amt > 0);
    }

    function resetCrypto() {
        document.getElementById('cryptoForm').reset();
        document.querySelectorAll('.wallet-opt').forEach(o => o.classList.remove('selected'));
        document.getElementById('cryptoAmountSection').style.display = 'none';
        document.getElementById('cryptoSubmit').disabled = true;
        document.querySelectorAll('#cryptoPresets .preset-btn').forEach(b => b.classList.remove('active'));
        cryptoWallet = null;
        // Reset submit button state if it was in submitting state
        const btn = document.getElementById('cryptoSubmit');
        btn.classList.remove('submitting');
        document.getElementById('cryptoSubmitText').textContent = 'Continue to Payment →';
    }

    /* Prevent double-submit for crypto */
    function handleCryptoSubmit(form) {
        const btn = document.getElementById('cryptoSubmit');
        if (btn.classList.contains('submitting')) return false;
        btn.classList.add('submitting');
        btn.disabled = true;
        document.getElementById('cryptoSubmitText').innerHTML = '<iconify-icon icon="ph:spinner-gap-bold" style="animation:spin360 .8s linear infinite;display:inline-block;margin-right:4px;"></iconify-icon> Processing...';
        return true;
    }

    /* ── GIFT CARD ── */
    function selectGcType(type, label) {
        gcType = type;
        gcTypeLabel = label || GC_META[type]?.label || type;

        document.querySelectorAll('.gc-type').forEach(el => el.classList.remove('selected'));
        const el = document.getElementById('gct-' + type);
        if (el) {
            el.classList.add('selected');
            el.querySelector('input').checked = true;
        }

        /* Show / hide the "Other" custom name input */
        const otherWrap = document.getElementById('otherCardNameWrap');
        if (type === 'other') {
            otherWrap.style.display = 'block';
            document.getElementById('other_card_name').required = true;
        } else {
            otherWrap.style.display = 'none';
            document.getElementById('other_card_name').required = false;
            document.getElementById('other_card_name').value = '';
        }

        /* Update the selected card summary badge */
        const meta = GC_META[type];
        const summary = document.getElementById('gcSelectedSummary');
        document.getElementById('gcSummaryIcon').setAttribute('icon', meta.icon);
        document.getElementById('gcSummaryIcon').style.color = meta.color;
        document.getElementById('gcSummaryName').textContent = (type === 'other' && document.getElementById('other_card_name').value) ?
            document.getElementById('other_card_name').value + ' Gift Card' :
            meta.label;
        summary.style.display = 'inline-flex';

        /* Update hidden label field */
        document.getElementById('gc_type_label').value = gcTypeLabel;

        validateGc();
    }

    /* Live-update the summary name when user types in Other field */
    document.getElementById('other_card_name')?.addEventListener('input', function() {
        const summaryName = document.getElementById('gcSummaryName');
        if (summaryName && gcType === 'other') {
            summaryName.textContent = this.value ? this.value + ' Gift Card' : 'Other Gift Card';
            document.getElementById('gc_type_label').value = this.value || 'Other';
        }
        validateGc();
    });

    function handleGcImg(input) {
        const file = input.files[0];
        const zone = document.getElementById('gcZone');
        if (!file) return;
        if (file.size > 10 * 1024 * 1024) {
            showToast('File too large. Max 10MB.');
            input.value = '';
            return;
        }
        if (!['image/jpeg', 'image/jpg', 'image/png', 'image/webp'].includes(file.type)) {
            showToast('Invalid type. Use PNG, JPG or WEBP.');
            input.value = '';
            return;
        }
        zone.classList.add('has-file');
        zone.innerHTML = `
        <iconify-icon icon="ph:check-circle-fill" style="font-size:2.5rem;color:#16a34a;display:block;margin:0 auto .5rem;"></iconify-icon>
        <p style="font-size:.875rem;font-weight:600;color:#111827;">${file.name}</p>
        <p style="font-size:.72rem;color:#9ca3af;margin-top:4px;">Click to change image</p>`;
        validateGc();
    }

    function validateGc() {
        const code = (document.getElementById('gc_code')?.value || '').trim();
        const amt = parseFloat(document.getElementById('gc_amt')?.value) || 0;
        const hasImg = (document.getElementById('gc_img')?.files?.length || 0) > 0;
        /* If "other" is selected, also require the custom name */
        const otherOk = gcType !== 'other' || (document.getElementById('other_card_name')?.value || '').trim().length > 0;
        document.getElementById('gcSubmit').disabled = !(code && amt > 0 && hasImg && otherOk);
    }

    function resetGc() {
        document.getElementById('gcForm').reset();
        const zone = document.getElementById('gcZone');
        zone.classList.remove('has-file');
        zone.innerHTML = `
        <iconify-icon icon="ph:gift" style="font-size:2.5rem;color:#d1d5db;display:block;margin:0 auto .5rem;"></iconify-icon>
        <p style="font-size:.875rem;font-weight:500;color:#9ca3af;">Click to upload your gift card image</p>
        <p style="font-size:.72rem;color:#d1d5db;margin-top:4px;">PNG · JPG · WEBP — max 10MB</p>`;
        document.getElementById('gcSubmit').disabled = true;
        document.getElementById('gcSelectedSummary').style.display = 'none';
        document.getElementById('otherCardNameWrap').style.display = 'none';
        document.querySelectorAll('#gcPresets .preset-btn').forEach(b => b.classList.remove('active'));
        // reset submit button state
        document.getElementById('gcSubmit').classList.remove('submitting');
        document.getElementById('gcSubmitText').textContent = 'Submit Gift Card →';
        selectGcType('amazon', 'Amazon');
    }

    /* Prevent double-submit for gift card */
    function handleGcSubmit(form) {
        const btn = document.getElementById('gcSubmit');
        if (btn.classList.contains('submitting')) return false;
        /* Final validation before submit */
        const code = (document.getElementById('gc_code')?.value || '').trim();
        const amt = parseFloat(document.getElementById('gc_amt')?.value) || 0;
        const hasImg = (document.getElementById('gc_img')?.files?.length || 0) > 0;
        const otherOk = gcType !== 'other' || (document.getElementById('other_card_name')?.value || '').trim().length > 0;
        if (!code || amt <= 0 || !hasImg || !otherOk) {
            showToast('Please fill all required fields.');
            return false;
        }
        btn.classList.add('submitting');
        btn.disabled = true;
        document.getElementById('gcSubmitText').innerHTML = '<iconify-icon icon="ph:spinner-gap-bold" style="animation:spin360 .8s linear infinite;display:inline-block;margin-right:4px;"></iconify-icon> Submitting...';
        return true;
    }

    /* ── UTILS ── */
    function beep() {
        try {
            const ctx = new(window.AudioContext || window.webkitAudioContext)(),
                o = ctx.createOscillator(),
                g = ctx.createGain();
            o.connect(g);
            g.connect(ctx.destination);
            o.frequency.value = 523.25;
            g.gain.value = 0.25;
            o.start();
            g.gain.exponentialRampToValueAtTime(0.00001, ctx.currentTime + .5);
            o.stop(ctx.currentTime + .5);
        } catch (e) {}
    }

    function wait(ms) {
        return new Promise(r => setTimeout(r, ms));
    }

    function showToast(msg) {
        document.querySelectorAll('.toast').forEach(t => t.remove());
        const t = document.createElement('div');
        t.className = 'toast';
        t.textContent = msg;
        document.body.appendChild(t);
        setTimeout(() => {
            t.style.transition = 'opacity .4s';
            t.style.opacity = '0';
            setTimeout(() => t.remove(), 400);
        }, 4500);
    }

    function openGuide() {
        document.getElementById('gmodal').classList.add('active');
    }

    function closeGuide() {
        document.getElementById('gmodal').classList.remove('active');
    }

    /* spinner keyframe added inline */
    const styleEl = document.createElement('style');
    styleEl.textContent = '@keyframes spin360{to{transform:rotate(360deg)}}';
    document.head.appendChild(styleEl);

    /* ── INIT ── */
    document.addEventListener('DOMContentLoaded', () => {
        if (localStorage.getItem('wallets_generated') === 'true') {
            document.getElementById('genSection').style.display = 'none';
            document.getElementById('walletSection').style.display = 'block';
            document.getElementById('cryptoActions').style.display = 'flex';
            fetchWallets();
        }
    });
</script>
@endsection