@extends('layout.app')

@section('content')

<style>
    /* Educational Page Specific Styles */
    .edu-header {
        background: linear-gradient(145deg, #0C3A30, #062018);
        padding: 60px 0;
        margin-bottom: 50px;
        border-bottom: 3px solid #8BC905;
        position: relative;
        overflow: hidden;
    }

    .edu-header::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -50px;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(139,201,5,0.1) 0%, transparent 70%);
        pointer-events: none;
    }

    .edu-header h1 {
        color: white;
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .edu-header .breadcrumb {
        background: transparent;
        padding: 0;
        margin: 0;
    }

    .edu-header .breadcrumb-item a {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
    }

    .edu-header .breadcrumb-item.active {
        color: #8BC905;
    }

    .edu-content {
        background: white;
        border-radius: 24px;
        padding: 3rem;
        box-shadow: 0 20px 40px -15px rgba(0,0,0,0.1);
        margin-bottom: 3rem;
    }

    .edu-section {
        margin-bottom: 2.5rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid rgba(139,201,5,0.2);
        scroll-margin-top: 100px;
    }

    .edu-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .edu-section h2 {
        color: #0C3A30;
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        position: relative;
        padding-left: 1rem;
        border-left: 4px solid #8BC905;
    }

    .edu-section h2 span {
        color: #8BC905;
    }

    .edu-section p {
        color: #4A5C5A;
        line-height: 1.8;
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }

    .edu-section p:last-child {
        margin-bottom: 0;
    }

    /* Checklist Cards */
    .checklist-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    .checklist-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 10px 25px -10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(139,201,5,0.2);
        position: relative;
        overflow: hidden;
    }

    .checklist-card:hover {
        transform: translateY(-5px);
        border-color: #8BC905;
        box-shadow: 0 20px 30px -12px rgba(139,201,5,0.2);
    }
.breadcrumb-item::after,
.breadcrumb-item::before,
.breadcrumb li::after,
.breadcrumb li::before {
    content: none !important;
    display: none !important;
}
    .checklist-card.legit::before {
        content: '✅';
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 1.5rem;
        opacity: 0.3;
    }

    .checklist-card.warning::before {
        content: '⚠️';
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 1.5rem;
        opacity: 0.3;
    }

    .card-icon {
        width: 60px;
        height: 60px;
        background: rgba(139,201,5,0.1);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.2rem;
    }

    .card-icon i {
        font-size: 2rem;
        color: #8BC905;
    }

    .checklist-card h4 {
        color: #0C3A30;
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 0.8rem;
    }

    .checklist-card p {
        color: #6c7c7a;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .checklist-badge {
        display: inline-block;
        background: rgba(139,201,5,0.1);
        color: #8BC905;
        padding: 0.3rem 0.8rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-top: 0.5rem;
    }

    /* Comparison Table */
    .comparison-section {
        background: linear-gradient(145deg, #f8fff8, #f0f9f0);
        border-radius: 24px;
        padding: 2rem;
        margin: 2rem 0;
    }

    .comparison-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    .comparison-col {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
    }

    .comparison-col h5 {
        color: #0C3A30;
        font-weight: 600;
        margin-bottom: 1.2rem;
        padding-bottom: 0.8rem;
        border-bottom: 2px solid;
    }

    .legitimate h5 {
        border-bottom-color: #8BC905;
    }

    .red-flags h5 {
        border-bottom-color: #dc3545;
    }

    .comparison-item {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1rem;
        color: #4A5C5A;
    }

    .comparison-item i {
        font-size: 1.2rem;
    }

    .legitimate .comparison-item i {
        color: #8BC905;
    }

    .red-flags .comparison-item i {
        color: #dc3545;
    }

    /* Warning Signs Grid */
    .warning-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        margin: 1.5rem 0;
    }

    .warning-item {
        background: #fff1f0;
        border: 1px solid #ffcdd2;
        border-radius: 12px;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .warning-item i {
        color: #dc3545;
        font-size: 1.5rem;
    }

    .warning-item span {
        color: #b71c1c;
        font-weight: 500;
    }

    /* Verification Steps */
    .steps-timeline {
        margin: 2rem 0;
    }

    .step-item {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
        align-items: flex-start;
    }

    .step-number {
        width: 40px;
        height: 40px;
        background: #8BC905;
        color: #0C3A30;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .step-content {
        flex: 1;
    }

    .step-content h5 {
        color: #0C3A30;
        margin-bottom: 0.5rem;
    }

    .step-content p {
        color: #6c7c7a;
        margin-bottom: 0;
    }

    /* Sidebar Styles */
    .edu-sidebar {
        background: white;
        border-radius: 24px;
        padding: 2rem;
        box-shadow: 0 20px 40px -15px rgba(0,0,0,0.1);
        position: sticky;
        top: 100px;
    }

    .sidebar-section {
        margin-bottom: 2rem;
    }

    .sidebar-section h4 {
        color: #0C3A30;
        font-weight: 600;
        margin-bottom: 1.2rem;
        padding-bottom: 0.8rem;
        border-bottom: 2px solid rgba(139,201,5,0.2);
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .sidebar-section ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-section li {
        margin-bottom: 0.5rem;
    }

    .sidebar-section a {
        color: #4A5C5A;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.7rem 1rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        cursor: pointer;
    }

    .sidebar-section a:hover {
        background: rgba(139,201,5,0.1);
        color: #8BC905;
        transform: translateX(5px);
    }

    .sidebar-section a.active {
        background: rgba(139,201,5,0.15);
        color: #8BC905;
        font-weight: 600;
        border-left: 3px solid #8BC905;
    }

    .sidebar-section a i {
        font-size: 0.9rem;
        color: #8BC905;
        width: 20px;
    }

    /* Trust Badge */
    .trust-badge {
        background: #0C3A30;
        border-radius: 16px;
        padding: 1.2rem;
        margin-top: 1.5rem;
    }

    .trust-badge h6 {
        color: white;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.8rem;
    }

    .trust-badge p {
        color: rgba(255,255,255,0.7);
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    @media (max-width: 991px) {
        .edu-header h1 {
            font-size: 2.2rem;
        }
        .edu-content {
            padding: 2rem;
        }
        .checklist-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767px) {
        .edu-section h2 {
            font-size: 1.5rem;
        }
        .comparison-grid {
            grid-template-columns: 1fr;
        }
    }

    html {
        scroll-behavior: smooth;
    }
</style>

<!-- Header Section -->
<section class="edu-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('plans.header') }}">Learn</a></li>
                        <li class="breadcrumb-item active">Are Trading Platforms Legit?</li>
                    </ol>
                </nav>
                <h1>How to Identify Legitimate Trading Platforms</h1>
                <p class="text-white-50" style="font-size: 1.2rem;">Learn the key factors that separate trustworthy platforms from potential scams</p>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="padding-bottom padding-top">
    <div class="container">
        <div class="row g-5">
            <!-- Main Content Column -->
            <div class="col-lg-8">
                <div class="edu-content" data-aos="fade-up" data-aos-duration="800">
                    
                    <!-- Introduction -->
                    <div id="intro" class="edu-section">
                        <h2><span>What Makes a Platform</span> Legitimate?</h2>
                        <p>Not all trading platforms and funding programs operate with the same standards. A legitimate platform is built on transparent rules, consistent risk enforcement, and programs designed to protect traders rather than exploit them.</p>
                        <p>Understanding what separates a serious operation from a marketing-focused one helps you make informed decisions before committing your time and money.</p>
                        
                        <div class="checklist-card legit mt-4" style="background: rgba(139,201,5,0.05);">
                            <div class="card-icon">
                                <i class="ri-shield-check-fill"></i>
                            </div>
                            <h4>The Golden Rule</h4>
                            <p>A legitimate platform's success depends on YOUR success. If their rules seem designed to make you fail, that's a red flag.</p>
                            <span class="checklist-badge">Key Principle</span>
                        </div>
                    </div>

                    <!-- Key Characteristics -->
                    <div id="key-characteristics" class="edu-section">
                        <h2><span>Key Characteristics of</span> Legitimate Platforms</h2>
                        
                        <div class="checklist-grid">
                            <div class="checklist-card legit">
                                <div class="card-icon">
                                    <i class="ri-file-list-3-fill"></i>
                                </div>
                                <h4>Clear & Enforced Rules</h4>
                                <p>Drawdown limits, position sizing rules, and loss limits are clearly defined BEFORE you start. Rules are enforced consistently through automated systems, not discretionary decisions.</p>
                                <span class="checklist-badge">✅ Must Have</span>
                            </div>

                            <div class="checklist-card legit">
                                <div class="card-icon">
                                    <i class="ri-money-dollar-circle-fill"></i>
                                </div>
                                <h4>Realistic Programs</h4>
                                <p>Profit targets, evaluation length, and risk limits reflect how markets actually behave. Designed to identify disciplined traders, not create artificial failure.</p>
                                <span class="checklist-badge">✅ Must Have</span>
                            </div>

                            <div class="checklist-card legit">
                                <div class="card-icon">
                                    <i class="ri-bank-card-fill"></i>
                                </div>
                                <h4>Transparent Payouts</h4>
                                <p>Clear explanation of how and when payouts occur. Defined profit splits, payout schedules, and withdrawal requirements without hidden conditions.</p>
                                <span class="checklist-badge">✅ Must Have</span>
                            </div>

                            <div class="checklist-card legit">
                                <div class="card-icon">
                                    <i class="ri-robot-fill"></i>
                                </div>
                                <h4>Automated Oversight</h4>
                                <p>Real-time risk engines and behavior analysis ensure fair treatment. Manual intervention introduces inconsistency and undermines trust.</p>
                                <span class="checklist-badge">✅ Must Have</span>
                            </div>
                        </div>
                    </div>

                    <!-- Red Flags Warning -->
                    <div id="red-flags" class="edu-section">
                        <h2><span>🚩 Red Flags</span> to Watch For</h2>
                        
                        <div class="warning-grid">
                            <div class="warning-item">
                                <i class="ri-alert-fill"></i>
                                <span>Vague or changing rules</span>
                            </div>
                            <div class="warning-item">
                                <i class="ri-alert-fill"></i>
                                <span>Unrealistic profit promises</span>
                            </div>
                            <div class="warning-item">
                                <i class="ri-alert-fill"></i>
                                <span>Hidden fees or conditions</span>
                            </div>
                            <div class="warning-item">
                                <i class="ri-alert-fill"></i>
                                <span>No clear payout process</span>
                            </div>
                            <div class="warning-item">
                                <i class="ri-alert-fill"></i>
                                <span>Pressure to upgrade quickly</span>
                            </div>
                            <div class="warning-item">
                                <i class="ri-alert-fill"></i>
                                <span>Poor customer support</span>
                            </div>
                        </div>

                        <div class="checklist-card warning mt-4">
                            <div class="card-icon" style="background: rgba(220,53,69,0.1);">
                                <i class="ri-skull-fill" style="color: #dc3545;"></i>
                            </div>
                            <h4 style="color: #dc3545;">The Biggest Red Flag</h4>
                            <p>If a platform's rules change after you start, or if they make discretionary decisions about your account - RUN. Legitimate platforms use automated, consistent rules for everyone.</p>
                            <span class="checklist-badge" style="background: rgba(220,53,69,0.1); color: #dc3545;">⚠️ Danger</span>
                        </div>
                    </div>

                    <!-- Legitimate vs Red Flags Comparison -->
                    <div id="comparison" class="edu-section">
                        <h2><span>Legitimate vs</span> Red Flags</h2>
                        
                        <div class="comparison-section">
                            <div class="comparison-grid">
                                <div class="comparison-col legitimate">
                                    <h5>✅ Legitimate Platforms</h5>
                                    <div class="comparison-item">
                                        <i class="ri-checkbox-circle-fill"></i>
                                        <span>Clear, published rules</span>
                                    </div>
                                    <div class="comparison-item">
                                        <i class="ri-checkbox-circle-fill"></i>
                                        <span>Automated enforcement</span>
                                    </div>
                                    <div class="comparison-item">
                                        <i class="ri-checkbox-circle-fill"></i>
                                        <span>Transparent payouts</span>
                                    </div>
                                    <div class="comparison-item">
                                        <i class="ri-checkbox-circle-fill"></i>
                                        <span>Realistic targets</span>
                                    </div>
                                    <div class="comparison-item">
                                        <i class="ri-checkbox-circle-fill"></i>
                                        <span>24/7 automated monitoring</span>
                                    </div>
                                </div>
                                
                                <div class="comparison-col red-flags">
                                    <h5>🚩 Red Flags</h5>
                                    <div class="comparison-item">
                                        <i class="ri-close-circle-fill"></i>
                                        <span>Vague or hidden rules</span>
                                    </div>
                                    <div class="comparison-item">
                                        <i class="ri-close-circle-fill"></i>
                                        <span>Manual/discretionary decisions</span>
                                    </div>
                                    <div class="comparison-item">
                                        <i class="ri-close-circle-fill"></i>
                                        <span>Hidden fees/conditions</span>
                                    </div>
                                    <div class="comparison-item">
                                        <i class="ri-close-circle-fill"></i>
                                        <span>Unrealistic profit promises</span>
                                    </div>
                                    <div class="comparison-item">
                                        <i class="ri-close-circle-fill"></i>
                                        <span>Hard to contact support</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- How to Verify a Platform -->
                    <div id="verification-steps" class="edu-section">
                        <h2><span>How to Verify</span> a Platform</h2>
                        
                        <div class="steps-timeline">
                            <div class="step-item">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h5>Read the Rules Carefully</h5>
                                    <p>Are all rules clearly stated? Can you find drawdown limits, profit targets, and payout terms easily?</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h5>Check Independent Reviews</h5>
                                    <p>Look for reviews on Trustpilot, Forex Peace Army, and trading forums. Pay attention to payout complaints.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h5>Test Customer Support</h5>
                                    <p>Send a pre-sales question. How fast and helpful is their response?</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">4</div>
                                <div class="step-content">
                                    <h5>Look for Transparency</h5>
                                    <p>Do they have clear information about their team, location, and company structure?</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">5</div>
                                <div class="step-content">
                                    <h5>Start Small</h5>
                                    <p>Test with the smallest account size first to verify their process before committing more.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Technology Matters -->
                    <div id="technology" class="edu-section">
                        <h2><span>Technology-Driven</span> Oversight</h2>
                        <p>Legitimate platforms rely on automated monitoring and real-time risk engines to ensure fair treatment. Manual intervention introduces inconsistency and undermines trust.</p>
                        
                        <div class="checklist-grid mt-3">
                            <div class="checklist-card legit">
                                <h5>Automated Risk Monitoring</h5>
                                <p>Real-time tracking of drawdowns, position sizes, and rule compliance</p>
                            </div>
                            <div class="checklist-card legit">
                                <h5>Consistent Enforcement</h5>
                                <p>Same rules apply to every trader, every time</p>
                            </div>
                            <div class="checklist-card legit">
                                <h5>Transparent Reporting</h5>
                                <p>Clear dashboards showing your progress and compliance</p>
                            </div>
                        </div>
                    </div>

                    <!-- Specialization Matters -->
                    <div id="specialization" class="edu-section">
                        <h2><span>Focus &</span> Specialization</h2>
                        <p>Platforms that specialize in specific markets tend to apply more precise risk logic. They avoid rule structures borrowed from unrelated asset classes.</p>
                        
                        <div class="highlight-box mt-3" style="background: white; border: 1px solid #8BC905; padding: 1.5rem; border-radius: 16px;">
                            <div class="key-point">
                                <i class="ri-focus-fill" style="color: #8BC905;"></i>
                                <div>
                                    <strong>Why Specialization Matters</strong>
                                    <p class="mb-0">A platform focused on futures understands futures market behavior. A platform trying to do everything often has generic, poorly-designed rules.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Checklist -->
                    <div id="summary" class="edu-section">
                        <h2><span>Quick</span> Checklist</h2>
                        
                        <div class="checklist-grid">
                            <div class="checklist-card legit">
                                <h5>✅ Clear Rules</h5>
                                <p>Can you find and understand all rules before signing up?</p>
                            </div>
                            <div class="checklist-card legit">
                                <h5>✅ Transparent Payouts</h5>
                                <p>Do they clearly explain how and when you get paid?</p>
                            </div>
                            <div class="checklist-card legit">
                                <h5>✅ Automated Systems</h5>
                                <p>Is rule enforcement automated or discretionary?</p>
                            </div>
                            <div class="checklist-card legit">
                                <h5>✅ Realistic Targets</h5>
                                <p>Are profit targets achievable in real market conditions?</p>
                            </div>
                            <div class="checklist-card legit">
                                <h5>✅ Good Reviews</h5>
                                <p>What are actual traders saying about payouts?</p>
                            </div>
                            <div class="checklist-card legit">
                                <h5>✅ Responsive Support</h5>
                                <p>Do they answer questions quickly and helpfully?</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Column -->
            <div class="col-lg-4">
                <div class="edu-sidebar" data-aos="fade-left" data-aos-duration="800">
                    
                    <!-- On This Page -->
                    <div class="sidebar-section">
                        <h4>On This Page</h4>
                        <ul>
                            <li><a href="#intro" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>What Makes a Platform Legit?</a></li>
                            <li><a href="#key-characteristics" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Key Characteristics</a></li>
                            <li><a href="#red-flags" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Red Flags to Watch For</a></li>
                            <li><a href="#comparison" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Legitimate vs Red Flags</a></li>
                            <li><a href="#verification-steps" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>How to Verify</a></li>
                            <li><a href="#technology" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Technology Matters</a></li>
                            <li><a href="#specialization" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Focus & Specialization</a></li>
                            <li><a href="#summary" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Quick Checklist</a></li>
                        </ul>
                    </div>

                    <!-- Related Topics -->
                    <div class="sidebar-section">
                        <h4>Related Topics</h4>
                        <ul>
                            <li><a href="{{ route('education.funding') }}"><i class="ri-arrow-right-s-line"></i>Funding Explained</a></li>
                            <li><a href="{{ route('education.evaluations') }}"><i class="ri-arrow-right-s-line"></i>How Evaluations Work</a></li>
                            <li><a href="{{ route('education.consistency-rules') }}"><i class="ri-arrow-right-s-line"></i>Consistency Rules</a></li>
                            <li><a href="{{ route('education.psychology2') }}"><i class="ri-arrow-right-s-line"></i>Why Traders Fail</a></li>
                        </ul>
                    </div>

                    <!-- Trust Badge -->
                    <div class="trust-badge">
                        <h6><i class="ri-shield-keyhole-fill" style="color: #8BC905;"></i> Trust but Verify</h6>
                        <p>Always do your own research before committing funds to any platform. The tips on this page will help you ask the right questions.</p>
                        <a href="#verification-steps" style="color: #8BC905; font-size: 0.9rem; font-weight: 600; text-decoration: none;">Start Your Verification →</a>
                    </div>

                    <!-- Quick Warning -->
                    <div style="background: #fff1f0; border-radius: 16px; padding: 1rem; margin-top: 1rem; border-left: 4px solid #dc3545;">
                        <p style="color: #b71c1c; font-size: 0.9rem; margin-bottom: 0;">
                            <i class="ri-alert-fill me-1"></i>
                            <strong>Remember:</strong> If it sounds too good to be true, it probably is.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Highlight active sidebar link on scroll
    const sections = document.querySelectorAll('.edu-section');
    const navLinks = document.querySelectorAll('.sidebar-link');
    
    function highlightLink() {
        let current = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (pageYOffset >= sectionTop - 150) {
                current = section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    }
    
    window.addEventListener('scroll', highlightLink);
    
    // Smooth scroll for sidebar links
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>

@endsection