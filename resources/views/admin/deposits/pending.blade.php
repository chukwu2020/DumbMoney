@extends('layout.admin')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-[#0C3A30] via-[#1a5c4a] to-[#0C3A30] overflow-hidden">
    <div class="p-4 md:p-6 max-w-full overflow-x-hidden">

        {{-- HEADER --}}
        <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
            <h6 class="font-semibold text-white text-2xl">⏳ Pending Deposits</h6>

            <ul class="flex items-center gap-2 text-sm">
                <li>
                    <a href="{{ route('admin_dashboard') }}"
                       class="flex items-center gap-2 text-[#8AC304] hover:text-white transition">
                        <iconify-icon icon="solar:home-smile-angle-outline"></iconify-icon>
                        Dashboard
                    </a>
                </li>
                <li class="text-white">/</li>
                <li class="text-gray-300">Pending Deposits</li>
            </ul>
        </div>

        {{-- CARD --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden max-w-full">

            {{-- CARD HEADER --}}
            <div class="bg-gradient-to-r from-[#8AC304] to-[#6ea003] p-5 flex items-center justify-between">
                <h5 class="text-white font-bold text-xl">📋 Pending Deposits</h5>
                <span class="bg-white text-[#0C3A30] px-4 py-1 rounded-full font-bold text-sm">
                    {{ $deposits->count() }} Pending
                </span>
            </div>

            {{-- CARD BODY --}}
            <div class="p-4 md:p-6">
                @if($deposits->count())

                    {{-- TABLE WRAPPER --}}
                    <div class="relative overflow-x-auto max-w-full border border-gray-200 rounded-xl">
                        <table class="w-full whitespace-nowrap text-sm">

                            <thead class="bg-[#0C3A30] text-white uppercase tracking-wider text-xs sticky top-0 z-10">
                                <tr>
                                    <th class="px-4 py-3">#</th>
                                    <th class="px-4 py-3">User</th>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3">Plan</th>
                                    <th class="px-4 py-3">Proof</th>
                                    <th class="px-4 py-3">Country</th>
                                    <th class="px-4 py-3">Amount</th>
                                    <th class="px-4 py-3">Wallet</th>
                                    <th class="px-4 py-3">Membership</th>
                                    <th class="px-4 py-3">Date</th>
                                    <th class="px-4 py-3">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y">
                                @foreach($deposits as $deposit)
                                    <tr class="hover:bg-gray-50">

                                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 font-medium">{{ $deposit->user->name }}</td>

                                        <td class="px-4 py-3 text-gray-600">
                                            {{ $deposit->user->email }}
                                        </td>

                                        <td class="px-4 py-3">
                                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                                {{ $deposit->plan->name }}
                                            </span>
                                        </td>

                                        <td class="px-4 py-3">
                                            @if($deposit->proof)
                                                <img src="{{ Storage::url($deposit->proof) }}"
                                                     class="w-12 h-12 rounded-lg cursor-pointer hover:scale-110 transition"
                                                     onclick="openModal('{{ Storage::url($deposit->proof) }}')">
                                            @else
                                                <span class="text-gray-400 text-xs">No proof</span>
                                            @endif
                                        </td>

                                        <td class="px-4 py-3">{{ $deposit->user->country }}</td>

                                        <td class="px-4 py-3 font-bold text-[#8AC304]">
                                            ${{ number_format($deposit->amount_deposited, 2) }}
                                        </td>

                                        <td class="px-4 py-3">
                                            <strong>{{ $deposit->wallet->crypto_name }}</strong>
                                            <div class="text-gray-500 font-mono text-xs">
                                                {{ Str::limit($deposit->wallet->wallet_address, 12) }}
                                            </div>
                                        </td>

                                        <td class="px-4 py-3">
                                            @if($deposit->user->membership_code)
                                                <span class="text-green-600 font-mono font-bold text-xs">
                                                    {{ $deposit->user->membership_code }}
                                                </span>
                                            @else
                                                <button
                                                    onclick="generateMembershipCode({{ $deposit->user->id }})"
                                                    class="px-3 py-1 bg-[#8AC304] text-white rounded text-xs">
                                                    Generate
                                                </button>
                                            @endif
                                        </td>

                                        <td class="px-4 py-3 text-gray-600">
                                            {{ $deposit->created_at->format('d M Y') }}
                                        </td>

                                        <td class="px-4 py-3">
                                            <div class="flex flex-wrap gap-2">
                                                <form method="POST"
                                                      action="{{ route('admin.approve.deposit', $deposit->id) }}">
                                                    @csrf
                                                    <button class="px-3 py-1 bg-green-600 text-white rounded text-xs">
                                                        Approve
                                                    </button>
                                                </form>

                                                <button
                                                    onclick="openRejectModal('{{ route('admin.reject.deposit', $deposit->id) }}')"
                                                    class="px-3 py-1 bg-red-600 text-white rounded text-xs">
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
                    <div class="text-center py-12 text-gray-500">
                        📭 No pending deposits
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- IMAGE MODAL --}}
<div id="imageModal"
     class="fixed inset-0 bg-black/90 hidden items-center justify-center z-50"
     onclick="closeModal()">
    <img id="modalImage" class="max-h-[90vh] rounded-xl">
</div>

{{-- REJECT MODAL --}}
<div id="rejectModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 w-[90%] max-w-md">
        <h3 class="text-red-600 font-bold text-xl mb-4">Reject Deposit</h3>

        <form method="POST" id="rejectForm">
            @csrf
            @method('DELETE')

            <textarea name="rejection_note" required
                      class="w-full border rounded-lg p-3 text-sm"
                      placeholder="Reason for rejection..."></textarea>

            <div class="flex justify-end gap-3 mt-4">
                <button type="button" onclick="closeRejectModal()"
                        class="px-4 py-2 bg-gray-300 rounded">
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
</script>

@endsection
