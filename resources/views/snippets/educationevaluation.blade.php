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

    /* Evaluation Notes Section */
    .evaluation-notes {
        background: linear-gradient(145deg, #f8fff8, #f0f9f0);
        border-radius: 24px;
        padding: 2rem;
        margin: 2rem 0;
        border: 1px solid rgba(139,201,5,0.3);
    }

    .notes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    .note-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 10px 25px -10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .note-card:hover {
        transform: translateY(-5px);
        border-color: #8BC905;
        box-shadow: 0 20px 30px -12px rgba(139,201,5,0.2);
    }

    .note-icon {
        width: 50px;
        height: 50px;
        background: rgba(139,201,5,0.1);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .note-icon i {
        font-size: 1.8rem;
        color: #8BC905;
    }

    .note-card h5 {
        color: #0C3A30;
        font-weight: 600;
        margin-bottom: 0.8rem;
        font-size: 1.2rem;
    }

    .note-card p {
        color: #6c7c7a;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .note-tag {
        display: inline-block;
        background: rgba(139,201,5,0.1);
        color: #8BC905;
        padding: 0.3rem 0.8rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .example-box {
        background: rgba(139,201,5,0.05);
        border-radius: 16px;
        padding: 1rem;
        margin-top: 1rem;
        border-left: 3px solid #8BC905;
    }

    .example-box small {
        color: #4A5C5A;
        display: block;
        margin-bottom: 0.3rem;
        font-weight: 600;
    }

    .example-box p {
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    /* Rules Grid */
    .rules-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.2rem;
        margin: 1.5rem 0;
    }

    .rule-item {
        background: white;
        border: 1px solid rgba(139,201,5,0.2);
        border-radius: 16px;
        padding: 1.2rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .rule-item:hover {
        border-color: #8BC905;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px -10px rgba(139,201,5,0.2);
    }

    .rule-icon {
        width: 50px;
        height: 50px;
        background: rgba(139,201,5,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.8rem;
    }

    .rule-icon i {
        font-size: 1.5rem;
        color: #8BC905;
    }

    .rule-item h6 {
        color: #0C3A30;
        font-weight: 600;
        margin-bottom: 0.3rem;
    }

    .rule-item p {
        color: #6c7c7a;
        font-size: 0.85rem;
        margin-bottom: 0;
    }

    /* Process Timeline */
    .process-timeline {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 2rem 0;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .timeline-step {
        flex: 1;
        min-width: 200px;
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid rgba(139,201,5,0.2);
        position: relative;
    }

    .timeline-step::after {
        content: '→';
        position: absolute;
        right: -20px;
        top: 50%;
        transform: translateY(-50%);
        color: #8BC905;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .timeline-step:last-child::after {
        display: none;
    }
.breadcrumb-item::after,
.breadcrumb-item::before,
.breadcrumb li::after,
.breadcrumb li::before {
    content: none !important;
    display: none !important;
}
    .step-number {
        width: 30px;
        height: 30px;
        background: #8BC905;
        color: #0C3A30;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .timeline-step h5 {
        color: #0C3A30;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }

    .timeline-step p {
        color: #6c7c7a;
        font-size: 0.9rem;
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

    /* Tip Box */
    .tip-box {
        background: rgba(139,201,5,0.05);
        border-radius: 16px;
        padding: 1.5rem;
        margin-top: 1.5rem;
        border: 1px dashed #8BC905;
    }

    .tip-box h6 {
        color: #0C3A30;
        font-weight: 600;
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .tip-box p {
        color: #6c7c7a;
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
        .notes-grid {
            grid-template-columns: 1fr;
        }
        .process-timeline {
            flex-direction: column;
        }
        .timeline-step::after {
            display: none;
        }
    }

    @media (max-width: 767px) {
        .edu-section h2 {
            font-size: 1.5rem;
        }
        .rules-grid {
            grid-template-columns: 1fr 1fr;
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
                        <li class="breadcrumb-item active">How Evaluations Work</li>
                    </ol>
                </nav>
                <h1>How Trading Evaluations Work</h1>
                <p class="text-white-50" style="font-size: 1.2rem;">Understanding the process of proving your trading skills to access capital</p>
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
                    <div id="evaluation-intro" class="edu-section">
                        <h2><span>Evaluation</span> Fundamentals</h2>
                        <p>Trading evaluations are designed to determine whether a trader can manage risk consistently in live market conditions. Before accessing firm capital, traders must trade an evaluation account and follow predefined rules that mirror real funded trading environments.</p>
                        <p>The evaluation phase exists to measure <strong>discipline</strong>, not short-term performance spikes. It's about proving you can protect capital while generating consistent returns.</p>
                        
                        <div class="evaluation-notes">
                            <h5 style="color: #0C3A30; margin-bottom: 1rem;">🎯 Key Purpose</h5>
                            <p>To separate traders who rely on luck from those who have genuine skill and risk management abilities.</p>
                        </div>
                    </div>

                    <!-- Purpose of Evaluation -->
                    <div id="evaluation-purpose" class="edu-section">
                        <h2>Purpose of a <span>Evaluation Account</span></h2>
                        <p>A evaluation account is used to assess how a trader handles drawdowns, position sizing, and emotional pressure. The goal is to confirm that profits are generated through controlled execution rather than aggressive risk taking.</p>
                        
                        <div class="notes-grid mt-4">
                            <div class="note-card">
                                <div class="note-icon">
                                    <i class="ri-psychotherapy-fill"></i>
                                </div>
                                <h5>Psychological Assessment</h5>
                                <p>How do you handle losing streaks? Can you stick to your plan under pressure?</p>
                                <span class="note-tag">Mindset</span>
                            </div>
                            <div class="note-card">
                                <div class="note-icon">
                                    <i class="ri-scales-fill"></i>
                                </div>
                                <h5>Risk Management</h5>
                                <p>Do you risk too much on single trades? Can you follow drawdown limits?</p>
                                <span class="note-tag">Discipline</span>
                            </div>
                            <div class="note-card">
                                <div class="note-icon">
                                    <i class="ri-line-chart-fill"></i>
                                </div>
                                <h5>Consistency</h5>
                                <p>Are your profits repeatable or just lucky one-time wins?</p>
                                <span class="note-tag">Skill</span>
                            </div>
                        </div>
                    </div>

                    <!-- Common Evaluation Rules -->
                    <div id="evaluation-rules" class="edu-section">
                        <h2><span>Common</span> Evaluation Rules</h2>
                        <p>Most funding programs include specific rules that are enforced automatically to ensure fairness and consistency across all traders.</p>
                        
                        <div class="rules-grid">
                            <div class="rule-item">
                                <div class="rule-icon">
                                    <i class="ri-trophy-fill"></i>
                                </div>
                                <h6>Profit Target</h6>
                                <p>Typically 8-10% gain required to pass</p>
                            </div>
                            <div class="rule-item">
                                <div class="rule-icon">
                                    <i class="ri-arrow-down-fill"></i>
                                </div>
                                <h6>Max Drawdown</h6>
                                <p>Usually 5-6% maximum loss allowed</p>
                            </div>
                            <div class="rule-item">
                                <div class="rule-icon">
                                    <i class="ri-alert-fill"></i>
                                </div>
                                <h6>Daily Loss Limit</h6>
                                <p>Often 3-4% per day maximum</p>
                            </div>
                            <div class="rule-item">
                                <div class="rule-icon">
                                    <i class="ri-calendar-fill"></i>
                                </div>
                                <h6>Min Trading Days</h6>
                                <p>Usually 5-10 minimum trading days</p>
                            </div>
                        </div>

                        <div class="example-box mt-4">
                            <small>📋 TYPICAL EVALUATION EXAMPLE:</small>
                            <p>$50,000 account • Profit Target: $5,000 (10%) • Max Drawdown: $3,000 (6%) • Daily Loss Limit: $1,500 (3%) • Minimum 10 trading days</p>
                        </div>
                    </div>

                    <!-- Why Consistency Matters -->
                    <div id="consistency-matters" class="edu-section">
                        <h2>Why <span>Consistency</span> Matters</h2>
                        <p>Trading evaluations are structured to reward repeatable performance. Large profits achieved in a single day often fail evaluation rules if they violate consistency or drawdown requirements.</p>
                        
                        <div class="notes-grid">
                            <div class="note-card">
                                <h5>Good: Consistent Growth</h5>
                                <p>+1%, +1.5%, +2%, +1%, +1.5% = Sustainable</p>
                                <span class="note-tag">✅ PASS</span>
                                <div class="example-box">
                                    <small>SKILL-BASED</small>
                                    <p>Shows controlled, repeatable strategy</p>
                                </div>
                            </div>
                            <div class="note-card">
                                <h5>Bad: One Big Win</h5>
                                <p>+8% in one day, then break even = Unsustainable</p>
                                <span class="note-tag">❌ FAIL</span>
                                <div class="example-box">
                                    <small>LUCK-BASED</small>
                                    <p>Could be gambling, not skill</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Evaluation Process Timeline -->
                    <div id="evaluation-process" class="edu-section">
                        <h2><span>Evaluation</span> Process</h2>
                        
                        <div class="process-timeline">
                            <div class="timeline-step">
                                <div class="step-number">1</div>
                                <h5>Purchase Evaluation</h5>
                                <p>Select account size and pay one-time fee</p>
                            </div>
                            <div class="timeline-step">
                                <div class="step-number">2</div>
                                <h5>Trade the Rules</h5>
                                <p>Follow profit target and drawdown limits</p>
                            </div>
                            <div class="timeline-step">
                                <div class="step-number">3</div>
                                <h5>Pass Evaluation</h5>
                                <p>Meet all requirements within time limit</p>
                            </div>
                            <div class="timeline-step">
                                <div class="step-number">4</div>
                                <h5>Get Funded</h5>
                                <p>Access firm capital and keep profits</p>
                            </div>
                        </div>
                    </div>

                    <!-- From Evaluation to Funded -->
                    <div id="evaluation-to-funded" class="edu-section">
                        <h2><span>From Evaluation</span> to Funded</h2>
                        <p>Once a trader passes the evaluation phase, they move into funded trading using firm capital. While profit targets are removed or adjusted, risk rules remain in place to protect capital and ensure long term sustainability.</p>
                        
                        <div class="highlight-box mt-4" style="background: white; border: 1px solid #8BC905; padding: 1.5rem; border-radius: 16px;">
                            <div class="key-point">
                                <i class="ri-shield-check-fill" style="color: #8BC905; font-size: 1.5rem;"></i>
                                <div>
                                    <strong>Funded Phase Changes:</strong>
                                    <p class="mb-0">• Profit targets removed or reduced<br>• Drawdown limits remain active<br>• Profit splits begin (usually 80-90% to trader)<br>• Regular payouts available</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Common Mistakes -->
                    <div id="common-mistakes" class="edu-section">
                        <h2><span>Common</span> Evaluation Mistakes</h2>
                        
                        <div class="notes-grid">
                            <div class="note-card">
                                <h5>Overtrading</h5>
                                <p>Taking too many trades to hit target quickly</p>
                                <span class="note-tag">❌ Mistake</span>
                            </div>
                            <div class="note-card">
                                <h5>Ignoring Drawdown</h5>
                                <p>Letting losses accumulate without stopping</p>
                                <span class="note-tag">❌ Mistake</span>
                            </div>
                            <div class="note-card">
                                <h5>No Trading Plan</h5>
                                <p>Trading without clear entry/exit rules</p>
                                <span class="note-tag">❌ Mistake</span>
                            </div>
                            <div class="note-card">
                                <h5>Revenge Trading</h5>
                                <p>Trying to recover losses quickly</p>
                                <span class="note-tag">❌ Mistake</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('education.psychology2') }}" class="trading-link mt-3" style="display: inline-block; color: #8BC905;">Learn why traders fail →</a>
                    </div>
                </div>
            </div>

            <!-- Sidebar Column -->
            <div class="col-lg-4">
                <div class="edu-sidebar" data-aos="fade-left" data-aos-duration="800">
                    
                    <!-- Evaluation Basics -->
                    <div class="sidebar-section">
                        <h4>Evaluation Basics</h4>
                        <ul>
                            <li><a href="#evaluation-intro" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Evaluation Fundamentals</a></li>
                            <li><a href="#evaluation-purpose" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Purpose of Evaluation</a></li>
                            <li><a href="#evaluation-rules" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Common Rules</a></li>
                            <li><a href="#consistency-matters" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Why Consistency Matters</a></li>
                            <li><a href="#evaluation-process" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Evaluation Process</a></li>
                            <li><a href="#evaluation-to-funded" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Getting Funded</a></li>
                            <li><a href="#common-mistakes" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Common Mistakes</a></li>
                        </ul>
                    </div>

                    <!-- Related Topics -->
                    <div class="sidebar-section">
                        <h4>Related Topics</h4>
                        <ul>
                            <li><a href="{{ route('education.funding') }}"><i class="ri-arrow-right-s-line"></i>Funding Explained</a></li>
                            <li><a href="{{ route('education.prop-firms') }}"><i class="ri-arrow-right-s-line"></i>Are Prop Firms Legit?</a></li>
                            <li><a href="{{ route('education.trailing-drawdown') }}"><i class="ri-arrow-right-s-line"></i>Drawdown Explained</a></li>
                            <li><a href="{{ route('education.consistency-rules') }}"><i class="ri-arrow-right-s-line"></i>Consistency Rules</a></li>
                            <li><a href="{{ route('education.psychology2') }}"><i class="ri-arrow-right-s-line"></i>Why Traders Fail</a></li>
                        </ul>
                    </div>

                    <!-- Quick Tip Box -->
                    <div class="tip-box">
                        <h6><i class="ri-lightbulb-flash-fill" style="color: #8BC905;"></i> Pro Tip</h6>
                        <p>Focus on consistency, not hitting the profit target quickly. Treat the evaluation like you're already funded - protect the account first.</p>
                        <a href="#consistency-matters" style="color: #8BC905; font-weight: 600; font-size: 0.9rem;">Learn about consistency →</a>
                    </div>

                    <!-- Success Stats -->
                    <div style="background: #0C3A30; border-radius: 16px; padding: 1.2rem; margin-top: 1.5rem;">
                        <p style="color: white; font-size: 0.9rem; margin-bottom: 0.8rem;"><i class="ri-bar-chart-2-fill me-2" style="color: #8BC905;"></i> <strong>Did You Know?</strong></p>
                        <p style="color: rgba(255,255,255,0.7); font-size: 0.85rem; margin-bottom: 1rem;">Only about 45% of traders pass evaluations on their first attempt. The key is risk management, not luck.</p>
                        <a href="{{ route('education.psychology2') }}" style="background: #8BC905; color: #0C3A30; padding: 0.4rem 1rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; text-decoration: none; display: inline-block;">Improve Your Odds →</a>
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