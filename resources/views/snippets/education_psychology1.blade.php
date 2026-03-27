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

    /* Psychology Cards */
    .psychology-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    .psychology-card {
        background: white;
        border-radius: 20px;
        padding: 1.8rem;
        box-shadow: 0 10px 25px -10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(139,201,5,0.2);
        position: relative;
        overflow: hidden;
    }

    .psychology-card:hover {
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

    .psychology-card h4 {
        color: #0C3A30;
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 0.8rem;
    }

    .psychology-card p {
        color: #6c7c7a;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1rem;
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

    /* Emotional Spectrum Cards */
    .emotion-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin: 1.5rem 0;
    }

    .emotion-card {
        background: linear-gradient(145deg, #f8fff8, #f0f9f0);
        border-radius: 16px;
        padding: 1.2rem;
        text-align: center;
        border: 1px solid rgba(139,201,5,0.2);
    }

    .emotion-icon {
        width: 40px;
        height: 40px;
        background: rgba(139,201,5,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.8rem;
    }

    .emotion-icon i {
        color: #8BC905;
        font-size: 1.2rem;
    }

    .emotion-card h6 {
        color: #0C3A30;
        font-weight: 600;
        margin-bottom: 0.3rem;
    }

    .emotion-card p {
        color: #6c7c7a;
        font-size: 0.85rem;
        margin-bottom: 0;
    }

    .emotion-card.good h6 {
        color: #8BC905;
    }

    .emotion-card.bad h6 {
        color: #dc3545;
    }

    /* Risk Control Framework */
    .framework-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.2rem;
        margin: 1.5rem 0;
    }

    .framework-item {
        background: white;
        border: 1px solid rgba(139,201,5,0.2);
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

    /* Discipline Timeline */
    .discipline-timeline {
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

    /* Psychology Tools */
    .tools-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.2rem;
        margin: 1.5rem 0;
    }

    .tool-card {
        background: white;
        border-radius: 16px;
        padding: 1.2rem;
        border: 1px solid rgba(139,201,5,0.2);
    }
.breadcrumb-item::after,
.breadcrumb-item::before,
.breadcrumb li::after,
.breadcrumb li::before {
    content: none !important;
    display: none !important;
}
    .tool-card h6 {
        color: #0C3A30;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .tool-card h6 i {
        color: #8BC905;
    }

    .tool-card p {
        color: #6c7c7a;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .tool-tip {
        background: rgba(139,201,5,0.05);
        border-radius: 8px;
        padding: 0.5rem;
        font-size: 0.85rem;
        color: #4A5C5A;
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

    /* Quick Reference */
    .quick-ref {
        background: linear-gradient(145deg, #f8fff8, #f0f9f0);
        border-radius: 16px;
        padding: 1.2rem;
        margin: 1.5rem 0;
        border-left: 4px solid #8BC905;
    }

    .quick-ref p {
        margin-bottom: 0;
        font-style: italic;
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
        .psychology-grid {
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
                        <li class="breadcrumb-item active">Trading Psychology & Risk Control</li>
                    </ol>
                </nav>
                <h1>Trading Psychology & Risk Control</h1>
                <p class="text-white-50" style="font-size: 1.2rem;">Master the mental game and structured risk management for consistent trading</p>
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
                        <h2><span>The Mind-Body</span> of Trading</h2>
                        <p>Technical knowledge alone is rarely enough to sustain progress in trading. Psychology and risk control play a central role in how decisions unfold during live market conditions.</p>
                        <p>Developing awareness around emotions, habits, and reactions helps traders navigate uncertainty with greater clarity and consistency.</p>
                        
                        <div class="quick-ref">
                            <p><i class="ri-double-quotes-L" style="color: #8BC905;"></i> The market is a reflection of human psychology. Master yourself before trying to master the market. <i class="ri-double-quotes-R" style="color: #8BC905;"></i></p>
                        </div>
                    </div>

                    <!-- Core Psychology Cards -->
                    <div id="core-psychology" class="edu-section">
                        <h2><span>Core</span> Trading Psychology</h2>
                        
                        <div class="psychology-grid">
                            <div class="psychology-card">
                                <div class="card-icon">
                                    <i class="ri-brain-fill"></i>
                                </div>
                                <h4>Perception & Expectation</h4>
                                <p>Trading decisions are influenced by how we perceive market movement and what we expect to happen next. These biases can cloud objective analysis.</p>
                                <div class="example-box">
                                    <small>EXAMPLE</small>
                                    <p>After three winning trades, you might expect the fourth to win too - leading to overconfidence and larger positions.</p>
                                </div>
                            </div>

                            <div class="psychology-card">
                                <div class="card-icon">
                                    <i class="ri-emotion-fill"></i>
                                </div>
                                <h4>Emotional Influence</h4>
                                <p>Fear, greed, frustration, and euphoria directly impact decision-making. Recognizing these states is the first step to controlling them.</p>
                                <div class="example-box">
                                    <small>EXAMPLE</small>
                                    <p>Fear after a loss might cause you to exit winning trades too early, missing out on profits.</p>
                                </div>
                            </div>

                            <div class="psychology-card">
                                <div class="card-icon">
                                    <i class="ri-mental-health-fill"></i>
                                </div>
                                <h4>Reaction vs Response</h4>
                                <p>Reacting is impulsive. Responding is deliberate. Psychology helps bridge the gap between market stimulus and your trading decisions.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Emotional Spectrum -->
                    <div id="emotional-awareness" class="edu-section">
                        <h2><span>Emotional</span> Awareness & Control</h2>
                        
                        <div class="emotion-grid">
                            <div class="emotion-card good">
                                <div class="emotion-icon">
                                    <i class="ri-emotion-happy-fill"></i>
                                </div>
                                <h6>Confidence</h6>
                                <p>Healthy self-trust in your process</p>
                            </div>
                            <div class="emotion-card bad">
                                <div class="emotion-icon">
                                    <i class="ri-emotion-unhappy-fill"></i>
                                </div>
                                <h6>Fear</h6>
                                <p>Leads to missed opportunities, early exits</p>
                            </div>
                            <div class="emotion-card bad">
                                <div class="emotion-icon" >
                                  <i class="ri-emotion-unhappy-fill"></i>
                                </div>
                                <h6>Frustration</h6>
                                <p>Causes revenge trading, chasing losses</p>
                            </div>
                            <div class="emotion-card good">
                                <div class="emotion-icon">
                                    <i class="ri-emotion-normal-fill"></i>
                                </div>
                                <h6>Balance</h6>
                                <p>Emotional equilibrium during volatility</p>
                            </div>
                            <div class="emotion-card bad">
                                <div class="emotion-icon">
                                    <i class="ri-emotion-laugh-fill"></i>
                                </div>
                                <h6>Euphoria</h6>
                                <p>Overconfidence after wins, leads to overtrading</p>
                            </div>
                            <div class="emotion-card good">
                                <div class="emotion-icon">
                                    <i class="ri-emotion-fill"></i>
                                </div>
                                <h6>Acceptance</h6>
                                <p>Embracing losses as part of the process</p>
                            </div>
                        </div>

                        <div class="example-box mt-3">
                            <small> EMOTIONAL AUDIT</small>
                            <p>Before each trade, ask: "What emotion am I feeling right now?" If it's fear or euphoria, step away.</p>
                        </div>
                    </div>

                    <!-- Risk Control Framework -->
                    <div id="risk-control" class="edu-section">
                        <h2><span>Risk Control</span> as a Stabilizing Force</h2>
                        <p>Risk control provides structure when markets become unpredictable. Having clear boundaries around exposure reduces stress and supports steadier decision-making.</p>
                        
                        <div class="framework-grid">
                            <div class="framework-item">
                                <div class="framework-icon">
                                    <i class="ri-scales-fill"></i>
                                </div>
                                <div class="framework-content">
                                    <h6>Fixed Risk Per Trade</h6>
                                    <p>Risk 1% or less on every trade, regardless of confidence level</p>
                                </div>
                            </div>
                            <div class="framework-item">
                                <div class="framework-icon">
                                    <i class="ri-stop-fill"></i>
                                </div>
                                <div class="framework-content">
                                    <h6>Daily Loss Limit</h6>
                                    <p>Stop trading after 2-3 consecutive losses to reset mentally</p>
                                </div>
                            </div>
                            <div class="framework-item">
                                <div class="framework-icon">
                                    <i class="ri-arrow-down-fill"></i>
                                </div>
                                <div class="framework-content">
                                    <h6>Drawdown Boundaries</h6>
                                    <p>Know your maximum allowable loss before starting</p>
                                </div>
                            </div>
                            <div class="framework-item">
                                <div class="framework-icon">
                                    <i class="ri-pause-circle-fill"></i>
                                </div>
                                <div class="framework-content">
                                    <h6>Mandatory Breaks</h6>
                                    <p>Step away after losses or during emotional periods</p>
                                </div>
                            </div>
                        </div>

                        <div class="mindset-box mt-3">
                            <h5><i class="ri-shield-fill"></i> Why Risk Control Protects Psychology</h5>
                            <ul>
                                <li><i class="ri-check-line"></i> Knowing your maximum loss removes fear of the unknown</li>
                                <li><i class="ri-check-line"></i> Fixed position sizes prevent emotional sizing decisions</li>
                                <li><i class="ri-check-line"></i> Daily limits stop revenge trading before it starts</li>
                                <li><i class="ri-check-line"></i> Structure creates calm in chaos</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Developing Discipline -->
                    <div id="discipline" class="edu-section">
                        <h2><span>Developing</span> Discipline Over Time</h2>
                        <p>Discipline is built gradually through experience, reflection, and adjustment. Consistency in behavior emerges as traders learn to trust their process.</p>
                        
                        <div class="discipline-timeline">
                            <div class="timeline-item">
                                <div class="timeline-number">1</div>
                                <div class="timeline-content">
                                    <h5>Awareness Phase</h5>
                                    <p>Notice when emotions influence decisions. Journal your mental state before and after each trade.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-number">2</div>
                                <div class="timeline-content">
                                    <h5>Practice Phase</h5>
                                    <p>Deliberately follow rules even when emotions urge you to deviate. Build the muscle of discipline.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-number">3</div>
                                <div class="timeline-content">
                                    <h5>Integration Phase</h5>
                                    <p>Discipline becomes automatic. You follow rules without conscious effort.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-number">4</div>
                                <div class="timeline-content">
                                    <h5>Mastery Phase</h5>
                                    <p>You trust your process completely. Emotions no longer drive decisions.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Psychology as Learning Tool -->
                    <div id="learning-tool" class="edu-section">
                        <h2><span>Psychology as</span> a Learning Tool</h2>
                        <p>Moments of emotional discomfort often highlight areas for growth. Viewing psychology as feedback rather than a flaw supports long-term development.</p>
                        
                        <div class="tools-grid">
                            <div class="tool-card">
                                <h6><i class="ri-book-open-fill"></i> Trading Journal</h6>
                                <p>Record not just your trades, but your emotional state before, during, and after.</p>
                                <div class="tool-tip">📝 "Entered trade feeling anxious - result: closed early for small profit"</div>
                            </div>
                            <div class="tool-card">
                                <h6><i class="ri-repeat-fill"></i> Pattern Recognition</h6>
                                <p>Identify emotional patterns. Do you always get fearful after two losses? Do you get overconfident after a big win?</p>
                            </div>
                            <div class="tool-card">
                                <h6><i class="ri-calendar-check-fill"></i> Weekly Review</h6>
                                <p>Review your psychological patterns weekly, not just your P&L.</p>
                            </div>
                        </div>

                        <div class="example-box mt-3">
                            <small> FEEDBACK LOOP</small>
                            <p>Every emotional reaction is data. Frustration after a loss? Maybe your position size was too large. Euphoria after a win? Time to check if you're getting overconfident.</p>
                        </div>
                    </div>

                    <!-- Practical Tools -->
                    <div id="practical-tools" class="edu-section">
                        <h2><span>Practical</span> Psychology Tools</h2>
                        
                        <div class="psychology-grid">
                            <div class="psychology-card">
                                <h4>The Pause Button</h4>
                                <p>After 2 consecutive losses, stop trading for the day. No exceptions.</p>
                                <div class="example-box">
                                    <small> WHY IT WORKS</small>
                                    <p>Prevents revenge trading and emotional decision-making</p>
                                </div>
                            </div>
                            <div class="psychology-card">
                                <h4>Pre-Trade Checklist</h4>
                                <p>Before each trade, verify: Is this in my plan? Is my position size correct? Am I calm?</p>
                            </div>
                            <div class="psychology-card">
                                <h4>Meditation/Mindfulness</h4>
                                <p>5 minutes before trading to center yourself and reduce emotional reactivity.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Common Psychological Mistakes -->
                    <div id="common-mistakes" class="edu-section">
                        <h2><span>Common</span> Psychological Mistakes</h2>
                        
                        <div class="psychology-grid">
                            <div class="psychology-card" style="border-left: 4px solid #dc3545;">
                                <h4 style="color: #dc3545;">Revenge Trading</h4>
                                <p>Trying to immediately recover losses by taking impulsive, oversized trades.</p>
                            </div>
                            <div class="psychology-card" style="border-left: 4px solid #dc3545;">
                                <h4 style="color: #dc3545;">Overconfidence</h4>
                                <p>After wins, increasing position sizes or ignoring rules because you feel invincible.</p>
                            </div>
                            <div class="psychology-card" style="border-left: 4px solid #dc3545;">
                                <h4 style="color: #dc3545;">Analysis Paralysis</h4>
                                <p>Fear of making the wrong decision leads to missing good opportunities.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Key Takeaways -->
                    <div id="takeaways" class="edu-section">
                        <div class="mindset-box">
                            <h5><i class="ri-star-fill"></i> Key Takeaways</h5>
                            <ul>
                                <li><i class="ri-check-line"></i> Technical skill is only half the equation - psychology drives execution</li>
                                <li><i class="ri-check-line"></i> Emotions are data, not directives. Observe them without acting</li>
                                <li><i class="ri-check-line"></i> Risk control creates the structure that protects your psychology</li>
                                <li><i class="ri-check-line"></i> Discipline is built gradually through consistent practice</li>
                                <li><i class="ri-check-line"></i> Every emotional reaction is feedback for improvement</li>
                                <li><i class="ri-check-line"></i> The goal is not to eliminate emotions, but to prevent them from driving decisions</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Daily Practice -->
                    <div id="daily-practice" class="edu-section">
                        <h2><span>Daily</span> Practice</h2>
                        
                        <div class="psychology-card">
                            <h5>Morning Mental Preparation</h5>
                            <ol style="color: #4A5C5A; padding-left: 1.2rem;">
                                <li class="mb-2">Review your trading plan and risk rules</li>
                                <li class="mb-2">Check your emotional state - are you calm and focused?</li>
                                <li class="mb-2">Set a goal for process adherence, not profit</li>
                                <li class="mb-2">Decide your daily loss limit BEFORE markets open</li>
                                <li class="mb-2">Visualize yourself following rules perfectly, regardless of outcome</li>
                            </ol>
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
                            <li><a href="#intro" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>The Mind-Body of Trading</a></li>
                            <li><a href="#core-psychology" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Core Psychology</a></li>
                            <li><a href="#emotional-awareness" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Emotional Awareness</a></li>
                            <li><a href="#risk-control" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Risk Control</a></li>
                            <li><a href="#discipline" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Developing Discipline</a></li>
                            <li><a href="#learning-tool" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Psychology as Learning Tool</a></li>
                            <li><a href="#practical-tools" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Practical Tools</a></li>
                            <li><a href="#common-mistakes" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Common Mistakes</a></li>
                            <li><a href="#takeaways" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Key Takeaways</a></li>
                            <li><a href="#daily-practice" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Daily Practice</a></li>
                        </ul>
                    </div>

                    <!-- Related Topics -->
                    <div class="sidebar-section">
                        <h4>Related Topics</h4>
                        <ul>
                            <li><a href="{{ route('education.psychology2') }}"><i class="ri-arrow-right-s-line"></i>Why Traders Fail</a></li>
                            <li><a href="{{ route('education.consistency-rules') }}"><i class="ri-arrow-right-s-line"></i>Consistency Rules</a></li>
                            <li><a href="{{ route('education.trailing-drawdown') }}"><i class="ri-arrow-right-s-line"></i>Drawdown Explained</a></li>
                            <li><a href="{{ route('education.make-living-trading') }}"><i class="ri-arrow-right-s-line"></i>Making a Living</a></li>
                        </ul>
                    </div>

                    <!-- Quick Tip -->
                    <div class="tip-box">
                        <h6><i class="ri-lightbulb-flash-fill"></i> Daily Reminder</h6>
                        <p>"My only job today is to follow my rules perfectly. Profits will follow process."</p>
                    </div>

                    <!-- Journal Prompt -->
                    <div style="background: #0C3A30; border-radius: 16px; padding: 1.2rem; margin-top: 1.5rem;">
                        <p style="color: white; font-size: 0.9rem; margin-bottom: 0.8rem;"><i class="ri-book-open-fill me-2" style="color: #8BC905;"></i> <strong>Psychology Journal</strong></p>
                        <p style="color: rgba(255,255,255,0.7); font-size: 0.85rem; margin-bottom: 1rem;">Track your emotional patterns to identify areas for growth.</p>
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