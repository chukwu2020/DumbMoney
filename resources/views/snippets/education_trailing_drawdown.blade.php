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

    /* Visual Diagram */
    .drawdown-diagram {
        background: linear-gradient(145deg, #f8fff8, #f0f9f0);
        border-radius: 24px;
        padding: 2rem;
        margin: 2rem 0;
        border: 1px solid rgba(139,201,5,0.3);
    }

    .chart-container {
        position: relative;
        height: 300px;
        margin: 2rem 0;
        background: rgba(139,201,5,0.02);
        border-radius: 16px;
        padding: 1rem;
    }

    .chart-line {
        position: relative;
        height: 200px;
        width: 100%;
        background: linear-gradient(90deg, 
            rgba(139,201,5,0.1) 0%, 
            rgba(139,201,5,0.05) 100%);
        border-radius: 8px;
        margin-bottom: 2rem;
    }

    .chart-points {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .point {
        position: absolute;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #8BC905;
        transform: translate(-50%, -50%);
    }

    .point-label {
        position: absolute;
        transform: translate(-50%, -100%);
        font-size: 0.8rem;
        color: #4A5C5A;
        white-space: nowrap;
    }

    /* Note Cards */
    .notes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    .note-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 10px 25px -10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(139,201,5,0.2);
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

    .note-card h4 {
        color: #0C3A30;
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.8rem;
    }

    .note-card p {
        color: #6c7c7a;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .example-box {
        background: rgba(139,201,5,0.05);
        border-radius: 12px;
        padding: 0.8rem;
        margin-top: 0.8rem;
        border-left: 3px solid #8BC905;
    }

    .example-box small {
        color: #0C3A30;
        font-weight: 600;
        display: block;
        margin-bottom: 0.3rem;
    }

    .example-box p {
        font-size: 0.85rem;
        margin-bottom: 0;
        color: #4A5C5A;
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

    .static-card h5 {
        border-bottom-color: #8BC905;
    }

    .trailing-card h5 {
        border-bottom-color: #dc3545;
    }

    .comparison-item {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 0.8rem;
        color: #4A5C5A;
    }

    .comparison-item i {
        font-size: 1.1rem;
    }

    .static-card .comparison-item i {
        color: #8BC905;
    }

    .trailing-card .comparison-item i {
        color: #dc3545;
    }

    /* Scenario Cards */
    .scenario-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin: 2rem 0;
    }

    .scenario-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid rgba(139,201,5,0.2);
        position: relative;
        overflow: hidden;
    }

    .scenario-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(139,201,5,0.1);
        color: #8BC905;
        padding: 0.2rem 0.8rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .scenario-card.good .scenario-badge {
        background: rgba(139,201,5,0.15);
        color: #0C3A30;
    }

    .scenario-card.bad .scenario-badge {
        background: rgba(220,53,69,0.1);
        color: #dc3545;
    }

    .mini-chart {
        height: 60px;
        background: linear-gradient(90deg, #8BC905 30%, #ffc107 30% 60%, #dc3545 60%);
        border-radius: 8px;
        margin: 1rem 0;
    }

    /* Key Takeaways */
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
.breadcrumb-item::after,
.breadcrumb-item::before,
.breadcrumb li::after,
.breadcrumb li::before {
    content: none !important;
    display: none !important;
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
        .notes-grid {
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
                        <li class="breadcrumb-item active">Trailing Drawdown Explained</li>
                    </ol>
                </nav>
                <h1>Trailing Drawdown Explained</h1>
                <p class="text-white-50" style="font-size: 1.2rem;">Understanding dynamic risk boundaries that adjust with your account performance</p>
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
                        <h2><span>What is</span> Trailing Drawdown?</h2>
                        <p>Trailing drawdown is a dynamic risk concept where your allowable loss limit moves (or "trails") alongside your account equity as it grows. Rather than remaining fixed, the boundary adjusts to reflect changes in performance over time.</p>
                        <p>Think of it as a protective mechanism that locks in profits by raising your floor as your account balance increases.</p>
                        
                        <div class="drawdown-diagram">
                            <h5 style="color: #0C3A30; margin-bottom: 1.5rem;"> Visual Example: How Trailing Drawdown Works</h5>
                            <div class="chart-container">
                                <svg width="100%" height="200" viewBox="0 0 600 200" style="background: rgba(139,201,5,0.02); border-radius: 8px;">
                                    <!-- Account balance line -->
                                    <polyline points="50,150 150,120 250,80 350,100 450,60 550,40" 
                                              fill="none" stroke="#8BC905" stroke-width="3" />
                                    
                                    <!-- Trailing drawdown line -->
                                    <polyline points="50,170 150,140 250,100 350,120 450,80 550,60" 
                                              fill="none" stroke="#dc3545" stroke-width="2" stroke-dasharray="5,3" />
                                    
                                    <!-- Labels -->
                                    <text x="50" y="140" fill="#8BC905" font-size="12">Account Balance</text>
                                    <text x="50" y="190" fill="#dc3545" font-size="12">Trailing Drawdown Limit</text>
                                    
                                    <!-- Points -->
                                    <circle cx="50" cy="150" r="4" fill="#8BC905" />
                                    <circle cx="150" cy="120" r="4" fill="#8BC905" />
                                    <circle cx="250" cy="80" r="4" fill="#8BC905" />
                                    <circle cx="350" cy="100" r="4" fill="#8BC905" />
                                    <circle cx="450" cy="60" r="4" fill="#8BC905" />
                                    <circle cx="550" cy="40" r="4" fill="#8BC905" />
                                </svg>
                            </div>
                            <p class="text-center text-muted small">As your account grows (green line), the trailing drawdown limit (red dashed line) moves up, protecting your profits.</p>
                        </div>
                    </div>

                    <!-- Key Concepts Grid -->
                    <div id="key-concepts" class="edu-section">
                        <h2><span>Key Concepts</span> Explained</h2>
                        
                        <div class="notes-grid">
                            <div class="note-card">
                                <div class="note-icon">
                                    <i class="ri-arrow-up-circle-fill"></i>
                                </div>
                                <h4>Dynamic Adjustment</h4>
                                <p>Unlike fixed limits, trailing boundaries move upward as your account grows, locking in profits along the way.</p>
                                <div class="example-box">
                                    <small>📈 EXAMPLE</small>
                                    <p>Start: $50,000 → Grow to $55,000 → New floor at $51,700 (6% from peak)</p>
                                </div>
                            </div>

                            <div class="note-card">
                                <div class="note-icon">
                                    <i class="ri-lock-fill"></i>
                                </div>
                                <h4>Profit Protection</h4>
                                <p>Each time you reach a new high, the drawdown limit resets higher, protecting your gains.</p>
                                <div class="example-box">
                                    <small>🛡️ PROTECTION</small>
                                    <p>New peak at $60,000 means you can't lose back below $56,400 (assuming 6% limit)</p>
                                </div>
                            </div>

                            <div class="note-card">
                                <div class="note-icon">
                                    <i class="ri-alert-fill"></i>
                                </div>
                                <h4>Risk Awareness</h4>
                                <p>Large swings have greater impact - both gains raise your floor and losses bring you closer to the limit.</p>
                                <div class="example-box">
                                    <small>⚠️ WARNING</small>
                                    <p>A 10% gain followed by 8% loss might violate rules despite net positive</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fixed vs Trailing Comparison -->
                    <div id="comparison" class="edu-section">
                        <h2><span>Fixed vs</span> Trailing Drawdown</h2>
                        
                        <div class="comparison-section">
                            <div class="comparison-grid">
                                <div class="comparison-card static-card">
                                    <h5>📌 Fixed Drawdown</h5>
                                    <div class="comparison-item">
                                        <i class="ri-checkbox-circle-fill"></i>
                                        <span>Static limit from starting balance</span>
                                    </div>
                                    <div class="comparison-item">
                                        <i class="ri-checkbox-circle-fill"></i>
                                        <span>Example: $50,000 account, 6% limit = $47,000 floor</span>
                                    </div>
                                    <div class="comparison-item">
                                        <i class="ri-checkbox-circle-fill"></i>
                                        <span>Floor never changes, even after profits</span>
                                    </div>
                                    <div class="example-box mt-3">
                                        <p>Grow to $55,000, still can't go below $47,000</p>
                                    </div>
                                </div>
                                
                                <div class="comparison-card trailing-card">
                                    <h5>📈 Trailing Drawdown</h5>
                                    <div class="comparison-item">
                                        <i class="ri-close-circle-fill"></i>
                                        <span>Dynamic limit based on peak balance</span>
                                    </div>
                                    <div class="comparison-item">
                                        <i class="ri-close-circle-fill"></i>
                                        <span>Example: $50,000 start, 6% limit = $47,000 floor</span>
                                    </div>
                                    <div class="comparison-item">
                                        <i class="ri-close-circle-fill"></i>
                                        <span>Floor rises with new peaks</span>
                                    </div>
                                    <div class="example-box mt-3">
                                        <p>Grow to $55,000 → New floor at $51,700</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Real-World Scenarios -->
                    <div id="scenarios" class="edu-section">
                        <h2><span>Real-World</span> Scenarios</h2>
                        
                        <div class="scenario-grid">
                            <div class="scenario-card good">
                                <div class="scenario-badge">✅ GOOD</div>
                                <h5>Steady Growth</h5>
                                <div class="mini-chart" style="background: linear-gradient(90deg, #8BC905 20%, #8BC905 40%, #8BC905 60%, #8BC905 80%);"></div>
                                <p class="small mb-1">Week 1: +2% → Week 2: +1.5% → Week 3: +2% → Week 4: +1%</p>
                                <p class="small text-muted">Trailing limit protects each gain, floor rises steadily</p>
                            </div>
                            
                            <div class="scenario-card bad">
                                <div class="scenario-badge">⚠️ RISKY</div>
                                <h5>Large Swing</h5>
                                <div class="mini-chart" style="background: linear-gradient(90deg, #8BC905 30%, #ffc107 30% 60%, #dc3545 60%);"></div>
                                <p class="small mb-1">Week 1: +8% → Week 2: -6% → Week 3: +4% → Week 4: -5%</p>
                                <p class="small text-muted">Despite net gain, volatility risks violation</p>
                            </div>
                            
                            <div class="scenario-card bad">
                                <div class="scenario-badge">❌ DANGER</div>
                                <h5>Deep Pullback</h5>
                                <div class="mini-chart" style="background: linear-gradient(90deg, #8BC905 20%, #8BC905 20% 40%, #dc3545 40% 100%);"></div>
                                <p class="small mb-1">Grow 10% to $55,000, then lose 8% ($4,400)</p>
                                <p class="small text-muted">With 6% trailing limit ($3,300 max loss) → Violation at $51,700 floor</p>
                            </div>
                        </div>
                    </div>

                    <!-- Why Trailing Drawdown Matters -->
                    <div id="why-matters" class="edu-section">
                        <h2><span>Why Trailing</span> Drawdown Matters</h2>
                        
                        <div class="notes-grid">
                            <div class="note-card">
                                <h4>Encourages Consistency</h4>
                                <p>Rewards steady, controlled growth over risky, volatile trading. Large swings become dangerous.</p>
                            </div>
                            <div class="note-card">
                                <h4>Protects Profits</h4>
                                <p>Locks in gains by raising the floor, preventing you from giving back hard-earned profits.</p>
                            </div>
                            <div class="note-card">
                                <h4>Teaches Discipline</h4>
                                <p>Forces you to manage risk actively, not just set and forget.</p>
                            </div>
                            <div class="note-card">
                                <h4>Realistic Risk Management</h4>
                                <p>Reflects how professional traders think - protecting capital while pursuing growth.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Common Mistakes -->
                    <div id="mistakes" class="edu-section">
                        <h2><span>Common</span> Mistakes</h2>
                        
                        <div class="notes-grid">
                            <div class="note-card">
                                <div class="note-icon">
                                    <i class="ri-flashlight-fill"></i>
                                </div>
                                <h4>Chasing Big Wins</h4>
                                <p>Large gains feel great but set a much higher floor. One big loss can wipe out months of work.</p>
                            </div>
                            <div class="note-card">
                                <div class="note-icon">
                                    <i class="ri-mental-health-fill"></i>
                                </div>
                                <h4>Ignoring the Trail</h4>
                                <p>Forgetting that your floor has risen leads to overconfidence and unnecessary risk.</p>
                            </div>
                            <div class="note-card">
                                <div class="note-icon">
                                    <i class="ri-repeat-fill"></i>
                                </div>
                                <h4>Revenge Trading</h4>
                                <p>After a loss, trying to recover quickly pushes you closer to the trailing limit.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Key Takeaways -->
                    <div id="takeaways" class="edu-section">
                        <div class="takeaway-box">
                            <h5><i class="ri-star-fill"></i> Key Takeaways</h5>
                            <ul>
                                <li><i class="ri-check-line"></i> Trailing drawdown moves UP with your account, never down</li>
                                <li><i class="ri-check-line"></i> Each new peak creates a higher floor, protecting profits</li>
                                <li><i class="ri-check-line"></i> Rewards consistency, punishes volatility</li>
                                <li><i class="ri-check-line"></i> Always know your current drawdown limit before trading</li>
                                <li><i class="ri-check-line"></i> Think in terms of risk per trade relative to your trailing limit</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Practical Tips -->
                    <div id="tips" class="edu-section">
                        <h2><span>Practical</span> Tips</h2>
                        
                        <div class="notes-grid">
                            <div class="note-card">
                                <h5>Track Your Peak</h5>
                                <p>Always know your account's highest point to calculate current trailing limit.</p>
                                <div class="example-box">
                                    <small> FORMULA</small>
                                    <p>Current Floor = Peak Balance × (1 - Drawdown %)</p>
                                </div>
                            </div>
                            <div class="note-card">
                                <h5>Risk Small</h5>
                                <p>Risk 0.5-1% per trade to avoid large swings that threaten your trailing limit.</p>
                            </div>
                            <div class="note-card">
                                <h5>Take Profits</h5>
                                <p>Regular profit-taking locks in gains and raises your floor permanently.</p>
                            </div>
                            <div class="note-card">
                                <h5>Know Your Numbers</h5>
                                <p>Calculate exactly how much drawdown room you have before each trading session.</p>
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
                            <li><a href="#intro" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>What is Trailing Drawdown?</a></li>
                            <li><a href="#key-concepts" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Key Concepts</a></li>
                            <li><a href="#comparison" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Fixed vs Trailing</a></li>
                            <li><a href="#scenarios" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Real-World Scenarios</a></li>
                            <li><a href="#why-matters" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Why It Matters</a></li>
                            <li><a href="#mistakes" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Common Mistakes</a></li>
                            <li><a href="#takeaways" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Key Takeaways</a></li>
                            <li><a href="#tips" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Practical Tips</a></li>
                        </ul>
                    </div>

                    <!-- Related Topics -->
                    <div class="sidebar-section">
                        <h4>Related Topics</h4>
                        <ul>
                            <li><a href="{{ route('education.consistency-rules') }}"><i class="ri-arrow-right-s-line"></i>Consistency Rules</a></li>
                            <li><a href="{{ route('education.psychology1') }}"><i class="ri-arrow-right-s-line"></i>Risk Control</a></li>
                            <li><a href="{{ route('education.make-living-trading') }}"><i class="ri-arrow-right-s-line"></i>Making a Living</a></li>
                        </ul>
                    </div>

                    <!-- Quick Tip -->
                    <div class="tip-box">
                        <h6><i class="ri-lightbulb-flash-fill" style="color: #8BC905;"></i> Quick Tip</h6>
                        <p>Think of trailing drawdown like a rising floor in a building - as you climb higher (profits), the floor below you rises, protecting you from falling too far.</p>
                    </div>

                    <!-- Calculator Teaser -->
                    <div style="background: #0C3A30; border-radius: 16px; padding: 1.2rem; margin-top: 1.5rem;">
                        <p style="color: white; font-size: 0.9rem; margin-bottom: 0.8rem;"><i class="ri-calculator-line me-2" style="color: #8BC905;"></i> <strong>Know Your Numbers</strong></p>
                        <p style="color: rgba(255,255,255,0.7); font-size: 0.85rem; margin-bottom: 1rem;">Calculate your current drawdown room before each trading session.</p>
                        <a href="{{ route('signup') }}" style="background: #8BC905; color: #0C3A30; padding: 0.4rem 1rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; text-decoration: none; display: inline-block;">Calculate Now →</a>
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