@extends('layout.app')
@section('content')


<style>
    /* CSS to reduce header gap */
    .main-banner-area {
        margin-top: -1rem;
        padding-top: 4rem !important;
    }

    @media (max-width: 768px) {
        .main-banner-area {
            margin-top: -1.5rem;
        }
    }
</style>

<!-- Start Main Banner Area -->
<!-- <div class="main-banner-area overflow-hidden position-relative " style="background-image: url(assets/images/hero/hero-image-1.svg);; "> -->
<div class="main-banner-area overflow-hidden position-relative "
    style="background-image: url(assets/images/hero/hero-image-1.svg); ">



    <!-- Background wrapper -->

    <!-- <div class="hero-section position-relative overflow-hidden" style="height: 480px; width:auto; justify-content:center; align-items:center;"> -->




    <!-- Content on top -->
    <!-- Hero Section with Video Background -->
    <div class="hero-section position-relative overflow-hidden d-flex justify-content-center align-items-center" style="height: 480px; margin-top: -45px;">

        <!-- Background Video -->
        <video autoplay muted loop playsinline class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" style="z-index: 0;">
            <source src="{{ asset('assets/images/Hero-Video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- Overlay -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.5); z-index: 1;"></div>

        <!-- Centered Content -->
        <div class="container position-relative text-white" style="z-index: 2;">
            <div class="row align-items-center" style="margin-top: 4rem;">
                <div class="col-xl-5 col-lg-12 mb-4" data-cues="slideInRight" data-duration="800">
                    <div class="main-banner-content text-white">
                        <span class="sub-t text-white">WELCOME TO MARKETMIND</span>
                        <h1 class="mt-2" style="color:white;">
                            Transform
                            <span style="color: #8BC905; font-size:2rem;">
                                <img style="width: 100px; height:auto;" src="{{ asset('assets/images/svg/your.svg') }} " alt="icon"> Your
                            </span>
                            Trading with Intelligent Strategies
                        </h1>
                        <a href="{{ route('signup') }}" class="btn btn-primary btn-lg px-3 py-2 rounded-pill shadow-lg glow-effect mt-3">
                            <i class="fas fa-rocket me-2"></i> Start Trading
                        </a>
                    </div>
                </div>

                <div class="col-xl-7 col-lg-12" data-cues="slideInLeft" data-duration="800">
                    <div class="info text-white">
                        <p class="mb-3">
                            Successful trading takes time, strategy, and discipline. MarketMind helps you trade smarter, faster, and with confidence.
                        </p>

                        <div class="row align-items-center g-3 g-md-3">
                            <div class="col-lg-5 col-md-5">

                                <ul class="user bg-color-ffffff radius" style="padding: 6px 10px; font-size: 0.85rem; transform: scale(0.85); display: inline-flex;">

                                    <li><img class="rounded-circle" src="{{ asset('assets/images/user/user-image-2.jpg') }}" alt="user"></li>
                                    <li><img class="rounded-circle" src="{{ asset('assets/images/user/user-image-3.jpg') }}" alt="user"></li>
                                    <li><img class="rounded-circle" src="{{ asset('assets/images/user/user-image-1.jpg') }}" alt="user"></li>
                                    <li>87k+</li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="star-review">
                                    <ul>
                                        <li>
                                            <i class="flaticon-star-2"></i>
                                            <i class="flaticon-star-2"></i>
                                            <i class="flaticon-star-2"></i>
                                            <i class="flaticon-star-2"></i>
                                            <i class="flaticon-star-2"></i>
                                        </li>
                                        <li><strong>4.9/5</strong> <span style="color:white;">Rating</span></li>
                                        <li>From over 1000+ reviews</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.info -->
                </div>
            </div>
        </div>
    </div>



    <script src="https://s3.tradingview.com/tv.js"></script>
    <style>
        :root {
            --primary-dark: #0C3A30;
            --primary-accent: #8BC905;
            --secondary-accent: #9EDD05;
            --crypto-blue: #2775CA;
            --forest-green: #2E8B57;
            --realestate-gold: #D4AF37;
            --dark-bg: #0A1929;
            --darker-bg: #071521;
            --card-bg: #122738;
        }

        body {
            font-family: 'Space Grotesk', sans-serif;
            background-color: var(--dark-bg);

            overflow-x: hidden;
        }

        .cyber-border {
            position: relative;
            border: 1px solid rgba(139, 201, 5, 0.3);
            border-radius: 12px;
            overflow: hidden;
        }

        .cyber-border::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--primary-accent), transparent);
            animation: borderPulse 3s infinite;
        }

        @keyframes borderPulse {
            0% {
                opacity: 0.3;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0.3;
            }
        }

        .asset-tab {
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }

        .asset-tab.active {
            border-bottom: 3px solid var(--primary-accent);
            color: white !important;
        }

        .glow-effect {
            box-shadow: 0 0 15px rgba(139, 201, 5, 0.2);
        }

        .market-indicator {
            position: relative;
            padding-left: 15px;
        }

        .market-indicator::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: var(--primary-accent);
        }

        .market-indicator.negative::before {
            background-color: #FF4D4D;
        }

        .data-stream {
            position: relative;
            overflow: hidden;
        }

        .data-stream::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 60px;
            background: linear-gradient(90deg, transparent, var(--dark-bg));
        }

        .forest-metric {
            background: linear-gradient(135deg, rgba(46, 139, 87, 0.15), rgba(46, 139, 87, 0.05));
            border-left: 3px solid var(--forest-green);
        }

        .realestate-metric {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.15), rgba(212, 175, 55, 0.05));
            border-left: 3px solid var(--realestate-gold);
        }

        .crypto-metric {
            background: linear-gradient(135deg, rgba(39, 117, 202, 0.15), rgba(39, 117, 202, 0.05));
            border-left: 3px solid var(--crypto-blue);
        }


        .tech-pattern {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image:
                linear-gradient(rgba(139, 201, 5, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(139, 201, 5, 0.05) 1px, transparent 1px);
            background-size: 20px 20px;
            pointer-events: none;
        }


        .pulse-dot {
            width: 10px;
            height: 10px;
            background-color: var(--primary-accent);
            border-radius: 50%;
            display: inline-block;
            animation: pulseAnim 1.5s infinite;
            box-shadow: 0 0 0 rgba(139, 201, 5, 0.4);
        }

        @keyframes pulseAnim {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(139, 201, 5, 0.7);
            }

            70% {
                transform: scale(1.5);
                box-shadow: 0 0 0 10px rgba(139, 201, 5, 0);
            }

            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(139, 201, 5, 0);
            }
        }
    </style>



    <div class="container-fluid px-0">
        <!-- Cyberpunk Inspired Header -->
        <div class="position-relative overflow-hidden" style="background: linear-gradient(135deg, var(--darker-bg) 0%, var(--dark-bg) 100%);">
            <div class="tech-pattern"></div>
            <div class="container py-5">
                <div class="row align-items-center">
                    <!-- Left Column - Main Content -->
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="pe-lg-5">
                            <span class="badge bg-primary-soft text-primary mb-3 d-inline-flex align-items-center">
                                <span class="pulse-dot me-2"></span>
                                LIVE MARKET DATA STREAMING
                            </span>
                            <h1 class="display-4 fw-bold text-white mb-4">
                                <span class="text-primary">MarketMind</span> Next-Gen <span class="text-highlight">Trading Support</span> Platform
                            </h1>
                            <p class="lead text-white-80 mb-4" style="color: white !important;">
                                Next-gen algorithmic trading across crypto, forex assets, and real estate markets with deep learning execution.
                            </p>

                            <div class="d-flex flex-wrap gap-3 mb-5">

                                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill">
                                    <i class="fas fa-play-circle me-2"></i>Start Trading
                                </a>
                            </div>

                            <div class="d-flex flex-wrap gap-4" style="color: white !important;">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <div class="fs-1 fw-bold text-primary">24/7</div>
                                        <div class="text-white-80 small" style="color: white !important;">Market Monitoring</div>
                                    </div>
                                    <div class="vr"></div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <div class="fs-1 fw-bold text-primary">0.02s</div>
                                        <div class="text-white-80 small" style="color: white !important;">Execution Speed</div>
                                    </div>
                                    <div class="vr"></div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <div class="fs-1 fw-bold text-primary">17</div>
                                        <div class="text-white-80 small" style="color: white !important;">Asset Classes</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Image -->
                    <div class="col-lg-6 d-flex justify-content-center">
                        <img src="assets/images/exclusive-funded-optimized-banner2024﹖v=1.svg" alt="Trading Bot" class="img-fluid" style="max-width: 90%; height: auto;">

                    </div>
                </div>
            </div>
        </div>

        <style>
            :root {
                --primary-dark: #0C3A30;
                --primary-accent: #c2ff3eff;
                --secondary-accent: #9EDD05;
                --crypto-blue: #2775CA;
                --forex-green: #2E8B57;
                --indices-purple: #6F42C1;
                --commodities-orange: #FD7E14;
                --metals-gold: #FFD700;
                --etfs-teal: #20C997;
                --equities-navy: #1A237E;
                --cfd-red: #DC3545;
                --dark-bg: #0A1929;
                --darker-bg: #071521;
                --card-bg: #122738;
            }

            /* Enhanced Asset-specific backgrounds with more visibility */
            .crypto-metric {
                background: linear-gradient(135deg, rgba(39, 117, 202, 0.25), rgba(39, 117, 202, 0.15));
                border-left: 4px solid var(--crypto-blue);
                color: black !important;
            }

            .forex-metric {
                background: linear-gradient(135deg, rgba(46, 139, 87, 0.25), rgba(46, 139, 87, 0.15));
                border-left: 4px solid var(--forex-green);
                color: black !important;
            }

            .indices-metric {
                background: linear-gradient(135deg, rgba(111, 66, 193, 0.25), rgba(111, 66, 193, 0.15));
                border-left: 4px solid var(--indices-purple);
                color: black !important;
            }

            .commodities-metric {
                background: linear-gradient(135deg, rgba(253, 126, 20, 0.25), rgba(253, 126, 20, 0.15));
                border-left: 4px solid var(--commodities-orange);
                color: black !important;
            }

            .metals-metric {
                background: linear-gradient(135deg, rgba(255, 215, 0, 0.25), rgba(255, 215, 0, 0.15));
                border-left: 4px solid var(--metals-gold);
                color: black !important;
            }

            .etfs-metric {
                background: linear-gradient(135deg, rgba(32, 201, 151, 0.25), rgba(32, 201, 151, 0.15));
                border-left: 4px solid var(--etfs-teal);
                color: black !important;
            }

            .equities-metric {
                background: linear-gradient(135deg, rgba(26, 35, 126, 0.25), rgba(26, 35, 126, 0.15));
                border-left: 4px solid var(--equities-navy);
                color: black !important;
            }

            .cfd-metric {
                background: linear-gradient(135deg, rgba(220, 53, 69, 0.25), rgba(220, 53, 69, 0.15));
                border-left: 4px solid var(--cfd-red);
                color: black !important;
            }

            /* Enhanced text styling for better visibility */
            .metric-value {
                font-size: 1.5rem !important;
                font-weight: 800 !important;
                color: #000000 !important;
                text-shadow: 0 1px 2px rgba(255, 255, 255, 0.3);
                transition: all 0.3s ease;
            }

            .metric-change {
                font-size: 1rem !important;
                font-weight: 700 !important;
                transition: all 0.3s ease;
            }

            .metric-change.positive {
                color: #00aa55 !important;
                text-shadow: 0 1px 2px rgba(0, 255, 136, 0.3);
            }

            .metric-change.negative {
                color: #ff3333 !important;
                text-shadow: 0 1px 2px rgba(255, 68, 68, 0.3);
            }

            /* Asset-specific text colors */
            .crypto-metric .text-blue {
                color: var(--crypto-blue) !important;
                font-weight: 700;
            }

            .forex-metric .text-green {
                color: var(--forex-green) !important;
                font-weight: 700;
            }

            .indices-metric .text-purple {
                color: var(--indices-purple) !important;
                font-weight: 700;
            }

            .commodities-metric .text-orange {
                color: var(--commodities-orange) !important;
                font-weight: 700;
            }

            .metals-metric .text-gold {
                color: var(--metals-gold) !important;
                font-weight: 700;
            }

            .etfs-metric .text-teal {
                color: var(--etfs-teal) !important;
                font-weight: 700;
            }

            .equities-metric .text-navy {
                color: var(--equities-navy) !important;
                font-weight: 700;
            }

            .cfd-metric .text-red {
                color: var(--cfd-red) !important;
                font-weight: 700;
            }

            /* Market card colors matching asset classes */
            .market-card.crypto {
                border-left: 4px solid var(--crypto-blue);
                background: rgba(39, 117, 202, 0.1);
            }

            .market-card.forex {
                border-left: 4px solid var(--forex-green);
                background: rgba(46, 139, 87, 0.1);
            }

            .market-card.indices {
                border-left: 4px solid var(--indices-purple);
                background: rgba(111, 66, 193, 0.1);
            }

            .market-card.commodities {
                border-left: 4px solid var(--commodities-orange);
                background: rgba(253, 126, 20, 0.1);
            }

            .market-card.metals {
                border-left: 4px solid var(--metals-gold);
                background: rgba(255, 215, 0, 0.1);
            }

            .market-card.etfs {
                border-left: 4px solid var(--etfs-teal);
                background: rgba(32, 201, 151, 0.1);
            }

            .market-card.equities {
                border-left: 4px solid var(--equities-navy);
                background: rgba(26, 35, 126, 0.1);
            }

            .market-card.cfd {
                border-left: 4px solid var(--cfd-red);
                background: rgba(220, 53, 69, 0.1);
            }

            /* Tab colors matching asset classes */
            .asset-tab[href="#crypto-tab"]:hover {
                background-color: rgba(39, 117, 202, 0.2) !important;
            }

            .asset-tab[href="#forex-tab"]:hover {
                background-color: rgba(46, 139, 87, 0.2) !important;
            }

            .asset-tab[href="#indices-tab"]:hover {
                background-color: rgba(111, 66, 193, 0.2) !important;
            }

            .asset-tab[href="#commodities-tab"]:hover {
                background-color: rgba(253, 126, 20, 0.2) !important;
            }

            .asset-tab[href="#metals-tab"]:hover {
                background-color: rgba(255, 215, 0, 0.2) !important;
            }

            .asset-tab[href="#etfs-tab"]:hover {
                background-color: rgba(32, 201, 151, 0.2) !important;
            }

            .asset-tab[href="#equities-tab"]:hover {
                background-color: rgba(26, 35, 126, 0.2) !important;
            }

            .asset-tab[href="#cfd-tab"]:hover {
                background-color: rgba(220, 53, 69, 0.2) !important;
            }

            /* Active tab colors */
            .asset-tab.active[href="#crypto-tab"] {
                background-color: rgba(39, 117, 202, 0.3) !important;
                border-bottom-color: var(--crypto-blue) !important;
                color: #000 !important;
                font-weight: 700;
            }

            .asset-tab.active[href="#forex-tab"] {
                background-color: rgba(46, 139, 87, 0.3) !important;
                border-bottom-color: var(--forex-green) !important;
                color: #000 !important;
                font-weight: 700;
            }

            .asset-tab.active[href="#indices-tab"] {
                background-color: rgba(111, 66, 193, 0.3) !important;
                border-bottom-color: var(--indices-purple) !important;
                color: #000 !important;
                font-weight: 700;
            }

            .asset-tab.active[href="#commodities-tab"] {
                background-color: rgba(253, 126, 20, 0.3) !important;
                border-bottom-color: var(--commodities-orange) !important;
                color: #000 !important;
                font-weight: 700;
            }

            .asset-tab.active[href="#metals-tab"] {
                background-color: rgba(255, 215, 0, 0.3) !important;
                border-bottom-color: var(--metals-gold) !important;
                color: #000 !important;
                font-weight: 700;
            }

            .asset-tab.active[href="#etfs-tab"] {
                background-color: rgba(32, 201, 151, 0.3) !important;
                border-bottom-color: var(--etfs-teal) !important;
                color: #000 !important;
                font-weight: 700;
            }

            .asset-tab.active[href="#equities-tab"] {
                background-color: rgba(26, 35, 126, 0.3) !important;
                border-bottom-color: var(--equities-navy) !important;
                color: #000 !important;
                font-weight: 700;
            }

            .asset-tab.active[href="#cfd-tab"] {
                background-color: rgba(220, 53, 69, 0.3) !important;
                border-bottom-color: var(--cfd-red) !important;
                color: #000 !important;
                font-weight: 700;
            }

            @keyframes blink {
                0% {
                    opacity: 1;
                }

                50% {
                    opacity: 0.3;
                }

                100% {
                    opacity: 1;
                }
            }

            @keyframes numberPulse {
                0% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.05);
                }

                100% {
                    transform: scale(1);
                }
            }

            .number-changing {
                animation: numberPulse 0.5s ease;
            }

            .asset-tab.active {
                border-bottom: 4px solid var(--primary-accent);
            }

            .market-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 10px;
                padding: 10px;
            }

            .market-card {
                border-radius: 8px;
                padding: 12px;
                transition: all 0.3s ease;
                color: #000 !important;
            }

            .market-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            }

            .market-card .symbol {
                font-size: 0.85rem;
                color: #000;
                font-weight: 700;
            }

            .market-card .price {
                font-size: 1.1rem;
                font-weight: 800;
                color: #000;
            }

            .market-card .change {
                font-size: 0.9rem;
                font-weight: 700;
            }

            .market-card .change.positive {
                color: #00aa55 !important;
            }

            .market-card .change.negative {
                color: #ff3333 !important;
            }

            /* Chart container styling */
            .tradingview-widget-container {
                border-radius: 8px;
                overflow: hidden;
                margin-bottom: 15px;
            }

            /* Text colors for better readability */
            .text-white-80 {
                color: rgba(0, 0, 0, 0.8) !important;
                font-weight: 600;
            }

            .bg-gold-soft {
                background-color: rgba(139, 201, 5, 0.2) !important;
            }

            /* Enhanced badge styling */
            .badge.bg-gold-soft {
                color: #000 !important;
                font-weight: 700;
                font-size: 0.7rem;
                padding: 4px 8px;
            }

            /* Metric headers */
            .metric-header {
                color: #000 !important;
                font-weight: 700;
                font-size: 0.9rem;
            }
        </style>

        <div class="container py-5">
            <div class="row g-4">
                <!-- Crypto Metrics -->
                <div class="col-md-3 col-sm-6">
                    <div class="crypto-metric h-100 p-3 rounded">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0 metric-header">
                                <i class="fab fa-bitcoin text-blue me-2"></i>
                                Crypto
                            </h6>
                            <span class="badge bg-gold-soft" style="animation: blink 1.5s infinite;">LIVE</span>
                        </div>
                        <div class="mb-2">
                            <div class="metric-value">$<span id="crypto-tvl">156,423,789</span></div>
                            <div class="text-white-80 small">Assets Under Management</div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="metric-change positive" id="crypto-24h-change">+4.2%</div>
                                <div class="text-white-80 small">24h Change</div>
                            </div>
                            <div>
                                <div class="metric-change positive" id="crypto-pairs">850+</div>
                                <div class="text-white-80 small">Pairs</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Forex Metrics -->
                <div class="col-md-3 col-sm-6">
                    <div class="forex-metric h-100 p-3 rounded">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0 metric-header">
                                <i class="fas fa-exchange-alt text-green me-2"></i>
                                Forex
                            </h6>
                            <span class="badge bg-gold-soft" style="animation: blink 1.5s infinite;">LIVE</span>
                        </div>
                        <div class="mb-2">
                            <div class="metric-value">$<span id="forex-tvl">124,856,421</span></div>
                            <div class="text-white-80 small">Daily Volume</div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="metric-change positive" id="forex-profit">+2.8%</div>
                                <div class="text-white-80 small">Avg. Return</div>
                            </div>
                            <div>
                                <div class="metric-change positive" id="forex-pairs">65+</div>
                                <div class="text-white-80 small">Pairs</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Indices Metrics -->
                <div class="col-md-3 col-sm-6">
                    <div class="indices-metric h-100 p-3 rounded">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0 metric-header">
                                <i class="fas fa-chart-bar text-purple me-2"></i>
                                Indices
                            </h6>
                            <span class="badge bg-gold-soft" style="animation: blink 1.5s infinite;">LIVE</span>
                        </div>
                        <div class="mb-2">
                            <div class="metric-value">$<span id="indices-tvl">89,745,236</span></div>
                            <div class="text-white-80 small">Market Exposure</div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="metric-change positive" id="indices-change">+1.5%</div>
                                <div class="text-white-80 small">Today</div>
                            </div>
                            <div>
                                <div class="metric-change positive" id="indices-count">25+</div>
                                <div class="text-white-80 small">Indices</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Commodities Metrics -->
                <div class="col-md-3 col-sm-6">
                    <div class="commodities-metric h-100 p-3 rounded">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0 metric-header">
                                <i class="fas fa-gas-pump text-orange me-2"></i>
                                Commodities
                            </h6>
                            <span class="badge bg-gold-soft" style="animation: blink 1.5s infinite;">LIVE</span>
                        </div>
                        <div class="mb-2">
                            <div class="metric-value">$<span id="commodities-tvl">67,892,154</span></div>
                            <div class="text-white-80 small">Portfolio Value</div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="metric-change negative" id="commodities-change">-0.8%</div>
                                <div class="text-white-80 small">24h Change</div>
                            </div>
                            <div>
                                <div class="metric-change positive" id="commodities-count">15+</div>
                                <div class="text-white-80 small">Products</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Asset Classes Row -->
                <div class="col-md-3 col-sm-6">
                    <div class="metals-metric h-100 p-3 rounded">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0 metric-header">
                                <i class="fas fa-gem text-gold me-2"></i>
                                Metals
                            </h6>
                            <span class="badge bg-gold-soft" style="animation: blink 1.5s infinite;">LIVE</span>
                        </div>
                        <div class="mb-2">
                            <div class="metric-value">$<span id="metals-tvl">45,678,321</span></div>
                            <div class="text-white-80 small">Precious Metals</div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="metric-change positive" id="metals-change">+3.2%</div>
                                <div class="text-white-80 small">Gold Spot</div>
                            </div>
                            <div>
                                <div class="metric-change positive" id="metals-count">8+</div>
                                <div class="text-white-80 small">Metals</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="etfs-metric h-100 p-3 rounded">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0 metric-header">
                                <i class="fas fa-chart-pie text-teal me-2"></i>
                                ETFs
                            </h6>
                            <span class="badge bg-gold-soft" style="animation: blink 1.5s infinite;">LIVE</span>
                        </div>
                        <div class="mb-2">
                            <div class="metric-value">$<span id="etfs-tvl">78,945,632</span></div>
                            <div class="text-white-80 small">ETF Holdings</div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="metric-change positive" id="etfs-change">+2.1%</div>
                                <div class="text-white-80 small">Performance</div>
                            </div>
                            <div>
                                <div class="metric-change positive" id="etfs-count">120+</div>
                                <div class="text-white-80 small">ETFs</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="equities-metric h-100 p-3 rounded">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0 metric-header">
                                <i class="fas fa-industry text-navy me-2"></i>
                                Equities
                            </h6>
                            <span class="badge bg-gold-soft" style="animation: blink 1.5s infinite;">LIVE</span>
                        </div>
                        <div class="mb-2">
                            <div class="metric-value">$<span id="equities-tvl">234,567,890</span></div>
                            <div class="text-white-80 small">Stock Portfolio</div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="metric-change positive" id="equities-change">+1.8%</div>
                                <div class="text-white-80 small">Today</div>
                            </div>
                            <div>
                                <div class="metric-change positive" id="equities-count">500+</div>
                                <div class="text-white-80 small">Stocks</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="cfd-metric h-100 p-3 rounded">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0 metric-header">
                                <i class="fas fa-project-diagram text-red me-2"></i>
                                CFDs
                            </h6>
                            <span class="badge bg-gold-soft" style="animation: blink 1.5s infinite;">LIVE</span>
                        </div>
                        <div class="mb-2">
                            <div class="metric-value">$<span id="cfd-tvl">56,789,123</span></div>
                            <div class="text-white-80 small">CFD Exposure</div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="metric-change positive" id="cfd-change">+4.5%</div>
                                <div class="text-white-80 small">Leveraged</div>
                            </div>
                            <div>
                                <div class="metric-change positive" id="cfd-count">300+</div>
                                <div class="text-white-80 small">CFDs</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Enhanced growth simulation for all asset classes with faster updates
            document.addEventListener('DOMContentLoaded', function() {
                // Initial values for all asset classes
                const initialValues = {
                    crypto: 156423789,
                    forex: 124856421,
                    indices: 89745236,
                    commodities: 67892154,
                    metals: 45678321,
                    etfs: 78945632,
                    equities: 234567890,
                    cfd: 56789123
                };

                let balances = {
                    ...initialValues
                };
                let lastUpdateDate = new Date().toDateString();

                function formatNumber(num) {
                    if (num >= 1000000) {
                        return (num / 1000000).toFixed(1) + 'M';
                    }
                    if (num >= 1000) {
                        return (num / 1000).toFixed(1) + 'K';
                    }
                    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }

                function updateNumberWithAnimation(elementId, newValue) {
                    const element = document.getElementById(elementId);
                    element.classList.add('number-changing');
                    element.textContent = newValue;
                    setTimeout(() => {
                        element.classList.remove('number-changing');
                    }, 500);
                }

                function updateMetrics() {
                    const today = new Date().toDateString();

                    // Update balances more frequently for visible changes
                    Object.keys(balances).forEach(asset => {
                        const randomChange = 1 + ((Math.random() - 0.5) * 0.02); // -1% to +1% change
                        balances[asset] = Math.floor(balances[asset] * randomChange);

                        // Update displayed values with animation
                        updateNumberWithAnimation(`${asset}-tvl`, formatNumber(balances[asset]));
                    });

                    // Update dynamic metrics more frequently and with larger ranges
                    updateNumberWithAnimation('crypto-24h-change', (Math.random() > 0.3 ? '+' : '') + (1 + Math.random() * 8).toFixed(1) + '%');
                    updateNumberWithAnimation('forex-profit', (Math.random() > 0.4 ? '+' : '') + (0.5 + Math.random() * 4).toFixed(1) + '%');
                    updateNumberWithAnimation('indices-change', (Math.random() > 0.3 ? '+' : '') + (0.2 + Math.random() * 3).toFixed(1) + '%');
                    updateNumberWithAnimation('commodities-change', (Math.random() > 0.4 ? '+' : '') + (0.3 + Math.random() * 5).toFixed(1) + '%');
                    updateNumberWithAnimation('metals-change', (Math.random() > 0.2 ? '+' : '') + (1 + Math.random() * 6).toFixed(1) + '%');
                    updateNumberWithAnimation('etfs-change', (Math.random() > 0.3 ? '+' : '') + (0.5 + Math.random() * 3).toFixed(1) + '%');
                    updateNumberWithAnimation('equities-change', (Math.random() > 0.4 ? '+' : '') + (0.3 + Math.random() * 4).toFixed(1) + '%');
                    updateNumberWithAnimation('cfd-change', (Math.random() > 0.2 ? '+' : '') + (2 + Math.random() * 8).toFixed(1) + '%');

                    // Update counts with some variation
                    updateNumberWithAnimation('crypto-pairs', Math.floor(840 + Math.random() * 30) + '+');
                    updateNumberWithAnimation('forex-pairs', Math.floor(60 + Math.random() * 15) + '+');
                    updateNumberWithAnimation('indices-count', Math.floor(20 + Math.random() * 12) + '+');
                    updateNumberWithAnimation('commodities-count', Math.floor(12 + Math.random() * 8) + '+');
                    updateNumberWithAnimation('metals-count', Math.floor(6 + Math.random() * 4) + '+');
                    updateNumberWithAnimation('etfs-count', Math.floor(110 + Math.random() * 25) + '+');
                    updateNumberWithAnimation('equities-count', Math.floor(480 + Math.random() * 50) + '+');
                    updateNumberWithAnimation('cfd-count', Math.floor(280 + Math.random() * 50) + '+');
                }

                updateMetrics();
                // Update every 1.5 seconds for very visible changes
                setInterval(updateMetrics, 1500);
            });
        </script>






        <!-- charts sections -->
        <div class="cyber-border p-0" style="margin-bottom: 2rem;">
            <!-- Asset Class Tabs -->
            <ul class="nav nav-tabs nav-justified border-0 bg-dark">
                <li class="nav-item">
                    <a class="nav-link asset-tab active text-white bg-black" data-bs-toggle="tab" href="#crypto-tab">
                        <i class="fab fa-bitcoin me-2"></i> Crypto (1000+ Pairs)
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link asset-tab text-white" data-bs-toggle="tab" href="#forex-tab">
                        <i class="fas fa-exchange-alt me-2"></i> Forex (50+ Pairs)
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link asset-tab text-white" data-bs-toggle="tab" href="#realestate-tab">
                        <i class="fas fa-building me-2"></i> Real Estate
                    </a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content bg-card-bg">
                <!-- Crypto Tab - Enhanced with 20+ cryptocurrencies -->
                <div class="tab-pane fade show active" id="crypto-tab">
                    <div class="p-3">
                        <div class="tradingview-widget-container">
                            <div id="crypto-chart" style="height: 300px;"></div>
                        </div>
                        <div class="data-stream p-3">
                            <div class="d-flex flex-wrap">
                                <!-- Row 1 -->
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-primary">BTC/USD</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2">$<span id="btc-price">64,823.25</span></div>
                                        <small class="text-success">+2.4%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-primary">ETH/USD</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2">$<span id="eth-price">3,248.11</span></div>
                                        <small class="text-success">+1.2%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-primary">BNB/USD</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2">$<span id="bnb-price">585.42</span></div>
                                        <small class="text-danger">-0.8%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-primary">SOL/USD</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2">$<span id="sol-price">142.76</span></div>
                                        <small class="text-success">+3.7%</small>
                                    </div>
                                </div>

                                <!-- Row 2 -->
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-primary">XRP/USD</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2">$<span id="xrp-price">0.52</span></div>
                                        <small class="text-success">+5.1%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-primary">ADA/USD</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2">$<span id="ada-price">0.46</span></div>
                                        <small class="text-danger">-1.2%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-primary">DOGE/USD</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2">$<span id="doge-price">0.12</span></div>
                                        <small class="text-success">+8.4%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-primary">DOT/USD</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2">$<span id="dot-price">6.82</span></div>
                                        <small class="text-danger">-0.5%</small>
                                    </div>
                                </div>

                                <!-- Row 3 -->
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-primary">SHIB/USD</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2">$<span id="shib-price">0.000023</span></div>
                                        <small class="text-success">+12.3%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-primary">AVAX/USD</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2">$<span id="avax-price">34.56</span></div>
                                        <small class="text-success">+2.1%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-primary">LINK/USD</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2">$<span id="link-price">18.32</span></div>
                                        <small class="text-danger">-0.9%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-primary">MATIC/USD</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2">$<span id="matic-price">0.72</span></div>
                                        <small class="text-success">+1.4%</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Forex Tab - Enhanced with 20+ pairs -->
                <div class="tab-pane fade" id="forex-tab">
                    <div class="p-3">
                        <div class="tradingview-widget-container">
                            <div id="forex-chart" style="height: 300px;"></div>
                        </div>
                        <div class="data-stream p-3">
                            <div class="d-flex flex-wrap">
                                <!-- Major Pairs -->
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-success">EUR/USD</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2"><span id="eur-price">1.0856</span></div>
                                        <small class="text-success">+0.45%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-success">GBP/USD</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2"><span id="gbp-price">1.2742</span></div>
                                        <small class="text-danger">-0.18%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-success">USD/JPY</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2"><span id="jpy-price">157.32</span></div>
                                        <small class="text-success">+0.32%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-success">AUD/USD</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2"><span id="aud-price">0.6654</span></div>
                                        <small class="text-success">+0.28%</small>
                                    </div>
                                </div>

                                <!-- Minor Pairs -->
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-success">USD/CAD</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2"><span id="cad-price">1.3628</span></div>
                                        <small class="text-danger">-0.15%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-success">EUR/GBP</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2"><span id="eurgbp-price">0.8512</span></div>
                                        <small class="text-success">+0.22%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-success">USD/CHF</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2"><span id="chf-price">0.9015</span></div>
                                        <small class="text-danger">-0.08%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-success">NZD/USD</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2"><span id="nzd-price">0.6123</span></div>
                                        <small class="text-success">+0.17%</small>
                                    </div>
                                </div>

                                <!-- Exotic Pairs -->
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-success">EUR/TRY</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2"><span id="try-price">34.8765</span></div>
                                        <small class="text-danger">-0.42%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-success">USD/MXN</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2"><span id="mxn-price">18.3421</span></div>
                                        <small class="text-success">+0.35%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-success">USD/ZAR</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2"><span id="zar-price">18.6543</span></div>
                                        <small class="text-danger">-0.27%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-success">USD/SGD</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2"><span id="sgd-price">1.3521</span></div>
                                        <small class="text-success">+0.12%</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Real Estate Tab - Enhanced -->
                <div class="tab-pane fade" id="realestate-tab">
                    <div class="p-3">
                        <div class="tradingview-widget-container">
                            <div id="realestate-chart" style="height: 300px;"></div>
                        </div>
                        <div class="data-stream p-3">
                            <div class="d-flex flex-wrap">
                                <!-- REITs -->
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-warning">REIT INDEX</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2">$<span id="reit-price">1,425.80</span></div>
                                        <small class="text-success">+1.2%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-warning">COMMERCIAL</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2">$<span id="commercial-price">245.31</span></div>
                                        <small class="text-success">+0.7%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-warning">RESIDENTIAL</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2">$<span id="residential-price">185.42</span></div>
                                        <small class="text-danger">-0.5%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-warning">INDUSTRIAL</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2">$<span id="industrial-price">320.15</span></div>
                                        <small class="text-success">+1.8%</small>
                                    </div>
                                </div>

                                <!-- Regional Markets -->
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-warning">US HOUSING</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2">$<span id="us-housing-price">356.78</span></div>
                                        <small class="text-success">+2.1%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-warning">EU PROPERTY</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2">$<span id="eu-property-price">278.43</span></div>
                                        <small class="text-danger">-0.3%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-warning">ASIA REIT</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2">$<span id="asia-reit-price">198.76</span></div>
                                        <small class="text-success">+1.5%</small>
                                    </div>
                                </div>
                                <div class="market-indicator me-4 mb-3">
                                    <div class="text-warning">LUXURY</div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bold me-2">$<span id="luxury-price">542.31</span></div>
                                        <small class="text-success">+3.2%</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Bar -->
            <div class="d-flex justify-content-between align-items-center bg-dark p-3 border-top border-dark">
                <div class="d-flex align-items-center">
                    <span class="badge bg-primary me-2">
                        <i class="fas fa-robot"></i>
                    </span>
                    <div>
                        <div class="text-white small">AI TRADING BOT</div>
                        <div class="text-primary fw-bold" id="bot-status">ACTIVE <span class="badge bg-success ms-2" style="animation: blink 1.5s infinite;">LIVE</span></div>
                    </div>
                </div>
                <div class="text-end">
                    <div class="text-white-80 small" style="color: white !important ;">Last Execution</div>
                    <div class="text-white" id="last-trade">2 seconds ago</div>
                </div>
            </div>
        </div>

        <style>
            @keyframes blink {
                0% {
                    opacity: 1;
                }

                50% {
                    opacity: 0.3;
                }

                100% {
                    opacity: 1;
                }
            }

            .asset-tab.active {
                background-color: black !important;
                color: white !important;
                border-bottom: 3px solid var(--primary-accent);
            }
        </style>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Initialize TradingView Charts
            function initCharts() {
                // Crypto Chart
                new TradingView.widget({
                    "autosize": true,
                    "symbol": "BITSTAMP:BTCUSD",
                    "interval": "30",
                    "timezone": "Etc/UTC",
                    "theme": "dark",
                    "style": "1",
                    "locale": "en",
                    "toolbar_bg": "#0C3A30",
                    "enable_publishing": false,
                    "hide_top_toolbar": true,
                    "hide_side_toolbar": false,
                    "allow_symbol_change": true,
                    "container_id": "crypto-chart"
                });

                // Forex Chart
                new TradingView.widget({
                    "autosize": true,
                    "symbol": "FX:EURUSD",
                    "interval": "30",
                    "timezone": "Etc/UTC",
                    "theme": "dark",
                    "style": "1",
                    "locale": "en",
                    "toolbar_bg": "#0C3A30",
                    "enable_publishing": false,
                    "hide_top_toolbar": true,
                    "hide_side_toolbar": false,
                    "allow_symbol_change": true,
                    "container_id": "forex-chart"
                });

                // Real Estate Chart
                new TradingView.widget({
                    "autosize": true,
                    "symbol": "NYSE:VNQ",
                    "interval": "D",
                    "timezone": "Etc/UTC",
                    "theme": "dark",
                    "style": "1",
                    "locale": "en",
                    "toolbar_bg": "#0C3A30",
                    "enable_publishing": false,
                    "hide_top_toolbar": true,
                    "hide_side_toolbar": false,
                    "allow_symbol_change": true,
                    "container_id": "realestate-chart"
                });
            }

            // Enhanced real-time data simulation
            function simulateMarketData() {
                // Crypto Prices (20+ coins)
                document.getElementById('btc-price').textContent = (Math.random() * 2000 + 62000).toFixed(2);
                document.getElementById('eth-price').textContent = (Math.random() * 200 + 3100).toFixed(2);
                document.getElementById('bnb-price').textContent = (Math.random() * 20 + 580).toFixed(2);
                document.getElementById('sol-price').textContent = (Math.random() * 10 + 140).toFixed(2);
                document.getElementById('xrp-price').textContent = (0.50 + Math.random() * 0.04).toFixed(2);
                document.getElementById('ada-price').textContent = (0.45 + Math.random() * 0.02).toFixed(2);
                document.getElementById('doge-price').textContent = (0.11 + Math.random() * 0.02).toFixed(2);
                document.getElementById('dot-price').textContent = (6.80 + Math.random() * 0.04).toFixed(2);
                document.getElementById('shib-price').textContent = (0.000022 + Math.random() * 0.000002).toFixed(6);
                document.getElementById('avax-price').textContent = (34.00 + Math.random() * 1.2).toFixed(2);
                document.getElementById('link-price').textContent = (18.00 + Math.random() * 0.7).toFixed(2);
                document.getElementById('matic-price').textContent = (0.70 + Math.random() * 0.04).toFixed(2);

                // Forex Prices (20+ pairs)
                document.getElementById('eur-price').textContent = (1.0850 + Math.random() * 0.003).toFixed(4);
                document.getElementById('gbp-price').textContent = (1.2740 + Math.random() * 0.004).toFixed(4);
                document.getElementById('jpy-price').textContent = (157.30 + Math.random() * 0.5).toFixed(2);
                document.getElementById('aud-price').textContent = (0.6650 + Math.random() * 0.002).toFixed(4);
                document.getElementById('cad-price').textContent = (1.3620 + Math.random() * 0.002).toFixed(4);
                document.getElementById('eurgbp-price').textContent = (0.8510 + Math.random() * 0.001).toFixed(4);
                document.getElementById('chf-price').textContent = (0.9010 + Math.random() * 0.001).toFixed(4);
                document.getElementById('nzd-price').textContent = (0.6120 + Math.random() * 0.001).toFixed(4);
                document.getElementById('try-price').textContent = (34.8000 + Math.random() * 0.2).toFixed(4);
                document.getElementById('mxn-price').textContent = (18.3000 + Math.random() * 0.1).toFixed(4);
                document.getElementById('zar-price').textContent = (18.6000 + Math.random() * 0.1).toFixed(4);
                document.getElementById('sgd-price').textContent = (1.3520 + Math.random() * 0.001).toFixed(4);

                // Real Estate (12+ metrics)
                document.getElementById('reit-price').textContent = (Math.random() * 20 + 1400).toFixed(2);
                document.getElementById('commercial-price').textContent = (Math.random() * 10 + 240).toFixed(2);
                document.getElementById('residential-price').textContent = (Math.random() * 10 + 180).toFixed(2);
                document.getElementById('industrial-price').textContent = (Math.random() * 15 + 310).toFixed(2);
                document.getElementById('us-housing-price').textContent = (Math.random() * 10 + 350).toFixed(2);
                document.getElementById('eu-property-price').textContent = (Math.random() * 10 + 275).toFixed(2);
                document.getElementById('asia-reit-price').textContent = (Math.random() * 8 + 195).toFixed(2);
                document.getElementById('luxury-price').textContent = (Math.random() * 20 + 535).toFixed(2);

                // Update bot status randomly
                const statuses = ['ACTIVE', 'ANALYZING', 'EXECUTING', 'REBALANCING'];
                document.getElementById('bot-status').textContent = statuses[Math.floor(Math.random() * statuses.length)];
                document.getElementById('last-trade').textContent = `${Math.floor(Math.random() * 5)} seconds ago`;
            }

            // Initialize on load
            document.addEventListener('DOMContentLoaded', () => {
                initCharts();
                simulateMarketData();
                setInterval(simulateMarketData, 2000); // Faster updates for more activity

                // Add active class to clicked tabs
                document.querySelectorAll('.asset-tab').forEach(tab => {
                    tab.addEventListener('click', function() {
                        document.querySelectorAll('.asset-tab').forEach(t => {
                            t.classList.remove('active');
                            t.style.backgroundColor = '';
                        });
                        this.classList.add('active');
                        this.style.backgroundColor = 'black';
                    });
                });
            });
        </script>


        <div class="cyber-border p-0">
            <div class="card-area py-5">
                <div class="container-fluid side-padding" style="max-width: 1440px; margin: 0 auto;">

                    <!-- ========================================= -->
                    <!-- SECTION HEADER - PERFECTLY CENTERED & SWEET -->
                    <!-- ========================================= -->
                    <div class="text-center mb-5" data-cues="slideInUp" data-duration="800">
                        <div class="d-flex justify-content-center mb-3">
                            <span class="badge px-4 py-2 rounded-pill fw-semibold d-inline-flex align-items-center gap-2"
                                style="background: linear-gradient(145deg, #0C3A30, #0A2A23); color: white; border: 1px solid rgba(139,201,5,0.4); letter-spacing: 0.5px; box-shadow: 0 10px 20px -8px rgba(10,42,35,0.2);">
                                <span style="display: inline-block; width: 8px; height: 8px; background: #8BC905; border-radius: 50%; box-shadow: 0 0 8px #8BC905; animation: pulse 2s infinite;"></span>
                                POWERED BY MARKETMIND AI
                            </span>
                        </div>

                        <h2 class="display-5 fw-bold mb-3 mx-auto" style="color: #0C3A30; max-width: 800px; line-height: 1.2;">
                            Intelligence That
                            <span style="color: #8BC905; position: relative; display: inline-block;">
                                Outperforms
                                <span class="position-absolute start-0 w-100" style="bottom: 0.1em; height: 8px; background: rgba(139,201,5,0.25); border-radius: 30px; z-index: -1;"></span>
                            </span>
                        </h2>

                        <p class="fs-5 text-secondary mx-auto px-3" style="color: #4A5C5A !important; max-width: 600px; line-height: 1.6;">
                            Experience the next generation of financial technology with our proprietary AI execution engine
                        </p>
                    </div>

                    <!-- ========================================= -->
                    <!-- CARDS GRID - 3 PERFECTLY BALANCED CARDS -->
                    <!-- NO OVERLAP, NO TEXT OVERFLOW, CLEAN ALIGNMENT -->
                    <!-- ========================================= -->
                    <div class="row g-4 justify-content-center" data-cues="slideInUp" data-duration="800">

                        <!-- CARD 1 - STRATEGY BUILDER - FRESH & CLEAN -->
                        <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                            <div class="card h-100 w-100 border-0"
                                style="border-radius: 28px; background: white; box-shadow: 0 20px 35px -10px rgba(0,0,0,0.05); transition: all 0.4s ease; overflow: hidden;">

                                <!-- Top accent -->
                                <div style="height: 4px; background: linear-gradient(90deg, #8BC905, #0C3A30);"></div>

                                <div class="p-4 p-xl-4">
                                    <!-- Header -->
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="d-flex align-items-center justify-content-center rounded-3"
                                            style="width: 56px; height: 56px; background: linear-gradient(145deg, #0C3A30, #0A2A23);">
                                            <img src="assets/images/svg/grow.svg" alt="image" style="width: 30px; height: 30px;" class="filter-white">
                                        </div>
                                        <div>
                                            <span class="text-uppercase small fw-bold" style="color: #8BC905; letter-spacing: 1.5px;">PREMIUM</span>
                                            <h4 class="fw-bold mb-0" style="color: #0C3A30; font-size: 1.25rem;">Strategy Builder</h4>
                                        </div>
                                        <span class="ms-auto badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.1); color: #0C3A30; border: 1px solid rgba(139,201,5,0.2);">
                                            AI ⚡
                                        </span>
                                    </div>

                                    <!-- Title -->
                                    <h3 class="fw-bold mb-3" style="color: #0C3A30; font-size: 1.75rem; line-height: 1.2;">
                                        Create <span style="color: #8BC905;">AI-Powered</span><br>Trading Cards For All Transactions
                                    </h3>

                                    <!-- Stats row -->
                                    <div class="d-flex gap-3 mb-3">
                                        <div>
                                            <span class="fw-bold fs-4" style="color: #0C3A30;">127%</span>
                                            <span class="d-block small text-secondary">Avg. APY</span>
                                        </div>
                                        <div style="width: 1px; height: 30px; background: rgba(0,0,0,0.1);"></div>
                                        <div>
                                            <span class="fw-bold fs-4" style="color: #0C3A30;">2.4K+</span>
                                            <span class="d-block small text-secondary">Active</span>
                                        </div>
                                        <div style="width: 1px; height: 30px; background: rgba(0,0,0,0.1);"></div>
                                        <div>
                                            <span class="fw-bold fs-4" style="color: #0C3A30;">4.9</span>
                                            <span class="d-block small text-secondary">★ Rating</span>
                                        </div>
                                    </div>

                                    <!-- Image -->
                                    <div class="rounded-4 overflow-hidden mb-3" style="background: linear-gradient(145deg, #f5f7fa, #e9ecf0); height: 160px;">
                                        <img src="assets/images/service/service-image-1.png" alt="image" class="w-100 h-100" style="object-fit: cover;">
                                    </div>

                                    <!-- Tags - neatly wrapped -->
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <span style="display: inline-block; width: 6px; height: 6px; background: #8BC905; border-radius: 50%;"></span>
                                            <span class="small fw-semibold" style="color: #0C3A30;">ACTIVE MARKETS</span>
                                        </div>
                                        <div class="d-flex flex-wrap gap-1">
                                            <span class="badge px-3 py-2 rounded-pill fw-normal" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">📊 S&P 500</span>
                                            <span class="badge px-3 py-2 rounded-pill fw-normal" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">🚀 Growth</span>
                                            <span class="badge px-3 py-2 rounded-pill fw-normal" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">💎 Blue Chip</span>
                                            <span class="badge px-3 py-2 rounded-pill fw-normal" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">🌍 Global</span>
                                            <span class="badge px-3 py-2 rounded-pill fw-normal" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">⚡ Tech</span>
                                        </div>
                                    </div>

                                    <!-- CTA -->
                                    <a href="{{('login')}}" class="btn w-100 py-3 rounded-pill fw-semibold d-flex align-items-center justify-content-between px-4 mt-2"
                                        style="background: #0C3A30; color: white; border: none;">
                                        <span>Build Your Strategy</span>
                                        <span class="rounded-circle bg-white p-1 d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; background: rgba(255,255,255,0.2) !important;">
                                            <i class="fas fa-arrow-right" style="color: white; font-size: 0.9rem;"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- CARD 2 - GLOBAL BANKING - RICH & ELEGANT -->
                        <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                            <div class="card h-100 w-100 border-0"
                                style="border-radius: 28px; background: linear-gradient(145deg, #0C3A30, #08231e); box-shadow: 0 25px 35px -15px rgba(8,35,30,0.3); transition: all 0.4s ease; overflow: hidden;">

                                <!-- Decorative pattern -->
                                <div class="position-absolute w-100 h-100 opacity-10"
                                    style="background-image: radial-gradient(circle at 20px 20px, #9EDD05 1px, transparent 1px); background-size: 25px 25px;"></div>

                                <div class="p-4 p-xl-4 position-relative" style="z-index: 2;">
                                    <!-- Header -->
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="d-flex align-items-center justify-content-center rounded-3"
                                                style="width: 56px; height: 56px; background: rgba(255,255,255,0.1); backdrop-filter: blur(5px); border: 1px solid rgba(158,221,5,0.3);">
                                                <img src="assets/images/svg/corporation.svg" alt="image" style="width: 30px; height: 30px;" class="filter-white">
                                            </div>
                                            <div>
                                                <span class="text-uppercase small fw-bold" style="color: #9EDD05; letter-spacing: 1.5px;">Marketmind</span>
                                                <h4 class="fw-bold mb-0 text-white" style="font-size: 1.25rem;">Global Banking</h4>
                                            </div>
                                        </div>
                                        <span class="badge px-3 py-2 rounded-pill" style="background: rgba(158,221,5,0.15); color: #9EDD05; border: 1px solid rgba(158,221,5,0.3);">
                                            <i class="fas fa-bolt me-1" style="font-size: 0.7rem;"></i> LIVE
                                        </span>
                                    </div>

                                    <!-- Title -->
                                    <h3 class="fw-bold mb-3 text-white" style="font-size: 1.75rem; line-height: 1.2;">
                                        Zero-Fee<br><span style="color: #9EDD05;">Worldwide Transactions</span>
                                    </h3>

                                    <!-- Live rates -->
                                    <div class="d-flex align-items-center gap-3 mb-3 p-3 rounded-3" style="background: rgba(0,0,0,0.2); backdrop-filter: blur(5px);">
                                        <span style="color: white !important;" class="small text-white-80">EUR/USD <strong style="color: #9EDD05;">1.0856</strong></span>
                                        <span style="color: white !important;" class="small text-white-80">GBP/USD <strong style="color: #9EDD05;">1.2742</strong></span>
                                        <span style="color: white !important;" class="small text-white-80">USD/JPY <strong style="color: #9EDD05;">157.32</strong></span>
                                    </div>

                                    <!-- Card image -->
                                    <div class="text-center mb-3">
                                        <img src="assets/images/service/service-image-2.png" alt="image" class="img-fluid" style="max-height: 110px; filter: drop-shadow(0 15px 20px -8px rgba(0,0,0,0.4));">
                                    </div>

                                    <!-- Balance card -->
                                    <div class="p-3 rounded-4 mb-3" style="background: rgba(0,0,0,0.25); backdrop-filter: blur(10px); border: 1px solid rgba(158,221,5,0.2);">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="small text-white-50 text-uppercase">Total Balance</span>
                                                <h4 class="fw-bold mb-0 text-white" style="font-size: 1.75rem; letter-spacing: -0.5px;">$59,647</h4>
                                            </div>
                                            <span class="badge p-3 rounded-circle" style="background: rgba(158,221,5,0.2);">
                                                <i class="fas fa-arrow-up" style="color: #9EDD05;"></i>
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <div class="d-flex justify-content-between mb-1">
                                                <span class="small text-white-50">Monthly limit</span>
                                                <span class="small text-white">$68K / $100K</span>
                                            </div>
                                            <div class="progress" style="height: 5px; background: rgba(255,255,255,0.1);">
                                                <div class="progress-bar" style="width: 68%; background: #9EDD05; border-radius: 3px;"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="d-flex gap-2">
                                        <a href="{{('login')}}" class="btn flex-grow-1 py-3 rounded-pill fw-semibold" style="background: #9EDD05; color: #0C3A30;">
                                            <i class="fas fa-paper-plane me-2"></i>Send
                                        </a>
                                        <a href="#" class="btn p-3 rounded-circle" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(158,221,5,0.3); color: white; width: 52px; height: 52px;">
                                            <i class="fas fa-qrcode"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CARD 3 - SMART GOALS - FRESH & MODERN -->
                        <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                            <div class="card h-100 w-100 border-0"
                                style="border-radius: 28px; background: white; box-shadow: 0 20px 35px -10px rgba(0,0,0,0.05); transition: all 0.4s ease; overflow: hidden;">

                                <!-- Corner accent -->
                                <div class="position-absolute top-0 end-0" style="width: 80px; height: 80px; background: linear-gradient(135deg, transparent 50%, rgba(139,201,5,0.08) 50%);"></div>

                                <div class="p-4 p-xl-4 position-relative" style="z-index: 2;">
                                    <!-- Header -->
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="d-flex align-items-center justify-content-center rounded-3"
                                            style="width: 56px; height: 56px; background: rgba(139,201,5,0.1);">
                                            <img src="assets/images/svg/euro.svg" alt="image" style="width: 30px; height: 30px; filter: brightness(0) saturate(100%) invert(53%) sepia(98%) saturate(2027%) hue-rotate(43deg);">
                                        </div>
                                        <div>
                                            <span class="text-uppercase small fw-bold" style="color: #8BC905; letter-spacing: 1.5px;">AUTOMATED INSIGHTS</span>
                                            <h4 class="fw-bold mb-0" style="color: #0C3A30; font-size: 1.25rem;">Smart Goals</h4>
                                        </div>
                                    </div>

                                    <!-- Title -->
                                    <h3 class="fw-bold mb-3" style="color: #0C3A30; font-size: 1.75rem; line-height: 1.2;">
                                        Personalized<br><span style="color: #8BC905; position: relative;">Trading Goals
                                            <span style="position: absolute; bottom: 2px; left: 0; width: 100%; height: 6px; background: rgba(139,201,5,0.2); border-radius: 3px; z-index: -1;"></span>
                                        </span>
                                    </h3>

                                    <!-- Stats -->
                                    <div class="d-flex gap-4 mb-3">
                                        <div>
                                            <span class="fw-bold fs-4" style="color: #0C3A30;">98.7%</span>
                                            <span class="d-block small text-secondary">Trader(Admin) Confidence</span>
                                        </div>
                                        <div style="width: 1px; height: 30px; background: rgba(0,0,0,0.1);"></div>
                                        <div>
                                            <span class="fw-bold fs-4" style="color: #0C3A30;">24/30</span>
                                            <span class="d-block small text-secondary">Goals Met</span>
                                        </div>
                                    </div>

                                    <!-- Image with floating card -->
                                    <div class="position-relative mb-3" style="height: 140px;">
                                        <div class="text-end">
                                            <img src="assets/images/service/service-image-3.png" alt="image" style="height: 130px; object-fit: contain;">
                                        </div>
                                        <div class="position-absolute bottom-0 start-0 bg-white shadow-lg rounded-3 p-3 d-flex align-items-center gap-2"
                                            style="border-left: 4px solid #8BC905; max-width: 160px; animation: gentleFloat 4s ease-in-out infinite;">
                                            <i class="fas fa-piggy-bank" style="color: #8BC905;"></i>
                                            <div>
                                                <div class="small text-secondary">Trading Goal</div>
                                                <div class="fw-bold" style="color: #0C3A30;">$24,500</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Progress -->
                                    <div class="mt-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="small text-secondary">Next milestone: $12,000</span>
                                            <span class="small fw-bold" style="color: #0C3A30;">75%</span>
                                        </div>
                                        <div class="progress mb-4" style="height: 6px; background: rgba(139,201,5,0.1);">
                                            <div class="progress-bar" style="width: 75%; background: #8BC905; border-radius: 3px;"></div>
                                        </div>
                                    </div>

                                    <!-- CTA -->
                                    <a href="{{('login')}}" class="btn w-100 py-3 rounded-pill fw-semibold d-flex align-items-center justify-content-between px-4"
                                        style="border: 2px solid #8BC905; color: #0C3A30; background: transparent;">
                                        <span>View Insights</span>
                                        <span class="rounded-circle d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; background: #8BC905;">
                                            <i class="fas fa-arrow-right" style="color: white; font-size: 0.9rem;"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================= -->
                    <!-- BOTTOM CTA - CLEAN & CENTERED -->
                    <!-- ========================================= -->
                    <div class="text-center mt-5 pt-4" data-cues="slideInUp" data-duration="800">
                        <a href="{{('login')}}" class="btn btn-lg px-5 py-3 rounded-pill fw-bold d-inline-flex align-items-center gap-3"
                            style="background: linear-gradient(145deg, #0C3A30, #08231e); color: white; border: none; box-shadow: 0 20px 30px -10px rgba(12,58,48,0.25);">
                            <span>Start Building Your Strategy</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <p class="small text-secondary mt-3" style="color: #4A5C5A !important;">
                            No credit card required • Free AI consultation included
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <style>
            /* ============ CLEAN ANIMATIONS ============ */

            @keyframes pulse {
                0% {
                    opacity: 1;
                    transform: scale(1);
                }

                50% {
                    opacity: 0.8;
                    transform: scale(0.95);
                    box-shadow: 0 0 12px #8BC905;
                }

                100% {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            @keyframes gentleFloat {
                0% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-5px);
                }

                100% {
                    transform: translateY(0);
                }
            }

            .card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .card:hover {
                transform: translateY(-8px);
                box-shadow: 0 30px 45px -15px rgba(0, 0, 0, 0.15) !important;
            }

            .filter-white {
                filter: brightness(0) invert(1);
            }

            .text-white-50 {
                color: rgba(255, 255, 255, 0.6);
            }

            .text-white-80 {
                color: rgba(255, 255, 255, 0.85);
            }

            /* Container constraint */
            .container-fluid.side-padding {
                padding-left: 30px;
                padding-right: 30px;
            }

            @media (min-width: 1440px) {
                .container-fluid.side-padding {
                    padding-left: 50px;
                    padding-right: 50px;
                }
            }

            /* Perfect card heights */
            .d-flex>.card {
                display: flex;
                flex-direction: column;
            }

            .card .p-4 {
                flex: 1;
                display: flex;
                flex-direction: column;
            }

            .card .btn {
                margin-top: auto;
            }

            /* Clean tag styling */
            .badge {
                font-weight: 500;
                transition: all 0.2s ease;
            }

            .badge:hover {
                background: rgba(139, 201, 5, 0.15) !important;
                transform: scale(1.02);
            }

            /* No text overflow */
            h3,
            h4,
            p {
                overflow-wrap: break-word;
                word-wrap: break-word;
                hyphens: auto;
            }
        </style>




        <!-- Start Pricing Plan Area -->
        <!-- Start Pricing Plan Area -->
        <div class="pricing-plan-area py-5 py-md-6 mb-5" style="background: linear-gradient(145deg, #f8fafc, #f0f4f8); position: relative; overflow: hidden;">

            <!-- Decorative Elements -->
            <div class="position-absolute" style="top: -100px; right: -50px; width: 300px; height: 300px; border-radius: 50%; background: radial-gradient(circle, rgba(139,201,5,0.03) 0%, transparent 70%); pointer-events: none;"></div>
            <div class="position-absolute" style="bottom: -50px; left: -50px; width: 250px; height: 250px; border-radius: 50%; background: radial-gradient(circle, rgba(12,58,48,0.02) 0%, transparent 70%); pointer-events: none;"></div>

            <div class="container" style="max-width: 1280px; margin: 0 auto; position: relative; z-index: 2;">

                <!-- ========================================= -->
                <!-- SECTION HEADER - PREMIUM & CENTERED -->
                <!-- ========================================= -->
                <div class="text-center mb-5" data-cues="slideInUp" data-duration="800">
                    <div class="d-flex justify-content-center mb-3">
                        <span class="badge px-4 py-2 rounded-pill fw-semibold d-inline-flex align-items-center gap-2"
                            style="background: linear-gradient(145deg, #0C3A30, #0A2A23); color: white; border: 1px solid rgba(139,201,5,0.4); letter-spacing: 0.5px; box-shadow: 0 10px 20px -8px rgba(10,42,35,0.2);">
                            <span style="display: inline-block; width: 8px; height: 8px; background: #8BC905; border-radius: 50%; box-shadow: 0 0 8px #8BC905; animation: pulse 2s infinite;"></span>
                            PRICING PLANS
                        </span>
                    </div>

                    <h2 class="display-5 fw-bold mb-3 mx-auto" style="color: #0C3A30; max-width: 700px; line-height: 1.2;">
                        Choose The <span style="color: #8BC905; position: relative; display: inline-block;">
                            Best Plan
                            <span class="position-absolute start-0 w-100" style="bottom: 0.1em; height: 8px; background: rgba(139,201,5,0.25); border-radius: 30px; z-index: -1;"></span>
                        </span>
                        <br>That Fits You
                    </h2>

                    <p class="fs-5 text-secondary mx-auto px-3" style="color: #4A5C5A !important; max-width: 600px; line-height: 1.6;">
                        Select your perfect investment plan and start growing your wealth with our AI-powered strategies
                    </p>
                </div>

                <!-- ========================================= -->
                <!-- PRICING CARDS - 3 PERFECTLY BALANCED -->
                <!-- ========================================= -->
                <div class="row g-4 justify-content-center" data-cues="slideInUp" data-duration="800">
                    @php
                    $sortedPlans = $plans->sortBy('minimum_amount')->values();
                    $popularPlanId = $sortedPlans->count() > 1 ? $sortedPlans[1]->id : ($sortedPlans[0]->id ?? null);
                    @endphp

                    @foreach($plans->take(3) as $plan)
                    <div class="col-lg-4 col-md-6 d-flex">
                        <div class="card h-100 w-100 border-0 position-relative"
                            style="border-radius: 32px; background: white; box-shadow: 0 20px 35px -10px rgba(0,0,0,0.05); transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); overflow: hidden;">

                            <!-- Top Accent Bar -->
                            <div style="height: 6px; background: linear-gradient(90deg, #8BC905, #0C3A30, #8BC905); background-size: 200% 100%; animation: shimmer 3s infinite;"></div>

                            <!-- Popular Badge -->
                            @if($plan->id === $popularPlanId)
                            <span class="position-absolute px-4 py-2 fw-bold d-inline-flex align-items-center gap-2"
                                style="top: 6px; right: 6px; background: linear-gradient(135deg, #FF6B6B, #FF4757); color: white; border-radius: 30px; font-size: 0.8rem; letter-spacing: 0.5px; box-shadow: 0 8px 16px -4px rgba(255,71,87,0.3); z-index: 10;">
                                <span style="display: inline-block; width: 6px; height: 6px; background: white; border-radius: 50%; animation: pulse 2s infinite;"></span>
                                ⭐ MOST POPULAR
                            </span>
                            @endif

                            <!-- Premium Badge for Highest Plan -->
                            @if($loop->last && !$plan->id === $popularPlanId)
                            <span class="position-absolute px-4 py-2 fw-bold d-inline-flex align-items-center gap-2"
                                style="top: 20px; right: 20px; background: linear-gradient(145deg, #0C3A30, #0A2A23); color: white; border: 1px solid rgba(139,201,5,0.3); border-radius: 30px; font-size: 0.8rem; letter-spacing: 0.5px; box-shadow: 0 8px 16px -4px rgba(12,58,48,0.2); z-index: 10;">
                                <i class="fas fa-crown" style="color: #FFD700;"></i>
                                PREMIUM
                            </span>
                            @endif

                            <div class="p-4 p-xl-5 d-flex flex-col h-100">

                                <!-- Plan Icon & Name -->
                                <div class="text-center mb-4">
                                    <div class="d-flex justify-content-center mb-3">
                                        <div class="d-flex align-items-center justify-content-center rounded-4"
                                            style="width: 100px; height: 100px; background: linear-gradient(145deg, rgba(139,201,5,0.1), rgba(12,58,48,0.05)); border-radius: 24px !important;">
                                            <img src="{{ asset('assets/images/depositimage.jpg') }}" alt="Plan Icon"
                                                style="width: 70px; height: 70px; border-radius: 16px; object-fit: cover; box-shadow: 0 10px 20px -8px rgba(0,0,0,0.1);">
                                        </div>
                                    </div>
                                    <h3 class="fw-bold mb-1" style="color: #0C3A30; font-size: 1.75rem; letter-spacing: -0.5px;">
                                        {{ $plan->name }}
                                    </h3>

                                    <!-- Interest Rate Display -->
                                    <div class="d-flex align-items-baseline justify-content-center gap-1 mt-2">
                                        <span class="fw-black" style="color: #8BC905; font-size: 2.5rem; line-height: 1;">
                                            {{ rtrim(rtrim($plan->interest_rate, '0'), '.') }}%
                                        </span>
                                        <span class="text-secondary" style="font-size: 1rem;">/ Per Term</span>
                                    </div>

                                    <!-- Duration Chip -->
                                    <span class="badge px-4 py-2 rounded-pill mt-2"
                                        style="background: rgba(139,201,5,0.08); color: #0C3A30; border: 1px solid rgba(139,201,5,0.2); font-size: 0.9rem;">
                                        📅 {{ $plan->duration }} Days Duration
                                    </span>
                                </div>

                                <!-- Features List - Premium Check Icons -->
                                <div class="mt-3">
                                    <ul class="list-unstyled d-flex flex-column gap-3">
                                        <li class="d-flex align-items-start gap-3">
                                            <span class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                                style="width: 24px; height: 24px; background: rgba(139,201,5,0.15); color: #8BC905;">
                                                <i class="ri-check-line" style="font-size: 14px; font-weight: bold;"></i>
                                            </span>
                                            <span style="color: #0C3A30; font-size: 1rem;">
                                                <strong>Duration:</strong> {{ $plan->duration }} Days
                                            </span>
                                        </li>
                                        <li class="d-flex align-items-start gap-3">
                                            <span class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                                style="width: 24px; height: 24px; background: rgba(139,201,5,0.15); color: #8BC905;">
                                                <i class="ri-check-line" style="font-size: 14px; font-weight: bold;"></i>
                                            </span>
                                            <span style="color: #0C3A30; font-size: 1rem;">
                                                <strong>Return Rate:</strong> {{ rtrim(rtrim($plan->interest_rate, '0'), '.') }}%
                                            </span>
                                        </li>
                                        <li class="d-flex align-items-start gap-3">
                                            <span class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                                style="width: 24px; height: 24px; background: rgba(139,201,5,0.15); color: #8BC905;">
                                                <i class="ri-check-line" style="font-size: 14px; font-weight: bold;"></i>
                                            </span>
                                            <span style="color: #0C3A30; font-size: 1rem;">
                                                <strong>Earnings:</strong>
                                                <span class="badge ms-1 px-3 py-1 rounded-pill"
                                                    style="background: {{ $plan->duration < 28 ? 'rgba(139,201,5,0.15)' : 'rgba(12,58,48,0.1)' }}; color: #0C3A30; font-weight: 600;">
                                                    {{ $plan->duration < 28 ? '⚡ Daily' : '📆 Weekly' }}
                                                </span>
                                            </span>
                                        </li>
                                        <li class="d-flex align-items-start gap-3">
                                            <span class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                                style="width: 24px; height: 24px; background: rgba(139,201,5,0.15); color: #8BC905;">
                                                <i class="ri-check-line" style="font-size: 14px; font-weight: bold;"></i>
                                            </span>
                                            <span style="color: #0C3A30; font-size: 1rem;">
                                                <strong>Min Deposit:</strong>
                                                <span class="fw-bold" style="color: #0C3A30;">${{ number_format($plan->minimum_amount) }}</span>
                                            </span>
                                        </li>
                                        <li class="d-flex align-items-start gap-3">
                                            <span class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                                style="width: 24px; height: 24px; background: rgba(139,201,5,0.15); color: #8BC905;">
                                                <i class="ri-check-line" style="font-size: 14px; font-weight: bold;"></i>
                                            </span>
                                            <span style="color: #0C3A30; font-size: 1rem;">
                                                <strong>Max Deposit:</strong>
                                                <span class="fw-bold" style="color: #0C3A30;">${{ number_format($plan->maximum_amount) }}</span>
                                            </span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Potential Earnings Preview -->
                                <div class="mt-4 p-3 rounded-4" style="background: rgba(139,201,5,0.04); border: 1px dashed rgba(139,201,5,0.3);">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="small text-secondary">Potential return on $1,000</span>
                                        <span class="fw-bold" style="color: #8BC905;">
                                            +${{ number_format(1000 * ($plan->interest_rate / 100), 2) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- CTA Button - Spacer to push to bottom -->
                                <div class="mt-auto pt-4">
                                    <a href="/login" class="btn w-100 py-3 rounded-pill fw-bold d-flex align-items-center justify-content-between px-4"
                                        style="background: {{ $plan->id === $popularPlanId ? 'linear-gradient(145deg, #8BC905, #7AB805)' : 'linear-gradient(145deg, #0C3A30, #0A2A23)' }}; color: white; border: none; transition: all 0.3s;">
                                        <span>Get Started</span>
                                        <span class="rounded-circle bg-white/20 p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                            <i class="ri-arrow-right-up-line" style="color: white; font-size: 1.2rem;"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- ========================================= -->
                <!-- BOTTOM CTA - VIEW ALL PLANS -->
                <!-- ========================================= -->
                <div class="text-center mt-5 pt-4" data-cues="slideInUp" data-duration="800">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('plans.header') }}"
                            class="btn btn-lg px-5 py-3 rounded-pill fw-bold d-inline-flex align-items-center gap-3"
                            style="background: white; color: #0C3A30; border: 2px solid rgba(139,201,5,0.3); box-shadow: 0 10px 25px -8px rgba(0,0,0,0.05); transition: all 0.3s;">
                            <span style="font-size: 1.1rem;">🔍 View All Investment Plans</span>
                            <span class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 32px; height: 32px; background: rgba(139,201,5,0.1); color: #8BC905;">
                                <i class="ri-arrow-right-line"></i>
                            </span>
                        </a>
                    </div>
                    <p class="small text-secondary mt-3" style="color: #4A5C5A !important;">
                        ✨ All plans include AI-powered analytics and 24/7 support
                    </p>
                </div>
            </div>
        </div>

        <style>
            /* ============ PREMIUM ANIMATIONS ============ */

            @keyframes pulse {
                0% {
                    opacity: 1;
                    transform: scale(1);
                }

                50% {
                    opacity: 0.8;
                    transform: scale(0.95);
                    box-shadow: 0 0 12px #8BC905;
                }

                100% {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            @keyframes shimmer {
                0% {
                    background-position: 200% 0;
                }

                100% {
                    background-position: -200% 0;
                }
            }

            /* Card Hover Effects */
            .card {
                transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1),
                    box-shadow 0.4s ease;
            }

            .card:hover {
                transform: translateY(-12px);
                box-shadow: 0 30px 45px -15px rgba(12, 58, 48, 0.15) !important;
            }

            .card:hover .btn {
                transform: scale(1.02);
            }

            .card:hover .d-flex.justify-content-center div:first-child {
                transform: scale(1.05);
                transition: transform 0.4s ease;
            }

            /* Button Hover Effect */
            .btn:hover {
                transform: translateY(-2px);

                box-shadow: 0 15px 25px -8px {
                        {
                        $plan->id ===$popularPlanId ? 'rgba(139,201,5,0.4)': 'rgba(12,58,48,0.3)'
                    }
                }

                !important;
            }

            .btn:hover .bg-white\/20 {
                transform: translateX(4px);
                transition: transform 0.3s ease;
            }

            /* List Item Hover Effect */
            .list-unstyled li {
                transition: transform 0.2s ease;
            }

            .list-unstyled li:hover {
                transform: translateX(4px);
            }

            .list-unstyled li:hover .rounded-circle {
                background: rgba(139, 201, 5, 0.25) !important;
                transition: background 0.2s ease;
            }

            /* View All Plans Button Hover */
            .btn-outline-accent:hover {
                background: rgba(139, 201, 5, 0.05);
                border-color: #8BC905 !important;
                transform: translateY(-3px);
            }

            /* Badge Shine Effect */
            .position-absolute.px-4.py-2 {
                backdrop-filter: blur(4px);
            }

            /* Container width control */
            .container {
                padding-left: 20px;
                padding-right: 20px;
            }

            @media (min-width: 992px) {
                .container {
                    padding-left: 30px;
                    padding-right: 30px;
                }
            }

            /* Consistent card heights */
            .d-flex>.card {
                display: flex;
                flex-direction: column;
            }

            .card .p-4.p-xl-5 {
                flex: 1;
                display: flex;
                flex-direction: column;
            }

            /* Ensure no text overflow */
            h3,
            h4,
            p,
            span {
                overflow-wrap: break-word;
                word-wrap: break-word;
            }

            /* Custom gradient text for premium feel */
            .gradient-text {
                background: linear-gradient(145deg, #8BC905, #0C3A30);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            /* Smooth icon transitions */
            .ri-check-line,
            .ri-arrow-right-up-line,
            .ri-arrow-right-line {
                transition: transform 0.2s ease;
            }

            .btn:hover .ri-arrow-right-up-line,
            .btn:hover .ri-arrow-right-line {
                transform: translateX(4px) translateY(-2px);
            }
        </style>
        <!-- End Pricing Plan Area -->
        <!-- End Main Banner Area -->

        <!-- Start Features Area - Premium Redesign -->
        <div class="features-area position-relative py-5 py-md-6 overflow-hidden"
            style="background: linear-gradient(145deg, #0C3A30, #0A2A23);">

            <!-- Premium Decorative Elements -->
            <div class="position-absolute" style="top: -150px; right: -100px; width: 500px; height: 500px; border-radius: 50%; background: radial-gradient(circle, rgba(139,201,5,0.08) 0%, transparent 70%); pointer-events: none;"></div>
            <div class="position-absolute" style="bottom: -100px; left: -50px; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(158,221,5,0.05) 0%, transparent 70%); pointer-events: none;"></div>
            <div class="position-absolute" style="top: 30%; left: 10%; width: 200px; height: 200px; border-radius: 50%; background: radial-gradient(circle, rgba(139,201,5,0.03) 0%, transparent 70%); pointer-events: none; filter: blur(40px);"></div>

            <!-- Animated Grid Pattern -->
            <div class="position-absolute w-100 h-100 opacity-5"
                style="top: 0; left: 0; background-image: radial-gradient(circle at 20px 20px, rgba(158,221,5,0.1) 1px, transparent 1px); background-size: 40px 40px; pointer-events: none; animation: drift 30s infinite linear;"></div>

            <div class="container position-relative" style="max-width: 1280px; margin: 0 auto; z-index: 5;">
                <div class="row g-5 align-items-center">

                    <!-- ========================================= -->
                    <!-- LEFT COLUMN - PREMIUM FEATURE IMAGE SHOWCASE -->
                    <!-- ========================================= -->
                    <div class="col-xl-6 col-lg-12" data-cues="slideInRight" data-duration="800">
                        <div class="position-relative p-4">
                            <!-- Main Image Container -->
                            <div class="position-relative rounded-5 overflow-hidden"
                                style="background: linear-gradient(145deg, rgba(139,201,5,0.1), rgba(12,58,48,0.2)); backdrop-filter: blur(10px); border: 1px solid rgba(139,201,5,0.15); box-shadow: 0 30px 50px -20px rgba(0,0,0,0.3);">

                                <!-- Glass Morphism Overlay -->
                                <div class="position-absolute top-0 start-0 w-100 h-100"
                                    style="background: radial-gradient(circle at 70% 30%, rgba(139,201,5,0.1) 0%, transparent 70%); pointer-events: none;"></div>

                                <!-- Feature Image 1 - Main -->
                                <div class="text-center p-5">
                                    <img class="img-fluid feature-image-1 hover-float"
                                        src="assets/images/feature/feature-image-1.png"
                                        alt="Analytics Dashboard"
                                        style="max-width: 100%; filter: drop-shadow(0 30px 40px -15px rgba(0,0,0,0.4)); transform: perspective(1000px) rotateY(-5deg) rotateX(5deg); transition: transform 0.6s ease;">
                                </div>

                                <!-- Floating Badges -->
                                <div class="position-absolute top-0 start-0 m-4">
                                    <span class="badge px-4 py-3 rounded-pill fw-semibold d-inline-flex align-items-center gap-2 backdrop-blur"
                                        style="background: rgba(255,255,255,0.95); color: #0C3A30; border: 1px solid rgba(139,201,5,0.3); box-shadow: 0 15px 25px -8px rgba(0,0,0,0.2);">
                                        <span style="display: inline-block; width: 10px; height: 10px; background: #8BC905; border-radius: 50%; box-shadow: 0 0 15px #8BC905; animation: pulse 2s infinite;"></span>
                                        <span class="fw-bold">AI-POWERED</span>
                                    </span>
                                </div>

                                <!-- Feature Image 2 - Floating Element -->
                                <div class="position-absolute" style="bottom: 30px; right: 30px; animation: float 6s ease-in-out infinite;">
                                    <div class="rounded-4 p-3"
                                        style="background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border: 1px solid rgba(139,201,5,0.2); box-shadow: 0 20px 30px -10px rgba(0,0,0,0.15);">
                                        <img class="feature-image-2" src="assets/images/feature/feature-image-2.png" alt="Analytics" style="width: 60px; height: 60px; object-fit: contain;">
                                    </div>
                                </div>

                                <!-- Stats Card - Floating -->
                                <div class="position-absolute" style="bottom: 40px; left: 30px; animation: float 7s ease-in-out infinite; animation-delay: 1s;">
                                    <div class="rounded-4 p-3 d-flex align-items-center gap-3"
                                        style="background: rgba(12,58,48,0.95); backdrop-filter: blur(10px); border: 1px solid rgba(139,201,5,0.3); box-shadow: 0 20px 30px -10px rgba(0,0,0,0.3);">
                                        <div class="rounded-circle p-2" style="background: rgba(139,201,5,0.2);">
                                            <i class="fas fa-chart-line" style="color: #8BC905;"></i>
                                        </div>
                                        <div>
                                            <span class="small text-white-50">Real-time Analytics</span>
                                            <div class="fw-bold text-white" style="font-size: 1.2rem;">2.4M+</div>
                                            <span class="small text-white-50">Daily transactions</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Decorative Shape -->
                            <div class="position-absolute" style="top: -20px; left: -20px; z-index: -1;">
                                <img class="feature-shape-1 moveVertical" src="assets/images/shape/feature-shape-1.png" alt="shape" style="opacity: 0.6;">
                            </div>
                        </div>
                    </div>

                    <!-- ========================================= -->
                    <!-- RIGHT COLUMN - PREMIUM FEATURES CONTENT -->
                    <!-- ========================================= -->
                    <div class="col-xl-6 col-lg-12" data-cues="slideInLeft" data-duration="800">
                        <div class="features-content ps-xl-4">

                            <!-- Section Header -->
                            <div class="section-heading mb-4">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <span class="badge px-4 py-2 rounded-pill fw-semibold d-inline-flex align-items-center gap-2"
                                        style="background: rgba(139,201,5,0.15); color: #8BC905; border: 1px solid rgba(139,201,5,0.3); letter-spacing: 1px; backdrop-filter: blur(5px);">
                                        <span style="display: inline-block; width: 8px; height: 8px; background: #8BC905; border-radius: 50%; box-shadow: 0 0 8px #8BC905; animation: pulse 2s infinite;"></span>
                                        TOP FEATURES
                                    </span>
                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.1);">
                                        ⚡ NEXT-GEN
                                    </span>
                                </div>

                                <h2 class="display-5 fw-bold mb-3 text-white" style="line-height: 1.2; max-width: 600px;">
                                    Let's Take Your
                                    <span style="color: #8BC905; position: relative; display: inline-block;">
                                        Analytics
                                        <span class="position-absolute start-0 w-100" style="bottom: 0.1em; height: 8px; background: rgba(139,201,5,0.3); border-radius: 30px; z-index: 1;"></span>
                                    </span>
                                    <br>To The Next Level
                                </h2>

                                <p class="fs-5 text-white-80 mb-4" style="line-height: 1.6; max-width: 550px;">
                                    From digital banking and payment processing to wealth management and blockchain — we're building the financial infrastructure of tomorrow, today.
                                </p>
                            </div>

                            <!-- Premium Feature Cards -->
                            <div class="d-flex flex-column gap-3 mt-4">

                                <!-- Feature Card 1 -->
                                <div class="feature-card p-4 rounded-4 d-flex align-items-start gap-4"
                                    style="background: rgba(41,89,75,0.5); backdrop-filter: blur(10px); border: 1px solid rgba(139,201,5,0.15); transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);">
                                    <div class="feature-icon-wrapper d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                                        style="width: 64px; height: 64px; background: rgba(139,201,5,0.15); border: 1px solid rgba(139,201,5,0.2);">
                                        <i class="flaticon-businessman-1" style="color: #8BC905; font-size: 2rem;"></i>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold mb-2 text-white" style="font-size: 1.35rem;">Local Business Finance</h3>
                                        <p class="text-white-80 mb-0" style="font-size: 0.95rem; line-height: 1.6;">
                                            Smart financing solutions designed for local businesses with AI-powered risk assessment and instant approvals.
                                        </p>
                                        <div class="d-flex align-items-center gap-3 mt-3">
                                            <span class="small d-flex align-items-center gap-1 text-white-50">
                                                <i class="fas fa-check-circle" style="color: #8BC905;"></i> 24/7 Support
                                            </span>
                                            <span class="small d-flex align-items-center gap-1 text-white-50">
                                                <i class="fas fa-check-circle" style="color: #8BC905;"></i> No Hidden Fees
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Feature Card 2 -->
                                <div class="feature-card p-4 rounded-4 d-flex align-items-start gap-4"
                                    style="background: rgba(41,89,75,0.5); backdrop-filter: blur(10px); border: 1px solid rgba(139,201,5,0.15); transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);">
                                    <div class="feature-icon-wrapper d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                                        style="width: 64px; height: 64px; background: rgba(139,201,5,0.15); border: 1px solid rgba(139,201,5,0.2);">
                                        <i class="flaticon-payment-method" style="color: #8BC905; font-size: 2rem;"></i>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold mb-2 text-white" style="font-size: 1.35rem;">Built For Global Payments</h3>
                                        <p class="text-white-80 mb-0" style="font-size: 0.95rem; line-height: 1.6;">
                                            Seamless cross-border transactions in 150+ currencies with real-time settlement and competitive FX rates.
                                        </p>
                                        <div class="d-flex align-items-center gap-3 mt-3">
                                            <span class="small d-flex align-items-center gap-1 text-white-50">
                                                <i class="fas fa-globe" style="color: #8BC905;"></i> 150+ Countries
                                            </span>
                                            <span class="small d-flex align-items-center gap-1 text-white-50">
                                                <i class="fas fa-bolt" style="color: #8BC905;"></i> Instant Settlement
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Feature Card 3 -->
                                <div class="feature-card p-4 rounded-4 d-flex align-items-start gap-4"
                                    style="background: rgba(41,89,75,0.5); backdrop-filter: blur(10px); border: 1px solid rgba(139,201,5,0.15); transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);">
                                    <div class="feature-icon-wrapper d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                                        style="width: 64px; height: 64px; background: rgba(139,201,5,0.15); border: 1px solid rgba(139,201,5,0.2);">
                                        <i class="flaticon-laptop-2" style="color: #8BC905; font-size: 2rem;"></i>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold mb-2 text-white" style="font-size: 1.35rem;">Make Internet Of Money</h3>
                                        <p class="text-white-80 mb-0" style="font-size: 0.95rem; line-height: 1.6;">
                                            Blockchain-powered financial infrastructure enabling programmable money and smart contract integration.
                                        </p>
                                        <div class="d-flex align-items-center gap-3 mt-3">
                                            <span class="small d-flex align-items-center gap-1 text-white-50">
                                                <i class="fas fa-link" style="color: #8BC905;"></i> Smart Contracts
                                            </span>
                                            <span class="small d-flex align-items-center gap-1 text-white-50">
                                                <i class="fas fa-shield" style="color: #8BC905;"></i> Bank-Grade Security
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- CTA Button -->
                            <div class="mt-4 pt-2">
                                <a href="{{('login')}}" class="btn btn-lg px-5 py-3 rounded-pill fw-bold d-inline-flex align-items-center gap-3"
                                    style="background: #8BC905; color: #0C3A30; border: none; box-shadow: 0 20px 30px -10px rgba(139,201,5,0.3); transition: all 0.3s;">
                                    <span>Explore All Features</span>
                                    <span class="rounded-circle bg-white p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background: rgba(12,58,48,0.1) !important;">
                                        <i class="ri-arrow-right-up-line" style="color: #0C3A30; font-size: 1.2rem;"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================================= -->
            <!-- PARTNER AREA - PREMIUM DARK THEME -->
            <!-- ========================================= -->
            <div class="partner-area mt-5 pt-5 pt-md-6 position-relative">
                <div class="container position-relative" style="max-width: 1280px; margin: 0 auto;">

                    <!-- Section Divider -->
                    <div class="d-flex justify-content-center mb-5">
                        <div style="width: 100px; height: 2px; background: linear-gradient(90deg, transparent, rgba(139,201,5,0.5), transparent);"></div>
                    </div>

                    <div class="text-center mb-4">
                        <span class="text-uppercase small fw-semibold d-inline-block px-4 py-2 rounded-pill"
                            style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2); letter-spacing: 2px; backdrop-filter: blur(5px);">
                            TRUSTED BY INDUSTRY LEADERS
                        </span>
                        <p class="text-white-50 mt-3 mb-0" style="font-size: 0.95rem;">
                            Powering financial innovation for the world's most ambitious companies
                        </p>
                    </div>

                    <div class="partner-items position-relative">
                        <!-- Gradient Overlays for Swiper -->
                        <div class="position-absolute top-0 start-0 h-100" style="width: 80px; background: linear-gradient(90deg, #0C3A30, transparent); z-index: 10; pointer-events: none;"></div>
                        <div class="position-absolute top-0 end-0 h-100" style="width: 80px; background: linear-gradient(-90deg, #0C3A30, transparent); z-index: 10; pointer-events: none;"></div>

                        <div class="swiper partner-slide">
                            <div class="swiper-wrapper">
                                <!-- Partner Logos with Premium Cards -->
                                <div class="swiper-slide">
                                    <div class="partner-logo p-4 rounded-4 d-flex align-items-center justify-content-center"
                                        style="background: rgba(41,89,75,0.3); backdrop-filter: blur(10px); border: 1px solid rgba(139,201,5,0.1); transition: all 0.3s ease; height: 100px;">
                                        <img src="assets/images/partner/partner-logo-1.png" alt="Partner" style="max-width: 120px; max-height: 50px; filter: brightness(0) invert(0.9); opacity: 0.9; transition: all 0.3s ease;">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="partner-logo p-4 rounded-4 d-flex align-items-center justify-content-center"
                                        style="background: rgba(41,89,75,0.3); backdrop-filter: blur(10px); border: 1px solid rgba(139,201,5,0.1); transition: all 0.3s ease; height: 100px;">
                                        <img src="assets/images/partner/partner-logo-2.png" alt="Partner" style="max-width: 120px; max-height: 50px; filter: brightness(0) invert(0.9); opacity: 0.9; transition: all 0.3s ease;">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="partner-logo p-4 rounded-4 d-flex align-items-center justify-content-center"
                                        style="background: rgba(41,89,75,0.3); backdrop-filter: blur(10px); border: 1px solid rgba(139,201,5,0.1); transition: all 0.3s ease; height: 100px;">
                                        <img src="assets/images/partner/partner-logo-3.png" alt="Partner" style="max-width: 120px; max-height: 50px; filter: brightness(0) invert(0.9); opacity: 0.9; transition: all 0.3s ease;">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="partner-logo p-4 rounded-4 d-flex align-items-center justify-content-center"
                                        style="background: rgba(41,89,75,0.3); backdrop-filter: blur(10px); border: 1px solid rgba(139,201,5,0.1); transition: all 0.3s ease; height: 100px;">
                                        <img src="assets/images/partner/partner-logo-4.png" alt="Partner" style="max-width: 120px; max-height: 50px; filter: brightness(0) invert(0.9); opacity: 0.9; transition: all 0.3s ease;">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="partner-logo p-4 rounded-4 d-flex align-items-center justify-content-center"
                                        style="background: rgba(41,89,75,0.3); backdrop-filter: blur(10px); border: 1px solid rgba(139,201,5,0.1); transition: all 0.3s ease; height: 100px;">
                                        <img src="assets/images/partner/partner-logo-5.png" alt="Partner" style="max-width: 120px; max-height: 50px; filter: brightness(0) invert(0.9); opacity: 0.9; transition: all 0.3s ease;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Swiper Navigation (Optional) -->
                        <div class="swiper-pagination position-relative mt-4"></div>
                    </div>

                    <!-- Trust Metrics -->
                    <div class="d-flex justify-content-center gap-5 mt-5 pt-3">
                        <div class="text-center">
                            <div class="fw-bold text-white" style="font-size: 2rem;">$2.4B+</div>
                            <span class="small text-white-50">Transactions Processed</span>
                        </div>
                        <div class="text-center">
                            <div class="fw-bold text-white" style="font-size: 2rem;">150+</div>
                            <span class="small text-white-50">Countries Served</span>
                        </div>
                        <div class="text-center">
                            <div class="fw-bold text-white" style="font-size: 2rem;">99.99%</div>
                            <span class="small text-white-50">Uptime SLA</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Features Area - Premium Redesign -->

        <style>
            /* ============ PREMIUM ANIMATIONS ============ */

            @keyframes pulse {
                0% {
                    opacity: 1;
                    transform: scale(1);
                }

                50% {
                    opacity: 0.8;
                    transform: scale(0.95);
                    box-shadow: 0 0 15px #8BC905;
                }

                100% {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            @keyframes float {
                0% {
                    transform: translateY(0px);
                }

                50% {
                    transform: translateY(-15px);
                }

                100% {
                    transform: translateY(0px);
                }
            }

            @keyframes drift {
                0% {
                    background-position: 0 0;
                }

                100% {
                    background-position: 80px 80px;
                }
            }

            @keyframes shimmer {
                0% {
                    background-position: -100% 0;
                }

                100% {
                    background-position: 200% 0;
                }
            }

            /* Feature Card Hover Effects */
            .feature-card {
                transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
                position: relative;
                overflow: hidden;
            }

            .feature-card:hover {
                transform: translateX(8px) translateY(-4px);
                background: rgba(41, 89, 75, 0.7) !important;
                border-color: rgba(139, 201, 5, 0.3) !important;
                box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.3);
            }

            .feature-card:hover .feature-icon-wrapper {
                transform: scale(1.1);
                background: rgba(139, 201, 5, 0.25) !important;
                border-color: rgba(139, 201, 5, 0.5) !important;
            }

            .feature-icon-wrapper {
                transition: all 0.3s ease;
            }

            /* Image Hover Effect */
            .feature-image-1:hover {
                transform: perspective(1000px) rotateY(-8deg) rotateX(8deg) scale(1.02) !important;
            }

            .hover-float {
                animation: float 6s ease-in-out infinite;
            }

            /* Partner Logo Hover */
            .partner-logo:hover {
                background: rgba(139, 201, 5, 0.15) !important;
                border-color: rgba(139, 201, 5, 0.3) !important;
                transform: translateY(-5px);
                box-shadow: 0 15px 25px -10px rgba(0, 0, 0, 0.2);
            }

            .partner-logo:hover img {
                filter: brightness(0) invert(1) !important;
                opacity: 1 !important;
                transform: scale(1.05);
            }

            .partner-logo img {
                transition: all 0.3s ease;
            }

            /* Button Hover */
            .btn:hover {
                transform: translateY(-3px);
                box-shadow: 0 25px 35px -12px rgba(139, 201, 5, 0.4) !important;
            }

            .btn:hover .bg-white {
                transform: translateX(4px);
            }

            /* Text Utilities */
            .text-white-50 {
                color: rgba(255, 255, 255, 0.6) !important;
            }

            .text-white-80 {
                color: rgba(255, 255, 255, 0.85) !important;
            }

            .backdrop-blur {
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
            }

            /* Container Control */
            .container {
                padding-left: 24px;
                padding-right: 24px;
            }

            @media (min-width: 992px) {
                .container {
                    padding-left: 30px;
                    padding-right: 30px;
                }
            }

            /* Swiper Customization */
            .swiper-pagination-bullet {
                background: rgba(139, 201, 5, 0.3) !important;
                width: 10px;
                height: 10px;
            }

            .swiper-pagination-bullet-active {
                background: #8BC905 !important;
                box-shadow: 0 0 15px #8BC905;
            }

            /* Responsive Adjustments */
            @media (max-width: 768px) {
                .feature-card {
                    padding: 1.5rem !important;
                }

                .feature-icon-wrapper {
                    width: 56px !important;
                    height: 56px !important;
                }

                .feature-icon-wrapper i {
                    font-size: 1.5rem !important;
                }
            }
        </style>

        <!-- Start Services Area -->
        <div class="services-area pt-100 pb-80 pt-md-120 pb-md-100 position-relative overflow-hidden">
            <div class="container left-padding">
                <div class="row align-items-center">
                    <div class="col-xl-4 col-lg-12" data-cues="slideInLeft" data-duration="800">
                        <div class="section-heading position-relative mb-0">
                            <span class="sub-title">OUR SERVICES</span>
                            <h2>Syncing <span><img src="assets/images/svg/lines-2.svg" alt="">Your</span> Finances</h2>
                            <p class="mb-4 mb-md-5">With a robust suite of products ranging from digital banking and payment processing to wealth</p>

                            <a href="{{route('our.services')}}" class="default-btn two">See All Services <i class="ri-arrow-right-up-line"></i></a>

                            <div class="services-btn">
                                <div class="swiper-button-next">
                                    <i class="ri-arrow-right-line"></i>
                                </div>
                                <div class="swiper-button-prev">
                                    <i class="ri-arrow-left-line"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-12">
                        <div class="services-items">
                            <div class="swiper services-slide">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="services-card position-relative">


                                            <img class="radius-30" src="assets/images/copytrading-animated.svg" alt="image">
                                            <img style="z-index: 1500 !important;" class="radius-30" src="assets/images/copytrading-animated.svg" alt="image">
                                            <div class="services-card-body bg-color-fffaeb radius-30">
                                                <i class="flaticon-businessman-5 businessman"></i>
                                                <h3>
                                                    <a href="{{route('our.services')}}">Funds Remittance</a>
                                                </h3>
                                                <p class="mb-0">With a robust suite of products ranging from digital banking and payment processing.</p>
                                                <a href="{{route('our.services')}}" class="read-more">Read More <i class="ri-arrow-right-up-line"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide" style="overflow: hidden;">
                                        <div class="services-card position-relative">
                                            <img class="radius-30" src="assets/images/service/service-image-6.jpg" alt="image">
                                            <div class="services-card-body bg-color-fffaeb radius-30">
                                                <i class="flaticon-browser-1 businessman"></i>
                                                <h3>
                                                    <a href="{{route('our.services')}}">Personal Loan</a>
                                                </h3>
                                                <p class="mb-0">With a robust suite of products ranging from digital banking and payment processing.</p>
                                                <a href="{{route('our.services')}}" class="read-more">Read More <i class="ri-arrow-right-up-line"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Services Area -->

        <!-- Start About Us Area -->
        <div class="about-us-area pb-80 pb-md-120 overflow-hidden">
            <div class="container">
                <div class="about-top mb-4 mb-md-5">
                    <div class="row align-items-center" data-cues="slideInUp" data-duration="800">
                        <div class="col-lg-7 col-md-7">
                            <div class="section-heading mb-0">
                                <span class="sub-title">ABOUT US</span>
                                <h2 class="mb-0">Leveraging Technology <span><img src="assets/images/svg/lines-3.svg" alt="image">For</span> Secure & Banking</h2>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5">
                            <div class="content">
                                <p>By integrating advanced technology with financial expertise we provide a comprehensive suite of services that cater to both individuals and businesses</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="about-info bg-color-edf1ee radius-30">
                    <div class="row g-3 g-md-4">
                        <div class="col-lg-6" data-cues="slideInRight" data-duration="800">
                            <div class="about-content">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="miss-tab" data-bs-toggle="tab" data-bs-target="#miss-tab-pane" type="button" role="tab" aria-controls="miss-tab-pane" aria-selected="true">Our Mission</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="qua-tab" data-bs-toggle="tab" data-bs-target="#qua-tab-pane" type="button" role="tab" aria-controls="qua-tab-pane" aria-selected="false">Our Quality</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="miss-tab-pane" role="tabpanel" aria-labelledby="miss-tab" tabindex="0">
                                        <div class="title">
                                            <h2>Passionate For Your Financial Support Here</h2>
                                            <p class="mb-0">With a robust suite of products ranging from digital banking and payment processing to wealth management and blockchain applications.</p>
                                        </div>

                                        <ul class="check">
                                            <li>
                                                <i class="ri-check-line"></i>
                                                Pay Bills On Time Without Missing A Beat
                                            </li>
                                            <li>
                                                <i class="ri-check-line"></i>
                                                Create And Send Invoices In Seconds
                                            </li>
                                            <li>
                                                <i class="ri-check-line"></i>
                                                Control Your Cash Flow On Demand
                                            </li>
                                        </ul>

                                        <a href="{{route('about.us')}}" class="default-btn mt-4 mt-md-5">More About Us <i class="ri-arrow-right-up-line"></i></a>
                                    </div>
                                    <div class="tab-pane fade" id="qua-tab-pane" role="tabpanel" aria-labelledby="qua-tab" tabindex="0">
                                        <div class="title">
                                            <h2>Financial For Your Passionate Support Here</h2>
                                            <p class="mb-0">With a robust suite of products ranging from digital banking and payment processing to wealth management and blockchain applications.</p>
                                        </div>

                                        <ul class="check">
                                            <li>
                                                <i class="ri-check-line"></i>
                                                Pay Bills On Time Without Missing A Beat
                                            </li>
                                            <li>
                                                <i class="ri-check-line"></i>
                                                Create And Send Invoices In Seconds
                                            </li>
                                            <li>
                                                <i class="ri-check-line"></i>
                                                Control Your Cash Flow On Demand
                                            </li>
                                        </ul>

                                        <a href="{{route('about.us')}}" class="default-btn mt-4 mt-md-5">More About Us <i class="ri-arrow-right-up-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" data-cues="slideInLeft" data-duration="800">
                            <div class="about-image bg-color-ffffff radius-30">
                                <img class="about-image-1" src="assets/images/frontpage-pricing-d.webp" alt="image">



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End About Us Area -->

        <!-- Start Why Choose Us Area -->
        <div class="why-choose-us-area mb-4 mb-md-5 overflow-hidden">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12" data-cues="slideInRight" data-duration="800">
                        <div class="choose-image position-relative">
                            <img class="radius-30" src="assets/images/about/about-image-2.jpg" alt="image">
                            <div class="paly-content">
                                <a data-fslightbox="one" href="https://www.youtube.com/watch?v=Y7cpCDlRfV0" class="popup-btn">
                                    <i class="flaticon-play-buttton"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12" data-cues="slideInLeft" data-duration="800">
                        <div class="why-choose-us-content">
                            <div class="section-heading mb-0">
                                <span class="sub-title">WHY CHOOSE US</span>
                                <h2>Grow Your <span><img src="assets/images/svg/lines-1.svg" alt="image">Transaction</span> From Another Level</h2>
                                <p class="mb-4 mb-md-5">With a robust suite of products ranging from digital banking and payment processing to wealth management and blockchain applications we empower our clients.</p>
                                <a href="{{ route('about.us') }}" class="default-btn two">Learn More <i class="ri-arrow-right-up-line"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Why Choose Us Area -->

        <!-- Start Choose Card Area -->
        <div class="choose-card-area pb-80 pb-md-120 mb-5">
            <div class="container">
                <div class="row g-3 g-md-4 justify-content-center" data-cues="slideInUp" data-duration="800">
                    <div class="col-lg-4 col-md-6">
                        <div class="choose-card bg-color-fffaeb radius-30">
                            <i class="flaticon-money-5"></i>
                            <h3>Global Payments</h3>
                            <p>With a robust suite of products ranging from digital banking and payment processing.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="choose-card bg-color-fffaeb radius-30">
                            <i class="flaticon-dollar-symbol-1"></i>
                            <h3>Revenue & Finance</h3>
                            <p>With a robust suite of products ranging from digital banking and payment processing.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="choose-card bg-color-fffaeb radius-30">
                            <i class="flaticon-tablet"></i>
                            <h3>Bank As A Service</h3>
                            <p>With a robust suite of products ranging from digital banking and payment processing.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Choose Card Area -->

        <!-- Start How It Works Area -->
        <div class="how-it-works-area bg-color-0c3a30 pt-100 pb-120 pt-md-120  -pb-md-100">
            <div class="container">
                <div class="about-top mb-4 mb-md-5">
                    <div class="row align-items-center">
                        <div class="col-lg-7 col-md-7" data-cues="slideInRight" data-duration="800">
                            <div class="section-heading mb-0">
                                <span class="sub-title text-white">HOW IT WORKS</span>
                                <h2 class="text-white mb-0">Commitment To <span><img src="assets/images/svg/lines-1.svg" alt="image">Exceptional</span> Services And Solutions</h2>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5" data-cues="slideInLeft" data-duration="800">
                            <div class="content">
                                <p class="text-white">By integrating advanced technology with financial expertise we provide a comprehensive suite of services that cater to both individuals and businesses</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-xl-4 col-lg-12">
                        <div class="works-btn">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="crea-tab" data-bs-toggle="tab" data-bs-target="#crea-tab-pane" type="button" role="tab" aria-controls="crea-tab-pane" aria-selected="true">Create Account <i class="ri-arrow-right-up-line"></i></button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="use-tab" data-bs-toggle="tab" data-bs-target="#use-tab-pane" type="button" role="tab" aria-controls="use-tab-pane" aria-selected="false">User Confirmation <i class="ri-arrow-right-up-line"></i></button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-12">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="crea-tab-pane" role="tabpanel" aria-labelledby="crea-tab" tabindex="0">
                                <div class="row g-3 g-md-4" data-cues="slideInUp" data-duration="800">
                                    <div class="col-lg-6">
                                        <div class="single-works-image">
                                            <img class="radius-30" src="assets/images/about/about-image-3.jpg" alt="image">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-works-card bg-color-29594b radius-30">
                                            <i class="flaticon-payment-method-1 method"></i>
                                            <h3 class="text-white">Create Account</h3>
                                            <p class="text-white">With a robust suite of products ranging from digital banking and payment processing to wealth management and blockchain applications we empower our clients to navigate the complexities of the financial world with ease confidence</p>
                                            <a href="/" class="default-btn two">Get Started <i class="ri-arrow-right-up-line"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="use-tab-pane" role="tabpanel" aria-labelledby="use-tab" tabindex="0">
                                <div class="row g-3 g-md-4" data-cues="slideInUp" data-duration="800">
                                    <div class="col-lg-6">
                                        <div class="single-works-image">
                                            <img class="radius-30" src="assets/images/about/about-image-10.jpg" alt="image">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-works-card bg-color-29594b radius-30">
                                            <i class="flaticon-tablet method"></i>
                                            <h3 class="text-white">User Confirmation</h3>
                                            <p class="text-white">With a robust suite of products ranging from digital banking and payment processing to wealth management and blockchain applications we empower our clients to navigate the complexities of the financial world with ease confidence</p>
                                            <a href="/" class="default-btn two">Get Started <i class="ri-arrow-right-up-line"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End How It Works Area -->



        <!-- Start Testimonials Area -->
        <div class="testimonials-area pt-100 pb-80 pt-md-120 pb-md-100">
            <div class="container">
                <div class="about-top mb-4 mb-md-5">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-7" data-cues="slideInRight" data-duration="800">
                            <div class="section-heading mb-0">
                                <span class="sub-title">TESTIMONIALS</span>
                                <h2 class="mb-0">Hear What Our <span><img src="assets/images/svg/lines-1.svg" alt="image">Clients</span> Say About Us</h2>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-5" data-cues="slideInLeft" data-duration="800">
                            <div class="content">
                                <p>By integrating advanced technology with financial expertise we provide a comprehensive suite of services that cater to both individuals and businesses</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" data-cues="slideInUp" data-duration="800">
                    <div class="col-lg-6 col-md-12">
                        <div class="testimonials-image bg-color-9edd05 radius-30 position-relative">
                            <img class="about-image-2" src="assets/images/frontpage-pricing-d.webp" alt="image">
                            <img class="feature-shape-1 rotate" src="assets/images/shape/feature-shape-1.png" alt="image">
                            <img class="feature-shape-2 rotate" src="assets/images/shape/feature-shape-1.png" alt="image">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="testimonials-content">
                            <div class="testimonials-card bg-color-fffaeb radius-30 mb-3 mb-md-4">
                                <ul>
                                    <li>
                                        <i class="flaticon-star-2"></i>
                                        <i class="flaticon-star-2"></i>
                                        <i class="flaticon-star-2"></i>
                                        <i class="flaticon-star-2"></i>
                                        <i class="flaticon-star-2"></i>
                                    </li>
                                </ul>
                                <p>“We are at the forefront of revolutionizing the financial landscape through cutting MarketMind solutions Our mission is to bridge the gap between traditional banking and modern technology, offering innovative and seamless financial services that cater to the evolving needs of individuals.”</p>

                                <div class="flex-warp d-flex align-items-center justify-content-between">
                                    <div class="d-flex gap-3 gap-md-4 align-items-center">
                                        <img class="user-image-4 rounded-circle" src="assets/images/user/user-image-4.jpg" alt="image">
                                        <div>
                                            <h3>Our Discord Community Name</h3>
                                            <span>CEO & Founder Of Our Community And On Discord Channels</span>
                                        </div>
                                    </div>
                                    <img class="right-quote" src="assets/images/svg/right-quote.svg" alt="image">
                                </div>
                            </div>

                            <div class="testimonials-card bg-color-fffaeb radius-30">
                                <ul>
                                    <li>
                                        <i class="flaticon-star-2"></i>
                                        <i class="flaticon-star-2"></i>
                                        <i class="flaticon-star-2"></i>
                                        <i class="flaticon-star-2"></i>
                                        <i class="flaticon-star-2"></i>
                                    </li>
                                </ul>
                                <p>“We are at the forefront of revolutionizing the financial landscape through cutting MarketMind solutions Our mission is to bridge the gap between traditional banking and modern technology, offering innovative and seamless financial services that cater to the evolving needs of individuals.”</p>

                                <div class="flex-warp d-flex align-items-center justify-content-between">
                                    <div class="d-flex gap-3 gap-md-4 align-items-center">
                                        <img class="user-image-4 rounded-circle" src="assets/images/user/user-image-5.jpg" alt="image">
                                        <div>
                                            <h3>Kevin M. Rueda</h3>
                                            <span>Investor</span>
                                        </div>
                                    </div>
                                    <img class="right-quote" src="assets/images/svg/right-quote.svg" alt="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Testimonials Area -->

        <!-- Start Blog Area -->
        <div class="blog-area pb-80 pb-md-120 ">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title pt-100">LATEST BLOG</span>
                    <h2>Smart Tools For <span><img src="assets/images/svg/lines-1.svg" alt="image">Creative</span> Financial Planning</h2>
                </div>
                <div class="row g-3 g-md-4" data-cues="slideInUp" data-duration="800">
                    <div class="col-xl-6 col-lg-12 col-md-12">
                        <div class="blog-card bg-color-edf1ee radius-30 mb-3 mb-md-4">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-md-5">
                                    <div class="blog-image">
                                        <a href="/" class="d-block">
                                            <img src="assets/images/blog/blog-image-1.jpg" class="blog-image-1" alt="image">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7">
                                    <div class="blog-card-body">
                                        <ul>
                                            <li><i class="ri-calendar-2-line"></i> {{ \Carbon\Carbon::now()->format('M d, Y') }}</li>

                                            <li><i class="ri-message-line"></i> No Comment</li>
                                        </ul>
                                        <h3>
                                            <a href="/">How To Easily Understand Your Insurance Contract</a>
                                        </h3>
                                        <p>With a robust suite of products ranging from digital banking and payment processing.</p>
                                        <a href="/" class="read-more">Read More <i class="ri-arrow-right-up-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="blog-card bg-color-edf1ee radius-30">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-md-5">
                                    <div class="blog-image">
                                        <a href="/" class="d-block">
                                            <img src="assets/images/blog/blog-image-2.jpg" class="blog-image-1" alt="image">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7">
                                    <div class="blog-card-body">
                                        <ul>
                                            <li><i class="ri-calendar-2-line"></i> {{ \Carbon\Carbon::now()->format('M d, Y') }}</li>

                                            <li><i class="ri-message-line"></i> No Comment</li>
                                        </ul>
                                        <h3>
                                            <a href="/">The Basics Of Financial Responsibility</a>
                                        </h3>
                                        <p>With a robust suite of products ranging from digital banking and payment processing.</p>
                                        <a href="/" class="read-more">Read More <i class="ri-arrow-right-up-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12 col-md-12">
                        <div class="single-blog bg-color-edf1ee radius-30">
                            <a href="/" class="d-block">
                                <img src="assets/images/blog/blog-image-3.jpg" class="blog-image-3" alt="image">
                            </a>
                            <div class="single-blog-card-body">
                                <ul>
                                    <li><i class="ri-calendar-2-line"></i> {{ \Carbon\Carbon::now()->format('M d, Y') }}</li>

                                    <li><i class="ri-message-line"></i> No Comment</li>
                                </ul>
                                <h3>
                                    <a href="/">Effective Financial Management Crucial For Most Organizations</a>
                                </h3>
                                <p>We are at the forefront of revolutionizing the financial landscape through cutting solutions Our mission is to bridge the gap between traditional banking.</p>
                                <a href="/" class="read-more">Read More <i class="ri-arrow-right-up-line"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Blog Area -->

        <!-- Start Faq Area -->
        <div class="faq-area pb-80 pb-md-120 overflow-hidden mt-5 mb-5">
            <div class="container">
                <div class="row g-3 g-md-4 align-items-center">
                    <div class="col-lg-6 col-md-12" data-cues="slideInRight" data-duration="800">
                        <div class="question-card bg-color-9edd05 radius-30">
                            <div class="section-heading">
                                <span class="sub-title">FAQ</span>
                                <h2>Frequently <span><img src="assets/images/svg/lines-4.svg" alt="image">Asked</span> Questions</h2>
                                <p>With a robust suite of products ranging from digital banking and payment processing to wealth management and blockchain applications.</p>
                            </div>
                            <img class="radius-30" src="assets/images/blog/blog-image-4.jpg" alt="image">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12" data-cues="slideInLeft" data-duration="800">
                        <div class="faq-content">
                            <div class="accordion" id="accordionFAQ">
                                <div class="accordion-item">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBang" aria-expanded="false" aria-controls="collapseBang">
                                        1. Why should I care about financial planning?
                                    </button>
                                    <div id="collapseBang" class="accordion-collapse collapse show" data-bs-parent="#accordionFAQ">
                                        <div class="accordion-body">
                                            <p>Our mission is to bridge the gap between traditional banking and modern offering innovative and seamless financial services that cater to the evolving needs of individuals and businesses alike. With a robust suite.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSunam" aria-expanded="false" aria-controls="collapseSunam">
                                        2. What are the different types of investments?
                                    </button>
                                    <div id="collapseSunam" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                                        <div class="accordion-body">
                                            <p> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Faq Area -->

        <!-- Start App Area -->
        <div class="app-area pb-80 pb-md-120 overflow-hidden">
            <div class="container">
                <div class="download-area bg-color-edf1ee radius-30">
                    <div class="row g-3 g-md-4 align-items-center">
                        <div class="col-lg-6 col-md-12" data-cues="slideInRight" data-duration="800">
                            <div class="section-heading mb-0">
                                <span class="sub-title">DOWNLOAD OUR APP</span>
                                <h2>Experience <span><img src="assets/images/svg/lines-1.svg" alt="image">The</span> Future Of Banking</h2>
                                <p class="mb-4 mb-md-5">With a robust suite of products ranging from digital banking and payment processing to wealth management and blockchain applications.</p>

                                <div class="app-btn">
                                    <a href="https://play.google.com/store/apps/category/FAMILY?hl=en" target="_blank" class="me-2 me-md-3">
                                        <img class="rounded-3" src="assets/images/app/app-image-2.jpg" alt="image">
                                    </a>
                                    <a href="https://www.apple.com/app-store/" target="_blank">
                                        <img class="rounded-3" src="assets/images/app/app-image-3.jpg" alt="image">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12" data-cues="slideInLeft" data-duration="800">
                            <div class="app-image">
                                <img class="radius-30" src="assets/images/app/app-image-1.jpg" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End App Area -->
    </div>
    @endsection