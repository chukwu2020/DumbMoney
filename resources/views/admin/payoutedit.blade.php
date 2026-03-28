@extends('layout.admin')

@section('content')

<style>
    :root { --brand-green:#9EDD05; --brand-dark:#0C3A30; }
    .admin-input { width:100%; padding:.5rem .75rem; border:1px solid #d1d5db; border-radius:8px; font-size:.875rem; color:#111827; background:#fff; outline:none; transition:border-color .2s; }
    .admin-input:focus { border-color:var(--brand-green); box-shadow:0 0 0 3px rgba(158,221,5,.15); }
    .admin-label { display:block; font-size:.8rem; font-weight:600; color:#374151; margin-bottom:.35rem; }
    .btn-brand { background:var(--brand-green); color:var(--brand-dark); font-weight:700; padding:.55rem 1.5rem; border-radius:8px; font-size:.875rem; border:none; cursor:pointer; transition:background .2s; }
    .btn-brand:hover { background:#8bc905; }
</style>

<div class="dashboard-main-body">

    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold text-base" style="color:var(--brand-dark);">Edit Payout #{{ $payout->id }}</h6>
        <ul class="flex items-center gap-[6px] text-sm">
            <li><a href="{{ route('admin_dashboard') }}" class="flex items-center gap-1 hover:text-[#9EDD05]" style="color:var(--brand-dark);"><iconify-icon icon="solar:home-smile-angle-outline" class="text-lg"></iconify-icon> Dashboard</a></li>
            <li class="text-gray-400">-</li>
            <li><a href="{{ route('admin.payouts.index') }}" class="hover:text-[#9EDD05]" style="color:var(--brand-dark);">Payouts</a></li>
            <li class="text-gray-400">-</li>
            <li class="font-semibold" style="color:var(--brand-green);">Edit</li>
        </ul>
    </div>

    @if($errors->any())
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg">
            <ul class="mb-0 list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-200 border-t-4 p-6 shadow-sm" style="border-top-color:var(--brand-green);">

        <form action="{{ route('admin.payouts.update', $payout) }}" method="POST">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">

                <div>
                    <label class="admin-label">Date <span class="text-red-500">*</span></label>
                    <input type="date" name="pay_date" class="admin-input"
                        value="{{ old('pay_date', $payout->pay_date ? \Carbon\Carbon::parse($payout->pay_date)->format('Y-m-d') : '') }}" required>
                </div>

                <div>
                    <label class="admin-label">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" name="fullname" class="admin-input" value="{{ old('fullname', $payout->fullname) }}" required>
                </div>

                <div>
                    <label class="admin-label">Amount <span class="text-red-500">*</span></label>
                    <input type="text" name="amount" class="admin-input" value="{{ old('amount', $payout->amount) }}" required>
                </div>

                <div>
                    <label class="admin-label">Processing Time <span class="text-red-500">*</span></label>
                    <input type="text" name="processing_time" class="admin-input" value="{{ old('processing_time', $payout->processing_time) }}" required>
                </div>

                <div>
                    <label class="admin-label">Plan <span class="text-red-500">*</span></label>
                    <select name="plan_id" class="admin-input" required>
                        <option value="">Select Plan</option>
                        @foreach($plans as $plan)
                            <option value="{{ $plan->id }}" {{ $payout->plan_id == $plan->id ? 'selected' : '' }}>{{ $plan->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="admin-label">Account Type <span class="text-red-500">*</span></label>
                    <select name="account_type" class="admin-input" required>
                        <option value="">Select Type</option>
                        <option value="Crypto"        {{ $payout->account_type == 'Crypto'        ? 'selected' : '' }}>Crypto</option>
                        <option value="USDT"          {{ $payout->account_type == 'USDT'          ? 'selected' : '' }}>USDT</option>
                        <option value="Bank Transfer" {{ $payout->account_type == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                    </select>
                </div>

                <div>
                    <label class="admin-label">Location <span class="text-red-500">*</span></label>
                    <input type="text" name="location" class="admin-input" value="{{ old('location', $payout->location) }}" required>
                </div>

                <div>
                    <label class="admin-label">Country</label>
                    <input type="text" name="country" class="admin-input" value="{{ old('country', $payout->country) }}" placeholder="Country">
                </div>

                <div>
                    <label class="admin-label">Flag Code</label>
                    <input type="text" name="flag_code" class="admin-input" value="{{ old('flag_code', $payout->flag_code) }}" placeholder="e.g. US">
                </div>

                <div class="sm:col-span-2 lg:col-span-3 flex items-center gap-3 mt-1">
                    <input type="checkbox" name="is_active" id="is_active" class="w-4 h-4 accent-[#9EDD05]" {{ $payout->is_active ? 'checked' : '' }}>
                    <label for="is_active" class="text-sm font-semibold text-gray-700 cursor-pointer">Mark as Active</label>
                </div>

            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-brand">Update Payout</button>
                <a href="{{ route('admin.payouts.index') }}" class="px-5 py-2 rounded-lg border border-gray-300 text-gray-700 text-sm font-medium hover:bg-gray-50 transition">Cancel</a>
            </div>

        </form>
    </div>

</div>
@endsection