@extends('layout.app')
@section('content')

  <!-- Start Pricing Plan Area -->
        <!-- Start Pricing Plan Area -->
        <div class="pricing-plan-area py-5 py-md-6 mb-5" style="background: linear-gradient(145deg, #f8fafc, #f0f4f8); position: relative; overflow: hidden;">

            <!-- Decorative Elements -->
            <div class="position-absolute" style="top: -100px; right: -50px; width: 300px; height: 300px; border-radius: 50%; background: radial-gradient(circle, rgba(139,201,5,0.03) 0%, transparent 70%); pointer-events: none;"></div>
            <div class="position-absolute" style="bottom: -50px; left: -50px; width: 250px; height: 250px; border-radius: 50%; background: radial-gradient(circle, rgba(12,58,48,0.02) 0%, transparent 70%); pointer-events: none;"></div>

            <div class="container" style="max-width: 1280px; margin: 0 auto; position: relative; z-index: 2;">

                <!-- ========================================= -->
                <!-- SECTION HEADER - PREMIUM & CENTERED -->
                <!-- ========================================= -->
                <div class="text-center mb-5" data-cues="slideInUp" data-duration="800">
                    <div class="d-flex justify-content-center mb-3">
                        <span class="badge px-4 py-2 rounded-pill fw-semibold d-inline-flex align-items-center gap-2"
                            style="background: linear-gradient(145deg, #0C3A30, #0A2A23); color: white; border: 1px solid rgba(139,201,5,0.4); letter-spacing: 0.5px; box-shadow: 0 10px 20px -8px rgba(10,42,35,0.2);">
                            <span style="display: inline-block; width: 8px; height: 8px; background: #8BC905; border-radius: 50%; box-shadow: 0 0 8px #8BC905; animation: pulse 2s infinite;"></span>
                            PRICING PLANS
                        </span>
                    </div>

                    <h2 class="display-5 fw-bold mb-3 mx-auto" style="color: #0C3A30; max-width: 700px; line-height: 1.2;">
                        Choose The <span style="color: #8BC905; position: relative; display: inline-block;">
                            Best Plan
                            <span class="position-absolute start-0 w-100" style="bottom: 0.1em; height: 8px; background: rgba(139,201,5,0.25); border-radius: 30px; z-index: -1;"></span>
                        </span>
                        <br>That Fits You
                    </h2>

                    <p class="fs-5 text-secondary mx-auto px-3" style="color: #4A5C5A !important; max-width: 600px; line-height: 1.6;">
                        Select your perfect investment plan and start growing your wealth with our AI-powered strategies
                    </p>
                </div>

                <!-- ========================================= -->
                <!-- PRICING CARDS - 3 PERFECTLY BALANCED -->
                <!-- ========================================= -->
                <div class="row g-4 justify-content-center" data-cues="slideInUp" data-duration="800">
                    @php
                    $sortedPlans = $plans->sortBy('minimum_amount')->values();
                    $popularPlanId = $sortedPlans->count() > 1 ? $sortedPlans[1]->id : ($sortedPlans[0]->id ?? null);
                    @endphp

                    @foreach($plans->take(3) as $plan)
                    <div class="col-lg-4 col-md-6 d-flex">
                        <div class="card h-100 w-100 border-0 position-relative"
                            style="border-radius: 32px; background: white; box-shadow: 0 20px 35px -10px rgba(0,0,0,0.05); transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); overflow: hidden;">

                            <!-- Top Accent Bar -->
                            <div style="height: 6px; background: linear-gradient(90deg, #8BC905, #0C3A30, #8BC905); background-size: 200% 100%; animation: shimmer 3s infinite;"></div>

                            <!-- Popular Badge -->
                            @if($plan->id === $popularPlanId)
                            <span class="position-absolute px-4 py-2 fw-bold d-inline-flex align-items-center gap-2"
                                style="top: 6px; right: 6px; background: linear-gradient(135deg, #FF6B6B, #FF4757); color: white; border-radius: 30px; font-size: 0.8rem; letter-spacing: 0.5px; box-shadow: 0 8px 16px -4px rgba(255,71,87,0.3); z-index: 10;">
                                <span style="display: inline-block; width: 6px; height: 6px; background: white; border-radius: 50%; animation: pulse 2s infinite;"></span>
                                ⭐ MOST POPULAR
                            </span>
                            @endif

                            <!-- Premium Badge for Highest Plan -->
                            @if($loop->last && !$plan->id === $popularPlanId)
                            <span class="position-absolute px-4 py-2 fw-bold d-inline-flex align-items-center gap-2"
                                style="top: 20px; right: 20px; background: linear-gradient(145deg, #0C3A30, #0A2A23); color: white; border: 1px solid rgba(139,201,5,0.3); border-radius: 30px; font-size: 0.8rem; letter-spacing: 0.5px; box-shadow: 0 8px 16px -4px rgba(12,58,48,0.2); z-index: 10;">
                                <i class="fas fa-crown" style="color: #FFD700;"></i>
                                PREMIUM
                            </span>
                            @endif

                            <div class="p-4 p-xl-5 d-flex flex-col h-100">

                                <!-- Plan Icon & Name -->
                                <div class="text-center mb-4">
                                    <div class="d-flex justify-content-center mb-3">
                                        <div class="d-flex align-items-center justify-content-center rounded-4"
                                            style="width: 100px; height: 100px; background: linear-gradient(145deg, rgba(139,201,5,0.1), rgba(12,58,48,0.05)); border-radius: 24px !important;">
                                            <img src="{{ asset('assets/images/depositimage.jpg') }}" alt="Plan Icon"
                                                style="width: 70px; height: 70px; border-radius: 16px; object-fit: cover; box-shadow: 0 10px 20px -8px rgba(0,0,0,0.1);">
                                        </div>
                                    </div>
                                    <h3 class="fw-bold mb-1" style="color: #0C3A30; font-size: 1.75rem; letter-spacing: -0.5px;">
                                        {{ $plan->name }}
                                    </h3>

                                    <!-- Interest Rate Display -->
                                    <div class="d-flex align-items-baseline justify-content-center gap-1 mt-2">
                                        <span class="fw-black" style="color: #8BC905; font-size: 2.5rem; line-height: 1;">
                                            {{ rtrim(rtrim($plan->interest_rate, '0'), '.') }}%
                                        </span>
                                        <span class="text-secondary" style="font-size: 1rem;">/ Per Term</span>
                                    </div>

                                    <!-- Duration Chip -->
                                    <span class="badge px-4 py-2 rounded-pill mt-2"
                                        style="background: rgba(139,201,5,0.08); color: #0C3A30; border: 1px solid rgba(139,201,5,0.2); font-size: 0.9rem;">
                                        📅 {{ $plan->duration }} Days Duration
                                    </span>
                                </div>

                                <!-- Features List - Premium Check Icons -->
                                <div class="mt-3">
                                    <ul class="list-unstyled d-flex flex-column gap-3">
                                        <li class="d-flex align-items-start gap-3">
                                            <span class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                                style="width: 24px; height: 24px; background: rgba(139,201,5,0.15); color: #8BC905;">
                                                <i class="ri-check-line" style="font-size: 14px; font-weight: bold;"></i>
                                            </span>
                                            <span style="color: #0C3A30; font-size: 1rem;">
                                                <strong>Duration:</strong> {{ $plan->duration }} Days
                                            </span>
                                        </li>
                                        <li class="d-flex align-items-start gap-3">
                                            <span class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                                style="width: 24px; height: 24px; background: rgba(139,201,5,0.15); color: #8BC905;">
                                                <i class="ri-check-line" style="font-size: 14px; font-weight: bold;"></i>
                                            </span>
                                            <span style="color: #0C3A30; font-size: 1rem;">
                                                <strong>Return Rate:</strong> {{ rtrim(rtrim($plan->interest_rate, '0'), '.') }}%
                                            </span>
                                        </li>
                                        <li class="d-flex align-items-start gap-3">
                                            <span class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                                style="width: 24px; height: 24px; background: rgba(139,201,5,0.15); color: #8BC905;">
                                                <i class="ri-check-line" style="font-size: 14px; font-weight: bold;"></i>
                                            </span>
                                            <span style="color: #0C3A30; font-size: 1rem;">
                                                <strong>Earnings:</strong>
                                                <span class="badge ms-1 px-3 py-1 rounded-pill"
                                                    style="background: {{ $plan->duration < 28 ? 'rgba(139,201,5,0.15)' : 'rgba(12,58,48,0.1)' }}; color: #0C3A30; font-weight: 600;">
                                                    {{ $plan->duration < 28 ? '⚡ Daily' : '📆 Weekly' }}
                                                </span>
                                            </span>
                                        </li>
                                        <li class="d-flex align-items-start gap-3">
                                            <span class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                                style="width: 24px; height: 24px; background: rgba(139,201,5,0.15); color: #8BC905;">
                                                <i class="ri-check-line" style="font-size: 14px; font-weight: bold;"></i>
                                            </span>
                                            <span style="color: #0C3A30; font-size: 1rem;">
                                                <strong>Min Deposit:</strong>
                                                <span class="fw-bold" style="color: #0C3A30;">${{ number_format($plan->minimum_amount) }}</span>
                                            </span>
                                        </li>
                                        <li class="d-flex align-items-start gap-3">
                                            <span class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                                style="width: 24px; height: 24px; background: rgba(139,201,5,0.15); color: #8BC905;">
                                                <i class="ri-check-line" style="font-size: 14px; font-weight: bold;"></i>
                                            </span>
                                            <span style="color: #0C3A30; font-size: 1rem;">
                                                <strong>Max Deposit:</strong>
                                                <span class="fw-bold" style="color: #0C3A30;">${{ number_format($plan->maximum_amount) }}</span>
                                            </span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Potential Earnings Preview -->
                                <div class="mt-4 p-3 rounded-4" style="background: rgba(139,201,5,0.04); border: 1px dashed rgba(139,201,5,0.3);">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="small text-secondary">Potential return on $1,000</span>
                                        <span class="fw-bold" style="color: #8BC905;">
                                            +${{ number_format(1000 * ($plan->interest_rate / 100), 2) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- CTA Button - Spacer to push to bottom -->
                                <div class="mt-auto pt-4">
                                    <a href="/login" class="btn w-100 py-3 rounded-pill fw-bold d-flex align-items-center justify-content-between px-4"
                                        style="background: {{ $plan->id === $popularPlanId ? 'linear-gradient(145deg, #8BC905, #7AB805)' : 'linear-gradient(145deg, #0C3A30, #0A2A23)' }}; color: white; border: none; transition: all 0.3s;">
                                        <span>Get Started</span>
                                        <span class="rounded-circle bg-white/20 p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                            <i class="ri-arrow-right-up-line" style="color: white; font-size: 1.2rem;"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- ========================================= -->
                <!-- BOTTOM CTA - VIEW ALL PLANS -->
                <!-- ========================================= -->
                
                   
            </div>
        </div>

        <style>
            /* ============ PREMIUM ANIMATIONS ============ */

            @keyframes pulse {
                0% {
                    opacity: 1;
                    transform: scale(1);
                }

                50% {
                    opacity: 0.8;
                    transform: scale(0.95);
                    box-shadow: 0 0 12px #8BC905;
                }

                100% {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            @keyframes shimmer {
                0% {
                    background-position: 200% 0;
                }

                100% {
                    background-position: -200% 0;
                }
            }

            /* Card Hover Effects */
            .card {
                transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1),
                    box-shadow 0.4s ease;
            }

            .card:hover {
                transform: translateY(-12px);
                box-shadow: 0 30px 45px -15px rgba(12, 58, 48, 0.15) !important;
            }

            .card:hover .btn {
                transform: scale(1.02);
            }

            .card:hover .d-flex.justify-content-center div:first-child {
                transform: scale(1.05);
                transition: transform 0.4s ease;
            }

            /* Button Hover Effect */
            .btn:hover {
                transform: translateY(-2px);

                box-shadow: 0 15px 25px -8px {
                        {
                        $plan->id ===$popularPlanId ? 'rgba(139,201,5,0.4)': 'rgba(12,58,48,0.3)'
                    }
                }

                !important;
            }

            .btn:hover .bg-white\/20 {
                transform: translateX(4px);
                transition: transform 0.3s ease;
            }

            /* List Item Hover Effect */
            .list-unstyled li {
                transition: transform 0.2s ease;
            }

            .list-unstyled li:hover {
                transform: translateX(4px);
            }

            .list-unstyled li:hover .rounded-circle {
                background: rgba(139, 201, 5, 0.25) !important;
                transition: background 0.2s ease;
            }

            /* View All Plans Button Hover */
            .btn-outline-accent:hover {
                background: rgba(139, 201, 5, 0.05);
                border-color: #8BC905 !important;
                transform: translateY(-3px);
            }

            /* Badge Shine Effect */
            .position-absolute.px-4.py-2 {
                backdrop-filter: blur(4px);
            }

            /* Container width control */
            .container {
                padding-left: 20px;
                padding-right: 20px;
            }

            @media (min-width: 992px) {
                .container {
                    padding-left: 30px;
                    padding-right: 30px;
                }
            }

            /* Consistent card heights */
            .d-flex>.card {
                display: flex;
                flex-direction: column;
            }

            .card .p-4.p-xl-5 {
                flex: 1;
                display: flex;
                flex-direction: column;
            }

            /* Ensure no text overflow */
            h3,
            h4,
            p,
            span {
                overflow-wrap: break-word;
                word-wrap: break-word;
            }

            /* Custom gradient text for premium feel */
            .gradient-text {
                background: linear-gradient(145deg, #8BC905, #0C3A30);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            /* Smooth icon transitions */
            .ri-check-line,
            .ri-arrow-right-up-line,
            .ri-arrow-right-line {
                transition: transform 0.2s ease;
            }

            .btn:hover .ri-arrow-right-up-line,
            .btn:hover .ri-arrow-right-line {
                transform: translateX(4px) translateY(-2px);
            }
        </style>
        <!-- End Pricing Plan Area -->
@endsection