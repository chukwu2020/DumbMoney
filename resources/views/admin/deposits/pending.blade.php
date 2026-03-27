@extends('layout.admin')
@section('content')

<style>
    :root {
        --primary-green: #9EDD05;
        --dark-green: #0C3A30;
        --accent-green: #8AC304;
    }

    .stats-card {
        background: white;
        border-radius: 12px;
        padding: 1.25rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        border-left: 4px solid var(--primary-green);
        transition: all 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .table th {
        background: #f8fafc;
        color: var(--dark-green);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    .table td {
        vertical-align: middle;
    }

    .badge-pending {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        color: #92400e;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .action-btn {
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        transition: all 0.2s ease;
        cursor: pointer;
        border: none;
    }

    .action-btn.approve {
        background: var(--primary-green);
        color: var(--dark-green);
    }

    .action-btn.approve:hover {
        background: var(--accent-green);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(158, 221, 5, 0.3);
    }

    .action-btn.reject {
        background: #ef4444;
        color: white;
    }

    .action-btn.reject:hover {
        background: #dc2626;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3);
    }

    .proof-thumbnail {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        border: 2px solid #e5e7eb;
    }

    .proof-thumbnail:hover {
        transform: scale(1.1);
        border-color: var(--primary-green);
        box-shadow: 0 4px 12px rgba(158, 221, 5, 0.3);
    }

    .wallet-info {
        font-size: 0.85rem;
    }

    .wallet-address {
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .modal-content {
        border-radius: 16px;
        overflow: hidden;
    }

    .modal-header {
        background: linear-gradient(135deg, var(--primary-green), var(--accent-green));
        color: var(--dark-green);
        padding: 1rem 1.5rem;
    }

    .modal-footer {
        padding: 1rem 1.5rem;
    }
</style>

<div class="dashboard-main-body">
    {{-- HEADER --}}
    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h5 class="text-2xl font-bold" style="color: #0C3A30;">Pending Deposits</h5>
        <ul class="flex items-center gap-[6px]">
            <li class="font-medium">
                <a href="{{ route('admin_dashboard') }}" class="flex items-center gap-2 hover:text-[#9EDD05]"
                   style="color: #0C3A30;">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="font-medium" style="color: #9EDD05;">Pending Deposits</li>
        </ul>
    </div>

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="stats-card">
            <p class="text-sm text-gray-500 mb-1">Total Pending</p>
            <p class="text-2xl font-bold" style="color: #0C3A30;">{{ $deposits->count() }}</p>
        </div>
        <div class="stats-card" style="border-left-color: #10b981;">
            <p class="text-sm text-gray-500 mb-1">Total Amount</p>
            <p class="text-2xl font-bold text-green-600">
                ${{ number_format($deposits->sum('amount_deposited'), 2) }}
            </p>
        </div>
        <div class="stats-card" style="border-left-color: #f59e0b;">
            <p class="text-sm text-gray-500 mb-1">Avg. Deposit</p>
            <p class="text-2xl font-bold text-yellow-600">
                ${{ number_format($deposits->avg('amount_deposited') ?: 0, 2) }}
            </p>
        </div>
        <div class="stats-card" style="border-left-color: #8b5cf6;">
            <p class="text-sm text-gray-500 mb-1">Unique Users</p>
            <p class="text-2xl font-bold text-purple-600">
                {{ $deposits->pluck('user_id')->unique()->count() }}
            </p>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="grid grid-cols-1 gap-6">
        <div class="col-span-12">
            <div class="card border-0 rounded-xl shadow-sm overflow-hidden">
                {{-- CARD HEADER --}}
                <div class="card-header bg-white p-6 border-b border-gray-200">
                    <div class="flex items-center flex-wrap gap-2 justify-between">
                        <h6 class="font-bold text-lg mb-0" style="color: #0C3A30;">Pending Deposits</h6>
                        <span class="badge-pending">
                            <iconify-icon icon="ph:clock-fill" class="mr-1"></iconify-icon>
                            {{ $deposits->count() }} Pending
                        </span>
                    </div>
                </div>

                {{-- CARD BODY --}}
                <div class="card-body p-6">
                    @if($deposits->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-[1200px] w-full table">
                                <thead>
                                    <tr>
                                        <th class="p-3 text-left">#</th>
                                        <th class="p-3 text-left">User</th>
                                        <th class="p-3 text-left">Email</th>
                                        <th class="p-3 text-left">Plan</th>
                                        <th class="p-3 text-left">Proof</th>
                                        <th class="p-3 text-left">Country</th>
                                        <th class="p-3 text-left">Amount</th>
                                        <th class="p-3 text-left">Wallet</th>
                                        <th class="p-3 text-left">Membership</th>
                                        <th class="p-3 text-left">Date</th>
                                        <th class="p-3 text-left">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($deposits as $deposit)
                                        <tr class="border-t border-gray-100 hover:bg-gray-50 transition">
                                            <td class="p-3">{{ $loop->iteration }}</td>

                                            <td class="p-3 font-medium">{{ $deposit->user->name ?? 'N/A' }}</td>

                                            <td class="p-3">{{ $deposit->user->email ?? 'N/A' }}</td>

                                            {{-- Plan (now optional) --}}
                                            <td class="p-3">
                                                @if($deposit->plan)
                                                    <span class="font-medium">{{ $deposit->plan->name }}</span>
                                                @else
                                                    <span class="text-gray-400 text-sm">No plan selected</span>
                                                @endif
                                            </td>

                                            {{-- Proof --}}
                                            <td class="p-3">
                                                @if($deposit->proof)
                                                    <img src="{{ Storage::url($deposit->proof) }}"
                                                         alt="Proof"
                                                         class="proof-thumbnail"
                                                         onclick="openModal('{{ Storage::url($deposit->proof) }}')">
                                                @else
                                                    <span class="text-gray-400 text-sm">No proof</span>
                                                @endif
                                            </td>

                                            <td class="p-3">{{ $deposit->user->country ?? 'N/A' }}</td>

                                            <td class="p-3">
                                                <strong class="text-green-600">
                                                    ${{ number_format($deposit->amount_deposited, 2) }}
                                                </strong>
                                            </td>

                                            <td class="p-3">
                                                <div class="wallet-info">
                                                    <strong>{{ $deposit->wallet->crypto_name ?? 'N/A' }}</strong>
                                                    @if($deposit->wallet)
                                                    <div class="wallet-address text-gray-500 text-xs" 
                                                         title="{{ $deposit->wallet->wallet_address }}">
                                                        {{ substr($deposit->wallet->wallet_address, 0, 15) }}...
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>

                                            <td class="p-3">
                                                @if($deposit->user->membership_code)
                                                    <span class="font-mono text-xs bg-gray-100 px-2 py-1 rounded">
                                                        {{ $deposit->user->membership_code }}
                                                    </span>
                                                @else
                                                    <button
                                                        onclick="generateMembershipCode({{ $deposit->user->id }})"
                                                        class="action-btn approve text-xs">
                                                        Generate
                                                    </button>
                                                @endif
                                            </td>

                                            <td class="p-3 text-sm text-gray-500">
                                                {{ $deposit->created_at->format('d M, Y') }}
                                            </td>

                                            <td class="p-3">
                                                <div class="flex gap-2">
                                                    <form method="POST"
                                                          action="{{ route('admin.approve.deposit', $deposit->id) }}">
                                                        @csrf
                                                        <button class="action-btn approve" type="submit">
                                                            <iconify-icon icon="ph:check-bold" class="mr-1"></iconify-icon>
                                                            Approve
                                                        </button>
                                                    </form>

                                                    <button
                                                        onclick="openRejectModal('{{ route('admin.reject.deposit', $deposit->id) }}')"
                                                        class="action-btn reject">
                                                        <iconify-icon icon="ph:x-bold" class="mr-1"></iconify-icon>
                                                        Reject
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                <iconify-icon icon="ph:clock-fill" class="text-4xl text-gray-400"></iconify-icon>
                            </div>
                            <p class="text-gray-500 text-lg mb-2">No Pending Deposits</p>
                            <p class="text-gray-400 text-sm">All deposits have been processed</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- IMAGE MODAL --}}
<div id="imageModal"
     class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden items-center justify-center p-4"
     onclick="closeModal()">
    <div class="relative max-w-4xl w-full">
        <button onclick="closeModal()" 
                class="absolute -top-10 right-0 text-white hover:text-gray-300">
            <iconify-icon icon="ph:x-bold" class="text-2xl"></iconify-icon>
        </button>
        <img id="modalImage"
             class="w-full rounded-lg shadow-2xl object-contain max-h-[80vh]"
             onclick="event.stopPropagation();">
    </div>
</div>

{{-- REJECT MODAL --}}
<div id="rejectModal"
     class="fixed inset-0 bg-black bg-opacity-70 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-xl w-full max-w-md modal-content">
        <div class="modal-header">
            <h4 class="font-bold text-lg flex items-center gap-2">
                <iconify-icon icon="ph:warning-circle-fill"></iconify-icon>
                Reject Deposit
            </h4>
        </div>

        <form method="POST" id="rejectForm">
            @csrf
            @method('DELETE')

            <div class="p-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Reason for Rejection
                </label>
                <textarea name="rejection_note"
                          class="w-full p-3 border border-gray-300 rounded-lg focus:border-[#9EDD05] focus:outline-none"
                          rows="4"
                          required
                          placeholder="Please provide a reason for rejection..."></textarea>
            </div>

            <div class="modal-footer bg-gray-50 flex justify-end gap-3">
                <button type="button"
                        onclick="closeRejectModal()"
                        class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                    Cancel
                </button>
                <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition flex items-center gap-2">
                    <iconify-icon icon="ph:x-bold"></iconify-icon>
                    Confirm Reject
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPTS --}}
<script>
function openRejectModal(action) {
    document.getElementById('rejectForm').action = action;
    document.getElementById('rejectModal').classList.remove('hidden');
    document.getElementById('rejectModal').classList.add('flex');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
    document.getElementById('rejectModal').classList.remove('flex');
}

function openModal(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').classList.remove('hidden');
    document.getElementById('imageModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.getElementById('imageModal').classList.remove('flex');
}

function generateMembershipCode(userId) {
    if(confirm('Generate membership code for this user?')) {
        // Add your membership code generation logic here
        alert('Membership code generation - implement your logic');
    }
}
</script>
@endsection