@extends('layout.user')

@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-6 py-10 relative z-10">
     <!-- Header Section -->
   

      <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
            <h4 class="font-semibold text-lg md:text-xl" style="color: #0C3A30;">Rules & Guidelines</h4>
            <ul class="flex items-center gap-[6px]">
                <li class="font-medium">
                    <a href="{{ route('user_dashboard') }}" class="flex items-center gap-2" onmouseover="this.style.color='#9EDD05';" onmouseout="this.style.color='#0C3A30';">
                      <iconify-icon style="color: green !important;" icon="solar:shield-keyhole-linear" class="text-[#0C3A30]"></iconify-icon>
                        Dashboard
                    </a>
                </li>
                
            </ul>
        </div>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-10 relative z-10" style="background-image: url(assets/images/hero/hero-image-1.svg); background-repeat: no-repeat; background-size: cover; background-position:center;">
   

    <!-- Introduction Card -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8 border-l-4 border-[#0C3A30]">
        <h2 class="text-xl font-semibold text-[#0C3A30] mb-3">Market Mind Investments – Rules & Guidelines</h2>
        <p class="text-gray-700">
            At Market Mind Investments, we believe in transparency, growth, and building a trusted community for all our investors. 
            Below you will find the core rules of operation as well as the qualifications and benefits that come with each of our structured investment plans.
        </p>
    </div>

    <!-- Rules Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <!-- Legitimacy & Security -->
        <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 rounded-full bg-[#E8F5E9] flex items-center justify-center mr-3">
                    <iconify-icon icon="mdi:security" class="text-xl text-[#0C3A30]"></iconify-icon>
                </div>
                <h3 class="text-lg font-semibold text-[#0C3A30]">Legitimacy & Security</h3>
            </div>
            <ul class="space-y-2 text-gray-700">
                <li class="flex items-start">
                    <iconify-icon icon="ic:round-check" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                    <span>Market Mind Investments operates under the Worldwide government framework.</span>
                </li>
                <li class="flex items-start">
                    <iconify-icon icon="ic:round-check" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                    <span>Our platform is co-managed by trusted administrators to ensure legitimacy.</span>
                </li>
                <li class="flex items-start">
                    <iconify-icon icon="ic:round-check" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                    <span>All client data and funds are secured under regulated systems.</span>
                </li>
            </ul>
        </div>

        <!-- Membership & Community -->
        <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 rounded-full bg-[#E8F5E9] flex items-center justify-center mr-3">
                    <iconify-icon icon="mdi:account-group" class="text-xl text-[#0C3A30]"></iconify-icon>
                </div>
                <h3 class="text-lg font-semibold text-[#0C3A30]">Membership & Community</h3>
            </div>
            <ul class="space-y-2 text-gray-700">
                <li class="flex items-start">
                    <iconify-icon icon="ic:round-check" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                    <span>Every user who joins becomes part of our investor community.</span>
                </li>
                <li class="flex items-start">
                    <iconify-icon icon="ic:round-check" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                    <span>Purchasing a plan is the first step toward becoming a full member.</span>
                </li>
                <li class="flex items-start">
                    <iconify-icon icon="ic:round-check" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                    <span>Full participation is unlocked with higher plans.</span>
                </li>
            </ul>
        </div>

        <!-- Deposits & Withdrawals -->
        <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 rounded-full bg-[#E8F5E9] flex items-center justify-center mr-3">
                    <iconify-icon icon="mdi:cash-sync" class="text-xl text-[#0C3A30]"></iconify-icon>
                </div>
                <h3 class="text-lg font-semibold text-[#0C3A30]">Deposits & Withdrawals</h3>
            </div>
            <ul class="space-y-2 text-gray-700">
                <li class="flex items-start">
                    <iconify-icon icon="ic:round-check" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                    <span>Deposits must be made using the wallet addresses provided by the platform.</span>
                </li>
                <li class="flex items-start">
                    <iconify-icon icon="ic:round-check" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                    <span>Withdrawals require the client's correct wallet address before submission.</span>
                </li>
                <li class="flex items-start">
                    <iconify-icon icon="ic:round-check" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                    <span>All withdrawals must comply with plan rules and security verification.</span>
                </li>
            </ul>
        </div>

        <!-- Transparency & Support -->
        <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 rounded-full bg-[#E8F5E9] flex items-center justify-center mr-3">
                    <iconify-icon icon="mdi:headset" class="text-xl text-[#0C3A30]"></iconify-icon>
                </div>
                <h3 class="text-lg font-semibold text-[#0C3A30]">Transparency & Support</h3>
            </div>
            <ul class="space-y-2 text-gray-700">
                <li class="flex items-start">
                    <iconify-icon icon="ic:round-check" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                    <span>Clients may reach out to our support team anytime for help.</span>
                </li>
                <li class="flex items-start">
                    <iconify-icon icon="ic:round-check" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                    <span>For verification, users can contact our admin, Phil.</span>
                </li>
                <li class="flex items-start">
                    <iconify-icon icon="ic:round-check" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                    <span>Live sessions are provided for education and strategy.</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Investment Plans Section -->
    <div class="mb-10">
        <h2 class="text-xl font-semibold text-[#0C3A30] mb-6 pb-2 border-b border-gray-200">Investment Plans & Qualifications</h2>
        
        <div class="space-y-6">
            <!-- Entry Plan -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-[#0C3A30]">Entry Plan</h3>
                    <span class="inline-block px-3 py-1 bg-[#E8F5E9] text-[#0C3A30] text-sm font-medium rounded-full mt-2 md:mt-0">Beginner Level</span>
                </div>
                <p class="text-gray-700 mb-3">Designed for new users to understand the system with daily profit generation.</p>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start">
                        <iconify-icon icon="ic:round-arrow-right" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                        <span>Account is set up with our broker</span>
                    </li>
                    <li class="flex items-start">
                        <iconify-icon icon="ic:round-arrow-right" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                        <span>Profit begins generating daily</span>
                    </li>
                    <li class="flex items-start">
                        <iconify-icon icon="ic:round-arrow-right" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                        <span>Withdrawals available after plan duration</span>
                    </li>
                </ul>
            </div>

            <!-- Starter Plan -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-[#0C3A30]">Starter Plan</h3>
                    <span class="inline-block px-3 py-1 bg-[#E1F5FE] text-[#01579B] text-sm font-medium rounded-full mt-2 md:mt-0">Intermediate Level</span>
                </div>
                <p class="text-gray-700 mb-3">Builds on the Entry Plan with higher daily profits and community access.</p>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start">
                        <iconify-icon icon="ic:round-arrow-right" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                        <span>Higher daily profits than Entry Plan</span>
                    </li>
               
                    <li class="flex items-start">
                        <iconify-icon icon="ic:round-arrow-right" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                        <span>Closer to becoming a full community member</span>
                    </li>
                </ul>
            </div>

            <!-- Standard Plan -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-[#0C3A30]">Standard Plan</h3>
                    <span class="inline-block px-3 py-1 bg-[#E8EAF6] text-[#1A237E] text-sm font-medium rounded-full mt-2 md:mt-0">Advanced Level</span>
                </div>
                <p class="text-gray-700 mb-3">Offers greater investment potential with stronger trading capacity.</p>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start">
                        <iconify-icon icon="ic:round-arrow-right" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                        <span>Higher investment potential and scalability</span>
                    </li>
                    <li class="flex items-start">
                        <iconify-icon icon="ic:round-arrow-right" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                        <span>More frequent profit opportunities (cycles)</span>
                    </li>
                      <li class="flex items-start">
                        <iconify-icon icon="ic:round-arrow-right" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                        <span>Acquired membership ID</span>
                    </li>
                    <li class="flex items-start">
                        <iconify-icon icon="ic:round-arrow-right" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                        <span>Enhanced trading capacity</span>
                    </li>
                </ul>
            </div>

            <!-- VIP Plan -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-[#0C3A30]">VIP Plan</h3>
                    <span class="inline-block px-3 py-1 bg-[#F3E5F5] text-[#4A148C] text-sm font-medium rounded-full mt-2 md:mt-0">Premium Level</span>
                </div>
                
                <p class="text-gray-700 mb-3">Exclusive access with significant privileges and reinvestment options.</p>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start">
                        <iconify-icon icon="ic:round-arrow-right" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                        <span>Access to exclusive VIP community</span>
                    </li>
                    <li class="flex items-start">
                        <iconify-icon icon="ic:round-arrow-right" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                        <span>Reinvest up to five times</span>
                    </li>
                    <li class="flex items-start">
                        <iconify-icon icon="ic:round-arrow-right" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                        <span>Option to attend currency conferences and international events</span>
                    </li>
                </ul>
            </div>

            <!-- Ambassadorship Plan -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-[#0C3A30]">Ambassadorship Plan</h3>
                    <span class="inline-block px-3 py-1 bg-[#FFF8E1] text-[#FF6F00] text-sm font-medium rounded-full mt-2 md:mt-0">Elite Level</span>
                </div>
                <p class="text-gray-700 mb-3">Highest-tier membership with unlimited investment opportunities.</p>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start">
                        <iconify-icon icon="ic:round-arrow-right" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                        <span>Unlimited investment opportunities</span>
                    </li>
                    <li class="flex items-start">
                        <iconify-icon icon="ic:round-arrow-right" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                        <span>Instant reinvest button in portfolio</span>
                    </li>
                    <li class="flex items-start">
                        <iconify-icon icon="ic:round-arrow-right" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                        <span>Direct access to advanced tools and premium support</span>
                    </li>
                    <li class="flex items-start">
                        <iconify-icon icon="ic:round-arrow-right" class="text-[#9EDD05] mt-1 mr-2"></iconify-icon>
                        <span>Potential to become a shareholder in our firm</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Final Note -->
    <div class="bg-[#E8F5E9] rounded-xl p-6 border border-[#9EDD05]">
        <div class="flex items-start">
            <iconify-icon icon="mdi:lightbulb-on" class="text-2xl text-[#0C3A30] mr-3"></iconify-icon>
            <div>
                <h3 class="font-semibold text-[#0C3A30] mb-2">Your Investment Journey</h3>
                <p class="text-gray-700">
                    With this system, every plan is designed to help you grow steadily from understanding the basics with the Entry Plan 
                    to enjoying unlimited privileges as an Ambassador. Your journey depends on your commitment to growth, 
                    and we'll be here every step of the way.
                </p>
            </div>
        </div>
    </div>
    </div>
</div>

<style>
    .icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endsection









