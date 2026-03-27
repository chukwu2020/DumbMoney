{{-- resources/views/admin/plans/add-plan.blade.php --}}
@extends('layout.admin')
@section('content')

<div class="dashboard-main-body">
    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold mb-0">Add Trading Plan</h6>
        <ul class="flex items-center gap-[6px]">
            <li class="font-medium">
                <a href="{{route('admin_dashboard')}}" class="flex items-center gap-2 hover:text-primary-600">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="font-medium">Add Plan</li>
        </ul>
    </div>

    <div class="card h-full rounded-xl overflow-hidden border-0">
        <div class="card-body p-10">
            <form action="{{ route('plans.store') }}" method="POST" id="planForm">
                @csrf
                
                <!-- Basic Information -->
                <h5 class="text-lg font-semibold mb-4" style="color: #0C3A30;">Basic Information</h5>
                <div class="grid md:grid-cols-3 gap-x-5 mb-6">
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block text-neutral-900">Plan Name</label>
                        <input type="text" class="form-control rounded-lg" name="name" placeholder="e.g., Beginner Trader" value="{{ old('name') }}">
                        <span class="text-danger">@error ('name') {{ $message }} @enderror</span>
                    </div>

                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block text-neutral-900">Duration</label>
                        <input type="number" class="form-control rounded-lg" name="duration" placeholder="30" value="{{ old('duration') }}">
                        <span class="text-red">@error ('duration') {{ $message }} @enderror</span>
                    </div>

                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block text-neutral-900">Duration Unit</label>
                        <select name="duration_unit" class="form-control rounded-lg">
                            <option value="minutes" {{ old('duration_unit') == 'minutes' ? 'selected' : '' }}>Minutes</option>
                            <option value="hours" {{ old('duration_unit') == 'hours' ? 'selected' : '' }}>Hours</option>
                            <option value="days" {{ old('duration_unit') == 'days' ? 'selected' : '' }}>Days</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Select the unit for the duration</p>
                    </div>
                </div>

                <!-- Minimum Duration (if flexible) -->
                <div class="mb-4">
                    <label class="text-sm font-semibold mb-2 block text-neutral-900">Minimum Duration (if flexible)</label>
                    <input type="text" class="form-control rounded-lg" name="min_duration" placeholder="e.g., 7-30 days" value="{{ old('min_duration') }}">
                </div>

                <!-- Amount Range -->
                <h5 class="text-lg font-semibold mb-4" style="color: #0C3A30;">Investment Range</h5>
                <div class="grid md:grid-cols-2 gap-x-5 mb-6">
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block text-neutral-900">Minimum Amount ($)</label>
                        <input type="number" name="minimum_amount" class="form-control rounded-lg" placeholder="1000" value="{{ old('minimum_amount') }}">
                        <span class="text-red">@error ('minimum_amount') {{ $message }} @enderror</span>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block text-neutral-900">Maximum Amount ($)</label>
                        <input type="number" name="maximum_amount" class="form-control rounded-lg" placeholder="50000" value="{{ old('maximum_amount') }}">
                        <span class="text-red">@error ('maximum_amount') {{ $message }} @enderror</span>
                    </div>
                </div>

                <!-- Trading Details -->
                <h5 class="text-lg font-semibold mb-4" style="color: #0C3A30;">Trading Details</h5>
                <div class="grid md:grid-cols-3 gap-x-5 mb-6">
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block text-neutral-900">Interest Rate (%)</label>
                        <input type="number" step="0.01" name="interest_rate" class="form-control rounded-lg" placeholder="15" value="{{ old('interest_rate') }}">
                        <span class="text-red">@error ('interest_rate') {{ $message }} @enderror</span>
                    </div>

                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block text-neutral-900">Expected ROI Range</label>
                        <input type="text" name="expected_roi_range" class="form-control rounded-lg" placeholder="e.g., 15-25%" value="{{ old('expected_roi_range') }}">
                    </div>

                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block text-neutral-900">Profit Frequency</label>
                        <select name="profit_frequency" class="form-control rounded-lg">
                            <option value="daily" {{ old('profit_frequency') == 'daily' ? 'selected' : '' }}>Daily</option>
                            <option value="weekly" {{ old('profit_frequency') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                            <option value="monthly" {{ old('profit_frequency') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                        </select>
                    </div>
                </div>

                <!-- Trading Style & Risk -->
                <div class="grid md:grid-cols-3 gap-x-5 mb-6">
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block text-neutral-900">Trading Style</label>
                        <select name="trading_style" class="form-control rounded-lg">
                            <option value="">Select Style</option>
                            <option value="Scalping" {{ old('trading_style') == 'Scalping' ? 'selected' : '' }}>Scalping (Fast, small profits)</option>
                            <option value="Day Trading" {{ old('trading_style') == 'Day Trading' ? 'selected' : '' }}>Day Trading (Close positions daily)</option>
                            <option value="Swing Trading" {{ old('trading_style') == 'Swing Trading' ? 'selected' : '' }}>Swing Trading (2-5 days)</option>
                            <option value="Position Trading" {{ old('trading_style') == 'Position Trading' ? 'selected' : '' }}>Position Trading (Weeks/Months)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block text-neutral-900">Risk Level</label>
                        <select name="risk_level" class="form-control rounded-lg">
                            <option value="">Select Risk</option>
                            <option value="Low" {{ old('risk_level') == 'Low' ? 'selected' : '' }}>Low (Conservative)</option>
                            <option value="Medium" {{ old('risk_level') == 'Medium' ? 'selected' : '' }}>Medium (Balanced)</option>
                            <option value="High" {{ old('risk_level') == 'High' ? 'selected' : '' }}>High (Aggressive)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block text-neutral-900">Recommended For</label>
                        <select name="recommended_for" class="form-control rounded-lg">
                            <option value="">Select Level</option>
                            <option value="Beginners" {{ old('recommended_for') == 'Beginners' ? 'selected' : '' }}>Beginners</option>
                            <option value="Intermediate" {{ old('recommended_for') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="Expert" {{ old('recommended_for') == 'Expert' ? 'selected' : '' }}>Expert</option>
                        </select>
                    </div>
                </div>

                <!-- Strategy & Assets -->
                <div class="grid md:grid-cols-2 gap-x-5 mb-6">
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block text-neutral-900">Trading Strategy</label>
                        <textarea name="strategy" class="form-control rounded-lg" rows="3" placeholder="Describe the trading strategy...">{{ old('strategy') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block text-neutral-900">Assets Traded</label>
                        <div class="space-y-2 border rounded-lg p-3">
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="assets_traded[]" value="Forex" {{ is_array(old('assets_traded')) && in_array('Forex', old('assets_traded')) ? 'checked' : '' }}>
                                <span>Forex (EUR/USD, GBP/USD, etc.)</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="assets_traded[]" value="Crypto" {{ is_array(old('assets_traded')) && in_array('Crypto', old('assets_traded')) ? 'checked' : '' }}>
                                <span>Crypto (BTC, ETH, SOL, etc.)</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="assets_traded[]" value="Stocks" {{ is_array(old('assets_traded')) && in_array('Stocks', old('assets_traded')) ? 'checked' : '' }}>
                                <span>Stocks (Apple, Tesla, etc.)</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="assets_traded[]" value="Commodities" {{ is_array(old('assets_traded')) && in_array('Commodities', old('assets_traded')) ? 'checked' : '' }}>
                                <span>Commodities (Gold, Oil, etc.)</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="assets_traded[]" value="Indices" {{ is_array(old('assets_traded')) && in_array('Indices', old('assets_traded')) ? 'checked' : '' }}>
                                <span>Indices (S&P 500, NASDAQ, etc.)</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Fees -->
                <h5 class="text-lg font-semibold mb-4" style="color: #0C3A30;">Fees</h5>
                <div class="grid md:grid-cols-3 gap-x-5 mb-6">
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block text-neutral-900">Management Fee (%)</label>
                        <input type="number" step="0.1" name="management_fee" class="form-control rounded-lg" placeholder="0" value="{{ old('management_fee', 0) }}">
                    </div>

                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block text-neutral-900">Performance Fee (%)</label>
                        <input type="number" step="0.1" name="performance_fee" class="form-control rounded-lg" placeholder="0" value="{{ old('performance_fee', 0) }}">
                    </div>

                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block text-neutral-900">Min Traders Copying</label>
                        <input type="number" name="min_traders" class="form-control rounded-lg" placeholder="1" value="{{ old('min_traders', 1) }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-semibold mb-2 block text-neutral-900">Max Participations Per User</label>
                    <input type="number" name="max_participations" class="form-control rounded-lg" placeholder="3" value="{{ old('max_participations', 3) }}">
                    <p class="text-xs text-gray-500 mt-1">Maximum times a user can participate in this plan (set to 0 for unlimited)</p>
                </div>

                <!-- Dynamic Features Section -->
                <h5 class="text-lg font-semibold mb-4" style="color: #0C3A30;">Plan Features</h5>
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-3">
                        <label class="text-sm font-semibold text-neutral-900">Add Custom Features</label>
                        <button type="button" onclick="addFeatureField()" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700 transition">
                            <i class="ri-add-line mr-1"></i>Add Feature
                        </button>
                    </div>
                    
                    <div id="features-container" class="space-y-3">
                        @if(old('features'))
                            @foreach(old('features') as $index => $feature)
                            <div class="feature-item flex gap-2 items-center">
                                <input type="text" name="features[]" class="form-control rounded-lg flex-1" placeholder="e.g., 24/7 Customer Support" value="{{ $feature }}">
                                <button type="button" onclick="removeFeatureField(this)" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>
                            @endforeach
                        @else
                        <div class="feature-item flex gap-2 items-center">
                            <input type="text" name="features[]" class="form-control rounded-lg flex-1" placeholder="e.g., 24/7 Customer Support">
                            <button type="button" onclick="removeFeatureField(this)" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </div>
                        @endif
                    </div>
                    
                    <p class="text-xs text-gray-500 mt-2">
                        <i class="ri-information-line"></i> Add all the features this plan offers. Each feature will be displayed with a checkmark.
                    </p>
                </div>

                <!-- Popular Examples (Optional helper) -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm font-semibold mb-2">Popular Feature Examples:</p>
                    <div class="flex flex-wrap gap-2">
                        <span onclick="addExampleFeature('24/7 Customer Support')" class="cursor-pointer bg-white border border-gray-300 px-3 py-1 rounded-full text-xs hover:bg-green-50 hover:border-green-500 transition">24/7 Customer Support</span>
                        <span onclick="addExampleFeature('Copy Trading Access')" class="cursor-pointer bg-white border border-gray-300 px-3 py-1 rounded-full text-xs hover:bg-green-50 hover:border-green-500 transition">Copy Trading Access</span>
                        <span onclick="addExampleFeature('Professional Trading Signals')" class="cursor-pointer bg-white border border-gray-300 px-3 py-1 rounded-full text-xs hover:bg-green-50 hover:border-green-500 transition">Professional Trading Signals</span>
                        <span onclick="addExampleFeature('Risk Management Tools')" class="cursor-pointer bg-white border border-gray-300 px-3 py-1 rounded-full text-xs hover:bg-green-50 hover:border-green-500 transition">Risk Management Tools</span>
                        <span onclick="addExampleFeature('Daily Market Analysis')" class="cursor-pointer bg-white border border-gray-300 px-3 py-1 rounded-full text-xs hover:bg-green-50 hover:border-green-500 transition">Daily Market Analysis</span>
                        <span onclick="addExampleFeature('Priority Withdrawals')" class="cursor-pointer bg-white border border-gray-300 px-3 py-1 rounded-full text-xs hover:bg-green-50 hover:border-green-500 transition">Priority Withdrawals</span>
                        <span onclick="addExampleFeature('Dedicated Account Manager')" class="cursor-pointer bg-white border border-gray-300 px-3 py-1 rounded-full text-xs hover:bg-green-50 hover:border-green-500 transition">Dedicated Account Manager</span>
                        <span onclick="addExampleFeature('Advanced Trading Dashboard')" class="cursor-pointer bg-white border border-gray-300 px-3 py-1 rounded-full text-xs hover:bg-green-50 hover:border-green-500 transition">Advanced Trading Dashboard</span>
                    </div>
                </div>

                <!-- Status & Badge -->
                <div class="grid md:grid-cols-2 gap-x-5 mb-6">
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block text-neutral-900">Status</label>
                        <select name="status" class="form-control rounded-lg">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <span class="text-red">@error ('status') {{ $message }} @enderror</span>
                    </div>

                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block text-neutral-900">Popular Badge</label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="popular_badge" value="1" {{ old('popular_badge') ? 'checked' : '' }}>
                            <span>Show "Popular" badge on this plan</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-3 mt-8">
                    <button type="reset" class="border border-danger-600 hover:bg-danger-200 text-danger-600 text-base px-10 py-[11px] rounded-lg">
                        Reset
                    </button>
                    <button type="submit" class="btn btn-primary border border-primary-600 text-base px-6 py-3 rounded-lg">
                        Create Trading Plan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function addFeatureField() {
    const container = document.getElementById('features-container');
    const newField = document.createElement('div');
    newField.className = 'feature-item flex gap-2 items-center';
    newField.innerHTML = `
        <input type="text" name="features[]" class="form-control rounded-lg flex-1" placeholder="e.g., 24/7 Customer Support">
        <button type="button" onclick="removeFeatureField(this)" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition">
            <i class="ri-delete-bin-line"></i>
        </button>
    `;
    container.appendChild(newField);
}

function removeFeatureField(button) {
    const container = document.getElementById('features-container');
    if (container.children.length > 1) {
        button.closest('.feature-item').remove();
    } else {
        alert('You must have at least one feature');
    }
}

function addExampleFeature(feature) {
    const inputs = document.querySelectorAll('input[name="features[]"]');
    let added = false;
    
    for (let input of inputs) {
        if (!input.value.trim()) {
            input.value = feature;
            added = true;
            break;
        }
    }
    
    if (!added) {
        const container = document.getElementById('features-container');
        const newField = document.createElement('div');
        newField.className = 'feature-item flex gap-2 items-center';
        newField.innerHTML = `
            <input type="text" name="features[]" class="form-control rounded-lg flex-1" value="${feature}" placeholder="e.g., 24/7 Customer Support">
            <button type="button" onclick="removeFeatureField(this)" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition">
                <i class="ri-delete-bin-line"></i>
            </button>
        `;
        container.appendChild(newField);
    }
}
</script>

<style>
.feature-item {
    transition: all 0.3s ease;
}
.feature-item:hover {
    transform: translateX(5px);
}
</style>

@endsection