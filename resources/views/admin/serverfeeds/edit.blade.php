@extends('layout.admin')

@section('content')

<style>
    :root {
        --brand-green: #9EDD05;
        --brand-dark: #0C3A30;
        --brand-accent: #8bc905;
    }
    .admin-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        border-top: 4px solid var(--brand-green);
        box-shadow: 0 4px 20px rgba(0,0,0,.06);
    }
    .admin-input {
        width: 100%;
        padding: .5rem .75rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: .875rem;
        color: var(--brand-dark);
        outline: none;
        transition: border-color .2s;
        background: #fff;
    }
    .admin-input:focus { border-color: var(--brand-green); box-shadow: 0 0 0 3px rgba(158,221,5,.15); }
    .admin-label {
        display: block;
        font-size: .8rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: .35rem;
    }
    .btn-brand {
        background: var(--brand-green);
        color: var(--brand-dark);
        font-weight: 700;
        padding: .6rem 1.75rem;
        border-radius: 8px;
        font-size: .875rem;
        border: none;
        cursor: pointer;
        transition: background .2s, transform .1s;
    }
    .btn-brand:hover { background: var(--brand-accent); transform: translateY(-1px); }

    @media (max-width: 640px) {
        .form-grid { grid-template-columns: 1fr !important; }
    }
</style>

<div class="dashboard-main-body">

    {{-- Breadcrumb --}}
    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold text-base" style="color:var(--brand-dark);">Edit Server</h6>
        <ul class="flex items-center gap-[6px] text-sm">
            <li>
                <a href="{{ route('admin_dashboard') }}" class="flex items-center gap-1 hover:text-[#9EDD05]" style="color:var(--brand-dark);">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li class="text-gray-400">-</li>
            <li style="color:var(--brand-green);" class="font-semibold">Edit Server</li>
        </ul>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm font-medium">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="admin-card p-6">

        <form method="POST"
              action="{{ route('admin.feeds.update', $feed->id) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Server Section --}}
            <div class="mb-8">
                <p class="text-xs font-bold mb-4 pb-2 border-b border-gray-100" style="color:var(--brand-dark);">🖥️ Server Details</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 form-grid">

                    <div>
                        <label class="admin-label">Server Name <span class="text-red-500">*</span></label>
                        <input type="text" name="server_name" value="{{ $feed->server_name }}" class="admin-input" required>
                    </div>

                    <div>
                        <label class="admin-label">Active Members <span class="text-red-500">*</span></label>
                        <input type="number" name="active_members" value="{{ $feed->active_members }}" class="admin-input" required>
                    </div>

                    <div>
                        <label class="admin-label">Copying Trades <span class="text-red-500">*</span></label>
                        <input type="number" name="copying_trades" value="{{ $feed->copying_trades }}" class="admin-input" required>
                    </div>

                    <div>
                        <label class="admin-label">Profit Margin ($) <span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" name="profit_margin" value="{{ $feed->profit_margin }}" class="admin-input" required>
                    </div>

                    <div>
                        <label class="admin-label">Win Rate (%)</label>
                        <input type="number" step="0.01" name="win_rate" value="{{ $feed->win_rate }}" class="admin-input" min="0" max="100">
                    </div>

                    <div class="flex items-center gap-2 self-end pb-2">
                        <input type="checkbox" name="copy_trading_enabled" value="1"
                               {{ $feed->copy_trading_enabled ? 'checked' : '' }}
                               class="w-4 h-4 accent-[#9EDD05]">
                        <label class="admin-label mb-0">Enable Copy Trading</label>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="admin-label">Server Profile Image</label>
                        @if($feed->server_profile_image)
                            <div class="mb-2">
                               
                                <img src="{{ asset('uploads/servers/' . $feed->server_profile_image) }}"
                                     class="w-14 h-14 rounded-full object-cover border-2 border-gray-200"
                                     onerror="this.style.display='none'">
                            </div>
                        @endif
                        <input type="file" name="server_profile_image" class="admin-input">
                        <p class="text-xs text-gray-400 mt-1">Leave blank to keep current image</p>
                    </div>

                </div>
            </div>

            {{-- Admin Section --}}
            <div class="mb-8">
                <p class="text-xs font-bold mb-4 pb-2 border-b border-gray-100" style="color:var(--brand-dark);">👤 Admin Details</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 form-grid">

                    <div class="sm:col-span-2">
                        <label class="admin-label">Admin Name <span class="text-red-500">*</span></label>
                        <input type="text" name="admin_name" value="{{ $feed->admin_name }}" class="admin-input" required>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="admin-label">Admin Profile Image</label>
                        @if($feed->admin_profile_image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/admins/'.$feed->admin_profile_image) }}"
                                     class="w-14 h-14 rounded-full object-cover border-2 border-gray-200"
                                     onerror="this.style.display='none'">
                            </div>
                        @endif
                        <input type="file" name="admin_profile_image" class="admin-input">
                        <p class="text-xs text-gray-400 mt-1">Leave blank to keep current image</p>
                    </div>

                </div>
            </div>

            <button type="submit" class="btn-brand">Update Server</button>

        </form>

    </div>

</div>
@endsection