@extends('layout.app')

@section('content')

<style>
    /* Premium Contact Page Styles */
    .contact-page {
        background: linear-gradient(145deg, #ffffff, #f9fbf9);
        position: relative;
        overflow: hidden;
    }
    
    /* Decorative Elements */
    .contact-page::before {
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
    
    .contact-page::after {
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
    
    /* Alert Styles */
    .alert-premium {
        border-radius: 16px;
        padding: 1rem 1.5rem;
        margin-bottom: 2rem;
        border-left: 4px solid;
        background: white;
        box-shadow: 0 10px 25px -10px rgba(0,0,0,0.1);
    }
    
    .alert-premium-success {
        border-left-color: #8BC905;
    }
    
    .alert-premium-danger {
        border-left-color: #dc3545;
    }
    
    .alert-premium ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    /* Address Cards */
    .address-container {
        background: linear-gradient(145deg, #0C3A30, #062018);
        border-radius: 32px;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(139,201,5,0.2);
        box-shadow: 0 30px 50px -20px rgba(12,58,48,0.3);
    }
    
    .address-container::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(139,201,5,0.1) 0%, transparent 70%);
        pointer-events: none;
    }
    
    .contact-warp {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        position: relative;
        z-index: 2;
    }
    
    .location {
        background: rgba(255,255,255,0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(139,201,5,0.15);
        border-radius: 24px;
        padding: 2rem 1.5rem;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        overflow: hidden;
    }
    
    .location:hover {
        transform: translateY(-10px);
        background: rgba(255,255,255,0.1);
        border-color: rgba(139,201,5,0.4);
        box-shadow: 0 20px 30px -12px rgba(0,0,0,0.3);
    }
    
    .location i {
        font-size: 2.5rem;
        color: #8BC905;
        margin-bottom: 1rem;
        display: inline-block;
        transition: all 0.3s ease;
    }
    
    .location:hover i {
        transform: scale(1.2);
        color: #fff;
    }
    
    .location span {
        display: block;
        color: rgba(255,255,255,0.7);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }
    
    .location a {
        color: white;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        display: inline-block;
    }
    
    .location a:hover {
        color: #8BC905;
        transform: translateX(5px);
    }
    
    /* Form Styles */
    .contact-form {
        background: white;
        border-radius: 32px;
        padding: 2.5rem;
        box-shadow: 0 30px 50px -20px rgba(0,0,0,0.1);
        border: 1px solid rgba(139,201,5,0.1);
        transition: all 0.3s ease;
    }
    
    .contact-form:hover {
        border-color: rgba(139,201,5,0.3);
        box-shadow: 0 40px 60px -20px rgba(139,201,5,0.15);
    }
    
    .form-control {
        border: 1px solid rgba(0,0,0,0.1);
        border-radius: 16px;
        padding: 1rem 1.25rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8fafc;
    }
    
    .form-control:focus {
        border-color: #8BC905;
        box-shadow: 0 0 0 4px rgba(139,201,5,0.1);
        outline: none;
        background: white;
    }
    
    .form-control::placeholder {
        color: #a0aec0;
    }
    
    textarea.form-control {
        min-height: 140px;
        resize: vertical;
    }
    
    /* Submit Button */
    .btn-premium {
        background: linear-gradient(145deg, #8BC905, #7AB805);
        color: #0C3A30;
        border: none;
        padding: 1rem 2.5rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        display: inline-flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 20px 30px -10px rgba(139,201,5,0.3);
        margin-top: 1rem;
        cursor: pointer;
    }
    
    .btn-premium:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 40px -12px rgba(139,201,5,0.4);
        color: #0C3A30;
    }
    
    .btn-premium i {
        transition: all 0.3s ease;
    }
    
    .btn-premium:hover i {
        transform: translateX(5px) translateY(-3px);
    }
    
    /* Section Title */
    .section-title {
        margin-bottom: 3rem;
    }
    
    .section-title .sub-title {
        background: linear-gradient(145deg, #0C3A30, #0A2A23);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        display: inline-block;
        margin-bottom: 1rem;
        border: 1px solid rgba(139,201,5,0.4);
        box-shadow: 0 10px 20px -8px rgba(10,42,35,0.2);
    }
    
    .section-title h2 {
        color: #0C3A30;
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1.2;
        max-width: 600px;
    }
    
    /* Responsive */
    @media (max-width: 991px) {
        .contact-warp {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .location {
            padding: 1.5rem;
        }
        
        .section-title h2 {
            font-size: 2rem;
        }
        
        .contact-form {
            padding: 1.5rem;
        }
    }
    
    @media (max-width: 767px) {
        .address-container {
            padding: 1rem;
        }
        
        .location i {
            font-size: 2rem;
        }
        
        .location a {
            font-size: 1rem;
        }
        
        .btn-premium {
            width: 100%;
            justify-content: center;
        }
    }
    
    /* Map Container */
    .contact-map {
        background: linear-gradient(145deg, #0C3A30, #062018);
        border-radius: 32px;
        height: 100%;
        min-height: 300px;
        border: 1px solid rgba(139,201,5,0.2);
        position: relative;
        overflow: hidden;
    }
    
    .contact-map::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cpath d=\"M30 0 L30 60 M0 30 L60 30 M15 15 L45 45 M45 15 L15 45\" stroke=\"%238BC905\" stroke-width=\"0.5\" opacity=\"0.1\" /%3E%3C/svg%3E');
        background-size: 40px 40px;
        pointer-events: none;
    }
    
    .map-content {
        position: relative;
        z-index: 2;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        text-align: center;
    }
    
    .map-content i {
        font-size: 3rem;
        color: #8BC905;
        margin-bottom: 1rem;
    }
    
    .map-content h4 {
        color: white;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .map-content p {
        color: rgba(255,255,255,0.7);
        margin-bottom: 1.5rem;
    }
    
    .map-badge {
        background: rgba(139,201,5,0.15);
        border: 1px solid rgba(139,201,5,0.3);
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
</style>

<!-- Start Contact Page - Premium Redesign -->
<div class="contact-page ptb-120 position-relative overflow-hidden">

    <!-- Pattern Overlay -->
    <div class="pattern-overlay"></div>

    <div class="container position-relative" style="z-index: 10;">

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="alert-premium alert-premium-success d-flex align-items-center gap-3">
            <i class="ri-checkbox-circle-fill" style="color: #8BC905; font-size: 1.5rem;"></i>
            <span style="color: #0C3A30; font-weight: 500;">{{ session('success') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div class="alert-premium alert-premium-danger">
            <div class="d-flex align-items-center gap-3 mb-2">
                <i class="ri-error-warning-fill" style="color: #dc3545; font-size: 1.5rem;"></i>
                <span style="color: #0C3A30; font-weight: 600;">Please fix the following errors:</span>
            </div>
            <ul class="ps-4">
                @foreach($errors->all() as $error)
                    <li style="color: #dc3545;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

   <!-- Contact Address Area -->
<div class="contact-address-area mb-5">
    <div class="container">
        <div class="row g-4">

            <!-- Phone -->
            <div class="col-md-4">
                <div class="contact-card p-4 rounded-4 text-center shadow-sm" style="background: rgba(139,201,5,0.04); border:1px solid rgba(139,201,5,0.1);">
                    <i class="flaticon-phone-call call-icon fs-3 mb-2" style="color:#8BC905;"></i>
                    <h6 class="fw-semibold text-dark mb-1">PHONE NUMBER</h6>
                    <a href="tel:+4477742663627" class="d-block text-decoration-none fw-bold" style="color:#0C3A30;">+447 742 (663) 627</a>
                    <span class="badge mt-2 px-2 py-1" style="background: rgba(139,201,5,0.2); color: #8BC905; font-size:0.7rem;">24/7 Support</span>
                </div>
            </div>

            <!-- Email -->
            <div class="col-md-4">
                <div class="contact-card p-4 rounded-4 text-center shadow-sm" style="background: rgba(139,201,5,0.04); border:1px solid rgba(139,201,5,0.1);">
                    <i class="flaticon-email-1 call-icon fs-3 mb-2" style="color:#8BC905;"></i>
                    <h6 class="fw-semibold text-dark mb-1">EMAIL ADDRESS</h6>
                    <a href="mailto:support@chartmasterscircle.com" class="d-block text-decoration-none fw-bold" style="color:#0C3A30;">chartmasterscircle@gmail.com</a>
                    <span class="badge mt-2 px-2 py-1" style="background: rgba(139,201,5,0.2); color: #8BC905; font-size:0.7rem;">Reply within 1hr</span>
                </div>
            </div>

            <!-- Headquarters -->
            <div class="col-md-4">
                <div class="contact-card p-4 rounded-4 text-center shadow-sm" style="background: rgba(139,201,5,0.04); border:1px solid rgba(139,201,5,0.1);">
                    <i class="flaticon-maps-and-flags call-icon fs-3 mb-2" style="color:#8BC905;"></i>
                    <h6 class="fw-semibold text-dark mb-1">GLOBAL HEADQUARTERS</h6>
                    <a href="#" target="_blank" class="d-block text-decoration-none fw-bold" style="color:#0C3A30;">WORLDWIDE</a>
                    <span class="badge mt-2 px-2 py-1" style="background: rgba(139,201,5,0.2); color: #8BC905; font-size:0.7rem;">30+ Countries</span>
                </div>
            </div>

        </div>

        <!-- Live Support Indicator -->
        <div class="d-flex align-items-center justify-content-center gap-2 mt-4 pt-3">
            <span class="pulse-dot" style="display:inline-block;width:10px;height:10px;background:#8BC905;border-radius:50%;animation:pulse 2s infinite;"></span>
            <span class="small text-white-50 text-center">Our support team is online 24/7, ready to help with your copy trading questions</span>
        </div>
    </div>
</div>
<!-- End Contact Address Area -->

        <!-- Start Contact Form Area -->
        <div class="contact-form-area">
            <div class="row align-items-center g-4">
                
                <!-- Form Column -->
                <div class="col-lg-8 col-md-12" data-cues="slideInUp" data-duration="800">
                    
                    <!-- Section Title -->
                    <div class="section-title">
                        <span class="sub-title">
                            <span class="pulse-dot me-2"></span>
                            GET IN TOUCH
                        </span>
                        <h2>Ready to Start Your <span class="highlight-underline"> Trading</span> Journey?</h2>
                        <p class="text-secondary" style="color: #4A5C5A !important;">Have questions about copying expert traders? We're here to help 24/7.</p>
                    </div>

                    <form method="POST" action="{{ route('user.contact.send') }}" class="contact-form">
                        @csrf
                        
                        <div class="row g-3">
                            <div class="col-lg-6 col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Your Full Name" value="{{ old('name') }}" required>
                            </div>
                            
                            <div class="col-lg-6 col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}" required>
                            </div>
                            
                            <div class="col-lg-6 col-md-6">
                                <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" class="form-control">
                            </div>
                            
                            <div class="col-lg-6 col-md-6">
                                <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" required placeholder="Subject">
                            </div>
                            
                            <div class="col-lg-12 col-md-12">
                                <textarea class="form-control textarea" name="message" required placeholder="Tell us about your trading interests...">{{ old('message') }}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn-premium">
                            <span>Send Message</span>
                            <i class="ri-arrow-right-up-line"></i>
                        </button>
                        
                        <p class="small text-secondary mt-3 mb-0">
                            <i class="ri-shield-check-fill" style="color: #8BC905;"></i>
                            Your information is secure and will not be shared
                        </p>
                    </form>
                </div>

                <!-- Map/Info Column -->
                <div class="col-lg-4 col-md-12" data-cues="slideInDown" data-duration="800">
                    <div class="contact-map">
                        <div class="map-content">
                            <i class="flaticon-maps-and-flags"></i>
                            <h4>Global Presence</h4>
                            <p>Serving copy traders in 150+ countries worldwide</p>
                            
                            <div class="map-badge">
                                <i class="ri-time-line"></i>
                                <span>24/7 Support</span>
                            </div>
                            
                            <!-- Quick Stats -->
                            <div class="mt-4 w-100">
                                <div class="d-flex justify-content-between text-white-50 small mb-2">
                                    <span>Active  Traders</span>
                                    <span class="text-white">100K+</span>
                                </div>
                                <div class="d-flex justify-content-between text-white-50 small mb-2">
                                    <span>Countries Served</span>
                                    <span class="text-white">150+</span>
                                </div>
                                <div class="d-flex justify-content-between text-white-50 small">
                                    <span>Avg. Response Time</span>
                                    <span class="text-white">< 1 hours</span>
                                </div>
                            </div>
                            
                            <!-- Trust Badge -->
                            <div class="mt-4">
                                <span class="trust-badge" style="background: rgba(139,201,5,0.1); color: white; border-color: rgba(139,201,5,0.3);">
                                    <i class="ri-star-fill" style="color: #FFB800;"></i>
                                    4.9/5 from 2,500+ traders
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Contact Form Area -->

        <!-- Trust Badges Row -->
        <div class="d-flex flex-wrap align-items-center justify-content-center gap-3 mt-5 pt-4">
            <span class="trust-badge">
                <i class="ri-shield-check-fill" style="color: #8BC905;"></i>
                SSL Secured
            </span>
            <span class="trust-badge">
                <i class="ri-lock-fill" style="color: #8BC905;"></i>
                Data Protected
            </span>
             <span class="trust-badge">
                <i class="ri-shield-check-fill" style="color: #8BC905;"></i>
                SEC Certified
            </span>
            <span class="trust-badge">
                <i class="ri-customer-service-fill" style="color: #8BC905;"></i>
                24/7 Support
            </span>
            <span class="trust-badge">
                <i class="ri-global-fill" style="color: #8BC905;"></i>
                Global Team
            </span>
        </div>

    </div>
</div>
<style>
    .trust-badge {
    background: rgba(139,201,5,0.08);
    border: 1px solid rgba(139,201,5,0.15);
    border-radius: 50px;
    padding: 0.5rem 1.2rem;
    font-size: 0.9rem;
    color: #0C3A30;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.trust-badge:hover {
    background: rgba(139,201,5,0.15);
    border-color: rgba(139,201,5,0.3);
    transform: translateY(-2px);
}
</style>
<!-- End Contact Page - Premium Redesign -->

@endsection