@extends('layout.user')

@section('content')
<style>
    :root {
        --primary-green: #9EDD05;
        --dark-green: #0C3A30;
        --accent-green: #8AC304;
    }

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

    .glass-card:hover::before {
        opacity: 1;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-badge.pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-badge.approved {
        background: #d1fae5;
        color: #065f46;
    }

    .status-badge.rejected {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-badge.active {
        background: #dbeafe;
        color: #1e40af;
    }

    .status-badge.completed {
        background: #e0e7ff;
        color: #3730a3;
    }

    .tab-container {
    display: flex;
    gap: 0.7rem;
    background: #f3f4f6;
    padding: 0.5rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    width: 100%;            /* 🔥 stretch full width */
    flex-wrap: nowrap;      /* keep in one line */
}

    .tab-btn {
        flex: 1;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.67rem;
        cursor: pointer;
        transition: all 0.2s ease;
        background: transparent;
        color: #6b7280;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
         flex: 1 1 0%;          /* 🔥 equal width */
    min-width: 0;          /* prevents overflow issues */
    white-space: nowrap; 
    }

    .tab-btn:hover {
        background: #e5e7eb;
        color: #374151;
    }

    /* Default tab look */
.tab-btn {
    flex: 1;
    padding: 0.7rem 1rem;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.67rem;
    background: transparent;
    color: #6b7280;
    transition: all 0.2s ease;
}

/* Hover */
.tab-btn:hover {
    background: #e5e7eb;
    color: #374151;
}

/* ACTIVE STATES (🔥 THIS IS THE MAGIC) */

.tab-btn.pending.active {
    background: #fef3c7;
    color: #d97706;
}

.tab-btn.approved.active {
    background: #d1fae5;
    color: #059669;
}

.tab-btn.rejected.active {
    background: #fee2e2;
    color: #dc2626;
}

/* Icon follows text color */
.tab-btn iconify-icon {
    font-size: 16px;
}

/* COUNT BADGES */

.count-badge {
    margin-left: 6px;
    padding: 2px 8px;
    border-radius: 999px;
    font-size: 9px;
    font-weight: 600;
}

/* Badge colors */
.count-badge.pending {
    background: #f59e0b;
    color: white;
}

.count-badge.approved {
    background: #10b981;
    color: white;
}

.count-badge.rejected {
    background: #ef4444;
    color: white;
}
    .tab-btn.active {
        background: white;
        color: var(--dark-green);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .tab-btn.pending.active {
        color: #f59e0b;
    }

    .tab-btn.approved.active {
        color: #10b981;
    }

    .tab-btn.rejected.active {
        color: #ef4444;
    }

    .timeline-item {
        position: relative;
        padding-left: 2rem;
        padding-bottom: 2rem;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, var(--primary-green), var(--accent-green));
        opacity: 0.3;
    }

    .timeline-item::after {
        content: '';
        position: absolute;
        left: -4px;
        top: 0;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: var(--primary-green);
        border: 2px solid white;
        box-shadow: 0 0 0 2px var(--primary-green);
    }

    .timeline-item.pending::after {
        background: #f59e0b;
        box-shadow: 0 0 0 2px #f59e0b;
    }

    .timeline-item.approved::after {
        background: #10b981;
        box-shadow: 0 0 0 2px #10b981;
    }

    .timeline-item.rejected::after {
        background: #ef4444;
        box-shadow: 0 0 0 2px #ef4444;
    }

    .timeline-item.completed::after {
        background: #6366f1;
        box-shadow: 0 0 0 2px #6366f1;
    }

    .progress-bar {
        width: 100%;
        height: 6px;
        background: #e5e7eb;
        border-radius: 30px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--primary-green), var(--accent-green));
        border-radius: 30px;
        transition: width 0.5s ease;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 1.25rem;
        border: 2px solid #e5e7eb;
        transition: all 0.2s ease;
    }

    .stat-card:hover {
        border-color: var(--primary-green);
        transform: translateY(-2px);
    }

    .trade-card {
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 20px;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }

    .trade-card:hover {
        border-color: var(--primary-green);
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(158, 221, 5, 0.15);
    }

    .live-trade-btn {
        background: linear-gradient(135deg, #ff6b6b, #ff4757);
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 700;
        margin-left: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
        overflow: hidden;
        animation: pulse 2s infinite;
    }

    .live-trade-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        animation: shine 3s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    @keyframes shine {
        to {
            left: 100%;
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-slide-up {
        animation: slideUp 0.5s ease forwards;
    }

    .duration-badge {
        display: inline-block;
        padding: 2px 8px;
        background: #f3f4f6;
        border-radius: 20px;
        font-size: 0.7rem;
        color: #4b5563;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        background: white;
        border-radius: 16px;
        border: 2px dashed #e5e7eb;
    }

    .empty-state-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1rem;
        background: #f3f4f6;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<div class="dashboard-main-body">
  

    <div class="flex  items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold mb-0">History</h6>
        <ul class="flex items-center gap-[6px] text-sm">
            <li>
                <a href="{{ route('user_dashboard') }}" class="flex items-center gap-2 hover:text-primary-600">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li>
                <a href="{{ route('user_dashboard') }}" class="flex items-center gap-1 hover:text-primary-600">
                    <iconify-icon icon="solar:users-group-rounded" class="text-lg"></iconify-icon>
                   History
                </a>
            </li>
        </ul>
    </div>


    <div class="bg-gradient-to-r from-green-800 to-emerald-800 rounded-2xl mb-8 animate-slide-up p-8" style=" background-image: url('assets/images/hero/hero-image-1.svg'); background-size: cover; background-position: center;">
        <div class="flex items-center justify-between flex-wrap gap-6">
            <div class="flex-1">
                <div class="flex items-center gap-3 m-2 ">
                    
                    <div>
                        <h3 class="text-2xl font-bold text-white">Every Trade is a Lesson</h3>
                        <p class="text-emerald-200">Your journey to becoming a better trader</p>
                    </div>
                </div>

              <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">
    <div class="bg-white/10 rounded-xl p-4">
        <div class="text-3xl font-bold text-white mb-1">
            {{ $pendingReqs->count() + $approvedReqs->count() + $rejectedReqs->count() }}
        </div>
        <p class="text-emerald-200 text-sm">Total Requests</p>
    </div>
    <div class="bg-white/10 rounded-xl p-4">
        <div class="text-3xl font-bold text-white mb-1">{{ $activeTrades->count() }}</div>
        <p class="text-emerald-200 text-sm">Active Trades</p>
    </div>
    <div class="bg-white/10 rounded-xl p-4">
        <div class="text-3xl font-bold text-white mb-1">
            ${{ number_format($activeTrades->sum('profit_loss'), 2) }}
        </div>
        <p class="text-emerald-200 text-sm">Current P&L</p>
    </div>
</div>

                <div class="mt-6 flex items-center gap-4 flex-wrap">
                    <a href="{{ route('user_live') }}" class="live-trade-btn">
                        <iconify-icon icon="ph:play-fill"></iconify-icon> Join Live Trading Now
                    </a>
                    <p class="text-emerald-200 text-sm mb-1" style="margin-left: 1rem;">
                        <iconify-icon icon="ph:lightbulb-fill" class="inline mr-1"></iconify-icon>
                        Experience real-time market action with our community
                    </p>
                </div>
            </div>
            <div class="hidden lg:block">
                <img src="{{ asset('assets/images/others/3n.png') }}" alt="Trading Success" class="w-32 h-auto opacity-50">
            </div>
        </div>
    </div>
@php
// Calculate from approved requests (which already exist)
$completedTrades = $approvedReqs->whereNotNull('completed_at');
$winningTrades = $completedTrades->where('final_profit_loss', '>', 0);
$winRate = $completedTrades->count() > 0 ? round(($winningTrades->count() / $completedTrades->count()) * 100) : 0;
$bestTrade = $completedTrades->max('final_profit_loss') ?? 0;
$avgDuration = $completedTrades->avg('snapshot_duration_value') ?? 0;
$avgDurationUnit = $completedTrades->first()?->snapshot_duration_unit ?? 'days';
@endphp

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8" style=" background-image: url('assets/images/hero/hero-image-1.svg'); background-size: cover; background-position: center;">
        <div class="stat-card">
            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                    <iconify-icon icon="ph:trend-up-fill" class="text-green-600"></iconify-icon>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Admin Win Rate</p>
                    <p class="text-xl font-bold">
                        {{ number_format($feed->win_rate ?? 0, 2) }}%
                    </p>
                </div>

            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center"><iconify-icon icon="ph:clock-fill" class="text-blue-600"></iconify-icon></div>
                <div>
                    <p class="text-sm text-gray-500">Avg. Duration</p>
                    <p class="text-xl font-bold">{{ floor($avgDuration) }} {{ $avgDurationUnit }}</p>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center"><iconify-icon icon="ph:chart-pie-fill" class="text-purple-600"></iconify-icon></div>
                <div>
                    <p class="text-sm text-gray-500">Best Trade</p>
                    <p class="text-xl font-bold text-green-600">${{ number_format($bestTrade, 2) }}</p>
                </div>
            </div>
        </div>
      <div class="stat-card">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center">
            <iconify-icon icon="ph:target-fill" class="text-orange-600"></iconify-icon>
        </div>
        <div>
            <p class="text-sm text-gray-500">Success Rate</p>
            <p class="text-xl font-bold">
                {{ $completedTrades->count() > 0 ? round(($winningTrades->count() / $completedTrades->count()) * 100) : 0 }}%
            </p>
        </div>
    </div>
</div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8" style=" background-image: url('assets/images/hero/hero-image-1.svg'); background-size: cover; background-position: center;">
        <div class="lg:col-span-1">
            <div class="glass-card sticky" style="top: 2rem;">
                <h2 class="text-xl font-bold mb-6" style="color: var(--dark-green);">Active Copy Trades</h2>
                @if($activeTrades->count() > 0)
                <div class="space-y-4">
                    @foreach($activeTrades as $trade)
                    <div class="trade-card">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="font-bold text-lg" style="color: var(--dark-green);">{{ $trade->investment_plan_name }}</h3>
                            <span class="status-badge active"><iconify-icon icon="ph:play-fill"></iconify-icon> Active</span>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm"><span class="text-gray-500">Invested</span><span class="font-semibold">${{ number_format($trade->amount_invested, 2) }}</span></div>
                            <div class="flex justify-between text-sm"><span class="text-gray-500">Current Value</span><span class="font-semibold {{ $trade->profit_loss >= 0 ? 'text-green-600' : 'text-red-600' }}">${{ number_format($trade->current_value, 2) }}</span></div>
                            <div class="flex justify-between text-sm"><span class="text-gray-500">P&L</span><span class="font-semibold {{ $trade->profit_loss >= 0 ? 'text-green-600' : 'text-red-600' }}">{{ $trade->profit_loss >= 0 ? '+' : '' }}${{ number_format($trade->profit_loss, 2) }} ({{ $trade->profit_loss_percentage }}%)</span></div>
                            <div class="pt-2">
                                <div class="flex justify-between text-xs text-gray-400 mb-1"><span>Time Remaining</span><span class="font-medium">{{ $trade->time_remaining }}</span></div>
                                <div class="flex justify-between text-xs text-gray-400 mb-1"><span>Progress</span><span>{{ $trade->progress_percentage }}%</span></div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: {{ $trade->progress_percentage }}%"></div>
                                </div>
                                <div class="text-right text-xs text-gray-400 mt-1"><span class="duration-badge">Duration: {{ $trade->duration_value }} {{ $trade->duration_unit }}</span></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8">
                    <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center"><iconify-icon icon="ph:chart-line-up-fill" class="text-3xl text-gray-400"></iconify-icon></div>
                    <p class="text-gray-500 mb-2">No active copy trades</p><a href="{{ route('copy-trading.index') }}" class="inline-block mt-4 px-4 py-2 bg-[#9EDD05] text-[#0C3A30] rounded-lg hover:bg-[#8AC304] transition font-semibold">Start Copy Trading</a>
                </div>
                @endif
            </div>
        </div>

        <div class="lg:col-span-2">
    <div class="glass-card">
        <h2 class="text-xl font-bold mb-6" style="color: var(--dark-green);">
            Your Trading Journey
        </h2>

        <!-- Tabs -->
      <div class="tab-container">
    <button class="tab-btn pending active" onclick="switchTab('pending')">
       
        Pending
        <span class="count-badge pending">{{ $pendingReqs->count() }}</span>
    </button>

    <button class="tab-btn approved" onclick="switchTab('approved')">
        
        Approved
        <span class="count-badge approved">{{ $approvedReqs->count() }}</span>
    </button>

    <button class="tab-btn rejected" onclick="switchTab('rejected')">
      
        Rejected
        <span class="count-badge rejected">{{ $rejectedReqs->count() }}</span>
    </button>
</div>

        <!-- Pending Tab -->
        <div id="pendingTab" class="tab-content">
            @if($pendingReqs->count() > 0)
                <div class="space-y-6">
                    @foreach($pendingReqs as $request)
                        <div class="timeline-item pending">
                            <div class="bg-white rounded-xl p-5 border border-gray-100 hover:border-[#9EDD05] transition-all">

                                <div class="flex items-center gap-3 mb-3">
                                    <span class="status-badge pending">
                                        <iconify-icon icon="ph:clock-fill"></iconify-icon> Pending
                                    </span>
                                    <span class="text-xs text-gray-400">
                                        {{ $request->created_at->format('M d, Y H:i') }}
                                    </span>
                                </div>

                                <p><strong>{{ $request->plan->name }}</strong></p>
                                <p class="text-green-600">${{ number_format($request->amount, 2) }}</p>

                                <div class="text-sm text-amber-600 mt-2">
                                    Awaiting admin approval
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">No Pending Requests</div>
            @endif
        </div>

        <!-- Approved Tab -->
        <div id="approvedTab" class="tab-content hidden">
            @if($approvedReqs->count() > 0)
                <div class="space-y-6">
                    @foreach($approvedReqs as $request)
                        <div class="timeline-item approved">
                            <div class="bg-white rounded-xl p-5 border border-gray-100">

                                <div class="flex items-center gap-3 mb-3">
                                    <span class="status-badge approved">
                                        <iconify-icon icon="ph:check-circle-fill"></iconify-icon>
                                        {{ $request->completed_at ? 'Completed' : 'Approved' }}
                                    </span>
                                </div>

                                <p><strong>{{ $request->plan->name }}</strong></p>
                                <p class="text-green-600">${{ number_format($request->amount, 2) }}</p>

                                @if($request->completed_at)
                                    <p class="text-green-600">
                                        Completed on {{ $request->completed_at->format('M d, Y H:i') }}
                                    </p>
                                @else
                                    <p class="text-green-600">
                                        Approved on {{ $request->approved_at->format('M d, Y H:i') }}
                                    </p>
                                @endif

                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">No Approved Requests</div>
            @endif
        </div>

        <!-- Rejected Tab -->
        <div id="rejectedTab" class="tab-content hidden">
            @if($rejectedReqs->count() > 0)
                <div class="space-y-6">
                    @foreach($rejectedReqs as $request)
                        <div class="timeline-item rejected">
                            <div class="bg-white rounded-xl p-5 border border-gray-100">

                                <div class="flex items-center gap-3 mb-3">
                                    <span class="status-badge rejected">
                                        <iconify-icon icon="ph:x-circle-fill"></iconify-icon> Rejected
                                    </span>
                                </div>

                                <p><strong>{{ $request->plan->name }}</strong></p>
                                <p class="text-green-600">${{ number_format($request->amount, 2) }}</p>

                                @if($request->rejection_reason)
                                    <p class="text-red-500 mt-2">
                                        {{ $request->rejection_reason }}
                                    </p>
                                @endif

                                <p class="text-sm text-red-600 mt-2">
                                    Rejected on {{ optional($request->rejected_at)->format('M d, Y H:i') }}
                                </p>

                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">No Rejected Requests</div>
            @endif
        </div>

    </div>
</div>
    </div>
</div>

<style>
    .pagination {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        margin-top: 2rem;
    }

    .pagination .page-item {
        list-style: none;
    }

    .pagination .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.5rem;
        height: 2.5rem;
        border: 2px solid #e5e7eb;
        border-radius: 0.5rem;
        color: #4b5563;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .pagination .page-link:hover {
        border-color: var(--primary-green);
        background: #f8faf7;
    }

    .pagination .active .page-link {
        background: var(--primary-green);
        border-color: var(--primary-green);
        color: var(--dark-green);
    }

    [title] {
        position: relative;
        cursor: help;
    }

    [title]:hover::after {
        content: attr(title);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: #1f2937;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.75rem;
        white-space: nowrap;
        z-index: 10;
        margin-bottom: 0.5rem;
    }
</style>

<script>
    function switchTab(tab) {
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelector(`.tab-btn.${tab}`).classList.add('active');
        document.getElementById('pendingTab').classList.add('hidden');
        document.getElementById('approvedTab').classList.add('hidden');
        document.getElementById('rejectedTab').classList.add('hidden');
        document.getElementById(`${tab}Tab`).classList.remove('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('animate-slide-up');
            });
        }, {
            threshold: 0.1
        });
        document.querySelectorAll('.stat-card, .trade-card, .timeline-item').forEach(el => observer.observe(el));
        const liveBtn = document.querySelector('.live-trade-btn');
        if (liveBtn) {
            setInterval(() => {
                liveBtn.style.boxShadow = '0 0 20px rgba(255, 71, 87, 0.5)';
                setTimeout(() => liveBtn.style.boxShadow = 'none', 1000);
            }, 3000);
        }
    });

    let profitLossInterval;

    function startProfitLossSimulation() {
        if (profitLossInterval) clearInterval(profitLossInterval);
        profitLossInterval = setInterval(() => {
            document.querySelectorAll('.trade-card').forEach(card => {
                const investedSpan = card.querySelector('.invested-amount');
                const currentValueSpan = card.querySelector('.current-value');
                const profitLossSpan = card.querySelector('.profit-loss');
                const profitLossPercentSpan = card.querySelector('.profit-loss-percent');
                const trendIcon = card.querySelector('.trend-icon');
                if (investedSpan && currentValueSpan) {
                    const invested = parseFloat(investedSpan.dataset.value);
                    let currentValue = parseFloat(currentValueSpan.dataset.value);
                    const fluctuation = (Math.random() * 5 - 2) / 100;
                    let newValue = currentValue * (1 + fluctuation);
                    newValue = Math.max(invested * 0.7, Math.min(invested * 1.5, newValue));
                    const profitLoss = newValue - invested;
                    const profitLossPercent = (profitLoss / invested) * 100;
                    currentValueSpan.textContent = '$' + newValue.toFixed(2);
                    currentValueSpan.dataset.value = newValue;
                    currentValueSpan.className = 'font-semibold ' + (profitLoss >= 0 ? 'text-green-600' : 'text-red-600');
                    profitLossSpan.textContent = (profitLoss >= 0 ? '+' : '') + '$' + profitLoss.toFixed(2);
                    profitLossSpan.className = 'font-semibold ' + (profitLoss >= 0 ? 'text-green-600' : 'text-red-600');
                    profitLossPercentSpan.textContent = (profitLossPercent >= 0 ? '+' : '') + profitLossPercent.toFixed(2) + '%';
                    profitLossPercentSpan.className = 'text-xs ' + (profitLossPercent >= 0 ? 'text-green-600' : 'text-red-600');
                    if (trendIcon) trendIcon.innerHTML = profitLoss >= 0 ? '<iconify-icon icon="ph:trend-up-fill" class="text-green-500"></iconify-icon>' : '<iconify-icon icon="ph:trend-down-fill" class="text-red-500"></iconify-icon>';
                    card.style.borderLeft = profitLoss > 0 ? '4px solid #10b981' : (profitLoss < 0 ? '4px solid #ef4444' : '4px solid #e5e7eb');
                }
            });
        }, 5000);
    }
    window.addEventListener('beforeunload', () => {
        if (profitLossInterval) clearInterval(profitLossInterval);
    });
    document.addEventListener('DOMContentLoaded', () => {
        const activeTrades = document.querySelectorAll('.trade-card');
        if (activeTrades.length > 0) startProfitLossSimulation();
    });
</script>
@endsection