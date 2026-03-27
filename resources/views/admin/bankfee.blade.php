@extends('layout.admin')

@section('content')
<div class="dashboard-main-body">
    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold mb-0">Bank Fee Settings</h6>
        <ul class="flex items-center gap-[6px]">
            <li class="font-medium">
                <a href="{{ route('admin_dashboard') }}" class="flex items-center gap-2 hover:text-primary-600">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="font-medium">Bank Fee</li>
        </ul>
    </div>

    <div class="max-w-xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4" style="color: #0C3A30;">Bank Transfer Fee</h3>
            <p class="text-sm text-gray-500 mb-4">Set the percentage fee for bank transfer withdrawals</p>

            <form action="{{ route('admin.settings.bank-fee.update') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bank Fee (%)</label>
                    <div class="relative">
                        <input type="number" 
                               name="bank_fee" 
                               value="{{ $bankFee ?? 5 }}" 
                               step="0.1" 
                               min="0" 
                               max="100"
                               class="w-full p-3 border border-gray-300 rounded-lg focus:border-[#9EDD05] focus:outline-none">
                        <span class="absolute right-3 top-3 text-gray-500">%</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">This fee will be applied to all bank transfer withdrawals</p>
                </div>
                <button type="submit" class="bg-[#8AC304] text-[#0C3A30] px-4 py-2 rounded-lg font-semibold hover:bg-[#7bb502] transition">
                    Save Settings
                </button>
            </form>
        </div>
    </div>
</div>
@endsection