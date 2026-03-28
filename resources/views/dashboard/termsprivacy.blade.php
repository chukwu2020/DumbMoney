@extends('layout.user')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12" style=" background-image: url('assets/images/hero/hero-image-1.svg'); background-size: cover; background-position: center;">

    <!-- Header Section -->
    <div class="text-center mb-12" >
        <div class="inline-flex items-center gap-2 bg-[#9EDD05]/10 px-4 py-2 rounded-full mb-6 mt-5">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#9EDD05] opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-[#9EDD05]"></span>
            </span>
            <span class="text-xs font-semibold text-[#9EDD05] tracking-wide">LEGAL & COMPLIANCE</span>
        </div>
        
        <h1 class="text-3xl md:text-4xl font-bold mb-4" style="color: #0C3A30;">
            Privacy Policy & Terms of Use
        </h1>
        
        <p class="text-gray-600 max-w-2xl mx-auto">
            Your trust matters to us. Read our policies to understand how we protect your data and what you can expect from ChartMasters Circle.
        </p>
        
        <div class="flex items-center justify-center gap-2 mt-4 text-sm text-gray-500">
            <span>Effective: December 16, 2025</span>
            <span>•</span>
            <span>Last Updated: January 2026</span>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="flex justify-center gap-3 mb-12">
        <button onclick="switchSection('privacy')" id="privacyBtn" class="nav-btn active">
            Privacy Policy
        </button>
        <button onclick="switchSection('terms')" id="termsBtn" class="nav-btn">
            Terms & Conditions
        </button>
        <button onclick="switchSection('eu')" id="euBtn" class="nav-btn">
            EU/UK Data Rights
        </button>
        <button onclick="switchSection('cookies')" id="cookiesBtn" class="nav-btn">
            Cookies Policy
        </button>
    </div>

    <!-- PRIVACY POLICY SECTION -->
    <div id="privacySection" class="section-content active">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-[#9EDD05]/20 flex items-center justify-center">
                        <iconify-icon icon="ph:shield-check" class="text-2xl" style="color: #9EDD05;"></iconify-icon>
                    </div>
                    <h2 class="text-2xl font-bold" style="color: #0C3A30;">Privacy Policy</h2>
                </div>
                
                <p class="text-gray-600 mb-6 leading-relaxed">
                    ChartMasters Circle Investment ("we", "our", or "us") is committed to protecting your privacy and ensuring the security of your personal information. This policy outlines our practices regarding data collection, use, and protection in compliance with global standards including GDPR and international data protection laws.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @foreach ([
                        ['icon' => 'ph:user-circle', 'title' => 'Information We Collect', 'desc' => 'Full name, email address, phone number, government-issued ID, and trading history for account verification and compliance.'],
                        ['icon' => 'ph:target', 'title' => 'Purpose of Data Collection', 'desc' => 'Account management, trade execution, communication, regulatory compliance, and platform improvement.'],
                        ['icon' => 'ph:database', 'title' => 'Data Protection', 'desc' => 'Documents are securely stored with bank-grade encryption and used solely for verification and compliance purposes.'],
                        ['icon' => 'ph:handshake', 'title' => 'Information Sharing', 'desc' => 'Shared only with licensed brokers, liquidity providers, or legal authorities as required by law. Never sold to third parties.'],
                        ['icon' => 'ph:warning-circle', 'title' => 'Trading Risk Disclaimer', 'desc' => 'ChartMasters Circle operates as a copy-trading platform. All trades executed carry financial risk. Past performance does not guarantee future results.'],
                        ['icon' => 'ph:lock-key', 'title' => 'Data Security', 'desc' => 'Bank-grade encryption, multi-factor authentication, and strict access controls protect your information.'],
                        ['icon' => 'ph:clock', 'title' => 'Data Retention', 'desc' => 'Data retained for 5-7 years as required by financial regulations, or as needed for legal and operational purposes.'],
                        ['icon' => 'ph:user-list', 'title' => 'Your Rights', 'desc' => 'Access, correction, deletion, restriction, and withdrawal of consent. Contact our Data Protection Officer to exercise your rights.'],
                        ['icon' => 'ph:crown', 'title' => 'Age Requirement', 'desc' => 'Users must be 18+ and legally allowed to trade in their jurisdiction. Proof of age may be required.'],
                        ['icon' => 'ph:globe', 'title' => 'International Use', 'desc' => 'Trading services operate globally. Data may be transferred internationally with appropriate safeguards in place.'],
                        ['icon' => 'ph:note-pencil', 'title' => 'Policy Updates', 'desc' => 'Material changes are communicated with 30 days notice via email and website notification.'],
                        ['icon' => 'ph:envelope', 'title' => 'Contact Us', 'desc' => 'tradesupport@chartmasterscircle.com | Data Protection Officer available 24/7 for privacy concerns.']
                    ] as $item)
                    <div class="group p-5 rounded-xl border border-gray-100 hover:border-[#9EDD05] hover:shadow-md transition-all duration-300">
                        <div class="flex items-start gap-3">
                            <iconify-icon icon="{{ $item['icon'] }}" class="text-2xl text-[#9EDD05] group-hover:scale-110 transition-transform"></iconify-icon>
                            <div>
                                <h3 class="font-semibold mb-1" style="color: #0C3A30;">{{ $item['title'] }}</h3>
                                <p class="text-sm text-gray-600 leading-relaxed">{{ $item['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-8 p-5 bg-gradient-to-r from-[#9EDD05]/5 to-transparent rounded-xl border-l-4 border-[#9EDD05]">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div>
                            <h4 class="font-semibold" style="color: #0C3A30;">Have privacy questions?</h4>
                            <p class="text-sm text-gray-500">Our Data Protection Officer is here to help</p>
                        </div>
                        <a href="mailto:tradesupport@chartmasterscircle.com" class="px-5 py-2 rounded-lg text-sm font-semibold transition-all" style="background: #9EDD05; color: #0C3A30; hover:background: #8AC304;">
                            Contact DPO
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TERMS & CONDITIONS SECTION -->
    <div id="termsSection" class="section-content hidden">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-[#9EDD05]/20 flex items-center justify-center">
                        <iconify-icon icon="ph:file-text" class="text-2xl" style="color: #9EDD05;"></iconify-icon>
                    </div>
                    <h2 class="text-2xl font-bold" style="color: #0C3A30;">Terms & Conditions</h2>
                </div>
                
                <p class="text-gray-600 mb-6 leading-relaxed">
                    By accessing or using ChartMasters Circle's platform, you agree to be bound by these Terms & Conditions. Please read them carefully before using our services.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @foreach ([
                        ['icon' => 'ph:copy', 'title' => 'Nature of Platform', 'desc' => 'ChartMasters Circle is a copy-trading platform where users can mirror trades from verified professional traders and administrators.'],
                        ['icon' => 'ph:check-circle', 'title' => 'Eligibility', 'desc' => 'Users must be 18+ years old and legally permitted to trade in their jurisdiction. We reserve the right to verify identity.'],
                        ['icon' => 'ph:user-plus', 'title' => 'Account Registration', 'desc' => 'Accurate personal information required. Multiple accounts are prohibited without explicit written permission.'],
                        ['icon' => 'ph:warning-triangle', 'title' => 'Risk Acknowledgment', 'desc' => 'Trading involves substantial financial risk. You may lose more than your initial investment. Past performance does not guarantee future results.'],
                        ['icon' => 'ph:chart-line', 'title' => 'Trading Advice Disclaimer', 'desc' => 'Trades are executed automatically based on copied strategies. This is not personalized financial advice.'],
                        ['icon' => 'ph:user-check', 'title' => 'User Responsibilities', 'desc' => 'You are solely responsible for your account security, trading decisions, and compliance with applicable laws.'],
                        ['icon' => 'ph:prohibit', 'title' => 'Prohibited Conduct', 'desc' => 'No fraud, misrepresentation, market manipulation, unauthorized access, or any illegal activity is permitted.'],
                        ['icon' => 'ph:clock-countdown', 'title' => 'Platform Availability', 'desc' => 'We strive for 99.9% uptime but may experience downtime for maintenance, updates, or unforeseen circumstances.'],
                        ['icon' => 'ph:gavel', 'title' => 'Limitation of Liability', 'desc' => 'ChartMasters Circle is not liable for trading losses, platform interruptions, or decisions made by users.'],
                        ['icon' => 'ph:copyright', 'title' => 'Intellectual Property', 'desc' => 'All platform content, tools, branding, and materials are protected by intellectual property laws.'],
                        ['icon' => 'ph:ban', 'title' => 'Suspension & Termination', 'desc' => 'Accounts may be suspended or terminated for policy violations, fraud, or illegal activity without prior notice.'],
                        ['icon' => 'ph:arrows-clockwise', 'title' => 'Changes to Terms', 'desc' => 'Terms may be updated with 30 days notice. Continued use constitutes acceptance of updated terms.']
                    ] as $item)
                    <div class="group p-5 rounded-xl border border-gray-100 hover:border-[#9EDD05] hover:shadow-md transition-all duration-300">
                        <div class="flex items-start gap-3">
                            <iconify-icon icon="{{ $item['icon'] }}" class="text-2xl text-[#9EDD05] group-hover:scale-110 transition-transform"></iconify-icon>
                            <div>
                                <h3 class="font-semibold mb-1" style="color: #0C3A30;">{{ $item['title'] }}</h3>
                                <p class="text-sm text-gray-600 leading-relaxed">{{ $item['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-8 p-5 bg-amber-50 rounded-xl border-l-4 border-amber-500">
                    <div class="flex items-center gap-3">
                        <iconify-icon icon="ph:warning" class="text-2xl text-amber-600"></iconify-icon>
                        <div>
                            <h4 class="font-semibold text-amber-800">Important Risk Notice</h4>
                            <p class="text-sm text-amber-700">CFDs, forex, and other financial instruments carry a high risk of loss. Only trade with money you can afford to lose. Seek independent financial advice if needed.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- EU/UK DATA RIGHTS SECTION -->
    <div id="euSection" class="section-content hidden">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-[#9EDD05]/20 flex items-center justify-center">
                        <iconify-icon icon="ph:flag" class="text-2xl" style="color: #9EDD05;"></iconify-icon>
                    </div>
                    <h2 class="text-2xl font-bold" style="color: #0C3A30;">EU & UK Data Protection Rights</h2>
                </div>

                <div class="space-y-6">
                    <div class="p-5 bg-gray-50 rounded-xl">
                        <h3 class="font-semibold mb-3" style="color: #0C3A30;">Your Rights Under GDPR</h3>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start gap-2">• <strong>Right to Access:</strong> Request a copy of your personal data</li>
                            <li class="flex items-start gap-2">• <strong>Right to Rectification:</strong> Correct inaccurate or incomplete data</li>
                            <li class="flex items-start gap-2">• <strong>Right to Erasure:</strong> Request deletion of your data (subject to legal requirements)</li>
                            <li class="flex items-start gap-2">• <strong>Right to Restrict Processing:</strong> Limit how we use your data</li>
                            <li class="flex items-start gap-2">• <strong>Right to Data Portability:</strong> Receive your data in a structured format</li>
                            <li class="flex items-start gap-2">• <strong>Right to Object:</strong> Object to processing based on legitimate interests</li>
                        </ul>
                    </div>

                    <div class="p-5 bg-blue-50 rounded-xl">
                        <h3 class="font-semibold mb-3" style="color: #0C3A30;">Legal Basis for Processing</h3>
                        <p class="text-gray-600 mb-3">We process your personal data based on:</p>
                        <ul class="space-y-1 text-gray-600">
                            <li>• Your explicit consent</li>
                            <li>• Performance of a contract (trading services)</li>
                            <li>• Compliance with legal obligations (financial regulations)</li>
                            <li>• Our legitimate interests (platform security and improvement)</li>
                        </ul>
                    </div>

                    <div class="p-5 rounded-xl" style="background: #9EDD05/5;">
                        <h3 class="font-semibold mb-2" style="color: #0C3A30;">Data Transfers</h3>
                        <p class="text-gray-600">Your data may be transferred outside the EU/UK with appropriate safeguards including Standard Contractual Clauses and Privacy Shield frameworks.</p>
                    </div>

                    <div class="p-5 bg-gray-50 rounded-xl">
                        <h3 class="font-semibold mb-2" style="color: #0C3A30;">Supervisory Authority</h3>
                        <p class="text-gray-600">You have the right to lodge a complaint with your local Data Protection Authority if you believe your rights have been violated.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- COOKIES POLICY SECTION -->
    <div id="cookiesSection" class="section-content hidden">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-[#9EDD05]/20 flex items-center justify-center">
                        <iconify-icon icon="ph:cookie" class="text-2xl" style="color: #9EDD05;"></iconify-icon>
                    </div>
                    <h2 class="text-2xl font-bold" style="color: #0C3A30;">Cookies Policy</h2>
                </div>

                <div class="space-y-6">
                    <p class="text-gray-600">We use cookies and similar technologies to enhance your experience, analyze platform usage, and ensure security.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 border rounded-lg">
                            <h3 class="font-semibold mb-2">Essential Cookies</h3>
                            <p class="text-sm text-gray-500">Required for platform functionality, authentication, and security. Cannot be disabled.</p>
                        </div>
                        <div class="p-4 border rounded-lg">
                            <h3 class="font-semibold mb-2">Analytics Cookies</h3>
                            <p class="text-sm text-gray-500">Help us understand how users interact with our platform to improve services.</p>
                        </div>
                        <div class="p-4 border rounded-lg">
                            <h3 class="font-semibold mb-2">Functional Cookies</h3>
                            <p class="text-sm text-gray-500">Remember your preferences and personalize your experience.</p>
                        </div>
                        <div class="p-4 border rounded-lg">
                            <h3 class="font-semibold mb-2">Advertising Cookies</h3>
                            <p class="text-sm text-gray-500">Used to deliver relevant advertisements and measure campaign effectiveness.</p>
                        </div>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-semibold mb-2">Manage Your Cookies</h3>
                        <p class="text-sm text-gray-600">You can control cookies through your browser settings. Note that disabling essential cookies may affect platform functionality.</p>
                    </div>

                    <div class="p-4 mt-8 rounded-lg" style="background: #9EDD05/5;">
                        <h3 class="font-semibold mb-4">Third-Party Tools</h3>
                        <p class="text-sm text-gray-600">We use Google Analytics, Facebook Pixel, and other tools for analytics and advertising. These tools set their own cookies subject to their privacy policies.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Contact -->
    <div class="mt-12 text-center border-t border-gray-100 pt-8">
        <p class="text-sm text-gray-500">For any questions regarding these policies, please contact us:</p>
        <div class="flex justify-center gap-4 mt-3">
            <a href="mailto:tradesupport@chartmasterscircle.com" class="text-sm" style="color: #9EDD05;">tradesupport@chartmasterscircle.com</a>
            <span>•</span>
            <a href="mailto:tradesupport@chartmasterscircle.com" class="text-sm" style="color: #9EDD05;">tradesupport@chartmasterscircle.com</a> 
        </div>
        <p class="text-xs text-gray-400 mt-4">© 2025 ChartMasters Circle Investment. All rights reserved.</p>
    </div>
</div>

<style>
    .nav-btn {
        padding: 0.6rem 1.5rem;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
        background: #f3f4f6;
        color: #4b5563;
    }
    
    .nav-btn.active {
        background: #9EDD05;
        color: #0C3A30;
        box-shadow: 0 4px 12px rgba(158, 221, 5, 0.3);
    }
    
    .nav-btn:hover:not(.active) {
        background: #e5e7eb;
        transform: translateY(-1px);
    }
    
    .section-content {
        display: none;
        animation: fadeIn 0.3s ease;
    }
    
    .section-content.active {
        display: block;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes ping {
        75%, 100% { transform: scale(2); opacity: 0; }
    }
    
    .animate-ping {
        animation: ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
    }
</style>

<script>
    function switchSection(section) {
        // Hide all sections
        document.querySelectorAll('.section-content').forEach(el => el.classList.remove('active'));
        
        // Show selected section
        document.getElementById(`${section}Section`).classList.add('active');
        
        // Update active button state
        document.querySelectorAll('.nav-btn').forEach(btn => btn.classList.remove('active'));
        document.getElementById(`${section}Btn`).classList.add('active');
        
        // Smooth scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>

<style>
    /* General heading styles - adjust all at once */
    h1, h2, h3, h4, h5, h6 {
        color: #0C3A30 !important;
    }
    
    /* Main page title */
    h1 {
        font-size: 1.5rem !important; /* 24px - adjust as needed */
        font-weight: 700 !important;
    }
    
    /* Section titles (Privacy Policy, Terms & Conditions, etc.) */
    h2 {
        font-size: 1.25rem !important; /* 20px */
        font-weight: 700 !important;
    }
    
    /* Card titles */
    h3 {
        font-size: 1rem !important; /* 16px */
        font-weight: 600 !important;
        margin-bottom: 0.25rem !important;
    }
    
    /* Smaller headings if needed */
    h4 {
        font-size: 0.875rem !important; /* 14px */
        font-weight: 600 !important;
    }
    
    /* Responsive adjustments */
    @media (min-width: 768px) {
        h1 {
            font-size: 1.875rem !important; /* 30px on desktop */
        }
        h2 {
            font-size: 1.5rem !important; /* 24px on desktop */
        }
        h3 {
            font-size: 1.125rem !important; /* 18px on desktop */
        }
    }
    
    /* Optional: Style all heading icons to match */
    .section-icon, 
    .card-icon,
    [class*="icon"] {
        font-size: 1.5rem !important;
    }
</style>
@endsection