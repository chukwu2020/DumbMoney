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

    /* Consistency Visual Cards */
    .consistency-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    .consistency-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 10px 25px -10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(139,201,5,0.2);
        position: relative;
        overflow: hidden;
    }

    .consistency-card:hover {
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
        margin-bottom: 1rem;
    }

    .card-icon i {
        font-size: 1.8rem;
        color: #8BC905;
    }

    .consistency-card h4 {
        color: #0C3A30;
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 0.8rem;
    }

    .consistency-card p {
        color: #6c7c7a;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .example-badge {
        display: inline-block;
        background: rgba(139,201,5,0.1);
        color: #8BC905;
        padding: 0.3rem 0.8rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Process Timeline */
    .process-timeline {
        margin: 2rem 0;
        position: relative;
    }

    .timeline-item {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 2rem;
        position: relative;
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
        font-size: 0.95rem;
    }

    /* Good vs Bad Comparison */
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

    .comparison-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
    }

    .comparison-card h5 {
        color: #0C3A30;
        font-weight: 600;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid;
    }

    .good-card h5 {
        border-bottom-color: #8BC905;
    }

    .bad-card h5 {
        border-bottom-color: #dc3545;
    }

    .trade-row {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px dashed rgba(0,0,0,0.1);
    }

    .trade-profit {
        color: #8BC905;
        font-weight: 600;
    }

    .trade-loss {
        color: #dc3545;
        font-weight: 600;
    }

    .result-stats {
        margin-top: 1rem;
        padding: 0.8rem;
        background: rgba(139,201,5,0.05);
        border-radius: 8px;
    }

    /* Habit Building Cards */
    .habits-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin: 1.5rem 0;
    }

    .habit-card {
        background: white;
        border: 1px solid rgba(139,201,5,0.2);
        border-radius: 12px;
        padding: 1rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .habit-card:hover {
        border-color: #8BC905;
        transform: translateY(-3px);
    }

    .habit-icon {
        width: 40px;
        height: 40px;
        background: rgba(139,201,5,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.8rem;
    }

    .habit-icon i {
        color: #8BC905;
        font-size: 1.2rem;
    }

    .habit-card h6 {
        color: #0C3A30;
        font-weight: 600;
        margin-bottom: 0.3rem;
    }

    .habit-card p {
        color: #6c7c7a;
        font-size: 0.85rem;
        margin-bottom: 0;
    }

    /* Common Mistakes */
    .mistakes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        margin: 1.5rem 0;
    }
.breadcrumb-item::after,
.breadcrumb-item::before,
.breadcrumb li::after,
.breadcrumb li::before {
    content: none !important;
    display: none !important;
}
    .mistake-item {
        background: #fff1f0;
        border: 1px solid #ffcdd2;
        border-radius: 12px;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .mistake-item i {
        color: #dc3545;
        font-size: 1.3rem;
    }

    .mistake-item span {
        color: #b71c1c;
        font-weight: 500;
    }

    /* Takeaway Box */
    .takeaway-box {
        background: #0C3A30;
        border-radius: 16px;
        padding: 1.5rem;
        color: white;
        margin: 2rem 0;
    }

    .takeaway-box h5 {
        color: #8BC905;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .takeaway-box ul {
        list-style: none;
        padding: 0;
    }

    .takeaway-box li {
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        color: rgba(255,255,255,0.9);
    }

    .takeaway-box li i {
        color: #8BC905;
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

    /* Tip Box */
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

    /* Journal Section */
    .journal-prompt {
        background: white;
        border: 2px dashed #8BC905;
        border-radius: 16px;
        padding: 1.5rem;
        text-align: center;
        margin: 2rem 0;
    }

    .journal-prompt h5 {
        color: #0C3A30;
        margin-bottom: 0.8rem;
    }

    .journal-prompt p {
        color: #6c7c7a;
        margin-bottom: 1rem;
    }

    .journal-btn {
        background: #8BC905;
        color: #0C3A30;
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
        text-decoration: none;
    }

    .journal-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139,201,5,0.3);
        color: #0C3A30;
    }

    @media (max-width: 991px) {
        .edu-header h1 {
            font-size: 2.2rem;
        }
        .edu-content {
            padding: 2rem;
        }
        .consistency-grid {
            grid-template-columns: 1fr;
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
                        <li class="breadcrumb-item active">Trading Consistency</li>
                    </ol>
                </nav>
                <h1>Trading Consistency Explained</h1>
                <p class="text-white-50" style="font-size: 1.2rem;">Learn how repeatable performance separates successful traders from the rest</p>
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
                        <h2><span>What is</span> Trading Consistency?</h2>
                        <p>Consistency in trading refers to the ability to apply a reliable process repeatedly, regardless of short-term results. It's about patterns of behavior, discipline, and risk awareness - not just individual wins.</p>
                        <p>Rather than focusing on isolated outcomes, consistency emphasizes how reliably you execute decisions over time.</p>
                        
                        <div class="consistency-card mt-4" style="background: rgba(139,201,5,0.03);">
                            <div class="card-icon">
                                <i class="ri-radar-fill"></i>
                            </div>
                            <h4>The Core Idea</h4>
                            <p>Consistency = Predictable execution + Controlled risk + Emotional discipline</p>
                            <span class="example-badge">Foundation of Success</span>
                        </div>
                    </div>

                    <!-- What Consistency Means -->
                    <div id="what-it-means" class="edu-section">
                        <h2><span>What Consistency</span> Means in Trading</h2>
                        
                        <div class="consistency-grid">
                            <div class="consistency-card">
                                <div class="card-icon">
                                    <i class="ri-stack-fill"></i>
                                </div>
                                <h4>Process Adherence</h4>
                                <p>Following your trading plan exactly as designed, every single time, without deviation.</p>
                                <div class="example-box mt-2" style="background: rgba(139,201,5,0.05); padding: 0.8rem; border-radius: 8px;">
                                    <small class="text-muted">📋 Same entry rules, same position sizing, same risk parameters - always</small>
                                </div>
                            </div>

                            <div class="consistency-card">
                                <div class="card-icon">
                                    <i class="ri-shield-fill"></i>
                                </div>
                                <h4>Risk Management</h4>
                                <p>Risking the same percentage on every trade, regardless of confidence level.</p>
                                <div class="example-box mt-2" style="background: rgba(139,201,5,0.05); padding: 0.8rem; border-radius: 8px;">
                                    <small class="text-muted">📊 Always 1% per trade - never more, never less</small>
                                </div>
                            </div>

                            <div class="consistency-card">
                                <div class="card-icon">
                                    <i class="ri-mental-health-fill"></i>
                                </div>
                                <h4>Emotional Control</h4>
                                <p>Responding to wins and losses the same way - with composure and discipline.</p>
                                <div class="example-box mt-2" style="background: rgba(139,201,5,0.05); padding: 0.8rem; border-radius: 8px;">
                                    <small class="text-muted">🧠 No euphoria after wins, no despair after losses</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Why Consistency Matters -->
                    <div id="why-matters" class="edu-section">
                        <h2><span>Why Consistency</span> Is Emphasized</h2>
                        
                        <div class="consistency-grid">
                            <div class="consistency-card">
                                <h4>Eliminates Luck</h4>
                                <p>One big win could be luck. Consistent small gains prove skill.</p>
                                <span class="example-badge">Skill vs Luck</span>
                            </div>
                            <div class="consistency-card">
                                <h4>Builds Trust</h4>
                                <p>Funding firms need to know you'll protect capital consistently, not just once.</p>
                                <span class="example-badge">Reliability</span>
                            </div>
                            <div class="consistency-card">
                                <h4>Enables Improvement</h4>
                                <p>Consistent execution makes it possible to identify what works and what doesn't.</p>
                                <span class="example-badge">Learning</span>
                            </div>
                            <div class="consistency-card">
                                <h4>Reduces Emotional Swings</h4>
                                <p>Following a process reduces fear and greed-driven decisions.</p>
                                <span class="example-badge">Psychology</span>
                            </div>
                        </div>
                    </div>

                    <!-- Good vs Bad Consistency Comparison -->
                    <div id="comparison" class="edu-section">
                        <h2><span>Consistent vs</span> Inconsistent Trading</h2>
                        
                        <div class="comparison-section">
                            <div class="comparison-grid">
                                <div class="comparison-card good-card">
                                    <h5>✅ Consistent Trader</h5>
                                    <div class="trade-row">
                                        <span>Week 1</span>
                                        <span class="trade-profit">+2.1%</span>
                                    </div>
                                    <div class="trade-row">
                                        <span>Week 2</span>
                                        <span class="trade-profit">+1.8%</span>
                                    </div>
                                    <div class="trade-row">
                                        <span>Week 3</span>
                                        <span class="trade-profit">+2.3%</span>
                                    </div>
                                    <div class="trade-row">
                                        <span>Week 4</span>
                                        <span class="trade-profit">+1.9%</span>
                                    </div>
                                    <div class="result-stats">
                                        <strong>Result:</strong> +8.1% total, low volatility, predictable growth
                                    </div>
                                </div>
                                
                                <div class="comparison-card bad-card">
                                    <h5>❌ Inconsistent Trader</h5>
                                    <div class="trade-row">
                                        <span>Week 1</span>
                                        <span class="trade-profit">+8.5%</span>
                                    </div>
                                    <div class="trade-row">
                                        <span>Week 2</span>
                                        <span class="trade-loss">-4.2%</span>
                                    </div>
                                    <div class="trade-row">
                                        <span>Week 3</span>
                                        <span class="trade-profit">+6.1%</span>
                                    </div>
                                    <div class="trade-row">
                                        <span>Week 4</span>
                                        <span class="trade-loss">-5.3%</span>
                                    </div>
                                    <div class="result-stats">
                                        <strong>Result:</strong> +5.1% total, high volatility, unpredictable
                                    </div>
                                </div>
                            </div>
                            <p class="text-center text-muted small mt-3">Despite similar total returns, the consistent trader is preferred because they're predictable and low-risk.</p>
                        </div>
                    </div>

                    <!-- Process Over Results -->
                    <div id="process-over-results" class="edu-section">
                        <h2><span>Process Over</span> Short-Term Results</h2>
                        <p>Short-term results can vary widely due to market conditions. Focusing on process allows you to evaluate performance based on execution quality rather than temporary fluctuations.</p>
                        
                        <div class="process-timeline">
                            <div class="timeline-item">
                                <div class="timeline-number">1</div>
                                <div class="timeline-content">
                                    <h5>Follow Your Plan</h5>
                                    <p>Execute trades exactly as your strategy dictates, no matter what.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-number">2</div>
                                <div class="timeline-content">
                                    <h5>Review Execution</h5>
                                    <p>After each trade, ask: "Did I follow my rules perfectly?"</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-number">3</div>
                                <div class="timeline-content">
                                    <h5>Ignore Outcome</h5>
                                    <p>A losing trade following the rules is still a good trade. A winning trade breaking rules is a bad trade.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-number">4</div>
                                <div class="timeline-content">
                                    <h5>Adjust Strategy</h5>
                                    <p>Only change your strategy based on process analysis, not emotional reactions to losses.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Developing Repeatable Habits -->
                    <div id="habits" class="edu-section">
                        <h2><span>Developing</span> Repeatable Habits</h2>
                        <p>Consistency is built through habits developed over time. Regular review, reflection, and adjustment help reinforce behaviors that align with long-term goals.</p>
                        
                        <div class="habits-grid">
                            <div class="habit-card">
                                <div class="habit-icon">
                                    <i class="ri-book-open-fill"></i>
                                </div>
                                <h6>Journal Every Trade</h6>
                                <p>Record entry, exit, emotions, and rule adherence</p>
                            </div>
                            <div class="habit-card">
                                <div class="habit-icon">
                                    <i class="ri-calendar-fill"></i>
                                </div>
                                <h6>Weekly Review</h6>
                                <p>Analyze patterns, not individual trades</p>
                            </div>
                            <div class="habit-card">
                                <div class="habit-icon">
                                    <i class="ri-scales-fill"></i>
                                </div>
                                <h6>Fixed Risk</h6>
                                <p>Same % risk on every trade, always</p>
                            </div>
                            <div class="habit-card">
                                <div class="habit-icon">
                                    <i class="ri-time-fill"></i>
                                </div>
                                <h6>Trading Hours</h6>
                                <p>Trade same time each day, avoid fatigue</p>
                            </div>
                            <div class="habit-card">
                                <div class="habit-icon">
                                    <i class="ri-pause-fill"></i>
                                </div>
                                <h6>Mandatory Breaks</h6>
                                <p>Stop after 3 consecutive losses</p>
                            </div>
                        </div>

                        <div class="journal-prompt">
                            <h5> Start Your Trading Journal</h5>
                            <p>The #1 habit of consistent traders - track everything</p>
                            <a href="{{ route('signup') }}" class="journal-btn">Download Journal Template →</a>
                        </div>
                    </div>

                    <!-- Consistency as a Learning Tool -->
                    <div id="learning-tool" class="edu-section">
                        <h2><span>Consistency as a</span> Learning Tool</h2>
                        <p>For many traders, consistency highlights areas that need refinement. This feedback guides improvement and supports gradual skill development.</p>
                        
                        <div class="consistency-grid">
                            <div class="consistency-card">
                                <h4>Identifies Weaknesses</h4>
                                <p>Consistent execution makes it obvious where your process breaks down.</p>
                                <div class="example-box mt-2">
                                    <small>🔍 If you always break rules after losses, you know psychology needs work</small>
                                </div>
                            </div>
                            <div class="consistency-card">
                                <h4>Confirms Strengths</h4>
                                <p>When you consistently follow rules and profit, you know your strategy works.</p>
                            </div>
                            <div class="consistency-card">
                                <h4>Provides Clear Data</h4>
                                <p>Inconsistent execution creates noisy data you can't learn from.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Common Consistency Mistakes -->
                    <div id="mistakes" class="edu-section">
                        <h2><span>Common</span> Consistency Mistakes</h2>
                        
                        <div class="mistakes-grid">
                            <div class="mistake-item">
                                <i class="ri-flashlight-fill"></i>
                                <span>Chasing losses with bigger positions</span>
                            </div>
                            <div class="mistake-item">
                                <i class="ri-flashlight-fill"></i>
                                <span>Changing strategy after every loss</span>
                            </div>
                            <div class="mistake-item">
                                <i class="ri-flashlight-fill"></i>
                                <span>Trading randomly without a plan</span>
                            </div>
                            <div class="mistake-item">
                                <i class="ri-flashlight-fill"></i>
                                <span>Letting winning trades make you overconfident</span>
                            </div>
                            <div class="mistake-item">
                                <i class="ri-flashlight-fill"></i>
                                <span>Not journaling or reviewing trades</span>
                            </div>
                            <div class="mistake-item">
                                <i class="ri-flashlight-fill"></i>
                                <span>Trading when emotional or tired</span>
                            </div>
                        </div>
                    </div>

                    <!-- Key Takeaways -->
                    <div id="takeaways" class="edu-section">
                        <div class="takeaway-box">
                            <h5><i class="ri-star-fill"></i> Key Takeaways</h5>
                            <ul>
                                <li><i class="ri-check-line"></i> Consistency is about process, not individual results</li>
                                <li><i class="ri-check-line"></i> Follow your rules exactly, every single time</li>
                                <li><i class="ri-check-line"></i> Risk the same percentage on every trade</li>
                                <li><i class="ri-check-line"></i> Journal everything to identify patterns</li>
                                <li><i class="ri-check-line"></i> Review weekly, focusing on process adherence</li>
                                <li><i class="ri-check-line"></i> A good trade follows rules - win or lose</li>
                                <li><i class="ri-check-line"></i> Consistency turns trading from gambling into a business</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Practical Exercise -->
                    <div id="exercise" class="edu-section">
                        <h2><span>Practical</span> Exercise</h2>
                        
                        <div class="consistency-card" style="background: rgba(139,201,5,0.03);">
                            <h5>Track Your Consistency Score</h5>
                            <p>For the next 20 trades, rate yourself 1-10 on:</p>
                            <ul style="color: #4A5C5A;">
                                <li class="mb-2">✓ Did you follow your entry rules exactly?</li>
                                <li class="mb-2">✓ Did you risk the correct amount?</li>
                                <li class="mb-2">✓ Did you place your stop-loss correctly?</li>
                                <li class="mb-2">✓ Did you exit according to your plan?</li>
                                <li class="mb-2">✓ Were you emotionally composed?</li>
                            </ul>
                            <p class="mt-3"><strong>Goal:</strong> Average 8+ across 20 trades, regardless of profit/loss</p>
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
                            <li><a href="#intro" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>What is Consistency?</a></li>
                            <li><a href="#what-it-means" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>What It Means</a></li>
                            <li><a href="#why-matters" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Why It Matters</a></li>
                            <li><a href="#comparison" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Consistent vs Inconsistent</a></li>
                            <li><a href="#process-over-results" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Process Over Results</a></li>
                            <li><a href="#habits" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Developing Habits</a></li>
                            <li><a href="#learning-tool" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Learning Tool</a></li>
                            <li><a href="#mistakes" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Common Mistakes</a></li>
                            <li><a href="#takeaways" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Key Takeaways</a></li>
                            <li><a href="#exercise" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Practical Exercise</a></li>
                        </ul>
                    </div>

                    <!-- Related Topics -->
                    <div class="sidebar-section">
                        <h4>Related Topics</h4>
                        <ul>
                            <li><a href="{{ route('education.psychology1') }}"><i class="ri-arrow-right-s-line"></i>Psychology & Risk Control</a></li>
                            <li><a href="{{ route('education.psychology2') }}"><i class="ri-arrow-right-s-line"></i>Why Traders Fail</a></li>
                            <li><a href="{{ route('education.trailing-drawdown') }}"><i class="ri-arrow-right-s-line"></i>Drawdown Explained</a></li>
                            <li><a href="{{ route('education.make-living-trading') }}"><i class="ri-arrow-right-s-line"></i>Making a Living</a></li>
                        </ul>
                    </div>

                    <!-- Quick Tip -->
                    <div class="tip-box">
                        <h6><i class="ri-lightbulb-flash-fill"></i> Quick Tip</h6>
                        <p>Ask yourself after every trade: "Did I follow my plan perfectly?" If yes, it was a good trade regardless of profit.</p>
                    </div>

                    <!-- Consistency Challenge -->
                    <div style="background: #0C3A30; border-radius: 16px; padding: 1.2rem; margin-top: 1.5rem;">
                        <p style="color: white; font-size: 0.9rem; margin-bottom: 0.8rem;"><i class="ri-medal-fill me-2" style="color: #8BC905;"></i> <strong>21-Day Consistency Challenge</strong></p>
                        <p style="color: rgba(255,255,255,0.7); font-size: 0.85rem; margin-bottom: 1rem;">Trade with perfect rule adherence for 21 days straight. Track your progress.</p>
                        <a href="{{ route('signup') }}" style="background: #8BC905; color: #0C3A30; padding: 0.4rem 1rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; text-decoration: none; display: inline-block;">Start Challenge →</a>
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