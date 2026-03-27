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

    /* Drawdown Notes Section */
    .drawdown-notes {
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

    /* Trading Basics Cards */
    .trading-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .trading-card {
        background: linear-gradient(145deg, #f8fff8, #f0f9f0);
        border: 1px solid rgba(139,201,5,0.2);
        border-radius: 20px;
        padding: 1.8rem 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .trading-card:hover {
        transform: translateY(-5px);
        border-color: #8BC905;
        box-shadow: 0 20px 30px -12px rgba(139,201,5,0.2);
    }

    .trading-icon {
        width: 70px;
        height: 70px;
        background: rgba(139,201,5,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem;
    }

    .trading-icon i {
        font-size: 2.2rem;
        color: #8BC905;
    }

    .trading-card h4 {
        color: #0C3A30;
        font-weight: 600;
        margin-bottom: 0.8rem;
    }

    .trading-card p {
        color: #6c7c7a;
        font-size: 0.95rem;
        margin-bottom: 1.2rem;
    }
.breadcrumb-item::after,
.breadcrumb-item::before,
.breadcrumb li::after,
.breadcrumb li::before {
    content: none !important;
    display: none !important;
}
    .trading-link {
        color: #8BC905;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        cursor: pointer;
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

    /* Responsive */
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
    }

    @media (max-width: 767px) {
        .edu-section h2 {
            font-size: 1.5rem;
        }
    }

    /* Smooth Scroll */
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
                        <li class="breadcrumb-item active">Trading Education</li>
                    </ol>
                </nav>
                <h1>Trading Education</h1>
                <p class="text-white-50" style="font-size: 1.2rem;">Master the fundamentals of successful trading</p>
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
                    
                    <!-- Introduction to Trading -->
                    <div id="trading-fundamentals" class="edu-section">
                        <h2><span>Trading</span> Fundamentals</h2>
                        <p>Trading is the act of buying and selling financial instruments with the goal of generating profits. Unlike investing, which focuses on long-term growth, trading requires active participation in markets, quick decision-making, and strict risk management.</p>
                        <p>Successful traders combine technical analysis, fundamental understanding, and psychological discipline to consistently profit from market movements.</p>
                        
                        <div class="highlight-box mt-4" style="background: white; border: 1px solid #8BC905;">
                            <div class="key-point">
                                <i class="ri-key-fill" style="color: #8BC905;"></i>
                                <div>
                                    <strong>Key Takeaway</strong>
                                    <p>Trading is a skill that requires continuous learning, practice, and emotional control. Start with a solid foundation in the basics before risking real capital.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Technical Analysis -->
                    <div id="technical-analysis" class="edu-section">
                        <h2><span>Technical</span> Analysis</h2>
                        <p>Technical analysis is the study of price movements and patterns to forecast future market direction. It's based on the idea that history tends to repeat itself and that price action reflects all available information.</p>
                        
                        <div class="notes-grid mt-4">
                            <div class="note-card">
                                <div class="note-icon">
                                    <i class="ri-line-chart-fill"></i>
                                </div>
                                <h5>Price Action</h5>
                                <p>The foundation of technical analysis - studying raw price movements without indicators.</p>
                                <span class="note-tag">Core Concept</span>
                                <div class="example-box">
                                    <small>📊 EXAMPLE:</small>
                                    <p>Support and resistance levels, trend lines, and candlestick patterns</p>
                                </div>
                            </div>
                            <div class="note-card">
                                <div class="note-icon">
                                    <i class="ri-bar-chart-2-fill"></i>
                                </div>
                                <h5>Indicators</h5>
                                <p>Mathematical calculations based on price and volume to identify trends and momentum.</p>
                                <span class="note-tag">Tools</span>
                                <div class="example-box">
                                    <small>📈 POPULAR:</small>
                                    <p>Moving Averages, RSI, MACD, Bollinger Bands</p>
                                </div>
                            </div>
                            <div class="note-card">
                                <div class="note-icon">
                                    <i class="ri-stack-fill"></i>
                                </div>
                                <h5>Chart Patterns</h5>
                                <p>Recognizable formations that suggest future price movements.</p>
                                <span class="note-tag">Patterns</span>
                                <div class="example-box">
                                    <small>🔍 EXAMPLES:</small>
                                    <p>Head and Shoulders, Double Tops, Triangles, Flags</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fundamental Analysis -->
                    <div id="fundamental-analysis" class="edu-section">
                        <h2><span>Fundamental</span> Analysis</h2>
                        <p>Fundamental analysis evaluates economic, financial, and geopolitical factors that influence asset prices. It helps traders understand the "why" behind market movements.</p>
                        
                        <div class="row g-4 mt-3">
                            <div class="col-md-6">
                                <div class="key-point">
                                    <i class="ri-government-fill"></i>
                                    <div>
                                        <strong>Economic Indicators</strong>
                                        <p>GDP, employment data, inflation reports, interest rates, and central bank policies</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="key-point">
                                    <i class="ri-news-fill"></i>
                                    <div>
                                        <strong>News Events</strong>
                                        <p>Earnings reports, geopolitical events, natural disasters, and policy changes</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chart Patterns -->
                    <div id="chart-patterns" class="edu-section">
                        <h2><span>Chart</span> Patterns</h2>
                        <p>Chart patterns are specific formations that appear on price charts, signaling potential trend reversals or continuations.</p>
                        
                        <div class="notes-grid mt-4">
                            <div class="note-card">
                                <h5>Reversal Patterns</h5>
                                <p>Signal that the current trend may be ending.</p>
                                <span class="note-tag">Trend Change</span>
                                <div class="example-box">
                                    <p>Head and Shoulders, Double Top/Bottom, Rounding Bottom</p>
                                </div>
                            </div>
                            <div class="note-card">
                                <h5>Continuation Patterns</h5>
                                <p>Suggest the current trend will continue after a pause.</p>
                                <span class="note-tag">Trend Pause</span>
                                <div class="example-box">
                                    <p>Flags, Pennants, Wedges, Triangles</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Indicators Explained -->
                    <div id="indicators-explained" class="edu-section">
                        <h2><span>Indicators</span> Explained</h2>
                        
                        <div class="notes-grid">
                            <div class="note-card">
                                <h5>Moving Averages (MA)</h5>
                                <p>Smooth out price data to identify trend direction.</p>
                                <span class="note-tag">Trend</span>
                                <div class="example-box">
                                    <p>50-day MA, 200-day MA - Golden Cross/Death Cross</p>
                                </div>
                            </div>
                            <div class="note-card">
                                <h5>RSI (Relative Strength Index)</h5>
                                <p>Measures momentum on a scale of 0-100. Overbought >70, Oversold <30.</p>
                                <span class="note-tag">Momentum</span>
                            </div>
                            <div class="note-card">
                                <h5>MACD</h5>
                                <p>Shows relationship between two moving averages.</p>
                                <span class="note-tag">Trend & Momentum</span>
                            </div>
                            <div class="note-card">
                                <h5>Bollinger Bands</h5>
                                <p>Measures volatility with upper and lower bands.</p>
                                <span class="note-tag">Volatility</span>
                            </div>
                        </div>
                    </div>

                    <!-- DRAWDOWN SECTION -->
                    <div id="drawdown-explained" class="edu-section">
                        <h2><span>Drawdown</span> Explained</h2>
                        <p>Drawdown is one of the most critical concepts in trading risk management. It measures the decline from a peak to a trough in your trading account balance before a new peak is reached.</p>
                        
                        <div class="drawdown-notes">
                            <h5 style="color: #0C3A30; margin-bottom: 1.5rem;">📝 Quick Notes on Drawdown</h5>
                            
                            <div class="notes-grid">
                                <div class="note-card">
                                    <div class="note-icon">
                                        <i class="ri-arrow-down-circle-fill"></i>
                                    </div>
                                    <h5>What is Drawdown?</h5>
                                    <p>The percentage decline from your account's highest point to its lowest point before recovery.</p>
                                    <span class="note-tag">Definition</span>
                                    <div class="example-box">
                                        <small>📊 EXAMPLE:</small>
                                        <p>If your account grows from $10,000 to $12,000 (peak), then drops to $9,000 (trough), your drawdown is 25%.</p>
                                    </div>
                                </div>
                                <div class="note-card">
                                    <div class="note-icon">
                                        <i class="ri-calculator-fill"></i>
                                    </div>
                                    <h5>How to Calculate</h5>
                                    <p>Drawdown = (Peak Value - Trough Value) ÷ Peak Value × 100</p>
                                    <span class="note-tag">Formula</span>
                                    <div class="example-box">
                                        <small>🧮 CALCULATION:</small>
                                        <p>($12,000 - $9,000) ÷ $12,000 × 100 = 25% drawdown</p>
                                    </div>
                                </div>
                                <div class="note-card">
                                    <div class="note-icon">
                                        <i class="ri-alert-fill"></i>
                                    </div>
                                    <h5>Maximum Drawdown (Max DD)</h5>
                                    <p>The largest peak-to-trough decline ever recorded in your trading history.</p>
                                    <span class="note-tag">Risk Metric</span>
                                    <div class="example-box">
                                        <small>⚠️ IMPORTANT:</small>
                                        <p>Professional traders aim to keep max drawdown under 20%</p>
                                    </div>
                                </div>
                                <div class="note-card">
                                    <div class="note-icon">
                                        <i class="ri-timer-fill"></i>
                                    </div>
                                    <h5>Drawdown Duration</h5>
                                    <p>The time it takes to recover from a drawdown and reach a new account peak.</p>
                                    <span class="note-tag">Recovery</span>
                                    <div class="example-box">
                                        <small>⏱️ RECOVERY TIME:</small>
                                        <p>A 20% drawdown requires a 25% gain just to break even</p>
                                    </div>
                                </div>
                                <div class="note-card">
                                    <div class="note-icon">
                                        <i class="ri-shield-fill"></i>
                                    </div>
                                    <h5>Types of Drawdown</h5>
                                    <p><strong>Absolute:</strong> Peak to trough in absolute terms<br>
                                    <strong>Relative:</strong> Percentage decline from peak</p>
                                    <span class="note-tag">Categories</span>
                                </div>
                                <div class="note-card">
                                    <div class="note-icon">
                                        <i class="ri-heart-pulse-fill"></i>
                                    </div>
                                    <h5>Psychological Impact</h5>
                                    <p>Large drawdowns trigger fear, overtrading, and revenge trading.</p>
                                    <span class="note-tag">Emotions</span>
                                    <div class="example-box">
                                        <small>🧠 MINDSET:</small>
                                        <p>Accept drawdowns as normal and stick to your trading plan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Position Sizing -->
                    <div id="position-sizing" class="edu-section">
                        <h2><span>Position</span> Sizing</h2>
                        <p>Position sizing determines how much capital to risk on each trade based on your account size and stop-loss distance.</p>
                        
                        <div class="highlight-box mt-3">
                            <div class="key-point">
                                <i class="ri-calculator-fill"></i>
                                <div>
                                    <strong>Formula:</strong>
                                    <p>Position Size = (Account Balance × Risk %) ÷ Stop Loss Distance</p>
                                </div>
                            </div>
                            <div class="example-box mt-3">
                                <small>📊 EXAMPLE:</small>
                                <p>$10,000 account, 2% risk ($200), 50-pip stop loss = 4 mini lots position size</p>
                            </div>
                        </div>
                    </div>

                    <!-- Stop-Loss Strategies -->
                    <div id="stop-loss-strategies" class="edu-section">
                        <h2><span>Stop-Loss</span> Strategies</h2>
                        
                        <div class="notes-grid">
                            <div class="note-card">
                                <h5>Fixed Percentage</h5>
                                <p>Set stop at fixed percentage (1-2% of account)</p>
                            </div>
                            <div class="note-card">
                                <h5>Technical Stop</h5>
                                <p>Place stop below support or above resistance</p>
                            </div>
                            <div class="note-card">
                                <h5>Volatility Stop</h5>
                                <p>Use ATR to set stop based on market volatility</p>
                            </div>
                            <div class="note-card">
                                <h5>Trailing Stop</h5>
                                <p>Stop moves with price to lock in profits</p>
                            </div>
                        </div>
                    </div>

                    <!-- Risk-Reward Ratios -->
                    <div id="risk-reward-ratios" class="edu-section">
                        <h2><span>Risk-Reward</span> Ratios</h2>
                        <p>The ratio of potential profit to potential loss on a trade. A 1:2 ratio means risking $1 to make $2.</p>
                        
                        <div class="notes-grid mt-3">
                            <div class="note-card">
                                <h5>Minimum 1:2</h5>
                                <p>Only take trades where potential profit is at least twice the risk</p>
                            </div>
                            <div class="note-card">
                                <h5>Win Rate Impact</h5>
                                <p>With 1:2 ratio, you only need 34% win rate to be profitable</p>
                                <div class="example-box">
                                    <small>📊 MATH:</small>
                                    <p>10 trades: 4 wins (+8R), 6 losses (-6R) = +2R profit</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Portfolio Protection -->
                    <div id="portfolio-protection" class="edu-section">
                        <h2><span>Portfolio</span> Protection</h2>
                        <p>Strategies to protect your overall trading capital from catastrophic losses.</p>
                        
                        <ul style="color: #4A5C5A;">
                            <li class="mb-2">✓ Never risk more than 1-2% per trade</li>
                            <li class="mb-2">✓ Diversify across multiple instruments</li>
                            <li class="mb-2">✓ Use correlation analysis</li>
                            <li class="mb-2">✓ Have a maximum daily loss limit</li>
                        </ul>
                    </div>

                    <!-- Psychology & Risk Control -->
                    <div id="psychology-risk" class="edu-section">
                        <h2><span>Psychology &</span> Risk Control</h2>
                        <p>The mental aspects of sticking to your risk management rules even under pressure.</p>
                        
                        <div class="notes-grid">
                            <div class="note-card">
                                <h5>Fear of Missing Out (FOMO)</h5>
                                <p>Chasing trades after missing entry - leads to poor entries</p>
                            </div>
                            <div class="note-card">
                                <h5>Revenge Trading</h5>
                                <p>Trying to recover losses quickly - leads to overtrading</p>
                            </div>
                            <div class="note-card">
                                <h5>Loss Aversion</h5>
                                <p>Holding losers too long, cutting winners too early</p>
                            </div>
                        </div>
                    </div>

                    <!-- Why Traders Fail -->
                    <div id="why-traders-fail" class="edu-section">
                        <h2><span>Why Traders</span> Fail</h2>
                        
                        <div class="notes-grid">
                            <div class="note-card">
                                <h5>No Trading Plan</h5>
                                <p>Trading without clear rules and strategies</p>
                            </div>
                            <div class="note-card">
                                <h5>Poor Risk Management</h5>
                                <p>Risking too much on single trades</p>
                            </div>
                            <div class="note-card">
                                <h5>Lack of Discipline</h5>
                                <p>Not following the trading plan consistently</p>
                            </div>
                            <div class="note-card">
                                <h5>Unrealistic Expectations</h5>
                                <p>Expecting to get rich quickly</p>
                            </div>
                        </div>
                        
                        <a href="{{ route('education.psychology2') }}" class="trading-link mt-3" style="display: inline-block;">Read detailed article →</a>
                    </div>

                    <!-- Making a Living Trading -->
                    <div id="making-living-trading" class="edu-section">
                        <h2><span>Making a Living</span> Trading</h2>
                        <p>Can trading replace your 9-5 income? Yes, but it requires:</p>
                        
                        <ul style="color: #4A5C5A;">
                            <li class="mb-2">✓ Minimum 2-3 years of consistent profitability</li>
                            <li class="mb-2">✓ Sufficient capital to generate meaningful income</li>
                            <li class="mb-2">✓ Proven strategy with positive expectancy</li>
                            <li class="mb-2">✓ Strong psychological discipline</li>
                        </ul>
                        
                        <a href="{{ route('education.make-living-trading') }}" class="trading-link">Read detailed article →</a>
                    </div>

                    <!-- Overcoming Fear & Greed -->
                    <div id="overcoming-fear-greed" class="edu-section">
                        <h2><span>Overcoming</span> Fear & Greed</h2>
                        
                        <div class="notes-grid">
                            <div class="note-card">
                                <h5>Fear</h5>
                                <p>Causes missed opportunities, early exits</p>
                                <div class="example-box">
                                    <p>Solution: Trust your analysis, use stop-losses</p>
                                </div>
                            </div>
                            <div class="note-card">
                                <h5>Greed</h5>
                                <p>Causes overtrading, holding too long</p>
                                <div class="example-box">
                                    <p>Solution: Take profits at targets, stick to plan</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Building Discipline -->
                    <div id="building-discipline" class="edu-section">
                        <h2><span>Building</span> Discipline</h2>
                        
                        <div class="key-point">
                            <i class="ri-medal-fill"></i>
                            <div>
                                <strong>Daily Habits:</strong>
                                <p>1. Create a trading plan<br>2. Journal every trade<br>3. Review performance weekly<br>4. Follow rules without exception</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Column -->
            <div class="col-lg-4">
                <div class="edu-sidebar" data-aos="fade-left" data-aos-duration="800">
                    
                    <!-- Trading Basics Section -->
                    <div class="sidebar-section">
                        <h4>Trading Basics</h4>
                        <ul>
                            <li><a href="#trading-fundamentals" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Trading Fundamentals</a></li>
                            <li><a href="#technical-analysis" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Technical Analysis</a></li>
                            <li><a href="#fundamental-analysis" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Fundamental Analysis</a></li>
                            <li><a href="#chart-patterns" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Chart Patterns</a></li>
                            <li><a href="#indicators-explained" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Indicators Explained</a></li>
                        </ul>
                    </div>

                    <!-- Risk Management Section -->
                    <div class="sidebar-section">
                        <h4>Risk Management</h4>
                        <ul>
                            <li><a href="#drawdown-explained" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Drawdown Explained</a></li>
                            <li><a href="#position-sizing" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Position Sizing</a></li>
                            <li><a href="#stop-loss-strategies" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Stop-Loss Strategies</a></li>
                            <li><a href="#risk-reward-ratios" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Risk-Reward Ratios</a></li>
                            <li><a href="#portfolio-protection" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Portfolio Protection</a></li>
                        </ul>
                    </div>

                    <!-- Psychology Section -->
                    <div class="sidebar-section">
                        <h4>Trader Psychology</h4>
                        <ul>
                            <li><a href="#psychology-risk" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Psychology & Risk Control</a></li>
                            <li><a href="#why-traders-fail" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Why Traders Fail</a></li>
                            <li><a href="#making-living-trading" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Making a Living Trading</a></li>
                            <li><a href="#overcoming-fear-greed" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Overcoming Fear & Greed</a></li>
                            <li><a href="#building-discipline" class="sidebar-link"><i class="ri-arrow-right-s-line"></i>Building Discipline</a></li>
                        </ul>
                    </div>

                    <!-- Quick Tip Box -->
                    <div class="tip-box">
                        <h6><i class="ri-lightbulb-flash-fill" style="color: #8BC905;"></i> Quick Tip</h6>
                        <p>The best traders don't try to win on every trade. They focus on managing losses and letting winners run. Accept that drawdowns are part of the process.</p>
                        <a href="#position-sizing" style="color: #8BC905; font-weight: 600; font-size: 0.9rem;">Learn Position Sizing →</a>
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