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
                            Secure
                            <span style="color: #8BC905; font-size:2rem;">
                                <img style="width: 100px; height:auto;" src="{{ asset('assets/images/svg/your.svg') }} " alt="icon"> Your
                            </span>
                            Financial Future with Intelligent Investing
                        </h1>
                        <a href="{{ route('signup') }}" class="btn btn-primary btn-lg px-3 py-2 rounded-pill shadow-lg glow-effect mt-3">
                            <i class="fas fa-rocket me-2"></i> Launch Dashboard
                        </a>
                    </div>
                </div>

                <div class="col-xl-7 col-lg-12" data-cues="slideInLeft" data-duration="800">
                    <div class="info text-white">
                        <p class="mb-4">
                            We are at the forefront of revolutionizing the financial landscape through cutting-edge MarketMind solutions.
                        </p>

                        <div class="row align-items-center g-3 g-md-3">
                            <div class="col-lg-5 col-md-5">

                                <ul class="user bg-color-ffffff radius" style="padding: 6px 10px; font-size: 0.85rem; transform: scale(0.85); display: inline-flex;">

                                    <li><img class="rounded-circle" src="{{ asset('assets/images/user/user-image-2.jpg') }}" alt="user"></li>
                                    <li><img class="rounded-circle" src="{{ asset('assets/images/user/user-image-3.jpg') }}" alt="user"></li>
                                    <li><img class="rounded-circle" src="{{ asset('assets/images/user/user-image-1.jpg') }}" alt="user"></li>
                                    <li>32k+</li>
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
                                <span class="text-primary">MarketMind</span> AI <span class="text-highlight">Convergence</span> Platform
                            </h1>
                            <p class="lead text-white-80 mb-4" style="color: white !important;">
                                Next-gen algorithmic trading across crypto, forest assets, and real estate markets with deep learning execution.
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

            <div class="card-area">
                <div class="container-fluid side-padding">
                    <div class="row g-3 g-md-4 justify-content-center" data-cues="slideInUp" data-duration="800">
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="banner-card bg-color-ffffff radius-30">
                                <div class="flex-warp position-relative">
                                    <i>
                                        <img src="assets/images/svg/grow.svg" alt="image">
                                    </i>
                                    <h3>Create A Card That Is Unique And Customized</h3>
                                </div>
                                <div class="banner-card-body bg-color-def1ee">
                                    <img src="assets/images/service/service-image-1.png" alt="image">
                                </div>
                            </div>

                            <!-- Advice Area Start -->
                            <div class="advice-area bg-color-ffffff radius-20 mt-3">
                                <div class="container-fluid">
                                    <div class="advice-content">
                                        <ul>
                                            <li>Revenue</li>
                                            <li>Investment</li>
                                            <li>Deposit</li>
                                            <li>Earnings</li>
                                            <li>Transaction</li>
                                            <li>Revenue</li>
                                            <li>Investment</li>
                                            <li>Deposit</li>
                                            <li>Earnings</li>
                                            <li>Transaction</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="banner-card part-two bg-color-9edd05 radius-30 position-relative">
                                <div class="flex-warp position-relative">
                                    <i>
                                        <img src="assets/images/svg/corporation.svg" alt="image">
                                    </i>
                                    <h3>Transfers Across The Globe Are Free</h3>
                                </div>
                                <p class="mb-0">Our digital solutions transform money management investing and transaction.</p>
                                <div class="banner-card-image">
                                    <div class="text-end">
                                        <img src="assets/images/service/service-image-2.png" alt="image">
                                    </div>
                                </div>

                                <div class="total bg-color-ffffff radius">
                                    <h4>Total Balance</h4>
                                    <h5>$59,647.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="banner-card part-three bg-color-ffffff radius-30 position-relative">
                                <div class="flex-warp position-relative">
                                    <i>
                                        <img src="assets/images/svg/euro.svg" alt="image">
                                    </i>
                                    <h3>Personalized Insights And Financial Goals</h3>
                                </div>
                                <div class="banner-image-body">
                                    <div class="text-end">
                                        <img class="service-image-3" src="assets/images/service/service-image-3.png" alt="image">
                                    </div>
                                    <img class="service-image-4" src="assets/images/service/service-image-4.png" alt="image">
                                </div>
                                <i class="flaticon-star-5 star-5 moveHorizontal_reverse"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <!-- Start Pricing Plan Area -->
        <div class="pricing-plan-area pt-100 pb-80 mb-5 pt-md-120 pb-md-100 bg-color-def1ee" style="background-image: url(assets/images/hero/hero-image-1.svg)">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">PRICING PLAN</span>
                    <h2>Choose The Best <span><img src="assets/images/svg/lines-2.svg" alt="image">Plans</span> Which For You</h2>
                </div>
                <div class="row g-3 g-md-4 justify-content-center" data-cues="slideInUp" data-duration="800">
                    @foreach($plans->take(3) as $plan)
                    <div class="col-lg-4 col-md-6">
                        <div class="pricing-card bg-color-ffffff radius-30">
                            <div class="title position-relative">
                                <h3>{{ $plan->name }} </h3>
                                <h4>{{ rtrim(rtrim($plan->interest_rate, '0'), '.') }}% / <span>Per Term</span></h4>
                                <img class="about-image-2" src="assets/images/about/about-image-2.png" alt="image">
                            </div>
                            <div class="pricing-card-body">
                                <ul class="check">
                                    <li><i class="ri-check-line"></i> Duration: {{ $plan->duration }} Days</li>
                                    <li><i class="ri-check-line"></i> Percentage: {{ rtrim(rtrim($plan->interest_rate, '0'), '.') }}%</li>
                                    <li class="flex items-start gap-3">
                                        <span class="check-icon"><i class="ri-check-line"></i></span>
                                        <span><strong>Earnings:</strong> {{ $plan->duration < 28 ? 'Daily' : 'Weekly' }}</span>
                                    </li>
                                    <li><i class="ri-check-line"></i> Minimum Deposit: ${{ number_format($plan->minimum_amount) }}</li>
                                    <li><i class="ri-check-line"></i> Maximum Deposit: ${{ number_format($plan->maximum_amount) }}</li>
                                </ul>
                                <a href="/login" class="default-btn two w-100 text-center">Get Started <i class="ri-arrow-right-up-line"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="text-center mt-4">
                        <a href="{{route('plans.header')}}" class="default-btn bg-[#8bc905] text-white px-5 py-3 rounded-xl">🔍 View All Plans</a>
                    </div>
                </div>

            </div>
        </div>
        <!-- End Pricing Plan Area -->
        <!-- End Main Banner Area -->

        <!-- Start Features Area -->
        <div class="features-area bg-color-0c3a30 pt-100 pb-80 pt-md-120 pb-md-100 overflow-hidden">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-12" data-cues="slideInRight" data-duration="800">
                        <div class="features-image bg-color-9edd05 radius-30 position-relative">
                            <img class="feature-image-1" src="assets/images/feature/feature-image-1.png" alt="image">
                            <img class="feature-image-2 bounce" src="assets/images/feature/feature-image-2.png" alt="image">
                            <img class="feature-shape-1 moveVertical" src="assets/images/shape/feature-shape-1.png" alt="image">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12" data-cues="slideInLeft" data-duration="800">
                        <div class="features-content">
                            <div class="section-heading">
                                <span class="sub-title">TOP FEATURES</span>
                                <h2 class="text-white">Let's Take Your <span><img src="assets/images/svg/lines-1.svg" alt="image">Analytics</span> To The Next Level</h2>
                                <p class="text-white">With a robust suite of products ranging from digital banking and payment processing to wealth management and blockchain applications we empower our clients.</p>
                            </div>

                            <ul>
                                <li class="bg-color-29594b radius-20">
                                    <i class="flaticon-businessman-1"></i>
                                    <h3 class="text-white">Local Business Finance</h3>
                                    <p class="text-white">Our commitment to security transparency and customer centricity ensures that every transaction is no.</p>
                                </li>
                                <li class="bg-color-29594b radius-20">
                                    <i class="flaticon-payment-method"></i>
                                    <h3 class="text-white">Built For Global Payments</h3>
                                    <p class="text-white">Our commitment to security transparency and customer centricity ensures that every transaction is no.</p>
                                </li>
                                <li class="bg-color-29594b radius-20">
                                    <i class="flaticon-laptop-2"></i>
                                    <h3 class="text-white">Make Internet Of Money</h3>
                                    <p class="text-white">Our commitment to security transparency and customer centricity ensures that every transaction is no.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="partner-area mt-5 pt-80 pt-md-120">
                <div class="container">
                    <div class="title">
                        <p>TRUSTED BY INDUSTRY LEADING COMPANIES AROUND THE GLOBE</p>
                    </div>
                    <div class="partner-items">
                        <div class="swiper partner-slide">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="partner-logo">
                                        <img src="assets/images/partner/partner-logo-1.png" alt="image">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="partner-logo">
                                        <img src="assets/images/partner/partner-logo-2.png" alt="image">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="partner-logo">
                                        <img src="assets/images/partner/partner-logo-3.png" alt="image">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="partner-logo">
                                        <img src="assets/images/partner/partner-logo-4.png" alt="image">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="partner-logo">
                                        <img src="assets/images/partner/partner-logo-5.png" alt="image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Features Area -->

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