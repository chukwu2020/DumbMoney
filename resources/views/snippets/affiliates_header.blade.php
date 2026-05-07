@extends('layout.app')

@section('content')

<style>
    /* Premium Service Details Styles - Keeping your exact styling */
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
    
    /* Hero Section */
    .hero--affiliate {
        padding: 120px 0;
        background-size: cover;
        background-position: center;
        position: relative;
        margin-bottom: 40px;
    }
    
    .hero--affiliate::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, rgba(12,58,48,0.9) 0%, rgba(12,58,48,0.6) 100%);
    }
    
    .hero__wrapper {
        position: relative;
        z-index: 2;
    }
    
    .hero__title {
        font-size: 3.5rem;
        font-weight: 800;
        color: white;
        margin-bottom: 20px;
        line-height: 1.2;
    }
    
    .hero__description {
        font-size: 1.2rem;
        color: rgba(255,255,255,0.9);
        margin-bottom: 30px;
        max-width: 600px;
    }
    
    .hero__highlights {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
    
    .hero__highlight {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .hero__highlight-icon {
        width: 24px;
        height: 24px;
        background: rgba(139,201,5,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #8BC905;
        font-size: 0.9rem;
    }
    
    .hero__highlight-text {
        color: white;
        font-weight: 500;
    }
    
    /* Service Items */
    .service__item--style1 {
        background: white;
        border-radius: 24px;
        padding: 30px;
        height: 100%;
        border: 1px solid rgba(139,201,5,0.1);
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 15px 30px -10px rgba(0,0,0,0.05);
    }
    
    .service__item--style1:hover {
        transform: translateY(-12px);
        border-color: rgba(139,201,5,0.3);
        box-shadow: 0 30px 45px -15px rgba(139,201,5,0.15);
    }
    
    .service__item-icon {
        width: 70px;
        height: 70px;
        background: rgba(139,201,5,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        transition: all 0.3s ease;
    }
    
    .service__item-icon img {
        width: 40px;
        height: 40px;
        object-fit: contain;
    }
    
    .service__item--style1:hover .service__item-icon {
        transform: scale(1.1);
        background: rgba(139,201,5,0.2);
    }
    
    .service__item-content h5 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #0C3A30;
        margin-bottom: 10px;
    }
    
    .service__item-content p {
        color: #4A5C5A;
        line-height: 1.6;
        margin-bottom: 0;
    }
    
    /* Affiliate Examples */
    .affiliate-examples {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    .affiliate-examples__card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        border: 1px solid rgba(139,201,5,0.1);
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }
    
    .affiliate-examples__card:hover {
        transform: translateY(-5px);
        border-color: rgba(139,201,5,0.3);
        box-shadow: 0 25px 40px -15px rgba(139,201,5,0.1);
    }
    
    .affiliate-examples__title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0C3A30;
        margin-bottom: 10px;
    }
    
    .affiliate-examples__meta p {
        font-size: 1.2rem;
        font-weight: 600;
        color: #8BC905;
        margin-bottom: 5px;
    }
    
    .affiliate-examples__meta span {
        color: #4A5C5A;
        font-size: 0.9rem;
    }
    
    .affiliate-examples__earnings {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 15px;
    }
    
    .affiliate-examples__amount {
        text-align: center;
    }
    
    .affiliate-examples__monthly {
        font-size: 1.8rem;
        font-weight: 800;
        color: #8BC905;
        display: block;
        line-height: 1.2;
    }
    
    .affiliate-examples__yearly {
        font-size: 1.8rem;
        font-weight: 800;
        color: #0C3A30;
        display: block;
        line-height: 1.2;
    }
    
    .affiliate-examples__period {
        font-size: 0.8rem;
        color: #4A5C5A;
    }
    
    .affiliate-examples__divider {
        width: 1px;
        height: 40px;
        background: rgba(139,201,5,0.2);
    }
    
    .affiliate-examples__cta .trk-btn {
        background: #8BC905;
        color: #0C3A30;
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .affiliate-examples__cta .trk-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 30px -10px rgba(139,201,5,0.3);
    }
    
    /* Comparison Table */
    .aff-comparison__table {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid rgba(139,201,5,0.1);
    }
    
    .aff-comparison__row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        border-bottom: 1px solid rgba(139,201,5,0.1);
    }
    
    .aff-comparison__row:last-child {
        border-bottom: none;
    }
    
    .aff-comparison__row--head {
        background: rgba(139,201,5,0.05);
        font-weight: 700;
        color: #0C3A30;
    }
    
    .aff-comparison__cell {
        padding: 20px;
        font-size: 1rem;
    }
    
    .aff-comparison__cell--highlight {
        color: #8BC905;
        font-weight: 600;
    }
    
    /* Process Cards */
    .process__card--style1 {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(139,201,5,0.15);
        border-radius: 20px;
        padding: 30px;
        height: 100%;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        backdrop-filter: blur(10px);
    }
    
    .process__card--style1:hover {
        transform: translateY(-10px);
        border-color: #8BC905;
        background: rgba(255,255,255,0.1);
    }
    
    .process__card-thumb {
        width: 80px;
        height: 80px;
        margin-bottom: 20px;
    }
    
    .process__card-thumb img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    
    .process__card-content h4 {
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        line-height: 1.4;
    }
    
    /* Profit Section */
    .profit {
        background: #0C3A30 !important;
    }
    
    .profit__content h2 {
        color: white;
        font-size: 2.5rem;
        font-weight: 700;
    }
    
    .profit .checklist__item {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(139,201,5,0.2);
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }
    
    .profit .checklist__item:hover {
        background: rgba(139,201,5,0.1);
        transform: translateX(10px);
    }
    
    .profit .checkmark {
        width: 28px;
        height: 28px;
        background: rgba(139,201,5,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #8BC905;
    }
    
    .profit .trk-btn--outline {
        background: transparent;
        border: 2px solid #8BC905;
        color: white;
        padding: 15px 40px;
        border-radius: 50px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .profit .trk-btn--outline:hover {
        background: #8BC905;
        color: #0C3A30;
        transform: translateY(-3px);
        box-shadow: 0 20px 30px -10px rgba(139,201,5,0.3);
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
        height: 200px;
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
    
    .feature-grid-image .p-3 {
        background: white;
        padding: 15px;
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
        text-decoration: none;
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
        text-decoration: none;
    }
    
    .trust-badge:hover {
        background: rgba(139,201,5,0.15);
        border-color: rgba(139,201,5,0.3);
        transform: translateY(-2px);
    }
    
    /* Section Headers */
    .section-header h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #0C3A30;
    }
    
    .section-header h2 span {
        color: #8BC905;
    }
    
    .bg-surface {
        background: #f8fafc;
    }
    
    /* Responsive */
    @media (max-width: 991px) {
        .hero__title {
            font-size: 2.5rem;
        }
        
        .affiliate-examples__card {
            flex-direction: column;
            text-align: center;
        }
        
        .affiliate-examples__earnings {
            justify-content: center;
        }
        
        .aff-comparison__cell {
            padding: 15px 10px;
            font-size: 0.9rem;
        }
        
        .service-main-image {
            margin-top: 2rem;
        }
        
        .check-list li {
            padding: 0.75rem;
        }
    }
    
    @media (max-width: 767px) {
        .hero__title {
            font-size: 2rem;
        }
        
        .hero__highlights {
            flex-direction: column;
            gap: 10px;
        }
        
        .aff-comparison__row {
            grid-template-columns: 1fr 1fr 1fr;
        }
        
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

<!-- Start Service Details Page - Affiliates Program -->
<div class="service-details-page pt-120 position-relative overflow-hidden">
    
    <!-- Pattern Overlay -->
    <div class="pattern-overlay"></div>
    
    <!-- ===============>> Hero Section Start <<================= -->
    <section class="hero hero--affiliate" style="background-image: url({{ asset('assets/images/affiliate/bg.png') }});">
        <div class="container">
            <div class="hero__wrapper">
                <div class="hero__content">
                    <h1 class="hero__title">Earn 20% Lifetime Commissions Referring Traders</h1>
                    <p class="hero__description">
                        Partner with Dumb Money and earn recurring income by referring traders to a structured futures prop firm built for serious growth.
                    </p>
                    <a href="#" class="trk-btn trk-btn--primary btn-premium"><span>Apply Now <i class="fa-solid fa-arrow-right ms-1"></i></span></a>
                    <div class="hero__highlights mt-4">
                        <div class="hero__highlight">
                            <span class="hero__highlight-icon">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <span class="hero__highlight-text">
                                Monthly payouts
                            </span>
                        </div>
                        <div class="hero__highlight">
                            <span class="hero__highlight-icon">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <span class="hero__highlight-text">
                                Accurate tracking
                            </span>
                        </div>
                        <div class="hero__highlight">
                            <span class="hero__highlight-icon">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <span class="hero__highlight-text">
                                No experience needed
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===============>> Hero Section End <<================= -->

    <!-- ===============>> Feat Info Section Start <<================= -->
    <div class="feat-info py-5" style="background: linear-gradient(145deg, #0C3A30, #0A2A23);">
        <div class="container">
            <div class="feat-info__wrapper">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-5 align-items-center justify-content-between">

                    <div class="col">
                        <div class="feat-info__item text-start">
                            <div class="feat-info__item-inner d-flex flex-wrap align-items-center gap-3">
                                <div class="feat-info__item-icon">
                                    <img src="{{ asset('assets/images/affiliate/icons/feat-1.png') }}" alt="icon" onerror="this.src='https://via.placeholder.com/40x40/0C3A30/8BC905?text=1'">
                                </div>
                                <div class="feat-info__item-content">
                                    <h6 class="text-white fw-medium">Highest commissioner <br> in the industry</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="feat-info__item text-start">
                            <div class="feat-info__item-inner d-flex flex-wrap align-items-center gap-3">
                                <div class="feat-info__item-icon">
                                    <img src="{{ asset('assets/images/affiliate/icons/feat-2.png') }}" alt="icon" onerror="this.src='https://via.placeholder.com/40x40/0C3A30/8BC905?text=2'">
                                </div>
                                <div class="feat-info__item-content">
                                    <h6 class="text-white fw-medium">Consistent <br> Monthly Payouts</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="feat-info__item text-start">
                            <div class="feat-info__item-inner d-flex flex-wrap align-items-center gap-3">
                                <div class="feat-info__item-icon">
                                    <img src="{{ asset('assets/images/affiliate/icons/feat-3.png') }}" alt="icon" onerror="this.src='https://via.placeholder.com/40x40/0C3A30/8BC905?text=3'">
                                </div>
                                <div class="feat-info__item-content">
                                    <h6 class="text-white fw-medium">High-Intent <br> Trading Audience</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===============>> Feat Info Section End <<================= -->

    <!-- ===============>> Services Section Start <<================= -->
    <section class="service padding-top padding-bottom" id="services">
        <div class="section-header section-header--max65 text-center mb-5">
            <h2 class="mb-10 mt-minus-5"><span>Why Partner With </span>Dumb Money?</h2>
        </div>
        <div class="container">
            <div class="service__wrapper">
                <div class="row g-4 justify-content-center">
                    <div class="col-xl-3 col-sm-6">
                        <div class="service__item service__item--style1 aos-init aos-animate" data-aos="fade-up" data-aos-duration="800">
                            <div class="service__item-inner text-start">
                                <div class="service__item-icon mb-5">
                                    <img src="{{ asset('assets/images/affiliate/icons/feat-4.png') }}" alt="icon" onerror="this.src='https://via.placeholder.com/40x40/0C3A30/8BC905?text=4'">
                                </div>
                                <div class="service__item-content">
                                    <h5>Recurring Income</h5>
                                    <p class="mb-0">Earn commissions on repeat purchases.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="service__item service__item--style1 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
                            <div class="service__item-inner text-start">
                                <div class="service__item-icon mb-5">
                                    <img src="{{ asset('assets/images/affiliate/icons/feat-5.png') }}" alt="icon" onerror="this.src='https://via.placeholder.com/40x40/0C3A30/8BC905?text=5'">
                                </div>
                                <div class="service__item-content">
                                    <h5>High Conversion</h5>
                                    <p class="mb-0">
                                        Clear rules and trader-friendly pricing.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="service__item service__item--style1 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1200">
                            <div class="service__item-inner text-start">
                                <div class="service__item-icon mb-5">
                                    <img src="{{ asset('assets/images/affiliate/icons/feat-6.png') }}" alt="icon" onerror="this.src='https://via.placeholder.com/40x40/0C3A30/8BC905?text=6'">
                                </div>
                                <div class="service__item-content">
                                    <h5>Flexible Promotion</h5>
                                    <p class="mb-0"> Content email, social, blogs, YouTube, newsletters , etc </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="service__item service__item--style1 aos-init" data-aos="fade-up" data-aos-duration="800">
                            <div class="service__item-inner text-start">
                                <div class="service__item-icon mb-5">
                                    <img src="{{ asset('assets/images/affiliate/icons/feat-7.png') }}" alt="icon" onerror="this.src='https://via.placeholder.com/40x40/0C3A30/8BC905?text=7'">
                                </div>
                                <div class="service__item-content">
                                    <h5>Built for Scale</h5>
                                    <p class="mb-0">Works for small or large audiences.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===============>> Services Section End <<================= -->

    <!-- ===============>> Affiliate Examples Section Start <<================= -->
    <section class="about padding-top padding-bottom bg-surface">
        <div class="container">
            <div class="about__wrapper">
                <div class="row g-5">
                    <div class="col-lg-5">
                        <div class="section-header mb-50">
                            <h2 class="mb-4"><span class="style2">How Much <br></span>
                                Can Affiliates Earn?
                            </h2>
                            <p>Earn lifetime commissions on every successful referral you bring in.
                                There's no earning limit — your results grow based on the work you put in and the audience you reach.</p>

                            <a href="#" class="trk-btn trk-btn--primary btn-premium mt-4"><span>Apply As An Affiliate <i class="fa-solid fa-arrow-right ms-1"></i></span></a>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="affiliate-examples">

                            <div class="affiliate-examples__card">
                                <div class="affiliate-examples__info">
                                    <h4 class="affiliate-examples__title">Starter Example</h4>
                                    <div class="affiliate-examples__meta">
                                        <p>$1,000 / Month</p>
                                        <span>33 Referrals / Month</span>
                                    </div>
                                </div>

                                <div class="affiliate-example__right">
                                    <div class="affiliate-examples__earnings">
                                        <div class="affiliate-examples__amount">
                                            <span class="affiliate-examples__monthly">$1,000</span>
                                            <span class="affiliate-examples__period">/Month</span>
                                        </div>

                                        <div class="affiliate-examples__divider"></div>

                                        <div class="affiliate-examples__amount">
                                            <span class="affiliate-examples__yearly">$12,000</span>
                                            <span class="affiliate-examples__period">/Year</span>
                                        </div>
                                    </div>

                                    <div class="affiliate-examples__cta">
                                        <a href="#" class="trk-btn trk-btn--primary trk-btn--small"><span>GET STARTED</span></a>
                                    </div>
                                </div>
                            </div>

                            <div class="affiliate-examples__card">
                                <div class="affiliate-examples__info">
                                    <h4 class="affiliate-examples__title">Growth Example</h4>
                                    <div class="affiliate-examples__meta">
                                        <p>$5,000 / Month</p>
                                        <span>167 Referrals / Month</span>
                                    </div>
                                </div>

                                <div class="affiliate-example_">
                                    <div class="affiliate-examples__earnings">
                                        <div class="affiliate-examples__amount">
                                            <span class="affiliate-examples__monthly">$5,000</span>
                                            <span class="affiliate-examples__period">/Month</span>
                                        </div>

                                        <div class="affiliate-examples__divider"></div>

                                        <div class="affiliate-examples__amount">
                                            <span class="affiliate-examples__yearly">$60,000</span>
                                            <span class="affiliate-examples__period">/Year</span>
                                        </div>
                                    </div>

                                    <div class="affiliate-examples__cta">
                                        <a href="#" class="trk-btn trk-btn--primary trk-btn--small"><span>GET STARTED</span></a>
                                    </div>
                                </div>
                            </div>

                            <div class="affiliate-examples__card">
                                <div class="affiliate-examples__info">
                                    <h4 class="affiliate-examples__title">Scale Example</h4>
                                    <div class="affiliate-examples__meta">
                                        <p>$10,000 / Month</p>
                                        <span>334 Referrals / Month</span>
                                    </div>
                                </div>
                                <div class="affiliate-example_">
                                    <div class="affiliate-examples__earnings">
                                        <div class="affiliate-examples__amount">
                                            <span class="affiliate-examples__monthly">$10,000</span>
                                            <span class="affiliate-examples__period">/Month</span>
                                        </div>

                                        <div class="affiliate-examples__divider"></div>

                                        <div class="affiliate-examples__amount">
                                            <span class="affiliate-examples__yearly">$120,000</span>
                                            <span class="affiliate-examples__period">/Year</span>
                                        </div>
                                    </div>

                                    <div class="affiliate-examples__cta">
                                        <a href="#" class="trk-btn trk-btn--primary trk-btn--small"><span>GET STARTED</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===============>> Affiliate Examples Section End <<================= -->

    <!-- ===============>> Comparison Table Section Start <<================= -->
    <section class="aff-comparison padding-top padding-bottom">
        <div class="section-header section-header--max65 text-center mb-5">
            <h2 class="mb-10 mt-minus-5">Why <br> <span>Dumb Money Pays Better?</span> </h2>
        </div>
        <div class="container">
            <div class="aff-comparison__table">

                <!-- Header -->
                <div class="aff-comparison__row aff-comparison__row--head">
                    <div class="aff-comparison__cell"></div>
                    <div class="aff-comparison__cell aff-comparison__cell--highlight">
                        Dumb Money
                    </div>
                    <div class="aff-comparison__cell">
                        Industry Standard
                    </div>
                </div>

                <!-- Row -->
                <div class="aff-comparison__row">
                    <div class="aff-comparison__cell">Base Commission</div>
                    <div class="aff-comparison__cell aff-comparison__cell--highlight">
                        20% Lifetime (Flat Rate)
                    </div>
                    <div class="aff-comparison__cell">
                        10%–15% (often tiered)
                    </div>
                </div>

                <div class="aff-comparison__row">
                    <div class="aff-comparison__cell">Recurring Earnings</div>
                    <div class="aff-comparison__cell aff-comparison__cell--highlight">Yes</div>
                    <div class="aff-comparison__cell">Yes (varies)</div>
                </div>

                <div class="aff-comparison__row">
                    <div class="aff-comparison__cell">Commission Structure</div>
                    <div class="aff-comparison__cell aff-comparison__cell--highlight">
                        Flat – No Volume Tiers
                    </div>
                    <div class="aff-comparison__cell">
                        Often volume-based tiers
                    </div>
                </div>

                <div class="aff-comparison__row">
                    <div class="aff-comparison__cell">Monthly Payouts</div>
                    <div class="aff-comparison__cell aff-comparison__cell--highlight">Yes</div>
                    <div class="aff-comparison__cell">Yes</div>
                </div>

                <div class="aff-comparison__row">
                    <div class="aff-comparison__cell">Tier Requirement</div>
                    <div class="aff-comparison__cell aff-comparison__cell--highlight">No</div>
                    <div class="aff-comparison__cell">Often required</div>
                </div>

            </div>
        </div>
    </section>
    <!-- ===============>> Comparison Table Section End <<================= -->

    <!-- ===============>> Process Section Start <<================= -->
    <div class="process bg-black padding-top padding-bottom">
        <div class="section-header section-header--max65 text-center mb-5">
            <h2 class="mb-15 text-white">Who <span class="text-primary" style="color: #8BC905 !important;"> This Program Is For? </span></h2>
        </div>
        <div class="container">
            <div class="process__wrapper">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-5 justify-content-center g-4">
                    <div class="col">
                        <div class="process__card process__card--style1 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
                            <div class="process__card-inner">
                                <div class="process__card-thumb bg-transparent">
                                    <img src="{{ asset('assets/images/affiliate/icons/1.png') }}" alt="icon" onerror="this.src='https://via.placeholder.com/80x80/8BC905/0C3A30?text=1'">
                                </div>
                                <div class="process__card-content">
                                    <h4 class="fs-24">Trading educators & mentors</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="process__card process__card--style1 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
                            <div class="process__card-inner">
                                <div class="process__card-thumb bg-transparent">
                                    <img src="{{ asset('assets/images/affiliate/icons/2.png') }}" alt="icon" onerror="this.src='https://via.placeholder.com/80x80/8BC905/0C3A30?text=2'">
                                </div>
                                <div class="process__card-content">
                                    <h4 class="fs-24">YouTube, TikTok, and social creators</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="process__card process__card--style1 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                            <div class="process__card-inner">
                                <div class="process__card-thumb bg-transparent">
                                    <img src="{{ asset('assets/images/affiliate/icons/3.png') }}" alt="icon" onerror="this.src='https://via.placeholder.com/80x80/8BC905/0C3A30?text=3'">
                                </div>
                                <div class="process__card-content">
                                    <h4 class="fs-24">Newsletter publishers & owners</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="process__card process__card--style1 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                            <div class="process__card-inner">
                                <div class="process__card-thumb bg-transparent">
                                    <img src="{{ asset('assets/images/affiliate/icons/4.png') }}" alt="icon" onerror="this.src='https://via.placeholder.com/80x80/8BC905/0C3A30?text=4'">
                                </div>
                                <div class="process__card-content">
                                    <h4 class="fs-24">Trading communities & Discord admins</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="process__card process__card--style1 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                            <div class="process__card-inner">
                                <div class="process__card-thumb bg-transparent">
                                    <img src="{{ asset('assets/images/affiliate/icons/5.png') }}" alt="icon" onerror="this.src='https://via.placeholder.com/80x80/8BC905/0C3A30?text=5'">
                                </div>
                                <div class="process__card-content">
                                    <h4 class="fs-24">Financial content websites</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-50 pt-4">
                    <a href="{{ route('signup') }}" class="btn-premium"><span>Apply As An Affiliate <i class="fa-solid fa-arrow-right ms-1"></i></span></a>
                </div>
            </div>
        </div>
    </div>
    <!-- ===============>> Process Section End <<================= -->

    <!-- ========== Profit Section Start ========== -->
    <section class="profit padding-top padding-bottom" style="background: #0C3A30 !important;">
        <div class="container">
            <div class="profit__wrapper">
                <div class="row g-5 justify-content-between">
                    <div class="col-lg-5">
                        <div class="profit__content">
                            <h2 class="text-white mb-4">
                                Affiliate Tools <br>
                                And Support
                            </h2>

                            <ul class="checklist flex-column list-unstyled">
                                <li class="checklist__item d-flex align-items-center gap-3 p-3 rounded-4 mb-3" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(139,201,5,0.2);">
                                    <span class="checkmark d-flex align-items-center justify-content-center rounded-circle" style="width: 28px; height: 28px; background: rgba(139,201,5,0.2); color: #8BC905;">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="text-white">Unique tracking links & custom coupon codes</span>
                                </li>
                                <li class="checklist__item d-flex align-items-center gap-3 p-3 rounded-4 mb-3" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(139,201,5,0.2);">
                                    <span class="checkmark d-flex align-items-center justify-content-center rounded-circle" style="width: 28px; height: 28px; background: rgba(139,201,5,0.2); color: #8BC905;">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="text-white">Real-time dashboard to monitor</span>
                                </li>
                                <li class="checklist__item d-flex align-items-center gap-3 p-3 rounded-4 mb-4" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(139,201,5,0.2);">
                                    <span class="checkmark d-flex align-items-center justify-content-center rounded-circle" style="width: 28px; height: 28px; background: rgba(139,201,5,0.2); color: #8BC905;">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="text-white">Conversion, commission & earnings</span>
                                </li>
                            </ul>

                            <a href="#" class="trk-btn trk-btn--outline btn-premium" style="background: transparent; border: 2px solid #8BC905; color: white;">APPLY NOW <i class="fa-solid fa-arrow-right ms-1"></i></a>

                            <p class="text-white mt-3">
                                Application reviewed quickly – No upfront cost
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="profit__thumb">
                            <img src="{{ asset('assets/images/affiliate/aff-img.png') }}" alt="affiliate image" class="img-fluid rounded-4" onerror="this.src='https://via.placeholder.com/500x400/0C3A30/8BC905?text=Affiliate+Program'">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== Profit Section End ========== -->

    <!-- ========== Copy Trading Learning Section (From your original) ========== -->
    <div class="container position-relative py-5" style="z-index: 10;">
        <div class="row">
            <div class="col-lg-12">
                <div class="service-details-content">
                    
                    <!-- Premium Breadcrumb -->
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <span class="premium-badge badge px-4 py-2 rounded-pill fw-semibold d-inline-flex align-items-center gap-2">
                            <span class="pulse-dot"></span>
                            AFFILIATE SUCCESS PATH
                        </span>
                    </div>
                    
                    <!-- Main Image -->
                    <div class="service-main-image position-relative">
                        <img class="radius-30 w-100" src="{{ asset('assets/images/service/service-image-9.jpg') }}" alt="Affiliate Success Platform" onerror="this.src='https://via.placeholder.com/1200x600/0C3A30/8BC905?text=Affiliate+Success'">
                        
                        <!-- Floating Badge -->
                        <div class="position-absolute top-0 start-0 m-4 float-animation" style="z-index: 5;">
                            <div class="d-flex align-items-center gap-2 bg-white/95 backdrop-blur rounded-pill py-2 px-4 shadow-lg">
                                <span class="pulse-dot"></span>
                                <span class="fw-semibold small" style="color: #0C3A30;">ACTIVE AFFILIATES</span>
                            </div>
                        </div>
                        
                        <!-- Floating Badge -->
                        <div class="position-absolute bottom-0 end-0 m-4 float-animation" style="animation-delay: 1s; z-index: 5;">
                            <div class="d-flex align-items-center gap-2 bg-white/95 backdrop-blur rounded-pill py-2 px-4 shadow-lg"
                                 style="border-left: 4px solid #8BC905;">
                                <i class="ri-global-line" style="color: #8BC905;"></i>
                                <span class="fw-semibold small" style="color: #0C3A30;">GLOBAL NETWORK</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Title Section -->
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                        <div>
                            <h1 class="display-5 fw-bold" style="color: #0C3A30;">
                                Your <span class="highlight-underline">Affiliate Journey</span> Starts Here
                            </h1>
                        </div>
                        
                        <!-- Quick Stats -->
                        <div class="d-flex align-items-center gap-3">
                            <div class="stats-card p-3 text-center">
                                <div class="stat-number">$2.4M+</div>
                                <div class="stat-label">Paid to Affiliates</div>
                            </div>
                            <div class="stats-card p-3 text-center">
                                <div class="stat-number">500+</div>
                                <div class="stat-label">Active Partners</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <p class="fs-5 text-secondary mb-4" style="color: #4A5C5A !important; line-height: 1.7;">
                        <span class="fw-bold" style="color: #8BC905;">Join our thriving affiliate community</span> and start earning lifetime commissions by referring traders to our platform. We provide all the tools, resources, and support you need to succeed — from unique tracking links to real-time performance dashboards.
                    </p>
                    
                    <!-- Premium Quote Card -->
                    <div class="quote-card">
                        <p class="text-white mb-0">
                            "Our mission is to build a partner-first affiliate program that rewards you for every successful trader you bring in — not just once, but for life. With competitive commissions, reliable payouts, and dedicated support, we're committed to your long-term success."
                        </p>
                        <div class="d-flex align-items-center gap-3 mt-4">
                            <span class="trust-badge" style="background: rgba(255,255,255,0.1); color: white; border-color: rgba(139,201,5,0.3);">
                                <i class="ri-check-line" style="color: #8BC905;"></i> 500+ Partners
                            </span>
                            <span class="trust-badge" style="background: rgba(255,255,255,0.1); color: white; border-color: rgba(139,201,5,0.3);">
                                <i class="ri-check-line" style="color: #8BC905;"></i> $2.4M+ Paid
                            </span>
                        </div>
                    </div>
                    
                    <!-- Section Title -->
                    <h2 class="fw-bold mb-4" style="color: #0C3A30; font-size: 2rem;">
                        Your <span class="highlight-underline">Affiliate Success Path</span> From Beginner to Top Earner
                    </h2>

                    <!-- Premium Learning Path Description -->
                    <div class="p-4 mb-4 rounded-4" style="background: rgba(139,201,5,0.04); border-left: 4px solid #8BC905;">
                        <p class="fs-5 mb-0" style="color: #0C3A30; line-height: 1.6;">
                            Start by sharing your unique affiliate link with your audience. As your referrals grow, so does your income. Track your performance in real-time, optimize your strategies, and scale your earnings — all with our support.
                        </p>
                    </div>

                    <!-- Premium Check List -->
                    <ul class="check-list">
                        <li>
                            <i class="ri-check-line"></i>
                            <div>
                                <strong style="color: #0C3A30;">Get Your Unique Tracking Link</strong>
                                <span class="d-block small text-secondary">Every affiliate gets a custom link to track referrals accurately</span>
                            </div>
                        </li>
                        <li>
                            <i class="ri-check-line"></i>
                            <div>
                                <strong style="color: #0C3A30;">Share with Your Audience</strong>
                                <span class="d-block small text-secondary">Promote through your website, social media, email, or YouTube</span>
                            </div>
                        </li>
                        <li>
                            <i class="ri-check-line"></i>
                            <div>
                                <strong style="color: #0C3A30;">Earn Lifetime Commissions</strong>
                                <span class="d-block small text-secondary">20% commission on every purchase from your referrals — forever</span>
                            </div>
                        </li>
                        <li>
                            <i class="ri-check-line"></i>
                            <div>
                                <strong style="color: #0C3A30;">Monitor Performance</strong>
                                <span class="d-block small text-secondary">Real-time dashboard shows clicks, conversions, and earnings</span>
                            </div>
                        </li>
                        <li>
                            <i class="ri-check-line"></i>
                            <div>
                                <strong style="color: #0C3A30;">Get Paid Monthly</strong>
                                <span class="d-block small text-secondary">Reliable monthly payouts with no minimum thresholds</span>
                            </div>
                        </li>
                        <li>
                            <i class="ri-check-line"></i>
                            <div>
                                <strong style="color: #0C3A30;">Scale Your Earnings</strong>
                                <span class="d-block small text-secondary">No earning caps — your income grows with your audience</span>
                            </div>
                        </li>
                    </ul>

                    <!-- Image Grid -->
                    <div class="row g-4 mb-5" data-cues="slideInUp" data-duration="800">
                        <div class="col-lg-6 col-md-6">
                            <div class="feature-grid-image">
                                <img class="radius-30 w-100" src="{{ asset('assets/images/service/service-image-10.jpg') }}" alt="Affiliate Dashboard" onerror="this.src='https://via.placeholder.com/600x400/0C3A30/8BC905?text=Dashboard'">
                                <div class="p-3 bg-white">
                                    <span class="small text-secondary">Real-Time Tracking</span>
                                    <p class="mb-0 fw-semibold" style="color: #0C3A30;">Monitor your performance live</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="feature-grid-image">
                                <img class="radius-30 w-100" src="{{ asset('assets/images/service/service-image-11.jpg') }}" alt="Affiliate Earnings" onerror="this.src='https://via.placeholder.com/600x400/0C3A30/8BC905?text=Earnings'">
                                <div class="p-3 bg-white">
                                    <span class="small text-secondary">Monthly Payouts</span>
                                    <p class="mb-0 fw-semibold" style="color: #0C3A30;">Get paid reliably every month</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -->
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-8">
                            <p class="text-secondary mb-0" style="color: #4A5C5A !important; line-height: 1.7;">
                                Start your affiliate journey today. Whether you're a content creator, educator, or community leader, we provide everything you need to earn by referring traders. From unique tracking links to real-time analytics and monthly payouts — join our partner program and turn your audience into recurring income.
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <div class="d-flex flex-column gap-2 p-4 rounded-4" style="background: rgba(139,201,5,0.04); border: 1px solid rgba(139,201,5,0.1);">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="small text-secondary">Active Affiliates</span>
                                    <span class="fw-bold" style="color: #8BC905;">500+</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="small text-secondary">Total Paid</span>
                                    <span class="fw-bold" style="color: #8BC905;">$2.4M+</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="small text-secondary">Avg. Monthly Earnings</span>
                                    <span class="fw-bold" style="color: #8BC905;">$1,500+</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="small text-secondary">Top Earner</span>
                                    <span class="fw-bold" style="color: #8BC905;">$15K/mo</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Section -->
                    <div class="text-center mt-5 pt-4">
                        <a href="{{ route('signup') }}" class="btn-premium">
                            <span>Become an Affiliate Today</span>
                            <span class="rounded-circle bg-white/20 p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i class="ri-arrow-right-up-line" style="color: #0C3A30; font-size: 1.2rem;"></i>
                            </span>
                        </a>
                        <p class="small text-secondary mt-3">Get your unique tracking link • Start promoting • Earn lifetime commissions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Service Details Page -->

@endsection