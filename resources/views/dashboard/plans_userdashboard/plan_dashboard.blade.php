@extends('layout.user')

@section('content')
<style>
    .custom-btn {
        background-color: #9EDD05;
        color: #0C3A30;
        padding: 0.75rem 1.5rem;
        font-weight: bold; 
        text-align: center;
        border-radius: 9999px;
        transition: all 0.3s ease;
        display: inline-block;
        width: 100%;
    }

    .custom-btn:hover {
        background-color: #89C604;
        box-shadow: 0 4px 6px rgba(0,0,0,0.2);
    }

    .custom-badge {
        position: absolute;
        top: 0.10rem;
        right: 0.10rem;
        background: linear-gradient(135deg, #ff6b6b, #ff4757);
        color: white;
        padding: 6px 10px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.5px;
        border-radius: 16px 0 16px 0;
        box-shadow: 0 4px 12px rgba(255,71,87,0.4);
        z-index: 5;
        text-transform: uppercase;
    }

    .check-icon {
        background-color: #9EDD05;
        color: #0C3A30;
        border-radius: 9999px;
        padding: 6px;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .plan-heading {
        color: #0C3A30;
    }
</style>

<div class="bg-white py-20 min-h-screen">
    <div class="container mx-auto px-4 py-10">
        <!-- Section Header -->
        <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
            <h5 class="font-semibold mb-0" style="color: #0C3A30; padding-right:0.8rem;">Plans</h5>
            <ul class="flex items-center gap-[6px]">
                <li class="font-medium">
                    <a href="{{ route('user_dashboard') }}" class="flex items-center gap-2 hover:text-primary-600" 
                       onmouseover="this.style.color='#9EDD05';" onmouseout="this.style.color='#0C3A30';">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Dashboard
                    </a>
                </li>
                <li>-</li>
                <li class="font-medium">Plans</li>
            </ul>
        </div>

        <div class="text-center mb-16">
            <h4 class="text-3xl md:text-5xl font-extrabold mt-3 mb-3 leading-tight plan-heading">
                PRICING PLANS
            </h4>
        </div>

        <!-- Plan Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

            @php
                // Find the second minimum amount plan for "Popular" badge
                $sortedPlans = $plans->sortBy('minimum_amount')->values();
                $popularPlanId = $sortedPlans->count() > 1 ? $sortedPlans[1]->id : $sortedPlans[0]->id;
            @endphp

            @foreach($plans as $plan)
            <div class="bg-white border border-gray-200 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 p-6 flex flex-col justify-between relative group" 
                 style="background-image: url(assets/images/hero/hero-image-1.svg);">

                <!-- Popular Badge -->
                @if($plan->id === $popularPlanId)
                <span class="custom-badge">
                    ⭐ Popular
                </span>
                @endif

                <!-- Icon -->
                <div class="flex justify-center mb-5">
                    <img src="{{ asset('assets/images/depositimage.jpg') }}" alt="Plan Icon" style="width: 104px; height: 84px; border-radius: 6px;">
                </div>

                <!-- Plan Name & Interest -->
                <div class="text-center mb-6">
                    <h3 class="text-2xl font-semibold capitalize plan-heading">
                        {{ $plan->name }}
                    </h3>
                    <p class="text-lg mt-1 text-gray-700">
                        <span class="font-bold">{{ rtrim(rtrim($plan->interest_rate, '0'), '.') }}%</span>
                        <span class="text-sm font-normal">/ Per Term</span>
                    </p>
                </div>

                <!-- Features List -->
                <div class="flex justify-center">
                    <ul class="space-y-4 text-sm text-gray-700 text-left">
                        <li class="flex items-start gap-3">
                            <span class="check-icon"><i class="ri-check-line"></i></span>
                            <span><strong>Duration:</strong> {{ $plan->duration }} Days</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="check-icon"><i class="ri-check-line"></i></span>
                            <span><strong>Percentage:</strong> {{ rtrim(rtrim($plan->interest_rate, '0'), '.') }}%</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="check-icon"><i class="ri-check-line"></i></span>
                            <span><strong>Earnings:</strong> {{ $plan->duration < 28 ? 'Daily' : 'Weekly' }}</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="check-icon"><i class="ri-check-line"></i></span>
                            <span><strong>Min Deposit:</strong> ${{ number_format($plan->minimum_amount) }}</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="check-icon"><i class="ri-check-line"></i></span>
                            <span><strong>Max Deposit:</strong> ${{ number_format($plan->maximum_amount) }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Get Started Button -->
                <a href="{{ route('user.deposit') }}" class="custom-btn mt-8">
                    Get Started <i class="ri-arrow-right-up-line ml-1"></i>
                </a>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
