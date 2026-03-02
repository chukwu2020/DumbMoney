@extends('layout.user')

@section('content')


<div class="main-content">
    @if(session('showTradingOverlay') && now()->timestamp >= session('overlayShowAt'))
    @php
    $deposits = $user->deposits;
    $depositCount = $deposits->count();
    $hasDeposited = $depositCount > 0;
    $isFirstDeposit = $depositCount === 1;
    $tradingPlan = optional($user->activePlan())->name;
    @endphp

    <!-- Full-Screen Overlay -->
    <div id="trading-overlay" class="trading-overlay-wrapper">
        <!-- Dark Trading Background -->
        <div class="trading-overlay-backdrop"></div>

        <!-- Content Container -->
        <div class="trading-overlay-container">

            <!-- Close Button -->
            <button
                type="button"
                id="overlay-close"
                class="trading-close-btn"
                aria-label="Close">

                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            <!-- Main Trading Card -->
            <div class="trading-card">

                <!-- Header with Live Indicator -->
                <div class="trading-header">
                    <div class="trading-header-content">
                        <div class="live-pulse-container">
                            <span class="live-pulse"></span>
                            <span class="live-text">LIVE</span>
                        </div>
                        <h2 class="trading-header-title">Mirror Trading Active</h2>

                    </div>

                </div>

                <!-- Content -->
                <div class="trading-content">

                    <!-- Trader Profile -->
                    <div class="trader-profile">
                        <div class="trader-avatar-container">
                            <div class="trader-avatar">👤</div>
                            <span class="online-badge"></span>
                        </div>
                        <div>
                            <h3 class="trader-name">Welcome, {{ $user->name }}</h3>
                            <p class="trader-status">
                                <span class="status-dot"></span>
                                Ready to mirror profitable trades
                            </p>
                        </div>
                    </div>



                    <!-- Alert Message -->
                    <div class="trading-alert">
                        <div class="alert-header">
                            <div class="alert-icon-wrapper">
                                @if(!$hasDeposited)
                                <span class="alert-icon"></span>
                                @elseif($isFirstDeposit)
                                <span class="alert-icon">⭐</span>
                                @else
                                <span class="alert-icon">📊</span>
                                @endif
                            </div>
                            <div class="alert-content">
                                @if(!$hasDeposited)
                                <div class="alert-title">Premium Entry Detected!</div>
                                <p class="alert-text">Mirror trades in real-time. Volume surge detected across major pairs. </p>
                                @elseif($isFirstDeposit && $tradingPlan)
                                <div class="alert-title">Strong Start - {{ $tradingPlan }}</div>
                                <p class="alert-text">You're mirroring profitable signals! Scale up your capital to maximize returns on high-probability setups. 🚀</p>
                                @elseif($depositCount > 1)
                                <div class="alert-title">{{ $depositCount }}x Active Positions</div>
                                <p class="alert-text">Excellent consistency! Premium mirror opportunities available. Advanced strategies unlocked for your tier. 📊</p>
                                @else
                                <div class="alert-title">Trading Session Active</div>
                                <p class="alert-text">Market conditions optimal. Professional traders executing high-probability entries. Mirror their moves now. ⚡</p>
                                @endif
                            </div>
                        </div>

                        <div class="action-hint">
                            <span class="hint-icon"></span>
                            <span class="hint-text">
                                @if(!$hasDeposited)
                                Fund account to start mirroring trades and go live
                                @elseif($isFirstDeposit && $tradingPlan)
                                Upgrade for advanced signals
                                @else
                                Scale capital for bigger wins
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <a href="{{ route('user.deposit') }}" class="trading-cta-btn">
                        <span class="btn-icon">
                            @if(!$hasDeposited)⚡
                            @elseif($isFirstDeposit && $tradingPlan)🚀
                            @else📈
                            @endif
                        </span>
                        <span class="btn-text">
                            @if(!$hasDeposited)
                            Activate Mirror Trading
                            @elseif($isFirstDeposit && $tradingPlan)
                            Upgrade Trading Tier
                            @else
                            Scale Capital
                            @endif
                        </span>
                    </a>

                    <!-- Quick Funding Guide -->
                    <div class="funding-guide">
                        <button onclick="toggleGuide()" class="guide-toggle">
                            <div class="guide-toggle-left">

                                <span class="guide-title">Quick Funding Guide</span>
                            </div>
                            <svg id="guide-arrow" class="guide-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div id="guide-content" class="guide-content">
                            <div class="guide-steps">

                                <div class="guide-step">
                                    <div class="step-number">1</div>
                                    <div class="step-info">
                                        <div class="step-title">Click Deposit Button</div>
                                        <div class="step-detail">View all available trading plans and their profit tiers</div>
                                    </div>
                                </div>

                                <div class="guide-step">
                                    <div class="step-number">2</div>
                                    <div class="step-info">
                                        <div class="step-title">Select Trading Plan</div>
                                        <div class="step-detail">Choose the tier matching your capital. Higher capital = Higher profits</div>
                                    </div>
                                </div>

                                <div class="guide-step">
                                    <div class="step-number">3</div>
                                    <div class="step-info">
                                        <div class="step-title">Select Wallet Address</div>
                                        <div class="step-detail">Pick crypto you hold on exchange (USDT, BTC, ETH, etc.)</div>
                                    </div>
                                </div>

                                <div class="guide-step">
                                    <div class="step-number">4</div>
                                    <div class="step-info">
                                        <div class="step-title">Enter Amount & Continue</div>
                                        <div class="step-detail">Input deposit amount for selected plan, click "Continue"</div>
                                    </div>
                                </div>

                                <div class="guide-step">
                                    <div class="step-number">5</div>
                                    <div class="step-info">
                                        <div class="step-title">Copy Wallet Address</div>
                                        <div class="step-detail">Next page shows wallet address - copy it carefully</div>
                                    </div>
                                </div>

                                <div class="guide-step">
                                    <div class="step-number">6</div>
                                    <div class="step-info">
                                        <div class="step-title">Open Crypto Exchange</div>
                                        <div class="step-detail">Launch Binance, Coinbase, or your preferred exchange</div>
                                    </div>
                                </div>

                                <div class="guide-step">
                                    <div class="step-number">7</div>
                                    <div class="step-info">
                                        <div class="step-title">Click Withdraw</div>
                                        <div class="step-detail">Select matching crypto, paste copied wallet address</div>
                                    </div>
                                </div>

                                <div class="guide-step">
                                    <div class="step-number">8</div>
                                    <div class="step-info">
                                        <div class="step-title">Complete & Screenshot</div>
                                        <div class="step-detail">Send crypto, capture transaction confirmation screenshot</div>
                                    </div>
                                </div>

                                <div class="guide-step">
                                    <div class="step-number">9</div>
                                    <div class="step-info">
                                        <div class="step-title">Upload Proof</div>
                                        <div class="step-detail">Return to platform, upload screenshot below copy section</div>
                                    </div>
                                </div>

                                <div class="guide-step">
                                    <div class="step-number">10</div>
                                    <div class="step-info">
                                        <div class="step-title">Submit & Wait</div>
                                        <div class="step-detail">Click "Submit" - get notified when deposit confirms</div>
                                    </div>
                                </div>

                                <div class="guide-note warning-note">
                                    <span class="note-icon">⏱️</span>
                                    <div>
                                        <strong>Processing Time:</strong> 1-10 minutes depending on network. Trading activates instantly after approval.
                                    </div>
                                </div>

                                <div class="guide-note tip-note">
                                    <span class="note-icon">💡</span>
                                    <div>
                                        <strong>Pro Tip:</strong> Triple-check wallet address! Bigger capital = Exponentially higher mirror trading profits!
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>



            </div>
        </div>
    </div>

    <style>
        /* Overlay Wrapper */
        .trading-overlay-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            animation: overlayFadeIn 0.4s ease;
            overflow-y: auto;
        }

        .trading-overlay-wrapper {
            display: none;
        }


        @keyframes overlayFadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Dark Trading Backdrop */
        .trading-overlay-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: none;
            backdrop-filter: blur(12px);
            z-index: 1;
        }

        /* Content Container */
        .trading-overlay-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 580px;
            margin: auto;
            padding: 60px 0 20px 0;
        }

        /* Close Button */
        .trading-close-btn {
            position: absolute;
            top: 10px;
            right: 0;
            width: 44px;
            height: 44px;
            background: #8bc905;
            border: 2px solid rgba(139, 201, 5, 0.3);
            border-radius: 50%;
            color: #0C3A30;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 20px rgba(139, 201, 5, 0.4);
            transition: all 0.3s ease;
            z-index: 10;
        }

        .trading-close-btn:hover {
            background: #a0db06;
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 0 30px rgba(139, 201, 5, 0.6);
        }

        /* Main Trading Card */
        .trading-card {
            background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.7), 0 0 40px rgba(139, 201, 5, 0.15);
            animation: cardSlideUp 0.5s ease;
            border: 1px solid rgba(139, 201, 5, 0.2);
        }

        @keyframes cardSlideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header with Live Indicator */
        .trading-header {
            background: linear-gradient(135deg, #8bc905 0%, #6a9b01 100%);
            padding: 1.25rem 1.5rem;
            border-bottom: 3px solid rgba(255, 255, 255, 0.1);
        }

        .trading-header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .live-pulse-container {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.15);
            padding: 0.375rem 0.75rem;
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }

        .live-pulse {
            width: 8px;
            height: 8px;
            background: #ff4444;
            border-radius: 50%;
            animation: pulse-animation 1.5s infinite;
            box-shadow: 0 0 10px #ff4444;
        }

        @keyframes pulse-animation {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.3);
                opacity: 0.7;
            }
        }

        .live-text {
            color: white;
            font-weight: 700;
            font-size: 0.75rem;
            letter-spacing: 0.1em;
        }

        .trading-header-title {
            flex: 1;
            font-size: 1.375rem;
            font-weight: 800;
            color: white;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .trading-emoji {
            font-size: 1.75rem;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }

        .market-status {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            font-size: 0.8125rem;
            color: rgba(255, 255, 255, 0.95);
        }

        .status-item {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-weight: 600;
        }

        .status-divider {
            color: rgba(255, 255, 255, 0.4);
        }

        /* Content */
        .trading-content {
            padding: 1.75rem;
        }

        /* Trader Profile */
        .trader-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border-radius: 12px;
            border: 1px solid #e9ecef;
        }

        .trader-avatar-container {
            position: relative;
        }

        .trader-avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, #8bc905 0%, #6a9b01 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.875rem;
            box-shadow: 0 4px 12px rgba(139, 201, 5, 0.25);
        }

        .online-badge {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 14px;
            height: 14px;
            background: #10b981;
            border: 3px solid white;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.5);
        }

        .trader-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0C3A30;
            margin: 0 0 0.25rem 0;
        }

        .trader-status {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: #6b7280;
            margin: 0;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            background: #10b981;
            border-radius: 50%;
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        /* Trading Stats */
        .trading-stats {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.25rem;
            background: linear-gradient(135deg, #0C3A30 0%, #0a2f27 100%);
            border-radius: 12px;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 16px rgba(12, 58, 48, 0.3);
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.625rem;
        }

        .stat-icon {
            font-size: 1.5rem;
        }

        .stat-label {
            font-size: 0.6875rem;
            color: rgba(255, 255, 255, 0.7);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.125rem;
        }

        .stat-value {
            font-size: 1.125rem;
            font-weight: 700;
            color: #8bc905;
            text-shadow: 0 0 10px rgba(139, 201, 5, 0.3);
        }

        .stat-divider {
            width: 1px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
        }

        /* Trading Alert */
        .trading-alert {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border: 2px solid #bbf7d0;
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .alert-header {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 0.875rem;
        }

        .alert-icon-wrapper {
            flex-shrink: 0;
        }

        .alert-icon {
            font-size: 2rem;
            display: block;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .alert-content {
            flex: 1;
        }

        .alert-title {
            font-size: 1.0625rem;
            font-weight: 700;
            color: #0C3A30;
            margin-bottom: 0.5rem;
        }

        .alert-text {
            font-size: 0.9375rem;
            color: #374151;
            line-height: 1.6;
            margin: 0;
        }

        .action-hint {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            padding: 0.75rem 1rem;
            background: rgba(139, 201, 5, 0.1);
            border-radius: 8px;
            border: 1px solid rgba(139, 201, 5, 0.2);
        }

        .hint-icon {
            font-size: 1.25rem;
        }

        .hint-text {
            font-weight: 700;
            color: #0C3A30;
            font-size: 0.9375rem;
        }

        /* CTA Button */
        .trading-cta-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            width: 100%;
            padding: 1.125rem 1.5rem;
            background: linear-gradient(135deg, #8bc905 0%, #6a9b01 100%);
            color: #0C3A30;
            font-weight: 800;
            font-size: 1.0625rem;
            text-align: center;
            border-radius: 12px;
            text-decoration: none;
            box-shadow: 0 6px 20px rgba(139, 201, 5, 0.4);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .trading-cta-btn:hover {
            background: linear-gradient(135deg, #a0db06 0%, #8bc905 100%);
            box-shadow: 0 8px 28px rgba(139, 201, 5, 0.5);
            transform: translateY(-2px);
        }

        .btn-icon {
            font-size: 1.375rem;
        }

        /* Funding Guide */
        .funding-guide {
            border-top: 2px solid #e9ecef;
            padding-top: 1.5rem;
        }

        .guide-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border: 1px solid #e9ecef;
            padding: 1rem 1.25rem;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .guide-toggle:hover {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-color: #8bc905;
            box-shadow: 0 2px 8px rgba(139, 201, 5, 0.15);
        }

        .guide-toggle-left {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .guide-icon {
            font-size: 1.375rem;
        }

        .guide-title {
            font-weight: 700;
            font-size: 1rem;
            color: #0C3A30;
        }

        .guide-arrow {
            width: 24px;
            height: 24px;
            color: #6b7280;
            transition: transform 0.3s ease;
        }

        .guide-arrow.rotated {
            transform: rotate(180deg);
        }

        .guide-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .guide-content.expanded {
            max-height: 1600px;
        }

        .guide-steps {
            padding-top: 1rem;
        }

        .guide-step {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 0.875rem;
            margin-bottom: 0.625rem;
            background: white;
            border-radius: 8px;
            border: 1px solid #e9ecef;
            transition: all 0.2s ease;
        }

        .guide-step:hover {
            border-color: #8bc905;
            box-shadow: 0 2px 8px rgba(139, 201, 5, 0.1);
        }

        .step-number {
            flex-shrink: 0;
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #8bc905 0%, #6a9b01 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.875rem;
            box-shadow: 0 2px 8px rgba(139, 201, 5, 0.3);
        }

        .step-info {
            flex: 1;
        }

        .step-title {
            font-weight: 700;
            font-size: 0.9375rem;
            color: #0C3A30;
            margin-bottom: 0.25rem;
        }

        .step-detail {
            font-size: 0.875rem;
            color: #6b7280;
            line-height: 1.5;
        }

        .guide-note {
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            font-size: 0.875rem;
            line-height: 1.6;
        }

        .warning-note {
            background: #fef3c7;
            border: 1px solid #fde68a;
            color: #92400e;
        }

        .tip-note {
            background: #dbeafe;
            border: 1px solid #93c5fd;
            color: #1e40af;
        }

        .note-icon {
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .guide-note strong {
            display: block;
            margin-bottom: 0.25rem;
        }

        /* Footer */

        /* Responsive */
        @media (max-width: 640px) {
            .trading-overlay-wrapper {
                padding: 0.5rem;
            }

            .trading-overlay-container {
                padding: 50px 0 15px 0;
            }

            .trading-close-btn {
                width: 40px;
                height: 40px;
            }

            .trading-content {
                padding: 1.5rem 1.25rem;
            }

            .trading-header {
                padding: 1rem 1.25rem;
            }

            .trading-header-title {
                font-size: 1.125rem;
            }

            .trader-name {
                font-size: 1.125rem;
            }

            .trading-stats {
                flex-direction: column;
                gap: 1rem;
            }

            .stat-divider {
                width: 100%;
                height: 1px;
            }

            .stat-item {
                width: 100%;
            }

            .market-status {
                font-size: 0.75rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const overlay = document.getElementById('trading-overlay');
            if (!overlay) return;

            const closeBtn = overlay.querySelector('#overlay-close');
            const guideBtn = overlay.querySelector('.guide-toggle');
            const guideContent = overlay.querySelector('#guide-content');
            const guideArrow = overlay.querySelector('#guide-arrow');

            // SHOW OVERLAY (server already delayed it)
            overlay.style.display = 'flex';

            // Lock background scroll
            document.body.style.overflow = 'hidden';
            document.body.style.position = 'fixed';
            document.body.style.width = '100%';

            function closeOverlay() {
                overlay.remove();
                document.body.style.overflow = '';
                document.body.style.position = '';
                document.body.style.width = '';
            }

            // Close when user clicks close button (with server update)
            closeBtn.addEventListener('click', async (e) => {
                e.preventDefault();
                e.stopPropagation();

                try {
                    await fetch('{{ route("user.hide-overlay") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                } catch (err) {
                    console.error(err);
                }

                closeOverlay();
            });

            // Optional: ESC key closes overlay
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    closeOverlay();
                }
            });

            // Funding guide toggle
            guideBtn?.addEventListener('click', () => {
                guideContent.classList.toggle('expanded');
                guideArrow.classList.toggle('rotated');
            });
        });
    </script>



    @endif










    <!-- Main Dashboard Content -->
    <div class="dashboard-main-body space-y-6">


        <!-- Header with Breadcrumb -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
            <div class="flex items-center gap-4 bg-[#f0fdf4] px-2 py-3 rounded-lg shadow-sm w-full sm:w-auto">
                <div class="relative">
                    @php
                    $profilePic = $user->profile->profile_pic ?? null;

                    $initials = collect(explode(' ', $user->name))
                    ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                    ->take(2)
                    ->join('') ?: 'U';
                    @endphp

                    @if ($profilePic && file_exists(public_path('storage/profile_pics/' . $profilePic)))
                    <img src="{{ asset('storage/profile_pics/' . $profilePic) }}"
                        alt="{{ $user->name }}"
                        class="rounded-full object-cover"
                        style="width: 80px; height: 80px; border: 2px solid #8bc905;" />
                    @else

                    <div
                        class="flex items-center justify-center font-bold text-2xl text-[#0C3A30] select-none"
                        style="background-color: #8bc905; width: 80px; height: 80px; border-radius: 50%;">
                        {{ $initials }}
                    </div>
                    @endif
                </div>


                <div>
                    @php
                    $idVerification = auth()->user()->userKyc;
                    @endphp

                    <div class="flex items-center gap-2 flex-wrap">
                        <h1 class="text-lg font-semibold" style="color: #0C3A30;">
                            Hi, {{ auth()->user()->name ?? 'Guest' }}
                        </h1>

                        @if($idVerification && $idVerification->status === 'approved')
                        <!-- Verification Icon + Success Message -->
                        <div class="verified-icon" title="Identity Verified">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="#8bc905"
                                style="width: 24px; height: 24px;">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707
                             a1 1 0 00-1.414-1.414L9 10.586
                             7.707 9.293a1 1 0 00-1.414 1.414l2 2
                             a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>

                        @endif
                    </div>

                    <style>
                        .verified-icon {
                            display: inline-flex;
                            align-items: center;
                            margin-left: -3px;
                        }
                    </style>

                    <h2 class="text-sm" style="color: #0C3A30; display: flex; flex-wrap: nowrap;">
                        Here is a summary of your account.
                    </h2>
                    <h2 class="text-sm" style="color: #0C3A30;">Have fun!</h2>
                </div>

            </div>
        </div>


        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <a href="{{ route('user_dashboard') }}">
                <h6 class="font-semibold mb-0 flex items-center space-x-2 " style="color: #0C3A30;">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    <span>Dashboard</span>
                </h6>
            </a>

            <ul class="flex items-center space-x-2">

                <li>
                    <span class="h-2.5 w-2.5 rounded-full bg-red-600 animate-[blink_1s_ease-in-out_infinite]"></span>
                </li>



                <li class="font-semibold mb-0 flex items-center space-x-2 " style="color: #0C3A30;">
                    <a href="{{ route('user_live') }}">Live Trading</a>
                </li>
            </ul>

            <style>
                @keyframes blink {

                    0%,
                    100% {
                        opacity: 1;
                    }

                    50% {
                        opacity: 0;
                    }
                }
            </style>

        </div>



        <!-- verification -->

        <!-- verification -->
        @php
        use Illuminate\Support\Facades\Cache;

        $user = auth()->user();
        $idVerification = $user->userKyc;
        $hasMadeDeposit = $user->deposits()->exists();
        $alertDismissed = Cache::has('user_'.$user->id.'_id_verification_alert_dismissed');
        $status = $idVerification?->status;
        @endphp

        @if($hasMadeDeposit && !$alertDismissed && $status !== 'approved')

        <div id="verification-alert"
            style="padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center;
       @switch($status)
           @case('approved') background-color: #e6f7e6; color: #0f5132; @break <!-- Lighter green -->
           @case('pending') background-color: #fff3cd; color: #856404; @break <!-- Yellow -->
           @case('rejected') background-color: #f8d7da; color: #842029; @break
           @default background-color: #fff3cd; color: #664d03;
       @endswitch
    ">
            @switch($status)


            @case('pending')
            ⏳ Your identity verification is under review.
            @break

            @case('rejected')
            ❌ Your ID verification was rejected. Please
            <a href="{{ route('user.kyc.upload') }}" style="text-decoration: underline; font-weight: 600;">resubmit here</a>.
            @break

            @default
            ⚠️ Please <a href="{{ route('user.kyc.upload') }}" style="text-decoration: underline; font-weight: 600;">verify your identity</a> to unlock full access.
            @endswitch
        </div>
        @endif


        <script>
            function dismissVerificationAlert() {
                fetch("{{ route('user.kyc.dismiss-alert') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                    })
                    .then(() => {
                        document.getElementById('verification-alert')?.remove();
                    });
            }
        </script>





        <!-- Community Activity Feed -->
        @php
        $user = auth()->user();
        $hasMadeDeposit = $user->deposits()->exists();
        @endphp

        <!-- ================== ACTIVITY TICKER ================== -->
        <div class="activity-ticker-wrapper">
            <div class="activity-ticker-container">
                <div id="activityFeed" class="activity-feed"></div>
            </div>
        </div>

        <style>
            .activity-ticker-wrapper {
                width: 100%;
                background: transparent;
                margin: 0.5rem 0;
                padding: 0;
            }

            .activity-ticker-container {
                max-width: 100%;
                padding: 0.2rem 1rem;
            }

            .activity-feed {
                position: relative;
                min-height: 32px;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: visible;
            }

            .activity-item {
                position: absolute;
                width: 100%;
                padding: 0.2rem 1rem;
                font-size: 0.875rem;
                color: #374151;
                line-height: 1.2;
                text-align: center;
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: center;
                gap: 0.375rem;
            }

            .activity-item strong {
                color: #0C3A30;
                font-weight: 700;
                font-size: 0.95rem;
            }

            .activity-separator {
                color: #cbd5e1;
            }

            .activity-time {
                color: #9ca3af;
                font-size: 0.8125rem;
            }

            .activity-enter {
                animation: fadeSlideIn 0.8s ease-out forwards;
            }

            .activity-exit {
                animation: fadeSlideOut 0.6s ease-in forwards;
            }

            @keyframes fadeSlideIn {
                0% {
                    opacity: 0;
                    transform: translateX(40px);
                }

                100% {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes fadeSlideOut {
                0% {
                    opacity: 1;
                    transform: translateX(0);
                }

                100% {
                    opacity: 0;
                    transform: translateX(-40px);
                }
            }

            @media (max-width: 768px) {
                .activity-ticker-wrapper {
                    margin: 0.4rem 0;
                }

                .activity-ticker-container {
                    padding: 0;
                }

                .activity-feed {
                    min-height: 45px;
                }

                .activity-item {
                    font-size: 0.8125rem;
                    padding: 0.2rem 0.5rem;
                }

                .activity-item strong {
                    font-size: 0.88rem;
                }
            }

            @media (max-width: 480px) {
                .activity-feed {
                    min-height: 50px;
                }

                .activity-item {
                    font-size: 0.75rem;
                }

                .activity-item strong {
                    font-size: 0.82rem;
                }
            }
        </style>

        <script>
            /* ------------------ HELPERS ------------------ */
            const timeLabels = ['just now', '1m ago', '2m ago', '3m ago', '5m ago', '8m ago', '10m ago'];
            const tradePairs = ['BTC/USD', 'USDT', 'NASDAQ', 'TESLA', 'SPX', 'XAU/USD', 'ETH/USD', 'SOL/USD'];

            const randomItem = arr => arr[Math.floor(Math.random() * arr.length)];
            const randomTime = () => randomItem(timeLabels);
            const randomPair = () => randomItem(tradePairs);

            /* ------------------ USERS ------------------ */
            const names = [
                "Wei Chen", "Jia Hao", "Yun Lin", "Bo Yang", "Zhi Wei", "Kai Hsu", "Ming Jie",
                "Li Wang", "Xiao Zhang", "Jun Liu", "Mei Ling", "Chen Wei", "Hui Fang",
                "Yuki Tanaka", "Hiroshi Sato", "Akira Yamamoto", "Kenji Nakamura", "Takeshi Ito",
                "Min-jun Kim", "Ji-woo Park", "Sung-ho Lee", "Hye-jin Choi",
                "Julien Moreau", "Lucas Bernard", "Antoine Lefevre", "Théo Dubois", "Maxime Martin",
                "Sophie Laurent", "Amélie Petit", "Camille Rousseau", "Emma Girard", "Léa Simon",
                "Oliver Grant", "James Walker", "Henry Collins", "William Turner", "Benjamin Hayes",
                "Alexander Reed", "Daniel Brooks", "Michael Cooper", "Ryan Mitchell",
                "Emily Johnson", "Sophia Anderson", "Emma Wilson", "Olivia Martinez", "Isabella Garcia",
                "Charlotte Thompson", "Ava Robinson", "Mia Clark", "Amelia Lewis"
            ];

            // Shuffle names to mix East Asian and English names naturally
            function shuffleArray(array) {
                for (let i = array.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }
                return array;
            }

            const mixedNames = shuffleArray(names);
            let nameIndex = 0;
            const randomName = () => {
                const name = mixedNames[nameIndex % mixedNames.length];
                nameIndex++;
                return name;
            };

            /* ------------------ ACTIVITIES ------------------ */
            const activities = [{
                    action: "earned",
                    amount: "$6,400"
                },
                {
                    action: "earned",
                    amount: "$9,200"
                },
                {
                    action: "earned",
                    amount: "$11,500"
                },
                {
                    action: "deposited",
                    amount: "$18,000"
                },
                {
                    action: "started",
                    plan: "mirroring trades"
                },
                {
                    action: "upgraded",
                    tier: "To The Next Plan"
                }
            ];

            /* ------------------ FEED LOGIC ------------------ */
            let cycleIndex = 0;
            const actionTypes = ['earned', 'deposited', 'started', 'upgraded'];

            function getNextActivity() {
                const type = actionTypes[cycleIndex++ % actionTypes.length];
                return randomItem(activities.filter(a => a.action === type));
            }

            /* ------------------ RENDER ------------------ */
            function showActivity() {
                const feed = document.getElementById('activityFeed');
                if (!feed) return;

                const activity = getNextActivity();
                const el = document.createElement('div');
                el.className = 'activity-item activity-enter';

                const name = randomName();
                const pair = randomPair();
                const time = randomTime();

                let content = '';

                if (activity.action === 'earned') {
                    content = `<strong>${name}</strong> earned <strong>${activity.amount}</strong> on <strong>${pair}</strong> <span class="activity-separator">•</span> <span class="activity-time">${time}</span>`;
                } else if (activity.action === 'deposited') {
                    content = `<strong>${name}</strong> deposited <strong>${activity.amount}</strong> into <strong>${pair}</strong> <span class="activity-separator">•</span> <span class="activity-time">${time}</span>`;
                } else if (activity.action === 'started') {
                    content = `<strong>${name}</strong> started <strong>${activity.plan}</strong> <span class="activity-separator">•</span> <span class="activity-time">${time}</span>`;
                } else if (activity.action === 'upgraded') {
                    content = `<strong>${name}</strong> upgraded to <strong>${activity.tier}</strong> <span class="activity-separator">•</span> <span class="activity-time">${time}</span>`;
                }

                el.innerHTML = content;
                feed.appendChild(el);

                setTimeout(() => {
                    el.classList.remove('activity-enter');
                    el.classList.add('activity-exit');
                    setTimeout(() => el.remove(), 600);
                }, 4500);
            }

            document.addEventListener('DOMContentLoaded', function() {
                showActivity();
                setInterval(showActivity, Math.random() * 2000 + 4500);
            });
        </script>

        <!-- ================== END ACTIVITY TICKER ================== -->




        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Available Balance Card -->
            @php
            $availableBalance = auth()->user()->available_balance;
            $totalInvested = auth()->user()->amount_invested;
            @endphp

            <!-- Toggle Script -->
            <script>
                function toggleBalance(id) {
                    const amount = document.getElementById(id);
                    const icon = document.getElementById(id + '-icon');
                    if (amount.dataset.visible === 'true') {
                        amount.textContent = '****';
                        amount.dataset.visible = 'false';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    } else {
                        amount.textContent = '$' + amount.dataset.value;
                        amount.dataset.visible = 'true';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    }
                }
            </script>

            <!-- Available Balance Card -->
            <div class="rounded-2xl shadow-xl overflow-hidden min-h-[150px]"
                style="border-top: 4px solid #8bc905;background-image: url('assets/images/hero/hero-image-1.svg'); background-size: cover; background-position: center;">
                <div class="p-6 bg-white/70 backdrop-blur-md rounded-2xl">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-semibold text-[#0C3A30]">Available Balance</p>
                            <h3 class="text-2xl font-bold text-[#0C3A30] mt-1">
                                <span id="availableBalance" data-value="{{ number_format($availableBalance, 2) }}" data-visible="true">
                                    ${{ number_format($availableBalance, 2) }}
                                </span>
                                <i id="availableBalance-icon" onclick="toggleBalance('availableBalance')" class="fa fa-eye-slash cursor-pointer text-sm ml-2 text-gray-500"></i>
                            </h3>
                        </div>

                        @if($totalInvested >= 200000)


                        <div class="p-2 rounded-xl text-[#0C3A30]">
                            <form action="{{ route('initiate.reinvestment') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-2 py-2 bg-green-100 text-green-800 rounded-lg hover:bg-green-200 transition flex items-center">
                                    <iconify-icon icon="solar:refresh-circle-outline" class="mr-1 " style="color:#8bc905 !important ; font-size:1.4rem;"></iconify-icon>



                                    Reinvest
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>

                    <div class="mt-4 pt-4 border-t border-[#0C3A30]">
                        <h6 class="text-xs text-[#0C3A30]">Invested + Interest</h6>
                    </div>
                </div>
            </div>




            @php
            use Carbon\Carbon;

            $allInvestments = auth()->user()->investments()
            ->where('status','active')
            ->with('plan')
            ->orderBy('created_at', 'desc')
            ->get();

            $totalEarnedAll = 0;
            $displayCount = min(2, count($allInvestments));

            // Load daily earnings from cache or default to empty array
            $dailyEarnings = Cache::remember('user_'.auth()->id().'_daily_earnings', now()->addDay(), fn() => []);
            @endphp

            <div class="investment-performance-card bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden w-full max-w-md mx-auto"
                style="border-top: 4px solid #8bc905; background-image: url('assets/images/hero/hero-image-1.svg'); background-size: cover; background-position: center;">
                <div class="p-5">
                    <!-- Header -->
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">PROFIT PERFORMANCE</h3>
                            <h6 class="text-xs text-gray-500 mt-1">
                                <span class="pulse-dot me-2"></span>
                                Live Updates
                            </h6>
                            <style>
                                .pulse-dot {
                                    width: 6px;
                                    /* Dot size */
                                    height: 6px;
                                    background-color: #EE1325;
                                    /* Bright red */
                                    border-radius: 50%;
                                    display: inline-block;
                                    animation: pulseAnim 1.2s infinite;
                                    box-shadow: 0 0 0 rgba(238, 19, 37, 0.4);
                                }

                                @keyframes pulseAnim {
                                    0% {
                                        transform: scale(1);
                                        box-shadow: 0 0 0 0 rgba(238, 19, 37, 0.4);
                                    }

                                    70% {
                                        transform: scale(1.2);
                                        /* Smaller pulse scale */
                                        box-shadow: 0 0 0 6px rgba(238, 19, 37, 0.3);
                                        /* Subtle glow */
                                    }

                                    100% {
                                        transform: scale(1);
                                        box-shadow: 0 0 0 0 rgba(238, 19, 37, 0.4);
                                    }
                                }
                            </style>

                        </div>
                    </div>

                    <div id="investmentContainer" class="space-y-3">

                        @if($allInvestments->isEmpty())
                        <!-- EMPTY STATE -->
                        <div class="bg-gray-50 border border-dashed border-gray-300 rounded-lg p-4 text-center">
                            <video
                                src="{{ asset('assets/images/livetradevideo.mp4') }}"
                                class="w-full h-full object-cover"
                                autoplay
                                muted
                                loop
                                playsinline
                                preload="auto"
                                onloadstart="this.style.opacity='1'; document.getElementById('video-loading-main').style.display='none';"
                                onerror="this.style.display='none'; document.getElementById('fallback-content-main').style.display='flex'; document.getElementById('video-loading-main').style.display='none';"
                                style="opacity: 0; transition: opacity 0.5s ease-in-out;">
                                Your browser does not support the video tag.
                            </video>

                            <!-- Loading Spinner for main video -->
                            <div id="video-loading-main" class="absolute inset-0 flex items-center justify-center bg-slate-900 transition-opacity duration-500">
                                <div class="text-center">
                                    <div class="w-16 h-16 border-4 border-emerald-500 border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
                                    <p class="text-white text-sm">Loading live trading stream...</p>
                                </div>
                            </div>
                            <h4 class="text-sm font-semibold text-gray-700 mb-1">
                                No Active Trades Yet, you can`t go live
                            </h4>
                            <p class="text-s text-gray-500 leading-relaxed">
                                Fund Account To Start Mirroring Trades And join us <a href="{{ route('user_live') }}" style="color:red !important;">Live </a> </p>


                        </div>
                        @else
                        @foreach($allInvestments->take($displayCount) as $investment)
                        @php
                        $startDate = $investment->created_at;
                        $now = now();
                        $duration = $investment->plan->duration;
                        $rate = $investment->plan->interest_rate;
                        $amount = $investment->amount_invested;

                        $projectedTotal = $amount * (1 + $rate / 100);
                        $projectedProfit = $amount * $rate / 100;

                        $daysCompleted = max(0, $now->diffInDays($startDate));
                        $currentDay = min($daysCompleted + 1, $duration);
                        $isLongTerm = $duration > 28;

                        // Fluctuation color and icons
                        if (mt_rand(1, 100) <= 90) {
                            $fluctuation=round(mt_rand(-53, 150)/100, 2);
                            } else {
                            $fluctuation=round(mt_rand(151, 10000)/100, 2);
                            }

                            $fluctuation=($fluctuation==0) ? 0.01 : $fluctuation;
                            $isPositive=$fluctuation>= 0;
                            $fluctuationDisplay = abs($fluctuation);

                            $trendColor = $isPositive ? 'text-green-600' : 'text-red-600';
                            $borderLeftColor = $isPositive ? 'border-green-500' : 'border-red-500';
                            $progressBarColor = $isPositive ? 'bg-green-500' : 'bg-red-500';

                            // Earnings
                            $totalEarned = 0;
                            $minimumFirstDay = $projectedProfit * 0.10;

                            if ($duration === 1) {
                            $totalEarned = $projectedProfit;
                            $currentDay = 1;
                            } elseif (!$isLongTerm) {
                            if ($currentDay === 1) {
                            $totalEarned = $minimumFirstDay;
                            } else {
                            $progressRatio = min(1, ($currentDay - 1)/($duration-1));
                            $totalEarned = $minimumFirstDay + ($projectedProfit - $minimumFirstDay) * $progressRatio;
                            }
                            } else {
                            $totalWeeks = ceil($duration / 7);
                            $weeksCompleted = floor($daysCompleted / 7);
                            if ($weeksCompleted === 0) {
                            $totalEarned = 0;
                            $currentDay = 1;
                            } else {
                            $progressRatio = min(1, $weeksCompleted / $totalWeeks);
                            $totalEarned = $projectedProfit * $progressRatio;
                            $currentDay = min($weeksCompleted * 7 + 1, $duration);
                            }
                            }

                            $totalEarned = round($totalEarned,2);
                            $dailyEarnings[$investment->id] = $totalEarned;
                            $totalEarnedAll += $totalEarned;
                            $displayPercentage = min(100, round(($totalEarned/$projectedProfit)*100));
                            @endphp

                            <!-- Single Investment Card -->
                            <div class="investment-item bg-white rounded-lg p-3 border-l-4 {{ $borderLeftColor }} shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-800">{{ strtoupper($investment->plan->name) }}</span>
                                    <span class="text-xs font-bold {{ $trendColor }} flex items-center {{ $isPositive ? 'animate-fluctuation-up' : 'animate-fluctuation-down' }}" id="fluctuation-{{ $investment->id }}">
                                        @if($isPositive)
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                        </svg>
                                        @else
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                        </svg>
                                        @endif
                                        {{ $fluctuationDisplay }}%
                                    </span>
                                </div>

                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-xs text-gray-500">Day {{ $currentDay }} of {{ $duration }}</span>
                                    <span class="text-xs font-medium">
                                        <span class="{{ $totalEarned>0?'text-gray-800':'text-gray-500' }}">${{ number_format($totalEarned,2) }}</span>
                                        <span class="mx-1 text-gray-300">/</span>
                                        <span class="text-gray-700">${{ number_format($projectedProfit,2) }}</span>
                                    </span>
                                </div>

                                <!-- Progress Bar -->
                                <div class="w-full bg-gray-100 rounded-full h-1.5 mt-2">
                                    <div class="h-1.5 rounded-full {{ $progressBarColor }}" style="width: {{ $displayPercentage }}%"></div>
                                </div>
                            </div>
                            @endforeach
                            @endif

                    </div>

                    @php
                    Cache::put('user_'.auth()->id().'_daily_earnings', $dailyEarnings, now()->addDay());
                    $totalProjectedAll = $allInvestments->sum(fn($inv) => ($inv->amount_invested * $inv->plan->interest_rate)/100);
                    @endphp

                    <!-- Summary -->
                    <div class="mt-4 pt-4 border-t border-gray-200">

                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-600">Profit Earned</span>
                            <span class="text-xl font-bold text-green-600">${{ number_format($totalEarnedAll,2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                @keyframes fluctuationUp {

                    0%,
                    100% {
                        transform: translateY(0);
                    }

                    50% {
                        transform: translateY(-2px);
                    }
                }

                @keyframes fluctuationDown {

                    0%,
                    100% {
                        transform: translateY(0);
                    }

                    50% {
                        transform: translateY(2px);
                    }
                }

                .animate-fluctuation-up {
                    animation: fluctuationUp 1.5s ease-in-out infinite;
                }

                .animate-fluctuation-down {
                    animation: fluctuationDown 1.5s ease-in-out infinite;
                }

                .text-green-600 {
                    color: #16a34a !important;
                }

                .text-red-600 {
                    color: #dc2626 !important;
                }

                .investment-performance-card {
                    border-top-width: 4px;
                    border-top-color: #8bc905;
                }

                .investment-item {
                    transition: all 0.2s ease;
                }

                .investment-item:hover {
                    transform: translateY(-1px);
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
                }
            </style>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const refreshFluctuations = () => {
                        fetch('/user/fluctuations-json?refresh=' + new Date().getTime(), {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                cache: 'no-store'
                            })
                            .then(res => res.json())
                            .then(data => {
                                for (const id in data) {
                                    const span = document.getElementById('fluctuation-' + id);
                                    if (span) {
                                        span.innerHTML = data[id].html;
                                        span.className = data[id].class;
                                    }
                                }
                            });
                    };
                    setInterval(refreshFluctuations, 5000);
                    document.addEventListener('visibilitychange', () => {
                        if (!document.hidden) refreshFluctuations();
                    });
                });
            </script>





            <!-- server and admin  -->
            <!-- server and admin -->
            @if($feeds->count() > 0)

            <div class="rounded-2xl shadow-xl overflow-hidden border border-emerald-200 mt-4"
                style="border-top: 4px solid #8bc905; 
            background-size: cover; 
            background-position: center; background-image: url(assets/images/hero/hero-image-1.svg);" >

                <div class="p-0 bg-white/80 backdrop-blur-md rounded-2xl">

                    <!-- Header -->
                    <div class="flex justify-between items-center mb-2">
                        <div>
                            <h4 class=" p-3 font-semibold text-[#0C3A30]" style="font-size: 12px;">
                                ACTIVE SERVER COPYING TRADES
                            </h4>

                        </div>

                        <div class="p-3 bg-[#9EDD05]/10 rounded-xl text-[#9EDD05]">
                            <i class="fa-solid fa-server text-lg"></i>
                        </div>
                    </div>

                    <div id="feedContainer" class="space-y-4" >

                        @foreach($feeds as $index => $feed)
                        <div class="server-card p-4 bg-white/90 rounded-xl border border-[#0C3A30]/5 
                    {{ $index > 1 ? 'hidden extra-feed' : '' }}" style="background-color: white !important;">

                            <!-- Server and Admin Grid - Equal sized profiles -->
                            <div class="grid grid-cols-2 gap-4">

                                <!-- Server Section -->
                                <div class="flex items-start gap-3">
                                    <!-- Server Image - Fixed size -->
                                 <div class="flex-shrink-0">
    @if($feed->server_profile_image)
        <div class="w-11 h-11 rounded-full overflow-hidden border border-gray-200 flex items-center justify-center">
            <img src="{{ asset('storage/servers/'.$feed->server_profile_image) }}"
                 class="min-w-full min-h-full object-cover object-center">
        </div>
    @else
        <div class="w-11 h-11 rounded-full flex items-center justify-center bg-[#9EDD05] text-[#0C3A30] border border-gray-200">
            <i class="fa-solid fa-user text-sm"></i>
        </div>
    @endif
</div>

                                    <!-- Server Details - Fixed height -->
                                    <div class="flex-1 min-w-0">
                                        <h5 class="font-semibold text-xs text-[#0C3A30] mb-1 truncate max-w-[180px]" title="{{ $feed->server_name }}">
                                            {{ $feed->server_name }}
                                        </h5>
                                        <p class=" text-gray-500 semibold mb-0.5"  style="font-size: 12px;">
                                            Active: {{ number_format($feed->active_members) }}
                                        </p>
                                        <p class="semibold text-gray-400 truncate"  style="font-size: 12px;">
                                            {{ $feed->copying_trades ?? 0 }} copying
                                        </p>
                                        @if($feed->server_description)
                                        <p class="text-[8px] text-gray-400 mt-1 truncate">
                                            {{ Str::limit($feed->server_description, 30) }}
                                        </p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Admin Section -->
                                <div class="flex items-start gap-3">
                                    <!-- Admin Image - Fixed size -->
                                  <div class="flex-shrink-0">
    @if($feed->admin_profile_image)
        <div class="w-11 h-11 rounded-full overflow-hidden border border-gray-200 flex items-center justify-center">
            <img src="{{ asset('storage/admins/'.$feed->admin_profile_image) }}"
                 class="min-w-full min-h-full object-cover object-center">
        </div>
    @else
        <div class="w-11 h-11 rounded-full flex items-center justify-center bg-[#9EDD05] text-[#0C3A30] border border-gray-200">
            <i class="fa-solid fa-user text-sm"></i>
        </div>
    @endif
</div>

                                    <!-- Admin Details - Fixed height -->
                                    <div class="flex-1 min-w-0">
                                        <h5 class="font-semibold  text-[#0C3A30] mb-1 truncate" style="font-size:10px;">
                                            ADMIN
                                        </h5>
                                        <p class="bold text-gray-600 mb-0.5 truncate"  style="font-size: 12px;">
                                            {{ $feed->admin_name }}
                                        </p>
                                        <p class="text-[6px] {{ $feed->profit_margin >= 0 ? 'text-green-600' : 'text-red-600' }} font-medium" style="font-size:12px;">
                                            Profit: ${{ number_format($feed->profit_margin) }}
                                        </p>
                                        @if($feed->admin_role)
                                        <p class="text-[8px] text-gray-400 mt-1 truncate">
                                            {{ $feed->admin_role }}
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </div>


                        </div>
                        @endforeach

                    </div>

                    @if($feeds->count() > 2)
                    <div class="text-center mt-6">
                        <a href="{{ route('allserver') }}"
                            class="inline-flex items-center gap-2 px-4 py-1.5 bg-white rounded-xl text-xs font-semibold text-[#0C3A30] 
              border border-gray-200 hover:border-[#8bc905] hover:bg-[#8bc905]/5 transition">
                            View All Servers
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </a>
                    </div>
                    @endif

                </div>
            </div>

            @else
            <div class="rounded-2xl shadow-xl overflow-hidden border border-emerald-200 mt-4 p-8 text-center bg-white/80 backdrop-blur-md">
                <div class="p-3 bg-[#9EDD05]/10 rounded-xl text-[#9EDD05] inline-block mb-3">
                    <i class="fa-solid fa-server text-lg"></i>
                </div>
                <h4 class="text-sm font-semibold text-[#0C3A30] mb-1">No Servers Found</h4>
                <p class="text-xs text-gray-500">There are no servers to display at the moment.</p>
            </div>
            @endif

            <script>
                function toggleFeeds(button) {
                    let extraFeeds = document.querySelectorAll('.extra-feed');
                    let icon = button.querySelector('i');
                    let buttonSpan = button.querySelector('span');
                    let isHidden = extraFeeds[0]?.classList.contains('hidden');

                    extraFeeds.forEach(feed => {
                        feed.classList.toggle('hidden');
                    });

                    if (isHidden) {
                        buttonSpan.textContent = "View Less";
                        icon.classList.remove('fa-chevron-down');
                        icon.classList.add('fa-chevron-up');
                    } else {
                        buttonSpan.textContent = "View More";
                        icon.classList.remove('fa-chevron-up');
                        icon.classList.add('fa-chevron-down');
                    }
                }
            </script>













            <!-- Total Invested Card -->
            <div class="rounded-2xl shadow-xl overflow-hidden border border-emerald-200 min-h-[150px]"
                style="border-top: 4px solid #8bc905; background-image: url('assets/images/hero/hero-image-1.svg'); background-size: cover; background-position: center;">
                <div class="p-6 bg-white/70 backdrop-blur-md rounded-2xl">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-[#0C3A30]">Total Invested With Us</p>
                            <h3 class="text-2xl font-bold text-[#0C3A30] mt-1">
                                <span id="totalInvested" data-value="{{ number_format($totalInvested, 2) }}" data-visible="true">
                                    ${{ number_format($totalInvested, 2) }}
                                </span>
                                <i id="totalInvested-icon" onclick="toggleBalance('totalInvested')" class="fa fa-eye-slash cursor-pointer text-sm ml-2 text-gray-500"></i>

                            </h3>
                        </div>
                        <div class="p-3 rounded-xl text-[#9EDD05]">
                            <i class="fa-solid fa-award text-2xl"></i>
                        </div>
                    </div>
                    <div class="mt-6 pt-2 border-t border-[#0C3A30]">
                        <h6 class="text-xs mt-2 text-[#0C3A30]">Across all investments</h6>
                    </div>
                </div>
            </div>



            <!-- Quick Actions Card -->
            <div class="bg-gradient-to-br from-primary-800 via-primary-700 to-primary-600  rounded-2xl shadow-xl overflow-hidden min-h-[150px]"
                style="border-top: 4px solid #8bc905; background-image: url('assets/images/hero/hero-image-1.svg'); background-size: cover; background-position: center;">
                <div class="p-6">
                    <p class="text-sm font-medium text-gray-500">Quick Actions</p>
                    <div class="flex quick-actions-buttons gap-3 mt-4">
                        <a href="{{ route('user.deposit') }}"
                            class="flex-1 flex items-center justify-center gap-2 px-4 py-3 custom-hover-deposit"
                            style="border-top: 4px solid #8bc905;">
                            <iconify-icon icon="solar:wallet-outline" class="text-lg"></iconify-icon>
                            Deposit
                        </a>
                        <a href="{{ route('user.withdraw.form') }}"
                            class="flex-1 flex items-center justify-center gap-2 px-4 py-3 font-semibold rounded-lg transition-all shadow-sm"
                            style="background-color: #8bc905; color: #0C3A30; text-decoration: none;"
                            onmouseover="this.style.backgroundColor='#7dbb00'"
                            onmouseout="this.style.backgroundColor='#8bc905'">
                            <iconify-icon icon="solar:wallet-money-outline" class="text-xl"></iconify-icon>
                            Withdraw
                        </a>
                    </div>
                </div>
            </div>





        </div>

        <style>
            .quick-actions-buttons {
                flex-direction: row;
                /* Default: horizontal */
            }

            /* Tablets and smaller: stack vertically */
            @media (max-width: 1024px) {
                .quick-actions-buttons {
                    flex-direction: column;
                }

                .quick-actions-buttons>a {
                    width: 100%;
                    /* Full width buttons */
                    margin-bottom: 0.75rem;
                    /* spacing between buttons */
                }

                .quick-actions-buttons>a:last-child {
                    margin-bottom: 0;
                    /* Remove bottom margin on last button */
                }
            }
        </style>


        <!-- Activity Section -->
        <div class="flex flex-wrap gap-6 mt-6 justify-center">

            <!-- Market Charts -->
            <div class=" p-4 rounded-2xl shadow-xl border border-gray-200 w-full sm:w-[48%] lg:w-1/3" style="min-height: 520px; overflow:hidden; margin-bottom: 2.5rem;">
                <h2 class="text-lg font-bold text-[#0C3A30] mb-4">
                    Live Market Charts (Crypto, Forex, Stocks, Metaverse etc...)
                </h2>
                <div class="tradingview-widget-container" style="height: 400px;">
                    <div x-data="{ loaded: false }" x-init="setTimeout(() => { loaded = true }, 500)">
                        <template x-if="!loaded">
                            <div class="w-full h-full bg-gray-200 rounded-lg animate-pulse flex items-center justify-center">
                                <div class="text-gray-500">Loading market data...</div>
                            </div>
                        </template>
                        <template x-if="loaded">
                            <div class="tradingview-widget-container__widget"></div>
                        </template>
                    </div>
                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
                        {
                            "colorTheme": "light",
                            "dateRange": "12M",
                            "showChart": true,
                            "locale": "en",
                            "width": "100%",
                            "height": "85%",
                            "largeChartUrl": "",
                            "isTransparent": false,
                            "showSymbolLogo": true,
                            "plotLineColorGrowing": "#8bc905",
                            "plotLineColorFalling": "#f23645",
                            "gridLineColor": "rgba(240, 240, 240, 0.3)",
                            "scaleFontColor": "#0C3A30",
                            "belowLineFillColorGrowing": "rgba(139, 201, 5, 0.1)",
                            "belowLineFillColorFalling": "rgba(242, 54, 69, 0.1)",
                            "symbolActiveColor": "#9EDD05",
                            "tabs": [{
                                    "title": "Crypto",
                                    "symbols": [{
                                            "s": "BINANCE:BTCUSDT",
                                            "d": "Bitcoin"
                                        },
                                        {
                                            "s": "BINANCE:ETHUSDT",
                                            "d": "Ethereum"
                                        },
                                        {
                                            "s": "BINANCE:SOLUSDT",
                                            "d": "Solana"
                                        },
                                        {
                                            "s": "BINANCE:XRPUSDT",
                                            "d": "XRP"
                                        },
                                        {
                                            "s": "BINANCE:BNBUSDT",
                                            "d": "BNB"
                                        },
                                        {
                                            "s": "BINANCE:ADAUSDT",
                                            "d": "Cardano"
                                        },
                                        {
                                            "s": "BINANCE:DOGEUSDT",
                                            "d": "Dogecoin"
                                        },
                                        {
                                            "s": "BINANCE:MATICUSDT",
                                            "d": "Polygon"
                                        },
                                        {
                                            "s": "BINANCE:AVAXUSDT",
                                            "d": "Avalanche"
                                        },
                                        {
                                            "s": "BINANCE:DOTUSDT",
                                            "d": "Polkadot"
                                        }
                                    ]
                                },
                                {
                                    "title": "Forex",
                                    "symbols": [{
                                            "s": "FX:EURUSD",
                                            "d": "EUR/USD"
                                        },
                                        {
                                            "s": "FX:GBPUSD",
                                            "d": "GBP/USD"
                                        },
                                        {
                                            "s": "FX:USDJPY",
                                            "d": "USD/JPY"
                                        },
                                        {
                                            "s": "FX:AUDUSD",
                                            "d": "AUD/USD"
                                        },
                                        {
                                            "s": "FX:USDCAD",
                                            "d": "USD/CAD"
                                        },
                                        {
                                            "s": "FX:NZDUSD",
                                            "d": "NZD/USD"
                                        },
                                        {
                                            "s": "FX:USDCHF",
                                            "d": "USD/CHF"
                                        },
                                        {
                                            "s": "FX:EURJPY",
                                            "d": "EUR/JPY"
                                        },
                                        {
                                            "s": "FX:GBPJPY",
                                            "d": "GBP/JPY"
                                        },
                                        {
                                            "s": "FX:EURGBP",
                                            "d": "EUR/GBP"
                                        }
                                    ]
                                },
                                {
                                    "title": "Real Estate",
                                    "symbols": [{
                                            "s": "NYSE:VNQ",
                                            "d": "Vanguard REIT ETF"
                                        },
                                        {
                                            "s": "NYSE:O",
                                            "d": "Realty Income Corp"
                                        },
                                        {
                                            "s": "NYSE:PLD",
                                            "d": "Prologis"
                                        },
                                        {
                                            "s": "NYSE:AMT",
                                            "d": "American Tower"
                                        },
                                        {
                                            "s": "NYSE:EQIX",
                                            "d": "Equinix"
                                        },
                                        {
                                            "s": "NYSE:SPG",
                                            "d": "Simon Property Group"
                                        },
                                        {
                                            "s": "NYSE:AVB",
                                            "d": "AvalonBay Communities"
                                        },
                                        {
                                            "s": "NYSE:WELL",
                                            "d": "Welltower"
                                        },
                                        {
                                            "s": "NYSE:DLR",
                                            "d": "Digital Realty Trust"
                                        },
                                        {
                                            "s": "NYSE:PSA",
                                            "d": "Public Storage"
                                        }
                                    ]
                                },

                                {
                                    "title": "Travel & Booking",
                                    "symbols": [{
                                            "s": "NYSE:ABNB",
                                            "d": "Airbnb"
                                        },
                                        {
                                            "s": "NASDAQ:EXPE",
                                            "d": "Expedia"
                                        },
                                        {
                                            "s": "NYSE:BOOK",
                                            "d": "Booking Holdings"
                                        },
                                        {
                                            "s": "NYSE:MAR",
                                            "d": "Marriott Hotels"
                                        },
                                        {
                                            "s": "NYSE:HLT",
                                            "d": "Hilton Hotels"
                                        },
                                        {
                                            "s": "NYSE:AAL",
                                            "d": "American Airlines"
                                        },
                                        {
                                            "s": "NYSE:DAL",
                                            "d": "Delta Airlines"
                                        },
                                        {
                                            "s": "NASDAQ:UBER",
                                            "d": "Uber (Rideshares)"
                                        }
                                    ]
                                },
                                {
                                    "title": "Stocks",
                                    "symbols": [{
                                            "s": "NASDAQ:AAPL",
                                            "d": "Apple"
                                        },
                                        {
                                            "s": "NASDAQ:MSFT",
                                            "d": "Microsoft"
                                        },
                                        {
                                            "s": "NASDAQ:GOOGL",
                                            "d": "Alphabet"
                                        },
                                        {
                                            "s": "NASDAQ:AMZN",
                                            "d": "Amazon"
                                        },
                                        {
                                            "s": "NASDAQ:META",
                                            "d": "Meta"
                                        },
                                        {
                                            "s": "NYSE:TSLA",
                                            "d": "Tesla"
                                        },
                                        {
                                            "s": "NYSE:NVDA",
                                            "d": "NVIDIA"
                                        },
                                        {
                                            "s": "NYSE:BRK.B",
                                            "d": "Berkshire Hathaway"
                                        },
                                        {
                                            "s": "NYSE:JPM",
                                            "d": "JPMorgan Chase"
                                        },
                                        {
                                            "s": "NYSE:V",
                                            "d": "Visa"
                                        }
                                    ]
                                },
                                {
                                    "title": "Gift Cards & Payments",
                                    "symbols": [{
                                            "s": "NYSE:GCT",
                                            "d": "GiftCardMall (Gift Cards)"
                                        },
                                        {
                                            "s": "NASDAQ:PYPL",
                                            "d": "PayPal (Digital Payments)"
                                        },
                                        {
                                            "s": "NYSE:SQ",
                                            "d": "Block (Cash App)"
                                        },
                                        {
                                            "s": "NASDAQ:COIN",
                                            "d": "Coinbase (Crypto Gift Cards)"
                                        },
                                        {
                                            "s": "NYSE:V",
                                            "d": "Visa (Gift Card Partner)"
                                        },
                                        {
                                            "s": "NYSE:MA",
                                            "d": "Mastercard (Gift Cards)"
                                        }
                                    ]
                                },
                                {
                                    "title": "Luxury & Vacation",
                                    "symbols": [{
                                            "s": "NYSE:LVS",
                                            "d": "Las Vegas Sands (Resorts)"
                                        },
                                        {
                                            "s": "NYSE:RCL",
                                            "d": "Royal Caribbean (Cruises)"
                                        },
                                        {
                                            "s": "NYSE:CCL",
                                            "d": "Carnival Corp (Cruises)"
                                        },
                                        {
                                            "s": "NYSE:TNL",
                                            "d": "Travel + Leisure Co"
                                        },
                                        {
                                            "s": "NYSE:H",
                                            "d": "Hyatt Hotels"
                                        }
                                    ]
                                },
                                {
                                    "title": "Metaverse Real Estate",
                                    "symbols": [{
                                            "s": "BINANCE:SANDUSDT",
                                            "d": "The Sandbox (Virtual Land)"
                                        },
                                        {
                                            "s": "BINANCE:MANAUSDT",
                                            "d": "Decentraland (Virtual Real Estate)"
                                        },
                                        {
                                            "s": "NASDAQ:META",
                                            "d": "Meta (VR Real Estate)"
                                        },
                                        {
                                            "s": "NYSE:U",
                                            "d": "Unity (3D Virtual Spaces)"
                                        }
                                    ]
                                },
                                {
                                    "title": "Commodities",
                                    "symbols": [{
                                            "s": "TVC:USOIL",
                                            "d": "Crude Oil"
                                        },
                                        {
                                            "s": "TVC:GOLD",
                                            "d": "Gold"
                                        },
                                        {
                                            "s": "TVC:SILVER",
                                            "d": "Silver"
                                        },
                                        {
                                            "s": "TVC:NATURALGAS",
                                            "d": "Natural Gas"
                                        },
                                        {
                                            "s": "TVC:COPPER",
                                            "d": "Copper"
                                        },
                                        {
                                            "s": "TVC:PLATINUM",
                                            "d": "Platinum"
                                        },
                                        {
                                            "s": "TVC:PALLADIUM",
                                            "d": "Palladium"
                                        },
                                        {
                                            "s": "TVC:CORN",
                                            "d": "Corn"
                                        },
                                        {
                                            "s": "TVC:WHEAT",
                                            "d": "Wheat"
                                        },
                                        {
                                            "s": "TVC:SOYBEAN",
                                            "d": "Soybean"
                                        }
                                    ]
                                },
                                {
                                    "title": "Indices",
                                    "symbols": [{
                                            "s": "FOREXCOM:SPXUSD",
                                            "d": "S&P 500"
                                        },
                                        {
                                            "s": "FOREXCOM:DJI",
                                            "d": "Dow Jones"
                                        },
                                        {
                                            "s": "NASDAQ:NDX",
                                            "d": "Nasdaq 100"
                                        },
                                        {
                                            "s": "FOREXCOM:NSXUSD",
                                            "d": "Nasdaq Composite"
                                        },
                                        {
                                            "s": "FOREXCOM:UK100",
                                            "d": "FTSE 100"
                                        },
                                        {
                                            "s": "FOREXCOM:DE30EUR",
                                            "d": "DAX"
                                        },
                                        {
                                            "s": "FOREXCOM:FR40EUR",
                                            "d": "CAC 40"
                                        },
                                        {
                                            "s": "FOREXCOM:EU50EUR",
                                            "d": "Euro Stoxx 50"
                                        },
                                        {
                                            "s": "FOREXCOM:HK50HKD",
                                            "d": "Hang Seng"
                                        },
                                        {
                                            "s": "FOREXCOM:JP225USD",
                                            "d": "Nikkei 225"
                                        }
                                    ]
                                },
                                {
                                    "title": "Trending",
                                    "symbols": [{
                                            "s": "BINANCE:SHIBUSDT",
                                            "d": "Shiba Inu"
                                        },
                                        {
                                            "s": "BINANCE:TRXUSDT",
                                            "d": "Tron"
                                        },
                                        {
                                            "s": "BINANCE:NEARUSDT",
                                            "d": "Near Protocol"
                                        },
                                        {
                                            "s": "BINANCE:LINKUSDT",
                                            "d": "Chainlink"
                                        },
                                        {
                                            "s": "BINANCE:ATOMUSDT",
                                            "d": "Cosmos"
                                        },
                                        {
                                            "s": "BINANCE:ALGOUSDT",
                                            "d": "Algorand"
                                        },
                                        {
                                            "s": "BINANCE:APTUSDT",
                                            "d": "Aptos"
                                        },
                                        {
                                            "s": "BINANCE:HBARUSDT",
                                            "d": "Hedera"
                                        },
                                        {
                                            "s": "BINANCE:VETUSDT",
                                            "d": "VeChain"
                                        },
                                        {
                                            "s": "BINANCE:FTMUSDT",
                                            "d": "Fantom"
                                        }
                                    ]
                                }
                            ]
                        }
                    </script>
                </div>
            </div>




        </div>


        <!-- Recent Activity -->

        <div class="rounded-2xl shadow-xl p-6 border border-gray-600 w-full sm:w-[48%] lg:w-1/3" style=" background-image: url('assets/images/hero/hero-image-1.svg');">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-primary-800">Recent Activity</h3>
                <div class="relative" x-data="{ activityFilterOpen: false }">
                    <button @click="activityFilterOpen = !activityFilterOpen"
                        class="flex items-center gap-2 px-3 py-2 rounded-lg bg-white border border-gray-200 shadow-xs hover:bg-primary-50 hover:border-primary-300 hover:text-primary-800 transition-all duration-200">
                        <iconify-icon icon="mdi:filter-outline" class="text-lg text-primary-600"></iconify-icon>
                        <span class="text-sm font-medium">Filter</span>
                    </button>
                    <div x-show="activityFilterOpen" @click.away="activityFilterOpen = false"
                        class="absolute right-0 mt-2 w-48 rounded-md  shadow-lg z-50 py-1 border border-gray-200" style="background-color: white !important;">
                        <a href="#" @click.prevent="$dispatch('filter-activities', 'all')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2">
                            <iconify-icon icon="mdi:format-list-bulleted" class="text-lg"></iconify-icon>
                            All Activities
                        </a>
                        <a href="#" @click.prevent="$dispatch('filter-activities', 'deposit')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2">
                            <iconify-icon icon="mdi:cash-plus" class="text-lg text-emerald-500"></iconify-icon>
                            Deposits
                        </a>
                        <a href="#" @click.prevent="$dispatch('filter-activities', 'withdrawal')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2">
                            <iconify-icon icon="mdi:cash-minus" class="text-lg text-red-500"></iconify-icon>
                            Withdrawals
                        </a>
                        <a href="#" @click.prevent="$dispatch('filter-activities', 'investment')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2">
                            <iconify-icon icon="mdi:chart-line" class="text-lg text-blue-500"></iconify-icon>
                            Investments
                        </a>
                    </div>
                </div>
            </div>

            <div class="space-y-4 h-[65vh] min-h-[400px] max-h-[700px] overflow-y-auto w-full pr-2"
                x-data="{
            activityFilter: 'all',
            init() {
                window.addEventListener('filter-activities', event => {
                    this.activityFilter = event.detail;
                });
            },
            filterType(type) {
                if (this.activityFilter === 'all') return true;
                return type.toLowerCase() === this.activityFilter;
            }
         }">
                @forelse ($recentActivities as $activity)
                @php
                $typeKey = strtolower(explode(' ', $activity['type'])[0]);

                $status = strtolower($activity['status']);
                $badgeClass = match($status) {
                'pending' => 'badge-pending',
                'ready to withdraw' => 'badge-warning',
                'active' => 'badge-active',
                'completed', 'approved' => 'badge-completed',
                'rejected' => 'badge-rejected',

                default => 'badge-default'
                };

                $amountClass = match($activity['type']) {
                'Deposit' => 'text-emerald-600',
                'Withdrawal' => 'text-red-600',
                'Investment Matured' => 'text-amber-600',
                'Investment Active' => 'text-blue-600',
                default => 'text-gray-600'
                };

                $borderClass = match($activity['type']) {
                'Deposit' => 'border-emerald-500',
                'Withdrawal' => 'border-red-500',
                'Investment Matured' => 'border-amber-500',
                'Investment Active' => 'border-blue-500',
                default => 'border-gray-300'
                };
                @endphp

                <template x-if="filterType('{{ $typeKey }}')">
                    <div class="bg-white border {{ $borderClass }} border-l-4 rounded-2xl shadow-xl p-5 w-full hover:bg-gray-50 transition-colors max-w-full flex justify-between items-center gap-4">
                        <div class="flex items-center gap-4">
                            <div class="p-3 rounded-lg 
                            @if($typeKey === 'deposit') bg-emerald-100
                            @elseif($typeKey === 'withdrawal') bg-red-100
                            @elseif($typeKey === 'investment') bg-blue-100
                            @elseif($typeKey === 'investment') bg-amber-100
                            @else bg-gray-100 @endif
                        ">
                                <iconify-icon icon="mdi:{{ $activity['icon'] }}"
                                    class="@if($typeKey === 'deposit') text-emerald-600
                                @elseif($typeKey === 'withdrawal') text-red-600
                                @elseif($typeKey === 'investment') text-blue-600
                                @elseif($typeKey === 'investment') text-amber-600
                                @else text-gray-600 @endif
                            text-xl"></iconify-icon>
                            </div>

                            <div class="flex flex-col min-w-0">
                                <p class="font-medium text-gray-900 truncate">{{ $activity['type'] }}</p>
                                <p class="text-sm text-gray-500">{{ $activity['date']->format('M d, h:i A') }}</p>

                                @if(in_array($activity['type'], ['Investment Active', 'Investment Matured']))
                                <p class="text-xs text-gray-600 mt-1 truncate">Plan: {{ $activity['plan_name'] }}</p>
                                @else
                                <p class="text-xs text-gray-400 truncate">{{ $activity['reference'] }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="text-right space-y-1 ml-2 min-w-[100px]">
                            @if(in_array($activity['type'], ['Deposit', 'Withdrawal', 'Investment Matured']))
                            <p class="{{ $amountClass }} font-semibold whitespace-nowrap">
                                {{ $activity['type'] === 'Deposit' ? '+' : '-' }}${{ number_format($activity['amount'], 2) }}
                            </p>
                            @endif

                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $badgeClass }} mb-1">
                                {{ ucfirst($activity['status']) }}
                            </span>

                            @if($activity['action_url'] && $activity['action_text'])
                            <a href="{{ $activity['action_url'] }}" class="inline-block text-xs bg-gray-800 hover:bg-gray-900 text-white px-3 py-1 rounded whitespace-nowrap">
                                {{ $activity['action_text'] }}
                            </a>
                            @endif
                        </div>
                    </div>
                </template>
                @empty
                <div class="text-center py-8">
                    <iconify-icon icon="mdi:inbox-remove-outline" class="text-4xl text-gray-300"></iconify-icon>
                    <p class="text-gray-400 text-sm mt-2">No recent activity available</p>
                    <a href="{{ route('user.deposit') }}" class="mt-3 inline-block text-sm text-primary-600 hover:text-primary-800 font-medium">
                        Make your first deposit
                    </a>
                </div>
                @endforelse
            </div>
        </div>

        <style>
            .badge-completed {
                background-color: #d1fae5;
                /* Tailwind's bg-green-100 */
                color: #065f46;
                /* Tailwind's text-green-800 */
                padding: 0.25rem 0.5rem;
                border-radius: 9999px;
                font-weight: 500;
                font-size: 0.75rem;
            }

            .badge-pending {
                background-color: #fef3c7;
                /* Tailwind's bg-yellow-100 */
                color: #92400e;
                /* Tailwind's text-yellow-800 */
                padding: 0.25rem 0.5rem;
                border-radius: 9999px;
                font-weight: 500;
                font-size: 0.75rem;
            }

            .badge-rejected {
                background-color: #ff6767ff;
                color: #fff;
                padding: 0.25rem 0.5rem;
                border-radius: 9999px;
                font-weight: 500;
                font-size: 0.75rem;
            }


            .badge-warning {
                background-color: #fde68a;
                /* Tailwind's bg-yellow-300 */
                color: #92400e;
                padding: 0.25rem 0.5rem;
                border-radius: 9999px;
                font-weight: 500;
                font-size: 0.75rem;
            }

            .badge-active {
                background-color: #dbeafe;
                /* Tailwind's bg-blue-100 */
                color: #1d4ed8;
                /* Tailwind's text-blue-700 */
                padding: 0.25rem 0.5rem;
                border-radius: 9999px;
                font-weight: 500;
                font-size: 0.75rem;
            }

            .badge-default {
                background-color: #f3f4f6;
                color: #374151;
                padding: 0.25rem 0.5rem;
                border-radius: 9999px;
                font-weight: 500;
                font-size: 0.75rem;
            }
        </style>


        <!-- Motivational Quote -->
        <!-- Motivational Quote -->
        <div x-data="quoteRotator()" x-init="startRotation()"
            class="relative rounded-2xl overflow-hidden shadow-2xl pt-8 min-h-[240px] w-full sm:w-[48%] lg:w-1/3 flex items-center justify-center text-center">

            <div class="absolute inset-0 bg-[#0C3A30]/80 backdrop-blur-sm"
                style="background-image: url('https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?auto=format&fit=crop&w=1350&q=80');">
            </div>

            <div class="relative z-10 px-4 sm:px-8 w-full text-white" style="color: white !important;">
                <div x-transition:enter="transition-opacity duration-700"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-500"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">

                    <p class="text-xl sm:text-2xl font-semibold italic leading-relaxed"
                        style="color: white !important;"
                        x-text="quotes[currentIndex].quote">
                    </p>

                    <p class="text-sm mt-4"
                        style="color: white !important;"
                        x-text="quotes[currentIndex].author">
                    </p>

                </div>
            </div>
        </div>


    </div>
</div>

<!-- Language Selector -->
<div class="languageTranslateWrapper flex items-center gap-1 pl-2 pr-2 py-1">
    <div class="languageTranslate" id="google_translate_element">🌐</div>
</div>
</div>

<!-- Scripts -->
<script>
    function quoteRotator() {
        return {
            quotes: [{
                    quote: '"Compound interest is the eighth wonder of the world. He who understands it, earns it; he who doesn\'t, pays it."',
                    author: '- Albert Einstein'
                },
                {
                    quote: '"The stock market is filled with individuals who know the price of everything, but the value of nothing."',
                    author: '- Philip Fisher'
                },
                {
                    quote: '"Do not save what is left after spending, but spend what is left after saving."',
                    author: '- Warren Buffett'
                }
            ],
            currentIndex: 0,
            startRotation() {
                setInterval(() => {
                    this.currentIndex = (this.currentIndex + 1) % this.quotes.length;
                }, 6000);
            }
        }
    }
</script>

<style>
    .quick-actions-buttons {
        flex-direction: row;
    }

    @media (max-width: 1024px) {
        .quick-actions-buttons {
            flex-direction: column;
        }

        .quick-actions-buttons>a {
            width: 100%;
            margin-bottom: 0.75rem;
        }

        .quick-actions-buttons>a:last-child {
            margin-bottom: 0;
        }
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @media (min-width: 1024px) {
        .tradingview-widget-container {
            height: 600px;
        }
    }

    @media (max-width: 1023px) {
        .tradingview-widget-container {
            height: 500px;
        }
    }

    @media (max-width: 768px) {
        .tradingview-widget-container {
            height: 400px;
        }
    }

    /* Default: no margin on small screens (mobile) */
    .main-content {
        margin-left: 0;
        transition: margin-left 0.3s ease;
    }

    /* Only on mid-sized screens (like fold phones / tablets) */
    @media (min-width: 1024px) and (max-width: 1199px) {
        .main-content {
            margin-left: 260px;
        }
    }
</style>



</div>
@endsection