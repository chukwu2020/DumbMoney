@extends('layout.admin')
@section('content')

<div class="dashboard-main-body">

    {{-- HEADER --}}
    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold mb-0">Pending Deposits</h6>

        <ul class="flex items-center gap-[6px]">
            <li class="font-medium">
                <a href="{{ route('admin_dashboard') }}"
                   class="flex items-center gap-2 hover:text-primary-600">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="font-medium">Deposits</li>
        </ul>
    </div>

    {{-- CONTENT --}}
    <div class="grid grid-cols-1 2xl:grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card border-0 h-full">

                {{-- CARD HEADER --}}
                <div class="card-header">
                    <div class="flex items-center flex-wrap gap-2 justify-between">
                        <h6 class="font-bold text-lg mb-0">Pending Deposits</h6>
                        <span class="badge bg-warning">
                            {{ $deposits->count() }} Pending
                        </span>
                    </div>
                </div>

                {{-- CARD BODY --}}
                <div class="card-body p-6">
                    @if($deposits->count())

                        <div class="overflow-x-auto">
                            <table class="min-w-[1100px] w-full table bordered-table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th>Plan</th>
                                        <th>Proof</th>
                                        <th>Country</th>
                                        <th>Amount ($)</th>
                                        <th>Wallet</th>
                                        <th>Membership</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($deposits as $deposit)
                                        <tr>

                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $deposit->user->name }}</td>

                                            <td>{{ $deposit->user->email }}</td>

                                            <td>{{ $deposit->plan->name }}</td>

                                            <td>
                                                @if($deposit->proof)
                                                    <img src="{{ Storage::url($deposit->proof) }}"
                                                         alt="Proof"
                                                         style="width:60px;height:60px;cursor:pointer"
                                                         onclick="openModal('{{ Storage::url($deposit->proof) }}')">
                                                @else
                                                    <span class="text-gray-400">No proof</span>
                                                @endif
                                            </td>

                                            <td>{{ $deposit->user->country }}</td>

                                            <td>
                                                <strong class="text-success">
                                                    ${{ number_format($deposit->amount_deposited, 2) }}
                                                </strong>
                                            </td>

                                            <td>
                                                <strong>{{ $deposit->wallet->crypto_name }}</strong><br>
                                                <small class="text-muted">
                                                    {{ $deposit->wallet->wallet_address }}
                                                </small>
                                            </td>

                                            <td>
                                                @if($deposit->user->membership_code)
                                                    <span class="text-success font-mono">
                                                        {{ $deposit->user->membership_code }}
                                                    </span>
                                                @else
                                                    <button
                                                        onclick="generateMembershipCode({{ $deposit->user->id }})"
                                                        class="btn btn-sm btn-primary">
                                                        Generate
                                                    </button>
                                                @endif
                                            </td>

                                            <td>{{ $deposit->created_at->format('d M, Y') }}</td>

                                            <td>
                                                <div class="flex gap-2">
                                                    <form method="POST"
                                                          action="{{ route('admin.approve.deposit', $deposit->id) }}">
                                                        @csrf
                                                        <button class="btn btn-sm btn-success" style="background-color: greenyellow; color:black;">
                                                            Approve
                                                        </button>
                                                    </form>

                                                    <button
                                                        onclick="openRejectModal('{{ route('admin.reject.deposit', $deposit->id) }}')"
                                                        class="btn btn-sm btn-danger" style="background-color: red; color:black;">
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
                            No pending deposits found.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- IMAGE MODAL --}}
<div id="imageModal"
     class="fixed inset-0 bg-black bg-opacity-80 z-50 hidden items-center justify-center p-4"
     onclick="closeModal()">
    <img id="modalImage"
         class="max-w-full max-h-full rounded-lg shadow-lg object-contain"
         onclick="event.stopPropagation();">
</div>

{{-- REJECT MODAL --}}
<div id="rejectModal"
     class="fixed inset-0 bg-black bg-opacity-70 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h4 class="text-danger font-bold mb-3">Reject Deposit</h4>

        <form method="POST" id="rejectForm">
            @csrf
            @method('DELETE')

            <textarea name="rejection_note"
                      class="form-control"
                      required
                      placeholder="Reason for rejection..."></textarea>

            <div class="flex justify-end gap-3 mt-4">
                <button type="button"
                        onclick="closeRejectModal()"
                        class="btn btn-secondary">
                    Cancel
                </button>
                <button class="btn btn-danger">
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
