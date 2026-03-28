{{-- resources/views/admin/copy-trading/index.blade.php --}}
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
        transition: all 0.2s ease;
    }
    .stats-card:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
    .request-card {
        border: 2px solid #e5e7eb; border-radius: 16px; padding: 1.5rem;
        transition: all 0.3s ease; background: white;
    }
    .request-card:hover { transform: translateY(-2px); border-color: var(--primary-green); box-shadow: 0 8px 20px rgba(158,221,5,0.15); }
    .tab-container { display: flex; gap: .5rem; background: #f3f4f6; padding: .5rem; border-radius: 12px; margin-bottom: 2rem; }
    .tab-btn {
        flex: 1; padding: .75rem 1.5rem; border: none; border-radius: 10px;
        font-weight: 600; font-size: .875rem; cursor: pointer; transition: all .2s ease;
        background: transparent; color: #6b7280; display: flex; align-items: center; justify-content: center; gap: .5rem;
    }
    .tab-btn:hover { background: #e5e7eb; color: #374151; }
    .tab-btn.active { background: white; color: var(--dark-green); box-shadow: 0 2px 8px rgba(0,0,0,.05); }
    .tab-btn.pending.active  { color: #f59e0b; }
    .tab-btn.approved.active { color: #10b981; }
    .tab-btn.rejected.active { color: #ef4444; }
    .badge-pending  { background:#fef3c7; color:#92400e; padding:.25rem .75rem; border-radius:20px; font-size:.75rem; font-weight:600; display:inline-flex; align-items:center; gap:4px; }
    .badge-approved { background:#d1fae5; color:#065f46; padding:.25rem .75rem; border-radius:20px; font-size:.75rem; font-weight:600; display:inline-flex; align-items:center; gap:4px; }
    .badge-rejected { background:#fee2e2; color:#991b1b; padding:.25rem .75rem; border-radius:20px; font-size:.75rem; font-weight:600; display:inline-flex; align-items:center; gap:4px; }
    .action-btn { padding:.5rem 1rem; border-radius:8px; font-weight:600; transition:all .2s ease; cursor:pointer; border:none; }
    .action-btn.approve { background:var(--primary-green); color:var(--dark-green); }
    .action-btn.approve:hover { background:var(--accent-green); transform:translateY(-1px); box-shadow:0 4px 8px rgba(158,221,5,.3); }
    .action-btn.reject  { background:#ef4444; color:#ffffff !important; }
    .action-btn.reject:hover { background:#dc2626; }
    .user-avatar { width:48px; height:48px; border-radius:50%; background:linear-gradient(135deg,var(--primary-green),var(--accent-green)); display:flex; align-items:center; justify-content:center; font-weight:bold; font-size:1.25rem; color:var(--dark-green); }
    .empty-state { text-align:center; padding:3rem; background:white; border-radius:16px; border:2px dashed #e5e7eb; }
    .empty-state-icon { width:80px; height:80px; margin:0 auto 1rem; background:#f3f4f6; border-radius:50%; display:flex; align-items:center; justify-content:center; }
</style>

<div class="dashboard-main-body">
    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <div>
            <h5 class="text-2xl font-bold" style="color:#0C3A30;">Copy Trading Requests</h5>
            <p class="text-sm text-gray-500 mt-1">Manage all copy trading requests from users</p>
        </div>
        <ul class="flex items-center gap-[6px]">
            <li><a href="{{ route('admin_dashboard') }}" class="flex items-center gap-2 hover:text-[#9EDD05]" style="color:#0C3A30;"><iconify-icon icon="solar:home-smile-angle-outline"></iconify-icon> Dashboard</a></li>
            <li>-</li>
            <li class="font-medium" style="color:#9EDD05;">Copy Trading</li>
        </ul>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="stats-card"><p class="text-sm text-gray-500 mb-1">Pending Requests</p><p class="text-2xl font-bold" style="color:#0C3A30;">{{ $pendingStats['total_pending'] ?? 0 }}</p></div>
        <div class="stats-card" style="border-left-color:#10b981;"><p class="text-sm text-gray-500 mb-1">Total Approved</p><p class="text-2xl font-bold text-green-600">{{ $approvedStats['total_approved'] ?? 0 }}</p></div>
        <div class="stats-card" style="border-left-color:#ef4444;"><p class="text-sm text-gray-500 mb-1">Total Rejected</p><p class="text-2xl font-bold text-red-600">{{ $rejectedStats['total_rejected'] ?? 0 }}</p></div>
        <div class="stats-card" style="border-left-color:#8b5cf6;"><p class="text-sm text-gray-500 mb-1">Total Amount</p><p class="text-2xl font-bold text-purple-600">${{ number_format(($pendingStats['total_amount'] ?? 0) + ($approvedStats['total_amount'] ?? 0), 2) }}</p></div>
    </div>

    <div class="tab-container">
        <button class="tab-btn pending active" onclick="switchTab('pending')">
            <iconify-icon icon="ph:clock-fill"></iconify-icon> Pending
            @if(($pendingStats['total_pending'] ?? 0) > 0)
                <span class="bg-yellow-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $pendingStats['total_pending'] }}</span>
            @endif
        </button>
        <button class="tab-btn approved" onclick="switchTab('approved')"><iconify-icon icon="ph:check-circle-fill"></iconify-icon> Approved</button>
        <button class="tab-btn rejected" onclick="switchTab('rejected')"><iconify-icon icon="ph:x-circle-fill"></iconify-icon> Rejected</button>
    </div>

    <div id="pendingTab" class="tab-content">
        <div class="grid grid-cols-1 gap-4">
            @forelse($pendingRequests ?? [] as $request)
                @include('admin.copytrading.partials', ['request' => $request, 'type' => 'pending'])
            @empty
                <div class="empty-state"><div class="empty-state-icon"><iconify-icon icon="ph:clock-fill" class="text-4xl text-gray-400"></iconify-icon></div><h6 class="text-lg font-semibold text-gray-700 mb-2">No Pending Requests</h6><p class="text-gray-500">All copy trading requests have been processed</p></div>
            @endforelse
        </div>
    </div>

    <div id="approvedTab" class="tab-content hidden">
        <div class="grid grid-cols-1 gap-4">
            @forelse($approvedRequests ?? [] as $request)
                @include('admin.copytrading.partials', ['request' => $request, 'type' => 'approved'])
            @empty
                <div class="empty-state"><div class="empty-state-icon"><iconify-icon icon="ph:check-circle-fill" class="text-4xl text-gray-400"></iconify-icon></div><h6 class="text-lg font-semibold text-gray-700 mb-2">No Approved Requests</h6><p class="text-gray-500">No copy trading requests have been approved yet</p></div>
            @endforelse
        </div>
    </div>

    <div id="rejectedTab" class="tab-content hidden">
        <div class="grid grid-cols-1 gap-4">
            @forelse($rejectedRequests ?? [] as $request)
                @include('admin.copytrading.partials', ['request' => $request, 'type' => 'rejected'])
            @empty
                <div class="empty-state"><div class="empty-state-icon"><iconify-icon icon="ph:x-circle-fill" class="text-4xl text-gray-400"></iconify-icon></div><h6 class="text-lg font-semibold text-gray-700 mb-2">No Rejected Requests</h6><p class="text-gray-500">No copy trading requests have been rejected</p></div>
            @endforelse
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-70 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl max-w-md w-full p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                <iconify-icon icon="ph:x-circle-fill" class="text-red-600 text-xl"></iconify-icon>
            </div>
            <h4 class="text-xl font-bold text-red-600">Reject Copy Request</h4>
        </div>
        <form id="rejectForm" method="POST">
            @csrf
            <input type="hidden" name="request_id" id="rejectRequestId">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Rejection</label>
                <textarea name="rejection_reason" class="w-full p-3 border border-gray-300 rounded-lg focus:border-[#9EDD05] focus:outline-none text-gray-800" rows="4" required placeholder="Please provide a reason for rejection..."></textarea>
                <p class="text-xs text-gray-400 mt-1"><iconify-icon icon="ph:info-fill" class="inline"></iconify-icon> This reason will be shown to the user</p>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeRejectModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-700 transition">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition flex items-center gap-2">
                    <iconify-icon icon="ph:x-bold"></iconify-icon> Reject
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function switchTab(tab) {
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelector(`.tab-btn.${tab}`).classList.add('active');
    ['pending','approved','rejected'].forEach(t => document.getElementById(t+'Tab').classList.add('hidden'));
    document.getElementById(tab+'Tab').classList.remove('hidden');
}
function approveRequest(id) {
    if (confirm('Approve this copy trading request?')) {
        fetch(`/admin/copy-trading/approve/${id}`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
        }).then(r => r.json()).then(data => { alert(data.message); if(data.success) location.reload(); });
    }
}
function showRejectModal(id) {
    document.getElementById('rejectRequestId').value = id;
    document.getElementById('rejectForm').action = `/admin/copy-trading/reject/${id}`;
    document.getElementById('rejectModal').classList.remove('hidden');
    document.getElementById('rejectModal').classList.add('flex');
}
function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
    document.getElementById('rejectModal').classList.remove('flex');
}
window.addEventListener('click', e => { const m = document.getElementById('rejectModal'); if (e.target === m) closeRejectModal(); });
</script>
@endsection