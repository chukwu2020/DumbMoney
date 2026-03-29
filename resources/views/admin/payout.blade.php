@extends('layout.admin')

@section('content')

<style>
    :root { --brand-green:#9EDD05; --brand-dark:#0C3A30; }

    .dashboard-main-body {
        max-width: 100%;
        overflow-x: hidden;
    }

    .admin-input {
        width: 100%;
        padding: .5rem .75rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: .875rem;
        color: #111827;
        background: #fff;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
        box-sizing: border-box;
    }
    .admin-input:focus {
        border-color: var(--brand-green);
        box-shadow: 0 0 0 3px rgba(158,221,5,.15);
    }

    .admin-label {
        display: block;
        font-size: .75rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: .3rem;
    }

    .btn-brand {
        background: var(--brand-green);
        color: var(--brand-dark);
        font-weight: 700;
        padding: .55rem 1.25rem;
        border-radius: 8px;
        font-size: .875rem;
        border: none;
        cursor: pointer;
        transition: background .2s;
        white-space: nowrap;
    }
    .btn-brand:hover { background: #8bc905; }

    /* Scrollable table shell */
    .tbl-shell {
        display: block;
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .tbl-shell::-webkit-scrollbar { height: 5px; }
    .tbl-shell::-webkit-scrollbar-thumb { background: var(--brand-green); border-radius: 10px; }
    .tbl-shell::-webkit-scrollbar-track { background: #f3f4f6; border-radius: 10px; }

    .data-table {
        width: max-content;
        min-width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: .83rem;
    }
    .data-table thead tr { background: var(--brand-dark); }
    .data-table thead th {
        color: #fff !important;
        padding: .75rem 1rem;
        text-align: left;
        font-weight: 600;
        font-size: .7rem;
        text-transform: uppercase;
        letter-spacing: .5px;
        white-space: nowrap;
        background: var(--brand-dark) !important;
    }
    .data-table tbody tr { border-bottom: 1px solid #f1f5f9; transition: background .15s; }
    .data-table tbody tr:hover { background: #f9fafb; }
    .data-table tbody td { padding: .75rem 1rem; color: #374151; vertical-align: middle; white-space: nowrap; }
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
        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 text-sm font-medium rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Quick Add Form --}}
    <div style="background:#fff; border-radius:16px; border:1px solid #e5e7eb; border-top:4px solid var(--brand-green); padding:1.5rem; margin-bottom:2rem; box-shadow:0 1px 3px rgba(0,0,0,.06);">
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

    {{-- Payout Table Card: overflow:hidden is the key fix --}}
    <div style="background:#fff; border-radius:16px; border:1px solid #e5e7eb; box-shadow:0 1px 3px rgba(0,0,0,.06); overflow:hidden; min-width:0; max-width:100%;">

        {{-- Card header — does NOT scroll --}}
        <div style="display:flex; align-items:center; justify-content:space-between; padding:1rem 1.5rem; border-bottom:1px solid #f1f5f9;">
            <h3 class="text-sm font-bold" style="color:var(--brand-dark);">Payout Records</h3>
            <a href="{{ route('admin.payouts.create') }}"
               style="display:inline-flex;align-items:center;gap:4px;font-size:.75rem;font-weight:600;padding:.4rem 1rem;border-radius:8px;background:var(--brand-green);color:var(--brand-dark);text-decoration:none;transition:background .2s;"
               onmouseover="this.style.background='#8bc905'"
               onmouseout="this.style.background='var(--brand-green)'">
                <iconify-icon icon="ic:baseline-plus"></iconify-icon> Add New
            </a>
        </div>

        {{-- Only this wrapper scrolls --}}
        <div class="tbl-shell">
            <table class="data-table">
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
                        <th style="text-align:center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payouts as $payout)
                    <tr>
                        <td style="font-weight:500;color:#6b7280;">#{{ $payout->id }}</td>
                        <td>{{ $payout->formatted_date }}</td>
                        <td style="font-weight:500;color:#111827;">{{ $payout->formatted_name }}</td>
                        <td style="font-weight:700;color:#16a34a;">{{ $payout->amount }}</td>
                        <td>{{ $payout->processing_time }}</td>
                        <td>{{ $payout->plan->name ?? '—' }}</td>
                        <td>
                            <span style="padding:3px 10px;border-radius:20px;font-size:.72rem;font-weight:600;background:#eff6ff;color:#1d4ed8;">
                                {{ $payout->account_type ?? '—' }}
                            </span>
                        </td>
                        <td>{{ $payout->location }}</td>
                        <td>
                            @if($payout->is_active)
                                <span style="padding:3px 10px;border-radius:20px;font-size:.72rem;font-weight:600;background:#dcfce7;color:#15803d;">Active</span>
                            @else
                                <span style="padding:3px 10px;border-radius:20px;font-size:.72rem;font-weight:600;background:#f3f4f6;color:#6b7280;">Inactive</span>
                            @endif
                        </td>
                        <td style="text-align:center;">
                            <div style="display:flex;align-items:center;justify-content:center;gap:6px;">
                                <a href="{{ route('admin.payouts.edit', $payout) }}"
                                   style="padding:4px 10px;font-size:.72rem;font-weight:600;background:#dbeafe;color:#2563eb;border-radius:8px;text-decoration:none;transition:background .2s;"
                                   onmouseover="this.style.background='#bfdbfe'"
                                   onmouseout="this.style.background='#dbeafe'">Edit</a>
                                <form action="{{ route('admin.payouts.destroy', $payout) }}" method="POST" onsubmit="return confirm('Delete this payout?');" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            style="padding:4px 10px;font-size:.72rem;font-weight:600;background:#fee2e2;color:#dc2626;border:none;border-radius:8px;cursor:pointer;transition:background .2s;"
                                            onmouseover="this.style.background='#fecaca'"
                                            onmouseout="this.style.background='#fee2e2'">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="10" style="text-align:center;padding:2rem;color:#9ca3af;">No payouts found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination — does NOT scroll --}}
        <div style="padding:1rem 1.5rem; border-top:1px solid #f1f5f9;">
            {{ $payouts->links() }}
        </div>
    </div>

</div>
@endsection