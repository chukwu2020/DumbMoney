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

    /* Challenge Cards */
    .challenge-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    .challenge-card {
        background: white;
        border-radius: 20px;
        padding: 1.8rem;
        box-shadow: 0 10px 25px -10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(139,201,5,0.2);
        position: relative;
        overflow: hidden;
    }

    .challenge-card:hover {
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

    .challenge-card h4 {
        color: #0C3A30;
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 0.8rem;
    }

    .challenge-card p {
        color: #6c7c7a;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .solution-badge {
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

    /* Expectation Cards */
    .expectation-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.2rem;
        margin: 1.5rem 0;
    }

    .expectation-item {
        background: linear-gradient(145deg, #f8fff8, #f0f9f0);
        border-radius: 16px;
        padding: 1.2rem;
        border: 1px solid rgba(139,201,5,0.2);
    }

    .expectation-item h6 {
        color: #0C3A30;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .expectation-item h6 i {
        color: #8BC905;
    }

    .expectation-item p {
        color: #6c7c7a;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    /* Risk Management Framework */
    .risk-framework {
        background: linear-gradient(145deg, #f8fff8, #f0f9f0);
        border-radius: 24px;
        padding: 2rem;
        margin: 2rem 0;
    }

    .framework-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.2rem;
        margin-top: 1.5rem;
    }

    .framework-item {
        background: white;
        border-radius: 16px;
        padding: 1.2rem;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }

    .framework-icon {
        width: 40px;
        height: 40px;
        background: rgba(139,201,5,0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .framework-icon i {
        color: #8BC905;
        font-size: 1.2rem;
    }

    .framework-content h6 {
        color: #0C3A30;
        font-weight: 600;
        margin-bottom: 0.3rem;
    }

    .framework-content p {
        color: #6c7c7a;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    /* Mindset Box */
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

    /* Feedback Loop */
    .feedback-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.2rem;
        margin: 1.5rem 0;
    }

    .feedback-item {
        background: white;
        border: 1px solid rgba(139,201,5,0.2);
        border-radius: 16px;
        padding: 1.2rem;
    }

    .feedback-item h6 {
        color: #0C3A30;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .feedback-item p {
        color: #6c7c7a;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .feedback-tip {
        background: rgba(139,201,5,0.05);
        border-radius: 8px;
        padding: 0.5rem;
        font-size: 0.85rem;
        color: #4A5C5A;
    }
.breadcrumb-item::after,
.breadcrumb-item::before,
.breadcrumb li::after,
.breadcrumb li::before {
    content: none !important;
    display: none !important;
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
        .challenge-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767px) {
        .edu-section h2 {
            font-size: 1.5rem;
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
                        <li class="breadcrumb-item active">Why Traders Struggle</li>
                    </ol>
                </nav>
                <h1>Why Traders Struggle With Evaluations</h1>
                <p class="text-white-50" style="font-size: 1.2rem;">Understanding common challenges and how to overcome them</p>
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
                        <h2><span>The Evaluation</span> Challenge</h2>
                        <p>Prop firm evaluations are designed to assess consistency, decision-making, and risk awareness. While many traders enter these programs with strong intentions, the evaluation phase can highlight areas that still need development.</p>
                        <p>Understanding common challenges can help you approach evaluations with clearer expectations and better preparation.</p>
                        
                        <div class="example-box mt-4">
                            <small> THE REALITY</small>
                            <p>Only about 45% of traders pass evaluations on their first attempt. The key isn't luck it's preparation and awareness.</p>
                        </div>
                    </div>

                    <!-- Common Challenges Grid -->
                    <div id="common-challenges" class="edu-section">
                        <h2><span>Common</span> Challenges</h2>
                        
                        <div class="challenge-grid">
                            <div class="challenge-card">
                                <div class="card-icon">
                                    <i class="ri-questionnaire-fill"></i>
                                </div>
                                <h4>Misaligned Expectations</h4>
                                <p>Some traders enter evaluations expecting quick results. When progress takes longer than anticipated, frustration can influence decisions.</p>
                                <div class="solution-badge">Solution: Think in months, not days</div>
                                <div class="example-box">
                                    <small> EXAMPLE</small>
                                    <p>Expecting to pass in 1 week vs. planning for 4-6 weeks of consistent trading</p>
                                </div>
                            </div>

                            <div class="challenge-card">
                                <div class="card-icon">
                                    <i class="ri-scales-fill"></i>
                                </div>
                                <h4>Inconsistent Risk Management</h4>
                                <p>Fluctuating position sizing or emotional reactions to losses can disrupt consistency. Evaluations highlight whether risk control habits are stable.</p>
                                <div class="solution-badge">Solution: Fixed % risk every trade</div>
                                <div class="example-box">
                                    <small> EXAMPLE</small>
                                    <p>Risking 2% after wins, 0.5% after losses → inconsistent results</p>
                                </div>
                            </div>

                            <div class="challenge-card">
                                <div class="card-icon">
                                    <i class="ri-bar-chart-fill"></i>
                                </div>
                                <h4>Overemphasis on Short-Term Results</h4>
                                <p>Focusing too closely on daily outcomes can lead to reactive decision-making. Evaluations reward steady execution, not isolated gains.</p>
                                <div class="solution-badge">Solution: Focus on process, not P&L</div>
                            </div>

                            <div class="challenge-card">
                                <div class="card-icon">
                                    <i class="ri-mental-health-fill"></i>
                                </div>
                                <h4>Emotional Pressure</h4>
                                <p>The evaluation environment can introduce new emotional pressures. Traders without emotional awareness struggle to maintain consistency.</p>
                                <div class="solution-badge">Solution: Build emotional awareness</div>
                                <div class="example-box">
                                    <small> EXAMPLE</small>
                                    <p>Feeling "this has to work" creates tension → leads to rule-breaking</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Misaligned Expectations Deep Dive -->
                    <div id="expectations" class="edu-section">
                        <h2><span>Misaligned</span> Expectations</h2>
                        
                        <div class="expectation-grid">
                            <div class="expectation-item">
                                <h6><i class="ri-error-warning-fill" style="color: #dc3545;"></i> Unrealistic</h6>
                                <p>"I'll pass in a week and start making $10k/month immediately"</p>
                            </div>
                            <div class="expectation-item">
                                <h6><i class="ri-check-line" style="color: #8BC905;"></i> Realistic</h6>
                                <p>"I'll focus on consistent execution for 4-6 weeks and learn from the process"</p>
                            </div>
                            <div class="expectation-item">
                                <h6><i class="ri-error-warning-fill" style="color: #dc3545;"></i> Unrealistic</h6>
                                <p>"One big win will get me to the target"</p>
                            </div>
                            <div class="expectation-item">
                                <h6><i class="ri-check-line" style="color: #8BC905;"></i> Realistic</h6>
                                <p>"Small, consistent gains build toward the target safely"</p>
                            </div>
                        </div>

                        <div class="mindset-box mt-3">
                            <h5><i class="ri-focus-fill"></i> Aligning Expectations</h5>
                            <ul>
                                <li><i class="ri-check-line"></i> View the evaluation as a learning process, not a lottery ticket</li>
                                <li><i class="ri-check-line"></i> Plan for the full duration, don't rush</li>
                                <li><i class="ri-check-line"></i> Success = following rules consistently, not hitting the target fast</li>
                                <li><i class="ri-check-line"></i> Each attempt teaches you something valuable</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Risk Management Framework -->
                    <div id="risk-management" class="edu-section">
                        <h2><span>Inconsistent</span> Risk Management</h2>
                        
                        <div class="risk-framework">
                            <h5 style="color: #0C3A30; margin-bottom: 1rem;">Building Stable Risk Habits</h5>
                            
                            <div class="framework-grid">
                                <div class="framework-item">
                                    <div class="framework-icon">
                                        <i class="ri-percent-fill"></i>
                                    </div>
                                    <div class="framework-content">
                                        <h6>Fixed % Risk</h6>
                                        <p>Risk the same percentage on every trade, every time</p>
                                    </div>
                                </div>
                                <div class="framework-item">
                                    <div class="framework-icon">
                                        <i class="ri-stop-fill"></i>
                                    </div>
                                    <div class="framework-content">
                                        <h6>Daily Loss Limit</h6>
                                        <p>Stop after 2-3 losses to reset mentally</p>
                                    </div>
                                </div>
                                <div class="framework-item">
                                    <div class="framework-icon">
                                        <i class="ri-arrow-down-fill"></i>
                                    </div>
                                    <div class="framework-content">
                                        <h6>Max Drawdown</h6>
                                        <p>Know your absolute limit before starting</p>
                                    </div>
                                </div>
                                <div class="framework-item">
                                    <div class="framework-icon">
                                        <i class="ri-repeat-fill"></i>
                                    </div>
                                    <div class="framework-content">
                                        <h6>Consistency</h6>
                                        <p>Same position sizing, same rules, always</p>
                                    </div>
                                </div>
                            </div>

                            <div class="example-box mt-3">
                                <small>⚠️ INCONSISTENT VS CONSISTENT</small>
                                <p><strong>Inconsistent:</strong> Risk 2% on first trade, 4% after loss to recover, 0.5% after win (emotional)</p>
                                <p><strong>Consistent:</strong> Risk 1% on every trade, every day, regardless of recent outcomes</p>
                            </div>
                        </div>
                    </div>

                    <!-- Short-Term Focus -->
                    <div id="short-term-focus" class="edu-section">
                        <h2><span>Short-Term</span> Focus Trap</h2>
                        
                        <div class="challenge-grid">
                            <div class="challenge-card">
                                <h4>The Problem</h4>
                                <p>Checking P&L constantly, getting euphoric after wins, depressed after losses, changing strategy based on last trade.</p>
                            </div>
                            <div class="challenge-card">
                                <h4>The Solution</h4>
                                <p>Focus on process adherence. Ask: "Did I follow my rules perfectly?" not "How much did I make/lose?"</p>
                            </div>
                        </div>

                        <div class="mindset-box mt-3">
                            <h5><i class="ri-eye-off-fill"></i> Shift Your Focus</h5>
                            <ul>
                                <li><i class="ri-check-line"></i> From "daily P&L" to "did I follow my plan?"</li>
                                <li><i class="ri-check-line"></i> From "how much this trade made" to "was this trade in my plan?"</li>
                                <li><i class="ri-check-line"></i> From "hitting the target fast" to "trading consistently for the whole period"</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Emotional Pressure -->
                    <div id="emotional-pressure" class="edu-section">
                        <h2><span>Emotional</span> Pressure</h2>
                        
                        <div class="challenge-grid">
                            <div class="challenge-card">
                                <div class="card-icon">
                                    <i class="ri-emotion-fill"></i>
                                </div>
                                <h4>Common Emotional States</h4>
                                <ul style="color: #6c7c7a; padding-left: 1.2rem;">
                                    <li>😰 Fear of failure</li>
                                    <li>😤 Frustration after losses</li>
                                    <li>🤑 Euphoria after wins (overconfidence)</li>
                                    <li>😨 Anxiety about rules</li>
                                </ul>
                            </div>
                            <div class="challenge-card">
                                <div class="card-icon">
                                    <i class="ri-mental-health-fill"></i>
                                </div>
                                <h4>Building Emotional Awareness</h4>
                                <p>Journal your emotional state before and after each trade. Patterns emerge over time.</p>
                                <div class="example-box">
                                    <small> JOURNAL PROMPT</small>
                                    <p>Emotion before trade:  Did I follow rules anyway? </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Evaluations as Feedback -->
                    <div id="feedback" class="edu-section">
                        <h2><span>Evaluations as</span> Feedback</h2>
                        <p>Challenges encountered during evaluations often point to specific areas for growth. Using this feedback constructively can support stronger preparation moving forward.</p>
                        
                        <div class="feedback-grid">
                            <div class="feedback-item">
                                <h6>If you blow through drawdown...</h6>
                                <p>Your position sizing is too large or you're not respecting stops</p>
                                <div class="feedback-tip">🎯 Focus: Risk management</div>
                            </div>
                            <div class="feedback-item">
                                <h6>If you get close but fail...</h6>
                                <p>You may be rushing or getting impatient near the target</p>
                                <div class="feedback-tip">🎯 Focus: Patience and process</div>
                            </div>
                            <div class="feedback-item">
                                <h6>If you're inconsistent...</h6>
                                <p>You may not have a clear, repeatable trading plan</p>
                                <div class="feedback-tip">🎯 Focus: Strategy refinement</div>
                            </div>
                            <div class="feedback-item">
                                <h6>If emotions overwhelm you...</h6>
                                <p>Psychology needs work - journal and review patterns</p>
                                <div class="feedback-tip">🎯 Focus: Emotional awareness</div>
                            </div>
                        </div>

                        <div class="example-box mt-3">
                            <small> FEEDBACK LOOP</small>
                            <p>Every failed evaluation is data. What specifically went wrong? Use that information to improve for next time.</p>
                        </div>
                    </div>

                    <!-- Key Takeaways -->
                    <div id="takeaways" class="edu-section">
                        <div class="mindset-box">
                            <h5><i class="ri-star-fill"></i> Key Takeaways</h5>
                            <ul>
                                <li><i class="ri-check-line"></i> Most evaluation challenges are predictable and preventable</li>
                                <li><i class="ri-check-line"></i> Align expectations with reality - this is a process, not a sprint</li>
                                <li><i class="ri-check-line"></i> Consistent risk management is non-negotiable</li>
                                <li><i class="ri-check-line"></i> Focus on process, not daily P&L</li>
                                <li><i class="ri-check-line"></i> Build emotional awareness - it's as important as technical skill</li>
                                <li><i class="ri-check-line"></i> Every attempt is feedback, not failure</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Preparation Checklist -->
                    <div id="preparation" class="edu-section">
                        <h2><span>Preparation</span> Checklist</h2>
                        
                        <div class="challenge-card">
                            <h5>Before Your Next Evaluation</h5>
                            <ol style="color: #4A5C5A; padding-left: 1.2rem;">
                                <li class="mb-2">✓ Write down your exact trading rules</li>
                                <li class="mb-2">✓ Define your max risk per trade (1% or less)</li>
                                <li class="mb-2">✓ Set your daily loss limit</li>
                                <li class="mb-2">✓ Know your maximum drawdown limit</li>
                                <li class="mb-2">✓ Plan for the full duration (4-6 weeks)</li>
                                <li class="mb-2">✓ Prepare your journal to track emotions</li>
                                <li class="mb-2">✓ Review these common challenges</li>
                            </ol>
                            <div class="example-box mt-3">
                                <small>🎯 GOAL</small>
                                <p>Not just to pass, but to become a consistently profitable trader</p>
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
                            <li><a href="#intro" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>The Evaluation Challenge</a></li>
                            <li><a href="#common-challenges" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Common Challenges</a></li>
                            <li><a href="#expectations" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Misaligned Expectations</a></li>
                            <li><a href="#risk-management" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Risk Management</a></li>
                            <li><a href="#short-term-focus" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Short-Term Focus</a></li>
                            <li><a href="#emotional-pressure" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Emotional Pressure</a></li>
                            <li><a href="#feedback" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Evaluations as Feedback</a></li>
                            <li><a href="#takeaways" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Key Takeaways</a></li>
                            <li><a href="#preparation" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Preparation Checklist</a></li>
                        </ul>
                    </div>

                    <!-- Related Topics -->
                    <div class="sidebar-section">
                        <h4>Related Topics</h4>
                        <ul>
                            <li><a href="{{ route('education.psychology1') }}"><i class="ri-arrow-right-s-line"></i>Psychology & Risk Control</a></li>
                            <li><a href="{{ route('education.consistency-rules') }}"><i class="ri-arrow-right-s-line"></i>Consistency Rules</a></li>
                            <li><a href="{{ route('education.trailing-drawdown') }}"><i class="ri-arrow-right-s-line"></i>Drawdown Explained</a></li>
                            <li><a href="{{ route('education.make-living-trading') }}"><i class="ri-arrow-right-s-line"></i>Making a Living</a></li>
                        </ul>
                    </div>

                    <!-- Quick Tip -->
                    <div class="tip-box">
                        <h6><i class="ri-lightbulb-flash-fill"></i> Before You Start</h6>
                        <p>Ask yourself: "Would I trade this evaluation exactly the same way if it was a $200,000 live account?" If not, adjust your approach.</p>
                    </div>

                    <!-- Journal Prompt -->
                    <div style="background: #0C3A30; border-radius: 16px; padding: 1.2rem; margin-top: 1.5rem;">
                        <p style="color: white; font-size: 0.9rem; margin-bottom: 0.8rem;"><i class="ri-book-open-fill me-2" style="color: #8BC905;"></i> <strong>Evaluation Journal</strong></p>
                        <p style="color: rgba(255,255,255,0.7); font-size: 0.85rem; margin-bottom: 1rem;">Track your progress and identify patterns before they become problems.</p>
                        <a href="{{route('signup')}}" style="background: #8BC905; color: #0C3A30; padding: 0.4rem 1rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; text-decoration: none; display: inline-block;">Download Template →</a>
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