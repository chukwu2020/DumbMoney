{{-- resources/views/admin/plans/index.blade.php --}}
@extends('layout.admin')
@section('content')

<style>
    :root {
        --brand-green: #9EDD05;
        --brand-dark: #0C3A30;
    }
    .card, .card-body, .card-header { background: #ffffff !important; color: #111827 !important; }
    .table th { color: #111827 !important; }
    .table td { color: #374151 !important; }
</style>

<div class="dashboard-main-body">
    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold mb-0" style="color:var(--brand-dark);">Plan List</h6>
        <ul class="flex items-center gap-[6px]">
            <li class="font-medium">
                <a href="{{ route('admin_dashboard') }}" class="flex items-center gap-2 hover:text-[#9EDD05]" style="color:var(--brand-dark);">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="font-medium" style="color:var(--brand-green);">Plan List</li>
        </ul>
    </div>

    <div class="grid grid-cols-12">
        <div class="col-span-12">
            <div class="card h-full p-0 rounded-xl border-0 overflow-hidden">
                <div class="card-header border-b border-neutral-200 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
                    <div class="flex items-center flex-wrap gap-3">
                        <span class="text-sm font-medium text-gray-600">Show</span>
                        <select class="form-select form-select-sm w-auto border-neutral-200 rounded-lg text-gray-700">
                            <option>10</option><option>25</option><option>50</option>
                        </select>
                        <form class="navbar-search">
                            <input type="text" class="bg-white h-10 w-auto text-gray-800" name="search" placeholder="Search">
                            <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                        </form>
                        <select class="form-select form-select-sm w-auto border-neutral-200 rounded-lg text-gray-700">
                            <option>Status</option>
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>
                    </div>
                    <a href="{{ route('create_plan') }}" class="btn btn-primary text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2">
                        <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                        Add New Plan
                    </a>
                </div>

                <div class="card-body p-6">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table sm-table mb-0">
                            <thead>
                                <tr style="background:#0C3A30 !important;">
                                    <th scope="col" style="background:#0C3A30 !important; color:#fff !important;">Name</th>
                                    <th scope="col" style="background:#0C3A30 !important; color:#fff !important;">Min Deposit</th>
                                    <th scope="col" style="background:#0C3A30 !important; color:#fff !important;">Max Deposit</th>
                                    <th scope="col" style="background:#0C3A30 !important; color:#fff !important;">Duration</th>
                                    <th scope="col" style="background:#0C3A30 !important; color:#fff !important;">Interest Rate</th>
                                    <th scope="col" style="background:#0C3A30 !important; color:#fff !important;">Trading Style</th>
                                    <th scope="col" style="background:#0C3A30 !important; color:#fff !important;">Risk Level</th>
                                    <th scope="col" class="text-center" style="background:#0C3A30 !important; color:#fff !important;">Status</th>
                                    <th scope="col" class="text-center" style="background:#0C3A30 !important; color:#fff !important;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($plans as $plan)
                                <tr class="hover:bg-gray-50">
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <span class="font-medium text-gray-800">{{ ucfirst($plan->name) }}</span>
                                            @if($plan->popular_badge)
                                                <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-0.5 rounded-full font-semibold">Popular</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-gray-700">${{ number_format($plan->minimum_amount) }}</td>
                                    <td class="text-gray-700">${{ number_format($plan->maximum_amount) }}</td>
                                    <td class="text-gray-700">
                                        {{ $plan->duration }}
                                        {{ $plan->duration_unit == 'minutes' ? 'min' : ($plan->duration_unit == 'hours' ? 'hrs' : 'days') }}
                                    </td>
                                    <td class="text-gray-700 font-medium">{{ $plan->interest_rate }}%</td>
                                    <td class="text-gray-700">{{ $plan->trading_style ?? 'N/A' }}</td>
                                    <td>
                                        @if($plan->risk_level)
                                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                                @if($plan->risk_level == 'Low') bg-green-100 text-green-800
                                                @elseif($plan->risk_level == 'Medium') bg-yellow-100 text-yellow-800
                                                @elseif($plan->risk_level == 'High') bg-red-100 text-red-800
                                                @endif">
                                                {{ $plan->risk_level }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">N/A</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($plan->status == 'active')
                                            <span class="bg-green-100 text-green-700 border border-green-300 px-4 py-1 rounded text-xs font-semibold">Active</span>
                                        @else
                                            <span class="bg-red-100 text-red-700 border border-red-300 px-4 py-1 rounded text-xs font-semibold">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="flex items-center gap-2 justify-center">
                                            <button type="button" class="bg-blue-100 hover:bg-blue-200 text-blue-600 font-medium w-9 h-9 flex justify-center items-center rounded-full transition">
                                                <iconify-icon icon="majesticons:eye-line" class="text-lg"></iconify-icon>
                                            </button>
                                            <a href="{{ route('plan.edit', $plan->id) }}"
                                               class="bg-green-100 hover:bg-green-200 text-green-700 font-medium w-9 h-9 flex justify-center items-center rounded-full transition">
                                                <iconify-icon icon="lucide:edit"></iconify-icon>
                                            </a>
                                            <a href="{{ route('plan.delete', $plan->id) }}"
                                               onclick="return confirm('Delete this plan?')"
                                               class="bg-red-100 hover:bg-red-200 text-red-600 font-medium w-9 h-9 flex justify-center items-center rounded-full transition">
                                                <iconify-icon icon="fluent:delete-24-regular"></iconify-icon>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex items-center justify-between flex-wrap gap-2 mt-6">
                        <span class="text-sm text-gray-600">Showing {{ count($plans) }} entries</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection