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

    /* Reality Cards */
    .reality-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    .reality-card {
        background: white;
        border-radius: 20px;
        padding: 1.8rem;
        box-shadow: 0 10px 25px -10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(139,201,5,0.2);
        position: relative;
        overflow: hidden;
    }

    .reality-card:hover {
        transform: translateY(-5px);
        border-color: #8BC905;
        box-shadow: 0 20px 30px -12px rgba(139,201,5,0.2);
    }

    .card-icon {
        width: 50px;
        height: 50px;
        background: rgba(139,201,5,0.1);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.2rem;
    }

    .card-icon i {
        font-size: 1.8rem;
        color: #8BC905;
    }

    .reality-card h4 {
        color: #0C3A30;
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 0.8rem;
    }

    .reality-card p {
        color: #6c7c7a;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .stat-badge {
        display: inline-block;
        background: rgba(139,201,5,0.1);
        color: #8BC905;
        padding: 0.3rem 0.8rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-top: 0.5rem;
    }

    .example-box {
        background: rgba(139,201,5,0.05);
        border-radius: 12px;
        padding: 1rem;
        margin-top: 1rem;
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

    /* Income Path Timeline */
    .path-timeline {
        margin: 2rem 0;
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
        background: white;
        border-radius: 16px;
        padding: 1.2rem;
        border: 1px solid rgba(139,201,5,0.2);
    }

    .timeline-content h5 {
        color: #0C3A30;
        margin-bottom: 0.5rem;
    }

    .timeline-content p {
        color: #6c7c7a;
        margin-bottom: 0;
    }

    /* Consistency Showcase */
    .consistency-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.2rem;
        margin: 1.5rem 0;
    }

    .consistency-item {
        background: linear-gradient(145deg, #f8fff8, #f0f9f0);
        border-radius: 16px;
        padding: 1.2rem;
        border: 1px solid rgba(139,201,5,0.2);
    }

    .consistency-item h6 {
        color: #0C3A30;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .consistency-item h6 i {
        color: #8BC905;
    }

    .consistency-item p {
        color: #6c7c7a;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    /* Income Reality Box */
    .income-box {
        background: #0C3A30;
        border-radius: 16px;
        padding: 1.8rem;
        color: white;
        margin: 2rem 0;
    }

    .income-box h5 {
        color: #8BC905;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .income-box ul {
        list-style: none;
        padding: 0;
    }

    .income-box li {
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        color: rgba(255,255,255,0.9);
    }

    .income-box li i {
        color: #8BC905;
    }

    /* Growth Timeline */
    .growth-timeline {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 2rem 0;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .growth-step {
        flex: 1;
        min-width: 150px;
        background: white;
        border-radius: 16px;
        padding: 1.2rem;
        border: 1px solid rgba(139,201,5,0.2);
        position: relative;
        text-align: center;
    }

    .growth-step::after {
        content: '→';
        position: absolute;
        right: -20px;
        top: 50%;
        transform: translateY(-50%);
        color: #8BC905;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .growth-step:last-child::after {
        display: none;
    }
.breadcrumb-item::after,
.breadcrumb-item::before,
.breadcrumb li::after,
.breadcrumb li::before {
    content: none !important;
    display: none !important;
}
    .step-label {
        font-size: 0.8rem;
        color: #8BC905;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.3rem;
    }

    .step-value {
        font-size: 1.1rem;
        color: #0C3A30;
        font-weight: 600;
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
        .reality-grid {
            grid-template-columns: 1fr;
        }
        .growth-timeline {
            flex-direction: column;
        }
        .growth-step::after {
            display: none;
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
                        <li class="breadcrumb-item active">Making a Living Trading</li>
                    </ol>
                </nav>
                <h1>Can You Make a Living Trading?</h1>
                <p class="text-white-50" style="font-size: 1.2rem;">Realistic expectations and the path to sustainable trading income</p>
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
                        <h2><span>The Big</span> Question</h2>
                        <p>This is one of the most common questions among traders exploring funded trading programs. The idea of replacing traditional income through trading naturally attracts curiosity and motivation.</p>
                        <p>While some traders do reach a level of consistency that supports meaningful income, the path is rarely immediate and often requires patience, discipline, and realistic expectations.</p>
                        
                        <div class="example-box mt-4">
                            <small> THE SHORT ANSWER</small>
                            <p>Yes, it's possible. But it's a journey of years, not months, and requires treating trading like a business, not a lottery.</p>
                        </div>
                    </div>

                    <!-- Understanding "Making a Living" -->
                    <div id="understanding" class="edu-section">
                        <h2><span>Understanding</span> "Making a Living"</h2>
                        
                        <div class="reality-grid">
                            <div class="reality-card">
                                <div class="card-icon">
                                    <i class="ri-money-dollar-circle-fill"></i>
                                </div>
                                <h4>Supplemental Income</h4>
                                <p>For many, it starts as part-time income alongside a job. This reduces pressure and allows time to develop skills.</p>
                                <span class="stat-badge">Common Starting Point</span>
                            </div>
                            <div class="reality-card">
                                <div class="card-icon">
                                    <i class="ri-briefcase-fill"></i>
                                </div>
                                <h4>Full-Time Income</h4>
                                <p>After 2-3 years of consistent profitability, some transition to full-time trading. This requires proven consistency.</p>
                                <span class="stat-badge">Long-Term Goal</span>
                            </div>
                        </div>

                        <div class="income-box mt-3">
                            <h5><i class="ri-focus-fill"></i> Define Your Goals Clearly</h5>
                            <ul>
                                <li><i class="ri-check-line"></i> What does "making a living" mean to you? $2,000/month? $5,000? $10,000+?</li>
                                <li><i class="ri-check-line"></i> How much capital do you need to generate that income sustainably?</li>
                                <li><i class="ri-check-line"></i> What's your timeline? 1 year? 3 years? 5 years?</li>
                                <li><i class="ri-check-line"></i> Are you willing to treat trading as a business, not a hobby?</li>
                            </ul>
                        </div>

                        <div class="example-box">
                            <small>REALISTIC EXAMPLE</small>
                            <p>With a $100k account and 5% average monthly return ($5,000), after 80% profit split = $4,000/month. But 5% monthly consistently is extremely difficult. Most aim for 2-3% monthly.</p>
                        </div>
                    </div>

                    <!-- The Path to Trading Income -->
                    <div id="the-path" class="edu-section">
                        <h2><span>The Path</span> to Trading Income</h2>
                        
                        <div class="path-timeline">
                            <div class="timeline-item">
                                <div class="timeline-number">1</div>
                                <div class="timeline-content">
                                    <h5>Learning Phase (6-12 months)</h5>
                                    <p>Learn strategy, risk management, and psychology. Trade small or demo. Goal: Find a repeatable edge.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-number">2</div>
                                <div class="timeline-content">
                                    <h5>Evaluation Phase (3-6 months)</h5>
                                    <p>Attempt funded evaluations. Learn from failures. Refine process. Goal: Pass first evaluation.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-number">3</div>
                                <div class="timeline-content">
                                    <h5>Funded Phase (6-12 months)</h5>
                                    <p>Trade funded accounts, prove consistency under real rules. Goal: Multiple months of profitability.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-number">4</div>
                                <div class="timeline-content">
                                    <h5>Scaling Phase (1-2 years)</h5>
                                    <p>Add accounts, scale up. Income grows. Goal: Replace traditional income.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Consistency Matters -->
                    <div id="consistency" class="edu-section">
                        <h2><span>Consistency Matters</span> More Than Occasional Wins</h2>
                        <p>Long-term sustainability in trading tends to come from steady execution rather than isolated results. Traders who focus on repeatable processes are often better positioned to build durability.</p>
                        
                        <div class="consistency-grid">
                            <div class="consistency-item">
                                <h6><i class="ri-line-chart-fill"></i> The Lottery Trader</h6>
                                <p>+15%, -8%, +12%, -10%, +20% → unsustainable, stressful, unpredictable</p>
                            </div>
                            <div class="consistency-item">
                                <h6><i class="ri-bar-chart-fill"></i> The Consistent Trader</h6>
                                <p>+2%, +1.8%, +2.2%, +1.5%, +2% → sustainable, calm, predictable growth</p>
                            </div>
                        </div>

                        <div class="example-box mt-3">
                            <small> THE MATH</small>
                            <p>5% monthly with consistency is worth more than 20% one month followed by losses. Firms value predictability.</p>
                        </div>
                    </div>

                    <!-- Time, Learning, Adaptation -->
                    <div id="time-learning" class="edu-section">
                        <h2><span>Time, Learning,</span> and Adaptation</h2>
                        <p>Most traders who find success within funded programs invest significant time in learning, reflection, and adjustment. Progress often involves refining strategy, managing emotions, and adapting to different market conditions.</p>
                        
                        <div class="reality-grid">
                            <div class="reality-card">
                                <h4>Daily Practice</h4>
                                <p>Reviewing trades, journaling, analyzing markets - this is your real work.</p>
                            </div>
                            <div class="reality-card">
                                <h4>Weekly Review</h4>
                                <p>Analyze patterns in your trading, not just P&L.</p>
                            </div>
                            <div class="reality-card">
                                <h4>Monthly Adaptation</h4>
                                <p>Refine strategy based on market conditions and your performance.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Income Fluctuations -->
                    <div id="fluctuations" class="edu-section">
                        <h2><span>Income</span> Fluctuations</h2>
                        <p>Trading income can vary from period to period. Planning for variability and avoiding dependence on short-term performance can help maintain balance.</p>
                        
                        <div class="growth-timeline">
                            <div class="growth-step">
                                <div class="step-label">Good Month</div>
                                <div class="step-value">+$4,000</div>
                            </div>
                            <div class="growth-step">
                                <div class="step-label">Average Month</div>
                                <div class="step-value">+$2,500</div>
                            </div>
                            <div class="growth-step">
                                <div class="step-label">Tough Month</div>
                                <div class="step-value">+$800</div>
                            </div>
                            <div class="growth-step">
                                <div class="step-label">Loss Month</div>
                                <div class="step-value">-$500</div>
                            </div>
                        </div>

                        <div class="income-box mt-3">
                            <h5><i class="ri-funds-fill"></i> Planning for Variability</h5>
                            <ul>
                                <li><i class="ri-check-line"></i> Have 6-12 months of living expenses saved separately</li>
                                <li><i class="ri-check-line"></i> Don't rely on trading income for essential bills initially</li>
                                <li><i class="ri-check-line"></i> Average your income over 3-6 month periods</li>
                                <li><i class="ri-check-line"></i> Treat good months as opportunity to build buffer</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Long-Term Perspective -->
                    <div id="long-term" class="edu-section">
                        <h2><span>Long-Term</span> Perspective</h2>
                        <p>For those who eventually generate meaningful income, success is often the result of steady development rather than rapid transformation. Approaching funded trading as a skill-building journey creates a more sustainable foundation.</p>
                        
                        <div class="reality-grid">
                            <div class="reality-card">
                                <h4>Year 1-2</h4>
                                <p>Learning, passing evaluations, small payouts. Goal: Consistency, not income.</p>
                            </div>
                            <div class="reality-card">
                                <h4>Year 2-3</h4>
                                <p>Multiple funded accounts, growing income. Goal: Replace part-time income.</p>
                            </div>
                            <div class="reality-card">
                                <h4>Year 3-5</h4>
                                <p>Scaling, multiple accounts, full-time potential. Goal: Replace full-time income.</p>
                            </div>
                        </div>

                        <div class="example-box mt-3">
                            <small>REALITY CHECK</small>
                            <p>Very few traders replace a full-time income in their first year. Most who succeed treat it as a 3-5 year journey.</p>
                        </div>
                    </div>

                    <!-- Key Takeaways -->
                    <div id="takeaways" class="edu-section">
                        <div class="income-box">
                            <h5><i class="ri-star-fill"></i> Key Takeaways</h5>
                            <ul>
                                <li><i class="ri-check-line"></i> Yes, you can make a living trading - but it's a journey, not a shortcut</li>
                                <li><i class="ri-check-line"></i> Define what "making a living" means to you realistically</li>
                                <li><i class="ri-check-line"></i> Consistency matters more than occasional big wins</li>
                                <li><i class="ri-check-line"></i> Plan for income variability - don't rely on trading for essential bills initially</li>
                                <li><i class="ri-check-line"></i> The path typically takes 2-5 years of dedicated work</li>
                                <li><i class="ri-check-line"></i> Treat trading as a business: track everything, review constantly, improve always</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Action Plan -->
                    <div id="action-plan" class="edu-section">
                        <h2><span>Your Action</span> Plan</h2>
                        
                        <div class="reality-card">
                            <h5>If You're Serious About Making a Living Trading</h5>
                            <ol style="color: #4A5C5A; padding-left: 1.2rem;">
                                <li class="mb-2">✓ Keep your day job initially - remove financial pressure</li>
                                <li class="mb-2">✓ Spend 1-2 years learning and developing consistency</li>
                                <li class="mb-2">✓ Start with small evaluations to prove your process</li>
                                <li class="mb-2">✓ Track everything - journal every trade, every emotion</li>
                                <li class="mb-2">✓ Build multiple funded accounts over time</li>
                                <li class="mb-2">✓ Scale gradually as consistency proves itself</li>
                                <li class="mb-2">✓ Have a 12-month emergency fund before going full-time</li>
                            </ol>
                            <div class="example-box mt-3">
                                <small> REMEMBER</small>
                                <p>This is a marathon, not a sprint. The goal is to build a sustainable trading business that lasts decades, not to get rich quick.</p>
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
                            <li><a href="#intro" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>The Big Question</a></li>
                            <li><a href="#understanding" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Understanding "Making a Living"</a></li>
                            <li><a href="#the-path" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>The Path to Trading Income</a></li>
                            <li><a href="#consistency" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Consistency Matters</a></li>
                            <li><a href="#time-learning" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Time, Learning, Adaptation</a></li>
                            <li><a href="#fluctuations" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Income Fluctuations</a></li>
                            <li><a href="#long-term" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Long-Term Perspective</a></li>
                            <li><a href="#takeaways" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Key Takeaways</a></li>
                            <li><a href="#action-plan" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Your Action Plan</a></li>
                        </ul>
                    </div>

                    <!-- Related Topics -->
                    <div class="sidebar-section">
                        <h4>Related Topics</h4>
                        <ul>
                            <li><a href="{{ route('education.psychology1') }}"><i class="ri-arrow-right-s-line"></i>Psychology & Risk Control</a></li>
                            <li><a href="{{ route('education.consistency-rules') }}"><i class="ri-arrow-right-s-line"></i>Consistency Rules</a></li>
                            <li><a href="{{ route('education.evaluations') }}"><i class="ri-arrow-right-s-line"></i>How Evaluations Work</a></li>
                            <li><a href="{{ route('education.psychology2') }}"><i class="ri-arrow-right-s-line"></i>Why Traders Fail</a></li>
                        </ul>
                    </div>

                    <!-- Quick Tip -->
                    <div class="tip-box">
                        <h6><i class="ri-lightbulb-flash-fill"></i> Reality Check</h6>
                        <p>The first $1,000 you make trading consistently is more valuable than a $10,000 win from gambling. It proves you have a process that works.</p>
                    </div>

                    <!-- Income Calculator Prompt -->
                    <div style="background: #0C3A30; border-radius: 16px; padding: 1.2rem; margin-top: 1.5rem;">
                        <p style="color: white; font-size: 0.9rem; margin-bottom: 0.8rem;"><i class="ri-calculator-line me-2" style="color: #8BC905;"></i> <strong>Income Calculator</strong></p>
                        <p style="color: rgba(255,255,255,0.7); font-size: 0.85rem; margin-bottom: 1rem;">See realistic income projections based on account size and consistency.</p>
                        <a href="#" style="background: #8BC905; color: #0C3A30; padding: 0.4rem 1rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; text-decoration: none; display: inline-block;">Calculate Potential →</a>
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