@extends('layout.user')

@section('content')
<div class="dashboard-main-body">

    <!-- PAGE HEADER -->
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
            <li class="font-medium">Withdrawal List</li>
        </ul>
    </div>

    <!-- MAIN BODY -->
    <div class="grid grid-cols-1 3xl:grid-cols-12 gap-6 mt-6">
        <div class="2xl:col-span-12 3xl:col-span-12">
            <div class="w-full">

                <div class="card-body p-6 bg-white shadow rounded-lg"
                    style="min-height: 100vh; background-image:url('assets/images/hero/hero-image-1.svg') !important; background-size:cover !important; background-repeat:no-repeat !important;">

                    <!-- HEADER -->
                    <div class="flex items-center justify-between mb-5">
                        <h6 class="font-bold text-lg text-gray-800">Recent Withdrawals</h6>

                        <a href="{{ route('user.withdraw.form') }}"
                            class="px-3 py-2 rounded-lg font-medium text-white hover:shadow-lg transition"
                            style="background-color:#8AC304 !important;">
                            + New Withdrawal
                        </a>
                    </div>

                    <!-- WITHDRAWAL CARDS -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mt-6">

                        @forelse ($withdrawals as $withdrawal)
                            @php
                                $profile = $withdrawal->user->profile ?? null;

                                $status = strtolower($withdrawal->status);
                                $badgeClass = match($status) {
                                    'approved' => 'badge-approved',
                                    'pending' => 'badge-pending',
                                    'rejected' => 'badge-rejected',
                                    'failed','unapproved' => 'badge-failed',
                                    default => 'badge-default',
                                };

                                $payment = match($withdrawal->payment_method) {
                                    'cryptocurrency' => 'Cryptocurrency',
                                    'digital_wallet' => 'Bank Transfer',
                                    default => ucfirst(str_replace('_', ' ', $withdrawal->payment_method)),
                                };

                                $destination = 'N/A';
                                if ($withdrawal->payment_method === 'cryptocurrency') {
                                    $destination = match($withdrawal->wallet_choice) {
                                        'bitcoin' => 'Bitcoin (BTC)',
                                        'etherium' => 'Ethereum (ETH)',
                                        'usdt' => 'Tether (USDT)',
                                        default => ucfirst($withdrawal->wallet_choice ?? 'Crypto'),
                                    };
                                } elseif ($withdrawal->payment_method === 'digital_wallet') {
                                    if ($profile?->account_number) {
                                        $destination = '****' . substr($profile->account_number, -4);
                                    } elseif ($profile?->iban) {
                                        $destination = '****' . substr($profile->iban, -4);
                                    }
                                }

                                $statusIcon = match($status) {
                                    'approved' => '✓',
                                    'pending' => '⏱',
                                    'rejected' => '✗',
                                    'failed','unapproved' => '⚠',
                                    default => '•',
                                };
                            @endphp

                            <!-- CARD -->
                            <div class="bg-white border border-gray-100 rounded-2xl shadow-xl p-5 w-full hover:shadow-2xl transition-shadow duration-300">

                                <!-- HEADER -->
                                <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-100">
                                    <h4 class="text-base font-semibold text-gray-800">
                                        Withdrawal #{{ str_pad($withdrawal->id, 4, '0', STR_PAD_LEFT) }}
                                    </h4>
                                    <span class="text-xs font-medium px-3 py-1 rounded-full {{ $badgeClass }} flex items-center gap-1">
                                        <span>{{ $statusIcon }}</span>
                                        {{ $status === 'unapproved' ? 'Failed' : ucfirst($withdrawal->status) }}
                                    </span>
                                </div>

                                <!-- BODY -->
                                <div class="space-y-3 text-sm">

                                    <div class="flex justify-between">
                                        <span class="font-medium text-gray-600">Amount:</span>
                                        <span class="text-lg font-bold" style="color:#0C3A30 !important;">
                                            ${{ number_format($withdrawal->amount,2) }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span class="font-medium text-gray-600">Method:</span>
                                        <span class="font-semibold text-gray-800">{{ $payment }}</span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span class="font-medium text-gray-600">Destination:</span>
                                        <span class="text-gray-700 text-right font-mono text-xs">{{ $destination }}</span>
                                    </div>

                                    <!-- BANK DETAILS DROPDOWN -->
                                    @if($withdrawal->payment_method === 'digital_wallet')
                                        <div class="mt-3">
                                            <button class="bank-details-toggle w-full px-3 py-2 text-xs font-medium rounded-lg border-2 flex justify-between"
                                                style="border-color:#8AC304 !important; background:#f9fafb !important; color:#0C3A30 !important;">
                                                <span>📋 View Full Bank Details</span>
                                                <svg class="arrow-icon w-4 h-4" fill="none" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>

                                            <div class="bank-details-content hidden mt-3 p-4 rounded-lg border-2"
                                                style="border-color:#8AC304 !important; background:#f0fde4 !important;">
                                                @if($profile)
                                                    <div class="space-y-2 text-xs">

                                                        <div class="flex justify-between">
                                                            <span class="text-gray-600 font-medium">Bank Name:</span>
                                                            <span class="font-semibold text-[#0C3A30]">{{ $profile->bank_name ?? 'N/A' }}</span>
                                                        </div>

                                                        <div class="flex justify-between">
                                                            <span class="text-gray-600 font-medium">Recipient:</span>
                                                            <span class="font-semibold text-[#0C3A30]">{{ $profile->recipient_name ?? 'N/A' }}</span>
                                                        </div>

                                                        <div class="flex justify-between">
                                                            <span class="text-gray-600 font-medium">Account:</span>
                                                            <span class="font-mono text-xs">{{ $profile->account_number ?? 'N/A' }}</span>
                                                        </div>

                                                        <div class="flex justify-between">
                                                            <span class="text-gray-600 font-medium">IBAN:</span>
                                                            <span class="font-mono text-xs">{{ $profile->iban ?? 'N/A' }}</span>
                                                        </div>

                                                        <div class="flex justify-between">
                                                            <span class="text-gray-600 font-medium">SWIFT:</span>
                                                            <span class="font-mono text-xs">{{ $profile->swift_bic ?? 'N/A' }}</span>
                                                        </div>

                                                    </div>
                                                @else
                                                    <p class="text-center text-xs text-red-600">No bank details found.</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    <!-- DATE -->
                                    <div class="flex justify-between pt-2 border-t border-gray-100">
                                        <span class="font-medium text-gray-600">Date:</span>
                                        <span class="text-gray-700 text-xs">
                                            {{ $withdrawal->created_at->format('d M Y, h:i A') }}
                                        </span>
                                    </div>

                                    <!-- ADMIN NOTE -->
                                    @if(in_array($status,['rejected','failed']) && $withdrawal->admin_note)
                                        <div class="admin-note">
                                            <div class="admin-note-header">
                                                <span class="admin-note-icon">⚠</span>
                                                <p class="admin-note-title">Note</p>
                                            </div>
                                            <p class="admin-note-message">{{ $withdrawal->admin_note }}</p>
                                        </div>
                                    @endif

                                    <!-- STATUS FOOTER -->
                                    @if($status === 'pending')
                                        <div class="mt-3 p-2 rounded-lg bg-yellow-50 border border-yellow-200">
                                            <p class="text-xs text-center" style="color:black !important;">Processing... Please wait</p>
                                        </div>
                                    @endif

                                    @if($status === 'approved')
                                        <div class="mt-3 p-2 rounded-lg bg-green-50 border border-green-200">
                                            <p class="text-xs text-green-800 text-center">✓ Withdrawal completed successfully!</p>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        @empty

                        <!-- EMPTY STATE -->
                        <div class="col-span-full text-center py-16 text-gray-500">
                            <div class="w-20 h-20 mx-auto mb-4 rounded-full flex items-center justify-center"
                                style="background:#f3f4f6;">
                                <iconify-icon icon="mdi:inbox-remove-outline" class="text-5xl text-gray-400"></iconify-icon>
                            </div>
                            <p class="text-lg font-semibold text-gray-700">No Withdrawals Yet</p>
                            <p class="text-sm text-gray-500 mb-4">You haven't made any withdrawal requests.</p>

                            <a href="{{ route('user.withdraw.form') }}"
                                class="px-6 py-3 rounded-lg font-semibold text-white shadow-lg transition-all"
                                style="background:#8AC304;">
                                + Make Your First Withdrawal
                            </a>
                        </div>

                        @endforelse

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- BANK TOGGLE SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.bank-details-toggle').forEach(btn => {
        btn.addEventListener('click', function () {
            let content = this.nextElementSibling;
            let arrow = this.querySelector('.arrow-icon');

            content.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        });
    });
});
</script>

<!-- CSS -->
<style>
.badge-approved {
    background:#d1fae5 !important;
    color:#065f46 !important;
}

.badge-pending {
    background:#fde68a !important;
    color:#92400e !important;
}

.badge-rejected {
    background:#ff4444 !important;
    color:#fff !important;
}

.badge-failed {
    background:#fecaca !important;
    color:#991b1b !important;
}

.admin-note {
    margin-top:1rem !important;
    padding:1rem !important;
    border-left:4px solid #ef4444 !important;
    background:#fee2e2 !important;
    border-radius:0.75rem !important;
}

.admin-note-icon {
    background:#fecaca !important;
    color:#b91c1c !important;
    border-radius:9999px !important;
    width:1.75rem !important;
    height:1.75rem !important;
    display:flex !important;
    align-items:center !important;
    justify-content:center !important;
}

.admin-note-message {
    font-size:0.75rem !important;
    color:#991b1b !important;
    padding-left:2.2rem !important;
}

.rotate-180 {
    transform:rotate(180deg) !important;
}
</style>

@endsection
