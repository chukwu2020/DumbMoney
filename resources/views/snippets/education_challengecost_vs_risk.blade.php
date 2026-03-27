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

    /* Comparison Cards */
    .comparison-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    .comparison-card {
        background: white;
        border-radius: 20px;
        padding: 1.8rem;
        box-shadow: 0 10px 25px -10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(139,201,5,0.2);
        position: relative;
        overflow: hidden;
    }

    .comparison-card:hover {
        transform: translateY(-5px);
        border-color: #8BC905;
        box-shadow: 0 20px 30px -12px rgba(139,201,5,0.2);
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .card-icon {
        width: 50px;
        height: 50px;
        background: rgba(139,201,5,0.1);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-icon i {
        font-size: 1.8rem;
        color: #8BC905;
    }

    .card-header h4 {
        color: #0C3A30;
        font-size: 1.3rem;
        font-weight: 600;
        margin: 0;
    }

    .cost-card .card-header h4 {
        color: #8BC905;
    }

    .risk-card .card-header h4 {
        color: #dc3545;
    }

    .feature-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .feature-list li {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 0.8rem;
        color: #4A5C5A;
    }

    .feature-list li i {
        font-size: 1.1rem;
    }

    .cost-card .feature-list li i {
        color: #8BC905;
    }

    .risk-card .feature-list li i {
        color: #dc3545;
    }

    .example-box {
        background: rgba(139,201,5,0.05);
        border-radius: 12px;
        padding: 1rem;
        margin-top: 1.2rem;
        border-left: 3px solid #8BC905;
    }

    .example-box small {
        color: #0C3A30;
        font-weight: 600;
        display: block;
        margin-bottom: 0.3rem;
    }

    .example-box p {
        font-size: 0.9rem;
        margin-bottom: 0;
        color: #4A5C5A;
    }

    /* Key Differences Section */
    .differences-section {
        background: linear-gradient(145deg, #f8fff8, #f0f9f0);
        border-radius: 24px;
        padding: 2rem;
        margin: 2rem 0;
    }

    .differences-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.2rem;
        margin-top: 1.5rem;
    }

    .difference-item {
        background: white;
        border-radius: 16px;
        padding: 1.2rem;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }

    .diff-icon {
        width: 40px;
        height: 40px;
        background: rgba(139,201,5,0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .diff-icon i {
        font-size: 1.3rem;
        color: #8BC905;
    }

    .diff-content h6 {
        color: #0C3A30;
        font-weight: 600;
        margin-bottom: 0.3rem;
    }

    .diff-content p {
        color: #6c7c7a;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    /* Misconceptions Grid */
    .misconceptions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.2rem;
        margin: 1.5rem 0;
    }

    .misconception-card {
        background: #fff1f0;
        border: 1px solid #ffcdd2;
        border-radius: 16px;
        padding: 1.2rem;
    }

    .misconception-title {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 0.8rem;
    }

    .misconception-title i {
        color: #dc3545;
        font-size: 1.2rem;
    }

    .misconception-title h6 {
        color: #b71c1c;
        font-weight: 600;
        margin: 0;
    }

    .misconception-card p {
        color: #b71c1c;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        opacity: 0.9;
    }

    .correction {
        background: rgba(139,201,5,0.1);
        border-radius: 8px;
        padding: 0.6rem;
        margin-top: 0.5rem;
        color: #0C3A30;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .correction i {
        color: #8BC905;
    }

    /* Reality Check Cards */
    .reality-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.2rem;
        margin: 1.5rem 0;
    }

    .reality-card {
        background: white;
        border: 1px solid rgba(139,201,5,0.2);
        border-radius: 16px;
        padding: 1.2rem;
    }

    .reality-card h6 {
        color: #0C3A30;
        font-weight: 600;
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .reality-card h6 i {
        color: #8BC905;
    }

    .reality-card p {
        color: #6c7c7a;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    /* Mindset Section */
    .mindset-box {
        background: #0C3A30;
        border-radius: 16px;
        padding: 1.8rem;
        color: white;
        margin: 2rem 0;
    }

    .mindset-box h5 {
        color: #8BC905;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .mindset-box ul {
        list-style: none;
        padding: 0;
    }

    .mindset-box li {
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        color: rgba(255,255,255,0.9);
    }

    .mindset-box li i {
        color: #8BC905;
    }

    /* Long-term Development */
    .development-timeline {
        margin: 2rem 0;
    }
.breadcrumb-item::after,
.breadcrumb-item::before,
.breadcrumb li::after,
.breadcrumb li::before {
    content: none !important;
    display: none !important;
}
    .timeline-item {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
        align-items: flex-start;
    }

    .timeline-number {
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

    .timeline-content {
        flex: 1;
    }

    .timeline-content h5 {
        color: #0C3A30;
        margin-bottom: 0.5rem;
    }

    .timeline-content p {
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

    .tip-box {
        background: rgba(139,201,5,0.05);
        border-radius: 16px;
        padding: 1.2rem;
        margin-top: 1.5rem;
        border: 1px dashed #8BC905;
    }

    .tip-box h6 {
        color: #0C3A30;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.8rem;
    }

    .tip-box p {
        color: #6c7c7a;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    @media (max-width: 991px) {
        .edu-header h1 {
            font-size: 2.2rem;
        }
        .edu-content {
            padding: 2rem;
        }
        .comparison-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767px) {
        .edu-section h2 {
            font-size: 1.5rem;
        }
        .timeline-item {
            flex-direction: column;
            gap: 0.5rem;
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
                        <li class="breadcrumb-item active">Challenge Cost vs Real Risk</li>
                    </ol>
                </nav>
                <h1>Challenge Cost vs Real Trading Risk</h1>
                <p class="text-white-50" style="font-size: 1.2rem;">Understanding the crucial difference between entry fees and actual capital exposure</p>
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
                        <h2><span>Understanding</span> the Difference</h2>
                        <p>When traders explore funded trading programs, one of the first considerations is cost. Challenge fees are often discussed alongside risk, even though the two represent completely different aspects of the trading experience.</p>
                        <p>Understanding this distinction can help you approach evaluations with clearer expectations and more thoughtful preparation.</p>
                        
                        <div class="example-box mt-4">
                            <small>🔑 KEY INSIGHT</small>
                            <p>The $50-$500 you pay for a challenge is a fee for access. The $25,000-$200,000 account you're trading is the real risk exposure.</p>
                        </div>
                    </div>

                    <!-- Side by Side Comparison -->
                    <div id="comparison" class="edu-section">
                        <h2><span>Challenge Cost vs</span> Real Risk</h2>
                        
                        <div class="comparison-grid">
                            <!-- Challenge Cost Card -->
                            <div class="comparison-card cost-card">
                                <div class="card-header">
                                    <div class="card-icon">
                                        <i class="ri-money-dollar-circle-fill"></i>
                                    </div>
                                    <h4>Challenge Cost</h4>
                                </div>
                                <ul class="feature-list">
                                    <li><i class="ri-checkbox-circle-fill"></i> One-time entry fee</li>
                                    <li><i class="ri-checkbox-circle-fill"></i> Pays for access to evaluation</li>
                                    <li><i class="ri-checkbox-circle-fill"></i> Fixed, known amount you control</li>
                                    <li><i class="ri-checkbox-circle-fill"></i> Lost only if you quit or violate rules</li>
                                    <li><i class="ri-checkbox-circle-fill"></i> Think of it as tuition for learning</li>
                                </ul>
                                <div class="example-box">
                                    <small>💰 EXAMPLE</small>
                                    <p>$150 challenge fee for a $50,000 evaluation account</p>
                                </div>
                            </div>

                            <!-- Real Risk Card -->
                            <div class="comparison-card risk-card">
                                <div class="card-header">
                                    <div class="card-icon" style="background: rgba(220,53,69,0.1);">
                                        <i class="ri-alert-fill" style="color: #dc3545;"></i>
                                    </div>
                                    <h4 style="color: #dc3545;">Real Trading Risk</h4>
                                </div>
                                <ul class="feature-list">
                                    <li><i class="ri-close-circle-fill" style="color: #dc3545;"></i> Potential loss of firm capital ($25,000 - $200,000+)</li>
                                    <li><i class="ri-close-circle-fill" style="color: #dc3545;"></i> Ongoing exposure on every trade</li>
                                    <li><i class="ri-close-circle-fill" style="color: #dc3545;"></i> Variable - depends on your decisions</li>
                                    <li><i class="ri-close-circle-fill" style="color: #dc3545;"></i> Risk is always present while trading</li>
                                    <li><i class="ri-close-circle-fill" style="color: #dc3545;"></i> Can be lost through poor management</li>
                                </ul>
                                <div class="example-box" style="border-left-color: #dc3545;">
                                    <small>⚠️ EXAMPLE</small>
                                    <p>Risking 2% ($1,000) per trade on a $50k account - real exposure regardless of challenge fee</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Key Differences -->
                    <div id="key-differences" class="edu-section">
                        <h2><span>Key</span> Differences</h2>
                        
                        <div class="differences-section">
                            <div class="differences-grid">
                                <div class="difference-item">
                                    <div class="diff-icon">
                                        <i class="ri-calendar-fill"></i>
                                    </div>
                                    <div class="diff-content">
                                        <h6>Timing</h6>
                                        <p>Cost is paid once upfront. Risk is ongoing throughout your trading journey.</p>
                                    </div>
                                </div>
                                <div class="difference-item">
                                    <div class="diff-icon">
                                        <i class="ri-stack-fill"></i>
                                    </div>
                                    <div class="diff-content">
                                        <h6>Magnitude</h6>
                                        <p>Cost is small and fixed. Risk can be 100x or 1000x larger.</p>
                                    </div>
                                </div>
                                <div class="difference-item">
                                    <div class="diff-icon">
                                        <i class="ri-mental-health-fill"></i>
                                    </div>
                                    <div class="diff-content">
                                        <h6>Control</h6>
                                        <p>You choose to pay cost. Risk is managed by your decisions every day.</p>
                                    </div>
                                </div>
                                <div class="difference-item">
                                    <div class="diff-icon">
                                        <i class="ri-repeat-fill"></i>
                                    </div>
                                    <div class="diff-content">
                                        <h6>Recurrence</h6>
                                        <p>Cost is one-time per attempt. Risk is every trade, every day.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Common Misconceptions -->
                    <div id="misconceptions" class="edu-section">
                        <h2><span>Common</span> Misconceptions</h2>
                        
                        <div class="misconceptions-grid">
                            <div class="misconception-card">
                                <div class="misconception-title">
                                    <i class="ri-error-warning-fill"></i>
                                    <h6>"I'm only risking the challenge fee"</h6>
                                </div>
                                <p>This confuses the entry fee with actual trading exposure.</p>
                                <div class="correction">
                                    <i class="ri-check-line"></i>
                                    <span>You're managing a full-size account with real drawdown limits</span>
                                </div>
                            </div>
                            <div class="misconception-card">
                                <div class="misconception-title">
                                    <i class="ri-error-warning-fill"></i>
                                    <h6>"Cheaper challenges = less risk"</h6>
                                </div>
                                <p>The account size and rules determine risk, not the fee.</p>
                                <div class="correction">
                                    <i class="ri-check-line"></i>
                                    <span>A $50k account has the same risk whether you paid $50 or $500</span>
                                </div>
                            </div>
                            <div class="misconception-card">
                                <div class="misconception-title">
                                    <i class="ri-error-warning-fill"></i>
                                    <h6>"I can afford many challenges"</h6>
                                </div>
                                <p>Focus on developing skills, not buying more attempts.</p>
                                <div class="correction">
                                    <i class="ri-check-line"></i>
                                    <span>One passed challenge is better than 10 failed ones</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reality Check -->
                    <div id="reality-check" class="edu-section">
                        <h2><span>Reality</span> Check</h2>
                        
                        <div class="reality-grid">
                            <div class="reality-card">
                                <h6><i class="ri-eye-fill"></i> What Actually Matters</h6>
                                <p>Your ability to manage drawdown, follow rules, and execute consistently - not the fee you paid.</p>
                            </div>
                            <div class="reality-card">
                                <h6><i class="ri-bar-chart-fill"></i> Where Focus Should Be</h6>
                                <p>Position sizing, risk per trade, emotional control, and process adherence.</p>
                            </div>
                            <div class="reality-card">
                                <h6><i class="ri-shield-fill"></i> True Risk Factors</h6>
                                <p>Market volatility, your trading decisions, leverage, and drawdown limits.</p>
                            </div>
                        </div>

                        <div class="example-box mt-4">
                            <small> REAL-WORLD EXAMPLE</small>
                            <p>Two traders buy the same $100 challenge for a $50k account. One treats it like a lottery ticket and blows the account in a day. The other manages risk carefully and passes. Same cost, completely different risk management.</p>
                        </div>
                    </div>

                    <!-- Why This Distinction Matters -->
                    <div id="why-matters" class="edu-section">
                        <h2><span>Why This</span> Distinction Matters</h2>
                        
                        <div class="comparison-grid">
                            <div class="comparison-card">
                                <h5>❌ Wrong Mindset</h5>
                                <p class="text-muted">"I paid $100, so I'll go big to hit the target fast"</p>
                                <div class="example-box mt-2" style="background: #fff1f0; border-left-color: #dc3545;">
                                    <small>RESULT:</small>
                                    <p>Blows account, loses fee, learns nothing</p>
                                </div>
                            </div>
                            <div class="comparison-card">
                                <h5>✅ Right Mindset</h5>
                                <p class="text-muted">"I'm managing a $50k account with strict rules"</p>
                                <div class="example-box mt-2">
                                    <small>RESULT:</small>
                                    <p>Manages risk, potentially passes, develops skills</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Managing Expectations -->
                    <div id="expectations" class="edu-section">
                        <h2><span>Managing</span> Expectations</h2>
                        
                        <div class="mindset-box">
                            <h5><i class="ri-mental-health-fill"></i> Healthy Mindset Tips</h5>
                            <ul>
                                <li><i class="ri-check-line"></i> View the challenge fee as tuition for learning, not a lottery ticket</li>
                                <li><i class="ri-check-line"></i> Focus on process and risk management, not just the profit target</li>
                                <li><i class="ri-check-line"></i> Prepare to trade the full account responsibly</li>
                                <li><i class="ri-check-line"></i> Don't let a low fee lead to careless trading</li>
                                <li><i class="ri-check-line"></i> Remember: The firm is trusting you with real capital</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Long-Term Development -->
                    <div id="long-term" class="edu-section">
                        <h2><span>Long-Term</span> Development</h2>
                        
                        <div class="development-timeline">
                            <div class="timeline-item">
                                <div class="timeline-number">1</div>
                                <div class="timeline-content">
                                    <h5>Learn Risk Management</h5>
                                    <p>Focus on position sizing, drawdown control, and consistent execution - skills that transfer to any account size.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-number">2</div>
                                <div class="timeline-content">
                                    <h5>Build Consistency</h5>
                                    <p>Develop habits that work regardless of whether you're in evaluation or funded phase.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-number">3</div>
                                <div class="timeline-content">
                                    <h5>Scale Responsibly</h5>
                                    <p>As accounts grow, risk management becomes MORE important, not less.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-number">4</div>
                                <div class="timeline-content">
                                    <h5>Protect What Matters</h5>
                                    <p>Once funded, you're protecting a potential income stream, not just a challenge fee.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Key Takeaways -->
                    <div id="takeaways" class="edu-section">
                        <div class="mindset-box" style="background: #0C3A30;">
                            <h5><i class="ri-star-fill"></i> Key Takeaways</h5>
                            <ul>
                                <li><i class="ri-check-line"></i> Challenge cost is a fee for access - real risk is the capital you're managing</li>
                                <li><i class="ri-check-line"></i> A $50 challenge on a $100k account is still a $100k responsibility</li>
                                <li><i class="ri-check-line"></i> Don't let low entry fees lead to high-risk trading</li>
                                <li><i class="ri-check-line"></i> Focus on risk management - it's what determines long-term success</li>
                                <li><i class="ri-check-line"></i> Your goal is to become a skilled trader, not just to pass a challenge</li>
                                <li><i class="ri-check-line"></i> Skills developed in evaluation transfer directly to funded trading</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Practical Exercise -->
                    <div id="exercise" class="edu-section">
                        <h2><span>Practical</span> Exercise</h2>
                        
                        <div class="comparison-card">
                            <h5>Before Your Next Challenge</h5>
                            <ol style="color: #4A5C5A; padding-left: 1.2rem;">
                                <li class="mb-2">Write down the maximum drawdown allowed</li>
                                <li class="mb-2">Calculate your risk per trade (1% or less of account)</li>
                                <li class="mb-2">Plan your position sizes based on stop-loss distance</li>
                                <li class="mb-2">Decide your daily loss limit BEFORE you start</li>
                                <li class="mb-2">Set a goal for process adherence, not just profit target</li>
                            </ol>
                            <div class="example-box mt-3">
                                <small> REMEMBER</small>
                                <p>The challenge fee is forgotten quickly. The trading habits you build last forever.</p>
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
                            <li><a href="#intro" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Understanding the Difference</a></li>
                            <li><a href="#comparison" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Challenge Cost vs Real Risk</a></li>
                            <li><a href="#key-differences" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Key Differences</a></li>
                            <li><a href="#misconceptions" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Common Misconceptions</a></li>
                            <li><a href="#reality-check" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Reality Check</a></li>
                            <li><a href="#why-matters" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Why It Matters</a></li>
                            <li><a href="#expectations" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Managing Expectations</a></li>
                            <li><a href="#long-term" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Long-Term Development</a></li>
                            <li><a href="#takeaways" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Key Takeaways</a></li>
                            <li><a href="#exercise" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Practical Exercise</a></li>
                        </ul>
                    </div>

                    <!-- Related Topics -->
                    <div class="sidebar-section">
                        <h4>Related Topics</h4>
                        <ul>
                            <li><a href="{{ route('education.trailing-drawdown') }}"><i class="ri-arrow-right-s-line"></i>Drawdown Explained</a></li>
                            <li><a href="{{ route('education.consistency-rules') }}"><i class="ri-arrow-right-s-line"></i>Consistency Rules</a></li>
                            <li><a href="{{ route('education.psychology1') }}"><i class="ri-arrow-right-s-line"></i>Risk Control</a></li>
                            <li><a href="{{ route('education.make-living-trading') }}"><i class="ri-arrow-right-s-line"></i>Making a Living</a></li>
                        </ul>
                    </div>

                    <!-- Quick Tip -->
                    <div class="tip-box">
                        <h6><i class="ri-lightbulb-flash-fill"></i> Quick Tip</h6>
                        <p>Before clicking "buy," ask yourself: "Would I risk this same amount if the fee was $1,000?" If yes, proceed. If no, reconsider your approach.</p>
                    </div>

                    <!-- Risk Calculator Prompt -->
                    <div style="background: #0C3A30; border-radius: 16px; padding: 1.2rem; margin-top: 1.5rem;">
                        <p style="color: white; font-size: 0.9rem; margin-bottom: 0.8rem;"><i class="ri-calculator-line me-2" style="color: #8BC905;"></i> <strong>Know Your Real Risk</strong></p>
                        <p style="color: rgba(255,255,255,0.7); font-size: 0.85rem; margin-bottom: 1rem;">Calculate your true exposure based on your trading plan.</p>
                        <a href="{{route('signup')}}" style="background: #8BC905; color: #0C3A30; padding: 0.4rem 1rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; text-decoration: none; display: inline-block;">Calculate Risk →</a>
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