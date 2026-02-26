@extends('layout.app')

@section('content')

<style>
    /* Premium Service Details Styles */
    .service-details-page {
        background: linear-gradient(145deg, #ffffff, #f9fbf9);
        position: relative;
        overflow: hidden;
    }
    
    /* Decorative Elements */
    .service-details-page::before {
        content: '';
        position: absolute;
        top: -150px;
        right: -100px;
        width: 600px;
        height: 600px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(139,201,5,0.03) 0%, transparent 70%);
        pointer-events: none;
    }
    
    .service-details-page::after {
        content: '';
        position: absolute;
        bottom: -150px;
        left: -80px;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(12,58,48,0.02) 0%, transparent 70%);
        pointer-events: none;
    }
    
    /* Pattern Overlay */
    .pattern-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: radial-gradient(circle at 30px 30px, rgba(139,201,5,0.02) 2px, transparent 2px);
        background-size: 60px 60px;
        pointer-events: none;
        opacity: 0.5;
    }
    
    /* Animations */
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
    
    @keyframes pulse {
        0% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(0.95); box-shadow: 0 0 20px #8BC905; }
        100% { opacity: 1; transform: scale(1); }
    }
    
    .float-animation {
        animation: float 6s ease-in-out infinite;
    }
    
    .pulse-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        background: #8BC905;
        border-radius: 50%;
        box-shadow: 0 0 15px #8BC905;
        animation: pulse 2s infinite;
    }
    
    /* Premium Badge */
    .premium-badge {
        background: linear-gradient(145deg, #0C3A30, #0A2A23);
        color: white;
        border: 1px solid rgba(139,201,5,0.4);
        box-shadow: 0 10px 20px -8px rgba(10,42,35,0.2);
    }
    
    /* Highlight Underline */
    .highlight-underline {
        position: relative;
        display: inline-block;
        color: #8BC905;
    }
    
    .highlight-underline::after {
        content: '';
        position: absolute;
        bottom: 0.1em;
        left: 0;
        width: 100%;
        height: 8px;
        background: rgba(139,201,5,0.25);
        border-radius: 30px;
        z-index: -1;
    }
    
    /* Main Image */
    .service-main-image {
        border-radius: 32px;
        overflow: hidden;
        box-shadow: 0 30px 50px -20px rgba(12,58,48,0.2);
        border: 1px solid rgba(139,201,5,0.1);
        transition: all 0.5s ease;
        margin-bottom: 2rem;
    }
    
    .service-main-image img {
        width: 100%;
        height: auto;
        transition: transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    .service-main-image:hover img {
        transform: scale(1.02);
    }
    
    .service-main-image:hover {
        box-shadow: 0 40px 60px -20px rgba(139,201,5,0.2);
        border-color: rgba(139,201,5,0.3);
    }
    
    /* Quote Card */
    .quote-card {
        background: linear-gradient(145deg, #0C3A30, #062018);
        border-radius: 24px;
        padding: 2.5rem;
        margin: 2rem 0;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(139,201,5,0.2);
    }
    
    .quote-card::before {
        content: '"';
        position: absolute;
        top: -20px;
        left: 20px;
        font-size: 150px;
        color: rgba(139,201,5,0.1);
        font-family: serif;
        line-height: 1;
    }
    
    .quote-card p {
        position: relative;
        z-index: 2;
        font-size: 1.2rem;
        line-height: 1.7;
        font-style: italic;
    }
    
    /* Check List */
    .check-list {
        list-style: none;
        padding: 0;
        margin: 2rem 0;
    }
    
    .check-list li {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        margin-bottom: 0.75rem;
        background: white;
        border-radius: 16px;
        border: 1px solid rgba(139,201,5,0.1);
        transition: all 0.3s ease;
    }
    
    .check-list li:hover {
        transform: translateX(10px);
        border-color: rgba(139,201,5,0.3);
        box-shadow: 0 10px 20px -8px rgba(139,201,5,0.1);
    }
    
    .check-list i {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background: rgba(139,201,5,0.15);
        color: #8BC905;
        border-radius: 50%;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    
    .check-list li:hover i {
        background: rgba(139,201,5,0.25);
        transform: scale(1.1);
    }
    
    /* Feature Grid Images */
    .feature-grid-image {
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid rgba(139,201,5,0.1);
        transition: all 0.4s ease;
        height: 100%;
    }
    
    .feature-grid-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .feature-grid-image:hover {
        transform: translateY(-8px);
        border-color: rgba(139,201,5,0.3);
        box-shadow: 0 20px 30px -12px rgba(139,201,5,0.15);
    }
    
    .feature-grid-image:hover img {
        transform: scale(1.05);
    }
    
    /* Stats Card */
    .stats-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        border: 1px solid rgba(139,201,5,0.1);
        box-shadow: 0 15px 30px -10px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
        border-color: rgba(139,201,5,0.3);
        box-shadow: 0 20px 35px -12px rgba(139,201,5,0.1);
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: #8BC905;
        line-height: 1;
        margin-bottom: 0.25rem;
    }
    
    .stat-label {
        color: #4A5C5A;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    /* CTA Button */
    .btn-premium {
        background: linear-gradient(145deg, #8BC905, #7AB805);
        color: #0C3A30;
        border: none;
        padding: 1rem 2.5rem;
        border-radius: 50px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 20px 30px -10px rgba(139,201,5,0.3);
    }
    
    .btn-premium:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 40px -12px rgba(139,201,5,0.4);
        color: #0C3A30;
    }
    
    /* Trust Badge */
    .trust-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1.25rem;
        background: rgba(139,201,5,0.08);
        border: 1px solid rgba(139,201,5,0.15);
        border-radius: 50px;
        color: #0C3A30;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    
    .trust-badge:hover {
        background: rgba(139,201,5,0.15);
        border-color: rgba(139,201,5,0.3);
        transform: translateY(-2px);
    }
    
    /* Responsive */
    @media (max-width: 991px) {
        .service-main-image {
            margin-top: 2rem;
        }
        
        .check-list li {
            padding: 0.75rem;
        }
    }
    
    @media (max-width: 767px) {
        .quote-card {
            padding: 1.5rem;
        }
        
        .quote-card p {
            font-size: 1rem;
        }
        
        .stat-number {
            font-size: 1.5rem;
        }
    }
</style>

<!-- Start Service Details Page - Premium Redesign -->
<div class="service-details-page ptb-120 position-relative overflow-hidden">
    
    <!-- Pattern Overlay -->
    <div class="pattern-overlay"></div>
    
    <div class="container position-relative" style="z-index: 10;">
        <div class="row">
            <div class="col-lg-12">
                <div class="service-details-content">
                    
                    <!-- Premium Breadcrumb -->
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <span class="premium-badge badge px-4 py-2 rounded-pill fw-semibold d-inline-flex align-items-center gap-2">
                            <span class="pulse-dot"></span>
                            COPY TRADING SERVICES
                        </span>
                        <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2);">
                            ✦ GLOBAL PAYMENTS
                        </span>
                    </div>
                    
                    <!-- Main Image with Overlay -->
                    <div class="service-main-image position-relative">
                        <img class="radius-30 w-100" src="assets/images/service/service-image-9.jpg" alt="Global Copy Trading Platform">
                        
                        <!-- Floating Badge - Live Stats -->
                        <div class="position-absolute top-0 start-0 m-4 float-animation" style="z-index: 5;">
                            <div class="d-flex align-items-center gap-2 bg-white/95 backdrop-blur rounded-pill py-2 px-4 shadow-lg">
                                <span class="pulse-dot"></span>
                                <span class="fw-semibold small" style="color: #0C3A30;">LIVE COPY TRADING</span>
                            </div>
                        </div>
                        
                        <!-- Floating Badge - Global -->
                        <div class="position-absolute bottom-0 end-0 m-4 float-animation" style="animation-delay: 1s; z-index: 5;">
                            <div class="d-flex align-items-center gap-2 bg-white/95 backdrop-blur rounded-pill py-2 px-4 shadow-lg"
                                 style="border-left: 4px solid #8BC905;">
                                <i class="ri-global-line" style="color: #8BC905;"></i>
                                <span class="fw-semibold small" style="color: #0C3A30;">150+ COUNTRIES</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Title Section -->
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                        <div>
                            <h1 class="display-5 fw-bold" style="color: #0C3A30;">
                                Global <span class="highlight-underline">Copy Trading</span> Payments
                            </h1>
                            <div class="d-flex align-items-center gap-3 mt-2">
                                <div class="d-flex align-items-center gap-1">
                                    <i class="ri-star-fill" style="color: #FFB800;"></i>
                                    <i class="ri-star-fill" style="color: #FFB800;"></i>
                                    <i class="ri-star-fill" style="color: #FFB800;"></i>
                                    <i class="ri-star-fill" style="color: #FFB800;"></i>
                                    <i class="ri-star-fill" style="color: #FFB800;"></i>
                                    <span class="ms-2 small fw-semibold" style="color: #0C3A30;">4.9/5 from 2,500+ traders</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Quick Stats -->
                        <div class="d-flex align-items-center gap-3">
                            <div class="stats-card p-3 text-center">
                                <div class="stat-number">0.01s</div>
                                <div class="stat-label">Execution</div>
                            </div>
                            <div class="stats-card p-3 text-center">
                                <div class="stat-number">100K+</div>
                                <div class="stat-label">Active Traders</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Description with Copy Trading Focus -->
                    <p class="fs-5 text-secondary mb-4" style="color: #4A5C5A !important; line-height: 1.7;">
                        <span class="fw-bold" style="color: #8BC905;">Mirror top-performing traders in real-time</span> while our global payment infrastructure ensures instant deposits and withdrawals across 150+ countries. Our mission is to bridge the gap between traditional banking and modern copy trading technology, offering innovative and seamless financial services that cater to the evolving needs of traders worldwide.
                    </p>
                    
                    <p class="text-secondary mb-4" style="color: #4A5C5A !important; line-height: 1.7;">
                        We are redefining the copy trading industry with our innovative MarketMind solutions. By integrating advanced Automated with financial expertise, we provide a comprehensive suite of services that allow you to automatically replicate successful traders' strategies while our global payment network handles your funds instantly and securely.
                    </p>
                    
                    <!-- Premium Quote Card -->
                    <div class="quote-card">
                        <p class="text-white mb-0">
                            "Our mission is to bridge the gap between traditional banking and modern copy trading technology, offering innovative and seamless financial services that cater to the evolving needs of traders worldwide. From instant copy trade execution to global payment processing, we empower our community to trade with confidence."
                        </p>
                        <div class="d-flex align-items-center gap-3 mt-4">
                            <span class="trust-badge" style="background: rgba(255,255,255,0.1); color: white; border-color: rgba(139,201,5,0.3);">
                                <i class="ri-check-line" style="color: #8BC905;"></i> 50K+ Traders
                            </span>
                            <span class="trust-badge" style="background: rgba(255,255,255,0.1); color: white; border-color: rgba(139,201,5,0.3);">
                                <i class="ri-check-line" style="color: #8BC905;"></i> $2.2B+ Copied
                            </span>
                        </div>
                    </div>
                    
                    <p class="text-secondary mb-5" style="color: #4A5C5A !important; line-height: 1.7;">
                        With a robust suite of products ranging from real-time copy trading and Automated-powered strategy selection to global payment processing and blockchain settlement, we empower our clients to navigate the complexities of the financial markets with ease and confidence.
                    </p>
                    
                  <!-- Section Title -->
<h2 class="fw-bold mb-4" style="color: #0C3A30; font-size: 2rem;">
    Your <span class="highlight-underline">Learning Journey</span> From Copying to Trading Independently
</h2>

<!-- Premium Learning Path Description -->
<div class="p-4 mb-4 rounded-4" style="background: rgba(139,201,5,0.04); border-left: 4px solid #8BC905;">
    <p class="fs-5 mb-0" style="color: #0C3A30; line-height: 1.6;">
        Start by copying experienced traders — observe how they manage risk, time their entries and exits, and position size. As you follow their moves, you begin to understand the rhythm of the markets. Soon, you'll find yourself confident enough to place your own trades.
    </p>
</div>

<!-- Premium Check List - Learning Focused -->
<ul class="check-list">
    <li>
        <i class="ri-check-line"></i>
        <div>
            <strong style="color: #0C3A30;">Learn Risk Management Firsthand</strong>
            <span class="d-block small text-secondary">Watch how experts protect capital, set stop-losses, and manage drawdowns in real-time</span>
        </div>
    </li>
    <li>
        <i class="ri-check-line"></i>
        <div>
            <strong style="color: #0C3A30;">Understand Entry & Exit Timing</strong>
            <span class="d-block small text-secondary">See exactly when and why experienced traders enter and exit positions</span>
        </div>
    </li>
    <li>
        <i class="ri-check-line"></i>
        <div>
            <strong style="color: #0C3A30;">Study Position Sizing</strong>
            <span class="d-block small text-secondary">Learn how professionals allocate capital across different trades</span>
        </div>
    </li>
    <li>
        <i class="ri-check-line"></i>
        <div>
            <strong style="color: #0C3A30;">Observe Market Analysis</strong>
            <span class="d-block small text-secondary">Follow the thought process behind each trade decision</span>
        </div>
    </li>
    <li>
        <i class="ri-check-line"></i>
        <div>
            <strong style="color: #0C3A30;">Gradual Independence</strong>
            <span class="d-block small text-secondary">Start placing your own trades when you're ready, with confidence built from observation</span>
        </div>
    </li>
    <li>
        <i class="ri-check-line"></i>
        <div>
            <strong style="color: #0C3A30;">From Follower to Trader</strong>
            <span class="d-block small text-secondary">Transition from copying others to executing your own strategy at your own pace</span>
        </div>
    </li>
</ul>

<!-- Image Grid -->
<div class="row g-4 mb-5" data-cues="slideInUp" data-duration="800">
    <div class="col-lg-6 col-md-6">
        <div class="feature-grid-image">
            <img class="radius-30 w-100" src="assets/images/service/service-image-10.jpg" alt="Learning from Expert Traders">
            <div class="p-3 bg-white">
                <span class="small text-secondary">Watch & Learn</span>
                <p class="mb-0 fw-semibold" style="color: #0C3A30;">Observe expert strategies in real-time</p>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="feature-grid-image">
            <img class="radius-30 w-100" src="assets/images/service/service-image-11.jpg" alt="Trading Independently">
            <div class="p-3 bg-white">
                <span class="small text-secondary">Grow Confident</span>
                <p class="mb-0 fw-semibold" style="color: #0C3A30;">Trade independently when you're ready</p>
            </div>
        </div>
    </div>
</div>

<!-- Closing Section with Stats -->
<div class="row g-4 align-items-center">
    <div class="col-lg-8">
        <p class="text-secondary mb-0" style="color: #4A5C5A !important; line-height: 1.7;">
            Start by copying, stay for the learning. Our platform lets you observe how experienced traders handle every aspect of the market — from risk management to execution timing. As you grow more confident, you'll find yourself making your own decisions, equipped with real-world knowledge gained from following the best. Whether you continue copying or trade alone, the choice is yours.
        </p>
    </div>
    <div class="col-lg-4">
        <div class="d-flex flex-column gap-2 p-4 rounded-4" style="background: rgba(139,201,5,0.04); border: 1px solid rgba(139,201,5,0.1);">
            <div class="d-flex align-items-center justify-content-between">
                <span class="small text-secondary">Traders Who Started Copying</span>
                <span class="fw-bold" style="color: #8BC905;">100K+</span>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <span class="small text-secondary">Now Trading Independently</span>
                <span class="fw-bold" style="color: #8BC905;">35K+</span>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <span class="small text-secondary">Average Learning Period</span>
                <span class="fw-bold" style="color: #8BC905;">3-6 Months</span>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <span class="small text-secondary">Success Rate After Learning</span>
                <span class="fw-bold" style="color: #8BC905;">88%</span>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="text-center mt-5 pt-4">
    <a href="{{ route('login') }}" class="btn-premium">
        <span>Start Your Learning Journey</span>
        <span class="rounded-circle bg-white/20 p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
            <i class="ri-arrow-right-up-line" style="color: #0C3A30; font-size: 1.2rem;"></i>
        </span>
    </a>
    <p class="small text-secondary mt-3">Begin by copying experts • Learn at your own pace • Trade when you're ready</p>
</div>
<!-- End Service Details Page - Premium Redesign -->

@endsection