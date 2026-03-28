{{-- resources/views/admin/plans/edit.blade.php --}}
@extends('layout.admin')
@section('content')

<style>
    :root {
        --brand-green: #9EDD05;
        --brand-dark: #0C3A30;
    }
    .form-section-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--brand-dark);
        margin-bottom: 1rem;
    }
    .features-box {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.25rem;
    }
    .features-box .feature-examples-bar {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 1rem;
    }
    .example-chip {
        display: inline-block;
        cursor: pointer;
        background: #ffffff;
        border: 1px solid #d1d5db;
        padding: .25rem .75rem;
        border-radius: 20px;
        font-size: .72rem;
        color: #374151;
        font-weight: 500;
        transition: background .15s, border-color .15s;
    }
    .example-chip:hover { background: #f0fdf4; border-color: var(--brand-green); color: var(--brand-dark); }
    .card, .card-body { background: #ffffff !important; color: #111827 !important; }
    .form-control, .form-select { color: #111827 !important; background: #ffffff !important; }
    .feature-item { transition: all 0.3s ease; }
    .feature-item:hover { transform: translateX(5px); }
</style>

<div class="dashboard-main-body">
    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold mb-0" style="color:var(--brand-dark);">Edit Trading Plan</h6>
        <ul class="flex items-center gap-[6px]">
            <li class="font-medium">
                <a href="{{ route('admin_dashboard') }}" class="flex items-center gap-2 hover:text-[#9EDD05]" style="color:var(--brand-dark);">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="font-medium" style="color:var(--brand-green);">Edit Plan</li>
        </ul>
    </div>

    <div class="card h-full rounded-xl overflow-hidden border-0">
        <div class="card-body p-10">
            <form action="{{ route('plan.update', $data->id) }}" method="POST" id="planForm">
                @csrf

                <!-- Basic Information -->
                <h5 class="form-section-title">Basic Information</h5>
                <div class="grid md:grid-cols-3 gap-x-5 mb-6">
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block" style="color:#111827;">Plan Name</label>
                        <input type="text" class="form-control rounded-lg" name="name" value="{{ old('name', $data->name) }}">
                        <span class="text-red-500 text-xs">@error('name') {{ $message }} @enderror</span>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block" style="color:#111827;">Duration</label>
                        <input type="number" class="form-control rounded-lg" name="duration" value="{{ old('duration', $data->duration) }}">
                        <span class="text-red-500 text-xs">@error('duration') {{ $message }} @enderror</span>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block" style="color:#111827;">Duration Unit</label>
                        <select name="duration_unit" class="form-control rounded-lg">
                            <option value="minutes" {{ old('duration_unit', $data->duration_unit ?? 'days') == 'minutes' ? 'selected' : '' }}>Minutes</option>
                            <option value="hours"   {{ old('duration_unit', $data->duration_unit ?? 'days') == 'hours'   ? 'selected' : '' }}>Hours</option>
                            <option value="days"    {{ old('duration_unit', $data->duration_unit ?? 'days') == 'days'    ? 'selected' : '' }}>Days</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Select the unit for the duration</p>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-semibold mb-2 block" style="color:#111827;">Minimum Duration (if flexible)</label>
                    <input type="text" class="form-control rounded-lg" name="min_duration" placeholder="e.g., 7-30 days" value="{{ old('min_duration', $data->min_duration) }}">
                </div>

                <!-- Investment Range -->
                <h5 class="form-section-title">Investment Range</h5>
                <div class="grid md:grid-cols-2 gap-x-5 mb-6">
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block" style="color:#111827;">Minimum Amount ($)</label>
                        <input type="number" name="minimum_amount" class="form-control rounded-lg" value="{{ old('minimum_amount', $data->minimum_amount) }}">
                        <span class="text-red-500 text-xs">@error('minimum_amount') {{ $message }} @enderror</span>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block" style="color:#111827;">Maximum Amount ($)</label>
                        <input type="number" name="maximum_amount" class="form-control rounded-lg" value="{{ old('maximum_amount', $data->maximum_amount) }}">
                        <span class="text-red-500 text-xs">@error('maximum_amount') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-semibold mb-2 block" style="color:#111827;">Max Participations Per User</label>
                    <input type="number" name="max_participations" class="form-control rounded-lg" value="{{ old('max_participations', $data->max_participations ?? 3) }}">
                    <p class="text-xs text-gray-500 mt-1">Set to 0 for unlimited</p>
                </div>

                <!-- Trading Details -->
                <h5 class="form-section-title">Trading Details</h5>
                <div class="grid md:grid-cols-3 gap-x-5 mb-6">
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block" style="color:#111827;">Interest Rate (%)</label>
                        <input type="number" step="0.01" name="interest_rate" class="form-control rounded-lg" value="{{ old('interest_rate', $data->interest_rate) }}">
                        <span class="text-red-500 text-xs">@error('interest_rate') {{ $message }} @enderror</span>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block" style="color:#111827;">Expected ROI Range</label>
                        <input type="text" name="expected_roi_range" class="form-control rounded-lg" value="{{ old('expected_roi_range', $data->expected_roi_range) }}">
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block" style="color:#111827;">Profit Frequency</label>
                        <select name="profit_frequency" class="form-control rounded-lg">
                            <option value="daily"   {{ old('profit_frequency', $data->profit_frequency) == 'daily'   ? 'selected' : '' }}>Daily</option>
                            <option value="weekly"  {{ old('profit_frequency', $data->profit_frequency) == 'weekly'  ? 'selected' : '' }}>Weekly</option>
                            <option value="monthly" {{ old('profit_frequency', $data->profit_frequency) == 'monthly' ? 'selected' : '' }}>Monthly</option>
                        </select>
                    </div>
                </div>

                <!-- Trading Style & Risk -->
                <div class="grid md:grid-cols-3 gap-x-5 mb-6">
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block" style="color:#111827;">Trading Style</label>
                        <select name="trading_style" class="form-control rounded-lg">
                            <option value="">Select Style</option>
                            <option value="Scalping"         {{ old('trading_style', $data->trading_style) == 'Scalping'         ? 'selected' : '' }}>Scalping</option>
                            <option value="Day Trading"      {{ old('trading_style', $data->trading_style) == 'Day Trading'      ? 'selected' : '' }}>Day Trading</option>
                            <option value="Swing Trading"    {{ old('trading_style', $data->trading_style) == 'Swing Trading'    ? 'selected' : '' }}>Swing Trading</option>
                            <option value="Position Trading" {{ old('trading_style', $data->trading_style) == 'Position Trading' ? 'selected' : '' }}>Position Trading</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block" style="color:#111827;">Risk Level</label>
                        <select name="risk_level" class="form-control rounded-lg">
                            <option value="">Select Risk</option>
                            <option value="Low"    {{ old('risk_level', $data->risk_level) == 'Low'    ? 'selected' : '' }}>Low (Conservative)</option>
                            <option value="Medium" {{ old('risk_level', $data->risk_level) == 'Medium' ? 'selected' : '' }}>Medium (Balanced)</option>
                            <option value="High"   {{ old('risk_level', $data->risk_level) == 'High'   ? 'selected' : '' }}>High (Aggressive)</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block" style="color:#111827;">Recommended For</label>
                        <select name="recommended_for" class="form-control rounded-lg">
                            <option value="">Select Level</option>
                            <option value="Beginners"    {{ old('recommended_for', $data->recommended_for) == 'Beginners'    ? 'selected' : '' }}>Beginners</option>
                            <option value="Intermediate" {{ old('recommended_for', $data->recommended_for) == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="Expert"       {{ old('recommended_for', $data->recommended_for) == 'Expert'       ? 'selected' : '' }}>Expert</option>
                        </select>
                    </div>
                </div>

                <!-- Strategy & Assets -->
                <div class="grid md:grid-cols-2 gap-x-5 mb-6">
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block" style="color:#111827;">Trading Strategy</label>
                        <textarea name="strategy" class="form-control rounded-lg" rows="3">{{ old('strategy', $data->strategy) }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block" style="color:#111827;">Assets Traded</label>
                        @php
                            $assets = is_array($data->assets_traded) ? $data->assets_traded : (json_decode($data->assets_traded, true) ?? []);
                        @endphp
                        <div class="space-y-2 border border-gray-200 rounded-lg p-3 bg-white">
                            @foreach(['Forex' => 'Forex (EUR/USD, GBP/USD, etc.)', 'Crypto' => 'Crypto (BTC, ETH, SOL, etc.)', 'Stocks' => 'Stocks (Apple, Tesla, etc.)', 'Commodities' => 'Commodities (Gold, Oil, etc.)', 'Indices' => 'Indices (S&P 500, NASDAQ, etc.)'] as $val => $label)
                            <label class="flex items-center gap-2 text-gray-800">
                                <input type="checkbox" name="assets_traded[]" value="{{ $val }}"
                                    {{ in_array($val, $assets) ? 'checked' : '' }}
                                    class="accent-[#9EDD05]">
                                <span class="text-sm">{{ $label }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Fees -->
                <h5 class="form-section-title">Fees</h5>
                <div class="grid md:grid-cols-3 gap-x-5 mb-6">
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block" style="color:#111827;">Management Fee (%)</label>
                        <input type="number" step="0.1" name="management_fee" class="form-control rounded-lg" value="{{ old('management_fee', $data->management_fee ?? 0) }}">
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block" style="color:#111827;">Performance Fee (%)</label>
                        <input type="number" step="0.1" name="performance_fee" class="form-control rounded-lg" value="{{ old('performance_fee', $data->performance_fee ?? 0) }}">
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block" style="color:#111827;">Min Traders Copying</label>
                        <input type="number" name="min_traders" class="form-control rounded-lg" value="{{ old('min_traders', $data->min_traders ?? 1) }}">
                    </div>
                </div>

                {{-- ══ ADVANCED CUSTOM FEATURES — white bg, black text ══ --}}
                <h5 class="form-section-title">Plan Features</h5>
                <div class="features-box mb-6">

                    <div class="flex justify-between items-center mb-4">
                        <label class="text-sm font-semibold" style="color:#111827;">Advanced Custom Features</label>
                        <button type="button" onclick="addFeatureField()"
                            class="flex items-center gap-1 text-sm font-semibold px-4 py-2 rounded-lg transition"
                            style="background:var(--brand-green); color:var(--brand-dark);">
                            <i class="ri-add-line"></i> Add Feature
                        </button>
                    </div>

                    <div id="features-container" class="space-y-3 mb-4">
                        @php
                            $features = is_array($data->features) ? $data->features : (json_decode($data->features, true) ?? []);
                        @endphp
                        @if(count($features) > 0)
                            @foreach($features as $feature)
                            <div class="feature-item flex gap-2 items-center">
                                <input type="text" name="features[]" class="form-control rounded-lg flex-1" value="{{ $feature }}" placeholder="e.g., 24/7 Customer Support">
                                <button type="button" onclick="removeFeatureField(this)" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition flex-shrink-0">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>
                            @endforeach
                        @else
                        <div class="feature-item flex gap-2 items-center">
                            <input type="text" name="features[]" class="form-control rounded-lg flex-1" placeholder="e.g., 24/7 Customer Support">
                            <button type="button" onclick="removeFeatureField(this)" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition flex-shrink-0">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </div>
                        @endif
                    </div>

                    {{-- Quick-add chips --}}
                    <div class="feature-examples-bar">
                        <p class="text-sm font-semibold mb-3" style="color:#111827;">Quick Add Popular Features:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(['24/7 Customer Support','Copy Trading Access','Professional Trading Signals','Risk Management Tools','Daily Market Analysis','Priority Withdrawals','Dedicated Account Manager','Advanced Trading Dashboard'] as $ex)
                            <span onclick="addExampleFeature('{{ $ex }}')" class="example-chip">{{ $ex }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Status & Badge -->
                <div class="grid md:grid-cols-2 gap-x-5 mb-6">
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block" style="color:#111827;">Status</label>
                        <select name="status" class="form-control rounded-lg">
                            <option value="active"   {{ old('status', $data->status) == 'active'   ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $data->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <span class="text-red-500 text-xs">@error('status') {{ $message }} @enderror</span>
                    </div>
                    <div class="mb-4">
                        <label class="text-sm font-semibold mb-2 block" style="color:#111827;">Popular Badge</label>
                        <label class="flex items-center gap-2 text-gray-800">
                            <input type="checkbox" name="popular_badge" value="1" {{ old('popular_badge', $data->popular_badge) ? 'checked' : '' }} class="accent-[#9EDD05]">
                            <span class="text-sm">Show "Popular" badge on this plan</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-3 mt-8">
                    <button type="reset" class="border border-red-400 hover:bg-red-50 text-red-500 text-base px-10 py-[11px] rounded-lg font-medium transition">
                        Reset
                    </button>
                    <button type="submit" class="btn btn-primary border border-primary-600 text-base px-6 py-3 rounded-lg">
                        Update Trading Plan
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
        <button type="button" onclick="removeFeatureField(this)" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition flex-shrink-0">
            <i class="ri-delete-bin-line"></i>
        </button>`;
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
    for (let input of inputs) {
        if (!input.value.trim()) { input.value = feature; return; }
    }
    const container = document.getElementById('features-container');
    const newField = document.createElement('div');
    newField.className = 'feature-item flex gap-2 items-center';
    newField.innerHTML = `
        <input type="text" name="features[]" class="form-control rounded-lg flex-1" value="${feature}">
        <button type="button" onclick="removeFeatureField(this)" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition flex-shrink-0">
            <i class="ri-delete-bin-line"></i>
        </button>`;
    container.appendChild(newField);
}
</script>

@endsection