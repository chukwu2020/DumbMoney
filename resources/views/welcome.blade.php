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

        <video autoplay muted loop playsinline class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" style="z-index: 0;" poster="https://www.marketmindinvestments.com/assets/images/Hero-Video-thumbnail.jpg">
            <source src="https://www.marketmindinvestments.com/assets/images/Hero-Video.mp4" type="video/mp4">
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
                Learn smart trading techniques, track real-time market trends, and grow your knowledge with our educational platform.
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
                                        <li>From over 1000+ reviews </li>
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

        <!-- Start Services Area - Premium Redesign -->
        <div class="services-area py-5 py-md-6 position-relative overflow-hidden"
            style="background: linear-gradient(145deg, #ffffff, #f8fafc);">

            <!-- Premium Decorative Elements -->
            <div class="position-absolute" style="top: -150px; left: -100px; width: 500px; height: 500px; border-radius: 50%; background: radial-gradient(circle, rgba(139,201,5,0.03) 0%, transparent 70%); pointer-events: none;"></div>
            <div class="position-absolute" style="bottom: -100px; right: -50px; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(12,58,48,0.02) 0%, transparent 70%); pointer-events: none;"></div>

            <!-- Subtle Pattern Overlay -->
            <div class="position-absolute w-100 h-100 opacity-2"
                style="top: 0; left: 0; background-image: radial-gradient(circle at 30px 30px, #0C3A30 1px, transparent 1px); background-size: 60px 60px; pointer-events: none;"></div>

            <div class="container position-relative" style="max-width: 1280px; margin: 0 auto; z-index: 5;">
                <div class="row g-5 align-items-center">

                    <!-- ========================================= -->
                    <!-- LEFT COLUMN - SECTION HEADER & CONTROLS -->
                    <!-- ========================================= -->
                    <div class="col-xl-4 col-lg-12" data-cues="slideInLeft" data-duration="800">
                        <div class="section-heading position-relative mb-0 pe-xl-4">

                            <!-- Premium Badge -->
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <span class="badge px-4 py-2 rounded-pill fw-semibold d-inline-flex align-items-center gap-2"
                                    style="background: linear-gradient(145deg, #0C3A30, #0A2A23); color: white; border: 1px solid rgba(139,201,5,0.3); letter-spacing: 0.5px; box-shadow: 0 10px 20px -8px rgba(10,42,35,0.2);">
                                    <span style="display: inline-block; width: 8px; height: 8px; background: #8BC905; border-radius: 50%; box-shadow: 0 0 8px #8BC905; animation: pulse 2s infinite;"></span>
                                    OUR SERVICES
                                </span>
                                <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2);">
                                    ✦ 8+ SOLUTIONS
                                </span>
                            </div>

                            <!-- Main Headline -->
                            <h2 class="display-5 fw-bold mb-3" style="color: #0C3A30; line-height: 1.2; max-width: 400px;">
                                Syncing
                                <span style="color: #8BC905; position: relative; display: inline-block;">
                                    Your Finances
                                    <span class="position-absolute start-0 w-100" style="bottom: 0.1em; height: 8px; background: rgba(139,201,5,0.25); border-radius: 30px; z-index: -1;"></span>
                                </span>
                            </h2>

                            <!-- Description -->
                            <p class="fs-6 text-secondary mb-4" style="color: #4A5C5A !important; line-height: 1.7; max-width: 350px;">
                                Seamlessly connect your entire financial world from payments and lending to wealth management all in one intelligent platform.
                            </p>

                            <!-- CTA Button -->
                            <a href="{{route('our.services')}}" class="btn btn-lg px-5 py-3 rounded-pill fw-bold d-inline-flex align-items-center gap-3 mb-4 mb-md-5"
                                style="background: linear-gradient(145deg, #0C3A30, #0A2A23); color: white; border: none; box-shadow: 0 20px 30px -10px rgba(12,58,48,0.25); transition: all 0.3s;">
                                <span>Explore All Services</span>
                                <span class="rounded-circle bg-white/20 p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                    <i class="ri-arrow-right-up-line" style="color: white; font-size: 1.2rem;"></i>
                                </span>
                            </a>

                            <!-- Premium Navigation Controls -->
                            <div class="services-btn d-flex align-items-center gap-3 mt-2">
                                <span class="text-secondary small fw-semibold me-2" style="color: #4A5C5A !important;">SWIPE</span>
                                <div class="swiper-button-prev-custom d-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 56px; height: 56px; background: white; border: 2px solid rgba(139,201,5,0.2); color: #0C3A30; box-shadow: 0 10px 20px -8px rgba(0,0,0,0.05); transition: all 0.3s; cursor: pointer;">
                                    <i class="ri-arrow-left-line fs-4"></i>
                                </div>
                                <div class="swiper-button-next-custom d-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 56px; height: 56px; background: #8BC905; border: none; color: white; box-shadow: 0 15px 25px -8px rgba(139,201,5,0.3); transition: all 0.3s; cursor: pointer;">
                                    <i class="ri-arrow-right-line fs-4"></i>
                                </div>
                            </div>

                            <!-- Slide Counter -->
                            <div class="d-flex align-items-center gap-2 mt-4">
                                <span class="fw-bold" style="color: #0C3A30; font-size: 1.2rem;" id="current-slide">01</span>
                                <span style="color: #8BC905; font-size: 0.9rem;">/</span>
                                <span style="color: #4A5C5A;" id="total-slides">06</span>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================= -->
                    <!-- RIGHT COLUMN - PREMIUM SERVICE CARDS SLIDER -->
                    <!-- ========================================= -->
                    <div class="col-xl-8 col-lg-12" data-cues="slideInRight" data-duration="800">
                        <div class="services-items position-relative ps-xl-4">

                            <!-- Gradient Edge Overlays -->
                            <div class="position-absolute top-0 start-0 h-100" style="width: 60px; background: linear-gradient(90deg, #ffffff, transparent); z-index: 20; pointer-events: none;"></div>
                            <div class="position-absolute top-0 end-0 h-100" style="width: 60px; background: linear-gradient(-90deg, #f8fafc, transparent); z-index: 20; pointer-events: none;"></div>

                            <div class="swiper services-slide-premium">
                                <div class="swiper-wrapper">

                                    <!-- SERVICE CARD 1 - Funds Remittance -->
                                    <div class="swiper-slide">
                                        <div class="service-card-premium position-relative"
                                            style="border-radius: 32px; background: white; box-shadow: 0 25px 40px -15px rgba(0,0,0,0.08); transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); overflow: hidden;">

                                            <!-- Top Accent -->
                                            <div style="height: 4px; background: linear-gradient(90deg, #8BC905, #0C3A30);"></div>

                                            <!-- Card Content -->
                                            <div class="p-4 p-xl-5">
                                                <!-- Icon & Badge -->
                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <div class="d-flex align-items-center justify-content-center rounded-3"
                                                        style="width: 72px; height: 72px; background: rgba(139,201,5,0.1);">
                                                        <i class="flaticon-businessman-5" style="color: #8BC905; font-size: 2.5rem;"></i>
                                                    </div>
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.08); color: #0C3A30; border: 1px solid rgba(139,201,5,0.2);">
                                                        ⚡ FAST
                                                    </span>
                                                </div>

                                                <!-- Title -->
                                                <h3 class="fw-bold mb-3" style="color: #0C3A30; font-size: 1.75rem;">
                                                    <a href="{{route('our.services')}}" class="text-decoration-none" style="color: #0C3A30;">Funds Remittance</a>
                                                </h3>

                                                <!-- Description -->
                                                <p class="text-secondary mb-4" style="color: #4A5C5A !important; line-height: 1.7;">
                                                    Send and receive money across borders instantly with zero hidden fees and real-time exchange rates.
                                                </p>

                                                <!-- Feature Pills -->
                                                <div class="d-flex flex-wrap gap-2 mb-4">
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">🌍 150+ Countries</span>
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">⚡ Instant Settlement</span>
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">🔒 Bank-Grade</span>
                                                </div>

                                                <!-- Read More Link -->
                                                <a href="{{route('our.services')}}" class="read-more d-inline-flex align-items-center gap-2 fw-semibold text-decoration-none"
                                                    style="color: #8BC905; transition: all 0.3s;">
                                                    Learn more
                                                    <span class="rounded-circle d-flex align-items-center justify-content-center"
                                                        style="width: 28px; height: 28px; background: rgba(139,201,5,0.1); color: #8BC905; transition: all 0.3s;">
                                                        <i class="ri-arrow-right-up-line"></i>
                                                    </span>
                                                </a>
                                            </div>

                                            <!-- Decorative Element -->
                                            <div class="position-absolute bottom-0 end-0" style="width: 120px; height: 120px; background: radial-gradient(circle, rgba(139,201,5,0.05) 0%, transparent 70%); border-radius: 50%;"></div>
                                        </div>
                                    </div>

                                    <!-- SERVICE CARD 2 - Personal Loan -->
                                    <div class="swiper-slide">
                                        <div class="service-card-premium position-relative"
                                            style="border-radius: 32px; background: white; box-shadow: 0 25px 40px -15px rgba(0,0,0,0.08); transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); overflow: hidden;">

                                            <!-- Top Accent -->
                                            <div style="height: 4px; background: linear-gradient(90deg, #0C3A30, #8BC905);"></div>

                                            <!-- Card Content -->
                                            <div class="p-4 p-xl-5">
                                                <!-- Icon & Badge -->
                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <div class="d-flex align-items-center justify-content-center rounded-3"
                                                        style="width: 72px; height: 72px; background: rgba(139,201,5,0.1);">
                                                        <i class="flaticon-browser-1" style="color: #8BC905; font-size: 2.5rem;"></i>
                                                    </div>
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.08); color: #0C3A30; border: 1px solid rgba(139,201,5,0.2);">
                                                        🏆 POPULAR
                                                    </span>
                                                </div>

                                                <!-- Title -->
                                                <h3 class="fw-bold mb-3" style="color: #0C3A30; font-size: 1.75rem;">
                                                    <a href="{{route('our.services')}}" class="text-decoration-none" style="color: #0C3A30;">Personal Loan</a>
                                                </h3>

                                                <!-- Description -->
                                                <p class="text-secondary mb-4" style="color: #4A5C5A !important; line-height: 1.7;">
                                                    Flexible financing tailored to your needs. Competitive rates, instant approval, and no prepayment penalties.
                                                </p>

                                                <!-- Feature Pills -->
                                                <div class="d-flex flex-wrap gap-2 mb-4">
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">💰 Up to $100K</span>
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">⚡ 5-min Approval</span>
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">📆 Flexible Terms</span>
                                                </div>

                                                <!-- Read More Link -->
                                                <a href="{{route('our.services')}}" class="read-more d-inline-flex align-items-center gap-2 fw-semibold text-decoration-none"
                                                    style="color: #8BC905; transition: all 0.3s;">
                                                    Learn more
                                                    <span class="rounded-circle d-flex align-items-center justify-content-center"
                                                        style="width: 28px; height: 28px; background: rgba(139,201,5,0.1); color: #8BC905; transition: all 0.3s;">
                                                        <i class="ri-arrow-right-up-line"></i>
                                                    </span>
                                                </a>
                                            </div>

                                            <!-- Decorative Element -->
                                            <div class="position-absolute bottom-0 end-0" style="width: 120px; height: 120px; background: radial-gradient(circle, rgba(139,201,5,0.05) 0%, transparent 70%); border-radius: 50%;"></div>
                                        </div>
                                    </div>

                                    <!-- SERVICE CARD 3 - Wealth Management -->
                                    <div class="swiper-slide">
                                        <div class="service-card-premium position-relative"
                                            style="border-radius: 32px; background: white; box-shadow: 0 25px 40px -15px rgba(0,0,0,0.08); transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); overflow: hidden;">

                                            <!-- Top Accent -->
                                            <div style="height: 4px; background: linear-gradient(90deg, #8BC905, #0C3A30);"></div>

                                            <!-- Card Content -->
                                            <div class="p-4 p-xl-5">
                                                <!-- Icon & Badge -->
                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <div class="d-flex align-items-center justify-content-center rounded-3"
                                                        style="width: 72px; height: 72px; background: rgba(139,201,5,0.1);">
                                                        <i class="flaticon-growth" style="color: #8BC905; font-size: 2.5rem;"></i>
                                                    </div>
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.08); color: #0C3A30; border: 1px solid rgba(139,201,5,0.2);">
                                                        💎 PREMIUM
                                                    </span>
                                                </div>

                                                <!-- Title -->
                                                <h3 class="fw-bold mb-3" style="color: #0C3A30; font-size: 1.75rem;">
                                                    <a href="{{route('our.services')}}" class="text-decoration-none" style="color: #0C3A30;">Trading Management</a>
                                                </h3>

                                                <!-- Description -->
                                                <p class="text-secondary mb-4" style="color: #4A5C5A !important; line-height: 1.7;">
                                                    AI-powered investment strategies personalized to your goals. Grow your wealth with institutional-grade tools.
                                                </p>

                                                <!-- Feature Pills -->
                                                <div class="d-flex flex-wrap gap-2 mb-4">
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">🤖 AI-Powered</span>
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">📊 127% APY</span>
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">🔐 Secure</span>
                                                </div>

                                                <!-- Read More Link -->
                                                <a href="{{route('our.services')}}" class="read-more d-inline-flex align-items-center gap-2 fw-semibold text-decoration-none"
                                                    style="color: #8BC905; transition: all 0.3s;">
                                                    Learn more
                                                    <span class="rounded-circle d-flex align-items-center justify-content-center"
                                                        style="width: 28px; height: 28px; background: rgba(139,201,5,0.1); color: #8BC905; transition: all 0.3s;">
                                                        <i class="ri-arrow-right-up-line"></i>
                                                    </span>
                                                </a>
                                            </div>

                                            <!-- Decorative Element -->
                                            <div class="position-absolute bottom-0 end-0" style="width: 120px; height: 120px; background: radial-gradient(circle, rgba(139,201,5,0.05) 0%, transparent 70%); border-radius: 50%;"></div>
                                        </div>
                                    </div>

                                    <!-- SERVICE CARD 4 - Business Banking -->
                                    <div class="swiper-slide">
                                        <div class="service-card-premium position-relative"
                                            style="border-radius: 32px; background: white; box-shadow: 0 25px 40px -15px rgba(0,0,0,0.08); transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); overflow: hidden;">

                                            <!-- Top Accent -->
                                            <div style="height: 4px; background: linear-gradient(90deg, #0C3A30, #8BC905);"></div>

                                            <!-- Card Content -->
                                            <div class="p-4 p-xl-5">
                                                <!-- Icon & Badge -->
                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <div class="d-flex align-items-center justify-content-center rounded-3"
                                                        style="width: 72px; height: 72px; background: rgba(139,201,5,0.1);">
                                                        <i class="flaticon-businessman-1" style="color: #8BC905; font-size: 2.5rem;"></i>
                                                    </div>
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.08); color: #0C3A30; border: 1px solid rgba(139,201,5,0.2);">
                                                        🏢 BUSINESS
                                                    </span>
                                                </div>

                                                <!-- Title -->
                                                <h3 class="fw-bold mb-3" style="color: #0C3A30; font-size: 1.75rem;">
                                                    <a href="{{route('our.services')}}" class="text-decoration-none" style="color: #0C3A30;">Investments</a>
                                                </h3>

                                                <!-- Description -->
                                                <p class="text-secondary mb-4" style="color: #4A5C5A !important; line-height: 1.7;">
                                                    Complete financial toolkit for modern businesses. From payroll to invoices, we've got you covered.
                                                </p>

                                                <!-- Feature Pills -->
                                                <div class="d-flex flex-wrap gap-2 mb-4">
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">📈 Cash Flow</span>
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">📄 Invoicing</span>
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">👥 Payroll</span>
                                                </div>

                                                <!-- Read More Link -->
                                                <a href="{{route('our.services')}}" class="read-more d-inline-flex align-items-center gap-2 fw-semibold text-decoration-none"
                                                    style="color: #8BC905; transition: all 0.3s;">
                                                    Learn more
                                                    <span class="rounded-circle d-flex align-items-center justify-content-center"
                                                        style="width: 28px; height: 28px; background: rgba(139,201,5,0.1); color: #8BC905; transition: all 0.3s;">
                                                        <i class="ri-arrow-right-up-line"></i>
                                                    </span>
                                                </a>
                                            </div>

                                            <!-- Decorative Element -->
                                            <div class="position-absolute bottom-0 end-0" style="width: 120px; height: 120px; background: radial-gradient(circle, rgba(139,201,5,0.05) 0%, transparent 70%); border-radius: 50%;"></div>
                                        </div>
                                    </div>

                                    <!-- SERVICE CARD 5 - Blockchain -->
                                    <div class="swiper-slide">
                                        <div class="service-card-premium position-relative"
                                            style="border-radius: 32px; background: white; box-shadow: 0 25px 40px -15px rgba(0,0,0,0.08); transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); overflow: hidden;">

                                            <!-- Top Accent -->
                                            <div style="height: 4px; background: linear-gradient(90deg, #8BC905, #0C3A30);"></div>

                                            <!-- Card Content -->
                                            <div class="p-4 p-xl-5">
                                                <!-- Icon & Badge -->
                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <div class="d-flex align-items-center justify-content-center rounded-3"
                                                        style="width: 72px; height: 72px; background: rgba(139,201,5,0.1);">
                                                        <i class="flaticon-blockchain" style="color: #8BC905; font-size: 2.5rem;"></i>
                                                    </div>
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.08); color: #0C3A30; border: 1px solid rgba(139,201,5,0.2);">
                                                        ⛓️ BLOCKCHAIN
                                                    </span>
                                                </div>

                                                <!-- Title -->
                                                <h3 class="fw-bold mb-3" style="color: #0C3A30; font-size: 1.75rem;">
                                                    <a href="{{route('our.services')}}" class="text-decoration-none" style="color: #0C3A30;">Blockchain Solutions</a>
                                                </h3>

                                                <!-- Description -->
                                                <p class="text-secondary mb-4" style="color: #4A5C5A !important; line-height: 1.7;">
                                                    Enterprise-grade blockchain infrastructure for secure, transparent, and programmable financial applications.
                                                </p>

                                                <!-- Feature Pills -->
                                                <div class="d-flex flex-wrap gap-2 mb-4">
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">🔗 Smart Contracts</span>
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">🌐 DeFi</span>
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">🔐 Immutable</span>
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">🔐 Forex</span>
                                                </div>

                                                <!-- Read More Link -->
                                                <a href="{{route('our.services')}}" class="read-more d-inline-flex align-items-center gap-2 fw-semibold text-decoration-none"
                                                    style="color: #8BC905; transition: all 0.3s;">
                                                    Learn more
                                                    <span class="rounded-circle d-flex align-items-center justify-content-center"
                                                        style="width: 28px; height: 28px; background: rgba(139,201,5,0.1); color: #8BC905; transition: all 0.3s;">
                                                        <i class="ri-arrow-right-up-line"></i>
                                                    </span>
                                                </a>
                                            </div>

                                            <!-- Decorative Element -->
                                            <div class="position-absolute bottom-0 end-0" style="width: 120px; height: 120px; background: radial-gradient(circle, rgba(139,201,5,0.05) 0%, transparent 70%); border-radius: 50%;"></div>
                                        </div>
                                    </div>

                                    <!-- SERVICE CARD 6 - Payment Processing -->
                                    <div class="swiper-slide">
                                        <div class="service-card-premium position-relative"
                                            style="border-radius: 32px; background: white; box-shadow: 0 25px 40px -15px rgba(0,0,0,0.08); transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); overflow: hidden;">

                                            <!-- Top Accent -->
                                            <div style="height: 4px; background: linear-gradient(90deg, #0C3A30, #8BC905);"></div>

                                            <!-- Card Content -->
                                            <div class="p-4 p-xl-5">
                                                <!-- Icon & Badge -->
                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <div class="d-flex align-items-center justify-content-center rounded-3"
                                                        style="width: 72px; height: 72px; background: rgba(139,201,5,0.1);">
                                                        <i class="flaticon-payment-method" style="color: #8BC905; font-size: 2.5rem;"></i>
                                                    </div>
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.08); color: #0C3A30; border: 1px solid rgba(139,201,5,0.2);">
                                                        💳 PAYMENTS
                                                    </span>
                                                </div>

                                                <!-- Title -->
                                                <h3 class="fw-bold mb-3" style="color: #0C3A30; font-size: 1.75rem;">
                                                    <a href="{{route('our.services')}}" class="text-decoration-none" style="color: #0C3A30;">Payment Processing</a>
                                                </h3>

                                                <!-- Description -->
                                                <p class="text-secondary mb-4" style="color: #4A5C5A !important; line-height: 1.7;">
                                                    Accept payments seamlessly across web, mobile, and in-store. 99.99% uptime, 140+ currencies.
                                                </p>

                                                <!-- Feature Pills -->
                                                <div class="d-flex flex-wrap gap-2 mb-4">
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">💳 Card Processing</span>
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">📱 Mobile</span>
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.06); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">🔄 Mirroring Trades</span>
                                                </div>

                                                <!-- Read More Link -->
                                                <a href="{{route('our.services')}}" class="read-more d-inline-flex align-items-center gap-2 fw-semibold text-decoration-none"
                                                    style="color: #8BC905; transition: all 0.3s;">
                                                    Learn more
                                                    <span class="rounded-circle d-flex align-items-center justify-content-center"
                                                        style="width: 28px; height: 28px; background: rgba(139,201,5,0.1); color: #8BC905; transition: all 0.3s;">
                                                        <i class="ri-arrow-right-up-line"></i>
                                                    </span>
                                                </a>
                                            </div>

                                            <!-- Decorative Element -->
                                            <div class="position-absolute bottom-0 end-0" style="width: 120px; height: 120px; background: radial-gradient(circle, rgba(139,201,5,0.05) 0%, transparent 70%); border-radius: 50%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile Pagination -->
                            <div class="swiper-pagination-premium d-flex justify-content-center mt-4 d-xl-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Services Area - Premium Redesign -->

        <style>
            /* ============ PREMIUM SERVICE CARD STYLES ============ */

            /* Card Hover Effects */
            .service-card-premium {
                transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            }

            .service-card-premium:hover {
                transform: translateY(-12px);
                box-shadow: 0 35px 50px -20px rgba(12, 58, 48, 0.2) !important;
            }

            .service-card-premium:hover .flaticon-businessman-5,
            .service-card-premium:hover .flaticon-browser-1,
            .service-card-premium:hover .flaticon-growth,
            .service-card-premium:hover .flaticon-businessman-1,
            .service-card-premium:hover .flaticon-blockchain,
            .service-card-premium:hover .flaticon-payment-method {
                transform: scale(1.1);
                color: #0C3A30 !important;
            }

            .service-card-premium .flaticon-businessman-5,
            .service-card-premium .flaticon-browser-1,
            .service-card-premium .flaticon-growth,
            .service-card-premium .flaticon-businessman-1,
            .service-card-premium .flaticon-blockchain,
            .service-card-premium .flaticon-payment-method {
                transition: all 0.3s ease;
            }

            /* Read More Link Hover */
            .read-more:hover {
                gap: 12px !important;
            }

            .read-more:hover span {
                background: #8BC905 !important;
                color: white !important;
                transform: translateX(4px);
            }

            .read-more span {
                transition: all 0.3s ease;
            }

            /* Navigation Controls Hover */
            .swiper-button-prev-custom:hover,
            .swiper-button-next-custom:hover {
                transform: scale(1.1);
            }

            .swiper-button-prev-custom:hover {
                background: #0C3A30 !important;
                color: white !important;
                border-color: #0C3A30 !important;
            }

            .swiper-button-next-custom:hover {
                background: #7AB805 !important;
                box-shadow: 0 20px 30px -8px rgba(139, 201, 5, 0.4) !important;
            }

            /* Button Hover */
            .btn:hover {
                transform: translateY(-3px);
                box-shadow: 0 25px 35px -12px rgba(12, 58, 48, 0.35) !important;
            }

            .btn:hover .bg-white\/20 {
                transform: translateX(4px);
            }

            /* Swiper Customization */
            .swiper-slide {
                height: auto;
            }

            .swiper-slide .service-card-premium {
                height: 100%;
            }

            /* Pagination */
            .swiper-pagination-bullet {
                background: rgba(139, 201, 5, 0.3) !important;
                width: 10px;
                height: 10px;
                opacity: 1;
                transition: all 0.3s ease;
            }

            .swiper-pagination-bullet-active {
                background: #8BC905 !important;
                width: 30px;
                border-radius: 10px;
                box-shadow: 0 0 15px #8BC905;
            }

            /* Animations */
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

            /* Responsive */
            @media (max-width: 1199px) {
                .section-heading {
                    text-align: center;
                    margin-bottom: 40px;
                }

                .section-heading h2 {
                    max-width: 100% !important;
                    margin-left: auto;
                    margin-right: auto;
                }

                .section-heading p {
                    max-width: 500px !important;
                    margin-left: auto;
                    margin-right: auto;
                }

                .services-btn {
                    justify-content: center;
                }

                #current-slide,
                #total-slides {
                    margin-left: auto;
                    margin-right: auto;
                }
            }

            @media (max-width: 768px) {
                .service-card-premium .p-4 {
                    padding: 1.5rem !important;
                }

                .service-card-premium h3 {
                    font-size: 1.5rem !important;
                }
            }
        </style>

        <script>
            // Initialize Swiper for Premium Services
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof Swiper !== 'undefined') {
                    const servicesSwiper = new Swiper('.services-slide-premium', {
                        slidesPerView: 1,
                        spaceBetween: 24,
                        loop: true,
                        autoplay: {
                            delay: 5000,
                            disableOnInteraction: false,
                        },
                        pagination: {
                            el: '.swiper-pagination-premium',
                            clickable: true,
                            dynamicBullets: true,
                        },
                        navigation: {
                            nextEl: '.swiper-button-next-custom',
                            prevEl: '.swiper-button-prev-custom',
                        },
                        breakpoints: {
                            640: {
                                slidesPerView: 1.5,
                                spaceBetween: 24,
                            },
                            768: {
                                slidesPerView: 1.8,
                                spaceBetween: 24,
                            },
                            1024: {
                                slidesPerView: 2.2,
                                spaceBetween: 24,
                            },
                            1200: {
                                slidesPerView: 2.5,
                                spaceBetween: 24,
                            }
                        },
                        on: {
                            slideChange: function() {
                                // Update slide counter
                                const current = document.getElementById('current-slide');
                                const total = document.getElementById('total-slides');
                                if (current && total) {
                                    let realIndex = this.realIndex + 1;
                                    current.innerText = realIndex < 10 ? '0' + realIndex : realIndex;
                                    total.innerText = this.slides.length < 10 ? '0' + this.slides.length : this.slides.length;
                                }
                            }
                        }
                    });

                    // Set total slides initially
                    const totalEl = document.getElementById('total-slides');
                    if (totalEl && servicesSwiper) {
                        const totalSlides = servicesSwiper.slides.length;
                        totalEl.innerText = totalSlides < 10 ? '0' + totalSlides : totalSlides;
                    }
                }
            });
        </script>

        <!-- Start About Us Area - Premium Redesign -->
        <div class="about-us-area py-5 py-md-6 overflow-hidden position-relative"
            style="background: linear-gradient(145deg, #ffffff, #f9fbf9);">

            <!-- Premium Decorative Elements -->
            <div class="position-absolute" style="top: -200px; right: -100px; width: 600px; height: 600px; border-radius: 50%; background: radial-gradient(circle, rgba(139,201,5,0.03) 0%, transparent 70%); pointer-events: none;"></div>
            <div class="position-absolute" style="bottom: -150px; left: -80px; width: 500px; height: 500px; border-radius: 50%; background: radial-gradient(circle, rgba(12,58,48,0.02) 0%, transparent 70%); pointer-events: none;"></div>

            <!-- Subtle Pattern Overlay -->
            <div class="position-absolute w-100 h-100 opacity-1"
                style="top: 0; left: 0; background-image: url('data:image/svg+xml,%3Csvg width=\" 60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%230C3A30\" fill-opacity=\"0.02\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); background-size: 40px 40px; pointer-events: none;"></div>

            <div class="container position-relative" style="max-width: 1280px; margin: 0 auto; z-index: 5;">

                <!-- ========================================= -->
                <!-- ABOUT TOP - PREMIUM HEADER SECTION -->
                <!-- ========================================= -->
                <div class="about-top mb-5" data-cues="slideInUp" data-duration="800">
                    <div class="row g-4 align-items-end">
                        <div class="col-lg-7 col-md-7">
                            <div class="section-heading mb-0">
                                <!-- Premium Badge -->
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <span class="badge px-4 py-2 rounded-pill fw-semibold d-inline-flex align-items-center gap-2"
                                        style="background: linear-gradient(145deg, #0C3A30, #0A2A23); color: white; border: 1px solid rgba(139,201,5,0.3); letter-spacing: 0.5px; box-shadow: 0 10px 20px -8px rgba(10,42,35,0.2);">
                                        <span style="display: inline-block; width: 8px; height: 8px; background: #8BC905; border-radius: 50%; box-shadow: 0 0 8px #8BC905; animation: pulse 2s infinite;"></span>
                                        ABOUT US
                                    </span>
                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2);">
                                        ✦ SINCE 2020
                                    </span>
                                </div>

                                <!-- Main Headline -->
                                <h2 class="display-5 fw-bold mb-0" style="color: #0C3A30; line-height: 1.2; max-width: 600px;">
                                    Leveraging Technology
                                    <span style="color: #8BC905; position: relative; display: inline-block;">
                                        For Secure
                                        <span class="position-absolute start-0 w-100" style="bottom: 0.1em; height: 8px; background: rgba(139,201,5,0.25); border-radius: 30px; z-index: -1;"></span>
                                    </span>
                                    & Smart Banking
                                </h2>
                            </div>
                        </div>

                        <div class="col-lg-5 col-md-5">
                            <div class="content ps-lg-4">
                                <p class="fs-5 text-secondary mb-0" style="color: #4A5C5A !important; line-height: 1.6; border-left: 4px solid #8BC905; padding-left: 20px;">
                                    "We blend advanced technology with financial expertise to deliver comprehensive solutions for individuals and businesses alike."
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================= -->
                <!-- ABOUT INFO - PREMIUM TABBED CONTENT CARD -->
                <!-- ========================================= -->
                <div class="about-info position-relative" data-cues="slideInUp" data-duration="800">

                    <!-- Premium Card Container -->
                    <div class="row g-0 rounded-5 overflow-hidden"
                        style="background: white; box-shadow: 0 30px 60px -20px rgba(12,58,48,0.12); border: 1px solid rgba(139,201,5,0.1);">

                        <!-- ========================================= -->
                        <!-- LEFT COLUMN - TABBED CONTENT -->
                        <!-- ========================================= -->
                        <div class="col-lg-6" data-cues="slideInRight" data-duration="800">
                            <div class="about-content h-100 p-4 p-xl-5 d-flex flex-column"
                                style="background: linear-gradient(145deg, #ffffff, #fafcf9);">

                                <!-- Premium Tab Navigation -->
                                <div class="d-flex align-items-center mb-4">
                                    <ul class="nav nav-tabs-premium d-flex gap-2 list-unstyled mb-0" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link-premium active px-4 py-3 rounded-pill fw-semibold"
                                                id="miss-tab"
                                                data-bs-toggle="tab"
                                                data-bs-target="#miss-tab-pane"
                                                type="button"
                                                role="tab"
                                                style="background: #0C3A30; color: white; border: none; transition: all 0.3s;">
                                                <span class="d-flex align-items-center gap-2">
                                                    <i class="ri-compass-line"></i>
                                                    Our Mission
                                                </span>
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link-premium px-4 py-3 rounded-pill fw-semibold"
                                                id="qua-tab"
                                                data-bs-toggle="tab"
                                                data-bs-target="#qua-tab-pane"
                                                type="button"
                                                role="tab"
                                                style="background: rgba(139,201,5,0.08); color: #0C3A30; border: 1px solid rgba(139,201,5,0.2); transition: all 0.3s;">
                                                <span class="d-flex align-items-center gap-2">
                                                    <i class="ri-star-line"></i>
                                                    Our Quality
                                                </span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Tab Content -->
                                <div class="tab-content-premium flex-grow-1" id="myTabContent">

                                    <!-- OUR MISSION TAB -->
                                    <div class="tab-pane-premium fade show active" id="miss-tab-pane" role="tabpanel">
                                        <div class="pe-xl-3">
                                            <!-- Title -->
                                            <h3 class="fw-bold mb-3" style="color: #0C3A30; font-size: 2rem; line-height: 1.2;">
                                                Passionate About Your<br>Financial Success
                                            </h3>

                                            <!-- Description -->
                                            <p class="text-secondary mb-4" style="color: #4A5C5A !important; line-height: 1.7; font-size: 1.05rem;">
                                                We're building the future of finance — where digital banking, payments, wealth management, and blockchain converge into one seamless, intelligent platform.
                                            </p>

                                            <!-- Premium Check List -->
                                            <ul class="list-unstyled d-flex flex-column gap-3 mb-4">
                                                <li class="d-flex align-items-start gap-3">
                                                    <span class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                                        style="width: 28px; height: 28px; background: rgba(139,201,5,0.15); color: #8BC905;">
                                                        <i class="ri-check-line" style="font-size: 16px; font-weight: bold;"></i>
                                                    </span>
                                                    <span style="color: #0C3A30; font-size: 1.05rem;">
                                                        <strong>Pay bills</strong> on time without missing a beat
                                                    </span>
                                                </li>
                                                <li class="d-flex align-items-start gap-3">
                                                    <span class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                                        style="width: 28px; height: 28px; background: rgba(139,201,5,0.15); color: #8BC905;">
                                                        <i class="ri-check-line" style="font-size: 16px; font-weight: bold;"></i>
                                                    </span>
                                                    <span style="color: #0C3A30; font-size: 1.05rem;">
                                                        <strong>Create & send invoices</strong> in seconds
                                                    </span>
                                                </li>
                                                <li class="d-flex align-items-start gap-3">
                                                    <span class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                                        style="width: 28px; height: 28px; background: rgba(139,201,5,0.15); color: #8BC905;">
                                                        <i class="ri-check-line" style="font-size: 16px; font-weight: bold;"></i>
                                                    </span>
                                                    <span style="color: #0C3A30; font-size: 1.05rem;">
                                                        <strong>Control your cash flow</strong> on demand
                                                    </span>
                                                </li>
                                            </ul>

                                            <!-- Stats Row -->
                                            <div class="d-flex gap-4 gap-xl-5 mt-4 mb-4 mb-md-5">
                                                <div>
                                                    <span class="fw-bold fs-2" style="color: #8BC905;">$2.4B+</span>
                                                    <span class="d-block small text-secondary">Transactions</span>
                                                </div>
                                                <div style="width: 1px; height: 40px; background: rgba(0,0,0,0.1);"></div>
                                                <div>
                                                    <span class="fw-bold fs-2" style="color: #8BC905;">150+</span>
                                                    <span class="d-block small text-secondary">Countries</span>
                                                </div>
                                                <div style="width: 1px; height: 40px; background: rgba(0,0,0,0.1);"></div>
                                                <div>
                                                    <span class="fw-bold fs-2" style="color: #8BC905;">99.9%</span>
                                                    <span class="d-block small text-secondary">Uptime</span>
                                                </div>
                                            </div>

                                            <!-- CTA Button -->
                                            <a href="{{route('about.us')}}"
                                                class="btn btn-lg px-5 py-3 rounded-pill fw-bold d-inline-flex align-items-center gap-3"
                                                style="background: linear-gradient(145deg, #0C3A30, #0A2A23); color: white; border: none; box-shadow: 0 20px 30px -10px rgba(12,58,48,0.25); transition: all 0.3s;">
                                                <span>More About Us</span>
                                                <span class="rounded-circle bg-white/20 p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                                    <i class="ri-arrow-right-up-line" style="color: white; font-size: 1.2rem;"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- OUR QUALITY TAB -->
                                    <div class="tab-pane-premium fade" id="qua-tab-pane" role="tabpanel">
                                        <div class="pe-xl-3">
                                            <!-- Title -->
                                            <h3 class="fw-bold mb-3" style="color: #0C3A30; font-size: 2rem; line-height: 1.2;">
                                                Uncompromising Quality,<br>Exceptional Service
                                            </h3>

                                            <!-- Description -->
                                            <p class="text-secondary mb-4" style="color: #4A5C5A !important; line-height: 1.7; font-size: 1.05rem;">
                                                Every product we build meets the highest standards of security, reliability, and performance. We never compromise on quality.
                                            </p>

                                            <!-- Premium Check List -->
                                            <ul class="list-unstyled d-flex flex-column gap-3 mb-4">
                                                <li class="d-flex align-items-start gap-3">
                                                    <span class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                                        style="width: 28px; height: 28px; background: rgba(139,201,5,0.15); color: #8BC905;">
                                                        <i class="ri-shield-check-line" style="font-size: 16px; font-weight: bold;"></i>
                                                    </span>
                                                    <span style="color: #0C3A30; font-size: 1.05rem;">
                                                        <strong>Bank-grade security</strong> with 256-bit encryption
                                                    </span>
                                                </li>
                                                <li class="d-flex align-items-start gap-3">
                                                    <span class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                                        style="width: 28px; height: 28px; background: rgba(139,201,5,0.15); color: #8BC905;">
                                                        <i class="ri-timer-line" style="font-size: 16px; font-weight: bold;"></i>
                                                    </span>
                                                    <span style="color: #0C3A30; font-size: 1.05rem;">
                                                        <strong>99.99% uptime SLA</strong> — always on, always reliable
                                                    </span>
                                                </li>
                                                <li class="d-flex align-items-start gap-3">
                                                    <span class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                                        style="width: 28px; height: 28px; background: rgba(139,201,5,0.15); color: #8BC905;">
                                                        <i class="ri-customer-service-line" style="font-size: 16px; font-weight: bold;"></i>
                                                    </span>
                                                    <span style="color: #0C3A30; font-size: 1.05rem;">
                                                        <strong>24/7 dedicated support</strong> from real humans
                                                    </span>
                                                </li>
                                            </ul>

                                            <!-- Quality Badges -->
                                            <div class="d-flex flex-wrap gap-2 mt-4 mb-4 mb-md-5">
                                                <span class="badge px-4 py-3 rounded-pill" style="background: rgba(139,201,5,0.08); color: #0C3A30; border: 1px solid rgba(139,201,5,0.2);">
                                                    ⭐ ISO 27001 Certified
                                                </span>
                                                <span class="badge px-4 py-3 rounded-pill" style="background: rgba(139,201,5,0.08); color: #0C3A30; border: 1px solid rgba(139,201,5,0.2);">
                                                    🔒 PCI DSS Compliant
                                                </span>
                                                <span class="badge px-4 py-3 rounded-pill" style="background: rgba(139,201,5,0.08); color: #0C3A30; border: 1px solid rgba(139,201,5,0.2);">
                                                    🌍 GDPR Ready
                                                </span>
                                            </div>

                                            <!-- CTA Button -->
                                            <a href="{{route('about.us')}}"
                                                class="btn btn-lg px-5 py-3 rounded-pill fw-bold d-inline-flex align-items-center gap-3"
                                                style="background: linear-gradient(145deg, #0C3A30, #0A2A23); color: white; border: none; box-shadow: 0 20px 30px -10px rgba(12,58,48,0.25); transition: all 0.3s;">
                                                <span>More About Us</span>
                                                <span class="rounded-circle bg-white/20 p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                                    <i class="ri-arrow-right-up-line" style="color: white; font-size: 1.2rem;"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ========================================= -->
                        <!-- RIGHT COLUMN - PREMIUM IMAGE SHOWCASE -->
                        <!-- ========================================= -->
                        <div class="col-lg-6" data-cues="slideInLeft" data-duration="800">
                            <div class="about-image h-100 position-relative"
                                style="background: linear-gradient(145deg, #0C3A30, #0A2A23); min-height: 550px;">

                                <!-- Decorative Pattern -->
                                <div class="position-absolute w-100 h-100 opacity-10"
                                    style="background-image: radial-gradient(circle at 30px 30px, rgba(139,201,5,0.2) 1px, transparent 1px); background-size: 40px 40px;"></div>

                                <!-- Glowing Orbs -->
                                <div class="position-absolute" style="top: -50px; right: -50px; width: 300px; height: 300px; border-radius: 50%; background: radial-gradient(circle, rgba(139,201,5,0.15) 0%, transparent 70%);"></div>
                                <div class="position-absolute" style="bottom: -50px; left: -50px; width: 250px; height: 250px; border-radius: 50%; background: radial-gradient(circle, rgba(139,201,5,0.1) 0%, transparent 70%);"></div>

                                <!-- Main Image -->
                                <div class="position-relative z-2 h-100 d-flex align-items-center justify-content-center p-4 p-xl-5">
                                    <div class="position-relative" style="transform: perspective(1000px) rotateY(5deg) rotateX(2deg); transition: transform 0.6s ease;">
                                        <!-- Premium Card Mockup -->
                                        <div class="position-relative rounded-4 overflow-hidden shadow-2xl"
                                            style="border: 1px solid rgba(139,201,5,0.2); box-shadow: 0 40px 70px -20px rgba(0,0,0,0.4);">
                                            <img class="about-image-1 img-fluid w-100"
                                                src="assets/images/frontpage-pricing-d.webp"
                                                alt="Premium Banking Dashboard"
                                                style="transition: transform 0.6s ease; display: block;">

                                            <!-- Overlay Gradient -->
                                            <div class="position-absolute bottom-0 start-0 w-100 p-4"
                                                style="background: linear-gradient(to top, rgba(12,58,48,0.9), transparent);">
                                                <span class="badge px-4 py-2 rounded-pill" style="background: rgba(139,201,5,0.9); color: #0C3A30; font-weight: 600;">
                                                    <i class="ri-shield-check-line me-1"></i> Secure Trading Platform
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Floating Badge 1 -->
                                        <div class="position-absolute" style="top: -20px; left: -20px; animation: float 6s ease-in-out infinite;">
                                            <div class="d-flex align-items-center gap-2 bg-white rounded-pill py-2 px-4 shadow-lg"
                                                style="border-left: 4px solid #8BC905;">
                                                <i class="ri-shield-check-fill" style="color: #8BC905;"></i>
                                                <span class="fw-semibold small" style="color: #0C3A30;">256-bit Encryption</span>
                                            </div>
                                        </div>

                                        <!-- Floating Badge 2 -->
                                        <div class="position-absolute" style="bottom: 40px; right: -20px; animation: float 7s ease-in-out infinite; animation-delay: 1s;">
                                            <div class="d-flex align-items-center gap-2 bg-white rounded-pill py-2 px-4 shadow-lg"
                                                style="border-left: 4px solid #8BC905;">
                                                <i class="ri-flashlight-fill" style="color: #8BC905;"></i>
                                                <span class="fw-semibold small" style="color: #0C3A30;">Real-time Sync</span>
                                            </div>
                                        </div>

                                        <!-- Floating Badge 3 -->
                                        <div class="position-absolute" style="top: 30%; right: -15px; animation: float 8s ease-in-out infinite; animation-delay: 2s;">
                                            <div class="d-flex align-items-center gap-2 bg-white rounded-pill py-2 px-4 shadow-lg"
                                                style="border-left: 4px solid #8BC905;">
                                                <i class="ri-global-line" style="color: #8BC905;"></i>
                                                <span class="fw-semibold small" style="color: #0C3A30;">150+ Countries</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Stats Card Overlay -->
                                <div class="position-absolute bottom-0 end-0 m-4 z-3" style="animation: float 5s ease-in-out infinite; animation-delay: 1.5s;">
                                    <div class="bg-white/95 backdrop-blur rounded-4 p-3 shadow-xl"
                                        style="border: 1px solid rgba(139,201,5,0.2); max-width: 200px;">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="rounded-circle p-2" style="background: rgba(139,201,5,0.15);">
                                                <i class="ri-user-star-line fs-4" style="color: #8BC905;"></i>
                                            </div>
                                            <div>
                                                <span class="small text-secondary">Trusted by</span>
                                                <div class="fw-bold fs-4" style="color: white;">50K+</div>
                                                <span class="small text-secondary">active users</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================= -->
                <!-- BOTTOM TRUST BADGES -->
                <!-- ========================================= -->
                <div class="row g-4 mt-5 pt-3" data-cues="slideInUp" data-duration="800">
                    <div class="col-12">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-4 p-4 rounded-4"
                            style="background: rgba(139,201,5,0.03); border: 1px solid rgba(139,201,5,0.1);">
                            <div class="d-flex align-items-center gap-3">
                                <span class="fw-semibold" style="color: #0C3A30;">Trusted by industry leaders:</span>
                            </div>
                            <div class="d-flex flex-wrap align-items-center gap-4 gap-xl-5">
                                <span style="color: #4A5C5A; font-weight: 600; opacity: 0.8;">PAYPAL</span>
                                <span style="color: #4A5C5A; font-weight: 600; opacity: 0.8;">STRIPE</span>
                                <span style="color: #4A5C5A; font-weight: 600; opacity: 0.8;">WISE</span>
                                <span style="color: #4A5C5A; font-weight: 600; opacity: 0.8;">REVOLUT</span>
                                <span style="color: #4A5C5A; font-weight: 600; opacity: 0.8;">ADYEN</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End About Us Area - Premium Redesign -->

        <style>
            /* ============ PREMIUM ABOUT US STYLES ============ */

            /* Animations */
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
                    transform: translateY(-10px);
                }

                100% {
                    transform: translateY(0px);
                }
            }

            /* Tab Navigation Premium */
            .nav-link-premium {
                transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                cursor: pointer;
                border: none;
                font-size: 1rem;
            }

            .nav-link-premium:hover {
                transform: translateY(-2px);
            }

            .nav-link-premium.active {
                background: #0C3A30 !important;
                color: white !important;
                box-shadow: 0 10px 20px -8px rgba(12, 58, 48, 0.3);
            }

            .nav-link-premium:not(.active):hover {
                background: rgba(139, 201, 5, 0.15) !important;
                border-color: rgba(139, 201, 5, 0.3) !important;
            }

            /* Tab Content */
            .tab-pane-premium {
                transition: opacity 0.3s ease;
            }

            .tab-pane-premium.fade {
                opacity: 0;
                display: none;
            }

            .tab-pane-premium.fade.show {
                opacity: 1;
                display: block;
            }

            /* Image Container */
            .about-image {
                transition: all 0.5s ease;
            }

            .about-image:hover .position-relative[style*="perspective"] {
                transform: perspective(1000px) rotateY(7deg) rotateX(4deg) scale(1.02) !important;
            }

            .about-image-1 {
                transition: transform 0.6s ease;
            }

            .about-image-1:hover {
                transform: scale(1.03);
            }

            /* Button Hover */
            .btn:hover {
                transform: translateY(-3px);
                box-shadow: 0 25px 35px -12px rgba(12, 58, 48, 0.35) !important;
            }

            .btn:hover .bg-white\/20 {
                transform: translateX(4px);
            }

            /* Check List Items */
            .list-unstyled li {
                transition: transform 0.2s ease;
            }

            .list-unstyled li:hover {
                transform: translateX(5px);
            }

            .list-unstyled li:hover .rounded-circle {
                background: rgba(139, 201, 5, 0.25) !important;
                transform: scale(1.1);
            }

            .list-unstyled li .rounded-circle {
                transition: all 0.2s ease;
            }

            /* Floating Badges */
            .position-absolute .bg-white {
                box-shadow: 0 15px 30px -12px rgba(0, 0, 0, 0.15);
                transition: all 0.3s ease;
            }

            .position-absolute .bg-white:hover {
                transform: scale(1.05);
                box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.2);
            }

            /* Utilities */
            .backdrop-blur {
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
            }

            .shadow-2xl {
                box-shadow: 0 35px 60px -15px rgba(0, 0, 0, 0.3);
            }

            .shadow-xl {
                box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.2);
            }

            /* Responsive */
            @media (max-width: 991px) {
                .about-top .row {
                    text-align: center;
                }

                .about-top .content p {
                    border-left: none !important;
                    padding-left: 0 !important;
                    margin-top: 15px;
                }

                .about-content {
                    padding: 2rem !important;
                }

                .about-image {
                    min-height: 450px !important;
                }

                .nav-tabs-premium {
                    justify-content: center;
                }
            }

            @media (max-width: 767px) {
                .about-content {
                    padding: 1.5rem !important;
                }

                .about-image {
                    min-height: 400px !important;
                }

                .d-flex.gap-4.gap-xl-5 {
                    flex-wrap: wrap;
                    gap: 1rem !important;
                }
            }
        </style>

        <script>
            // Initialize Bootstrap Tabs (if not already initialized)
            document.addEventListener('DOMContentLoaded', function() {
                // Bootstrap 5 tabs initialization
                const triggerTabList = [].slice.call(document.querySelectorAll('#myTab button'));
                triggerTabList.forEach(function(triggerEl) {
                    const tabTrigger = new bootstrap.Tab(triggerEl);

                    triggerEl.addEventListener('click', function(event) {
                        event.preventDefault();

                        // Remove active class from all buttons
                        document.querySelectorAll('.nav-link-premium').forEach(btn => {
                            btn.style.background = 'rgba(139,201,5,0.08)';
                            btn.style.color = '#0C3A30';
                            btn.style.border = '1px solid rgba(139,201,5,0.2)';
                        });

                        // Add active class to clicked button
                        this.style.background = '#0C3A30';
                        this.style.color = 'white';
                        this.style.border = 'none';

                        tabTrigger.show();
                    });
                });
            });
        </script>




        <!-- Start Why Choose Us Area -->
        <!-- Start Why Choose Us Area - Premium Redesign -->
        <div class="why-choose-us-area py-5 py-md-6 overflow-hidden position-relative"
            style="background: linear-gradient(145deg, #ffffff, #f9fbf9);">

            <!-- Premium Decorative Elements -->
            <div class="position-absolute" style="top: -200px; left: -100px; width: 600px; height: 600px; border-radius: 50%; background: radial-gradient(circle, rgba(139,201,5,0.03) 0%, transparent 70%); pointer-events: none;"></div>
            <div class="position-absolute" style="bottom: -150px; right: -80px; width: 500px; height: 500px; border-radius: 50%; background: radial-gradient(circle, rgba(12,58,48,0.02) 0%, transparent 70%); pointer-events: none;"></div>

            <!-- Subtle Pattern Overlay -->
            <div class="position-absolute w-100 h-100 opacity-1"
                style="top: 0; left: 0; background-image: url('data:image/svg+xml,%3Csvg width=\" 60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%230C3A30\" fill-opacity=\"0.02\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); background-size: 40px 40px; pointer-events: none;"></div>

            <div class="container position-relative" style="max-width: 1280px; margin: 0 auto; z-index: 5;">
                <div class="row g-5 align-items-center">

                    <!-- ========================================= -->
                    <!-- LEFT COLUMN - PREMIUM VIDEO SHOWCASE -->
                    <!-- ========================================= -->
                    <div class="col-lg-6 col-md-12" data-cues="slideInRight" data-duration="800">
                        <div class="choose-image position-relative p-3 p-xl-4">

                            <!-- Premium Image Container -->
                            <div class="position-relative rounded-5 overflow-hidden"
                                style="background: linear-gradient(145deg, #0C3A30, #0A2A23); box-shadow: 0 30px 50px -20px rgba(12,58,48,0.25); border: 1px solid rgba(139,201,5,0.15);">

                                <!-- Glowing Overlay -->
                                <div class="position-absolute w-100 h-100"
                                    style="background: radial-gradient(circle at 70% 30%, rgba(139,201,5,0.15) 0%, transparent 70%); pointer-events: none; z-index: 2;"></div>

                                <!-- Main Image -->
                                <img class="radius-30 w-100 hover-zoom"
                                    src="assets/images/about/about-image-2.jpg"
                                    alt="Why Choose MarketMind AI"
                                    style="display: block; transition: transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1); aspect-ratio: 4/3; object-fit: cover;">

                                <!-- Premium Gradient Overlay -->
                                <div class="position-absolute bottom-0 start-0 w-100 h-50"
                                    style="background: linear-gradient(to top, rgba(12,58,48,0.7), transparent); pointer-events: none; z-index: 3;"></div>

                                <!-- Premium Play Button -->
                                <div class="position-absolute top-50 start-50 translate-middle" style="z-index: 10;">
                                    <video
                                        src="{{ asset('assets/images/livetradevideo.mp4') }}"
                                        class="w-full h-full object-cover"
                                        autoplay
                                        muted
                                        loop
                                        playsinline
                                        preload="auto"
                                        onloadstart="this.style.opacity='1'; document.getElementById('video-loading-main').style.display='none';"
                                        onerror="this.style.display='none'; document.getElementById('fallback-content-main').style.display='flex'; document.getElementById('video-loading-main').style.display='none';"
                                        style="opacity: 0; transition: opacity 0.5s ease-in-out;">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>

                                <!-- Pulse Rings Animation -->
                                <div class="position-absolute top-50 start-50 translate-middle" style="z-index: 5;">
                                    <span class="position-absolute top-50 start-50 translate-middle"
                                        style="width: 120px; height: 120px; border-radius: 50%; background: rgba(139,201,5,0.2); animation: ping 2.5s infinite; pointer-events: none;"></span>
                                    <span class="position-absolute top-50 start-50 translate-middle"
                                        style="width: 150px; height: 150px; border-radius: 50%; background: rgba(139,201,5,0.1); animation: ping 2.5s infinite 0.5s; pointer-events: none;"></span>
                                </div>

                                <!-- Floating Badge - Trust Indicator -->
                                <div class="position-absolute top-0 end-0 m-4" style="z-index: 15; animation: float 6s ease-in-out infinite;">
                                    <div class="d-flex align-items-center gap-2 bg-white/95 backdrop-blur rounded-pill py-2 px-4 shadow-lg"
                                        style="border-left: 4px solid #8BC905;">
                                        <i class="ri-shield-check-fill" style="color: white;"></i>
                                        <span class="fw-semibold small" style="color: white;">Trusted by 50K+ users</span>
                                    </div>
                                </div>

                                <!-- Floating Badge - Live Demo -->
                                <div class="position-absolute bottom-0 start-0 m-4" style="z-index: 15; animation: float 7s ease-in-out infinite 1s;">
                                    <div class="d-flex align-items-center gap-2 bg-white/95 backdrop-blur rounded-pill py-2 px-4 shadow-lg"
                                        style="border-left: 4px solid #8BC905;">
                                        <span class="d-flex align-items-center gap-2">
                                            <span style="display: inline-block; width: 10px; height: 10px; background: #8BC905; border-radius: 50%; box-shadow: 0 0 15px #8BC905; animation: pulse 2s infinite;"></span>
                                            <span class="fw-semibold small" style="color: white;">Watch Demo</span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Experience Badge -->
                            <div class="position-absolute bottom-0 end-0 translate-middle-y me-5" style="z-index: 20; animation: float 8s ease-in-out infinite 1.5s;">
                                <div class="bg-white rounded-4 p-3 shadow-xl d-flex align-items-center gap-3"
                                    style="border: 1px solid rgba(139,201,5,0.2);">
                                    <div class="rounded-circle p-2" style="background: rgba(139,201,5,0.15);">
                                        <i class="ri-star-fill fs-4" style="color: #8BC905;"></i>
                                    </div>
                                    <div>
                                        <span class="small text-secondary">4.9/5 Rating</span>
                                        <div class="fw-bold" style="color: #0C3A30;">2,500+ Reviews</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================= -->
                    <!-- RIGHT COLUMN - PREMIUM CONTENT -->
                    <!-- ========================================= -->
                    <div class="col-lg-6 col-md-12" data-cues="slideInLeft" data-duration="800">
                        <div class="why-choose-us-content ps-lg-4">

                            <!-- Section Header -->
                            <div class="section-heading mb-0">

                                <!-- Premium Badge -->
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <span class="badge px-4 py-2 rounded-pill fw-semibold d-inline-flex align-items-center gap-2"
                                        style="background: linear-gradient(145deg,#0C3A30,#0A2A23); color:white; border:1px solid rgba(139,201,5,0.3); letter-spacing:0.5px; box-shadow:0 10px 20px -8px rgba(10,42,35,0.2);">
                                        <span style="display:inline-block;width:8px;height:8px;background:#8BC905;border-radius:50%;box-shadow:0 0 8px #8BC905;animation:pulse 2s infinite;"></span>
                                        WHY CHOOSE US
                                    </span>

                                    <span class="badge px-3 py-2 rounded-pill"
                                        style="background:rgba(139,201,5,0.1);color:#8BC905;border:1px solid rgba(139,201,5,0.2);">
                                        ⚡ GLOBAL COMMUNITY
                                    </span>
                                </div>

                                <!-- Main Headline -->
                                <h2 class="display-5 fw-bold mb-3" style="color:#0C3A30;line-height:1.2;">
                                    Build Your
                                    <span style="color:#8BC905; position:relative; display:inline-block;">
                                        Trading Knowledge
                                        <span class="position-absolute start-0 w-100"
                                            style="bottom:0.1em;height:8px;background:rgba(139,201,5,0.25);border-radius:30px;z-index:-1;"></span>
                                    </span>
                                    <br>With Confidence
                                </h2>

                                <!-- Description -->
                                <p class="fs-5 text-secondary mb-4"
                                    style="color:#4A5C5A !important; line-height:1.7; max-width:550px;">
                                    Market Mind is a modern trading education platform designed to simplify complex financial markets.
                                    Learn proven trading strategies, analyze real-time market trends, and join a community of traders
                                    sharing insights and best practices to grow your trading knowledge with confidence.
                                </p>
                                <!-- Feature Grid -->
                                <div class="row g-3 mb-4 mb-md-5">

                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-start gap-3 p-3 rounded-4"
                                            style="background:rgba(139,201,5,0.04);border:1px solid rgba(139,201,5,0.1); transition: all 0.3s ease;">
                                            <div class="rounded-circle p-2 flex-shrink-0"
                                                style="background:rgba(139,201,5,0.15);">
                                                <i class="ri-flashlight-fill" style="color:#8BC905;font-size:1.2rem;"></i>
                                            </div>
                                            <div>
                                                <h4 class="fw-bold mb-1" style="color:#0C3A30;font-size:1.1rem;">Timely Insights</h4>
                                                <p class="small text-secondary mb-0">Stay updated with the latest financial knowledge</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-start gap-3 p-3 rounded-4"
                                            style="background:rgba(139,201,5,0.04);border:1px solid rgba(139,201,5,0.1); transition: all 0.3s ease;">
                                            <div class="rounded-circle p-2 flex-shrink-0"
                                                style="background:rgba(139,201,5,0.15);">
                                                <i class="ri-shield-check-fill" style="color:#8BC905;font-size:1.2rem;"></i>
                                            </div>
                                            <div>
                                                <h4 class="fw-bold mb-1" style="color:#0C3A30;font-size:1.1rem;">Trusted Resources</h4>
                                                <p class="small text-secondary mb-0">Educational content curated for transparency</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-start gap-3 p-3 rounded-4"
                                            style="background:rgba(139,201,5,0.04);border:1px solid rgba(139,201,5,0.1); transition: all 0.3s ease;">
                                            <div class="rounded-circle p-2 flex-shrink-0"
                                                style="background:rgba(139,201,5,0.15);">
                                                <i class="ri-global-line" style="color:#8BC905;font-size:1.2rem;"></i>
                                            </div>
                                            <div>
                                                <h4 class="fw-bold mb-1" style="color:#0C3A30;font-size:1.1rem;">Global Education</h4>
                                                <p class="small text-secondary mb-0">Learn about markets, fintech, and digital innovation</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-start gap-3 p-3 rounded-4"
                                            style="background:rgba(139,201,5,0.04);border:1px solid rgba(139,201,5,0.1); transition: all 0.3s ease;">
                                            <div class="rounded-circle p-2 flex-shrink-0"
                                                style="background:rgba(139,201,5,0.15);">
                                                <i class="ri-community-fill" style="color:#8BC905;font-size:1.2rem;"></i>
                                            </div>
                                            <div>
                                                <h4 class="fw-bold mb-1" style="color:#0C3A30;font-size:1.1rem;">Active Community</h4>
                                                <p class="small text-secondary mb-0">Connect with thousands of learners worldwide</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- CTA -->
                                <div class="d-flex flex-wrap align-items-center gap-4">

                                    <a href="{{ route('about.us') }}"
                                        class="btn btn-lg px-5 py-3 rounded-pill fw-bold d-inline-flex align-items-center gap-3"
                                        style="background:linear-gradient(145deg,#8BC905,#7AB805);color:#0C3A30;border:none;box-shadow:0 20px 30px -10px rgba(139,201,5,0.3);">
                                        <span>Learn More</span>
                                        <span class="rounded-circle d-flex align-items-center justify-content-center"
                                            style="width:32px;height:32px;background:rgba(12,58,48,0.1);">
                                            <i class="ri-arrow-right-up-line" style="color:#0C3A30;font-size:1.2rem;"></i>
                                        </span>
                                    </a>

                                    <!-- Community Indicator -->
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle border-2 border-white"
                                                style="width:36px;height:36px;background:linear-gradient(145deg,#0C3A30,#0A2A23);margin-right:-8px;"></div>
                                            <div class="rounded-circle border-2 border-white"
                                                style="width:36px;height:36px;background:linear-gradient(145deg,#8BC905,#7AB805);margin-right:-8px;"></div>
                                            <div class="rounded-circle border-2 border-white"
                                                style="width:36px;height:36px;background:linear-gradient(145deg,#0C3A30,#0A2A23);margin-right:-8px;"></div>
                                            <div class="rounded-circle border-2 border-white"
                                                style="width:36px;height:36px;background:linear-gradient(145deg,#8BC905,#7AB805);"></div>
                                        </div>
                                        <span class="fw-semibold" style="color:#0C3A30;font-size:0.95rem;">
                                            Join <span style="color:#8BC905;">50K+</span> members
                                        </span>
                                        <span class="badge rounded-pill px-2 py-1"
                                            style="background:rgba(139,201,5,0.1);color:#0C3A30;border:1px solid rgba(139,201,5,0.2);font-size:0.7rem;">
                                            Discord • YouTube • WhatsApp
                                        </span>
                                    </div>

                                </div>

                                <!-- Trust Indicators -->
                                <div class="d-flex flex-wrap gap-3 mt-4 pt-3">
                                    <span class="d-flex align-items-center gap-2">
                                        <i class="ri-checkbox-circle-fill" style="color:#8BC905;"></i>
                                        <span class="small text-secondary">Educational insights</span>
                                    </span>
                                    <span class="d-flex align-items-center gap-2">
                                        <i class="ri-checkbox-circle-fill" style="color:#8BC905;"></i>
                                        <span class="small text-secondary">Global market topics</span>
                                    </span>
                                    <span class="d-flex align-items-center gap-2">
                                        <i class="ri-checkbox-circle-fill" style="color:#8BC905;"></i>
                                        <span class="small text-secondary">Active learning community</span>
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Why Choose Us Area - Premium Redesign -->

        <style>
            /* ============ PREMIUM WHY CHOOSE US STYLES ============ */

            /* Animations */
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

            @keyframes ping {
                0% {
                    transform: translate(-50%, -50%) scale(1);
                    opacity: 0.8;
                }

                75%,
                100% {
                    transform: translate(-50%, -50%) scale(1.5);
                    opacity: 0;
                }
            }

            @keyframes float {
                0% {
                    transform: translateY(0px);
                }

                50% {
                    transform: translateY(-10px);
                }

                100% {
                    transform: translateY(0px);
                }
            }

            /* Play Button Hover */
            .popup-btn {
                transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            }

            .popup-btn:hover {
                transform: scale(1.15);
                background: white !important;
                border-color: #8BC905 !important;
                box-shadow: 0 25px 50px -10px rgba(139, 201, 5, 0.5) !important;
            }

            .popup-btn:hover i {
                color: #0C3A30 !important;
                transform: scale(1.1);
            }

            .popup-btn i {
                transition: all 0.3s ease;
            }

            /* Image Hover Effect */
            .hover-zoom {
                transition: transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
            }

            .choose-image:hover .hover-zoom {
                transform: scale(1.05);
            }

            /* Feature Cards Hover */
            .row .col-sm-6 .d-flex {
                transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            }

            .row .col-sm-6 .d-flex:hover {
                transform: translateY(-5px);
                background: rgba(139, 201, 5, 0.08) !important;
                border-color: rgba(139, 201, 5, 0.3) !important;
                box-shadow: 0 10px 20px -8px rgba(139, 201, 5, 0.15);
            }

            .row .col-sm-6 .d-flex:hover .rounded-circle {
                transform: scale(1.1);
                background: rgba(139, 201, 5, 0.25) !important;
            }

            .row .col-sm-6 .d-flex .rounded-circle {
                transition: all 0.3s ease;
            }

            /* Button Hover */
            .btn:hover {
                transform: translateY(-3px);
                box-shadow: 0 25px 35px -12px rgba(139, 201, 5, 0.4) !important;
            }

            .btn:hover .bg-white\/20 {
                transform: translateX(4px) translateY(-2px);
            }

            .bg-white\/20 {
                transition: all 0.3s ease;
            }

            /* Trust Badges Hover */
            .d-flex.flex-wrap.gap-3 span {
                transition: all 0.2s ease;
            }

            .d-flex.flex-wrap.gap-3 span:hover {
                transform: translateX(5px);
            }

            .d-flex.flex-wrap.gap-3 span i {
                transition: all 0.2s ease;
            }

            .d-flex.flex-wrap.gap-3 span:hover i {
                transform: scale(1.2);
                color: #0C3A30 !important;
            }

            /* User Avatars */
            .rounded-circle.border-2 {
                transition: all 0.3s ease;
                border: 2px solid white;
                box-shadow: 0 5px 15px -5px rgba(0, 0, 0, 0.1);
            }

            .d-flex.align-items-center:hover .rounded-circle {
                transform: translateY(-3px);
            }

            /* Floating Badges */
            .position-absolute .bg-white\/95 {
                transition: all 0.3s ease;
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
            }

            .position-absolute .bg-white\/95:hover {
                transform: scale(1.05);
                box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.2) !important;
            }

            /* Responsive */
            @media (max-width: 991px) {
                .why-choose-us-content {
                    text-align: center;
                    padding-left: 0 !important;
                }

                .why-choose-us-content h2 {
                    max-width: 600px;
                    margin-left: auto;
                    margin-right: auto;
                }

                .why-choose-us-content p {
                    max-width: 550px;
                    margin-left: auto;
                    margin-right: auto;
                }

                .d-flex.flex-wrap.align-items-center.gap-4 {
                    justify-content: center;
                }

                .d-flex.flex-wrap.gap-3.mt-4 {
                    justify-content: center;
                }

                .popup-btn {
                    width: 80px !important;
                    height: 80px !important;
                }

                .popup-btn i {
                    font-size: 2.2rem !important;
                }
            }

            @media (max-width: 767px) {
                .popup-btn {
                    width: 70px !important;
                    height: 70px !important;
                }

                .popup-btn i {
                    font-size: 1.8rem !important;
                }

                .position-absolute.bottom-0.end-0.translate-middle-y {
                    display: none;
                }
            }

            /* Utilities */
            .backdrop-blur {
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
            }

            .shadow-xl {
                box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.2);
            }
        </style>
        <!-- End Why Choose Us Area -->



        <!-- Start Choose Card Area -->
        <!-- Start Choose Card Area - Premium Redesign -->
        <div class="choose-card-area py-5 py-md-6 mb-5 overflow-hidden position-relative"
            style="background: linear-gradient(145deg, #f8fafc, #ffffff);">

            <!-- Premium Decorative Elements -->
            <div class="position-absolute" style="top: -100px; right: -50px; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(139,201,5,0.04) 0%, transparent 70%); pointer-events: none;"></div>
            <div class="position-absolute" style="bottom: -80px; left: -40px; width: 350px; height: 350px; border-radius: 50%; background: radial-gradient(circle, rgba(12,58,48,0.03) 0%, transparent 70%); pointer-events: none;"></div>

            <!-- Subtle Grid Pattern -->
            <div class="position-absolute w-100 h-100 opacity-1"
                style="top: 0; left: 0; background-image: linear-gradient(rgba(139,201,5,0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(139,201,5,0.02) 1px, transparent 1px); background-size: 30px 30px; pointer-events: none;"></div>

            <div class="container position-relative" style="max-width: 1280px; margin: 0 auto; z-index: 5;">

                <!-- ========================================= -->
                <!-- SECTION HEADER - MINIMAL & ELEGANT -->
                <!-- ========================================= -->
                <div class="text-center mb-5" data-cues="slideInUp" data-duration="800">
                    <div class="d-flex justify-content-center mb-3">
                        <span class="badge px-4 py-2 rounded-pill fw-semibold d-inline-flex align-items-center gap-2"
                            style="background: linear-gradient(145deg, #0C3A30, #0A2A23); color: white; border: 1px solid rgba(139,201,5,0.4); letter-spacing: 0.5px; box-shadow: 0 10px 20px -8px rgba(10,42,35,0.2);">
                            <span style="display: inline-block; width: 8px; height: 8px; background: #8BC905; border-radius: 50%; box-shadow: 0 0 8px #8BC905; animation: pulse 2s infinite;"></span>
                            WHY TRADERS CHOOSE US
                        </span>
                    </div>

                    <h2 class="display-6 fw-bold mb-0 mx-auto" style="color: #0C3A30; max-width: 600px; line-height: 1.2;">
                        Trade Smarter in the<br><span style="color: #8BC905; position: relative; display: inline-block;">
                            Modern Market
                            <span class="position-absolute start-0 w-100" style="bottom: 0.1em; height: 8px; background: rgba(139,201,5,0.25); border-radius: 30px; z-index: -1;"></span>
                        </span>
                    </h2>
                </div>

                <!-- ========================================= -->
                <!-- PREMIUM FEATURE CARDS - 3 COLUMN GRID -->
                <!-- ========================================= -->
                <div class="row g-4 justify-content-center" data-cues="slideInUp" data-duration="800">
                    <!-- CARD 1 - Market Insights -->
                    <div class="col-lg-4 col-md-6 d-flex">
                        <div class="choose-card-premium w-100 h-100 position-relative p-4 p-xl-5 rounded-4"
                            style="background:white;border:1px solid rgba(139,201,5,0.1);box-shadow:0 15px 35px -10px rgba(0,0,0,0.05);overflow:hidden;">

                            <div class="position-absolute top-0 start-0 w-100"
                                style="height:4px;background:linear-gradient(90deg,#8BC905,#0C3A30);"></div>

                            <div class="d-flex align-items-center justify-content-center rounded-3 mb-4"
                                style="width:80px;height:80px;background:rgba(139,201,5,0.1);border:1px solid rgba(139,201,5,0.2);">
                                <i class="flaticon-money-5" style="color:#8BC905;font-size:2.5rem;"></i>
                            </div>

                            <h3 class="fw-bold mb-3" style="color:#0C3A30;">Market Insights</h3>

                            <p class="text-secondary mb-4" style="line-height:1.7;">
                                Explore simplified explanations of financial markets, economic trends,
                                and digital finance developments designed to help readers understand
                                how modern markets operate.
                            </p>

                        </div>
                    </div>


                    <!-- CARD 2 - Learning Resources -->
                    <div class="col-lg-4 col-md-6 d-flex">
                        <div class="choose-card-premium w-100 h-100 position-relative p-4 p-xl-5 rounded-4"
                            style="background:white;border:1px solid rgba(139,201,5,0.1);box-shadow:0 15px 35px -10px rgba(0,0,0,0.05);overflow:hidden;">

                            <div class="position-absolute top-0 start-0 w-100"
                                style="height:4px;background:linear-gradient(90deg,#0C3A30,#8BC905);"></div>

                            <div class="d-flex align-items-center justify-content-center rounded-3 mb-4"
                                style="width:80px;height:80px;background:rgba(139,201,5,0.1);border:1px solid rgba(139,201,5,0.2);">
                                <i class="flaticon-dollar-symbol-1" style="color:#8BC905;font-size:2.5rem;"></i>
                            </div>

                            <h3 class="fw-bold mb-3" style="color:#0C3A30;">Learning Resources</h3>

                            <p class="text-secondary mb-4" style="line-height:1.7;">
                                Access educational articles, beginner guides, and explanations
                                covering financial markets, digital finance, and modern technology
                                impacting global economies.
                            </p>

                        </div>
                    </div>


                    <!-- CARD 3 - Community & Discussion -->
                    <div class="col-lg-4 col-md-6 d-flex">
                        <div class="choose-card-premium w-100 h-100 position-relative p-4 p-xl-5 rounded-4"
                            style="background:linear-gradient(145deg,#0C3A30,#0A2A23);border:1px solid rgba(139,201,5,0.2);">

                            <div class="d-flex align-items-center justify-content-center rounded-3 mb-4"
                                style="width:80px;height:80px;background:rgba(255,255,255,0.1);border:1px solid rgba(139,201,5,0.3);">
                                <i class="flaticon-tablet" style="color:#8BC905;font-size:2.5rem;"></i>
                            </div>

                            <h3 class="fw-bold mb-3 text-white">Community Discussions</h3>

                            <p class="text-white mb-4" style="opacity:0.9;line-height:1.7;">
                                Join conversations with other readers and community members across
                                our social platforms where financial topics, market news,
                                and digital innovations are discussed.
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End Choose Card Area - Premium Redesign -->

            <style>
                /* ============ PREMIUM CHOOSE CARD STYLES ============ */

                /* Animations */
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

                /* Card Hover Effects */
                .choose-card-premium {
                    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
                }

                .choose-card-premium:hover {
                    transform: translateY(-12px);
                    box-shadow: 0 30px 45px -15px rgba(12, 58, 48, 0.15) !important;
                }

                /* Light Card Hover */
                .choose-card-premium:not([style*="background: linear-gradient(145deg, #0C3A30"]) {
                    border-color: rgba(139, 201, 5, 0.3) !important;
                    box-shadow: 0 25px 40px -15px rgba(139, 201, 5, 0.15) !important;
                }

                .choose-card-premium:hover .d-flex.align-items-center.justify-content-center.rounded-3 {
                    transform: scale(1.1);
                    background: rgba(139, 201, 5, 0.15) !important;
                    border-color: rgba(139, 201, 5, 0.4) !important;
                }

                .choose-card-premium:hover i {
                    transform: scale(1.1);
                    color: #0C3A30 !important;
                }

                /* Dark Card Hover */
                .choose-card-premium[style*="background: linear-gradient(145deg, #0C3A30"]:hover {
                    transform: translateY(-12px);
                    box-shadow: 0 35px 50px -15px rgba(12, 58, 48, 0.4) !important;
                    border-color: rgba(139, 201, 5, 0.4) !important;
                }

                .choose-card-premium[style*="background: linear-gradient(145deg, #0C3A30"]:hover .d-flex.align-items-center.justify-content-center.rounded-3 {
                    background: rgba(255, 255, 255, 0.15) !important;
                    border-color: rgba(139, 201, 5, 0.5) !important;
                }

                .choose-card-premium[style*="background: linear-gradient(145deg, #0C3A30"]:hover i {
                    color: white !important;
                    transform: scale(1.1);
                }

                /* Icon Container */
                .d-flex.align-items-center.justify-content-center.rounded-3 {
                    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                }

                i.flaticon-money-5,
                i.flaticon-dollar-symbol-1,
                i.flaticon-tablet {
                    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                }

                /* Learn More Link Hover */
                a.d-inline-flex {
                    transition: all 0.3s ease;
                }

                a.d-inline-flex:hover {
                    gap: 12px !important;
                }

                a.d-inline-flex:hover span {
                    background: #8BC905 !important;
                    color: white !important;
                    transform: translateX(4px);
                }

                a.d-inline-flex span {
                    transition: all 0.3s ease;
                }

                /* Dark card link hover */
                .choose-card-premium[style*="background: linear-gradient(145deg, #0C3A30"] a.d-inline-flex:hover span {
                    background: #8BC905 !important;
                    color: #0C3A30 !important;
                }

                /* Badge hover */
                .position-absolute.top-0.end-0.m-4.px-3.py-2 {
                    transition: all 0.3s ease;
                }

                .position-absolute.top-0.end-0.m-4.px-3.py-2:hover {
                    transform: scale(1.05);
                }

                /* Feature tags hover */
                .badge {
                    transition: all 0.2s ease;
                }

                .badge:hover {
                    background: rgba(139, 201, 5, 0.15) !important;
                    transform: scale(1.05);
                    border-color: rgba(139, 201, 5, 0.4) !important;
                }

                /* Dark card tags hover */
                .choose-card-premium[style*="background: linear-gradient(145deg, #0C3A30"] .badge:hover {
                    background: rgba(255, 255, 255, 0.15) !important;
                    color: white !important;
                }

                /* Responsive */
                @media (max-width: 991px) {
                    .choose-card-premium {
                        padding: 2rem !important;
                    }

                    h2.display-6 {
                        font-size: 2.2rem;
                    }
                }

                @media (max-width: 767px) {
                    .choose-card-premium {
                        padding: 1.75rem !important;
                    }

                    .d-flex.flex-wrap.align-items-center.justify-content-center.gap-4 {
                        flex-direction: column;
                        text-align: center;
                    }

                    h2.display-6 {
                        font-size: 1.8rem;
                    }

                    .position-absolute.top-0.end-0.m-4.fw-bold {
                        font-size: 2.5rem !important;
                    }
                }

                /* Utilities */
                .text-white-80 {
                    color: rgba(255, 255, 255, 0.85);
                }

                .backdrop-blur {
                    backdrop-filter: blur(5px);
                    -webkit-backdrop-filter: blur(5px);
                }
            </style>
            <!-- End Choose Card Area - Premium Redesign -->

            <style>
                /* ============ PREMIUM CHOOSE CARD STYLES ============ */

                /* Animations */
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

                /* Card Hover Effects */
                .choose-card-premium {
                    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
                }

                .choose-card-premium:hover {
                    transform: translateY(-12px);
                    box-shadow: 0 30px 45px -15px rgba(12, 58, 48, 0.15) !important;
                }

                /* Light Card Hover */
                .choose-card-premium:not([style*="background: linear-gradient(145deg, #0C3A30"]) {
                    border-color: rgba(139, 201, 5, 0.3) !important;
                    box-shadow: 0 25px 40px -15px rgba(139, 201, 5, 0.15) !important;
                }

                .choose-card-premium:hover .d-flex.align-items-center.justify-content-center.rounded-3 {
                    transform: scale(1.1);
                    background: rgba(139, 201, 5, 0.15) !important;
                    border-color: rgba(139, 201, 5, 0.4) !important;
                }

                .choose-card-premium:hover i {
                    transform: scale(1.1);
                    color: #0C3A30 !important;
                }

                /* Dark Card Hover */
                .choose-card-premium[style*="background: linear-gradient(145deg, #0C3A30"]:hover {
                    transform: translateY(-12px);
                    box-shadow: 0 35px 50px -15px rgba(12, 58, 48, 0.4) !important;
                    border-color: rgba(139, 201, 5, 0.4) !important;
                }

                .choose-card-premium[style*="background: linear-gradient(145deg, #0C3A30"]:hover .d-flex.align-items-center.justify-content-center.rounded-3 {
                    background: rgba(255, 255, 255, 0.15) !important;
                    border-color: rgba(139, 201, 5, 0.5) !important;
                }

                .choose-card-premium[style*="background: linear-gradient(145deg, #0C3A30"]:hover i {
                    color: white !important;
                    transform: scale(1.1);
                }

                /* Icon Container */
                .d-flex.align-items-center.justify-content-center.rounded-3 {
                    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                }

                i.flaticon-money-5,
                i.flaticon-dollar-symbol-1,
                i.flaticon-tablet {
                    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                }

                /* Learn More Link Hover */
                a.d-inline-flex {
                    transition: all 0.3s ease;
                }

                a.d-inline-flex:hover {
                    gap: 12px !important;
                }

                a.d-inline-flex:hover span {
                    background: #8BC905 !important;
                    color: white !important;
                    transform: translateX(4px);
                }

                a.d-inline-flex span {
                    transition: all 0.3s ease;
                }

                /* Dark card link hover */
                .choose-card-premium[style*="background: linear-gradient(145deg, #0C3A30"] a.d-inline-flex:hover span {
                    background: #8BC905 !important;
                    color: #0C3A30 !important;
                }

                /* Badge hover */
                .position-absolute.top-0.end-0.m-4.px-3.py-2 {
                    transition: all 0.3s ease;
                }

                .position-absolute.top-0.end-0.m-4.px-3.py-2:hover {
                    transform: scale(1.05);
                }

                /* Feature tags hover */
                .badge {
                    transition: all 0.2s ease;
                }

                .badge:hover {
                    background: rgba(139, 201, 5, 0.15) !important;
                    transform: scale(1.05);
                    border-color: rgba(139, 201, 5, 0.4) !important;
                }

                /* Dark card tags hover */
                .choose-card-premium[style*="background: linear-gradient(145deg, #0C3A30"] .badge:hover {
                    background: rgba(255, 255, 255, 0.15) !important;
                    color: white !important;
                }

                /* Responsive */
                @media (max-width: 991px) {
                    .choose-card-premium {
                        padding: 2rem !important;
                    }

                    h2.display-6 {
                        font-size: 2.2rem;
                    }
                }

                @media (max-width: 767px) {
                    .choose-card-premium {
                        padding: 1.75rem !important;
                    }

                    .d-flex.flex-wrap.align-items-center.justify-content-center.gap-4 {
                        flex-direction: column;
                        text-align: center;
                    }

                    h2.display-6 {
                        font-size: 1.8rem;
                    }

                    .position-absolute.top-0.end-0.m-4.fw-bold {
                        font-size: 2.5rem !important;
                    }
                }

                /* Utilities */
                .text-white-80 {
                    color: rgba(255, 255, 255, 0.85);
                }

                .backdrop-blur {
                    backdrop-filter: blur(5px);
                    -webkit-backdrop-filter: blur(5px);
                }
            </style>
            <!-- End Choose Card Area -->

            <!-- Start How It Works Area -->
            <!-- Start How It Works Area - Premium Redesign -->
            <div class="how-it-works-area position-relative py-5 py-md-6 overflow-hidden"
                style="background: linear-gradient(145deg, #0C3A30, #062018);">

                <!-- Premium Decorative Elements -->
                <div class="position-absolute" style="top: -200px; right: -100px; width: 600px; height: 600px; border-radius: 50%; background: radial-gradient(circle, rgba(139,201,5,0.1) 0%, transparent 70%); pointer-events: none;"></div>
                <div class="position-absolute" style="bottom: -150px; left: -80px; width: 500px; height: 500px; border-radius: 50%; background: radial-gradient(circle, rgba(158,221,5,0.08) 0%, transparent 70%); pointer-events: none;"></div>

                <!-- Animated Grid Pattern -->
                <div class="position-absolute w-100 h-100 opacity-5"
                    style="top: 0; left: 0; background-image: radial-gradient(circle at 30px 30px, rgba(139,201,5,0.1) 1px, transparent 1px); background-size: 50px 50px; pointer-events: none; animation: drift 30s infinite linear;"></div>

                <!-- Glowing Orbs -->
                <div class="position-absolute" style="top: 20%; left: 10%; width: 300px; height: 300px; border-radius: 50%; background: radial-gradient(circle, rgba(139,201,5,0.05) 0%, transparent 70%); filter: blur(60px);"></div>
                <div class="position-absolute" style="bottom: 10%; right: 15%; width: 250px; height: 250px; border-radius: 50%; background: radial-gradient(circle, rgba(158,221,5,0.05) 0%, transparent 70%); filter: blur(50px);"></div>

                <div class="container position-relative" style="max-width: 1280px; margin: 0 auto; z-index: 10;">

                    <!-- ========================================= -->
                    <!-- SECTION HEADER - PREMIUM DARK THEME -->
                    <!-- ========================================= -->
                    <div class="about-top mb-5" data-cues="slideInUp" data-duration="800">
                        <div class="row g-4 align-items-end">
                            <div class="col-lg-7 col-md-7">
                                <div class="section-heading mb-0">
                                    <!-- Premium Badge -->
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <span class="badge px-4 py-2 rounded-pill fw-semibold d-inline-flex align-items-center gap-2"
                                            style="background: rgba(139,201,5,0.15); color: #8BC905; border: 1px solid rgba(139,201,5,0.3); letter-spacing: 0.5px; backdrop-filter: blur(5px);">
                                            <span style="display: inline-block; width: 8px; height: 8px; background: #8BC905; border-radius: 50%; box-shadow: 0 0 15px #8BC905; animation: pulse 2s infinite;"></span>
                                            HOW IT WORKS
                                        </span>
                                        <span class="badge px-3 py-2 rounded-pill" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.1); backdrop-filter: blur(5px);">
                                            ⚡ 3 SIMPLE STEPS
                                        </span>
                                    </div>

                                    <!-- Main Headline -->
                                    <h2 class="display-5 fw-bold mb-0 text-white" style="line-height: 1.2; max-width: 600px; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                        Commitment To
                                        <span style="color: #8BC905; position: relative; display: inline-block;">
                                            Exceptional
                                            <span class="position-absolute start-0 w-100" style="bottom: 0.1em; height: 8px; background: rgba(139,201,5,0.3); border-radius: 30px; z-index: 1; filter: blur(2px);"></span>
                                        </span>
                                        <br>Services & Solutions
                                    </h2>
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-5">
                                <div class="content ps-lg-4">
                                    <p class="fs-5 text-white-80 mb-0" style="line-height: 1.6; border-left: 4px solid #8BC905; padding-left: 20px;">
                                        Advanced technology meets financial expertise. One seamless platform for individuals and businesses to grow, manage, and move money smarter.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================= -->
                    <!-- MAIN CONTENT - TABBED JOURNEY -->
                    <!-- ========================================= -->
                    <div class="row g-5 align-items-start">

                        <!-- ========================================= -->
                        <!-- LEFT COLUMN - VERTICAL TAB NAVIGATION -->
                        <!-- ========================================= -->
                        <div class="col-xl-4 col-lg-12" data-cues="slideInRight" data-duration="800">
                            <div class="works-vertical-tabs h-100">
                                <div class="d-flex flex-column gap-3" role="tablist">

                                    <!-- Tab 1 - Create Account -->
                                    <button class="works-tab-btn w-100 text-start d-flex align-items-center justify-content-between p-4 rounded-4 active"
                                        id="crea-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#crea-tab-pane"
                                        type="button"
                                        role="tab"
                                        style="background: rgba(139,201,5,0.15); border: 1px solid rgba(139,201,5,0.3); backdrop-filter: blur(10px); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="step-number d-flex align-items-center justify-content-center rounded-circle fw-bold"
                                                style="width: 48px; height: 48px; background: rgba(139,201,5,0.2); color: #8BC905; font-size: 1.3rem; border: 1px solid rgba(139,201,5,0.3);">01</span>
                                            <div>
                                                <span class="d-block fw-bold text-white" style="font-size: 1.2rem;">Create Account</span>
                                                <span class="small text-white-50">Get started in 2 minutes</span>
                                            </div>
                                        </div>
                                        <i class="ri-arrow-right-up-line fs-4" style="color: #8BC905; transition: all 0.3s ease;"></i>
                                    </button>

                                    <!-- Tab 2 - User Confirmation -->
                                    <button class="works-tab-btn w-100 text-start d-flex align-items-center justify-content-between p-4 rounded-4"
                                        id="use-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#use-tab-pane"
                                        type="button"
                                        role="tab"
                                        style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); backdrop-filter: blur(10px); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="step-number d-flex align-items-center justify-content-center rounded-circle fw-bold"
                                                style="width: 48px; height: 48px; background: rgba(255,255,255,0.1); color: white; font-size: 1.3rem; border: 1px solid rgba(255,255,255,0.1);">02</span>
                                            <div>
                                                <span class="d-block fw-bold text-white" style="font-size: 1.2rem;">User Confirmation</span>
                                                <span class="small text-white-50">Secure identity verification</span>
                                            </div>
                                        </div>
                                        <i class="ri-arrow-right-up-line fs-4" style="color: white; opacity: 0.5; transition: all 0.3s ease;"></i>
                                    </button>

                                    <!-- Tab 3 - Start Investing (New) -->
                                    <button class="works-tab-btn w-100 text-start d-flex align-items-center justify-content-between p-4 rounded-4"
                                        id="invest-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#invest-tab-pane"
                                        type="button"
                                        role="tab"
                                        style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); backdrop-filter: blur(10px); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="step-number d-flex align-items-center justify-content-center rounded-circle fw-bold"
                                                style="width: 48px; height: 48px; background: rgba(255,255,255,0.1); color: white; font-size: 1.3rem; border: 1px solid rgba(255,255,255,0.1);">03</span>
                                            <div>
                                                <span class="d-block fw-bold text-white" style="font-size: 1.2rem;">Start Investing</span>
                                                <span class="small text-white-50">AI-powered portfolio</span>
                                            </div>
                                        </div>
                                        <i class="ri-arrow-right-up-line fs-4" style="color: white; opacity: 0.5; transition: all 0.3s ease;"></i>
                                    </button>
                                </div>

                                <!-- Progress Indicator -->
                                <div class="mt-5 pt-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="flex-grow-1" style="height: 2px; background: rgba(255,255,255,0.1);">
                                            <div class="h-100" style="width: 33%; background: #8BC905; box-shadow: 0 0 15px #8BC905;"></div>
                                        </div>
                                        <span class="small text-white-50">Step 1 of 3</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ========================================= -->
                        <!-- RIGHT COLUMN - TAB CONTENT (DYNAMIC) -->
                        <!-- ========================================= -->
                        <div class="col-xl-8 col-lg-12" data-cues="slideInLeft" data-duration="800">
                            <div class="tab-content" id="myTabContent">

                                <!-- TAB 1 - CREATE ACCOUNT -->
                                <div class="tab-pane fade show active" id="crea-tab-pane" role="tabpanel">
                                    <div class="row g-4 align-items-center">
                                        <!-- Left: Image -->
                                        <div class="col-lg-6">
                                            <div class="single-works-image position-relative">
                                                <div class="position-relative rounded-5 overflow-hidden"
                                                    style="border: 1px solid rgba(139,201,5,0.2); box-shadow: 0 30px 50px -20px rgba(0,0,0,0.4);">
                                                    <img class="w-100 hover-zoom"
                                                        src="assets/images/about/about-image-3.jpg"
                                                        alt="Create Account"
                                                        style="display: block; transition: transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1); aspect-ratio: 4/3; object-fit: cover;">

                                                    <!-- Gradient Overlay -->
                                                    <div class="position-absolute bottom-0 start-0 w-100 p-3"
                                                        style="background: linear-gradient(to top, rgba(12,58,48,0.9), transparent);">
                                                        <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.9); color: #0C3A30;">
                                                            <i class="ri-time-line me-1"></i> Takes just 2 minutes
                                                        </span>
                                                    </div>
                                                </div>

                                                <!-- Floating Badge -->
                                                <div class="position-absolute top-0 start-0 translate-middle-y ms-4" style="animation: float 6s ease-in-out infinite;">
                                                    <div class="d-flex align-items-center gap-2 bg-white rounded-pill py-2 px-4 shadow-lg">
                                                        <i class="ri-customer-service-fill" style="color: #8BC905;"></i>
                                                        <span class="fw-semibold small" style="color: #0C3A30;">Free signup</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Right: Content Card -->
                                        <div class="col-lg-6">
                                            <div class="single-works-card h-100 p-4 p-xl-5 rounded-4 d-flex flex-column"
                                                style="background: rgba(41,89,75,0.3); backdrop-filter: blur(10px); border: 1px solid rgba(139,201,5,0.2); box-shadow: 0 20px 40px -15px rgba(0,0,0,0.3);">

                                                <!-- Icon -->
                                                <div class="d-flex align-items-center justify-content-center rounded-3 mb-4"
                                                    style="width: 80px; height: 80px; background: rgba(139,201,5,0.15); border: 1px solid rgba(139,201,5,0.3);">
                                                    <i class="flaticon-payment-method-1 method" style="color: #8BC905; font-size: 2.8rem; line-height: 1;"></i>
                                                </div>

                                                <!-- Title -->
                                                <h3 class="fw-bold mb-3 text-white" style="font-size: 1.8rem;">Create Your Account</h3>

                                                <!-- Description -->
                                                <p class="text-white-80 mb-4" style="line-height: 1.7; opacity: 0.9;">
                                                    Sign up in under 2 minutes. No paperwork, no hidden fees. Just secure, instant access to our entire financial platform.
                                                </p>

                                                <!-- Feature List -->
                                                <ul class="list-unstyled d-flex flex-column gap-2 mb-4">
                                                    <li class="d-flex align-items-center gap-2">
                                                        <i class="ri-checkbox-circle-fill" style="color: #8BC905;"></i>
                                                        <span class="text-white-80">Free account, no minimum balance</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-2">
                                                        <i class="ri-checkbox-circle-fill" style="color: #8BC905;"></i>
                                                        <span class="text-white-80">Instant virtual card issued</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-2">
                                                        <i class="ri-checkbox-circle-fill" style="color: #8BC905;"></i>
                                                        <span class="text-white-80">Connect existing bank accounts</span>
                                                    </li>
                                                </ul>

                                                <!-- CTA Button -->
                                                <a href="/" class="btn w-100 py-3 rounded-pill fw-bold d-flex align-items-center justify-content-between px-4 mt-auto"
                                                    style="background: linear-gradient(145deg, #8BC905, #7AB805); color: #0C3A30; border: none; transition: all 0.3s;">
                                                    <span>Get Started Now</span>
                                                    <span class="rounded-circle bg-white/20 p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                                        <i class="ri-arrow-right-up-line" style="color: #0C3A30; font-size: 1.2rem;"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- TAB 2 - USER CONFIRMATION -->
                                <div class="tab-pane fade" id="use-tab-pane" role="tabpanel">
                                    <div class="row g-4 align-items-center">
                                        <!-- Left: Image -->
                                        <div class="col-lg-6">
                                            <div class="single-works-image position-relative">
                                                <div class="position-relative rounded-5 overflow-hidden"
                                                    style="border: 1px solid rgba(139,201,5,0.2); box-shadow: 0 30px 50px -20px rgba(0,0,0,0.4);">
                                                    <img class="w-100 hover-zoom"
                                                        src="assets/images/about/about-image-10.jpg"
                                                        alt="User Confirmation"
                                                        style="display: block; transition: transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1); aspect-ratio: 4/3; object-fit: cover;">

                                                    <!-- Gradient Overlay -->
                                                    <div class="position-absolute bottom-0 start-0 w-100 p-3"
                                                        style="background: linear-gradient(to top, rgba(12,58,48,0.9), transparent);">
                                                        <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.9); color: #0C3A30;">
                                                            <i class="ri-shield-check-line me-1"></i> Secure verification
                                                        </span>
                                                    </div>
                                                </div>

                                                <!-- Floating Badge -->
                                                <div class="position-absolute top-0 end-0 translate-middle-y me-4" style="animation: float 7s ease-in-out infinite;">
                                                    <div class="d-flex align-items-center gap-2 bg-white rounded-pill py-2 px-4 shadow-lg">
                                                        <i class="ri-fingerprint-line" style="color: #8BC905;"></i>
                                                        <span class="fw-semibold small" style="color: #0C3A30;">Biometric ready</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Right: Content Card -->
                                        <div class="col-lg-6">
                                            <div class="single-works-card h-100 p-4 p-xl-5 rounded-4 d-flex flex-column"
                                                style="background: rgba(41,89,75,0.3); backdrop-filter: blur(10px); border: 1px solid rgba(139,201,5,0.2); box-shadow: 0 20px 40px -15px rgba(0,0,0,0.3);">

                                                <!-- Icon -->
                                                <div class="d-flex align-items-center justify-content-center rounded-3 mb-4"
                                                    style="width: 80px; height: 80px; background: rgba(139,201,5,0.15); border: 1px solid rgba(139,201,5,0.3);">
                                                    <i class="flaticon-tablet method" style="color: #8BC905; font-size: 2.8rem; line-height: 1;"></i>
                                                </div>

                                                <!-- Title -->
                                                <h3 class="fw-bold mb-3 text-white" style="font-size: 1.8rem;">Verify Your Identity</h3>

                                                <!-- Description -->
                                                <p class="text-white-80 mb-4" style="line-height: 1.7; opacity: 0.9;">
                                                    Fast, secure KYC verification. Upload your ID and take a selfie — our AI verifies you in seconds, not days.
                                                </p>

                                                <!-- Feature List -->
                                                <ul class="list-unstyled d-flex flex-column gap-2 mb-4">
                                                    <li class="d-flex align-items-center gap-2">
                                                        <i class="ri-checkbox-circle-fill" style="color: #8BC905;"></i>
                                                        <span class="text-white-80">AI-powered ID verification</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-2">
                                                        <i class="ri-checkbox-circle-fill" style="color: #8BC905;"></i>
                                                        <span class="text-white-80">Facial recognition available</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-2">
                                                        <i class="ri-checkbox-circle-fill" style="color: #8BC905;"></i>
                                                        <span class="text-white-80">Approved in under 60 seconds</span>
                                                    </li>
                                                </ul>

                                                <!-- CTA Button -->
                                                <a href="/" class="btn w-100 py-3 rounded-pill fw-bold d-flex align-items-center justify-content-between px-4 mt-auto"
                                                    style="background: linear-gradient(145deg, #8BC905, #7AB805); color: #0C3A30; border: none; transition: all 0.3s;">
                                                    <span>Verify Now</span>
                                                    <span class="rounded-circle bg-white/20 p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                                        <i class="ri-arrow-right-up-line" style="color: #0C3A30; font-size: 1.2rem;"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- TAB 3 - START INVESTING (NEW) -->
                                <div class="tab-pane fade" id="invest-tab-pane" role="tabpanel">
                                    <div class="row g-4 align-items-center">
                                        <!-- Left: Image -->
                                        <div class="col-lg-6">
                                            <div class="single-works-image position-relative">
                                                <div class="position-relative rounded-5 overflow-hidden"
                                                    style="border: 1px solid rgba(139,201,5,0.2); box-shadow: 0 30px 50px -20px rgba(0,0,0,0.4);">
                                                    <img class="w-100 hover-zoom"
                                                        src="assets/images/service/service-image-3.png"
                                                        alt="Start Investing"
                                                        style="display: block; transition: transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1); aspect-ratio: 4/3; object-fit: cover;">

                                                    <!-- Gradient Overlay -->
                                                    <div class="position-absolute bottom-0 start-0 w-100 p-3"
                                                        style="background: linear-gradient(to top, rgba(12,58,48,0.9), transparent);">
                                                        <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.9); color: #0C3A30;">
                                                            <i class="ri-line-chart-line me-1"></i> AI-powered returns
                                                        </span>
                                                    </div>
                                                </div>

                                                <!-- Floating Badge -->
                                                <div class="position-absolute bottom-0 end-0 translate-middle-y me-4" style="animation: float 8s ease-in-out infinite;">
                                                    <div class="d-flex align-items-center gap-2 bg-white rounded-pill py-2 px-4 shadow-lg">
                                                        <i class="ri-flashlight-fill" style="color: #8BC905;"></i>
                                                        <span class="fw-semibold small" style="color: #0C3A30;">From $10</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Right: Content Card -->
                                        <div class="col-lg-6">
                                            <div class="single-works-card h-100 p-4 p-xl-5 rounded-4 d-flex flex-column"
                                                style="background: rgba(41,89,75,0.3); backdrop-filter: blur(10px); border: 1px solid rgba(139,201,5,0.2); box-shadow: 0 20px 40px -15px rgba(0,0,0,0.3);">

                                                <!-- Icon -->
                                                <div class="d-flex align-items-center justify-content-center rounded-3 mb-4"
                                                    style="width: 80px; height: 80px; background: rgba(139,201,5,0.15); border: 1px solid rgba(139,201,5,0.3);">
                                                    <i class="flaticon-growth" style="color: #8BC905; font-size: 2.8rem; line-height: 1;"></i>
                                                </div>

                                                <!-- Title -->
                                                <h3 class="fw-bold mb-3 text-white" style="font-size: 1.8rem;">Start Investing</h3>

                                                <!-- Description -->
                                                <p class="text-white-80 mb-4" style="line-height: 1.7; opacity: 0.9;">
                                                    Let our AI build a personalized portfolio tailored to your goals. Start with as little as $10 and watch your money grow.
                                                </p>

                                                <!-- Feature List -->
                                                <ul class="list-unstyled d-flex flex-column gap-2 mb-4">
                                                    <li class="d-flex align-items-center gap-2">
                                                        <i class="ri-checkbox-circle-fill" style="color: #8BC905;"></i>
                                                        <span class="text-white-80">AI-managed diversified portfolio</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-2">
                                                        <i class="ri-checkbox-circle-fill" style="color: #8BC905;"></i>
                                                        <span class="text-white-80">Low fees, high transparency</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-2">
                                                        <i class="ri-checkbox-circle-fill" style="color: #8BC905;"></i>
                                                        <span class="text-white-80">Withdraw anytime, no penalties</span>
                                                    </li>
                                                </ul>

                                                <!-- CTA Button -->
                                                <a href="/" class="btn w-100 py-3 rounded-pill fw-bold d-flex align-items-center justify-content-between px-4 mt-auto"
                                                    style="background: linear-gradient(145deg, #8BC905, #7AB805); color: #0C3A30; border: none; transition: all 0.3s;">
                                                    <span>Start Investing</span>
                                                    <span class="rounded-circle bg-white/20 p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                                        <i class="ri-arrow-right-up-line" style="color: #0C3A30; font-size: 1.2rem;"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================= -->
                    <!-- BOTTOM TRUST BADGES -->
                    <!-- ========================================= -->
                    <div class="row mt-5 pt-5" data-cues="slideInUp" data-duration="800">
                        <div class="col-12">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-4 p-4 rounded-4"
                                style="background: rgba(255,255,255,0.05); border: 1px solid rgba(139,201,5,0.15); backdrop-filter: blur(10px);">
                                <div class="d-flex align-items-center gap-3">
                                    <span class="fw-semibold text-white-80">Join 50,000+ users who started their journey:</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="ri-star-fill" style="color: #FFB800;"></i>
                                    <i class="ri-star-fill" style="color: #FFB800;"></i>
                                    <i class="ri-star-fill" style="color: #FFB800;"></i>
                                    <i class="ri-star-fill" style="color: #FFB800;"></i>
                                    <i class="ri-star-fill" style="color: #FFB800;"></i>
                                    <span class="ms-2 text-white-80">4.9/5 from 2,500+ reviews</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="small text-white-50">🚀 Avg. funding time: 2.4 min</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End How It Works Area - Premium Redesign -->

            <style>
                /* ============ PREMIUM HOW IT WORKS STYLES ============ */

                /* Animations */
                @keyframes pulse {
                    0% {
                        opacity: 1;
                        transform: scale(1);
                    }

                    50% {
                        opacity: 0.8;
                        transform: scale(0.95);
                        box-shadow: 0 0 20px #8BC905;
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
                        transform: translateY(-10px);
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
                        background-position: 100px 100px;
                    }
                }

                /* Works Tab Buttons */
                .works-tab-btn {
                    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                    cursor: pointer;
                    position: relative;
                    overflow: hidden;
                }

                .works-tab-btn:hover {
                    transform: translateX(8px);
                    background: rgba(139, 201, 5, 0.15) !important;
                    border-color: rgba(139, 201, 5, 0.4) !important;
                }

                .works-tab-btn.active {
                    background: rgba(139, 201, 5, 0.15) !important;
                    border-color: rgba(139, 201, 5, 0.4) !important;
                    box-shadow: 0 10px 25px -8px rgba(139, 201, 5, 0.2);
                }

                .works-tab-btn.active .step-number {
                    background: rgba(139, 201, 5, 0.3) !important;
                    color: white !important;
                    border-color: rgba(139, 201, 5, 0.6) !important;
                }

                .works-tab-btn.active i {
                    color: #8BC905 !important;
                    opacity: 1 !important;
                    transform: translateX(4px) translateY(-2px);
                }

                .works-tab-btn i {
                    transition: all 0.3s ease;
                }

                .works-tab-btn:hover i {
                    transform: translateX(4px) translateY(-2px);
                    color: #8BC905 !important;
                    opacity: 1 !important;
                }

                .works-tab-btn .step-number {
                    transition: all 0.3s ease;
                }

                .works-tab-btn:hover .step-number {
                    background: rgba(139, 201, 5, 0.2) !important;
                    color: #8BC905 !important;
                    border-color: rgba(139, 201, 5, 0.4) !important;
                }

                /* Card Hover Effects */
                .single-works-card {
                    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
                }

                .single-works-card:hover {
                    transform: translateY(-8px);
                    background: rgba(41, 89, 75, 0.4) !important;
                    border-color: rgba(139, 201, 5, 0.3) !important;
                    box-shadow: 0 30px 50px -20px rgba(0, 0, 0, 0.4) !important;
                }

                .single-works-card:hover .d-flex.align-items-center.justify-content-center.rounded-3 {
                    transform: scale(1.1);
                    background: rgba(139, 201, 5, 0.2) !important;
                    border-color: rgba(139, 201, 5, 0.5) !important;
                }

                .single-works-card .d-flex.align-items-center.justify-content-center.rounded-3 {
                    transition: all 0.3s ease;
                }

                /* Image Hover */
                .hover-zoom {
                    transition: transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
                }

                .single-works-image:hover .hover-zoom {
                    transform: scale(1.05);
                }

                .single-works-image:hover .position-relative {
                    border-color: rgba(139, 201, 5, 0.3) !important;
                }

                /* Button Hover */
                .btn:hover {
                    transform: translateY(-3px);
                    box-shadow: 0 20px 30px -10px rgba(139, 201, 5, 0.3) !important;
                }

                .btn:hover .bg-white\/20 {
                    transform: translateX(4px) translateY(-2px);
                }

                .bg-white\/20 {
                    transition: all 0.3s ease;
                }

                /* Floating Badges */
                .position-absolute .bg-white {
                    transition: all 0.3s ease;
                    box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.2);
                }

                .position-absolute .bg-white:hover {
                    transform: scale(1.05);
                    box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.25);
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

                /* Responsive */
                @media (max-width: 1199px) {
                    .works-vertical-tabs {
                        margin-bottom: 40px;
                    }

                    .works-tab-btn {
                        padding: 1.25rem !important;
                    }

                    .about-top .row {
                        text-align: center;
                    }

                    .about-top .content p {
                        border-left: none !important;
                        padding-left: 0 !important;
                        margin-top: 15px;
                    }
                }

                @media (max-width: 767px) {
                    .works-tab-btn {
                        padding: 1rem !important;
                    }

                    .works-tab-btn .step-number {
                        width: 40px !important;
                        height: 40px !important;
                        font-size: 1.1rem !important;
                    }

                    .single-works-card {
                        padding: 1.5rem !important;
                    }

                    .single-works-card h3 {
                        font-size: 1.5rem !important;
                    }

                    .d-flex.flex-wrap.align-items-center.justify-content-between {
                        flex-direction: column;
                        text-align: center;
                    }
                }
            </style>

            <script>
                // Initialize Bootstrap Tabs with enhanced interaction
                document.addEventListener('DOMContentLoaded', function() {
                    const tabBtns = document.querySelectorAll('.works-tab-btn');
                    const progressStep = document.querySelector('.flex-grow-1 .h-100');
                    const stepText = document.querySelector('.small.text-white-50');

                    tabBtns.forEach((btn, index) => {
                        btn.addEventListener('click', function() {
                            // Remove active class from all
                            tabBtns.forEach(b => {
                                b.style.background = 'rgba(255,255,255,0.05)';
                                b.style.borderColor = 'rgba(255,255,255,0.1)';
                                b.classList.remove('active');

                                // Reset step number style
                                const stepNum = b.querySelector('.step-number');
                                if (stepNum) {
                                    stepNum.style.background = 'rgba(255,255,255,0.1)';
                                    stepNum.style.color = 'white';
                                    stepNum.style.borderColor = 'rgba(255,255,255,0.1)';
                                }

                                // Reset icon
                                const icon = b.querySelector('i.ri-arrow-right-up-line');
                                if (icon) {
                                    icon.style.color = 'white';
                                    icon.style.opacity = '0.5';
                                }
                            });

                            // Add active class to current
                            this.style.background = 'rgba(139,201,5,0.15)';
                            this.style.borderColor = 'rgba(139,201,5,0.4)';
                            this.classList.add('active');

                            // Update step number style
                            const stepNum = this.querySelector('.step-number');
                            if (stepNum) {
                                stepNum.style.background = 'rgba(139,201,5,0.2)';
                                stepNum.style.color = '#8BC905';
                                stepNum.style.borderColor = 'rgba(139,201,5,0.4)';
                            }

                            // Update icon
                            const icon = this.querySelector('i.ri-arrow-right-up-line');
                            if (icon) {
                                icon.style.color = '#8BC905';
                                icon.style.opacity = '1';
                            }

                            // Update progress indicator
                            const step = index + 1;
                            if (progressStep) {
                                progressStep.style.width = (step * 33.33) + '%';
                            }
                            if (stepText) {
                                stepText.innerText = 'Step ' + step + ' of 3';
                            }
                        });
                    });
                });
            </script>
            <!-- End How It Works Area -->



            <!-- Start Testimonials Area -->
            <!-- Start Testimonials Area - Premium Redesign -->
            <div class="testimonials-area py-5 py-md-6 overflow-hidden position-relative"
                style="background: linear-gradient(145deg, #ffffff, #f9fbf9);">

                <!-- Premium Decorative Elements -->
                <div class="position-absolute" style="top: -150px; right: -80px; width: 500px; height: 500px; border-radius: 50%; background: radial-gradient(circle, rgba(139,201,5,0.03) 0%, transparent 70%); pointer-events: none;"></div>
                <div class="position-absolute" style="bottom: -120px; left: -60px; width: 450px; height: 450px; border-radius: 50%; background: radial-gradient(circle, rgba(12,58,48,0.02) 0%, transparent 70%); pointer-events: none;"></div>

                <!-- Subtle Pattern Overlay -->
                <div class="position-absolute w-100 h-100 opacity-1"
                    style="top: 0; left: 0; background-image: radial-gradient(circle at 25px 25px, #8BC905 1px, transparent 1px); background-size: 50px 50px; opacity: 0.02; pointer-events: none;"></div>

                <div class="container position-relative" style="max-width: 1280px; margin: 0 auto; z-index: 5;">

                    <!-- ========================================= -->
                    <!-- SECTION HEADER - PREMIUM -->
                    <!-- ========================================= -->
                    <div class="about-top mb-5" data-cues="slideInUp" data-duration="800">
                        <div class="row g-4 align-items-end">
                            <div class="col-lg-5 col-md-7">
                                <div class="section-heading mb-0">
                                    <!-- Premium Badge -->
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <span class="badge px-4 py-2 rounded-pill fw-semibold d-inline-flex align-items-center gap-2"
                                            style="background: linear-gradient(145deg, #0C3A30, #0A2A23); color: white; border: 1px solid rgba(139,201,5,0.4); letter-spacing: 0.5px; box-shadow: 0 10px 20px -8px rgba(10,42,35,0.2);">
                                            <span style="display: inline-block; width: 8px; height: 8px; background: #8BC905; border-radius: 50%; box-shadow: 0 0 8px #8BC905; animation: pulse 2s infinite;"></span>
                                            TESTIMONIALS
                                        </span>
                                        <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2);">
                                            ⭐ 4.9/5 RATING
                                        </span>
                                    </div>

                                    <!-- Main Headline -->
                                    <h2 class="display-5 fw-bold mb-0" style="color: #0C3A30; line-height: 1.2; max-width: 500px;">
                                        Hear What Our
                                        <span style="color: #8BC905; position: relative; display: inline-block;">
                                            Clients
                                            <span class="position-absolute start-0 w-100" style="bottom: 0.1em; height: 8px; background: rgba(139,201,5,0.25); border-radius: 30px; z-index: -1;"></span>
                                        </span>
                                        Say About Us
                                    </h2>
                                </div>
                            </div>

                            <div class="col-lg-7 col-md-5">
                                <div class="content ps-lg-5">
                                    <p class="fs-5 text-secondary mb-0" style="color: #4A5C5A !important; line-height: 1.6; border-left: 4px solid #8BC905; padding-left: 20px;">
                                        Join 50,000+ individuals and businesses who trust us to move, manage, and grow their money every single day.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================= -->
                    <!-- MAIN CONTENT - LEFT IMAGE | RIGHT TESTIMONIALS -->
                    <!-- ========================================= -->
                    <div class="row g-5 align-items-stretch">

                        <!-- ========================================= -->
                        <!-- LEFT COLUMN - PREMIUM IMAGE SHOWCASE -->
                        <!-- ========================================= -->
                        <div class="col-lg-6 col-md-12" data-cues="slideInRight" data-duration="800">
                            <div class="testimonials-image h-100 position-relative p-3">
                                <div class="position-relative h-100 rounded-5 overflow-hidden"
                                    style="background: linear-gradient(145deg, #8BC905, #7AB805); box-shadow: 0 30px 50px -20px rgba(139,201,5,0.3);">

                                    <!-- Decorative Pattern -->
                                    <div class="position-absolute w-100 h-100 opacity-10"
                                        style="background-image: radial-gradient(circle at 20px 20px, rgba(255,255,255,0.3) 1px, transparent 1px); background-size: 30px 30px; pointer-events: none;"></div>

                                    <!-- Main Image -->
                                    <img class="w-100 h-100"
                                        src="assets/images/frontpage-pricing-d.webp"
                                        alt="Happy clients"
                                        style="object-fit: cover; mix-blend-mode: overlay; opacity: 0.9;">

                                    <!-- Gradient Overlay -->


                                    <!-- Floating Trust Badges -->
                                    <div class="position-absolute top-0 start-0 m-4" style="animation: float 6s ease-in-out infinite; z-index: 10;">
                                        <div class="d-flex align-items-center gap-2 bg-white/95 backdrop-blur rounded-pill py-3 px-4 shadow-lg">
                                            <i class="ri-user-heart-fill" style="color: #8BC905;"></i>
                                            <span class="fw-bold" style="color: #0C3A30;">50K+</span>
                                            <span class="text-secondary small">happy clients</span>
                                        </div>
                                    </div>

                                    <div class="position-absolute bottom-0 end-0 m-4" style="animation: float 7s ease-in-out infinite 1s; z-index: 10;">
                                        <div class="d-flex align-items-center gap-2 bg-white/95 backdrop-blur rounded-pill py-3 px-4 shadow-lg">
                                            <i class="ri-star-fill" style="color: #FFB800;"></i>
                                            <span class="fw-bold" style="color: #0C3A30;">4.9</span>
                                            <span class="text-secondary small">/ 5.0</span>
                                        </div>
                                    </div>

                                    <!-- Decorative Shapes -->
                                    <div class="position-absolute" style="top: 20%; left: 10%; animation: rotateSlow 20s linear infinite;">
                                        <img class="feature-shape-1" src="assets/images/shape/feature-shape-1.png" alt="shape" style="width: 60px; opacity: 0.6;">
                                    </div>
                                    <div class="position-absolute" style="bottom: 15%; right: 10%; animation: rotateSlow 25s linear infinite reverse;">
                                        <img class="feature-shape-2" src="assets/images/shape/feature-shape-1.png" alt="shape" style="width: 80px; opacity: 0.4;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ========================================= -->
                        <!-- RIGHT COLUMN - PREMIUM TESTIMONIAL CARDS -->
                        <!-- ========================================= -->
                        <div class="col-lg-6 col-md-12" data-cues="slideInLeft" data-duration="800">
                            <div class="testimonials-content d-flex flex-column gap-4 h-100">

                                <!-- TESTIMONIAL CARD 1 - Community Founder -->
                                <div class="testimonial-card-premium p-4 p-xl-5 rounded-4 position-relative"
                                    style="background: white; border: 1px solid rgba(139,201,5,0.1); box-shadow: 0 20px 40px -15px rgba(0,0,0,0.05); transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);">

                                    <!-- Decorative Quote Icon -->
                                    <div class="position-absolute top-0 end-0 m-4" style="z-index: 2;">
                                        <img class="right-quote" src="assets/images/svg/right-quote.svg" alt="quote" style="width: 48px; height: 48px; opacity: 0.2;">
                                    </div>

                                    <!-- Star Rating -->
                                    <div class="d-flex align-items-center gap-1 mb-3">
                                        <i class="flaticon-star-2" style="color: #FFB800; font-size: 1.4rem;"></i>
                                        <i class="flaticon-star-2" style="color: #FFB800; font-size: 1.4rem;"></i>
                                        <i class="flaticon-star-2" style="color: #FFB800; font-size: 1.4rem;"></i>
                                        <i class="flaticon-star-2" style="color: #FFB800; font-size: 1.4rem;"></i>
                                        <i class="flaticon-star-2" style="color: #FFB800; font-size: 1.4rem;"></i>
                                        <span class="ms-2 small fw-semibold" style="color: #0C3A30;">5.0</span>
                                    </div>

                                    <!-- Testimonial Text -->
                                    <p class="text-secondary mb-4" style="color: #4A5C5A !important; line-height: 1.7; font-size: 1.05rem; position: relative; z-index: 3;">
                                        "At MarketMind, we’re transforming the financial landscape with advanced trading and copy-trading technology. We bridge the gap between traditional markets and modern digital innovation — delivering a seamless, intelligent trading experience."
                                    </p>

                                    <!-- Author Info -->
                                    <div class="d-flex align-items-center justify-content-between mt-auto">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="position-relative">
                                                <img class="user-image-4 rounded-circle"
                                                    src="assets/images/user/user-image-4.jpg"
                                                    alt="Sarah Chen"
                                                    style="width: 64px; height: 64px; object-fit: cover; border: 3px solid white; box-shadow: 0 10px 20px -8px rgba(0,0,0,0.1);">
                                                <span class="position-absolute bottom-0 end-0 bg-success rounded-circle border-2 border-white"
                                                    style="width: 16px; height: 16px; background: #8BC905 !important;"></span>
                                            </div>
                                            <div>
                                                <h3 class="fw-bold mb-1" style="color: #0C3A30; font-size: 1.25rem;">Our Discord Community</h3>
                                                <span class="small text-secondary">CEO & Founder, MarketMind Community</span>
                                            </div>
                                        </div>
                                        <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2);">
                                            Discord
                                        </span>
                                    </div>

                                    <!-- Top Accent -->
                                    <div class="position-absolute top-0 start-0 w-100" style="height: 4px; background: linear-gradient(90deg, #8BC905, #0C3A30); border-radius: 4px 4px 0 0;"></div>
                                </div>

                                <!-- TESTIMONIAL CARD 2 - Investor -->
                                <div class="testimonial-card-premium p-4 p-xl-5 rounded-4 position-relative"
                                    style="background: white; border: 1px solid rgba(139,201,5,0.1); box-shadow: 0 20px 40px -15px rgba(0,0,0,0.05); transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);">

                                    <!-- Decorative Quote Icon -->
                                    <div class="position-absolute top-0 end-0 m-4" style="z-index: 2;">
                                        <img class="right-quote" src="assets/images/svg/right-quote.svg" alt="quote" style="width: 48px; height: 48px; opacity: 0.2;">
                                    </div>

                                    <!-- Star Rating -->
                                    <div class="d-flex align-items-center gap-1 mb-3">
                                        <i class="flaticon-star-2" style="color: #FFB800; font-size: 1.4rem;"></i>
                                        <i class="flaticon-star-2" style="color: #FFB800; font-size: 1.4rem;"></i>
                                        <i class="flaticon-star-2" style="color: #FFB800; font-size: 1.4rem;"></i>
                                        <i class="flaticon-star-2" style="color: #FFB800; font-size: 1.4rem;"></i>
                                        <i class="flaticon-star-2" style="color: #FFB800; font-size: 1.4rem;"></i>
                                        <span class="ms-2 small fw-semibold" style="color: #0C3A30;">5.0</span>
                                    </div>

                                    <!-- Testimonial Text -->
                                    <p class="text-secondary mb-4" style="color: #4A5C5A !important; line-height: 1.7; font-size: 1.05rem; position: relative; z-index: 3;">
                                        "I've been investing for over 15 years, and I've never seen a platform this intuitive. The Automated-powered insights alone have improved my returns by 23%. Finally, a trading company that actually delivers on its promises."
                                    </p>

                                    <!-- Author Info -->
                                    <div class="d-flex align-items-center justify-content-between mt-auto">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="position-relative">
                                                <img class="user-image-4 rounded-circle"
                                                    src="assets/images/user/user-image-5.jpg"
                                                    alt="Kevin M. Rueda"
                                                    style="width: 64px; height: 64px; object-fit: cover; border: 3px solid white; box-shadow: 0 10px 20px -8px rgba(0,0,0,0.1);">
                                                <span class="position-absolute bottom-0 end-0 bg-success rounded-circle border-2 border-white"
                                                    style="width: 16px; height: 16px; background: #8BC905 !important;"></span>
                                            </div>
                                            <div>
                                                <h3 class="fw-bold mb-1" style="color: #0C3A30; font-size: 1.25rem;">Kevin M. Rueda</h3>
                                                <span class="small text-secondary">Angel Investor • 15+ years</span>
                                            </div>
                                        </div>
                                        <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; border: 1px solid rgba(139,201,5,0.2);">
                                            ⚡ +23% returns
                                        </span>
                                    </div>

                                    <!-- Top Accent -->
                                    <div class="position-absolute top-0 start-0 w-100" style="height: 4px; background: linear-gradient(90deg, #0C3A30, #8BC905); border-radius: 4px 4px 0 0;"></div>
                                </div>

                                <!-- Trust Metrics Row -->
                                <div class="d-flex align-items-center justify-content-between p-3 rounded-4"
                                    style="background: rgba(139,201,5,0.04); border: 1px dashed rgba(139,201,5,0.2);">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle border-2 border-white" style="width: 36px; height: 36px; background: linear-gradient(145deg, #0C3A30, #0A2A23); margin-right: -10px;"></div>
                                            <div class="rounded-circle border-2 border-white" style="width: 36px; height: 36px; background: linear-gradient(145deg, #8BC905, #7AB805); margin-right: -10px;"></div>
                                            <div class="rounded-circle border-2 border-white" style="width: 36px; height: 36px; background: linear-gradient(145deg, #0C3A30, #0A2A23); margin-right: -10px;"></div>
                                            <div class="rounded-circle border-2 border-white" style="width: 36px; height: 36px; background: linear-gradient(145deg, #8BC905, #7AB805);"></div>
                                        </div>
                                        <span class="fw-semibold small" style="color: #0C3A30;">Trusted by 50K+</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        <i class="ri-shield-check-fill" style="color: #8BC905;"></i>
                                        <span class="small text-secondary">Verified reviews</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================= -->
                    <!-- BOTTOM PARTNER LOGOS / TRUST BADGES -->
                    <!-- ========================================= -->
                    <div class="row mt-5 pt-4" data-cues="slideInUp" data-duration="800">
                        <div class="col-12">
                            <div class="d-flex flex-wrap align-items-center justify-content-center gap-4 gap-xl-5 p-4 rounded-4"
                                style="background: white; border: 1px solid rgba(139,201,5,0.1); box-shadow: 0 10px 30px -10px rgba(0,0,0,0.03);">
                                <span class="small text-secondary fw-semibold">Featured on:</span>
                                <span style="color: #4A5C5A; font-weight: 600; opacity: 0.7;">MARKETMIND</span>
                                <span style="color: #4A5C5A; font-weight: 600; opacity: 0.7;">KRACKENN</span>
                                <span style="color: #4A5C5A; font-weight: 600; opacity: 0.7;">TRUSTWALLET</span>
                                <span style="color: #4A5C5A; font-weight: 600; opacity: 0.7;">BINANCE</span>
                                <span style="color: #4A5C5A; font-weight: 600; opacity: 0.7;">MT5 / MT4</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Testimonials Area - Premium Redesign -->

            <style>
                /* ============ PREMIUM TESTIMONIALS STYLES ============ */

                /* Animations */
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
                        transform: translateY(-10px);
                    }

                    100% {
                        transform: translateY(0px);
                    }
                }

                @keyframes rotateSlow {
                    0% {
                        transform: rotate(0deg);
                    }

                    100% {
                        transform: rotate(360deg);
                    }
                }

                /* Testimonial Card Hover */
                .testimonial-card-premium {
                    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
                    position: relative;
                    overflow: hidden;
                }

                .testimonial-card-premium:hover {
                    transform: translateY(-8px);
                    box-shadow: 0 30px 50px -15px rgba(139, 201, 5, 0.15) !important;
                    border-color: rgba(139, 201, 5, 0.3) !important;
                }

                .testimonial-card-premium:hover .right-quote {
                    transform: scale(1.1);
                    opacity: 0.3;
                }

                .testimonial-card-premium .right-quote {
                    transition: all 0.3s ease;
                }

                /* User Image Hover */
                .testimonial-card-premium:hover .user-image-4 {
                    transform: scale(1.05);
                    border-color: #8BC905 !important;
                }

                .user-image-4 {
                    transition: all 0.3s ease;
                }

                /* Left Image Container Hover */
                .testimonials-image .position-relative {
                    transition: all 0.5s ease;
                }

                .testimonials-image:hover .position-relative {
                    transform: scale(1.02);
                    box-shadow: 0 40px 70px -20px rgba(139, 201, 5, 0.4) !important;
                }

                /* Star Rating */
                .flaticon-star-2 {
                    transition: all 0.2s ease;
                }

                .testimonial-card-premium:hover .flaticon-star-2 {
                    transform: scale(1.1);
                }

                /* Floating Badges */
                .position-absolute .bg-white\/95 {
                    transition: all 0.3s ease;
                }

                .position-absolute .bg-white\/95:hover {
                    transform: scale(1.05);
                    box-shadow: 0 15px 30px -8px rgba(0, 0, 0, 0.15) !important;
                }

                /* Trust Metrics Row Hover */
                .d-flex.align-items-center.justify-content-between.p-3 {
                    transition: all 0.3s ease;
                }

                .d-flex.align-items-center.justify-content-between.p-3:hover {
                    background: rgba(139, 201, 5, 0.08) !important;
                    border-color: rgba(139, 201, 5, 0.3) !important;
                }

                .d-flex.align-items-center .rounded-circle {
                    transition: all 0.3s ease;
                }

                .d-flex.align-items-center:hover .rounded-circle {
                    transform: translateY(-3px);
                }

                /* Partner Logos Hover */
                .d-flex.flex-wrap span[style*="font-weight: 600"] {
                    transition: all 0.3s ease;
                    cursor: default;
                }

                .d-flex.flex-wrap span[style*="font-weight: 600"]:hover {
                    opacity: 1 !important;
                    color: #0C3A30 !important;
                    transform: translateY(-2px);
                }

                /* Responsive */
                @media (max-width: 991px) {
                    .about-top .row {
                        text-align: center;
                    }

                    .about-top .content p {
                        border-left: none !important;
                        padding-left: 0 !important;
                        margin-top: 15px;
                    }

                    .testimonials-image {
                        margin-bottom: 30px;
                        height: 400px !important;
                    }

                    .testimonials-content {
                        padding-left: 0 !important;
                    }
                }

                @media (max-width: 767px) {
                    .testimonial-card-premium {
                        padding: 1.5rem !important;
                    }

                    .d-flex.align-items-center.gap-3 {
                        flex-wrap: wrap;
                    }

                    .position-absolute.top-0.end-0.m-4 {
                        position: relative !important;
                        top: auto !important;
                        right: auto !important;
                        margin: 0 0 15px 0 !important;
                        text-align: right;
                    }

                    .testimonials-image {
                        height: 350px !important;
                    }

                    .d-flex.flex-wrap.align-items-center.justify-content-center.gap-4 {
                        flex-direction: column;
                        text-align: center;
                    }
                }

                /* Utilities */
                .backdrop-blur {
                    backdrop-filter: blur(10px);
                    -webkit-backdrop-filter: blur(10px);
                }

                .text-secondary {
                    color: #4A5C5A !important;
                }
            </style>
            <!-- End Testimonials Area -->

            <!-- Start Blog Area -->
            <!-- Start Blog Area - Premium Redesign -->
            <div class="blog-area py-5 py-md-6 overflow-hidden position-relative"
                style="background: linear-gradient(145deg, #ffffff, #f9fbf9);">

                <!-- Premium Decorative Elements -->
                <div class="position-absolute" style="top: -150px; left: -80px; width: 500px; height: 500px; border-radius: 50%; background: radial-gradient(circle, rgba(139,201,5,0.03) 0%, transparent 70%); pointer-events: none;"></div>
                <div class="position-absolute" style="bottom: -120px; right: -60px; width: 450px; height: 450px; border-radius: 50%; background: radial-gradient(circle, rgba(12,58,48,0.02) 0%, transparent 70%); pointer-events: none;"></div>

                <!-- Subtle Pattern Overlay -->
                <div class="position-absolute w-100 h-100 opacity-1"
                    style="top: 0; left: 0; background-image: linear-gradient(45deg, rgba(139,201,5,0.02) 25%, transparent 25%), linear-gradient(-45deg, rgba(139,201,5,0.02) 25%, transparent 25%); background-size: 30px 30px; pointer-events: none;"></div>

                <div class="container position-relative" style="max-width: 1280px; margin: 0 auto; z-index: 5;">

                    <!-- ========================================= -->
                    <!-- SECTION HEADER - PREMIUM -->
                    <!-- ========================================= -->
                    <div class="text-center mb-5" data-cues="slideInUp" data-duration="800">
                        <div class="d-flex justify-content-center mb-3">
                            <span class="badge px-4 py-2 rounded-pill fw-semibold d-inline-flex align-items-center gap-2"
                                style="background: linear-gradient(145deg, #0C3A30, #0A2A23); color: white; border: 1px solid rgba(139,201,5,0.4); letter-spacing: 0.5px; box-shadow: 0 10px 20px -8px rgba(10,42,35,0.2);">
                                <span style="display: inline-block; width: 8px; height: 8px; background: #8BC905; border-radius: 50%; box-shadow: 0 0 8px #8BC905; animation: pulse 2s infinite;"></span>
                                LATEST INSIGHTS
                            </span>
                        </div>

                        <h2 class="display-5 fw-bold mb-3 mx-auto" style="color: #0C3A30; max-width: 700px; line-height: 1.2;">
                            Smart Tools For
                            <span style="color: #8BC905; position: relative; display: inline-block;">
                                Creative
                                <span class="position-absolute start-0 w-100" style="bottom: 0.1em; height: 8px; background: rgba(139,201,5,0.25); border-radius: 30px; z-index: -1;"></span>
                            </span>
                            Financial Planning
                        </h2>

                        <p class="fs-5 text-secondary mx-auto" style="color: #4A5C5A !important; max-width: 600px; line-height: 1.6;">
                            Expert insights, guides, and strategies to help you make smarter financial decisions
                        </p>
                    </div>

                    <!-- ========================================= -->
                    <!-- BLOG GRID - MIXED LAYOUT (2 HORIZONTAL + 1 VERTICAL) -->
                    <!-- ========================================= -->
                    <div class="row g-4" data-cues="slideInUp" data-duration="800">

                        <!-- ========================================= -->
                        <!-- LEFT COLUMN - 2 HORIZONTAL CARDS -->
                        <!-- ========================================= -->
                        <div class="col-xl-6 col-lg-12 col-md-12">
                            <div class="d-flex flex-column gap-4 h-100">

                                <!-- BLOG CARD 1 - Horizontal -->
                                <div class="blog-card-horizontal d-flex flex-column flex-md-row align-items-stretch overflow-hidden rounded-4 w-100"
                                    style="background: white; border: 1px solid rgba(139,201,5,0.1); box-shadow: 0 15px 30px -10px rgba(0,0,0,0.05); transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);">

                                    <!-- Image Container -->
                                    <div class="blog-image-wrapper position-relative" style="flex: 0 0 40%; min-height: 220px;">
                                        <a href="/" class="d-block h-100 w-100">
                                            <img src="assets/images/blog/blog-image-1.jpg"
                                                alt="Insurance Contract Guide"
                                                style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;"
                                                class="blog-image-hover">
                                        </a>
                                        <!-- Category Badge -->
                                        <span class="position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill small fw-semibold"
                                            style="background: rgba(139,201,5,0.9); color: #0C3A30; backdrop-filter: blur(5px); z-index: 2;">
                                            Insurance
                                        </span>
                                    </div>

                                    <!-- Content -->
                                    <div class="blog-card-body p-4 p-xl-4 d-flex flex-column flex-grow-1" style="flex: 1;">
                                        <!-- Meta -->
                                        <div class="d-flex align-items-center gap-3 mb-2">
                                            <span class="small d-flex align-items-center gap-1 text-secondary">
                                                <i class="ri-calendar-2-line" style="color: #8BC905;"></i>
                                                {{ \Carbon\Carbon::now()->format('M d, Y') }}
                                            </span>
                                            <span class="small d-flex align-items-center gap-1 text-secondary">
                                                <i class="ri-message-line" style="color: #8BC905;"></i>
                                                0 Comments
                                            </span>
                                            <span class="badge px-2 py-1 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; font-size: 0.7rem;">
                                                5 min read
                                            </span>
                                        </div>

                                        <!-- Title -->
                                        <h3 class="fw-bold mb-2" style="color: #0C3A30; font-size: 1.35rem; line-height: 1.4;">
                                            <a href="/" class="text-decoration-none" style="color: #0C3A30; transition: color 0.2s;">
                                                How To Easily Understand Your Trading Strategy
                                            </a>
                                        </h3>

                                        <!-- Excerpt -->
                                        <p class="text-secondary mb-3 small" style="color: #4A5C5A !important; line-height: 1.6;">
                                            Know exactly how your capital is managed, how returns are calculated, and what risks are involved clearly explained, zero guesswork.
                                        </p>

                                        <!-- Read More -->
                                        <a href="/" class="read-more d-inline-flex align-items-center gap-2 fw-semibold text-decoration-none mt-auto"
                                            style="color: #8BC905; transition: all 0.3s ease;">
                                            Read Article
                                            <span class="rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 28px; height: 28px; background: rgba(139,201,5,0.1); color: #8BC905; transition: all 0.3s ease;">
                                                <i class="ri-arrow-right-up-line"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>

                                <!-- BLOG CARD 2 - Horizontal -->
                                <div class="blog-card-horizontal d-flex flex-column flex-md-row align-items-stretch overflow-hidden rounded-4 w-100"
                                    style="background: white; border: 1px solid rgba(139,201,5,0.1); box-shadow: 0 15px 30px -10px rgba(0,0,0,0.05); transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);">

                                    <!-- Image Container -->
                                    <div class="blog-image-wrapper position-relative" style="flex: 0 0 40%; min-height: 220px;">
                                        <a href="/" class="d-block h-100 w-100">
                                            <img src="assets/images/blog/blog-image-2.jpg"
                                                alt="Financial Responsibility"
                                                style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;"
                                                class="blog-image-hover">
                                        </a>
                                        <!-- Category Badge -->
                                        <span class="position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill small fw-semibold"
                                            style="background: rgba(139,201,5,0.9); color: #0C3A30; backdrop-filter: blur(5px); z-index: 2;">
                                            Finance 101
                                        </span>
                                    </div>

                                    <!-- Content -->
                                    <div class="blog-card-body p-4 p-xl-4 d-flex flex-column flex-grow-1" style="flex: 1;">
                                        <!-- Meta -->
                                        <div class="d-flex align-items-center gap-3 mb-2">
                                            <span class="small d-flex align-items-center gap-1 text-secondary">
                                                <i class="ri-calendar-2-line" style="color: #8BC905;"></i>
                                                {{ \Carbon\Carbon::now()->format('M d, Y') }}
                                            </span>
                                            <span class="small d-flex align-items-center gap-1 text-secondary">
                                                <i class="ri-message-line" style="color: #8BC905;"></i>
                                                3 Comments
                                            </span>
                                            <span class="badge px-2 py-1 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; font-size: 0.7rem;">
                                                4 min read
                                            </span>
                                        </div>

                                        <!-- Title -->
                                        <h3 class="fw-bold mb-2" style="color: #0C3A30; font-size: 1.35rem; line-height: 1.4;">
                                            <a href="/" class="text-decoration-none" style="color: #0C3A30; transition: color 0.2s;">
                                                The Foundations of Smart Trading
                                            </a>
                                        </h3>

                                        <!-- Excerpt -->
                                        <p class="text-secondary mb-3 small" style="color: #4A5C5A !important; line-height: 1.6;">
                                            Master the core principles of capital management, risk control, and disciplined investing built for new traders.
                                        </p>

                                        <!-- Read More -->
                                        <a href="/" class="read-more d-inline-flex align-items-center gap-2 fw-semibold text-decoration-none mt-auto"
                                            style="color: #8BC905; transition: all 0.3s ease;">
                                            Read Article
                                            <span class="rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 28px; height: 28px; background: rgba(139,201,5,0.1); color: #8BC905; transition: all 0.3s ease;">
                                                <i class="ri-arrow-right-up-line"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ========================================= -->
                        <!-- RIGHT COLUMN - 1 VERTICAL FEATURED CARD -->
                        <!-- ========================================= -->
                        <div class="col-xl-6 col-lg-12 col-md-12">
                            <div class="blog-card-vertical h-100 w-100 overflow-hidden rounded-4 d-flex flex-column"
                                style="background: white; border: 1px solid rgba(139,201,5,0.1); box-shadow: 0 20px 40px -15px rgba(0,0,0,0.08); transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);">

                                <!-- Featured Badge -->
                                <span class="position-absolute top-0 end-0 m-4 px-4 py-2 rounded-pill fw-semibold d-inline-flex align-items-center gap-2"
                                    style="background: linear-gradient(145deg, #8BC905, #7AB805); color: #0C3A30; border: none; box-shadow: 0 10px 20px -8px rgba(139,201,5,0.3); z-index: 10;">
                                    <span style="display: inline-block; width: 8px; height: 8px; background: #0C3A30; border-radius: 50%; animation: pulse 2s infinite;"></span>
                                    FEATURED
                                </span>

                                <!-- Image Container -->
                                <div class="blog-image-vertical-wrapper position-relative w-100" style="height: 260px;">
                                    <a href="/" class="d-block h-100 w-100">
                                        <img src="assets/images/blog/blog-image-3.jpg"
                                            alt="Financial Management"
                                            style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);"
                                            class="blog-image-hover">
                                    </a>
                                    <!-- Gradient Overlay -->
                                    <div class="position-absolute bottom-0 start-0 w-100 p-3"
                                        style="background: linear-gradient(to top, rgba(12,58,48,0.8), transparent);">
                                        <span class="badge px-3 py-2 rounded-pill" style="background: rgba(255,255,255,0.9); color: #0C3A30;">
                                            <i class="ri-trending-up-fill me-1" style="color: #8BC905;"></i>
                                            Trending Now
                                        </span>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="single-blog-card-body p-4 p-xl-5 d-flex flex-column flex-grow-1">
                                    <!-- Meta -->
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <span class="small d-flex align-items-center gap-1 text-secondary">
                                            <i class="ri-calendar-2-line" style="color: #8BC905;"></i>
                                            {{ \Carbon\Carbon::now()->format('M d, Y') }}
                                        </span>
                                        <span class="small d-flex align-items-center gap-1 text-secondary">
                                            <i class="ri-message-line" style="color: #8BC905;"></i>
                                            12 Comments
                                        </span>
                                        <span class="badge px-2 py-1 rounded-pill" style="background: rgba(139,201,5,0.1); color: #8BC905; font-size: 0.7rem;">
                                            7 min read
                                        </span>
                                    </div>

                                    <!-- Title -->
                                    <h3 class="fw-bold mb-3" style="color: #0C3A30; font-size: 1.65rem; line-height: 1.3;">
                                        <a href="/" class="text-decoration-none" style="color: #0C3A30; transition: color 0.2s;">
                                            Smart Trading Strategies: The Edge Every Investor Needs
                                        </a>
                                    </h3>


                                    <!-- Excerpt -->
                                    <p class="text-secondary mb-4" style="color: #4A5C5A !important; line-height: 1.7;">
                                        We’re transforming how traders approach the markets. From precision copy trading to advanced risk management and AI-powered market insights — discover the strategies that separate consistent earners from the crowd.
                                    </p>


                                    <!-- Author & Read More -->
                                    <!-- <div class="d-flex align-items-center justify-content-between mt-auto">
                            <div class="d-flex align-items-center gap-3">
                                <div class="position-relative">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                         style="width: 44px; height: 44px; background: linear-gradient(145deg, #0C3A30, #0A2A23); color: white; font-weight: 600;">
                                        MD
                                    </div>
                                    <span class="position-absolute bottom-0 end-0 bg-success rounded-circle border-2 border-white" 
                                          style="width: 12px; height: 12px; background: #8BC905 !important;"></span>
                                </div>
                                <div>
                                    <span class="small text-secondary d-block">Written by</span>
                                    <span class="fw-semibold small" style="color: #0C3A30;">Michael Chen</span>
                                </div>
                            </div>
                            
                            <a href="/" class="read-more d-inline-flex align-items-center gap-2 fw-semibold text-decoration-none"
                               style="color: #8BC905; transition: all 0.3s ease;">
                                Read Article
                                <span class="rounded-circle d-flex align-items-center justify-content-center" 
                                      style="width: 32px; height: 32px; background: rgba(139,201,5,0.1); color: #8BC905; transition: all 0.3s ease;">
                                    <i class="ri-arrow-right-up-line"></i>
                                </span>
                            </a>
                        </div> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================= -->
                    <!-- BOTTOM CTA - VIEW ALL ARTICLES -->
                    <!-- ========================================= -->
                    <div class="text-center mt-5 pt-4" data-cues="slideInUp" data-duration="800">
                        <div class="d-flex justify-content-center">
                            <a href="{{('login')}}"
                                class="btn btn-lg px-5 py-3 rounded-pill fw-bold d-inline-flex align-items-center gap-3"
                                style="background: white; color: #0C3A30; border: 2px solid rgba(139,201,5,0.2); box-shadow: 0 15px 25px -8px rgba(0,0,0,0.05); transition: all 0.3s ease;">
                                <span>View All Articles</span>
                                <span class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 32px; height: 32px; background: rgba(139,201,5,0.1); color: #8BC905; transition: all 0.3s ease;">
                                    <i class="ri-arrow-right-line"></i>
                                </span>
                            </a>
                        </div>
                        <p class="small text-secondary mt-3" style="color: #4A5C5A !important;">
                            📚 50+ articles on personal finance, investing, and wealth management
                        </p>
                    </div>
                </div>
            </div>
            <!-- End Blog Area - Premium Redesign -->

            <style>
                /* ============ PREMIUM BLOG STYLES ============ */

                /* Animations */
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

                /* Blog Card Hover Effects */
                .blog-card-horizontal,
                .blog-card-vertical {
                    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
                    position: relative;
                    overflow: hidden;
                }

                .blog-card-horizontal:hover,
                .blog-card-vertical:hover {
                    transform: translateY(-8px);
                    box-shadow: 0 30px 50px -15px rgba(139, 201, 5, 0.15) !important;
                    border-color: rgba(139, 201, 5, 0.3) !important;
                }

                /* Image Hover */
                .blog-image-hover {
                    transition: transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
                }

                .blog-image-wrapper:hover .blog-image-hover,
                .blog-image-vertical-wrapper:hover .blog-image-hover {
                    transform: scale(1.08);
                }

                /* Title Hover */
                h3 a:hover {
                    color: #8BC905 !important;
                    text-decoration: underline;
                    text-decoration-color: rgba(139, 201, 5, 0.3);
                    text-underline-offset: 4px;
                }

                /* Read More Hover */
                .read-more {
                    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                }

                .read-more:hover {
                    gap: 12px !important;
                }

                .read-more:hover span {
                    background: #8BC905 !important;
                    color: white !important;
                    transform: translateX(4px);
                }

                .read-more span {
                    transition: all 0.3s ease;
                }

                /* Category Badge */
                .position-absolute.top-0.start-0.m-3 {
                    transition: all 0.3s ease;
                    backdrop-filter: blur(5px);
                    -webkit-backdrop-filter: blur(5px);
                }

                .blog-card-horizontal:hover .position-absolute.top-0.start-0.m-3,
                .blog-card-vertical:hover .position-absolute.top-0.end-0.m-4 {
                    transform: scale(1.05);
                }

                /* Meta Icons */
                .ri-calendar-2-line,
                .ri-message-line {
                    transition: all 0.2s ease;
                }

                .blog-card-horizontal:hover .ri-calendar-2-line,
                .blog-card-vertical:hover .ri-calendar-2-line,
                .blog-card-horizontal:hover .ri-message-line,
                .blog-card-vertical:hover .ri-message-line {
                    transform: scale(1.1);
                    color: #0C3A30 !important;
                }

                /* Author Avatar */
                .rounded-circle.d-flex.align-items-center.justify-content-center {
                    transition: all 0.3s ease;
                }

                .blog-card-vertical:hover .rounded-circle.d-flex.align-items-center.justify-content-center {
                    transform: scale(1.1);
                    background: #8BC905 !important;
                }

                /* View All Button Hover */
                .btn-outline-accent:hover {
                    background: rgba(139, 201, 5, 0.05) !important;
                    border-color: #8BC905 !important;
                    transform: translateY(-3px);
                    box-shadow: 0 20px 30px -10px rgba(139, 201, 5, 0.15) !important;
                }

                .btn-outline-accent:hover span:last-child {
                    background: #8BC905 !important;
                    color: white !important;
                    transform: translateX(4px);
                }

                /* Responsive */
                @media (max-width: 767px) {
                    .blog-card-horizontal {
                        flex-direction: column !important;
                    }

                    .blog-image-wrapper {
                        flex: 0 0 200px !important;
                        min-height: 200px !important;
                    }

                    .blog-card-vertical {
                        margin-top: 1rem;
                    }

                    h2.display-5 {
                        font-size: 2rem;
                    }

                    .blog-card-body h3 {
                        font-size: 1.2rem !important;
                    }

                    .single-blog-card-body h3 {
                        font-size: 1.4rem !important;
                    }

                    .position-absolute.top-0.end-0.m-4 {
                        position: relative !important;
                        top: auto !important;
                        right: auto !important;
                        margin: 1rem !important;
                        display: inline-block;
                        width: fit-content;
                    }
                }

                @media (min-width: 768px) and (max-width: 991px) {
                    .blog-image-wrapper {
                        min-height: 240px !important;
                    }

                    .blog-card-vertical {
                        margin-top: 0;
                    }
                }

                /* Utilities */
                .text-secondary {
                    color: #4A5C5A !important;
                }

                .bg-color-edf1ee {
                    background-color: #edf1ee;
                }
            </style>
            <!-- End Blog Area -->

            <!-- Start Faq Area -->
            <!-- Start Faq Area - Premium Redesign -->
            <div class="faq-area py-5 py-md-6 overflow-hidden position-relative"
                style="background: linear-gradient(145deg, #ffffff, #f8fafc);">

                <!-- Premium Decorative Elements - Trading Inspired -->
                <div class="position-absolute" style="top: -100px; right: -50px; width: 500px; height: 500px; border-radius: 50%; background: radial-gradient(circle, rgba(139,201,5,0.03) 0%, transparent 70%);"></div>
                <div class="position-absolute" style="bottom: -80px; left: -40px; width: 450px; height: 450px; border-radius: 50%; background: radial-gradient(circle, rgba(12,58,48,0.02) 0%, transparent 70%);"></div>

                <!-- Subtle Chart Pattern Overlay -->
                <div class="position-absolute w-100 h-100 opacity-1"
                    style="top: 0; left: 0; background-image: url('data:image/svg+xml,%3Csvg width=\" 60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cpath d=\"M0 30 L60 30 M30 0 L30 60 M15 15 L45 45 M45 15 L15 45\" stroke=\"%238BC905\" stroke-width=\"0.5\" opacity=\"0.1\" /%3E%3C/svg%3E'); background-size: 40px 40px; pointer-events: none;"></div>

                <div class="container position-relative" style="max-width: 1280px; margin: 0 auto; z-index: 5;">
                    <div class="row g-5 align-items-center">

                        <!-- ========================================= -->
                        <!-- LEFT COLUMN - PREMIUM FAQ IMAGE CARD -->
                        <!-- ========================================= -->
                        <div class="col-lg-6 col-md-12" data-cues="slideInRight" data-duration="800">
                            <div class="question-card-premium position-relative p-4 p-xl-5 rounded-5 h-100 d-flex flex-column"
                                style="background: linear-gradient(145deg, #0C3A30, #0A2A23); border: 1px solid rgba(139,201,5,0.2); box-shadow: 0 30px 50px -20px rgba(12,58,48,0.3);">

                                <!-- Decorative Pattern - Candlestick Inspired -->
                                <div class="position-absolute w-100 h-100 opacity-5"
                                    style="top: 0; left: 0; background-image: radial-gradient(circle at 20px 20px, rgba(139,201,5,0.1) 2px, transparent 2px); background-size: 40px 40px; pointer-events: none;"></div>

                                <!-- Glowing Orb -->
                                <div class="position-absolute" style="top: -50px; right: -30px; width: 200px; height: 200px; border-radius: 50%; background: radial-gradient(circle, rgba(139,201,5,0.15) 0%, transparent 70%); filter: blur(40px);"></div>

                                <!-- Section Header -->
                                <div class="section-heading position-relative" style="z-index: 10;">
                                    <!-- Premium Badge -->
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <span class="badge px-4 py-2 rounded-pill fw-semibold d-inline-flex align-items-center gap-2"
                                            style="background: rgba(139,201,5,0.15); color: #8BC905; border: 1px solid rgba(139,201,5,0.3); backdrop-filter: blur(5px); letter-spacing: 0.5px;">
                                            <span style="display: inline-block; width: 8px; height: 8px; background: #8BC905; border-radius: 50%; box-shadow: 0 0 15px #8BC905; animation: pulse 2s infinite;"></span>
                                            FAQ — TRADING BASICS
                                        </span>
                                        <span class="badge px-3 py-2 rounded-pill" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.1);">
                                            <i class="ri-funds-line me-1"></i> 5 min read
                                        </span>
                                    </div>

                                    <!-- Main Headline -->
                                    <h2 class="display-5 fw-bold mb-3 text-white" style="line-height: 1.2; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                        Frequently
                                        <span style="color: #8BC905; position: relative; display: inline-block;">
                                            Asked
                                            <span class="position-absolute start-0 w-100" style="bottom: 0.1em; height: 8px; background: rgba(139,201,5,0.3); border-radius: 30px; filter: blur(2px);"></span>
                                        </span>
                                        Questions
                                    </h2>

                                    <!-- Description -->
                                    <p class="text-white-80 mb-4" style="line-height: 1.7; max-width: 450px;">
                                        Get answers about trading, account security, fees, and how our AI-powered platform helps you make smarter investment decisions.
                                    </p>
                                </div>

                                <!-- Premium Image with Overlay -->
                                <div class="position-relative mt-auto rounded-4 overflow-hidden" style="z-index: 10; border: 1px solid rgba(139,201,5,0.2);">
                                    <img class="w-100 hover-zoom"
                                        src="assets/images/blog/blog-image-4.jpg"
                                        alt="Trading platform FAQ"
                                        style="display: block; transition: transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1); aspect-ratio: 16/9; object-fit: cover;">

                                    <!-- Gradient Overlay -->
                                    <div class="position-absolute bottom-0 start-0 w-100 p-3 d-flex align-items-center gap-2"
                                        style="background: linear-gradient(to top, rgba(12,58,48,0.95), transparent);">
                                        <span class="d-flex align-items-center gap-2">
                                            <span style="display: inline-block; width: 10px; height: 10px; background: #8BC905; border-radius: 50%; box-shadow: 0 0 15px #8BC905; animation: pulse 2s infinite;"></span>
                                            <span class="small text-white fw-semibold">LIVE SUPPORT 24/7</span>
                                        </span>
                                        <span class="ms-auto text-white-50 small">
                                            <i class="ri-customer-service-line"></i> Chat now
                                        </span>
                                    </div>
                                </div>

                                <!-- Market Stats Ticker -->
                                <div class="d-flex align-items-center gap-3 mt-3">
                                    <span class="small text-white-50"><i class="ri-funds-box-line" style="color: #8BC905;"></i> BTC $67,432</span>
                                    <span class="small text-white-50"><i class="ri-funds-box-line" style="color: #8BC905;"></i> ETH $3,245</span>
                                    <span class="small text-white-50"><i class="ri-funds-box-line" style="color: #8BC905;"></i> S&P 5,234</span>
                                </div>
                            </div>
                        </div>

                        <!-- ========================================= -->
                        <!-- RIGHT COLUMN - PREMIUM ACCORDION FAQ -->
                        <!-- ========================================= -->
                        <div class="col-lg-6 col-md-12" data-cues="slideInLeft" data-duration="800">
                            <div class="faq-content-premium ps-lg-4">
                                <div class="accordion-premium d-flex flex-column gap-3" id="accordionFAQ">

                                    <!-- FAQ ITEM 1 - Trading Focused -->
                                    <div class="accordion-item-premium rounded-4 p-4"
                                        style="background: white; border: 1px solid rgba(139,201,5,0.1); box-shadow: 0 10px 25px -10px rgba(0,0,0,0.05); transition: all 0.3s ease;">
                                        <button class="accordion-button-premium d-flex align-items-center justify-content-between w-100 border-0 bg-transparent collapsed"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseTrading1"
                                            aria-expanded="false"
                                            style="color: #0C3A30; font-weight: 600; font-size: 1.1rem;">
                                            <span class="d-flex align-items-center gap-3">
                                                <span class="d-flex align-items-center justify-content-center rounded-circle"
                                                    style="width: 32px; height: 32px; background: rgba(139,201,5,0.1); color: #8BC905; font-weight: 700;">01</span>
                                                Why should I trade with MarketMind AI?
                                            </span>
                                            <span class="accordion-icon rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 32px; height: 32px; background: rgba(139,201,5,0.1); color: #8BC905; transition: all 0.3s ease;">
                                                <i class="ri-add-line" style="font-weight: bold;"></i>
                                            </span>
                                        </button>
                                        <div id="collapseTrading1" class="accordion-collapse collapse show" data-bs-parent="#accordionFAQ">
                                            <div class="accordion-body pt-3 ps-5">
                                                <p class="text-secondary mb-0" style="color: #4A5C5A !important; line-height: 1.7;">
                                                    Our AI-powered execution engine analyzes market patterns in real-time, helping you identify opportunities faster. Zero commission trading, institutional-grade security, and personalized strategies based on your risk profile. Join 50,000+ traders already using our platform.
                                                </p>
                                                <div class="d-flex align-items-center gap-3 mt-3">
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.08); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">
                                                        ⚡ 0% commission
                                                    </span>
                                                    <span class="badge px-3 py-2 rounded-pill" style="background: rgba(139,201,5,0.08); color: #0C3A30; border: 1px solid rgba(139,201,5,0.15);">
                                                        🔒 insured up to $500K
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- FAQ ITEM 2 - Investment Types -->
                                    <div class="accordion-item-premium rounded-4 p-4"
                                        style="background: white; border: 1px solid rgba(139,201,5,0.1); box-shadow: 0 10px 25px -10px rgba(0,0,0,0.05); transition: all 0.3s ease;">
                                        <button class="accordion-button-premium d-flex align-items-center justify-content-between w-100 border-0 bg-transparent collapsed"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseTrading2"
                                            aria-expanded="false"
                                            style="color: #0C3A30; font-weight: 600; font-size: 1.1rem;">
                                            <span class="d-flex align-items-center gap-3">
                                                <span class="d-flex align-items-center justify-content-center rounded-circle"
                                                    style="width: 32px; height: 32px; background: rgba(139,201,5,0.1); color: #8BC905; font-weight: 700;">02</span>
                                                What can I invest in on your platform?
                                            </span>
                                            <span class="accordion-icon rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 32px; height: 32px; background: rgba(139,201,5,0.1); color: #8BC905; transition: all 0.3s ease;">
                                                <i class="ri-add-line" style="font-weight: bold;"></i>
                                            </span>
                                        </button>
                                        <div id="collapseTrading2" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                                            <div class="accordion-body pt-3 ps-5">
                                                <p class="text-secondary mb-3" style="color: #4A5C5A !important; line-height: 1.7;">
                                                    Stocks, ETFs, crypto, forex, commodities, and our exclusive AI-managed portfolios. Access global markets from a single dashboard:
                                                </p>
                                                <ul class="list-unstyled d-flex flex-wrap gap-2">
                                                    <li class="d-flex align-items-center gap-2">
                                                        <i class="ri-checkbox-circle-fill" style="color: #8BC905;"></i>
                                                        <span class="small">US Stocks</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-2">
                                                        <i class="ri-checkbox-circle-fill" style="color: #8BC905;"></i>
                                                        <span class="small">Crypto (50+)</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-2">
                                                        <i class="ri-checkbox-circle-fill" style="color: #8BC905;"></i>
                                                        <span class="small">Forex pairs</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-2">
                                                        <i class="ri-checkbox-circle-fill" style="color: #8BC905;"></i>
                                                        <span class="small">ETFs</span>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-2">
                                                        <i class="ri-checkbox-circle-fill" style="color: #8BC905;"></i>
                                                        <span class="small">AI Portfolios</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- FAQ ITEM 3 - Fees & Commissions -->
                                    <div class="accordion-item-premium rounded-4 p-4"
                                        style="background: white; border: 1px solid rgba(139,201,5,0.1); box-shadow: 0 10px 25px -10px rgba(0,0,0,0.05); transition: all 0.3s ease;">
                                        <button class="accordion-button-premium d-flex align-items-center justify-content-between w-100 border-0 bg-transparent collapsed"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseTrading3"
                                            aria-expanded="false"
                                            style="color: #0C3A30; font-weight: 600; font-size: 1.1rem;">
                                            <span class="d-flex align-items-center gap-3">
                                                <span class="d-flex align-items-center justify-content-center rounded-circle"
                                                    style="width: 32px; height: 32px; background: rgba(139,201,5,0.1); color: #8BC905; font-weight: 700;">03</span>
                                                What are your trading fees?
                                            </span>
                                            <span class="accordion-icon rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 32px; height: 32px; background: rgba(139,201,5,0.1); color: #8BC905; transition: all 0.3s ease;">
                                                <i class="ri-add-line" style="font-weight: bold;"></i>
                                            </span>
                                        </button>
                                        <div id="collapseTrading3" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                                            <div class="accordion-body pt-3 ps-5">
                                                <p class="text-secondary mb-0" style="color: #4A5C5A !important; line-height: 1.7;">
                                                    0% commission on stocks and ETFs. Crypto spreads from 0.1%. Forex from 0.0 pips. No hidden fees, no account minimums. Premium AI strategies start at just $10/month.
                                                </p>
                                                <div class="mt-3 p-3 rounded-3" style="background: rgba(139,201,5,0.04); border: 1px dashed rgba(139,201,5,0.2);">
                                                    <span class="small fw-semibold" style="color: #0C3A30;">💰 Save an average of $347/year compared to traditional brokers</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- FAQ ITEM 4 - Security -->
                                    <div class="accordion-item-premium rounded-4 p-4"
                                        style="background: white; border: 1px solid rgba(139,201,5,0.1); box-shadow: 0 10px 25px -10px rgba(0,0,0,0.05); transition: all 0.3s ease;">
                                        <button class="accordion-button-premium d-flex align-items-center justify-content-between w-100 border-0 bg-transparent collapsed"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseTrading4"
                                            aria-expanded="false"
                                            style="color: #0C3A30; font-weight: 600; font-size: 1.1rem;">
                                            <span class="d-flex align-items-center gap-3">
                                                <span class="d-flex align-items-center justify-content-center rounded-circle"
                                                    style="width: 32px; height: 32px; background: rgba(139,201,5,0.1); color: #8BC905; font-weight: 700;">04</span>
                                                How secure is my money?
                                            </span>
                                            <span class="accordion-icon rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 32px; height: 32px; background: rgba(139,201,5,0.1); color: #8BC905; transition: all 0.3s ease;">
                                                <i class="ri-add-line" style="font-weight: bold;"></i>
                                            </span>
                                        </button>
                                        <div id="collapseTrading4" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                                            <div class="accordion-body pt-3 ps-5">
                                                <p class="text-secondary mb-0" style="color: #4A5C5A !important; line-height: 1.7;">
                                                    Bank-grade 256-bit encryption, biometric authentication, and cold storage for crypto assets. Insured up to $500K through our partners. Regulated in multiple jurisdictions.
                                                </p>
                                                <div class="d-flex align-items-center gap-2 mt-3">
                                                    <i class="ri-shield-check-fill" style="color: #8BC905;"></i>
                                                    <span class="small">ISO 27001 certified</span>
                                                    <span class="mx-2">•</span>
                                                    <i class="ri-shield-check-fill" style="color: #8BC905;"></i>
                                                    <span class="small">PCI DSS compliant</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Still Have Questions? -->
                                <div class="d-flex align-items-center justify-content-between mt-4 pt-3 p-4 rounded-4"
                                    style="background: rgba(139,201,5,0.04); border: 1px solid rgba(139,201,5,0.1);">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle p-3" style="background: rgba(139,201,5,0.1);">
                                            <i class="ri-question-line fs-4" style="color: #8BC905;"></i>
                                        </div>
                                        <div>
                                            <span class="fw-semibold d-block" style="color: #0C3A30;">Still have questions?</span>
                                            <span class="small text-secondary">Our support team is online 24/7</span>
                                        </div>
                                    </div>
                                    <a href="#" class="btn px-4 py-2 rounded-pill fw-semibold"
                                        style="background: #8BC905; color: #0C3A30; border: none;">
                                        Chat Now <i class="ri-arrow-right-up-line ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Faq Area - Premium Redesign -->

            <!-- Start App Area - Premium Redesign -->
            <div class="app-area py-5 py-md-6 overflow-hidden position-relative"
                style="background: linear-gradient(145deg, #f8fafc, #ffffff);">

                <!-- Premium Decorative Elements -->
                <div class="position-absolute" style="top: -120px; left: -60px; width: 500px; height: 500px; border-radius: 50%; background: radial-gradient(circle, rgba(139,201,5,0.03) 0%, transparent 70%);"></div>
                <div class="position-absolute" style="bottom: -100px; right: -50px; width: 450px; height: 450px; border-radius: 50%; background: radial-gradient(circle, rgba(12,58,48,0.02) 0%, transparent 70%);"></div>

                <div class="container position-relative" style="max-width: 1280px; margin: 0 auto; z-index: 5;">
                    <div class="download-area-premium rounded-5 p-4 p-xl-5 position-relative overflow-hidden"
                        style="background: linear-gradient(145deg, #0C3A30, #062018); border: 1px solid rgba(139,201,5,0.2); box-shadow: 0 30px 60px -20px rgba(12,58,48,0.4);">

                        <!-- Animated Grid Pattern -->
                        <div class="position-absolute w-100 h-100 opacity-5"
                            style="top: 0; left: 0; background-image: radial-gradient(circle at 30px 30px, rgba(139,201,5,0.15) 1px, transparent 1px); background-size: 40px 40px; pointer-events: none; animation: drift 30s infinite linear;"></div>

                        <!-- Glowing Orbs -->
                        <div class="position-absolute" style="top: -80px; right: -40px; width: 300px; height: 300px; border-radius: 50%; background: radial-gradient(circle, rgba(139,201,5,0.12) 0%, transparent 70%); filter: blur(50px);"></div>
                        <div class="position-absolute" style="bottom: -60px; left: -20px; width: 250px; height: 250px; border-radius: 50%; background: radial-gradient(circle, rgba(158,221,5,0.1) 0%, transparent 70%); filter: blur(40px);"></div>

                        <div class="row g-5 align-items-center position-relative" style="z-index: 10;">

                            <!-- ========================================= -->
                            <!-- LEFT COLUMN - APP CONTENT -->
                            <!-- ========================================= -->
                            <div class="col-lg-6 col-md-12" data-cues="slideInRight" data-duration="800">
                                <div class="section-heading mb-0">

                                    <!-- Premium Badge -->
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <span class="badge px-4 py-2 rounded-pill fw-semibold d-inline-flex align-items-center gap-2"
                                            style="background: rgba(139,201,5,0.15); color: #8BC905; border: 1px solid rgba(139,201,5,0.3); backdrop-filter: blur(5px); letter-spacing: 0.5px;">
                                            <span style="display: inline-block; width: 8px; height: 8px; background: #8BC905; border-radius: 50%; box-shadow: 0 0 15px #8BC905; animation: pulse 2s infinite;"></span>
                                            DOWNLOAD OUR APP
                                        </span>
                                        <span class="badge px-3 py-2 rounded-pill" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.1);">
                                            <i class="ri-smartphone-line me-1"></i> iOS & Android
                                        </span>
                                    </div>

                                    <!-- Main Headline - Trading Focused -->
                                    <h2 class="display-5 fw-bold mb-3 text-white" style="line-height: 1.2; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                        Experience The
                                        <span style="color: #8BC905; position: relative; display: inline-block;">
                                            Future
                                            <span class="position-absolute start-0 w-100" style="bottom: 0.1em; height: 8px; background: rgba(139,201,5,0.3); border-radius: 30px; filter: blur(2px);"></span>
                                        </span>
                                        <br>Of Trading
                                    </h2>

                                    <!-- Description - Trading Focused -->
                                    <p class="text-white-80 mb-4" style="line-height: 1.7; max-width: 500px; font-size: 1.1rem;">
                                        Trade stocks, crypto, and forex from your pocket. Real-time charts, instant execution, and AI-powered insights all in the palm of your hand.
                                    </p>

                                    <!-- App Features -->
                                    <div class="d-flex flex-wrap gap-3 mb-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="ri-checkbox-circle-fill" style="color: #8BC905;"></i>
                                            <span class="text-white-80 small">0% commission</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="ri-checkbox-circle-fill" style="color: #8BC905;"></i>
                                            <span class="text-white-80 small">Real-time quotes</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="ri-checkbox-circle-fill" style="color: #8BC905;"></i>
                                            <span class="text-white-80 small">Biometric login</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="ri-checkbox-circle-fill" style="color: #8BC905;"></i>
                                            <span class="text-white-80 small">Instant deposits</span>
                                        </div>
                                    </div>

                                    <!-- App Store Buttons - Premium -->
                                    <div class="app-btn-premium d-flex flex-wrap align-items-center gap-3 mt-4 mt-md-5">
                                        <a href="https://play.google.com/store/apps/category/FAMILY?hl=en"
                                            target="_blank"
                                            class="d-flex align-items-center gap-3 p-3 rounded-4 text-decoration-none"
                                            style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); transition: all 0.3s ease;">
                                            <i class="ri-google-play-fill" style="color: white; font-size: 2rem;"></i>
                                            <div>
                                                <span class="small text-white-50 d-block">GET IT ON</span>
                                                <span class="fw-bold text-white">Google Play</span>
                                            </div>
                                        </a>
                                        <a href="https://www.apple.com/app-store/"
                                            target="_blank"
                                            class="d-flex align-items-center gap-3 p-3 rounded-4 text-decoration-none"
                                            style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); transition: all 0.3s ease;">
                                            <i class="ri-apple-fill" style="color: white; font-size: 2rem;"></i>
                                            <div>
                                                <span class="small text-white-50 d-block">Download on the</span>
                                                <span class="fw-bold text-white">App Store</span>
                                            </div>
                                        </a>
                                    </div>

                                    <!-- QR Code / Rating -->
                                    <div class="d-flex align-items-center gap-4 mt-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="d-flex align-items-center">
                                                <i class="ri-star-fill" style="color: #FFB800;"></i>
                                                <i class="ri-star-fill" style="color: #FFB800;"></i>
                                                <i class="ri-star-fill" style="color: #FFB800;"></i>
                                                <i class="ri-star-fill" style="color: #FFB800;"></i>
                                                <i class="ri-star-fill" style="color: #FFB800;"></i>
                                            </div>
                                            <span class="text-white-80 small">4.9 • 50K+ reviews</span>
                                        </div>
                                        <span class="text-white-50 small">|</span>
                                        <span class="text-white-80 small d-flex align-items-center gap-1">
                                            <i class="ri-qr-code-line" style="color: #8BC905;"></i> Scan to download
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- ========================================= -->
                            <!-- RIGHT COLUMN - APP MOCKUP -->
                            <!-- ========================================= -->
                            <div class="col-lg-6 col-md-12" data-cues="slideInLeft" data-duration="800">
                                <div class="app-image-premium position-relative text-center">

                                    <!-- Main App Image -->
                                    <div class="position-relative d-inline-block" style="transform: perspective(1000px) rotateY(5deg) rotateX(2deg); transition: transform 0.6s ease;">
                                        <img class="radius-4"
                                            src="assets/images/app/app-image-1.jpg"
                                            alt="Trading App Dashboard"
                                            style="max-width: 100%; height: auto; border-radius: 24px; border: 4px solid rgba(139,201,5,0.2); box-shadow: 0 40px 70px -20px rgba(0,0,0,0.5);">

                                        <!-- Live Trading Badge -->
                                        <div class="position-absolute top-0 start-0 translate-middle-y ms-4" style="animation: float 6s ease-in-out infinite;">
                                            <span class="badge px-4 py-3 rounded-pill fw-semibold d-flex align-items-center gap-2"
                                                style="background: #8BC905; color: #0C3A30; border: none; box-shadow: 0 15px 30px -8px rgba(139,201,5,0.4);">
                                                <span style="display: inline-block; width: 10px; height: 10px; background: #0C3A30; border-radius: 50%; animation: pulse 2s infinite;"></span>
                                                LIVE MARKETS
                                            </span>
                                        </div>

                                        <!-- Crypto Price Badge -->
                                        <div class="position-absolute bottom-0 end-0 translate-middle-y me-4" style="animation: float 7s ease-in-out infinite 1s;">
                                            <div class="d-flex align-items-center gap-2 bg-white/95 backdrop-blur rounded-pill py-3 px-4 shadow-lg"
                                                style="border-left: 4px solid #8BC905;">
                                                <i class="ri-funds-line" style="color: #8BC905;"></i>
                                                <span class="fw-semibold small" style="color: #0C3A30;">BTC +2.34%</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Trust Indicators -->
                                    <div class="d-flex align-items-center justify-content-center gap-4 mt-4">
                                        <span class="text-white-80 small d-flex align-items-center gap-1">
                                            <i class="ri-shield-check-fill" style="color: #8BC905;"></i> Regulated
                                        </span>
                                        <span class="text-white-80 small d-flex align-items-center gap-1">
                                            <i class="ri-flashlight-fill" style="color: #8BC905;"></i> 0.1s execution
                                        </span>
                                        <span class="text-white-80 small d-flex align-items-center gap-1">
                                            <i class="ri-customer-service-fill" style="color: #8BC905;"></i> 24/7 support
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End App Area - Premium Redesign -->

            <style>
                /* ============ PREMIUM FAQ & APP STYLES ============ */

                /* Animations */
                @keyframes pulse {
                    0% {
                        opacity: 1;
                        transform: scale(1);
                    }

                    50% {
                        opacity: 0.8;
                        transform: scale(0.95);
                        box-shadow: 0 0 20px #8BC905;
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
                        transform: translateY(-10px);
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

                /* FAQ Accordion Styles */
                .accordion-item-premium {
                    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                }

                .accordion-item-premium:hover {
                    transform: translateX(8px);
                    border-color: rgba(139, 201, 5, 0.3) !important;
                    box-shadow: 0 15px 35px -12px rgba(139, 201, 5, 0.1) !important;
                }

                .accordion-button-premium {
                    transition: all 0.3s ease;
                    cursor: pointer;
                }

                .accordion-button-premium:hover .accordion-icon {
                    background: #8BC905 !important;
                    color: white !important;
                    transform: scale(1.1);
                }

                .accordion-button-premium:hover span:first-child span {
                    background: rgba(139, 201, 5, 0.2) !important;
                    color: #0C3A30 !important;
                }

                .accordion-icon {
                    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                }

                .accordion-button-premium[aria-expanded="true"] .accordion-icon {
                    background: #8BC905 !important;
                    color: white !important;
                    transform: rotate(45deg);
                }

                .accordion-button-premium[aria-expanded="true"] .accordion-icon i {
                    transform: rotate(45deg);
                }

                /* App Store Button Hover */
                .app-btn-premium a {
                    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
                }

                .app-btn-premium a:hover {
                    transform: translateY(-5px);
                    background: rgba(139, 201, 5, 0.15) !important;
                    border-color: rgba(139, 201, 5, 0.4) !important;
                }

                .app-btn-premium a:hover i {
                    transform: scale(1.1);
                    color: #8BC905 !important;
                }

                .app-btn-premium a i {
                    transition: all 0.3s ease;
                }

                /* App Image Hover */
                .app-image-premium .position-relative {
                    transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
                }

                .app-image-premium:hover .position-relative {
                    transform: perspective(1000px) rotateY(8deg) rotateX(4deg) scale(1.02) !important;
                }

                /* Question Card Hover */
                .question-card-premium .hover-zoom {
                    transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
                }

                .question-card-premium:hover .hover-zoom {
                    transform: scale(1.03);
                }

                .question-card-premium:hover {
                    box-shadow: 0 40px 70px -20px rgba(12, 58, 48, 0.5) !important;
                }

                /* Utilities */
                .backdrop-blur {
                    backdrop-filter: blur(10px);
                    -webkit-backdrop-filter: blur(10px);
                }

                .text-white-50 {
                    color: rgba(255, 255, 255, 0.6) !important;
                }

                .text-white-80 {
                    color: rgba(255, 255, 255, 0.85) !important;
                }

                .text-secondary {
                    color: #4A5C5A !important;
                }

                /* Responsive */
                @media (max-width: 991px) {
                    .question-card-premium {
                        margin-bottom: 30px;
                    }

                    .faq-content-premium {
                        padding-left: 0 !important;
                    }

                    .download-area-premium {
                        text-align: center;
                    }

                    .app-btn-premium {
                        justify-content: center;
                    }

                    .app-image-premium {
                        margin-top: 40px;
                    }
                }

                @media (max-width: 767px) {
                    .accordion-item-premium {
                        padding: 1.25rem !important;
                    }

                    .accordion-button-premium span:first-child {
                        font-size: 0.95rem;
                    }

                    .app-btn-premium {
                        flex-direction: column;
                        align-items: stretch;
                    }

                    .app-btn-premium a {
                        justify-content: center;
                    }

                    .display-5 {
                        font-size: 2rem;
                    }
                }
            </style>
            <!-- End App Area -->
        </div>
        @endsection