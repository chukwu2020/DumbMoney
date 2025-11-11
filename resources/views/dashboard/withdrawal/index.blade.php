@extends('layout.user')

@section('content')
<div class="dashboard-main-body">
    <div class="flex flex-wrap items-center justify-between gap-2 mb-6 mt-7">
        <h6 class="font-semibold mb-0 text-lg text-gray-800">Withdrawal List</h6>
        <ul class="flex items-center gap-2 text-sm text-gray-600">
            <li class="font-medium">
                <a href="{{ route('user_dashboard') }}" class="flex items-center gap-1 text-[#8AC304]">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="font-medium">Withdrawal list</li>
        </ul>
    </div>

    <div class="grid grid-cols-1 3xl:grid-cols-12 gap-6 mt-6">
        <div class="2xl:col-span-12 3xl:col-span-12">
            <div class="w-full">
                <div class="card-body p-6 bg-white shadow rounded-lg" style="min-height: 100vh; background-image: url('assets/images/hero/hero-image-1.svg'); background-repeat: no-repeat; background-size: cover;">
                    <div class="flex items-center justify-between mb-5">
                        <h6 class="font-bold text-lg text-gray-800">Recent Withdrawals</h6>
                        <a href="{{ route('user.withdraw.form') }}" 
                           class="px-4 py-2 rounded-lg font-medium text-white hover:shadow-lg transition"
                           style="background-color: #8AC304;">
                            + New Withdrawal
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mt-6">
                        @forelse ($withdrawals as $key => $withdrawal)
                            @php
                                $status = strtolower($withdrawal->status);
                                $badgeClass = match($status) {
                                    'approved' => 'badge-approved',
                                    'pending' => 'badge-pending',
                                    'rejected' => 'badge-rejected',
                                    'failed' => 'badge-failed',
                                    default => 'badge-default',
                                };

                                // Better payment method display
                                $paymentMethodDisplay = match($withdrawal->payment_method) {
                                    'cryptocurrency' => '💰 Cryptocurrency',
                                    'digital_wallet' => '🏦 Bank Transfer',
                                    default => ucfirst(str_replace('_', ' ', $withdrawal->payment_method))
                                };

                                // Better wallet/destination display
                                $destination = 'N/A';
                                if ($withdrawal->payment_method === 'cryptocurrency') {
                                    $destination = match($withdrawal->wallet_choice) {
                                        'bitcoin' => 'Bitcoin (BTC)',
                                        'etherium' => 'Ethereum (ETH)',
                                        'usdt' => 'Tether (USDT)',
                                        default => ucfirst($withdrawal->wallet_choice ?? 'Crypto')
                                    };
                                } elseif ($withdrawal->payment_method === 'digital_wallet') {
                                    $destination = 'Bank Account';
                                }

                                // Status icon
                                $statusIcon = match($status) {
                                    'approved' => '✓',
                                    'pending' => '⏱',
                                    'rejected' => '✗',
                                    'failed' => '⚠',
                                    default => '•'
                                };
                            @endphp

                            <div class="bg-white border border-gray-100 rounded-2xl shadow-xl p-5 w-full hover:shadow-2xl transition-shadow duration-300">
                                {{-- Header --}}
                                <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-100">
                                    <h4 class="text-base font-semibold text-gray-800">
                                        Withdrawal #{{ str_pad($withdrawal->id, 4, '0', STR_PAD_LEFT) }}
                                    </h4>
                                    <span class="text-xs font-medium px-3 py-1 rounded-full {{ $badgeClass }} flex items-center gap-1">
                                        <span>{{ $statusIcon }}</span>
                                        {{ ucfirst($withdrawal->status) }}
                                    </span>
                                </div>

                                {{-- Details --}}
                                <div class="space-y-3 text-sm">
                                    {{-- Amount --}}
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-gray-600">Amount:</span>
                                        <span class="text-lg font-bold" style="color: #0C3A30;">
                                            ${{ number_format($withdrawal->amount, 2) }}
                                        </span>
                                    </div>

                                    {{-- Payment Method --}}
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-gray-600">Method:</span>
                                        <span class="font-semibold text-gray-800">
                                            {{ $paymentMethodDisplay }}
                                        </span>
                                    </div>

                                    {{-- Destination --}}
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-gray-600">Destination:</span>
                                        <span class="text-gray-700 text-right">
                                            {{ $destination }}
                                        </span>
                                    </div>

                                    {{-- Date --}}
                                    <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                                        <span class="font-medium text-gray-600">Date:</span>
                                        <span class="text-gray-700">
                                            {{ $withdrawal->created_at->format('d M Y, h:i A') }}
                                        </span>
                                    </div>

                                    {{-- Status Message (if rejected/failed) --}}
                                    @if(in_array($status, ['rejected', 'failed']) && $withdrawal->admin_note)
                                    <div class="mt-3 p-3 rounded-lg bg-red-50 border border-red-200">
                                        <p class="text-xs font-semibold text-red-800 mb-1">Reason:</p>
                                        <p class="text-xs text-red-700">{{ $withdrawal->admin_note }}</p>
                                    </div>
                                    @endif

                                    {{-- Pending Message --}}
                                    @if($status === 'pending')
                                    <div class="mt-3 p-2 rounded-lg bg-yellow-50 border border-yellow-200">
                                        <p class="text-xs text-yellow-800 text-center">
                                            ⏳ Processing... Please wait
                                        </p>
                                    </div>
                                    @endif

                                    {{-- Approved Message --}}
                                    @if($status === 'approved')
                                    <div class="mt-3 p-2 rounded-lg bg-green-50 border border-green-200">
                                        <p class="text-xs text-green-800 text-center font-medium">
                                            ✓ Withdrawal completed successfully!
                                        </p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-16 text-gray-500">
                                <div class="w-20 h-20 mx-auto mb-4 rounded-full flex items-center justify-center" 
                                     style="background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);">
                                    <iconify-icon icon="mdi:inbox-remove-outline" class="text-5xl text-gray-400"></iconify-icon>
                                </div>
                                <p class="text-lg font-semibold text-gray-700 mb-2">No Withdrawals Yet</p>
                                <p class="text-sm text-gray-500 mb-4">You haven't made any withdrawal requests.</p>
                                <a href="{{ route('user.withdraw.form') }}" 
                                   class="inline-flex items-center px-6 py-3 rounded-lg font-semibold text-white shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105"
                                   style="background: linear-gradient(135deg, #9EDD05 0%, #8AC304 100%);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Make Your First Withdrawal
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Status Badges */
    .badge-approved { 
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); 
        color: #065f46; 
        padding: 0.25rem 0.75rem; 
        border-radius: 9999px; 
        font-weight: 600; 
        font-size: 0.75rem;
        box-shadow: 0 2px 4px rgba(5, 150, 105, 0.1);
    }
    
    .badge-pending { 
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); 
        color: #92400e; 
        padding: 0.25rem 0.75rem; 
        border-radius: 9999px; 
        font-weight: 600; 
        font-size: 0.75rem;
        box-shadow: 0 2px 4px rgba(217, 119, 6, 0.1);
    }
    
    .badge-rejected { 
        background: linear-gradient(135deg, #ff6767 0%, #ff4444 100%); 
        color: #fff; 
        padding: 0.25rem 0.75rem; 
        border-radius: 9999px; 
        font-weight: 600; 
        font-size: 0.75rem;
        box-shadow: 0 2px 4px rgba(239, 68, 68, 0.2);
    }
    
    .badge-failed { 
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); 
        color: #991b1b; 
        padding: 0.25rem 0.75rem; 
        border-radius: 9999px; 
        font-weight: 600; 
        font-size: 0.75rem;
        box-shadow: 0 2px 4px rgba(185, 28, 28, 0.1);
    }
    
    .badge-default { 
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%); 
        color: #374151; 
        padding: 0.25rem 0.75rem; 
        border-radius: 9999px; 
        font-weight: 600; 
        font-size: 0.75rem;
    }

    /* Card Hover Effects */
    .bg-white.border.rounded-2xl {
        transition: all 0.3s ease;
    }

    .bg-white.border.rounded-2xl:hover {
        transform: translateY(-4px);
        border-color: #8AC304;
    }
</style>
@endsection