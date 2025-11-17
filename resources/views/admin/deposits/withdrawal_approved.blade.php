@extends('layout.admin')

@section('content')
<div class="dashboard-main-body p-4 sm:p-6 lg:p-8">

    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold mb-0 ">Approved Withdrawals</h6>
        <ul class="flex items-center gap-[6px]">
            <li class="font-medium">
                <a href="{{ route('admin_dashboard') }}" class="flex items-center gap-2 hover:text-primary-600">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="font-medium">Withdrawals</li>
        </ul>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    @if($approvedWithdrawals->isEmpty())
        <div class="text-gray-500">No approved withdrawal requests at the moment.</div>
    @else
    <div class="grid grid-cols-1 2xl:grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card border-0 h-full">
                <div class="card-body p-6 overflow-x-auto">
                    <table class="min-w-[900px] w-full table mb-0 divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Requested At</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($approvedWithdrawals as $withdrawal)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $withdrawal->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $withdrawal->user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    ${{ number_format($withdrawal->amount, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $status = strtolower($withdrawal->status);
                                        $badgeClass = match($status) {
                                            'approved' => 'bg-green-100 text-green-800',
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'rejected' => 'bg-red-600 text-white',
                                            'failed' => 'bg-red-100 text-red-800',
                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold {{ $badgeClass }}">
                                        {{ ucfirst($withdrawal->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $withdrawal->created_at->format('d M, Y h:i A') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap flex flex-col gap-1">
                                    @if($withdrawal->status === 'approved')
                                        <button type="button" 
                                                class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700 open-unapprove-modal"
                                                data-withdrawal-id="{{ $withdrawal->id }}">
                                            Unapprove
                                        </button>
                                    @endif
                                    <form action="{{ route('withdraw.delete', $withdrawal->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this withdrawal?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1 bg-gray-200 text-gray-800 text-sm font-medium rounded hover:bg-gray-300">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

{{-- Unapprove Modal --}}
<div id="unapproveModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-4">
        <h3 class="text-lg font-semibold mb-4" style="color: #0C3A30;">Unapprove Withdrawal</h3>
        <div class="mb-4 p-3 bg-yellow-50 border border-yellow-200 rounded">
            <p class="text-sm text-yellow-800">⚠️ This will restore the amount to the user's balance.</p>
        </div>
        <form id="unapproveForm" method="POST">
            @csrf
            <div class="mb-4">
                <label for="unapprove_note" class="block text-sm font-medium text-gray-700 mb-2">
                    Reason for Unapproving <span class="text-red-500">*</span>
                </label>
                <textarea 
                    name="admin_note" 
                    id="unapprove_note" 
                    rows="4" 
                    required
                    maxlength="500"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#8AC304] focus:border-transparent"
                    placeholder="Please explain why this withdrawal is being unapproved..."></textarea>
                <p class="text-xs text-gray-500 mt-1">Max 500 characters. User will see this message.</p>
            </div>
            <div class="flex gap-3 justify-end">
                <button type="button" 
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition close-unapprove-modal">
                    Cancel
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Confirm Unapprove
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const unapproveModal = document.getElementById('unapproveModal');
    const unapproveForm = document.getElementById('unapproveForm');
    const unapproveNote = document.getElementById('unapprove_note');

    document.querySelectorAll('.open-unapprove-modal').forEach(button => {
        button.addEventListener('click', () => {
            const withdrawalId = button.getAttribute('data-withdrawal-id');
            // Use proper route() in Blade with placeholder
            unapproveForm.action = "{{ route('withdraw.unapprove', ['id' => ':id']) }}".replace(':id', withdrawalId);
            unapproveNote.value = '';
            unapproveModal.classList.remove('hidden');
        });
    });

    document.querySelectorAll('.close-unapprove-modal').forEach(button => {
        button.addEventListener('click', () => {
            unapproveModal.classList.add('hidden');
        });
    });

    unapproveModal.addEventListener('click', (e) => {
        if (e.target === unapproveModal) {
            unapproveModal.classList.add('hidden');
        }
    });
});
</script>
@endsection
