@extends('layout.admin')

@section('content')

<style>
    :root {
        --brand-green: #9EDD05;
        --brand-dark: #0C3A30;
    }

    /* Sticky header - prevents scrolling with table */
    .sticky-header {
        position: sticky;
        top: 0;
        z-index: 50;
        background: white;
        margin: 0;
        padding: 1rem 0;
    }

    .table-scroll {
        overflow-x: auto;
        overflow-y: auto;
        max-height: calc(100vh - 280px);
        -webkit-overflow-scrolling: touch;
    }

    /* Custom scrollbar */
    .table-scroll::-webkit-scrollbar {
        height: 6px;
        width: 6px;
    }
    .table-scroll::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    .table-scroll::-webkit-scrollbar-thumb {
        background: var(--brand-green);
        border-radius: 10px;
    }
    .table-scroll::-webkit-scrollbar-thumb:hover {
        background: #7bb502;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.78rem;
        min-width: 1000px;
    }

    thead th {
        background: linear-gradient(135deg, #0C3A30, #1a5c47);
        color: white;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.85rem 1rem;
        white-space: nowrap;
        position: sticky;
        top: 0;
        z-index: 10;
        border-right: 1px solid rgba(255,255,255,0.08);
    }

    thead th:first-child {
        position: sticky;
        left: 0;
        z-index: 20;
        background: linear-gradient(135deg, #0C3A30, #1a5c47);
    }

    tbody tr {
        border-bottom: 1px solid #f3f4f6;
        transition: background 0.15s;
    }

    tbody tr:hover {
        background: #f8fffe;
    }

    tbody td {
        padding: 0.85rem 1rem;
        color: #374151;
        vertical-align: middle;
        white-space: nowrap;
        border-right: 1px solid #f3f4f6;
    }

    tbody td:first-child {
        position: sticky;
        left: 0;
        background: white;
        z-index: 5;
        box-shadow: 2px 0 6px rgba(0,0,0,0.06);
    }

    tbody tr:hover td:first-child {
        background: #f8fffe;
    }

    /* Badge styles */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.68rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .badge-blue {
        background: #dbeafe;
        color: #1e40af;
        border: 1px solid #bfdbfe;
    }

    .badge-green {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #86efac;
    }

    .badge-gray {
        background: #f3f4f6;
        color: #374151;
        border: 1px solid #e5e7eb;
    }

    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        cursor: pointer;
        border: none;
    }

    .action-btn:hover {
        transform: scale(1.1);
    }

    .action-btn.edit {
        background: #dbeafe;
        color: #2563eb;
    }

    .action-btn.delete {
        background: #fee2e2;
        color: #dc2626;
    }

    .action-group {
        display: flex;
        justify-content: center;
        gap: 8px;
    }

    /* Form styles */
    .form-control {
        width: 100%;
        padding: 0.6rem 0.75rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--brand-green);
        box-shadow: 0 0 0 2px rgba(158,221,5,0.2);
    }

    .btn {
        padding: 0.6rem 1rem;
        border-radius: 0.5rem;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
    }

    .btn-primary {
        background: #0C3A30;
        color: white;
    }

    .btn-primary:hover {
        background: #1a5c47;
    }

    .btn-sm {
        padding: 0.4rem 0.75rem;
        font-size: 0.75rem;
    }

    /* Card styles */
    .card {
        background: white;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    /* Scroll hint for mobile */
    .scroll-hint {
        display: none;
        text-align: center;
        padding: 0.5rem;
        background: #f0fde4;
        font-size: 0.7rem;
        color: #0C3A30;
        margin-bottom: 0.5rem;
    }

    @media (max-width: 768px) {
        .scroll-hint {
            display: block;
        }
        
        .form-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>

<div class="dashboard-main-body">

    <!-- Sticky Header -->
    <div class="sticky-header">
        <div class="flex flex-wrap items-center justify-between gap-2 mb-4">
            <h6 class="font-semibold mb-0" style="color:#0C3A30;">Payouts Management</h6>
            <ul class="flex items-center gap-[6px] text-sm">
                <li class="font-medium">
                    <a href="{{ route('admin_dashboard') }}" class="flex items-center gap-2 hover:text-[#9EDD05]" style="color:#0C3A30;">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon> Dashboard
                    </a>
                </li>
                <li>-</li>
                <li class="font-medium" style="color:#9EDD05;">Payouts</li>
            </ul>
        </div>
    </div>

    <!-- Main Card -->
    <div class="grid grid-cols-12">
        <div class="col-span-12">
            <div class="card h-full p-0 rounded-xl border-0 overflow-hidden">

                <!-- Quick Add Form -->
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-sm font-bold mb-4 text-[#0C3A30]">Quick Add Payout</h3>
                    
                    <form action="{{ route('admin.payouts.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            <input type="date" name="pay_date" class="form-control" required>
                            <input type="text" name="fullname" class="form-control" placeholder="Full Name" required>
                            <input type="text" name="amount" class="form-control" placeholder="$0.00" required>
                            <input type="text" name="processing_time" class="form-control" placeholder="Processing Time" required>

                            <select name="plan_id" class="form-control" required>
                                <option value="">Select Plan</option>
                                @foreach($plans as $plan)
                                <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                @endforeach
                            </select>

                            <select name="account_type" class="form-control" required>
                                <option value="">Account Type</option>
                                <option>Crypto</option>
                                <option>USDT</option>
                                <option>Bank Transfer</option>
                            </select>

                            <input type="text" name="location" class="form-control" placeholder="Location" required>

                            <button class="btn btn-primary w-full">Add Payout</button>
                        </div>
                    </form>
                </div>

                <!-- Table Section -->
                <div class="p-6">
                    <!-- Top Bar -->
                    <div class="flex items-center justify-between mb-4 flex-wrap gap-3">
                        <h3 class="text-sm font-bold text-[#0C3A30]">Payout Records</h3>
                        <a href="{{ route('admin.payouts.create') }}" class="btn btn-primary btn-sm flex items-center gap-1">
                            <iconify-icon icon="ic:baseline-plus"></iconify-icon>
                            Add New
                        </a>
                    </div>

                    <!-- Scroll Hint for Mobile -->
                    <div class="scroll-hint">
                        <iconify-icon icon="ph:arrow-left-right-bold" class="text-sm"></iconify-icon>
                        Scroll horizontally to see all columns
                        <iconify-icon icon="ph:arrow-left-right-bold" class="text-sm"></iconify-icon>
                    </div>

                    <!-- Table Body -->
                    <!-- Table Body -->
<div class="table-scroll">
    
    <table>
        
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Processing</th>
                <th>Plan</th>
                <th>Type</th>
                <th>Location</th>
                <th>Status</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($payouts as $payout)
            <tr>
                <td class="font-medium">#{{ $payout->id }}</td>
                <td>{{ $payout->formatted_date }}</td>
                <td class="font-medium">{{ $payout->formatted_name }}</td>

                <td class="text-green-600 font-semibold">
                    {{ $payout->amount }}
                </td>

                <td>{{ $payout->processing_time }}</td>
                <td>{{ $payout->plan->name ?? '—' }}</td>

                <td>
                    <span class="badge badge-blue">
                        {{ $payout->account_type }}
                    </span>
                </td>

                <td>{{ $payout->location }}</td>

                <td>
                    @if($payout->is_active)
                        <span class="badge badge-green">Active</span>
                    @else
                        <span class="badge badge-gray">Inactive</span>
                    @endif
                </td>

                <td class="text-center">
                    <div class="action-group">
                        
                        <a href="{{ route('admin.payouts.edit', $payout) }}"
                           class="action-btn edit" title="Edit">
                            <iconify-icon icon="lucide:edit"></iconify-icon>
                        </a>

                        <form method="POST"
                              action="{{ route('admin.payouts.destroy', $payout) }}"
                              onsubmit="return confirm('Delete this payout?')"
                              style="display:inline;">
                            @csrf @method('DELETE')

                            <button class="action-btn delete" title="Delete">
                                <iconify-icon icon="fluent:delete-24-regular"></iconify-icon>
                            </button>
                        </form>

                    </div>
                </td>
            </tr>

            @empty
            <tr>
                <td colspan="10" class="text-center py-8 text-gray-400">
                    <iconify-icon icon="mdi:file-document-outline"
                        style="font-size:2.5rem; display:block; margin:0 auto 0.75rem;">
                    </iconify-icon>
                    No payouts found
                </td>
            </tr>
            @endforelse
        </tbody>

    </table>

</div>

                    <!-- Pagination -->
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        {{ $payouts->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection