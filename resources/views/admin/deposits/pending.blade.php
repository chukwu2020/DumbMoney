@extends('layout.admin')
@section('content')

<style>
    * { color: black !important; }
</style>

<div class="dashboard-main-body" style="background: linear-gradient(135deg, #0C3A30 0%, #1a5c4a 50%, #0C3A30 100%); min-height: 100vh;">
    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold mb-0 text-white text-2xl">⏳ Pending Deposits</h6>
        <ul class="flex items-center gap-2">
            <li>
                <a href="{{ route('admin_dashboard') }}" class="flex items-center gap-2 text-[#8AC304] hover:text-white">
                    <iconify-icon icon="solar:home-smile-angle-outline"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li class="text-white">-</li>
            <li class="text-gray-300">Pending Deposits</li>
        </ul>
    </div>

    <div class="card border-0 shadow-xl rounded-2xl bg-white/95">
        <div class="card-header bg-gradient-to-r from-[#8AC304] to-[#6ea003] rounded-t-2xl p-5 flex justify-between items-center">
            <h5 class="text-white font-bold text-xl">📋 Pending Deposits</h5>
            <span class="bg-white text-[#0C3A30] px-4 py-1 rounded-full font-bold">
                {{ $deposits->count() }} Pending
            </span>
        </div>

        <div class="card-body p-6">
            @if($deposits->count())
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[1000px]">
                        <thead class="bg-[#0C3A30] text-white">
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Plan</th>
                                <th>Proof</th>
                                <th>Country</th>
                                <th>Amount</th>
                                <th>Wallet</th>
                                <th>Membership</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($deposits as $deposit)
                            <tr class="border-b hover:bg-gray-50">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $deposit->user->name }}</td>
                                <td class="text-sm text-gray-600">{{ $deposit->user->email }}</td>

                                <td>
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                        {{ $deposit->plan->name }}
                                    </span>
                                </td>

                                <td>
                                    @if($deposit->proof)
                                        <img src="{{ Storage::url($deposit->proof) }}"
                                             class="w-14 h-14 rounded-lg cursor-pointer hover:scale-110 transition"
                                             onclick="openModal('{{ Storage::url($deposit->proof) }}')">
                                    @else
                                        <span class="text-gray-400">No proof</span>
                                    @endif
                                </td>

                                <td>{{ $deposit->user->country }}</td>

                                <td class="font-bold text-[#8AC304]">
                                    ${{ number_format($deposit->amount_deposited, 2) }}
                                </td>

                                <td>
                                    <div>
                                        <strong>{{ $deposit->wallet->crypto_name }}</strong><br>
                                        <small class="text-gray-500 font-mono">
                                            {{ substr($deposit->wallet->wallet_address, 0, 10) }}...
                                        </small>
                                    </div>
                                </td>

                                <td>
                                    @if($deposit->user->membership_code)
                                        <span class="text-green-600 font-mono font-bold">
                                            {{ $deposit->user->membership_code }}
                                        </span>
                                    @else
                                        <button onclick="generateMembershipCode({{ $deposit->user->id }})"
                                                class="px-3 py-1 bg-[#8AC304] text-white rounded">
                                            Generate
                                        </button>
                                    @endif
                                </td>

                                <td>{{ $deposit->created_at->format('d M Y') }}</td>

                                <td class="flex gap-2">
                                    <form method="POST" action="{{ route('admin.approve.deposit', $deposit->id) }}">
                                        @csrf
                                        <button class="px-3 py-1 bg-green-600 text-white rounded">Approve</button>
                                    </form>

                                    <button onclick="openRejectModal('{{ route('admin.reject.deposit', $deposit->id) }}')"
                                            class="px-3 py-1 bg-red-600 text-white rounded">
                                        Reject
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12 text-gray-500">
                    📭 No pending deposits
                </div>
            @endif
        </div>
    </div>
</div>

{{-- IMAGE MODAL --}}
<div id="imageModal" class="fixed inset-0 bg-black/90 hidden items-center justify-center z-50" onclick="closeModal()">
    <img id="modalImage" class="max-h-[90vh] rounded-xl">
</div>

{{-- REJECT MODAL --}}
<div id="rejectModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 w-full max-w-md">
        <h3 class="text-red-600 font-bold text-xl mb-4">Reject Deposit</h3>

        <form method="POST" id="rejectForm">
            @csrf
            @method('DELETE')

            <textarea name="rejection_note" required
                      class="w-full border rounded-lg p-3"
                      placeholder="Reason for rejection..."></textarea>

            <div class="flex justify-end gap-3 mt-4">
                <button type="button" onclick="closeRejectModal()" class="px-4 py-2 bg-gray-300 rounded">
                    Cancel
                </button>
                <button class="px-4 py-2 bg-red-600 text-white rounded">
                    Reject
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
}

function openModal(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').classList.remove('hidden');
    document.getElementById('imageModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('imageModal').classList.add('hidden');
}
</script>

@endsection
