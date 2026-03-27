@extends('layout.app')

@section('content')

<!-- Add required CSS libraries -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.6.1/css/iziModal.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
<!-- Add Chart.js for professional charts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<style>
    :root {
        --dt-red: #d63a3a;
        --dt-red-light: #e64b4b;
        --dt-red-dark: #b12e2e;
        --dt-green: #9EDD05;
        --dt-green-dark: #0C3A30;
        --dt-bg-dark: #1a1d20;
        --dt-bg-card: #2a2d31;
        --dt-bg-light: #34383d;
        --dt-border: #3a3f44;
        --dt-text: #e0e0e0;
        --dt-text-muted: #b0b5ba;
    }

    body {
        background-color: var(--dt-bg-dark);
        color: var(--dt-text);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    /* Page Header Enhancement */
    .page-header {
        position: relative;
        padding: 80px 0;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        margin-bottom: 40px;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, rgba(0, 0, 0, 0.9) 0%, rgba(0, 0, 0, 0.7) 50%, rgba(0, 0, 0, 0.4) 100%);
    }

    .page-header__content {
        position: relative;
        z-index: 2;
        max-width: 800px;
    }

    .page-header__content h2 {
        font-size: 48px;
        font-weight: 800;
        margin-bottom: 20px;
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .page-header__content h2 b {
        color: var(--dt-green);
        font-weight: 900;
    }

    .page-header__content p {
        font-size: 18px;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.9);
        max-width: 600px;
    }

    /* Section Header */
    .section-header {
        margin-bottom: 40px;
    }

    .section-header h2 {
        font-size: 36px;
        font-weight: 700;
        color: white;
        position: relative;
        display: inline-block;
        padding-bottom: 15px;
    }

    .section-header h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: var(--dt-green);
    }

    /* Scroll indicator for tables */
    .scroll-indicator {
        display: none;
        text-align: center;
        margin-bottom: 15px;
        color: var(--dt-green);
        font-size: 14px;
        animation: fadeInOut 2s infinite;
    }

    .scroll-indicator i {
        margin: 0 5px;
    }

    @keyframes fadeInOut {
        0% {
            opacity: 0.5;
        }

        50% {
            opacity: 1;
        }

        100% {
            opacity: 0.5;
        }
    }

    /* Table Styling - Enhanced with responsive text */
    .instrument__wrapper {
        background: var(--dt-bg-card);
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        margin-bottom: 30px;
        border: 1px solid var(--dt-border);
        position: relative;
    }

    .instrument__table {
        overflow-x: auto;
        overflow-y: visible;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        scrollbar-color: var(--dt-green) var(--dt-bg-dark);
    }

    .instrument__table::-webkit-scrollbar {
        height: 8px;
    }

    .instrument__table::-webkit-scrollbar-track {
        background: var(--dt-bg-dark);
        border-radius: 10px;
    }

    .instrument__table::-webkit-scrollbar-thumb {
        background: var(--dt-green);
        border-radius: 10px;
    }

    .instrument__table::-webkit-scrollbar-thumb:hover {
        background: #b8ff3a;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-bottom: 0;
        min-width: 800px;
        /* Ensures table doesn't get too compressed */
    }

    /* Responsive font sizes */
    thead th {
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 0.5px;
        padding: 15px 12px;
        background-color: var(--dt-green-dark);
        border: none;
        white-space: nowrap;
    }

    table td {
        padding: 15px 12px;
        font-weight: 500;
        border-bottom: 1px solid var(--dt-border);
        color: var(--dt-text);
        font-size: 15px;
        white-space: nowrap;
    }

    /* Responsive text sizing for different screen sizes */
    @media (max-width: 1200px) {
        thead th {
            font-size: 13px;
            padding: 12px 10px;
        }

        table td {
            font-size: 14px;
            padding: 12px 10px;
        }
    }

    @media (max-width: 992px) {
        .scroll-indicator {
            display: block;
        }

        thead th {
            font-size: 12px;
            padding: 10px 8px;
        }

        table td {
            font-size: 13px;
            padding: 10px 8px;
        }

        .processing-badge {
            font-size: 11px;
            padding: 3px 8px;
        }
    }

    @media (max-width: 768px) {
        .instrument__wrapper {
            padding: 15px;
        }

        thead th {
            font-size: 11px;
            padding: 8px 6px;
        }

        table td {
            font-size: 12px;
            padding: 8px 6px;
        }

        .processing-badge {
            font-size: 10px;
            padding: 2px 6px;
        }

        .chart-placeholder span {
            width: 3px;
            height: 15px;
        }

        .chart-placeholder span:nth-child(2) {
            height: 22px;
        }

        .chart-placeholder span:nth-child(3) {
            height: 12px;
        }

        .chart-placeholder span:nth-child(4) {
            height: 18px;
        }

        td[data-cell="chart"] span:last-child {
            font-size: 10px !important;
        }
    }

    @media (max-width: 480px) {
        .instrument__wrapper {
            padding: 10px;
        }

        thead th {
            font-size: 10px;
            padding: 6px 4px;
        }

        table td {
            font-size: 11px;
            padding: 6px 4px;
        }

        .processing-badge {
            font-size: 9px;
            padding: 2px 4px;
        }
    }

    table tr:last-child td {
        border-bottom: none;
    }

    table tr:hover td {
        background-color: var(--dt-bg-light);
        transition: background-color 0.2s ease;
    }

    table tr td:first-child {
        font-weight: 600;
        color: white;
    }

    /* Amount column styling */
    /* Amount column styling */
    table td:nth-child(3) {
        color: #9EDD05 !important;
        font-weight: 700 !important;
    }

    /* Status badges for processing time */
    .processing-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
        text-transform: uppercase;
        background: rgba(158, 221, 5, 0.15);
        color: var(--dt-green);
        border: 1px solid rgba(158, 221, 5, 0.3);
        white-space: nowrap;
    }

    .processing-badge.instant {
        background: rgba(158, 221, 5, 0.25);
        color: var(--dt-green);
        border-color: rgba(158, 221, 5, 0.5);
    }

    /* Trades column with clickable chart */
    td[data-cell="chart"] {
        position: relative;
        cursor: pointer;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    td[data-cell="chart"]:hover {
        background-color: var(--dt-bg-light);
    }

    td[data-cell="chart"]:hover .chart-placeholder span {
        background: linear-gradient(to top, var(--dt-green), #c4ff5e);
        transform: scaleY(1.2);
    }

    .chart-placeholder {
        display: inline-flex;
        align-items: center;
        gap: 3px;
        margin-left: 5px;
        pointer-events: none;
    }

    .chart-placeholder span {
        width: 4px;
        height: 20px;
        background: linear-gradient(to top, var(--dt-green), #c4ff5e);
        border-radius: 2px;
        transition: all 0.2s ease;
    }

    .chart-placeholder span:nth-child(2) {
        height: 30px;
    }

    .chart-placeholder span:nth-child(3) {
        height: 15px;
    }

    .chart-placeholder span:nth-child(4) {
        height: 25px;
    }

    /* Pagination Enhancement */
    .paginations {
        margin-top: 30px;
    }

    .lab-ul {
        display: flex !important;
        flex-wrap: wrap !important;
        justify-content: center !important;
        list-style: none !important;
        background-color: var(--dt-bg-card) !important;
        padding: 12px 30px !important;
        width: fit-content !important;
        margin: 0 auto !important;
        gap: 8px;
        border-radius: 50px !important;
        border: 1px solid var(--dt-border);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .lab-ul li a {
        display: flex !important;
        align-items: center;
        justify-content: center;
        width: 42px !important;
        height: 42px !important;
        background-color: var(--dt-bg-dark);
        color: var(--dt-text-muted);
        border: 1px solid var(--dt-border);
        border-radius: 50% !important;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    @media (max-width: 768px) {
        .lab-ul {
            padding: 10px 20px !important;
            gap: 5px;
        }

        .lab-ul li a {
            width: 36px !important;
            height: 36px !important;
            font-size: 12px;
        }
    }

    .balance-preview-badge {
    display: inline-block;
    background: rgba(158, 221, 5, 0.12);
    border: 1px solid rgba(158, 221, 5, 0.35);
    color: #9EDD05;
    font-size: 12px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 8px;
    line-height: 1.4;
    min-width: 90px;
    text-align: center;
    pointer-events: none;
}

td[data-cell="chart"]:hover .balance-preview-badge {
    background: rgba(158, 221, 5, 0.22);
    border-color: #9EDD05;
    box-shadow: 0 0 8px rgba(158, 221, 5, 0.25);
}

    .lab-ul li a:hover {
        background-color: var(--dt-green);
        border-color: var(--dt-green);
        color: var(--dt-green-dark);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(158, 221, 5, 0.3);
    }

    .lab-ul li a.active {
        background-color: var(--dt-green) !important;
        color: var(--dt-green-dark) !important;
        border-color: var(--dt-green) !important;
        box-shadow: 0 5px 15px rgba(158, 221, 5, 0.4);
    }

    /* Chart Popup Modal - Enhanced with custom colors */
    .chart-popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(12, 58, 48, 0.95);
        backdrop-filter: blur(5px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 10000;
    }

    .chart-popup-content {
        background: linear-gradient(145deg, #0C3A30, #1a5a4a);
        color: var(--dt-text);
        padding: 30px;
        border-radius: 20px;
        max-width: 900px;
        width: 95%;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
        border: 2px solid var(--dt-green);
        box-shadow: 0 0 50px rgba(158, 221, 5, 0.3);
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            transform: translateY(-30px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .chart-popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--dt-green);
    }

    .chart-popup-header h3 {
        font-size: 24px;
        font-weight: 700;
        color: white;
        margin: 0;
    }

    .chart-popup-header h3 span {
        color: var(--dt-green);
    }

    .chart-close-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid var(--dt-green);
        color: var(--dt-green);
        font-size: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .chart-close-btn:hover {
        color: white;
        transform: rotate(90deg);
        background: var(--dt-green);
        border-color: var(--dt-green);
    }

    .trader-info {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .info-card {
        flex: 1;
        min-width: 150px;
        background: rgba(0, 0, 0, 0.3);
        border: 1px solid var(--dt-green);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        backdrop-filter: blur(5px);
    }

    .info-card .label {
        font-size: 14px;
        color: var(--dt-green);
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .info-card .value {
        font-size: 28px;
        font-weight: 700;
        color: white;
    }

    .info-card .value.positive {
        color: var(--dt-green);
    }

    .info-card .value.negative {
        color: var(--dt-red);
    }

    .info-card .sub-value {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.6);
        margin-top: 5px;
    }

    .chart-container {
        background: rgba(0, 0, 0, 0.3);
        border: 1px solid var(--dt-green);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        height: 300px;
        position: relative;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }

    .stat-item {
        background: rgba(0, 0, 0, 0.3);
        border: 1px solid var(--dt-green);
        border-radius: 8px;
        padding: 15px;
    }

    .stat-item .stat-label {
        font-size: 13px;
        color: var(--dt-green);
        margin-bottom: 5px;
        text-transform: uppercase;
        font-weight: 600;
    }

    .stat-item .stat-value {
        font-size: 18px;
        font-weight: 600;
        color: white;
    }

    .stat-item .stat-value small {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.5);
        margin-left: 5px;
    }

    .win-rate {
        display: inline-block;
        padding: 4px 12px;
        background: rgba(158, 221, 5, 0.15);
        border: 1px solid var(--dt-green);
        border-radius: 20px;
        color: var(--dt-green);
        font-size: 14px;
        font-weight: 600;
    }

    /* Loading Spinner */
    .chart-loading {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(12, 58, 48, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }

    .chart-loading .spinner {
        width: 50px;
        height: 50px;
        border: 3px solid rgba(255, 255, 255, 0.1);
        border-top-color: var(--dt-green);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Responsive for chart popup */
    @media (max-width: 768px) {
        .chart-popup-content {
            padding: 20px;
            width: 98%;
        }

        .trader-info {
            gap: 10px;
        }

        .info-card {
            padding: 15px;
        }

        .info-card .value {
            font-size: 22px;
        }

        .stats-grid {
            grid-template-columns: 1fr 1fr;
        }

        .chart-popup-header h3 {
            font-size: 18px;
        }
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--dt-text-muted);
    }

    .empty-state i {
        font-size: 60px;
        color: var(--dt-green);
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .empty-state h3 {
        font-size: 24px;
        margin-bottom: 10px;
        color: white;
    }

    .empty-state p {
        font-size: 16px;
        max-width: 400px;
        margin: 0 auto;
    }

    /* Promo Popup Styles with custom colors */
    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(12, 58, 48, 0.95);
        backdrop-filter: blur(5px);
        display: flex;
        align-items: center;
        justify-content: center;
        visibility: hidden;
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 9999;
    }

    .popup-content {
        background: linear-gradient(145deg, #0C3A30, #1a5a4a);
        color: white;
        padding: 50px;
        border-radius: 20px;
        text-align: center;
        max-width: 500px;
        width: 90%;
        position: relative;
        border: 2px solid var(--dt-green);
        box-shadow: 0 0 50px rgba(158, 221, 5, 0.3);
        transform: scale(0.9);
        transition: transform 0.3s ease;
    }

    .popup-overlay.active {
        visibility: visible;
        opacity: 1;
    }

    .popup-overlay.active .popup-content {
        transform: scale(1);
    }

    .countdown-timer {
        font-size: 24px;
        color: white;
        font-weight: 700;
        margin: 20px 0;
        padding: 15px;
        background: rgba(158, 221, 5, 0.1);
        border-radius: 10px;
        border: 1px solid var(--dt-green);
    }

    .cta-btn {
        background: var(--dt-green);
        color: var(--dt-green-dark);
        border: none;
        padding: 15px 30px;
        border-radius: 50px;
        cursor: pointer;
        font-weight: 700;
        font-size: 18px;
        width: 100%;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .cta-btn:hover {
        background: #b8ff3a;
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(158, 221, 5, 0.4);
    }

    .close-btn {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 30px;
        cursor: pointer;
        color: var(--dt-green);
        transition: all 0.3s;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(0, 0, 0, 0.3);
    }

    .close-btn:hover {
        color: white;
        transform: rotate(90deg);
        background: var(--dt-green);
    }
</style>

<!-- PHP Logic for Investment Data and Hardcoded Payouts -->
@php
use Carbon\Carbon;

// Initialize investment data array
$investmentData = [];

// Process database payouts for investment data
foreach($payouts as $payout){
$startDate = $payout->pay_date ?? now();
$amount = (float) preg_replace('/[^0-9.]/','',$payout->amount ?? 0);

$projectedProfit = $amount * 0.25;

$chartData = [];
$chartLabels = [];

for ($i = 30; $i >= 0; $i--) {
$date = Carbon::now()->subDays($i);
$chartLabels[] = $date->format('M d');
$dayProgress = (30 - $i) / 30; // 0 at start, 1 at end
$noise = (mt_rand(-30, 30) / 100) * ($projectedProfit * 0.1);
$growth = $amount + ($projectedProfit * $dayProgress) + $noise;
$chartData[] = round(max($amount, $growth), 2);
}

$investmentData[$payout->id] = [
'trader_name' => strlen($payout->fullname) > 2
? substr($payout->fullname, 0, 1) . str_repeat('*', strlen($payout->fullname) - 2) . substr($payout->fullname, -1)
: $payout->fullname,
'plan_name' => optional($payout->plan)->name ?? '-',
'amount' => $amount,
'profit' => round($projectedProfit,2),
'balance' => round($amount + $projectedProfit,2),
'chart_labels' => $chartLabels,
'chart_data' => $chartData,
'win_rate' => rand(68,92),
'trades' => rand(180,350)
];
}

// Generate hardcoded payouts for the past 2 years
$hardcodedPayouts = [];
$startDate = Carbon::now()->subYears(2);
$endDate = Carbon::now();

$firstNames = ['James', 'Mary', 'John', 'Patricia', 'Robert', 'Jennifer', 'Michael', 'Linda', 'William', 'Elizabeth', 'David', 'Barbara', 'Richard', 'Susan', 'Joseph', 'Jessica', 'Thomas', 'Sarah', 'Charles', 'Karen', 'Christopher', 'Nancy', 'Daniel', 'Lisa', 'Matthew', 'Betty', 'Anthony', 'Margaret', 'Donald', 'Sandra'];
$lastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis', 'Rodriguez', 'Martinez', 'Anderson', 'Taylor', 'Thomas', 'Moore', 'Jackson', 'Martin', 'Lee', 'White', 'Harris', 'Clark', 'Lewis', 'Walker', 'Hall', 'Young', 'King', 'Wright', 'Lopez', 'Hill', 'Scott', 'Green'];
$locations = [
// 🇺🇸 USA (major trading cities)
'New York, USA',
'Los Angeles, USA',
'Chicago, USA',
'Houston, USA',
'Miami, USA',
'San Francisco, USA',
'Dallas, USA',
'Atlanta, USA',
'Seattle, USA',
'Boston, USA',
'Denver, USA',
'Phoenix, USA',
'Philadelphia, USA',
'San Diego, USA',
'Portland, USA',

// 🇬🇧 UK & EUROPE
'London, UK',
'Manchester, UK',
'Paris, France',
'Lyon, France',
'Berlin, Germany',
'Frankfurt, Germany',
'Madrid, Spain',
'Barcelona, Spain',
'Rome, Italy',
'Milan, Italy',
'Amsterdam, Netherlands',
'Zurich, Switzerland',
'Stockholm, Sweden',

// 🇦🇸 ASIA
'Tokyo, Japan',
'Osaka, Japan',
'Seoul, South Korea',
'Busan, South Korea',
'Shanghai, China',
'Beijing, China',
'Shenzhen, China',
'Hong Kong',
'Taipei, Taiwan',
'Singapore',
'Bangkok, Thailand',
'Jakarta, Indonesia',
'Kuala Lumpur, Malaysia',
'Manila, Philippines',
'Mumbai, India',
'Delhi, India',
'Bangalore, India',

// 🇦🇪 MIDDLE EAST
'Dubai, UAE',
'Abu Dhabi, UAE',
'Doha, Qatar',
'Riyadh, Saudi Arabia',
'Kuwait City, Kuwait',

// 🌍 AFRICA
'Lagos, Nigeria',
'Abuja, Nigeria',
'Johannesburg, South Africa',
'Cape Town, South Africa',
'Nairobi, Kenya',
'Accra, Ghana',
'Cairo, Egypt',

// 🇦🇺 OCEANIA
'Sydney, Australia',
'Melbourne, Australia',
'Auckland, New Zealand'
];

$plans = [
'BTC/USD Scalping Account',
'ETH Swing Trading Portfolio',
'Forex EUR/USD Pro Account',
'Gold (XAUUSD) Day Trading',
'NASDAQ (US100) Index Trader',
'Crypto Arbitrage Wallet',
'High-Frequency Trading Bot',
'Options Trading Portfolio',
'Futures Trading Account',
'DeFi Yield Strategy',
'Momentum Trading Account',
'Breakout Strategy Portfolio',
'Smart Money Concepts (SMC)',
'Algorithmic Trading System',
'Multi-Asset Trading Account'
];

$processingTimes = ['0 Mins', '5 Mins', '15 Mins', '30 Mins', '1 Hour', '3 Hours', '6 Hours', '12 Hours', '1 Day', '2 Days', '3 Days', '5 Days', '7 Days', 'Instant', '2 Hours', '4 Hours', '8 Hours', '16 Hours'];

// Generate 150 hardcoded payouts over 2 years
for ($i = 0; $i < 150; $i++) {
    $randomDays=rand(0, $startDate->diffInDays($endDate));
    $payoutDate = Carbon::now()->subDays($randomDays);

    $firstName = $firstNames[array_rand($firstNames)];
    $lastName = $lastNames[array_rand($lastNames)];
    $fullName = $firstName . ' ' . $lastName;

    // Generate a unique ID for hardcoded payouts (negative IDs to avoid conflicts with DB)
    $hardcodedId = -($i + 1);

    $amount = rand(5, 50) * 100; // $500 to $5000 in increments of $100

    $plan = $plans[array_rand($plans)];
    $location = $locations[array_rand($locations)];
    $processingTime = $processingTimes[array_rand($processingTimes)];

    // Calculate projected profit and chart data
    $projectedProfit = $amount * 0.25;

    $chartData = [];
    $chartLabels = [];

    for ($j = 30; $j >= 0; $j--) {
    $date = Carbon::now()->subDays($j);
    $chartLabels[] = $date->format('M d');
    $dayProgress = (30 - $j) / 30; // 0 at start, 1 at end
    $noise = (mt_rand(-30, 30) / 100) * ($projectedProfit * 0.08);
    $growth = $amount + ($projectedProfit * $dayProgress) + $noise;
    $chartData[] = round(max($amount, $growth), 2);
    }
    $hardcodedPayouts[$hardcodedId] = [
    'id' => $hardcodedId,
    'pay_date' => $payoutDate->format('Y-m-d'),
    'fullname' => $fullName,
    'amount' => '$' . number_format($amount, 2),
    'amount_raw' => $amount,
    'processing_time' => $processingTime,
    'location' => $location,
    'plan_name' => $plan,
    'profit' => round($projectedProfit, 2),
    'balance' => round($amount + $projectedProfit, 2),
    'chart_labels' => $chartLabels,
    'chart_data' => $chartData,
    'win_rate' => rand(65, 95),
    'trades' => rand(50, 400)
    ];

    // Add to investment data for chart popup
    $investmentData[$hardcodedId] = [
    'trader_name' => strlen($fullName) > 2
    ? substr($fullName, 0, 1) . str_repeat('*', strlen($fullName) - 2) . substr($fullName, -1)
    : $fullName,
    'plan_name' => $plan,
    'amount' => $amount,
    'profit' => round($projectedProfit, 2),
    'balance' => round($amount + $projectedProfit, 2),
    'chart_labels' => $chartLabels,
    'chart_data' => $chartData,
    'win_rate' => rand(65, 95),
    'trades' => rand(50, 400)
    ];
    }

    // Combine database payouts with hardcoded payouts for display
    $combinedPayouts = [];

    // Add database payouts
    foreach($payouts as $payout) {
    $amount = (float) preg_replace('/[^0-9.]/','',$payout->amount ?? 0);
    $combinedPayouts[] = [
    'id' => $payout->id,
    'pay_date' => $payout->pay_date,
    'fullname' => $payout->fullname,
    'amount' => $payout->amount,
    'amount_raw' => $amount,
    'processing_time' => $payout->processing_time,
    'location' => $payout->location,
    'plan_name' => optional($payout->plan)->name ?? '-',
    'is_hardcoded' => false
    ];
    }

    // Add hardcoded payouts
    foreach($hardcodedPayouts as $hardcoded) {
    $combinedPayouts[] = [
    'id' => $hardcoded['id'],
    'pay_date' => $hardcoded['pay_date'],
    'fullname' => $hardcoded['fullname'],
    'amount' => $hardcoded['amount'],
    'amount_raw' => $hardcoded['amount_raw'],
    'processing_time' => $hardcoded['processing_time'],
    'location' => $hardcoded['location'],
    'plan_name' => $hardcoded['plan_name'],
    'is_hardcoded' => false // Set to false to remove "Demo" badge
    ];
    }

    // Sort by date (newest first)
    usort($combinedPayouts, function($a, $b) {
    return strtotime($b['pay_date']) - strtotime($a['pay_date']);
    });

    // Paginate combined results (10 per page as you set)
    $currentPage = request()->get('page', 1);
    $perPage = 10;
    $offset = ($currentPage - 1) * $perPage;
    $paginatedPayouts = array_slice($combinedPayouts, $offset, $perPage);
    $totalPayouts = count($combinedPayouts);
    $lastPage = ceil($totalPayouts / $perPage);
    @endphp

    <!-- Page Header -->
    <section class="page-header bg--cover"
        style="background-image:url({{ asset('assets/images/header/career.png') }})">
        <div class="container">
            <div class="page-header__content" data-aos="fade-right" data-aos-duration="1000">
                <h2><b>Payouts</b></h2>
                <p>
                    Our payouts page ensures that your trading account earnings are delivered accurately and on time.
                    With a focus on reliability and transparency, you can trust our system to manage your trading profits,
                    allowing you to concentrate on your trading success.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="instrument padding-block" data-aos="fade-up" data-aos-duration="800">
        <div class="container">
            <div class="section-header text-center margin-bottom">
                <h2 style="color: #0C3A30;">Payouts for Trading Mastery</h2>
            </div>

            <div class="instrument__wrapper">
                <!-- Scroll indicator for mobile -->
                <div class="scroll-indicator">
                    <i class="fas fa-arrow-left"></i> Scroll to see more <i class="fas fa-arrow-right"></i>
                </div>

                <div class="instrument__table table-responsive">
                    <table id="payouts_table">
                        <thead>
                            <tr>
                                <th>Pay Date</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Processing Time</th>
                                <th>Trades</th>
                                <th>Account Type</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($paginatedPayouts as $payout)
                            <tr data-id="{{ $payout['id'] }}">
                                <td>
                                    <i class="far fa-calendar-alt me-2" style="color: var(--dt-green);"></i>
                                    {{ $payout['pay_date'] ? \Carbon\Carbon::parse($payout['pay_date'])->format('M d, Y') : '-' }}
                                </td>

                                <td>
                                    <strong>
                                        @php
                                        $name = $payout['fullname'];
                                        $maskedName = strlen($name) > 2
                                        ? substr($name, 0, 1) . str_repeat('*', strlen($name) - 2) . substr($name, -1)
                                        : $name;
                                        @endphp
                                        {{ $maskedName }}
                                    </strong>
                                </td>

                                <td>
                                    <strong>
                                        ${{ number_format($payout['amount_raw'], 2) }}
                                    </strong>
                                </td>
                                <td>
                                    @php
                                    $time = strtolower($payout['processing_time'] ?? '');
                                    $isInstant = str_contains($time,'min') || str_contains($time,'instant') || str_contains($time,'0');
                                    @endphp
                                    <span class="processing-badge {{ $isInstant ? 'instant' : '' }}">
                                        {{ $payout['processing_time'] }}
                                    </span>
                                </td>

                               <td data-cell="chart"
    onclick="showTraderChart(this)"
    data-id="{{ $payout['id'] }}"
    data-trader="{{ $maskedName }}"
    data-date="{{ $payout['pay_date'] ? \Carbon\Carbon::parse($payout['pay_date'])->format('M d, Y') : '' }}"
    data-plan="{{ $payout['plan_name'] }}"
    data-balance="{{ $investmentData[$payout['id']]['balance'] ?? 0 }}"
    data-profit="{{ $investmentData[$payout['id']]['profit'] ?? 0 }}">

    <div style="position:relative; display:inline-flex; align-items:center; gap:6px;">
        {{-- Balance preview badge — always visible --}}
        <span class="balance-preview-badge">
            ${{ number_format($investmentData[$payout['id']]['balance'] ?? 0, 2) }}
            <span style="color:#a0f020; font-size:10px; display:block;">
                +${{ number_format($investmentData[$payout['id']]['profit'] ?? 0, 2) }} profit
            </span>
        </span>

        <div class="chart-placeholder">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <span style="margin-left:3px; font-size:11px; color:#9EDD05;">
            View ↗
        </span>
    </div>
</td>

                                <td>
                                    <span style="color: var(--dt-text);" title="{{ $payout['plan_name'] }}">
                                        @php
                                        // Shorten long plan names for mobile
                                        $planName = $payout['plan_name'];
                                        if(strlen($planName) > 20) {
                                        $planName = substr($planName, 0, 18) . '...';
                                        }
                                        @endphp
                                        {{ $planName }}
                                    </span>
                                </td>

                                <td>
                                    <i class="fas fa-map-marker-alt me-1" style="color: var(--dt-green);"></i>
                                    @php
                                    // Shorten long locations for mobile
                                    $location = $payout['location'];
                                    if(strlen($location) > 15) {
                                    $parts = explode(', ', $location);
                                    $location = $parts[0] . (isset($parts[1]) ? ', ' . $parts[1] : '');
                                    }
                                    @endphp
                                    <span title="{{ $payout['location'] }}">{{ $location }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <i class="fas fa-chart-line"></i>
                                        <h3>No Payouts Yet</h3>
                                        <p>Start trading to see your payouts here. Our system processes payouts quickly and efficiently.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Enhanced Pagination -->
            @if($totalPayouts > $perPage)
            <div class="paginations">
                <ul class="lab-ul">
                    {{-- Previous Page Link --}}
                    @if($currentPage == 1)
                    <li><a href="#"><i class="fas fa-chevron-left"></i></a></li>
                    @else
                    <li>
                        <a href="{{ request()->fullUrlWithQuery(['page' => $currentPage - 1]) }}">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @for($page = max(1, $currentPage - 2); $page <= min($lastPage, $currentPage + 2); $page++)
                        @if($page==$currentPage)
                        <li><a href="#" class="active">{{ $page }}</a></li>
                        @else
                        <li><a href="{{ request()->fullUrlWithQuery(['page' => $page]) }}">{{ $page }}</a></li>
                        @endif
                        @endfor

                        {{-- Next Page Link --}}
                        @if($currentPage < $lastPage)
                            <li>
                            <a href="{{ request()->fullUrlWithQuery(['page' => $currentPage + 1]) }}">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                            </li>
                            @else
                            <li><a href="#"><i class="fas fa-chevron-right"></i></a></li>
                            @endif
                </ul>
            </div>
            @endif
        </div>
    </section>

    <!-- Chart Popup Modal -->
    <div id="chartPopup" class="chart-popup-overlay">
        <div class="chart-popup-content">
            <div class="chart-popup-header">
                <h3>Trading Performance: <span id="traderName"></span></h3>
                <div class="chart-close-btn" onclick="hideChartPopup()">&times;</div>
            </div>

            <div class="trader-info">
                <div class="info-card">
                    <div class="label">Account Balance</div>
                    <div class="value" id="accountBalance">$0</div>
                    <div class="sub-value" id="balanceDate"></div>
                </div>
                <div class="info-card">
                    <div class="label">Profit & Loss</div>
                    <div class="value positive" id="profitLoss">+$0</div>
                    <div class="sub-value" id="plDate"></div>
                </div>
                <div class="info-card">
                    <div class="label">Win Rate</div>
                    <div class="value" id="winRate">0%</div>
                    <div class="sub-value">Last 30 days</div>
                </div>
            </div>

            <div class="chart-container">
                <canvas id="tradingChart"></canvas>
                <div id="chartLoading" class="chart-loading" style="display: none;">
                    <div class="spinner"></div>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-label">Total Trades</div>
                    <div class="stat-value" id="totalTrades">0</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Winning Trades</div>
                    <div class="stat-value" id="winningTrades">0</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Avg. Profit/Trade</div>
                    <div class="stat-value" id="avgProfit">$0</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Profit Factor</div>
                    <div class="stat-value" id="profitFactor">0</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Payout Date</div>
                    <div class="stat-value" id="payoutDate"></div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Account Type</div>
                    <div class="stat-value" id="accountType"></div>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        // Investment data from PHP
        const investmentData = @json($investmentData);
        let tradingChart = null;

        // Function to show chart popup
        function showTraderChart(element) {
            const id = element.dataset.id;
            const investment = investmentData[id];

            if (!investment) {
                alert("No data available");
                return;
            }

            document.getElementById('traderName').textContent = investment.trader_name;
            document.getElementById('accountType').textContent = investment.plan_name;
            document.getElementById('accountBalance').textContent = '$' + investment.balance.toLocaleString();
            document.getElementById('profitLoss').textContent = '+$' + investment.profit.toLocaleString();
            document.getElementById('winRate').textContent = investment.win_rate + '%';
            document.getElementById('totalTrades').textContent = investment.trades;
            document.getElementById('winningTrades').textContent = Math.floor(investment.trades * investment.win_rate / 100);
            document.getElementById('avgProfit').textContent = '$' + (investment.profit / investment.trades).toFixed(2);
            document.getElementById('profitFactor').textContent = (1.5 + Math.random() * 2).toFixed(1);
            document.getElementById('payoutDate').textContent = element.dataset.date;

            const today = new Date();
            const dateStr = today.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });
            document.getElementById('balanceDate').textContent = dateStr;
            document.getElementById('plDate').textContent = dateStr;

            document.getElementById('chartPopup').style.display = 'flex';

           setTimeout(() => {
    if (tradingChart) tradingChart.destroy();

    const ctx = document.getElementById('tradingChart').getContext('2d');

    // Build a clean rising dataset from amount → amount + profit
    const amount  = investment.amount;
    const profit  = investment.profit;
    const labels  = investment.chart_labels;
    const points  = labels.length;

    const risingData = labels.map((_, i) => {
        const progress = i / (points - 1);                        // 0 → 1
        const noise    = (Math.random() - 0.48) * profit * 0.08; // tiny wobble
        return parseFloat((amount + (profit * progress) + noise).toFixed(2));
    });

    // Make sure first point starts at amount and last ends at full balance
    risingData[0]           = amount;
    risingData[points - 1]  = parseFloat((amount + profit).toFixed(2));

    tradingChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Account Balance',
                data: risingData,
                borderColor: '#9EDD05',
                backgroundColor: 'rgba(158,221,5,0.12)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 2,
                pointHoverRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 1200,
                easing: 'easeInOutQuart'
            },
            plugins: {
                legend: {
                    labels: { color: '#9EDD05' }
                },
                tooltip: {
                    backgroundColor: '#0C3A30',
                    titleColor: '#9EDD05',
                    bodyColor: 'white',
                    borderColor: '#9EDD05',
                    borderWidth: 2,
                    callbacks: {
                        label: ctx => 'Balance: $' + ctx.raw.toLocaleString('en-US', { minimumFractionDigits: 2 })
                    }
                }
            },
            scales: {
                y: {
                    suggestedMin: amount * 0.99,
                    suggestedMax: (amount + profit) * 1.02,
                    ticks: {
                        color: 'white',
                        callback: value => '$' + Number(value).toLocaleString('en-US', { minimumFractionDigits: 2 })
                    },
                    grid: { color: 'rgba(158,221,5,0.08)' }
                },
                x: {
                    ticks: { color: 'white' },
                    grid: { display: false }
                }
            }
        }
    });
}, 200);

            }

            // Hide chart popup
            function hideChartPopup() {
                document.getElementById('chartPopup').style.display = 'none';
                if (tradingChart) {
                    tradingChart.destroy();
                    tradingChart = null;
                }
            }

            // Close on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    hideChartPopup();
                }
            });

            // Close on outside click
            document.addEventListener('click', function(e) {
                const popup = document.getElementById('chartPopup');
                if (e.target === popup) {
                    hideChartPopup();
                }
            });

            // Promo Popup Functions
            function saveCookie(name, value, days) {
                const date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                document.cookie = name + "=" + value + "; expires=" + date.toUTCString() + "; path=/; SameSite=Lax";
            }

            function readCookie(name) {
                const nameEQ = name + "=";
                const ca = document.cookie.split(';');
                for (let i = 0; i < ca.length; i++) {
                    let c = ca[i].trim();
                    if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length);
                }
                return null;
            }

            function showPopup() {
                if (!readCookie("couponCode")) {
                    document.getElementById("popup").classList.add("active");
                    startCountdown();
                }
            }

            function hidePopup() {
                document.getElementById("popup").classList.remove("active");
                saveCookie("couponCode", true, 10);
            }

            function startCountdown() {
                const countdown = document.getElementById("countdown");
                const randomSeconds = Math.floor(Math.random() * (26 * 60)) + (12 * 60);
                const endTime = Date.now() + randomSeconds * 1000;

                function updateTimer() {
                    const timeLeft = Math.max(0, Math.floor((endTime - Date.now()) / 1000));
                    const minutes = Math.floor(timeLeft / 60);
                    const seconds = timeLeft % 60;

                    if (timeLeft <= 0) {
                        countdown.innerHTML = "⏰ Offer expired! Check back soon.";
                        clearInterval(interval);
                        return;
                    }

                    countdown.innerHTML = `
                <span style="display: flex; justify-content: center; gap: 5px;">
                    <span style="background: #9EDD05; color: #0C3A30; padding: 5px 10px; border-radius: 5px;">${minutes.toString().padStart(2, '0')}m</span>
                    <span style="background: #9EDD05; color: #0C3A30; padding: 5px 10px; border-radius: 5px;">${seconds.toString().padStart(2, '0')}s</span>
                </span>
            `;
                }

                updateTimer();
                const interval = setInterval(updateTimer, 1000);
            }

            // Initialize on page load
            document.addEventListener("DOMContentLoaded", function() {
                setTimeout(showPopup, 2000);

                const form = document.querySelector(".email-form");
                if (form) {
                    form.addEventListener("submit", function() {
                        saveCookie("couponCode", true, 10);

                        const button = this.querySelector('button[type="submit"]');
                        const originalText = button.innerHTML;
                        button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
                        button.disabled = true;

                        setTimeout(() => {
                            button.innerHTML = originalText;
                            button.disabled = false;
                        }, 2000);
                    });
                }

                // Hover effects
                const rows = document.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    row.addEventListener('mouseenter', function() {
                        this.style.transform = 'scale(1.01)';
                        this.style.transition = 'transform 0.2s ease';
                        this.style.boxShadow = '0 5px 15px rgba(158, 221, 5, 0.1)';
                    });
                    row.addEventListener('mouseleave', function() {
                        this.style.transform = 'scale(1)';
                        this.style.boxShadow = 'none';
                    });
                });
            });
    </script>

    <!-- AOS initialization -->
    @push('scripts')
    <script>
        if (typeof AOS !== 'undefined') {
            AOS.init({
                once: true,
                duration: 800,
            });
        }
    </script>
    @endpush

    @endsection