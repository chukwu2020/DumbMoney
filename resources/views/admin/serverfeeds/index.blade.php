@extends('layout.admin')

@section('content')

<style>
    :root {
        --brand-green: #9EDD05;
        --brand-dark: #0C3A30;
        --brand-accent: #8bc905;
    }

    /* ── Master card shell ── */
    .admin-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        border-top: 4px solid var(--brand-green);
        box-shadow: 0 4px 20px rgba(0,0,0,.06);
        overflow: hidden;
    }

    /* ── Form inputs ── */
    .admin-input {
        width: 100%;
        padding: .5rem .75rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: .875rem;
        color: var(--brand-dark);
        outline: none;
        transition: border-color .2s;
    }
    .admin-input:focus { border-color: var(--brand-green); box-shadow: 0 0 0 3px rgba(158,221,5,.15); }

    .admin-label {
        display: block;
        font-size: .75rem;
        font-weight: 600;
        color: #4b5563;
        margin-bottom: .3rem;
    }

    /* ── Section headings ── */
    .section-heading {
        font-size: .8rem;
        font-weight: 700;
        color: var(--brand-dark);
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: .5rem;
        margin-bottom: 1rem;
    }

    /* ── Submit button ── */
    .btn-brand {
        background: var(--brand-green);
        color: var(--brand-dark);
        font-weight: 700;
        padding: .55rem 1.5rem;
        border-radius: 8px;
        font-size: .875rem;
        border: none;
        cursor: pointer;
        transition: background .2s, transform .1s;
    }
    .btn-brand:hover { background: var(--brand-accent); transform: translateY(-1px); }

    /* ── Scrollable table wrapper ── */
    .table-scroll-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .table-scroll-wrapper::-webkit-scrollbar { height: 5px; }
    .table-scroll-wrapper::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
    .table-scroll-wrapper::-webkit-scrollbar-thumb { background: var(--brand-green); border-radius: 10px; }

    /* ── Data table ── */
    .data-table {
        width: 100%;
        min-width: 780px;
        border-collapse: collapse;
        font-size: .85rem;
    }
    .data-table thead tr {
        background: var(--brand-dark);
    }
    .data-table thead th {
        color: #fff;
        padding: .75rem 1rem;
        text-align: left;
        font-weight: 600;
        font-size: .75rem;
        text-transform: uppercase;
        letter-spacing: .5px;
        white-space: nowrap;
    }
    .data-table tbody tr {
        border-bottom: 1px solid #f1f5f9;
        transition: background .15s;
    }
    .data-table tbody tr:hover { background: #f9fafb; }
    .data-table tbody td {
        padding: .75rem 1rem;
        color: #374151;
        vertical-align: middle;
    }

    /* ── Avatar inside table ── */
    .tbl-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e5e7eb;
        flex-shrink: 0;
    }

    /* ── Badges ── */
    .badge-green {
        background: #d1fae5;
        color: #065f46;
        padding: .2rem .65rem;
        border-radius: 20px;
        font-size: .72rem;
        font-weight: 600;
        white-space: nowrap;
    }
    .badge-blue {
        background: #dbeafe;
        color: #1e40af;
        padding: .2rem .65rem;
        border-radius: 20px;
        font-size: .72rem;
        font-weight: 600;
        white-space: nowrap;
    }

    /* ── Action buttons ── */
    .btn-edit {
        background: #dbeafe;
        color: #1d4ed8;
        padding: .3rem .75rem;
        border-radius: 6px;
        font-size: .75rem;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        transition: background .2s;
    }
    .btn-edit:hover { background: #bfdbfe; }

    .btn-delete {
        background: #fee2e2;
        color: #dc2626;
        padding: .3rem .75rem;
        border-radius: 6px;
        font-size: .75rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        white-space: nowrap;
        transition: background .2s;
    }
    .btn-delete:hover { background: #fecaca; }

    /* ── Grid helpers ── */
    @media (max-width: 640px) {
        .form-grid-2 { grid-template-columns: 1fr !important; }
    }
</style>

<div class="dashboard-main-body">

    {{-- Breadcrumb --}}
    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold text-base" style="color:var(--brand-dark);">Active Servers</h6>
        <ul class="flex items-center gap-[6px] text-sm">
            <li>
                <a href="{{ route('admin_dashboard') }}" class="flex items-center gap-1 hover:text-[#9EDD05]" style="color:var(--brand-dark);">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li class="text-gray-400">-</li>
            <li class="font-semibold" style="color:var(--brand-green);">Servers</li>
        </ul>
    </div>

    {{-- ══ ADD SERVER FORM ══ --}}
    <div class="admin-card p-6 mb-8">

        <h3 class="text-base font-bold mb-6" style="color:var(--brand-dark);">Add New Server</h3>

        <form method="POST" action="{{ route('admin.feeds.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Server Profile --}}
            <div class="mb-7">
                <p class="section-heading">🖥️ Server Profile</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 form-grid-2">

                    <div class="sm:col-span-2">
                        <label class="admin-label">Server Profile Image</label>
                        <input type="file" name="server_profile_image" class="admin-input">
                    </div>

                    <div>
                        <label class="admin-label">Server Name <span class="text-red-500">*</span></label>
                        <input type="text" name="server_name" class="admin-input" required>
                    </div>

                    <div>
                        <label class="admin-label">Active Members <span class="text-red-500">*</span></label>
                        <input type="number" name="active_members" class="admin-input" required>
                    </div>

                    <div>
                        <label class="admin-label">Copying Trades <span class="text-red-500">*</span></label>
                        <input type="number" name="copying_trades" class="admin-input" required>
                    </div>

                    <div>
                        <label class="admin-label">Total Profit ($) <span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" name="profit_margin" class="admin-input" placeholder="e.g. 1500000.00" required>
                    </div>

                    <div>
                        <label class="admin-label">Win Rate (%)</label>
                        <input type="number" step="0.01" name="win_rate" class="admin-input" min="0" max="100" placeholder="e.g. 87.50">
                    </div>

                    <div class="flex items-center gap-2 sm:col-span-2 mt-1">
                        <input type="checkbox" name="copy_trading_enabled" value="1" checked class="w-4 h-4 accent-[#9EDD05]">
                        <label class="admin-label mb-0">Enable Copy Trading</label>
                    </div>

                </div>
            </div>

            {{-- Admin Profile --}}
            <div class="mb-7">
                <p class="section-heading">👤 Admin Profile</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 form-grid-2">

                    <div>
                        <label class="admin-label">Admin Name <span class="text-red-500">*</span></label>
                        <input type="text" name="admin_name" class="admin-input" required>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="admin-label">Admin Profile Image</label>
                        <input type="file" name="admin_profile_image" class="admin-input">
                    </div>

                </div>
            </div>

            <button type="submit" class="btn-brand">Add Server</button>

        </form>
    </div>

    {{-- ══ SERVER LIST TABLE ══ --}}
    @if($feeds->count() > 0)
    <div class="admin-card">

        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <h3 class="text-sm font-bold" style="color:var(--brand-dark);">Server List</h3>
            <span class="text-xs text-gray-400 font-medium">{{ $feeds->count() }} Total</span>
        </div>

        <div class="table-scroll-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Server</th>
                        <th>Admin</th>
                        <th>Members</th>
                        <th>Trades</th>
                        <th>Profit</th>
                        <th>Win Rate</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feeds as $feed)
                    <tr>

                        {{-- Server --}}
                        <td>
                            <div class="flex items-center gap-3">
                                @if($feed->server_profile_image)
                                    <img src="{{ asset('storage/servers/'.$feed->server_profile_image) }}"
                                         class="tbl-avatar"
                                         onerror="this.style.display='none'">
                                @endif
                                <div>
                                    <div class="font-semibold text-gray-800">{{ $feed->server_name }}</div>
                                    <div class="text-xs mt-0.5 {{ $feed->copy_trading_enabled ? 'text-green-600' : 'text-gray-400' }}">
                                        {{ $feed->copy_trading_enabled ? '● Copy Enabled' : '○ Copy Disabled' }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        {{-- Admin --}}
                        <td>
                            <div class="flex items-center gap-2">
                                @if($feed->admin_profile_image)
                                    <img src="{{ asset('storage/admins/'.$feed->admin_profile_image) }}"
                                         class="tbl-avatar"
                                         onerror="this.style.display='none'">
                                @endif
                                <span class="font-medium text-gray-800">{{ $feed->admin_name }}</span>
                            </div>
                        </td>

                        <td class="font-medium text-gray-700">{{ number_format($feed->active_members) }}</td>
                        <td class="font-medium text-gray-700">{{ number_format($feed->copying_trades) }}</td>

                        {{-- Profit --}}
                        <td>
                            <span class="badge-green">${{ number_format($feed->profit_margin, 2) }}</span>
                        </td>

                        {{-- Win Rate --}}
                        <td>
                            <span class="badge-blue">{{ number_format($feed->win_rate, 2) }}%</span>
                        </td>

                        {{-- Actions --}}
                        <td>
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.feeds.edit', $feed->id) }}" class="btn-edit">Edit</a>

                                <form method="POST" action="{{ route('admin.feeds.delete', $feed->id) }}"
                                      onsubmit="return confirm('Delete this server?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Delete</button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    @endif

</div>
@endsection