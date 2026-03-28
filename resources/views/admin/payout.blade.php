@extends('layout.admin')

@section('content')

<style>
    :root { --brand-green:#9EDD05; --brand-dark:#0C3A30; }
    .admin-input { width:100%; padding:.5rem .75rem; border:1px solid #d1d5db; border-radius:8px; font-size:.875rem; color:#111827; background:#fff; outline:none; transition:border-color .2s; }
    .admin-input:focus { border-color:var(--brand-green); box-shadow:0 0 0 3px rgba(158,221,5,.15); }
    .admin-label { display:block; font-size:.75rem; font-weight:600; color:#374151; margin-bottom:.3rem; }
    .btn-brand { background:var(--brand-green); color:var(--brand-dark); font-weight:700; padding:.5rem 1.25rem; border-radius:8px; font-size:.875rem; border:none; cursor:pointer; transition:background .2s; }
    .btn-brand:hover { background:#8bc905; }
    .data-table { width:100%; border-collapse:collapse; font-size:.85rem; }
    .data-table thead tr { background:var(--brand-dark); }
    .data-table thead th { color:#fff; padding:.75rem 1rem; text-align:left; font-weight:600; font-size:.72rem; text-transform:uppercase; letter-spacing:.5px; white-space:nowrap; }
    .data-table tbody tr { border-bottom:1px solid #f1f5f9; transition:background .15s; }
    .data-table tbody tr:hover { background:#f9fafb; }
    .data-table tbody td { padding:.75rem 1rem; color:#374151; vertical-align:middle; }
    .tbl-scroll { width:100%; overflow-x:auto; -webkit-overflow-scrolling:touch; }
    .tbl-scroll::-webkit-scrollbar { height:5px; }
    .tbl-scroll::-webkit-scrollbar-thumb { background:var(--brand-green); border-radius:10px; }
</style>

<div class="dashboard-main-body">

    {{-- Breadcrumb --}}
    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold text-base" style="color:var(--brand-dark);">Payouts Management</h6>
        <ul class="flex items-center gap-[6px] text-sm">
            <li><a href="{{ route('admin_dashboard') }}" class="flex items-center gap-1 hover:text-[#9EDD05]" style="color:var(--brand-dark);"><iconify-icon icon="solar:home-smile-angle-outline" class="text-lg"></iconify-icon> Dashboard</a></li>
            <li class="text-gray-400">-</li>
            <li class="font-semibold" style="color:var(--brand-green);">Payouts</li>
        </ul>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 text-sm font-medium rounded-lg">✅ {{ session('success') }}</div>
    @endif

    {{-- ── QUICK ADD FORM ── --}}
    <div class="bg-white rounded-2xl border border-gray-200 border-t-4 p-6 mb-8 shadow-sm" style="border-top-color:var(--brand-green);">
        <h3 class="text-sm font-bold mb-5" style="color:var(--brand-dark);">Quick Add Payout</h3>

        <form action="{{ route('admin.payouts.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                <div>
                    <label class="admin-label">Date <span class="text-red-500">*</span></label>
                    <input type="date" name="pay_date" class="admin-input" required>
                </div>
                <div>
                    <label class="admin-label">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" name="fullname" class="admin-input" placeholder="Full Name" required>
                </div>
                <div>
                    <label class="admin-label">Amount <span class="text-red-500">*</span></label>
                    <input type="text" name="amount" class="admin-input" placeholder="$0.00" required>
                </div>
                <div>
                    <label class="admin-label">Processing Time <span class="text-red-500">*</span></label>
                    <input type="text" name="processing_time" class="admin-input" placeholder="e.g. Instant" required>
                </div>
                <div>
                    <label class="admin-label">Plan <span class="text-red-500">*</span></label>
                    <select name="plan_id" class="admin-input" required>
                        <option value="">Select Plan</option>
                        @foreach($plans as $plan)
                            <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="admin-label">Account Type <span class="text-red-500">*</span></label>
                    <select name="account_type" class="admin-input" required>
                        <option value="">Select Type</option>
                        <option value="Crypto">Crypto</option>
                        <option value="USDT">USDT</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                    </select>
                </div>
                <div>
                    <label class="admin-label">Location <span class="text-red-500">*</span></label>
                    <input type="text" name="location" class="admin-input" placeholder="City, Country" required>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="btn-brand w-full">Add Payout</button>
                </div>
            </div>
        </form>
    </div>

    {{-- ── PAYOUT TABLE ── --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="text-sm font-bold" style="color:var(--brand-dark);">Payout Records</h3>
            <a href="{{ route('admin.payouts.create') }}" class="flex items-center gap-1 text-xs font-semibold px-4 py-2 rounded-lg transition" style="background:var(--brand-green); color:var(--brand-dark);">
                <iconify-icon icon="ic:baseline-plus"></iconify-icon> Add New
            </a>
        </div>

        <div class="tbl-scroll">
            <table class="data-table" style="min-width:900px;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Processing</th>
                        <th>Plan</th>
                        <th>Account Type</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payouts as $payout)
                    <tr>
                        <td class="font-medium text-gray-600">#{{ $payout->id }}</td>
                        <td class="text-gray-700">{{ $payout->formatted_date }}</td>
                        <td class="font-medium text-gray-800">{{ $payout->formatted_name }}</td>
                        <td class="font-semibold text-green-600">{{ $payout->amount }}</td>
                        <td class="text-gray-700">{{ $payout->processing_time }}</td>
                        <td class="text-gray-700">{{ $payout->plan->name ?? '—' }}</td>
                        <td>
                            <span class="px-2 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700">
                                {{ $payout->account_type ?? '—' }}
                            </span>
                        </td>
                        <td class="text-gray-700">{{ $payout->location }}</td>
                        <td>
                            @if($payout->is_active)
                                <span class="px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Active</span>
                            @else
                                <span class="px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">Inactive</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.payouts.edit', $payout) }}"
                                   class="px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition">Edit</a>
                                <form action="{{ route('admin.payouts.destroy', $payout) }}" method="POST" onsubmit="return confirm('Delete this payout?');" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-1 text-xs font-semibold bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="10" class="text-center py-8 text-gray-400">No payouts found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-100">
            {{ $payouts->links() }}
        </div>
    </div>

</div>
@endsection