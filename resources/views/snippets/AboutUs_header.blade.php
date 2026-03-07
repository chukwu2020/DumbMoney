@extends('layout.app')

@section('content')

<style>
    /* Premium About Page Styles */
    .about-area {
        background: linear-gradient(145deg, #ffffff, #f9fbf9);
        position: relative;
        overflow: hidden;
    }
    
    /* Decorative Elements */
    .about-area::before {
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
    
    .about-area::after {
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
    
    /* Subtle Pattern Overlay */
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
    
    /* Floating Animation */
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }
    
    @keyframes pulse {
        0% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(0.95); box-shadow: 0 0 20px #8BC905; }
        100% { opacity: 1; transform: scale(1); }
    }
    
    @keyframes shimmer {
        0% { background-position: -100% 0; }
        100% { background-position: 200% 0; }
    }
    
    .float-animation {
        animation: float 6s ease-in-out infinite;
    }
    
    .float-animation-delay {
        animation: float 7s ease-in-out infinite 1s;
    }
    
    /* Premium Badge */
    .premium-badge {
        background: linear-gradient(145deg, #0C3A30, #0A2A23);
        color: white;
        border: 1px solid rgba(139,201,5,0.4);
        box-shadow: 0 10px 20px -8px rgba(10,42,35,0.2);
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
    
    /* Underline Effect */
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
    
    /* Check List Items */
    .check-list-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }
    
    .check-list-item:hover {
        transform: translateX(8px);
    }
    
    .check-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background: rgba(139,201,5,0.15);
        color: #8BC905;
        border-radius: 50%;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }
    
    .check-list-item:hover .check-icon {
        background: rgba(139,201,5,0.25);
        transform: scale(1.1);
    }
    
    /* Stats Card */
    .stats-card {
        background: white;
        border-radius: 24px;
        padding: 2rem;
        box-shadow: 0 20px 40px -15px rgba(0,0,0,0.08);
        border: 1px solid rgba(139,201,5,0.1);
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    .stats-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 50px -20px rgba(139,201,5,0.15);
        border-color: rgba(139,201,5,0.3);
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: #8BC905;
        line-height: 1;
        margin-bottom: 0.25rem;
    }
    
    .stat-label {
        color: #4A5C5A;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    /* Image Container */
    .about-image-container {
        position: relative;
        border-radius: 32px;
        overflow: hidden;
        background: linear-gradient(145deg, #0C3A30, #0A2A23);
        box-shadow: 0 30px 50px -20px rgba(12,58,48,0.3);
        border: 1px solid rgba(139,201,5,0.15);
    }
    
    .about-main-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
       
    }
    
    .about-image-container:hover .about-main-image {
        transform: scale(1.05);
    }
    
    
    
    
    /* Floating Image */
    .floating-image {
        position: absolute;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(139,201,5,0.2);
        box-shadow: 0 20px 30px -10px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }
    
    .floating-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .floating-image:hover {
        transform: scale(1.05) translateY(-5px);
        border-color: rgba(139,201,5,0.4);
        box-shadow: 0 25px 40px -12px rgba(0,0,0,0.25);
    }
    
    /* Feature Card */
    .feature-card-about {
        background: white;
        border-radius: 24px;
        padding: 2rem;
        box-shadow: 0 15px 30px -10px rgba(0,0,0,0.05);
        border: 1px solid rgba(139,201,5,0.1);
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        height: 100%;
    }
    
    .feature-card-about:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 45px -15px rgba(139,201,5,0.15);
        border-color: rgba(139,201,5,0.3);
    }
    
    .feature-icon {
        width: 72px;
        height: 72px;
        background: rgba(139,201,5,0.1);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }
    
    .feature-icon i {
        font-size: 2.5rem;
        color: #8BC905;
        transition: all 0.3s ease;
    }
    
    .feature-card-about:hover .feature-icon {
        background: rgba(139,201,5,0.15);
        transform: scale(1.1);
    }
    
    .feature-card-about:hover .feature-icon i {
        transform: scale(1.1);
        color: #0C3A30;
    }
    
    .feature-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #0C3A30;
        margin-bottom: 1rem;
    }
    
    .feature-text {
        color: #4A5C5A;
        line-height: 1.6;
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
    
    .btn-premium span {
        transition: all 0.3s ease;
    }
    
    .btn-premium:hover span:last-child {
        transform: translateX(8px) translateY(-4px);
    }
    
    .btn-outline-premium {
        background: transparent;
        color: #0C3A30;
        border: 2px solid rgba(139,201,5,0.3);
        padding: 0.9rem 2.2rem;
        border-radius: 50px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
    }
    
    .btn-outline-premium:hover {
        border-color: #8BC905;
        background: rgba(139,201,5,0.05);
        transform: translateY(-3px);
    }
    
    /* Trust Badge */
    .trust-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem 1.5rem;
        background: rgba(139,201,5,0.08);
        border: 1px solid rgba(139,201,5,0.15);
        border-radius: 50px;
        color: #0C3A30;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .trust-badge:hover {
        background: rgba(139,201,5,0.15);
        border-color: rgba(139,201,5,0.3);
        transform: translateY(-2px);
    }
    
    /* Timeline */
    .timeline-item {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: white;
        border-radius: 20px;
        border: 1px solid rgba(139,201,5,0.1);
        transition: all 0.3s ease;
    }
    
    .timeline-item:hover {
        transform: translateX(8px);
        border-color: rgba(139,201,5,0.3);
        box-shadow: 0 15px 30px -10px rgba(139,201,5,0.1);
    }
    
    .timeline-year {
        font-size: 1.2rem;
        font-weight: 700;
        color: #8BC905;
        min-width: 80px;
    }
    
    .timeline-content h4 {
        font-weight: 700;
        color: #0C3A30;
        margin-bottom: 0.5rem;
    }
    
    .timeline-content p {
        color: #4A5C5A;
        margin-bottom: 0;
    }
    
    /* Responsive */
    @media (max-width: 991px) {
        .about-content {
            text-align: center;
            padding-left: 0 !important;
        }
        
        .check-list-item {
            justify-content: center;
        }
        
        .stats-row {
            justify-content: center;
        }
        
        .floating-image {
            display: none;
        }
    }
    
    @media (max-width: 767px) {
        .display-4 {
            font-size: 2.2rem;
        }
        
        .stat-number {
            font-size: 2rem;
        }
        
        .feature-card-about {
            padding: 1.5rem;
        }
    }
</style>

<!-- Start About Area - Premium Redesign -->
<div class="about-area ptb-120 position-relative overflow-hidden" style="min-height: 100vh;">
    
    <!-- Premium Decorative Elements -->
    <div class="pattern-overlay"></div>
    
    <div class="container position-relative" style="z-index: 10;">
        <div class="row align-items-center g-5">
            
            <!-- ========================================= -->
            <!-- LEFT COLUMN - PREMIUM CONTENT -->
            <!-- ========================================= -->
            <div class="col-lg-6 col-md-12" data-cues="slideInRight" data-duration="800">
                <div class="about-content pe-lg-5">
                    
                    <!-- Premium Badge -->
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="premium-badge badge px-4 py-2 rounded-pill fw-semibold d-inline-flex align-items-center gap-2">
                            <span class="pulse-dot"></span>
                            ABOUT MARKET MIND
                        </span>
                        <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2);">
                            ✦ SINCE 2015
                        </span>
                    </div>
                    
                    <!-- Main Headline -->
                    <h1 class="display-4 fw-bold mb-3" style="color: #0C3A30; line-height: 1.2;">
                        Your Right Path To 
                        <span class="highlight-underline">
                            Smart Financial
                        </span>
                        Decisions
                    </h1>
                    
                    <!-- Description with Drop Cap Effect -->
                    <div class="mb-4">
                        <p class="fs-5 text-secondary mb-3" style="color: #4A5C5A !important; line-height: 1.7;">
                            <span class="float-start me-2" style="font-size: 4rem; line-height: 0.8; color: #8BC905; font-weight: 800;">A</span>
                            s a leading global Asset Management firm with <strong class="text-dark">$2.2 trillion</strong> in assets, Market Mind has been creating lasting impact since 2015. We pioneered a consulting-based approach to private asset investing, partnering with management teams to challenge conventional thinking and build great businesses.
                        </p>
                        
                        <p class="text-secondary mb-3" style="color: #4A5C5A !important; line-height: 1.7;">
                            Our unique platform spans asset classes, delivering enduring results for diverse investors. Through insightful analysis and unconventional thinking, our team uncovers hidden opportunities while carefully assessing risks.
                        </p>
                        
                        <div class="p-4 rounded-4 my-4" style="background: rgba(139,201,5,0.04); border-left: 4px solid #8BC905;">
                            <p class="mb-0 fst-italic" style="color: #0C3A30; font-weight: 500;">
                                "At our core is a culture of integrity, collaboration, and client focus - our sustainable competitive advantage that attracts and retains top talent in the industry."
                            </p>
                        </div>
                    </div>
                    
                    <!-- Premium Check List -->
                    <div class="mt-4">
                        <ul class="list-unstyled">
                            <li class="check-list-item">
                                <span class="check-icon">
                                    <i class="ri-check-line"></i>
                                </span>
                                <span style="color: #0C3A30; font-size: 1.05rem;">
                                    With a robust suite of products ranging from digital banking and payment processing to wealth management and blockchain applications we empower our clients
                                </span>
                            </li>
                            <li class="check-list-item">
                                <span class="check-icon">
                                    <i class="ri-check-line"></i>
                                </span>
                                <span style="color: #0C3A30; font-size: 1.05rem;">
                                    Pay Bills On Time Without Missing A Beat
                                </span>
                            </li>
                            <li class="check-list-item">
                                <span class="check-icon">
                                    <i class="ri-check-line"></i>
                                </span>
                                <span style="color: #0C3A30; font-size: 1.05rem;">
                                    Create And Send Invoices In Seconds
                                </span>
                            </li>
                            <li class="check-list-item">
                                <span class="check-icon">
                                    <i class="ri-check-line"></i>
                                </span>
                                <span style="color: #0C3A30; font-size: 1.05rem;">
                                    Control Your Cash Flow On Demand
                                </span>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Stats Row -->
                    <div class="stats-row d-flex flex-wrap align-items-center gap-4 gap-xl-5 mt-4 pt-2 mb-4">
                        <div>
                            <div class="stat-number">$2.2T</div>
                            <div class="stat-label">Assets Under Management</div>
                        </div>
                        <div style="width: 1px; height: 40px; background: rgba(0,0,0,0.1);"></div>
                        <div>
                            <div class="stat-number">50K+</div>
                            <div class="stat-label">Global Clients</div>
                        </div>
                        <div style="width: 1px; height: 40px; background: rgba(0,0,0,0.1);"></div>
                        <div>
                            <div class="stat-number">2015</div>
                            <div class="stat-label">Founded</div>
                        </div>
                    </div>
                    
                    <!-- CTA Buttons -->
                    <div class="d-flex flex-wrap align-items-center gap-3 mt-4">
                        <a href="{{route('about.us')}}" class="btn-premium">
                            <span>Learn About Us</span>
                            <span class="rounded-circle bg-white/20 p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i class="ri-arrow-right-up-line" style="color: #0C3A30; font-size: 1.2rem;"></i>
                            </span>
                        </a>
                        
                        <div class="d-flex align-items-center gap-2">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle border-2 border-white" style="width: 40px; height: 40px; background: linear-gradient(145deg, #0C3A30, #0A2A23); margin-right: -10px;"></div>
                                <div class="rounded-circle border-2 border-white" style="width: 40px; height: 40px; background: linear-gradient(145deg, #8BC905, #7AB805); margin-right: -10px;"></div>
                                <div class="rounded-circle border-2 border-white" style="width: 40px; height: 40px; background: linear-gradient(145deg, #0C3A30, #0A2A23);"></div>
                            </div>
                            <span class="small text-secondary">Join 50K+ clients</span>
                        </div>
                    </div>
                </div>
            </div>
            
          
            <!-- ========================================= -->
<!-- RIGHT COLUMN - PREMIUM IMAGE SHOWCASE -->
<!-- ========================================= -->
<div class="col-lg-6 col-md-12" data-cues="slideInLeft" data-duration="800">
    <div class="about-image position-relative p-3">
        
        <!-- Main Image Container -->
        <div class="about-image-container position-relative" style="min-height: 500px;">
            
            <!-- Decorative Pattern (Optional - you can keep or remove this too) -->
            <div class="position-absolute w-100 h-100 opacity-10" 
                 style="background-image: radial-gradient(circle at 30px 30px, rgba(139,201,5,0.2) 1px, transparent 1px); background-size: 40px 40px; pointer-events: none; z-index: 2;"></div>
            
            <!-- Main Image - REMOVED THE OVERLAY -->
            <img class="about-main-image radius-30" 
                 src="assets/images/about/about-image-4.jpg" 
                 alt="Market Mind Team"
                 style="width: 100%; height: 100%; object-fit: cover; opacity: 1; mix-blend-mode: normal;">
            
            <!-- REMOVED: Gradient Overlay (image-overlay div) -->
            <!-- REMOVED: <div class="image-overlay"></div> -->
            
            <!-- Floating Image 1 - Team Meeting -->
            <div class="floating-image position-absolute" 
                 style="top: 20px; right: -20px; width: 180px; height: 140px; animation: float 7s ease-in-out infinite; z-index: 5;">
                <img src="assets/images/about/about-image-5.jpg" alt="Team Meeting" style="width: 100%; height: 100%; object-fit: cover;">
                <div class="position-absolute bottom-0 start-0 w-100 p-2" style="background: linear-gradient(to top, rgba(12,58,48,0.8), transparent);">
                    <span class="small text-white fw-semibold">Global Team</span>
                </div>
            </div>
            
            <!-- Floating Badge - Years of Experience -->
            <div class="position-absolute" style="bottom: 40px; left: -20px; animation: float 8s ease-in-out infinite 1s; z-index: 6;">
                <div class="d-flex align-items-center gap-3 bg-white/95 backdrop-blur rounded-4 p-3 shadow-xl"
                     style="border-left: 4px solid #8BC905;">
                    <div class="rounded-circle p-2" style="background: rgba(139,201,5,0.15);">
                        <i class="ri-star-fill fs-3" style="color: #8BC905;"></i>
                    </div>
                    <div>
                        <span class="small text-secondary" style="color: #0C3A30;">Trusted Since</span>
                        <div class="fw-bold fs-4" style="color: #0C3A30;">2015</div>
                        <span class="small text-secondary" style="color: #0C3A30;">9+ Years of Excellence</span>
                    </div>
                </div>
            </div>
            
            <!-- Floating Badge - Global Presence -->
            <div class="position-absolute" style="top: 30%; right: -15px; animation: float 6s ease-in-out infinite 2s; z-index: 6;">
                <div class="d-flex align-items-center gap-3 bg-white/95 backdrop-blur rounded-4 p-3 shadow-xl"
                     style="border-left: 4px solid #8BC905;">
                    <div class="rounded-circle p-2" style="background: rgba(139,201,5,0.15);">
                        <i class="ri-global-line fs-3" style="color: #8BC905;"></i>
                    </div>
                    <div>
                        <span class="small text-secondary" style="color: white;">Global Presence</span>
                        <div class="fw-bold" style="color: white;">30+ Countries</div>
                    </div>
                </div>
            </div>
            
            <!-- Stats Overlay -->
            <div class="position-absolute bottom-0 end-0 m-4" style="z-index: 7;">
                <div class="stats-card p-3" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(10px);">
                    <div class="d-flex align-items-center gap-3">
                        <div class="text-center">
                            <div class="stat-number" style="font-size: 1.8rem;">150+</div>
                            <div class="stat-label" style="font-size: 0.7rem;">Countries Served</div>
                        </div>
                        <div style="width: 1px; height: 30px; background: rgba(0,0,0,0.1);"></div>
                        <div class="text-center">
                            <div class="stat-number" style="font-size: 1.8rem;">24/7</div>
                            <div class="stat-label" style="font-size: 0.7rem;">Support</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Decorative Shapes -->
        <div class="position-absolute" style="top: -20px; left: -20px; z-index: 1;">
            <img class="feature-shape-1" src="assets/images/shape/feature-shape-1.png" alt="shape" style="opacity: 0.4; width: 80px;">
        </div>
    </div>
</div>
        </div>
    </div>
</div>
<!-- End About Area - Premium Redesign -->

<!-- Start Our Story Section - Premium -->
<div class="our-story-area py-5 py-md-6 position-relative overflow-hidden"
     style="background: linear-gradient(145deg, #f8fafc, #ffffff);">
    
    <!-- Decorative Elements -->
    <div class="position-absolute" style="top: -100px; left: -50px; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(139,201,5,0.03) 0%, transparent 70%);"></div>
    
    <div class="container position-relative" style="max-width: 1280px; margin: 0 auto; z-index: 5;">
        
        <!-- Section Header -->
        <div class="text-center mb-5" data-cues="slideInUp" data-duration="800">
            <div class="d-flex justify-content-center mb-3">
                <span class="premium-badge badge px-4 py-2 rounded-pill fw-semibold d-inline-flex align-items-center gap-2">
                    <span class="pulse-dot"></span>
                    OUR JOURNEY
                </span>
            </div>
            
            <h2 class="display-5 fw-bold mb-3 mx-auto" style="color: #0C3A30; max-width: 700px; line-height: 1.2;">
                The Story Behind 
                <span class="highlight-underline">
                    Market Mind
                </span>
            </h2>
            
            <p class="fs-5 text-secondary mx-auto" style="color: #4A5C5A !important; max-width: 600px;">
                From a bold vision to a global financial leader  our journey of innovation and trust
            </p>
        </div>
        
       <!-- Timeline / Story Grid -->
<div class="row g-4" data-cues="slideInUp" data-duration="800">
    <div class="col-lg-6">
        <div class="feature-card-about">
            <div class="feature-icon">
                <i class="flaticon-rocket"></i>
            </div>
            <h3 class="feature-title">Our Vision</h3>
            <p class="feature-text">
                To democratize access to professional trading strategies by creating the world's most intuitive copy trading platform  where beginners can learn from experts, and experts can monetize their success, all powered by our Automated execution engine.
            </p>
            <div class="mt-3 d-flex align-items-center gap-2">
                <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2);">
                    👥 50K+ Traders Connected
                </span>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="feature-card-about">
            <div class="feature-icon">
                <i class="flaticon-target"></i>
            </div>
            <h3 class="feature-title">Our Mission</h3>
            <p class="feature-text">
                To empower every trader  regardless of experience  with the ability to mirror top-performing strategies in real-time, automate their portfolio management, and achieve consistent returns through our advanced copy trading infrastructure and Automated-powered market insights.
            </p>
            <div class="mt-3 d-flex align-items-center gap-2">
                <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2);">
                    ⚡ <1ms Execution
                </span>
                <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2);">
                    🤖 AI-Powered
                </span>
            </div>
        </div>
    </div>
</div>
        
        <!-- Timeline -->
        <!-- Timeline -->
<div class="row mt-5" data-cues="slideInUp" data-duration="800">
    <div class="col-12">
        <div class="p-4 p-xl-5 rounded-5" style="background: white; border: 1px solid rgba(139,201,5,0.1); box-shadow: 0 20px 40px -15px rgba(0,0,0,0.05);">
            <h3 class="fw-bold mb-4" style="color: #0C3A30;">Our Global Copy Trading Journey</h3>
            
            <div class="timeline-item">
                <div class="timeline-year">2013</div>
                <div class="timeline-content">
                    <h4>Global Vision Born</h4>
                    <p>Market Mind was founded with a worldwide mission — to connect traders across continents through innovative copy trading technology, starting with a distributed team across London, Singapore, and New York.</p>
                    <div class="d-flex align-items-center gap-2 mt-2">
                        <span class="badge px-2 py-1 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2); font-size: 0.7rem;">
                            🌍 London
                        </span>
                        <span class="badge px-2 py-1 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2); font-size: 0.7rem;">
                            🌏 Taiwan
                        </span>
                        <span class="badge px-2 py-1 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2); font-size: 0.7rem;">
                            🌎 United States
                        </span>
                        <span class="badge px-2 py-1 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2); font-size: 0.7rem;">
                            🌍 Germany
                        </span>
                        <span class="badge px-2 py-1 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2); font-size: 0.7rem;">
                            🌏France
                        </span>
                        <span class="badge px-2 py-1 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2); font-size: 0.7rem;">
                            🌎Russia
                        </span>
                        <span class="badge px-2 py-1 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2); font-size: 0.7rem;">
                            🌍 Canada
                        </span>
                        <span class="badge px-2 py-1 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2); font-size: 0.7rem;">
                            🌏 Singapore
                        </span>
                        <span class="badge px-2 py-1 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2); font-size: 0.7rem;">
                            🌎 China
                        </span>
                         <span class="badge px-2 py-1 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2); font-size: 0.7rem;">
                            🌎 All countries +
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-year">2015</div>
                <div class="timeline-content">
                    <h4>Global Copy Trading Network</h4>
                    <p>Launched our first cross-border copy trading protocol, enabling users from 30+ countries to follow and replicate top traders regardless of geographical location.</p>
                    <div class="d-flex align-items-center gap-2 mt-2">
                        <span class="badge px-2 py-1 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2); font-size: 0.7rem;">
                            🌍 30+ Countries
                        </span>
                        <span class="badge px-2 py-1 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2); font-size: 0.7rem;">
                            ⚡ Cross-Border Execution
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-year">2020</div>
                <div class="timeline-content">
                    <h4>Automated-Powered Global Copy Trading</h4>
                    <p>Integrated AI to analyze top trader performance across multiple time zones and markets, providing smart recommendations to a growing international community.</p>
                    <div class="d-flex align-items-center gap-2 mt-2">
                        <span class="badge px-2 py-1 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2); font-size: 0.7rem;">
                            🤖 AI-Powered
                        </span>
                        <span class="badge px-2 py-1 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2); font-size: 0.7rem;">
                            🌐 24/7 Global Markets
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-year">2023</div>
                <div class="timeline-content">
                    <h4>50K+ Global Copy Traders</h4>
                    <p>Today, our community spans over 150 countries with 50,000+ active copy traders, $2.2B in copy-traded volume, and a 4.9/5 rating from our worldwide user base.</p>
                    <div class="d-flex align-items-center gap-2 mt-2">
                        <span class="badge px-2 py-1 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2); font-size: 0.7rem;">
                            👥 100K+ Global Users
                        </span>
                        <span class="badge px-2 py-1 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2); font-size: 0.7rem;">
                            🌍 150+ Countries
                        </span>
                        <span class="badge px-2 py-1 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2); font-size: 0.7rem;">
                            ⭐ 4.9/5 Rating
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Live Global Stats -->
        <div class="d-flex flex-wrap align-items-center justify-content-center gap-4 mt-4 p-3 rounded-4" style="background: rgba(139,201,5,0.03); border: 1px dashed rgba(139,201,5,0.2);">
            <div class="d-flex align-items-center gap-2">
                <span class="pulse-dot"></span>
                <span class="small fw-semibold" style="color: #0C3A30;">🌍 Global Network:</span>
            </div>
            <span class="d-flex align-items-center gap-2"><i class="ri-team-line" style="color: #8BC905;"></i> <span class="small fw-semibold" style="color: #0C3A30;">100K+ Followers Worldwide</span></span>
            <span class="d-flex align-items-center gap-2"><i class="ri-flashlight-fill" style="color: #8BC905;"></i> <span class="small fw-semibold" style="color: #0C3A30;">0.01s Global Execution</span></span>
            <span class="d-flex align-items-center gap-2"><i class="ri-star-fill" style="color: #8BC905;"></i> <span class="small fw-semibold" style="color: #0C3A30;">4.9/5 International Rating</span></span>
        </div>
    </div>
</div>
        
        <!-- Trust Badges -->
        <div class="d-flex flex-wrap align-items-center justify-content-center gap-3 mt-5 pt-4">
             <span class="trust-badge">
                <i class="ri-shield-check-fill" style="color: #8BC905;"></i>
                SEC  Certified
            </span>
            <span class="trust-badge">
                <i class="ri-shield-check-fill" style="color: #8BC905;"></i>
                FCA Regulated
            </span>
            <span class="trust-badge">
                <i class="ri-shield-check-fill" style="color: #8BC905;"></i>
                ISO 27001 Certified
            </span>
            <span class="trust-badge">
                <i class="ri-shield-check-fill" style="color: #8BC905;"></i>
                PCI DSS Compliant
            </span>
            <span class="trust-badge">
                <i class="ri-shield-check-fill" style="color: #8BC905;"></i>
                GDPR Ready
            </span>
        </div>
    </div>
</div>
<!-- End Our Story Section -->

<!-- Start Values Section - Premium -->
<div class="values-area py-5 py-md-6 position-relative overflow-hidden"
     style="background: linear-gradient(145deg, #0C3A30, #062018);">
    
    <!-- Decorative Elements -->
    <div class="position-absolute" style="top: -150px; right: -80px; width: 500px; height: 500px; border-radius: 50%; background: radial-gradient(circle, rgba(139,201,5,0.08) 0%, transparent 70%);"></div>
    <div class="position-absolute" style="bottom: -100px; left: -50px; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(158,221,5,0.06) 0%, transparent 70%);"></div>
    
    <div class="container position-relative" style="max-width: 1280px; margin: 0 auto; z-index: 5;">
        
        <!-- Section Header -->
        <div class="text-center mb-5" data-cues="slideInUp" data-duration="800">
            <div class="d-flex justify-content-center mb-3">
                <span class="badge px-4 py-2 rounded-pill fw-semibold d-inline-flex align-items-center gap-2" 
                      style="background: rgba(139,201,5,0.15); color: #8BC905; border: 1px solid rgba(139,201,5,0.3); backdrop-filter: blur(5px);">
                    <span class="pulse-dot"></span>
                    OUR CORE VALUES
                </span>
            </div>
            
            <h2 class="display-5 fw-bold mb-3 mx-auto text-white" style="max-width: 700px; line-height: 1.2;">
                Built on a Foundation of 
                <span style="color: #8BC905;">Trust & Innovation</span>
            </h2>
        </div>
        
        <!-- Values Grid -->
        <div class="row g-4" data-cues="slideInUp" data-duration="800">
            
            <div class="col-lg-4 col-md-6">
                <div class="p-4 p-xl-5 rounded-4 h-100 text-center" 
                     style="background: rgba(255,255,255,0.05); border: 1px solid rgba(139,201,5,0.15); backdrop-filter: blur(10px); transition: all 0.4s ease;">
                    <div class="d-flex align-items-center justify-content-center rounded-circle mx-auto mb-4" 
                         style="width: 80px; height: 80px; background: rgba(139,201,5,0.15); border: 1px solid rgba(139,201,5,0.3);">
                        <i class="ri-heart-line" style="color: #8BC905; font-size: 2.5rem;"></i>
                    </div>
                    <h3 class="fw-bold mb-3 text-white">Client First</h3>
                    <p class="text-white-80 text-white">Every decision we make puts our clients' interests first. We succeed only when our clients succeed.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="p-4 p-xl-5 rounded-4 h-100 text-center" 
                     style="background: rgba(255,255,255,0.05); border: 1px solid rgba(139,201,5,0.15); backdrop-filter: blur(10px); transition: all 0.4s ease;">
                    <div class="d-flex align-items-center justify-content-center rounded-circle mx-auto mb-4" 
                         style="width: 80px; height: 80px; background: rgba(139,201,5,0.15); border: 1px solid rgba(139,201,5,0.3);">
                        <i class="ri-flashlight-line" style="color: #8BC905; font-size: 2.5rem;"></i>
                    </div>
                    <h3 class="fw-bold mb-3 text-white">Innovation</h3>
                    <p class="text-white-80  text-white   ">We continuously push boundaries to bring the latest technology and insights to our platform.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="p-4 p-xl-5 rounded-4 h-100 text-center" 
                     style="background: rgba(255,255,255,0.05); border: 1px solid rgba(139,201,5,0.15); backdrop-filter: blur(10px); transition: all 0.4s ease;">
                    <div class="d-flex align-items-center justify-content-center rounded-circle mx-auto mb-4" 
                         style="width: 80px; height: 80px; background: rgba(139,201,5,0.15); border: 1px solid rgba(139,201,5,0.3);">
                        <i class="ri-shield-line" style="color: #8BC905; font-size: 2.5rem;"></i>
                    </div>
                    <h3 class="fw-bold mb-3 text-white">Integrity</h3>
                    <p class="text-white-80 text-white">We operate with complete transparency and honesty, building trust through every interaction.</p>
                </div>
            </div>
        </div>
        
        <!-- Bottom CTA -->
        <div class="text-center mt-5 pt-4" data-cues="slideInUp" data-duration="800">
            <a href="{{route('our.services')}}" class="btn-premium">
                <span>Explore Our Services</span>
                <span class="rounded-circle bg-white/20 p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                    <i class="ri-arrow-right-up-line" style="color: #0C3A30; font-size: 1.2rem;"></i>
                </span>
            </a>
            <p class="small text-white-50 mt-3">Join 100,000+ clients who trust us with their financial future</p>
        </div>
    </div>
</div>
<!-- End Values Section -->

@endsection