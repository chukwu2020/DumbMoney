@extends('layout.user')

@section('content')
<style>
    :root {
        --primary-green: #9EDD05;
        --dark-green: #0C3A30;
        --accent-green: #8AC304;
    }

    /* ===== CARD STYLES ===== */
    .glass-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 2px solid #e5e7eb;
        border-radius: 20px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .glass-card::before {
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

    .glass-card:hover::before { opacity: 1; }
    .glass-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.08);
    }

    /* ===== ADMIN/SERVER GRID ===== */
    .admin-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .admin-card {
        background: white;
        border-radius: 16px;
        padding: 1.25rem;
        border: 2px solid #e5e7eb;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .admin-card:hover {
        border-color: var(--primary-green);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(158,221,5,0.15);
    }

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
    }

    .admin-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .admin-avatar .fallback-icon { color: var(--dark-green); font-size: 1.25rem; }

    /* ===== STAT BADGES ===== */
    .admin-stats { display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 0.5rem; }

    .stat-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.25rem 0.625rem;
        border-radius: 0.5rem;
        font-size: 0.7rem;
        transition: all 0.2s ease;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
    }

    .stat-badge:hover { transform: translateY(-1px); box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    .stat-badge .stat-icon { font-size: 0.75rem; }
    .stat-badge .stat-label { font-weight: 500; color: #6b7280; }
    .stat-badge .stat-value { font-weight: 700; }

    .stat-badge.win-rate.high { background: linear-gradient(135deg,#f0fdf4,#dcfce7); border-color: #86efac; }
    .stat-badge.win-rate.high .stat-icon { color: #16a34a; }
    .stat-badge.win-rate.high .stat-value { color: #15803d; }
    .stat-badge.win-rate.medium { background: linear-gradient(135deg,#fef9c3,#fef08a); border-color: #fde047; }
    .stat-badge.win-rate.medium .stat-icon { color: #ca8a04; }
    .stat-badge.win-rate.medium .stat-value { color: #a16207; }
    .stat-badge.win-rate.low { background: linear-gradient(135deg,#fee2e2,#fecaca); border-color: #fca5a5; }
    .stat-badge.win-rate.low .stat-icon { color: #dc2626; }
    .stat-badge.win-rate.low .stat-value { color: #b91c1c; }
    .stat-badge.profit.high { background: linear-gradient(135deg,#f0fdf4,#dcfce7); border-color: #86efac; }
    .stat-badge.profit.high .stat-icon { color: #16a34a; }
    .stat-badge.profit.high .stat-value { color: #15803d; }
    .stat-badge.profit.low { background: linear-gradient(135deg,#fee2e2,#fecaca); border-color: #fca5a5; }
    .stat-badge.profit.low .stat-icon { color: #dc2626; }
    .stat-badge.profit.low .stat-value { color: #b91c1c; }

    /* ===== PLAN CARDS ===== */
    .plan-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
    }

    .plan-card {
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 20px;
        padding: 1.5rem;
        transition: all 0.2s ease;
        cursor: pointer;
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
        /* FIX: default — allow events */
        pointer-events: auto;
        user-select: none;
    }

    .plan-card:hover {
        border-color: var(--primary-green);
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(158,221,5,0.15);
    }

    .plan-card.selected {
        border-color: var(--primary-green);
        background: linear-gradient(135deg, #ffffff, #f8fff5);
        box-shadow: 0 12px 24px rgba(158,221,5,0.2);
    }

    .change-trader-btn {
        background: linear-gradient(135deg, #9EDD05, #8AC304);
        color: #0C3A30 !important;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.25s ease;
        box-shadow: 0 4px 12px rgba(158,221,5,0.25);
    }
    .change-trader-btn:hover { background: linear-gradient(135deg,#8AC304,#9EDD05); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(158,221,5,0.35); }
    .change-trader-btn:active { transform: scale(0.97); box-shadow: 0 3px 8px rgba(158,221,5,0.2); }
    .change-trader-btn:disabled { opacity: 0.6; cursor: not-allowed; }

    /* ─────────────────────────────────────────────────────────────
       FIX: limit-reached — block ALL interaction completely
       pointer-events:none  → no clicks, no taps, no hover
       We overlay a transparent shield div instead for the tooltip
    ───────────────────────────────────────────────────────────── */
    .plan-card.limit-reached {
        opacity: 0.55;
        cursor: not-allowed !important;
        border-color: #ef4444 !important;
        pointer-events: none;          /* ← KEY FIX: blocks click/touch */
        transform: none !important;
        box-shadow: none !important;
    }

    /* Shield sits on top, absorbs any remaining events and shows cursor */
    .plan-card.limit-reached .limit-shield {
        position: absolute;
        inset: 0;
        z-index: 20;
        cursor: not-allowed;
        pointer-events: auto;          /* shield is clickable, card content is not */
        border-radius: 18px;
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
        color: var(--dark-green);
        font-size: 14px;
        font-weight: bold;
    }

    .plan-card.selected .plan-checkmark { display: flex; animation: popIn 0.3s ease; }

    @keyframes popIn {
        0%   { transform: scale(0); }
        50%  { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    /* ===== BADGES & TAGS ===== */
    .style-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 12px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 600;
        background: #f3f4f6;
        color: #374151;
    }

    .style-badge.purple { background: #f3e8ff; color: #6b21a8; }
    .style-badge.green  { background: #dcfce7; color: #166534; }
    .style-badge.yellow { background: #fef9c3; color: #854d0e; }
    .style-badge.red    { background: #fee2e2; color: #991b1b; }
    .style-badge.blue   { background: #dbeafe; color: #1e40af; }

    .feature-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 30px;
        font-size: 11px;
        color: #4b5563;
        transition: all 0.2s ease;
    }
    .feature-pill:hover { border-color: var(--primary-green); background: #f0fdf4; }

    /* ===== FORM ELEMENTS ===== */
    .amount-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2rem;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.2s ease;
    }
    .amount-input:focus { outline: none; border-color: var(--primary-green); box-shadow: 0 0 0 3px rgba(158,221,5,0.1); }
    .amount-input:disabled { background: #f9fafb; cursor: not-allowed; }

    .preset-btn {
        padding: 0.5rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-weight: 600;
        color: var(--dark-green);
        background: white;
        transition: all 0.2s ease;
        cursor: pointer;
        font-size: 13px;
    }
    .preset-btn:hover { border-color: var(--primary-green); background: #f8faf7; }
    .preset-btn.active { background: var(--primary-green); border-color: var(--primary-green); color: var(--dark-green); }

    .submit-btn {
        width: 100%;
        padding: 0.875rem;
        background: linear-gradient(135deg, var(--primary-green), var(--accent-green));
        color: var(--dark-green);
        font-weight: 700;
        font-size: 1rem;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .submit-btn:hover:not(:disabled) { transform: translateY(-2px); box-shadow: 0 8px 16px rgba(158,221,5,0.3); }
    .submit-btn:disabled { opacity: 0.5; cursor: not-allowed; transform: none !important; box-shadow: none !important; }
    .submit-btn.submitting { background: linear-gradient(135deg,#8AC304,#7AB503); cursor: wait; pointer-events: none; opacity: 0.8; }

    .loading-spinner {
        display: inline-block;
        width: 18px;
        height: 18px;
        border: 2px solid rgba(12,58,48,0.3);
        border-top-color: #0C3A30;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        margin-right: 8px;
        vertical-align: middle;
    }
    @keyframes spin { to { transform: rotate(360deg); } }

    /* ===== STAT CARDS ===== */
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 1.25rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        border-left: 4px solid;
        transition: all 0.2s ease;
    }
    .stat-card:hover { transform: translateY(-2px); box-shadow: 0 12px 24px rgba(0,0,0,0.08); }
    .stat-card.green   { border-color: var(--primary-green); }
    .stat-card.success { border-color: #10b981; }
    .stat-card.info    { border-color: #3b82f6; }
    .stat-card.warning { border-color: #f59e0b; }

    /* ===== UTILITY ===== */
    .balance-highlight { font-size: 2rem; font-weight: 700; line-height: 1.2; color: var(--dark-green); }
    .text-small { font-size: 0.75rem; color: #6b7280; }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .animate-slide-up { animation: slideUp 0.5s ease forwards; }

    .asset-tag { background: #f3f4f6; padding: 2px 8px; border-radius: 20px; font-size: 0.7rem; color: #4b5563; }

    /* ===== CHANGE ADMIN ===== */
    #changeAdminSelect { transition: all 0.2s ease; cursor: pointer; background-color: #ffffff; }
    #changeAdminSelect:hover { border-color: var(--primary-green); box-shadow: 0 2px 8px rgba(158,221,5,0.1); }
    #changeAdminSelect:focus { border-color: var(--primary-green); box-shadow: 0 0 0 3px rgba(158,221,5,0.1); outline: none; }
    #changeAdminBtn { transition: all 0.3s ease; cursor: pointer; }
    #changeAdminBtn:active { transform: scale(0.98); }

    /* ===== TOAST ===== */
    .toast-message {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        padding: 0.875rem 1.5rem;
        border-radius: 12px;
        font-size: 0.875rem;
        font-weight: 600;
        z-index: 9999;
        animation: slideUp 0.3s ease;
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    }
    .toast-message.success { background: #dcfce7; color: #166534; border: 1px solid #86efac; }
    .toast-message.error   { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .admin-grid { grid-template-columns: 1fr; gap: 1rem; }
        .admin-card { padding: 1rem; }
        .admin-avatar { width: 40px; height: 40px; }
        .glass-card { padding: 1rem; }
        .gap-6 { gap: 1rem; }
        .admin-stats { gap: 0.375rem; }
        .stat-badge { padding: 0.1875rem 0.5rem; font-size: 0.65rem; }
        select#changeAdminSelect, button#changeAdminBtn { width: 100%; }
        button#changeAdminBtn { justify-content: center; }
    }

    @media (max-width: 480px) {
        .admin-card { padding: 0.75rem; }
        .admin-avatar { width: 36px; height: 36px; }
        .glass-card { padding: 0.75rem; }
        .mt-6 { margin-top: 0.8rem; }
    }

    @media (min-width: 1025px) {
        #changeAdminSelect { max-width: 450px; }
        #changeAdminBtn { min-width: 160px; padding: 0.75rem 2rem; }
    }
</style>

<div class="dashboard-main-body">

    <div class="flex items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold mb-0">Copy Trading</h6>
        <ul class="flex items-center gap-[6px] text-sm">
            <li>
                <a href="{{ route('user_dashboard') }}" class="flex items-center gap-2 hover:text-primary-600">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li>
                <a href="{{ route('user_dashboard') }}" class="flex items-center gap-2 hover:text-primary-600">
                    <iconify-icon icon="solar:users-group-rounded" class="text-lg"></iconify-icon>
                    Trading
                </a>
            </li>
        </ul>
    </div>

    <!-- Trader Info Card -->
    <div class="glass-card mb-8" style="background-image: url('assets/images/hero/hero-image-1.svg'); background-size: cover; background-position: center;">
        <h6 class="text-gray-500 mb-3 text-xs">You will be copying your admin's trades</h6>
        <div class="flex flex-col lg:flex-row items-start justify-between gap-6">
            <div class="admin-grid w-full lg:w-auto">

                <!-- Server Card -->
                <div class="admin-card">
                    <div class="flex items-start gap-3">
                        <div class="admin-avatar flex-shrink-0">
                            @if(isset($copyAdmin) && $copyAdmin->server_profile_image)
                            <img src="{{ asset('storage/servers/'.$copyAdmin->server_profile_image) }}" alt="Server">
                            @else
                            <div class="fallback-icon">
                                <iconify-icon icon="ph:server-fill" class="text-xl" style="color: #8bc905;"></iconify-icon>
                            </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h5 class="font-semibold text-sm text-[#0C3A30] mb-1 truncate">
                                {{ $copyAdmin->server_name ?? $user->copy_server_name ?? 'Official Server' }}
                            </h5>
                            @if($copyAdmin)
                            <p class="text-gray-500 font-semibold text-xs mb-0.5">
                                <i class="fa-solid fa-users mr-1"></i>
                                {{ number_format($copyAdmin->active_members) }} active
                            </p>
                            <p class="text-gray-400 font-semibold text-xs truncate">
                                <i class="fa-solid fa-copy mr-1"></i>
                                {{ $copyAdmin->copying_trades ?? 0 }} copying
                            </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Admin Card -->
                <div class="admin-card">
                    <div class="flex items-start gap-3">
                        <div class="admin-avatar flex-shrink-0">
                            @if(isset($copyAdmin) && $copyAdmin->admin_profile_image)
                            <img src="{{ asset('storage/admins/'.$copyAdmin->admin_profile_image) }}" alt="Admin">
                            @else
                            <div class="fallback-icon">
                                <iconify-icon icon="ph:user-circle-fill" class="text-xl" style="color: #8bc905;"></iconify-icon>
                            </div>
                            @endif
                        </div>
                        <div class="admin-info flex-1">
                            <h5 class="admin-label text-[10px] font-semibold text-gray-400 mb-0.5">ADMIN</h5>
                            <p class="admin-name font-bold text-gray-700 text-sm mb-2 truncate">
                                {{ $copyAdmin->admin_name ?? $user->copy_admin_name ?? 'Platform Admin' }}
                            </p>
                            @if($copyAdmin)
                            @php
                                $profitClass = $copyAdmin->profit_margin >= 0 ? 'high' : 'low';
                                $winRateClass = 'low';
                                if ($copyAdmin->win_rate >= 70) $winRateClass = 'high';
                                elseif ($copyAdmin->win_rate >= 50) $winRateClass = 'medium';
                            @endphp
                            <div class="admin-stats">
                                <div class="stat-badge profit {{ $profitClass }}">
                                    <iconify-icon icon="ph:chart-line-up-fill" class="stat-icon"></iconify-icon>
                                    <span class="stat-label">Profit</span>
                                    <span class="stat-value">${{ number_format(abs($copyAdmin->profit_margin ?? 0), 2) }}</span>
                                </div>
                                <div class="stat-badge win-rate {{ $winRateClass }}">
                                    <iconify-icon icon="ph:trophy-fill" class="stat-icon"></iconify-icon>
                                    <span class="stat-label">Win Rate</span>
                                    <span class="stat-value">{{ number_format($copyAdmin->win_rate ?? 0, 1) }}%</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <!-- Balance -->
            <div class="balance-section w-full lg:w-auto mt-2 lg:mt-0">
                <div class="flex items-center justify-between lg:justify-end gap-3">
                    <div class="balance-info">
                        <p class="text-[10px] text-gray-500 mb-0">Available Balance</p>
                        <div class="text-base md:text-sm font-semibold text-[#0C3A30]">
                            ${{ number_format($user->available_balance, 2) }}
                        </div>
                    </div>
                    <a href="{{ route('user.deposit') }}"
                        style="background-color: #7AB503; color:#0C3A30 !important; white-space: nowrap;"
                        class="inline-flex items-center gap-1 text-[10px] px-2 py-1 rounded font-semibold hover:bg-[#8AC304] transition">
                        <iconify-icon icon="ph:plus-bold" class="text-xs"></iconify-icon>
                        Add Funds
                    </a>
                </div>
            </div>
        </div>

        <!-- Change Admin -->
        <div class="mt-6 pt-4 border-t border-gray-200">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-end">
                <div class="lg:col-span-2">
                    <label class="text-xs font-semibold text-gray-600 mb-2 block">
                        <iconify-icon icon="ph:user-switch-fill" class="inline mr-1 text-sm"></iconify-icon>
                        Switch to Another Admin
                    </label>
                    <select id="changeAdminSelect"
                        class="w-full border-2 border-gray-200 rounded-xl p-3 text-sm focus:border-[#9EDD05] focus:outline-none transition bg-white shadow-sm">
                        <option value="">-- Select an Admin to Copy --</option>
                        @foreach(\App\Models\ServerFeed::where('copy_trading_enabled', true)->get() as $server)
                        <option value="{{ $server->id }}" {{ ($user->copy_admin_id == $server->id) ? 'selected' : '' }}>
                            {{ $server->admin_name }} ({{ $server->server_name }})
                            @if($server->win_rate) - Win Rate: {{ $server->win_rate }}% @endif
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="lg:col-span-1 flex justify-start lg:justify-end">
                    <button id="changeAdminBtn"
                        class="change-trader-btn inline-flex items-center gap-2 px-6 py-3 font-bold rounded-xl text-sm">
                        <iconify-icon icon="ph:arrows-clockwise-fill" class="text-lg"></iconify-icon>
                        <span>Change Trader</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Alert -->
    @if($pendingRequests->count() > 0)
    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-8 animate-slide-up">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center">
                <iconify-icon icon="ph:clock-fill" class="text-2xl text-amber-600"></iconify-icon>
            </div>
            <div class="flex-1">
                <h4 class="font-semibold text-amber-800">Pending Requests ({{ $pendingRequests->count() }})</h4>
                <p class="text-sm text-amber-700">Your copy trading requests are awaiting admin approval.</p>
            </div>
            <a href="{{ route('copy-trading.history') }}"
                class="px-4 py-2 bg-white text-amber-700 rounded-lg hover:bg-amber-50 transition text-sm font-semibold shadow-sm">
                View Status
            </a>
        </div>
    </div>
    @endif

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Plan Selection -->
        <div class="lg:col-span-2">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold" style="color: var(--dark-green);">
                    Trading Plans <span class="font-bold">– Click one</span>
                </h2>
                <span class="text-sm text-gray-500 font-bold">{{ $plans->count() }} plans</span>
            </div>

            <div class="plan-grid" id="planGrid">
                @foreach($plans as $plan)
                @php
                    $userActiveParticipations = App\Models\Investment::where('user_id', auth()->id())
                        ->where('plan_id', $plan->id)
                        ->where('type', 'copy_trading')
                        ->where('status', 'active')
                        ->count();

                    $userPendingParticipations = App\Models\CopyTradingRequest::where('user_id', auth()->id())
                        ->where('plan_id', $plan->id)
                        ->where('status', 'pending')
                        ->count();

                    $planLimit = $plan->max_participations ?? 3;
                    $totalParticipations = $userActiveParticipations + $userPendingParticipations;
                    $isLimitReached = $totalParticipations >= $planLimit;
                @endphp

                <div class="plan-card {{ $isLimitReached ? 'limit-reached' : '' }}"
                    style="background-image: url('assets/images/hero/hero-image-1.svg'); background-size: cover; background-position: center;"
                    data-plan-id="{{ $plan->id }}"
                    data-min="{{ $plan->minimum_amount }}"
                    data-max="{{ $plan->maximum_amount }}"
                    data-rate="{{ $plan->interest_rate }}"
                    data-duration="{{ $plan->duration }}"
                    data-duration-unit="{{ $plan->duration_unit ?? 'days' }}"
                    data-name="{{ $plan->name }}"
                    data-max-participations="{{ $planLimit }}"
                    data-limit-reached="{{ $isLimitReached ? 'true' : 'false' }}">

                    {{--
                        FIX: Shield div sits above all card content on limit-reached cards.
                        pointer-events:none on the card blocks children too, so the shield
                        re-enables events only for the "not allowed" cursor experience.
                        The shield does NOT forward clicks — it swallows them silently.
                    --}}
                    @if($isLimitReached)
                    <div class="limit-shield" aria-hidden="true"></div>
                    @endif

                    @if($isLimitReached)
                    <div class="absolute top-0 left-2 z-10"
                        style="background: linear-gradient(135deg, #ff4444, #cc0000);
                               color: #fff !important;
                               font-size: 0.65rem;
                               font-weight: 700;
                               padding: 3px 10px;
                               border-radius: 20px;
                               box-shadow: 0 2px 8px rgba(220,0,0,0.4);
                               letter-spacing: 0.03em;
                               border: 1px solid rgba(255,255,255,0.2);
                               pointer-events: none;">
                        Limit Reached ({{ $totalParticipations }}/{{ $planLimit }})
                    </div>
                    @endif

                    <div class="plan-checkmark">✓</div>
                    <h3 class="text-xl font-bold mb-3" style="color: var(--dark-green);">{{ $plan->name }}</h3>

                    <!-- Badges -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        @if($plan->trading_style)
                        <span class="style-badge purple">
                            <iconify-icon icon="ph:chart-line-up-fill"></iconify-icon>
                            {{ $plan->trading_style }}
                        </span>
                        @endif
                        @if($plan->risk_level)
                        @php $riskColor = $plan->risk_level == 'Low' ? 'green' : ($plan->risk_level == 'Medium' ? 'yellow' : 'red'); @endphp
                        <span class="style-badge {{ $riskColor }}">
                            <iconify-icon icon="ph:shield-check-fill"></iconify-icon>
                            {{ $plan->risk_level }} Risk
                        </span>
                        @endif
                        @if($plan->profit_frequency)
                        <span class="style-badge blue">
                            <iconify-icon icon="ph:calendar-check-fill"></iconify-icon>
                            {{ ucfirst($plan->profit_frequency) }}
                        </span>
                        @endif
                    </div>

                    @if($plan->recommended_for)
                    <p class="text-xs text-gray-500 mt-2">
                        <iconify-icon icon="ph:user-star-fill" class="mr-1 text-yellow-500"></iconify-icon>
                        Recommended for: <span class="font-semibold">{{ $plan->recommended_for }}</span>
                    </p>
                    @endif

                    <!-- Returns -->
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-4 mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-600">Return Rate</span>
                            <span class="text-2xl font-bold text-green-600">{{ $plan->interest_rate }}%</span>
                        </div>
                        @if($plan->expected_roi_range)
                        <div class="flex justify-between text-xs mb-1">
                            <span class="text-gray-500">ROI Range</span>
                            <span class="font-semibold text-gray-700">{{ $plan->expected_roi_range }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Duration</span>
                            <span class="font-semibold text-gray-700">
                                {{ $plan->duration }}
                                @if($plan->duration_unit == 'minutes') minutes
                                @elseif($plan->duration_unit == 'hours') hours
                                @else days @endif
                            </span>
                        </div>
                        @if($plan->min_duration)
                        <div class="flex justify-between text-xs mt-1">
                            <span class="text-gray-500">Min Duration</span>
                            <span class="font-semibold text-gray-600">{{ $plan->min_duration }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- Limits & Fees -->
                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between text-sm">
                            <div>
                                <span class="text-gray-500">Min</span>
                                <p class="font-semibold">${{ number_format($plan->minimum_amount) }}</p>
                            </div>
                            <div class="text-right">
                                <span class="text-gray-500">Max</span>
                                <p class="font-semibold">${{ number_format($plan->maximum_amount) }}</p>
                            </div>
                        </div>
                        @if($plan->management_fee > 0 || $plan->performance_fee > 0)
                        <div class="flex flex-wrap gap-2 pt-2 border-t border-gray-100">
                            @if($plan->management_fee > 0)
                            <span class="stat-badge">
                                <iconify-icon icon="ph:percent-fill" class="text-xs"></iconify-icon>
                                Mgmt fee: {{ $plan->management_fee }}%
                            </span>
                            @endif
                            @if($plan->performance_fee > 0)
                            <span class="stat-badge">
                                <iconify-icon icon="ph:trend-up-fill" class="text-xs"></iconify-icon>
                                Perf: {{ $plan->performance_fee }}%
                            </span>
                            @endif
                        </div>
                        @endif
                    </div>

                    <!-- Assets -->
                    @if($plan->assets_list && count($plan->assets_list) > 0)
                    <div class="mb-3">
                        <p class="text-xs font-semibold text-gray-500 mb-2">Assets Traded:</p>
                        <div class="flex flex-wrap gap-1">
                            @foreach($plan->assets_list as $asset)
                            <span class="asset-tag">{{ $asset }}</span>
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

                    <!-- Features -->
                    @if($plan->features_list && count($plan->features_list) > 0)
                    <div class="flex flex-wrap gap-2 mt-auto pt-4 border-t border-gray-100">
                        @foreach($plan->features_list as $feature)
                        <span class="feature-pill">
                            <iconify-icon icon="ph:check-circle-fill" style="color: #9EDD05 !important;"></iconify-icon>
                            {{ $feature }}
                        </span>
                        @endforeach
                    </div>
                    @endif

                </div>
                @endforeach
            </div>
        </div>

        <!-- Request Form -->
        <div class="lg:col-span-1 mb-4">
            <div class="glass-card sticky" style="top: 2rem;" id="requestFormCard">
                <h2 class="text-xl font-bold mb-6" style="color: var(--dark-green);">Start Copy Trading</h2>

                <!-- Selected Plan Info -->
                <div id="selectedPlanInfo" class="bg-gradient-to-br from-[#9EDD05]/10 to-[#8AC304]/10 rounded-xl p-4 mb-6 hidden animate-slide-up">
                    <p class="text-xs text-gray-500 mb-2">SELECTED PLAN</p>
                    <div class="flex items-center justify-between mb-3">
                        <span class="font-bold text-lg" id="selectedPlanName" style="color: var(--dark-green);">-</span>
                        <span class="text-sm text-green-600 font-semibold" id="selectedRate">0%</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div>
                            <span class="text-gray-500 text-xs">Min</span>
                            <p class="font-semibold">$<span id="selectedMin">0</span></p>
                        </div>
                        <div>
                            <span class="text-gray-500 text-xs">Max</span>
                            <p class="font-semibold">$<span id="selectedMax">0</span></p>
                        </div>
                        <div class="col-span-2">
                            <span class="text-gray-500 text-xs">Duration</span>
                            <p class="font-semibold"><span id="selectedDuration">0</span> <span id="selectedDurationUnit">days</span></p>
                        </div>
                    </div>
                </div>

                <!-- Plan Limit Warning -->
                <div id="planLimitWarning" class="bg-red-50 border border-red-200 rounded-xl p-3 mb-4 hidden">
                    <div class="flex items-center gap-2">
                        <iconify-icon icon="ph:warning-circle-fill" class="text-red-600 text-lg flex-shrink-0"></iconify-icon>
                        <div class="text-sm text-red-700" id="planLimitMessage">
                            You have reached the maximum limit for this plan.
                        </div>
                    </div>
                </div>

                <!-- Global Limit Warning -->
                @if($hasReachedLimit)
                <div class="bg-red-50 border border-red-200 rounded-xl p-3 mb-4">
                    <div class="flex items-center gap-2">
                        <iconify-icon icon="ph:warning-circle-fill" class="text-red-600 text-lg flex-shrink-0"></iconify-icon>
                        <div class="text-sm text-red-700">
                            You have reached the maximum of 3 active copy trades.
                            Please wait for existing trades to complete before starting new ones.
                        </div>
                    </div>
                </div>
                @endif

                <form id="copyTradingForm">
                    @csrf
                    <input type="hidden" name="plan_id" id="plan_id_input">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Amount to Copy</label>
                        <div class="relative">
                            <span class="absolute left-3 top-3 text-gray-500 font-medium">$</span>
                            <input type="number" name="amount" id="amount_input" step="0.01" min="0"
                                class="amount-input" placeholder="0.00" required disabled>
                        </div>
                    </div>

                    <div class="mb-4" id="quickAmountsContainer" style="display: none;">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Quick Select</label>
                        <div class="flex flex-wrap gap-2" id="quickAmountButtons"></div>
                    </div>

                    <div id="balanceWarning" class="bg-amber-50 border border-amber-200 rounded-xl p-3 mb-4 hidden">
                        <div class="flex items-center gap-2">
                            <iconify-icon icon="ph:warning-circle-fill" class="text-amber-600 text-lg flex-shrink-0"></iconify-icon>
                            <div class="text-sm text-amber-700">
                                Insufficient balance.
                                <a href="{{ route('user.deposit') }}" class="font-bold underline">Deposit funds</a>
                            </div>
                        </div>
                    </div>

                    <div id="expectedReturnSection" class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 mb-4 hidden">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-600">Expected Return</span>
                            <span class="text-lg font-bold text-green-600" id="expectedReturn">$0.00</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-500">After <span id="planDuration">0</span> <span id="planDurationUnit">days</span></span>
                            <span class="font-semibold" style="color: var(--dark-green);" id="totalReturn">$0.00</span>
                        </div>
                    </div>

                    <button type="submit" id="submitRequestBtn" class="submit-btn" disabled>
                        Submit Request
                    </button>

                    <div class="flex items-center gap-2 mt-4 text-xs text-gray-500">
                        <iconify-icon icon="ph:info-fill" class="text-lg"></iconify-icon>
                        <span>Request will be pending for admin approval before joining the trade</span>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ─── ELEMENTS ─────────────────────────────────────────── */
    const planCards             = document.querySelectorAll('.plan-card:not(.limit-reached)'); // FIX: only attach listeners to non-limited cards
    const planIdInput           = document.getElementById('plan_id_input');
    const amountInput           = document.getElementById('amount_input');
    const submitBtn             = document.getElementById('submitRequestBtn');
    const selectedPlanInfo      = document.getElementById('selectedPlanInfo');
    const selectedPlanName      = document.getElementById('selectedPlanName');
    const selectedMin           = document.getElementById('selectedMin');
    const selectedMax           = document.getElementById('selectedMax');
    const selectedRate          = document.getElementById('selectedRate');
    const selectedDuration      = document.getElementById('selectedDuration');
    const selectedDurationUnit  = document.getElementById('selectedDurationUnit');
    const planDuration          = document.getElementById('planDuration');
    const planDurationUnit      = document.getElementById('planDurationUnit');
    const quickAmountsContainer = document.getElementById('quickAmountsContainer');
    const balanceWarning        = document.getElementById('balanceWarning');
    const expectedReturnSection = document.getElementById('expectedReturnSection');
    const expectedReturn        = document.getElementById('expectedReturn');
    const totalReturn           = document.getElementById('totalReturn');
    const requestFormCard       = document.getElementById('requestFormCard');
    const planLimitWarning      = document.getElementById('planLimitWarning');
    const planLimitMessage      = document.getElementById('planLimitMessage');
    const changeBtn             = document.getElementById('changeAdminBtn');
    const changeSelect          = document.getElementById('changeAdminSelect');

    const userBalance = {{ $user->available_balance }};
    const csrfToken   = '{{ csrf_token() }}';

    let selectedPlan     = null;
    let isChangingAdmin  = false;
    let isCheckingLimit  = false; // FIX: guard against double-clicks during async check

    /* ─── HELPERS ───────────────────────────────────────────── */
    function getDurationUnitText(unit) {
        return unit === 'minutes' ? 'minutes' : unit === 'hours' ? 'hours' : 'days';
    }

    function formatMoney(num) {
        return '$' + Number(num).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function showLimitWarning(message) {
        planLimitWarning.classList.remove('hidden');
        planLimitMessage.textContent = message;
        amountInput.disabled = true;
        amountInput.value = '';
        submitBtn.disabled = true;
        document.querySelectorAll('.preset-btn').forEach(b => b.classList.remove('active'));
        expectedReturnSection.classList.add('hidden');
        balanceWarning.classList.add('hidden');
        quickAmountsContainer.style.display = 'none';
    }

    function hideLimitWarning() {
        planLimitWarning.classList.add('hidden');
        planLimitMessage.textContent = '';
    }

    /* ─── VALIDATE FORM ─────────────────────────────────────── */
    function validateForm() {
        const amount      = parseFloat(amountInput.value) || 0;
        const limitActive = !planLimitWarning.classList.contains('hidden');

        const isValid =
            selectedPlan &&
            amount >= selectedPlan.min &&
            amount <= selectedPlan.max &&
            amount <= userBalance &&
            !limitActive;

        submitBtn.disabled = !isValid;
    }

    /* ─── CHECK PLAN LIMIT (async) ──────────────────────────── */
    async function checkPlanLimit(planId) {
        try {
            const response = await fetch(`/copy-trading/check-plan-limit/${planId}`, {
                method: 'GET',
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
            });

            if (!response.ok) throw new Error('Request failed');

            const data = await response.json();

            if (data.has_reached_limit) {
                showLimitWarning(
                    `Maximum ${data.plan_limit} participation${data.plan_limit > 1 ? 's' : ''} reached. ` +
                    `You currently have ${data.current_participations} (active + pending).`
                );
                return true;  // limit reached
            } else {
                hideLimitWarning();
                amountInput.disabled = false;
                return false; // ok
            }

        } catch (err) {
            console.error('checkPlanLimit error:', err);
            hideLimitWarning();
            amountInput.disabled = false;
            return false;
        }
    }

    /* ─── PLAN CARD CLICK ───────────────────────────────────── */
    // FIX: listeners are only attached to cards that are NOT .limit-reached
    // (the selector above already filters them out)
    planCards.forEach(card => {
        card.addEventListener('click', async function (e) {
            e.preventDefault();

            // FIX: hard guard — should never be true here, but kept as safety net
            if (this.dataset.limitReached === 'true') return;

            // FIX: prevent double-click while an async check is already running
            if (isCheckingLimit) return;

            isCheckingLimit = true;

            // Deselect all eligible cards, select this one
            planCards.forEach(c => c.classList.remove('selected'));
            this.classList.add('selected');

            selectedPlan = {
                id:               this.dataset.planId,
                min:              parseFloat(this.dataset.min),
                max:              parseFloat(this.dataset.max),
                rate:             parseFloat(this.dataset.rate),
                duration:         parseInt(this.dataset.duration),
                durationUnit:     this.dataset.durationUnit,
                name:             this.dataset.name,
                maxParticipations: parseInt(this.dataset.maxParticipations || 3),
            };

            planIdInput.value = selectedPlan.id;

            // Update plan info display
            selectedPlanName.textContent     = selectedPlan.name;
            selectedMin.textContent          = selectedPlan.min.toLocaleString();
            selectedMax.textContent          = selectedPlan.max.toLocaleString();
            selectedRate.textContent         = selectedPlan.rate + '%';
            selectedDuration.textContent     = selectedPlan.duration;
            selectedDurationUnit.textContent = getDurationUnitText(selectedPlan.durationUnit);
            planDuration.textContent         = selectedPlan.duration;
            planDurationUnit.textContent     = getDurationUnitText(selectedPlan.durationUnit);

            selectedPlanInfo.classList.remove('hidden');
            selectedPlanInfo.classList.add('animate-slide-up');

            // Lock form while checking
            amountInput.disabled  = true;
            submitBtn.disabled    = true;
            submitBtn.textContent = 'Checking…';

            const limited = await checkPlanLimit(selectedPlan.id);

            submitBtn.textContent = 'Submit Request';
            isCheckingLimit = false;

            if (!limited) {
                generateQuickAmounts(selectedPlan.min, selectedPlan.max);
                quickAmountsContainer.style.display = 'block';
                validateForm();
            }

            setTimeout(() => {
                requestFormCard?.scrollIntoView({ behavior: 'smooth', block: 'center' });
                if (!amountInput.disabled) amountInput.focus();
            }, 300);
        });
    });

    /* ─── QUICK AMOUNTS ─────────────────────────────────────── */
    function generateQuickAmounts(min, max) {
        const container = document.getElementById('quickAmountButtons');
        if (!container) return;
        container.innerHTML = '';

        const amounts = [min, Math.min(min * 2, max), Math.min(min * 3, max), max];

        amounts.forEach(amount => {
            const btn = document.createElement('button');
            btn.type      = 'button';
            btn.className = 'preset-btn';
            btn.textContent = '$' + amount.toLocaleString();

            btn.onclick = () => {
                amountInput.value = amount;
                document.querySelectorAll('.preset-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                calculateExpectedReturn();
                validateForm();
            };

            container.appendChild(btn);
        });
    }

    /* ─── AMOUNT INPUT ──────────────────────────────────────── */
    amountInput?.addEventListener('input', function () {
        document.querySelectorAll('.preset-btn').forEach(b => b.classList.remove('active'));
        calculateExpectedReturn();
        validateForm();
    });

    function calculateExpectedReturn() {
        const amount = parseFloat(amountInput.value) || 0;

        if (amount > 0 && selectedPlan) {
            const profit = (amount * selectedPlan.rate) / 100;
            const total  = amount + profit;

            expectedReturn.textContent = formatMoney(profit);
            totalReturn.textContent    = formatMoney(total);
            expectedReturnSection.classList.remove('hidden');

            balanceWarning.classList.toggle('hidden', amount <= userBalance);
        } else {
            expectedReturnSection.classList.add('hidden');
            balanceWarning.classList.add('hidden');
        }
    }

    /* ─── FORM SUBMIT ───────────────────────────────────────── */
    document.getElementById('copyTradingForm')?.addEventListener('submit', function (e) {
        e.preventDefault();

        if (submitBtn.disabled || submitBtn.classList.contains('submitting')) return;

        const amount = parseFloat(amountInput.value);

        if (amount > userBalance) {
            showToast('Insufficient balance', 'error');
            return;
        }

        submitBtn.disabled = true;
        submitBtn.classList.add('submitting');
        submitBtn.innerHTML = '<div class="loading-spinner"></div> Processing…';

        fetch('{{ route("copy-trading.store") }}', {
            method: 'POST',
            headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
            body: new FormData(this),
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                showToast(data.message, 'success');
                setTimeout(() => window.location.href = '{{ route("copy-trading.history") }}', 1500);
            } else {
                throw new Error(data.message);
            }
        })
        .catch(err => {
            showToast(err.message || 'An error occurred', 'error');
            submitBtn.disabled = false;
            submitBtn.classList.remove('submitting');
            submitBtn.innerHTML = 'Submit Request';
        });
    });

    /* ─── CHANGE ADMIN ──────────────────────────────────────── */
    if (changeBtn && changeSelect) {
        changeBtn.addEventListener('click', function () {
            if (isChangingAdmin) return;

            const adminId = changeSelect.value;

            if (!adminId) {
                showToast('Please select an admin first', 'error');
                return;
            }

            isChangingAdmin = true;

            const originalHTML = changeBtn.innerHTML;
            changeBtn.disabled = true;
            changeBtn.innerHTML = '<div class="loading-spinner"></div> Changing…';

            fetch('{{ route("copy-trading.change-admin") }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                body: JSON.stringify({ admin_id: adminId }),
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast('Trader switched successfully', 'success');
                    setTimeout(() => location.reload(), 1200);
                } else {
                    throw new Error(data.message);
                }
            })
            .catch(() => {
                showToast('Failed to change trader', 'error');
                changeBtn.disabled = false;
                changeBtn.innerHTML = originalHTML;
                isChangingAdmin = false;
            });
        });
    }

    /* ─── TOAST ─────────────────────────────────────────────── */
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className   = `toast-message ${type}`;
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }

    window.showMessage = showToast;
});
</script>
@endsection