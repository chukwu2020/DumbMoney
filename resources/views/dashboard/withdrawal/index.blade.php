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
                            class="px-2 py-2 rounded-lg font-medium text-white hover:shadow-lg transition"
                            style="background-color: #8AC304;">
                            + New Withdrawal
                        </a>
                    </div>
@if($status === 'failed')
<div class="mt-3 p-2 rounded-lg bg-red-50 border border-red-200 text-red-700 text-xs text-center">
    ⚠️ Your withdrawal was unapproved. 
    @if($withdrawal->admin_note)
        Note: {{ $withdrawal->admin_note }}
    @endif
</div>
@endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mt-6">
                        @forelse ($withdrawals as $key => $withdrawal)
                        @php
                        $userProfile = $withdrawal->user->profile ?? null;
                        $recipientName = $userProfile->recipient_name ?? null;
                        $bankName = $userProfile->bank_name ?? null;
                        $accountNumber = $userProfile->account_number ?? null;
                        $iban = $userProfile->iban ?? null;
                        $swiftBic = $userProfile->swift_bic ?? null;
                        $bankAddress = $userProfile->bank_address ?? null;

                        $status = strtolower($withdrawal->status);
                        $badgeClass = match($status) {
                        'approved' => 'badge-approved',
                        'pending' => 'badge-pending',
                        'rejected' => 'badge-rejected',
                        'failed' => 'badge-failed',
                        default => 'badge-default',
                        };

                        $paymentMethodDisplay = match($withdrawal->payment_method) {
                        'cryptocurrency' => ' Cryptocurrency',
                        'digital_wallet' => ' Bank Transfer',
                        default => ucfirst(str_replace('_', ' ', $withdrawal->payment_method))
                        };

                        $destination = 'N/A';
                        if ($withdrawal->payment_method === 'cryptocurrency') {
                        $destination = match($withdrawal->wallet_choice) {
                        'bitcoin' => 'Bitcoin (BTC)',
                        'etherium' => 'Ethereum (ETH)',
                        'usdt' => 'Tether (USDT)',
                        default => ucfirst($withdrawal->wallet_choice ?? 'Crypto')
                        };
                        } elseif ($withdrawal->payment_method === 'digital_wallet') {
                        if ($accountNumber) {
                        $destination = '****' . substr($accountNumber, -4);
                        } elseif ($iban) {
                        $destination = '****' . substr($iban, -4);
                        } else {
                        $destination = 'Bank Account';
                        }
                        }

                        $statusIcon = match($status) {
                        'approved' => '✓',
                        'pending' => '⏱',
                        'rejected' => '✗',
                        'failed' => '⚠',
                        default => '•'
                        };
                        @endphp

                        <div class="bg-white border border-gray-100 rounded-2xl shadow-xl p-5 w-full hover:shadow-2xl transition-shadow duration-300">

                            <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-100">
                                <h4 class="text-base font-semibold text-gray-800">
                                    Withdrawal #{{ str_pad($withdrawal->id, 4, '0', STR_PAD_LEFT) }}
                                </h4>
                                <span class="text-xs font-medium px-3 py-1 rounded-full {{ $badgeClass }} flex items-center gap-1">
                                    <span>{{ $statusIcon }}</span>
                                    {{ ucfirst($withdrawal->status) }}
                                </span>
                            </div>

                            <div class="space-y-3 text-sm">

                                <div class="flex justify-between items-center">
                                    <span class="font-medium text-gray-600">Amount:</span>
                                    <span class="text-lg font-bold" style="color: #0C3A30;">
                                        ${{ number_format($withdrawal->amount, 2) }}
                                    </span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="font-medium text-gray-600">Method:</span>
                                    <span class="font-semibold text-gray-800">
                                        {{ $paymentMethodDisplay }}
                                    </span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="font-medium text-gray-600">Destination :</span>
                                    <span class="text-gray-700 text-right font-mono text-xs">
                                        {{ $destination }}
                                    </span>
                                </div>

                                @if($withdrawal->payment_method === 'digital_wallet')
                                <div class="mt-3">
                                    <button
                                        class="w-full px-3 py-2 text-xs font-medium rounded-lg border-2 transition-all duration-200 flex items-center justify-between bank-details-toggle"
                                        style="border-color: #8AC304; color: #0C3A30; background-color: #f9fafb;"
                                        data-withdrawal-id="{{ $withdrawal->id }}">
                                        <span>📋 View Full Bank Details</span>
                                        <svg class="w-4 h-4 transition-transform duration-200 arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    <div class="bank-details-content hidden mt-3 p-4 rounded-lg border-2" style="border-color: #8AC304; background-color: #f0fde4;">
                                        @if($bankName || $recipientName || $accountNumber || $iban || $swiftBic || $bankAddress)
                                        <div class="space-y-2 text-xs">

                                            <div class="flex items-center gap-3 mb-3 pb-3 border-b border-[#8AC304]">
                                                <div class="flex-1">
                                                    <p class="font-semibold text-[#0C3A30] text-sm"></p>
                                                    @if($bankName)
                                                    <span class="inline-block ml-3 px-2 py-1 rounded text-xs font-medium text-white mt-1" style="background-color: #8AC304;">✓ Bank Info Verified</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="space-y-2 text-sm">
                                                @if($bankName)
                                                <div class="flex justify-between items-start">
                                                    <span class="text-gray-600 font-medium">Bank Name:</span>
                                                    <span class="text-[#0C3A30] font-semibold text-right">{{ $bankName ?? 'Bank Name' }}</span>
                                                </div>
                                                @endif

                                                @if($recipientName)
                                                <div class="flex justify-between items-start">
                                                    <span class="text-gray-600 font-medium">Recipient:</span>
                                                    <span class="text-[#0C3A30] font-semibold text-right">{{ $recipientName }}</span>
                                                </div>
                                                @endif

                                                @if($accountNumber)
                                                <div class="flex justify-between items-start">
                                                    <span class="text-gray-600 font-medium">Account:</span>
                                                    <span class="text-[#0C3A30] font-mono text-xs text-right break-all">{{ $accountNumber }}</span>
                                                </div>
                                                @endif

                                                @if($iban)
                                                <div class="flex justify-between items-start">
                                                    <span class="text-gray-600 font-medium">IBAN:</span>
                                                    <span class="text-[#0C3A30] font-mono text-xs text-right break-all">{{ $iban }}</span>
                                                </div>
                                                @endif

                                                @if($swiftBic)
                                                <div class="flex justify-between items-start">
                                                    <span class="text-gray-600 font-medium">SWIFT:</span>
                                                    <span class="text-[#0C3A30] font-mono text-xs text-right">{{ $swiftBic }}</span>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @else
                                        <div class="text-center py-3">
                                            <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-yellow-100 flex items-center justify-center">
                                                <span class="text-yellow-600 text-lg">⚠️</span>
                                            </div>
                                            <p class="text-amber-700 text-xs font-semibold">Bank details not found</p>
                                            <p class="text-amber-600 text-xs mt-1">Please update your profile</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endif

                                <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                                    <span class="font-medium text-gray-600">Date:</span>
                                    <span class="text-gray-700 text-xs">
                                        {{ $withdrawal->created_at->format('d M Y, h:i A') }}
                                    </span>
                                </div>

                                {{-- FIXED ADMIN NOTE --}}

                                @if(in_array($status, ['rejected', 'failed']) && $withdrawal->admin_note)

                                <div class="admin-note">
                                    <div class="admin-note-header">
                                        <span class="admin-note-icon">⚠</span>
                                        <p class="admin-note-title"> Note</p>
                                    </div>
                                    <p class="admin-note-message">{{ $withdrawal->admin_note }}</p>
                                </div>
                                @endif
<style>
    .admin-note {
    margin-top: 1rem !important;
    border-left: 4px solid #ef4444 !important; /* bright red */
    background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%) !important;
    padding: 1rem !important;
    border-radius: 0.75rem !important; /* rounded-xl */
    box-shadow: 0 2px 6px rgba(239, 68, 68, 0.15) !important;
}

.admin-note-header {
    display: flex !important;
    align-items: center !important;
    gap: 0.5rem !important;
    margin-bottom: 0.5rem !important;
}

.admin-note-icon {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 1.75rem !important;
    height: 1rem !important;
    border-radius: 9999px !important; /* full circle */
    background-color: rgba(239, 68, 68, 0.1) !important;
    color: #b91c1c !important;
    font-size: 1rem !important;
}

.admin-note-title {
    font-weight: 600 !important;
    color: #b91c1c !important;
    font-size: 0.875rem !important; /* text-sm */
    letter-spacing: 0.5px !important;
}

.admin-note-message {
    font-size: 0.75rem !important; /* text-xs */
    color: #991b1b !important;
    line-height: 1.4 !important;
    padding-left: 2.25rem !important; /* align with icon */
}

</style>


                                @if($status === 'pending')
                                <div class="mt-3 p-2 rounded-lg bg-yellow-50 border border-yellow-200">
                                    <p class="text-xs text-yellow-800 text-center" style="color:black !important; font-size:0.8rem; ">
                                        Processing... Please wait
                                    </p>
                                </div>
                                @endif

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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.bank-details-toggle').forEach(button => {
            button.addEventListener('click', function() {
                const content = this.nextElementSibling;
                const arrow = this.querySelector('.arrow-icon');

                content.classList.toggle('hidden');
                arrow.classList.toggle('rotate-180');
            });
        });
    });
</script>

<style>
    .badge-approved {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
        box-shadow: 0 2px 4px rgba(5, 150, 105, 0.1);
    }

    .badge-pending {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #92400e;
        box-shadow: 0 2px 4px rgba(217, 119, 6, 0.1);
    }

    .badge-rejected {
        background: linear-gradient(135deg, #ff6767 0%, #ff4444 100%);
        color: #fff;
        box-shadow: 0 2px 4px rgba(239, 68, 68, 0.2);
    }

    .badge-failed {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #991b1b;
        box-shadow: 0 2px 4px rgba(185, 28, 28, 0.1);
    }

    .badge-default {
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        color: #374151;
    }

    .arrow-icon {
        transition: transform 0.3s ease;
    }

    .rotate-180 {
        transform: rotate(180deg);
    }
</style>
@endsection