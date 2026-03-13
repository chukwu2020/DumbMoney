@extends('layout.user')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20">

  <!-- ================= ABOUT US SECTION ================= -->
<div class="mb-16 text-center">
    <!-- Badge -->
    <div class="inline-flex items-center gap-2 bg-[#8bc905]/10 px-3 py-4 rounded-full mb-6">
        <span class="relative flex h-2.5 w-2.5">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#8bc905] opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-[#8bc905]"></span>
        </span>
        <span class="text-xs font-semibold text-[#8bc905] tracking-wide">ABOUT MARKETMIND</span>
    </div>

    <!-- Title -->
    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3 leading-snug">
        Where Innovation Meets
        <span class="text-[#8bc905]">Trust</span>
    </h1>

    <!-- Description -->
    <p class="text-base md:text-lg text-gray-600 max-w-3xl mx-auto mb-8 leading-relaxed">
        MarketMind is a cutting-edge financial education platform dedicated to empowering traders
        with intelligent tools, real-time insights, and a community-driven approach to modern investing.
    </p>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-3xl mx-auto mt-8">
        <div class="text-center">
            <div class="text-2xl md:text-3xl font-bold text-[#8bc905]">50K+</div>
            <div class="text-xs md:text-sm text-gray-500 uppercase tracking-wide mt-1">Active Users</div>
        </div>
        <div class="text-center">
            <div class="text-2xl md:text-3xl font-bold text-[#8bc905]">150+</div>
            <div class="text-xs md:text-sm text-gray-500 uppercase tracking-wide mt-1">Countries</div>
        </div>
        <div class="text-center">
            <div class="text-2xl md:text-3xl font-bold text-[#8bc905]">$2.4B+</div>
            <div class="text-xs md:text-sm text-gray-500 uppercase tracking-wide mt-1">Volume Traded</div>
        </div>
        <div class="text-center">
            <div class="text-2xl md:text-3xl font-bold text-[#8bc905]">24/7</div>
            <div class="text-xs md:text-sm text-gray-500 uppercase tracking-wide mt-1">Support</div>
        </div>
    </div>

    <!-- Divider -->
    <div class="w-20 h-1 bg-gradient-to-r from-[#8bc905] to-transparent mx-auto mt-10 rounded"></div>
</div>

<!-- ================= QUICK NAV ================= -->
<div class="flex justify-center gap-3 mb-12 quick-nav">
    <a href="#privacy" class="quick-nav-btn active">Privacy Policy</a>
    <a href="#terms" class="quick-nav-btn">Terms & Conditions</a>
</div>

<style>
/* ===== Quick Nav Buttons ===== */
.quick-nav-btn {
    padding: 0.5rem 1.25rem !important; /* px-5 py-2 */
    border-radius: 9999px !important; /* fully rounded */
    font-size: 0.875rem !important; /* text-sm */
    font-weight: 500 !important; /* medium */
    text-align: center !important;
    text-decoration: none !important;
    transition: all 0.3s ease !important;
    cursor: pointer !important;
    display: inline-block !important;
}

/* ===== Active Button ===== */
.quick-nav-btn.active {
    background-color: #9EDD05 !important; /* brand green */
    color: #0C3A30 !important; /* dark text */
    box-shadow: 0 4px 10px rgba(156, 221, 5, 0.3) !important;
}

/* ===== Inactive Button ===== */
.quick-nav-btn:not(.active) {
    background-color: #E5E7EB !important; /* gray-100 */
    color: #4B5563 !important; /* gray-700 */
    box-shadow: 0 2px 4px rgba(0,0,0,0.05) !important;
}

/* Hover effect for all buttons */
.quick-nav-btn:hover {
    transform: translateY(-2px) scale(1.05) !important;
}

/* Hover colors */
.quick-nav-btn.active:hover {
    background-color: #8BC905 !important; /* brighter brand green */
    box-shadow: 0 6px 12px rgba(156, 221, 5, 0.4) !important;
}

.quick-nav-btn:not(.active):hover {
    background-color: #D1D5DB !important; /* slightly darker gray */
    box-shadow: 0 3px 6px rgba(0,0,0,0.1) !important;
}

/* Click / pressed effect */
.quick-nav-btn:active {
    transform: scale(0.95) !important;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
}

/* Mobile responsive */
@media (max-width: 768px) {
    .quick-nav-btn {
        font-size: 0.75rem !important;
        padding: 0.4rem 1rem !important;
    }
}
</style>

    <!-- ================= PRIVACY POLICY ================= -->
    <section id="privacy" class="scroll-mt-28 mb-16">
        <div class="flex items-center gap-4 mb-6">
            <h2 class="text-3xl font-bold text-gray-900">Privacy Policy</h2>
            <div class="flex-1 h-px bg-gradient-to-r from-[#8bc905] to-transparent"></div>
            <span class="text-sm px-3 py-1 bg-[#8bc905]/10 text-[#8bc905] rounded-full font-medium">GDPR Compliant</span>
        </div>

        <p class="text-sm text-gray-500 mb-8 flex items-center gap-2">
            Effective Date: December 16, 2025 • Last Updated: January 2026
        </p>

        <div class="prose prose-sm max-w-none text-gray-600 mb-8">
            <p>MarketMind Investment (“we”, “our”, or “us”) is committed to protecting your privacy and ensuring the security of your personal information. This policy outlines our practices regarding data collection, use, and protection.</p>
        </div>

        <!-- Grid Layout for Privacy Items -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @foreach ([
        ['icon'=>'🔐','title'=>'Information We Collect','desc'=>'Full name, email, phone, government-issued ID for account verification.'],
        ['icon'=>'🎯','title'=>'Purpose of Data Collection','desc'=>'Account management, trade execution, communication, and compliance.'],
        ['icon'=>'🛡️','title'=>'Use & Protection of Documents','desc'=>'Documents are securely stored and used solely for verification and compliance purposes.'],
        ['icon'=>'🤝','title'=>'Information Sharing','desc'=>'Shared only with brokers, liquidity providers, or legal authorities as required.'],
        ['icon'=>'⚠️','title'=>'Trading & Regulatory Disclaimer','desc'=>'MarketMind operates as a copy-trading broker. All trades executed on your account carry risk. Past performance is not indicative of future results.'],
        ['icon'=>'🔒','title'=>'Data Security','desc'=>'We use bank-grade encryption and strict access control to protect your information.'],
        ['icon'=>'⏳','title'=>'Data Retention','desc'=>'Data is retained only as long as necessary for legal, regulatory, and operational purposes.'],
        ['icon'=>'⚖️','title'=>'User Rights','desc'=>'Access, correction, deletion, restriction, and withdrawal of consent in accordance with GDPR.'],
        ['icon'=>'👤','title'=>'Age Requirement','desc'=>'Users must be 16+ and legally allowed to trade in their jurisdiction.'],
        ['icon'=>'🌍','title'=>'International Use','desc'=>'Trading services may operate across different jurisdictions subject to local laws.'],
        ['icon'=>'📝','title'=>'Policy Updates','desc'=>'Updates are posted on the website with 30 days notice where possible.'],
        ['icon'=>'📧','title'=>'Contact','desc'=>'officialmarketmind@gmail.com']
    ] as $item)
    <div class="group bg-white p-4 md:p-5 rounded-xl border border-gray-200 hover:border-[#8bc905] hover:shadow-lg transition-all duration-300">
        <div class="flex items-start gap-3">
            <span class="text-2xl group-hover:scale-110 transition-transform duration-300">{{ $item['icon'] }}</span>
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-1">{{ $item['title'] }}</h3>
                <p class="text-sm text-gray-600">{{ $item['desc'] }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
        <!-- Contact Card -->
        <div class="mt-8 bg-gradient-to-r from-[#8bc905]/5 to-transparent p-6 rounded-xl border border-[#8bc905]/20">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-[#8bc905] rounded-full flex items-center justify-center text-white font-bold text-xl">?</div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Have privacy questions?</h4>
                        <p class="text-sm text-gray-500">Our Data Protection Officer is here to help</p>
                    </div>
                </div>
                <a href="mailto:privacy@marketmind.com" class="px-6 py-2 bg-[#8bc905] text-white rounded-full text-sm font-semibold hover:bg-[#7ab805] transition-colors">
                    Contact DPO
                </a>
            </div>
        </div>
    </section>

    <!-- ================= TERMS & CONDITIONS ================= -->
    <section id="terms" class="scroll-mt-28 mb-12">
        <div class="flex items-center gap-4 mb-6">
            <h2 class="text-3xl font-bold text-gray-900">Terms & Conditions</h2>
            <div class="flex-1 h-px bg-gradient-to-r from-[#8bc905] to-transparent"></div>
            <span class="text-sm px-3 py-1 bg-[#8bc905]/10 text-[#8bc905] rounded-full font-medium">v2.1.0</span>
        </div>

        <p class="text-sm text-gray-500 mb-8">
            Effective Date: December 16, 2025 • Version 2.1
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @foreach ([
        ['icon'=>'📱','title'=>'Nature of the Platform','desc'=>'MarketMind is a copy-trading broker platform where users can mirror trades from selected admins.'],
        ['icon'=>'✅','title'=>'Eligibility','desc'=>'Users must be 16+ and legally allowed to trade in their jurisdiction.'],
        ['icon'=>'📝','title'=>'Account Registration','desc'=>'Accurate personal information is required for account verification and trading.'],
        ['icon'=>'⚠️','title'=>'Risk Acknowledgment','desc'=>'Trading involves real financial risk. Past performance does not guarantee future results.'],
        ['icon'=>'📚','title'=>'Trading Advice','desc'=>'Trades are executed automatically based on copied admins; this is not personalized financial advice.'],
        ['icon'=>'👤','title'=>'User Responsibilities','desc'=>'Users are responsible for their own account, funds, and compliance with applicable laws.'],
        ['icon'=>'🚫','title'=>'Prohibited Conduct','desc'=>'No fraud, misrepresentation, unauthorized access, or security compromise is allowed.'],
        ['icon'=>'⏰','title'=>'Platform Availability','desc'=>'The platform may be temporarily unavailable for maintenance or updates.'],
        ['icon'=>'⚖️','title'=>'Limitation of Liability','desc'=>'MarketMind is not liable for trading losses or decisions made by users.'],
        ['icon'=>'©️','title'=>'Intellectual Property','desc'=>'All platform content, tools, and materials are protected by intellectual property law.'],
        ['icon'=>'🔨','title'=>'Suspension & Termination','desc'=>'Accounts may be suspended or terminated for violations of the Terms.'],
        ['icon'=>'🔄','title'=>'Changes to Terms','desc'=>'Terms may be updated with at least 30 days notice, posted on the website.'],
        ['icon'=>'📧','title'=>'Contact','desc'=>'marketmindinvestments@gmail.com']
    ] as $item)
    <div class="group bg-white p-4 md:p-5 rounded-xl border border-gray-200 hover:border-[#8bc905] hover:shadow-lg transition-all duration-300">
        <div class="flex items-start gap-3">
            <span class="text-2xl group-hover:scale-110 transition-transform duration-300">{{ $item['icon'] }}</span>
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-1">{{ $item['title'] }}</h3>
                <p class="text-sm text-gray-600">{{ $item['desc'] }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
    </section>
</div>

<style>
    html {
        scroll-behavior: smooth;
        scroll-padding-top: 7rem;
    }

    .animate-ping {
        animation: ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
    }

    @keyframes ping {

        75%,
        100% {
            transform: scale(2);
            opacity: 0;
        }
    }

    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }

    .transition-all {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>

<script>
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    });
</script>
@endsection