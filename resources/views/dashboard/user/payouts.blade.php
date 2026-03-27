@extends('layout.user')

@section('content')

<!-- Add required CSS libraries -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.6.1/css/iziModal.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
<!-- Add Chart.js for professional charts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<style>
    :root {
        --brand-green: #9EDD05;
        --brand-green-mid: #8AC304;


        --brand-green-glow: rgba(158, 221, 5, 0.18);
        --brand-green-glow2: rgba(158, 221, 5, 0.08);
        --brand-gold: #c8ff2e;
        --brand-red: #d63a3a;
        --brand-red-light: #e64b4b;
        --surface-0: #061f19;


        --border-subtle: rgba(158, 221, 5, 0.15);
        --border-mid: rgba(158, 221, 5, 0.30);
        --border-strong: rgba(158, 221, 5, 0.55);
        --text-primary: #f0fff4;
        --text-secondary: #a8d4b8;
        --text-muted: #5a8a70;
    }

    * {
        box-sizing: border-box;
    }

    body {

        color: var(--text-primary);
        font-family: 'Georgia', 'Times New Roman', serif;
       
     
           
    }

    /* ───────────── PAGE HEADER ───────────── */
    .page-header {
        position: relative;
        padding: 100px 0 80px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        margin-bottom: 60px;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(105deg,
                rgba(6, 31, 25, 0.97) 0%,
                rgba(12, 58, 48, 0.88) 45%,
                rgba(12, 58, 48, 0.55) 100%);
    }

    /* animated grid overlay */
    .page-header::after {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(var(--border-subtle) 1px, transparent 1px),
            linear-gradient(90deg, var(--border-subtle) 1px, transparent 1px);
        background-size: 48px 48px;
        animation: gridDrift 20s linear infinite;
        opacity: 0.4;
    }

    @keyframes gridDrift {
        0% {
            background-position: 0 0;
        }

        100% {
            background-position: 48px 48px;
        }
    }

    .page-header__content {
        position: relative;
        z-index: 3;
        max-width: 760px;
    }

    .page-header__content h2 {
        font-size: clamp(36px, 5vw, 56px);
        font-weight: 800;
        margin-bottom: 20px;
        color: var(--text-primary);
        line-height: 1.1;
        letter-spacing: -1px;
    }

    .page-header__content h2 b {
        color: var(--brand-green);
        font-weight: 900;
        text-shadow: 0 0 40px rgba(158, 221, 5, 0.4);
    }

    .page-header__content p {
        font-size: 17px;
        line-height: 1.75;
        color: var(--text-secondary);
        max-width: 580px;
        font-family: 'Georgia', serif;
    }

    /* header accent line */
    .page-header__accent {
        position: relative;
        z-index: 3;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 28px;
    }

    .page-header__accent span {
        display: inline-block;
        width: 48px;
        height: 3px;
        background: var(--brand-green);
        border-radius: 2px;
    }

    .page-header__accent em {
        font-style: normal;
        font-size: 12px;
        font-family: 'Courier New', monospace;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--brand-green);
    }

    /* ───────────── SECTION HEADER ───────────── */
    .section-header {
        margin-bottom: 48px;
        position: relative;
    }

    .section-header h2 {
        font-size: clamp(26px, 3.5vw, 38px);
        font-weight: 700;
        color: var(--brand-green-dark);
        position: relative;
        display: inline-block;
        padding-bottom: 18px;
        letter-spacing: -0.5px;
    }

    .section-header h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 64px;
        height: 3px;
        background: linear-gradient(90deg, var(--brand-green), var(--brand-gold));
        border-radius: 2px;
    }

    /* ───────────── SCROLL INDICATOR ───────────── */
    .scroll-indicator {
        display: none;
        text-align: center;
        margin-bottom: 16px;
        color: var(--brand-green);
        font-size: 13px;
        font-family: 'Courier New', monospace;
        letter-spacing: 1px;
        animation: fadeInOut 2.4s ease infinite;
    }

    @keyframes fadeInOut {

        0%,
        100% {
            opacity: 0.4;
        }

        50% {
            opacity: 1;
        }
    }

    /* ───────────── TABLE WRAPPER ───────────── */
    .instrument__wrapper {
        background: linear-gradient(145deg, var(--surface-1), var(--surface-2));
        border-radius: 16px;
        padding: 28px;
        margin-bottom: 36px;
        border: 1px solid var(--border-subtle);
        box-shadow:
            0 0 0 1px var(--border-subtle),
            0 20px 60px rgba(0, 0, 0, 0.5),
            inset 0 1px 0 rgba(158, 221, 5, 0.08);
        position: relative;
        overflow: hidden;
    }

    /* corner accent */
    .instrument__wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 120px;
        height: 120px;
        background: radial-gradient(circle at top left, rgba(158, 221, 5, 0.08), transparent 70%);
        pointer-events: none;
    }

    .instrument__wrapper::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 180px;
        height: 180px;
        background: radial-gradient(circle at bottom right, rgba(158, 221, 5, 0.05), transparent 70%);
        pointer-events: none;
    }

    /* ───────────── TABLE SCROLL CONTAINER ───────────── */
    .instrument__table {
        overflow-x: auto;
        overflow-y: visible;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        scrollbar-color: var(--brand-green) var(--surface-0);
    }

    .instrument__table::-webkit-scrollbar {
        height: 6px;
    }

    .instrument__table::-webkit-scrollbar-track {
        background: var(--surface-0);
        border-radius: 10px;
    }

    .instrument__table::-webkit-scrollbar-thumb {
        background: var(--brand-green);
        border-radius: 10px;
    }

    .instrument__table::-webkit-scrollbar-thumb:hover {
        background: var(--brand-gold);
    }

    /* ───────────── TABLE ───────────── */
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 3px;
        margin-bottom: 0;
        min-width: 820px;
    }

    thead tr {
        position: relative;
    }

    thead th {
        color: var(--brand-green);
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 1.5px;
        padding: 14px 16px;
        background: var(--surface-0);
        border: none;
        white-space: nowrap;
        font-family: 'Courier New', monospace;
    }

    thead th:first-child {
        border-radius: 8px 0 0 8px;
    }

    thead th:last-child {
        border-radius: 0 8px 8px 0;
    }

    /* ─── body rows ─── */
    table tbody tr {
        background: var(--surface-1);
        transition: background 0.18s ease, transform 0.18s ease, box-shadow 0.18s ease;
    }

    table tbody tr:hover {
        background: var(--surface-3) !important;
        transform: scale(1.008);
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.4), 0 0 0 1px var(--border-mid);
    }

    table td {
        padding: 14px 16px;
        font-weight: 500;
        color: var(--text-secondary);
        font-size: 14px;
        white-space: nowrap;
        border-top: 1px solid var(--border-subtle);
        border-bottom: 1px solid transparent;
        vertical-align: middle;
    }

    table td:first-child {
        font-weight: 600;
        color: var(--text-primary);
        border-left: 3px solid transparent;
        border-radius: 8px 0 0 8px;
        transition: border-color 0.18s;
    }

    table tbody tr:hover td:first-child {
        border-left-color: var(--brand-green);
    }

    table td:last-child {
        border-radius: 0 8px 8px 0;
    }

    /* amount column */
    table td:nth-child(3) {
        color: var(--brand-green) !important;
        font-weight: 700 !important;
        font-family: 'Courier New', monospace;
        font-size: 15px !important;
    }

    /* ───────────── PROCESSING BADGE ───────────── */
    .processing-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        background: rgba(158, 221, 5, 0.08);
        color: var(--text-secondary);
        border: 1px solid var(--border-subtle);
        white-space: nowrap;
        font-family: 'Courier New', monospace;
    }

    .processing-badge::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--text-muted);
        flex-shrink: 0;
    }

    .processing-badge.instant {
        background: rgba(158, 221, 5, 0.14);
        color: var(--brand-green);
        border-color: var(--border-mid);
    }

    .processing-badge.instant::before {
        background: var(--brand-green);
        box-shadow: 0 0 6px var(--brand-green);
        animation: pulse-dot 1.6s ease infinite;
    }

    @keyframes pulse-dot {

        0%,
        100% {
            opacity: 1;
            transform: scale(1);
        }

        50% {
            opacity: 0.5;
            transform: scale(0.7);
        }
    }

    /* ───────────── TRADES / CHART CELL ───────────── */
    td[data-cell="chart"] {
        cursor: pointer;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    td[data-cell="chart"]:hover .chart-placeholder span {
        background: linear-gradient(to top, var(--brand-green), var(--brand-gold));
        transform: scaleY(1.25);
        box-shadow: 0 0 6px rgba(158, 221, 5, 0.5);
    }

    .chart-placeholder {
        display: inline-flex;
        align-items: flex-end;
        gap: 3px;
        margin-left: 4px;
        pointer-events: none;
    }

    .chart-placeholder span {
        width: 4px;
        border-radius: 2px;
        background: linear-gradient(to top, var(--brand-green-mid), var(--brand-green));
        transition: all 0.2s ease;
    }

    .chart-placeholder span:nth-child(1) {
        height: 18px;
    }

    .chart-placeholder span:nth-child(2) {
        height: 28px;
    }

    .chart-placeholder span:nth-child(3) {
        height: 14px;
    }

    .chart-placeholder span:nth-child(4) {
        height: 22px;
    }

    /* balance preview badge */
    .balance-preview-badge {
        display: inline-block;
        background: rgba(158, 221, 5, 0.08);
        border: 1px solid var(--border-mid);
        color: var(--brand-green);
        font-size: 12px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 8px;
        line-height: 1.4;
        min-width: 92px;
        text-align: center;
        pointer-events: none;
        font-family: 'Courier New', monospace;
        transition: all 0.2s;
    }

    td[data-cell="chart"]:hover .balance-preview-badge {
        background: rgba(158, 221, 5, 0.16);
        border-color: var(--brand-green);
        box-shadow: 0 0 12px rgba(158, 221, 5, 0.25);
    }

    /* ───────────── PAGINATION ───────────── */
    .paginations {
        margin-top: 36px;
    }

    .lab-ul {
        display: flex !important;
        flex-wrap: wrap !important;
        justify-content: center !important;
        list-style: none !important;
        background: linear-gradient(135deg, var(--surface-1), var(--surface-2)) !important;
        padding: 12px 28px !important;
        width: fit-content !important;
        margin: 0 auto !important;
        gap: 8px;
        border-radius: 50px !important;
        border: 1px solid var(--border-mid);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(158, 221, 5, 0.06);
    }

    .lab-ul li a {
        display: flex !important;
        align-items: center;
        justify-content: center;
        width: 40px !important;
        height: 40px !important;
        background: var(--surface-0);
        color: var(--text-muted);
        border: 1px solid var(--border-subtle);
        border-radius: 50% !important;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        font-family: 'Courier New', monospace;
        transition: all 0.2s ease;
    }

    .lab-ul li a:hover {
        background: var(--brand-green);
        border-color: var(--brand-green);
        color: var(--brand-green-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(158, 221, 5, 0.35);
    }

    .lab-ul li a.active {
        background: var(--brand-green) !important;
        color: var(--brand-green-dark) !important;
        border-color: var(--brand-green) !important;
        box-shadow: 0 4px 16px rgba(158, 221, 5, 0.4);
        font-weight: 900 !important;
    }

    /* ───────────── CHART POPUP ───────────── */
    .chart-popup-overlay {
        position: fixed;
        inset: 0;
        background: rgba(6, 31, 25, 0.96);
        backdrop-filter: blur(8px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 10000;
    }

    .chart-popup-content {
        background: linear-gradient(155deg, var(--surface-1) 0%, var(--surface-2) 60%, var(--surface-3) 100%);
        color: var(--text-primary);
        padding: 36px;
        border-radius: 20px;
        max-width: 920px;
        width: 95%;
        max-height: 92vh;
        overflow-y: auto;
        position: relative;
        border: 1px solid var(--border-strong);
        box-shadow:
            0 0 0 1px var(--border-mid),
            0 40px 100px rgba(0, 0, 0, 0.7),
            0 0 80px rgba(158, 221, 5, 0.12);
        animation: slideInPop 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        scrollbar-width: thin;
        scrollbar-color: var(--brand-green) var(--surface-0);
    }

    .chart-popup-content::-webkit-scrollbar {
        width: 5px;
    }

    .chart-popup-content::-webkit-scrollbar-track {
        background: var(--surface-0);
    }

    .chart-popup-content::-webkit-scrollbar-thumb {
        background: var(--brand-green);
        border-radius: 10px;
    }

    @keyframes slideInPop {
        from {
            transform: scale(0.92) translateY(-20px);
            opacity: 0;
        }

        to {
            transform: scale(1) translateY(0);
            opacity: 1;
        }
    }

    .chart-popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
        padding-bottom: 18px;
        border-bottom: 1px solid var(--border-mid);
        position: relative;
    }

    /* green glow line under header */
    .chart-popup-header::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 80px;
        height: 2px;
        background: var(--brand-green);
        border-radius: 2px;
        box-shadow: 0 0 10px var(--brand-green);
    }

    .chart-popup-header h3 {
        font-size: 22px;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
        letter-spacing: -0.3px;
    }

    .chart-popup-header h3 span {
        color: var(--brand-green);
    }

    .chart-close-btn {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: rgba(158, 221, 5, 0.08);
        border: 1px solid var(--border-mid);
        color: var(--brand-green);
        font-size: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        line-height: 1;
    }

    .chart-close-btn:hover {
        background: var(--brand-green);
        color: var(--brand-green-dark);
        transform: rotate(90deg);
        box-shadow: 0 0 16px rgba(158, 221, 5, 0.4);
    }

    /* ─── info cards inside popup ─── */
    .trader-info {
        display: flex;
        gap: 16px;
        margin-bottom: 28px;
        flex-wrap: wrap;
    }

    .info-card {
        flex: 1;
        min-width: 150px;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.2));
        border: 1px solid var(--border-mid);
        border-radius: 14px;
        padding: 20px 18px;
        text-align: center;
        position: relative;
        overflow: hidden;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .info-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--brand-green), var(--brand-gold));
    }

    .info-card:hover {
        border-color: var(--border-strong);
        box-shadow: 0 0 20px rgba(158, 221, 5, 0.12);
    }

    .info-card .label {
        font-size: 11px;
        color: var(--brand-green);
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 700;
        font-family: 'Courier New', monospace;
    }

    .info-card .value {
        font-size: 26px;
        font-weight: 800;
        color: var(--text-primary);
        font-family: 'Courier New', monospace;
    }

    .info-card .value.positive {
        color: var(--brand-green);
    }

    .info-card .value.negative {
        color: var(--brand-red);
    }

    .info-card .sub-value {
        font-size: 12px;
        color: var(--text-muted);
        margin-top: 6px;
        font-family: 'Courier New', monospace;
    }

    /* ─── chart container in popup ─── */
    .chart-container {
        background: linear-gradient(145deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.25));
        border: 1px solid var(--border-mid);
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 20px;
        height: 300px;
        position: relative;
    }

    /* ─── stats grid in popup ─── */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(175px, 1fr));
        gap: 14px;
        margin-top: 20px;
    }

    .stat-item {
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.15));
        border: 1px solid var(--border-subtle);
        border-radius: 12px;
        padding: 16px;
        transition: border-color 0.2s, transform 0.2s;
    }

    .stat-item:hover {
        border-color: var(--border-mid);
        transform: translateY(-2px);
    }

    .stat-item .stat-label {
        font-size: 11px;
        color: var(--brand-green);
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        font-weight: 700;
        font-family: 'Courier New', monospace;
    }

    .stat-item .stat-value {
        font-size: 17px;
        font-weight: 700;
        color: var(--text-primary);
        font-family: 'Courier New', monospace;
    }

    .stat-item .stat-value small {
        font-size: 11px;
        color: var(--text-muted);
        margin-left: 4px;
    }

    /* ─── loading spinner in popup ─── */
    .chart-loading {
        position: absolute;
        inset: 0;
        background: rgba(6, 31, 25, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
    }

    .chart-loading .spinner {
        width: 48px;
        height: 48px;
        border: 3px solid rgba(158, 221, 5, 0.1);
        border-top-color: var(--brand-green);
        border-radius: 50%;
        animation: spin 0.9s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* ───────────── PROMO POPUP ───────────── */
    .popup-overlay {
        position: fixed;
        inset: 0;
        background: rgba(6, 31, 25, 0.96);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        visibility: hidden;
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 9999;
    }

    .popup-content {
        background: linear-gradient(155deg, var(--surface-1), var(--surface-3));
        color: var(--text-primary);
        padding: 52px 48px;
        border-radius: 20px;
        text-align: center;
        max-width: 500px;
        width: 90%;
        position: relative;
        border: 1px solid var(--border-strong);
        box-shadow: 0 0 80px rgba(158, 221, 5, 0.2), 0 40px 100px rgba(0, 0, 0, 0.6);
        transform: scale(0.92);
        transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .popup-overlay.active {
        visibility: visible;
        opacity: 1;
    }

    .popup-overlay.active .popup-content {
        transform: scale(1);
    }

    .countdown-timer {
        font-size: 22px;
        color: var(--text-primary);
        font-weight: 800;
        margin: 22px 0;
        padding: 16px;
        background: rgba(158, 221, 5, 0.08);
        border-radius: 12px;
        border: 1px solid var(--border-mid);
        font-family: 'Courier New', monospace;
    }

    .cta-btn {
        background: linear-gradient(135deg, var(--brand-green), var(--brand-gold));
        color: var(--brand-green-dark);
        border: none;
        padding: 16px 32px;
        border-radius: 50px;
        cursor: pointer;
        font-weight: 800;
        font-size: 17px;
        width: 100%;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-family: 'Courier New', monospace;
    }

    .cta-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 36px rgba(158, 221, 5, 0.45);
        filter: brightness(1.1);
    }

    .close-btn {
        position: absolute;
        top: 14px;
        right: 18px;
        font-size: 28px;
        cursor: pointer;
        color: var(--brand-green);
        transition: all 0.25s;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(158, 221, 5, 0.06);
        border: 1px solid var(--border-subtle);
        line-height: 1;
    }

    .close-btn:hover {
        color: var(--brand-green-dark);
        background: var(--brand-green);
        transform: rotate(90deg);
    }

    /* ───────────── EMPTY STATE ───────────── */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: var(--text-muted);
    }

    .empty-state i {
        font-size: 56px;
        color: var(--brand-green);
        margin-bottom: 24px;
        opacity: 0.4;
        display: block;
    }

    .empty-state h3 {
        font-size: 22px;
        margin-bottom: 12px;
        color: var(--text-secondary);
        font-weight: 700;
    }

    .empty-state p {
        font-size: 15px;
        max-width: 400px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* ───────────── RESPONSIVE ───────────── */
    @media (max-width: 1200px) {
        thead th {
            font-size: 10px;
            padding: 12px 10px;
        }

        table td {
            font-size: 13px;
            padding: 12px 10px;
        }
    }

    @media (max-width: 992px) {
        .scroll-indicator {
            display: block;
        }

        thead th {
            font-size: 10px;
            padding: 10px 8px;
        }

        table td {
            font-size: 12px;
            padding: 10px 8px;
        }

        .processing-badge {
            font-size: 10px;
            padding: 3px 8px;
        }
    }

    @media (max-width: 768px) {
        .instrument__wrapper {
            padding: 16px;
        }

        thead th {
            font-size: 10px;
            padding: 8px 6px;
        }

        table td {
            font-size: 11px;
            padding: 8px 6px;
        }

        .processing-badge {
            font-size: 9px;
            padding: 2px 6px;
        }

        .chart-placeholder span {
            width: 3px;
        }

        .chart-popup-content {
            padding: 22px;
        }

        .trader-info {
            gap: 10px;
        }

        .info-card {
            padding: 14px;
        }

        .info-card .value {
            font-size: 20px;
        }

        .stats-grid {
            grid-template-columns: 1fr 1fr;
        }

        .lab-ul {
            padding: 10px 18px !important;
            gap: 5px;
        }

        .lab-ul li a {
            width: 34px !important;
            height: 34px !important;
            font-size: 11px;
        }
    }

    @media (max-width: 480px) {
        .instrument__wrapper {
            padding: 10px;
        }

        thead th {
            font-size: 9px;
            padding: 6px 4px;
        }

        table td {
            font-size: 10px;
            padding: 6px 4px;
        }
    }


    /* Add/modify these styles at the end of your existing CSS */

/* ───────────── MAIN CONTAINER ADJUSTMENTS ───────────── */
.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}

.instrument__wrapper {
    background: linear-gradient(145deg, var(--surface-1), var(--surface-2));
    border-radius: 16px;
    padding: 24px 20px;
    margin-bottom: 36px;
    border: 1px solid var(--border-subtle);
    box-shadow: 0 0 0 1px var(--border-subtle), 0 20px 60px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(158, 221, 5, 0.08);
    position: relative;
    overflow-x: auto;
    overflow-y: visible;
}

/* Remove scroll indicator */
.scroll-indicator {
    display: none !important;
}

/* ───────────── TABLE CONTAINER - NO SCROLL ───────────── */
.instrument__table {
    overflow-x: auto;
    overflow-y: visible;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: thin;
    scrollbar-color: var(--brand-green) var(--surface-0);
    margin: 0 -8px;
    padding: 0 8px;
}

.instrument__table::-webkit-scrollbar {
    height: 4px;
}

.instrument__table::-webkit-scrollbar-track {
    background: var(--surface-0);
    border-radius: 10px;
}

.instrument__table::-webkit-scrollbar-thumb {
    background: var(--brand-green);
    border-radius: 10px;
}

/* ───────────── TABLE - FIXED LAYOUT FOR BETTER FIT ───────────── */
table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 3px;
    margin-bottom: 0;
    table-layout: fixed;
    min-width: 100%;
}

/* Column width distribution - adjust percentages as needed */
table th:nth-child(1),
table td:nth-child(1) {
    width: 12%;
}

table th:nth-child(2),
table td:nth-child(2) {
    width: 15%;
}

table th:nth-child(3),
table td:nth-child(3) {
    width: 12%;
}

table th:nth-child(4),
table td:nth-child(4) {
    width: 13%;
}

table th:nth-child(5),
table td:nth-child(5) {
    width: 15%;
}

table th:nth-child(6),
table td:nth-child(6) {
    width: 18%;
}

table th:nth-child(7),
table td:nth-child(7) {
    width: 15%;
}

/* Text overflow handling */
table td,
table th {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Allow some columns to wrap on smaller screens */
@media (max-width: 1200px) {
    table td:nth-child(6),
    table th:nth-child(6) {
        white-space: normal;
        word-break: break-word;
    }
}

/* Responsive adjustments - prevent horizontal scroll */
@media (max-width: 992px) {
    .instrument__wrapper {
        padding: 16px 12px;
    }
    
    table th,
    table td {
        padding: 10px 8px;
        font-size: 12px;
    }
    
    /* Adjust column widths for medium screens */
    table th:nth-child(1),
    table td:nth-child(1) { width: 14%; }
    table th:nth-child(2),
    table td:nth-child(2) { width: 16%; }
    table th:nth-child(3),
    table td:nth-child(3) { width: 12%; }
    table th:nth-child(4),
    table td:nth-child(4) { width: 13%; }
    table th:nth-child(5),
    table td:nth-child(5) { width: 14%; }
    table th:nth-child(6),
    table td:nth-child(6) { width: 16%; }
    table th:nth-child(7),
    table td:nth-child(7) { width: 15%; }
    
    .balance-preview-badge {
        font-size: 11px;
        padding: 3px 8px;
        min-width: 75px;
    }
}

@media (max-width: 768px) {
    .instrument__wrapper {
        padding: 12px 10px;
    }
    
    table th,
    table td {
        padding: 8px 6px;
        font-size: 11px;
    }
    
    /* Hide less important columns on very small screens */
    table th:nth-child(6),
    table td:nth-child(6) {
        display: none;
    }
    
    table th:nth-child(7),
    table td:nth-child(7) {
        width: 20%;
    }
    
    /* Recalculate widths for remaining columns */
    table th:nth-child(1),
    table td:nth-child(1) { width: 16%; }
    table th:nth-child(2),
    table td:nth-child(2) { width: 20%; }
    table th:nth-child(3),
    table td:nth-child(3) { width: 15%; }
    table th:nth-child(4),
    table td:nth-child(4) { width: 18%; }
    table th:nth-child(5),
    table td:nth-child(5) { width: 20%; }
    table th:nth-child(7),
    table td:nth-child(7) { width: 11%; }
    
    .balance-preview-badge {
        font-size: 10px;
        padding: 2px 6px;
        min-width: 65px;
    }
    
    .balance-preview-badge span {
        font-size: 9px;
    }
}

@media (max-width: 576px) {
    /* Hide account type column on very small screens */
    table th:nth-child(6),
    table td:nth-child(6) {
        display: none;
    }
    
    /* Hide location column on very small screens */
    table th:nth-child(7),
    table td:nth-child(7) {
        display: none;
    }
    
    /* Recalculate widths for remaining columns */
    table th:nth-child(1),
    table td:nth-child(1) { width: 20%; }
    table th:nth-child(2),
    table td:nth-child(2) { width: 28%; }
    table th:nth-child(3),
    table td:nth-child(3) { width: 20%; }
    table th:nth-child(4),
    table td:nth-child(4) { width: 22%; }
    table th:nth-child(5),
    table td:nth-child(5) { width: 30%; }
    
    .chart-placeholder {
        display: none !important;
    }
    
    .balance-preview-badge {
        font-size: 9px;
        padding: 2px 4px;
        min-width: 55px;
    }
}

/* Ensure the table fits within its container */
.instrument__wrapper {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

/* Make sure the table doesn't overflow its parent */
table {
    width: 100%;
    min-width: 650px; /* Minimum width to maintain readability */
}

/* Optional: Show a subtle scroll hint on hover */
.instrument__wrapper:hover {
    scrollbar-width: thin;
}

/* For touch devices - better scrolling experience */
@media (hover: none) and (pointer: coarse) {
    .instrument__wrapper {
        -webkit-overflow-scrolling: touch;
    }
}

/* Balance preview badge improvements */
.balance-preview-badge {
    display: inline-block;
    background: rgba(158, 221, 5, 0.08);
    border: 1px solid var(--border-mid);
    color: var(--brand-green);
    font-size: 12px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 8px;
    line-height: 1.3;
    min-width: 92px;
    text-align: center;
    pointer-events: none;
    font-family: 'Courier New', monospace;
    transition: all 0.2s;
}

.balance-preview-badge span {
    font-size: 10px;
    display: block;
    color: #a0f020;
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
$dayProgress = (30 - $i) / 30;
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
'New York, USA','Los Angeles, USA','Chicago, USA','Houston, USA','Miami, USA',
'San Francisco, USA','Dallas, USA','Atlanta, USA','Seattle, USA','Boston, USA',
'Denver, USA','Phoenix, USA','Philadelphia, USA','San Diego, USA','Portland, USA',
'London, UK','Manchester, UK','Paris, France','Lyon, France','Berlin, Germany',
'Frankfurt, Germany','Madrid, Spain','Barcelona, Spain','Rome, Italy','Milan, Italy',
'Amsterdam, Netherlands','Zurich, Switzerland','Stockholm, Sweden',
'Tokyo, Japan','Osaka, Japan','Seoul, South Korea','Busan, South Korea',
'Shanghai, China','Beijing, China','Shenzhen, China','Hong Kong','Taipei, Taiwan',
'Singapore','Bangkok, Thailand','Jakarta, Indonesia','Kuala Lumpur, Malaysia',
'Manila, Philippines','Mumbai, India','Delhi, India','Bangalore, India',
'Dubai, UAE','Abu Dhabi, UAE','Doha, Qatar','Riyadh, Saudi Arabia','Kuwait City, Kuwait',
'Lagos, Nigeria','Abuja, Nigeria','Johannesburg, South Africa','Cape Town, South Africa',
'Nairobi, Kenya','Accra, Ghana','Cairo, Egypt',
'Sydney, Australia','Melbourne, Australia','Auckland, New Zealand'
];

$plans = [
'BTC/USD Scalping Account','ETH Swing Trading Portfolio','Forex EUR/USD Pro Account',
'Gold (XAUUSD) Day Trading','NASDAQ (US100) Index Trader','Crypto Arbitrage Wallet',
'High-Frequency Trading Bot','Options Trading Portfolio','Futures Trading Account',
'DeFi Yield Strategy','Momentum Trading Account','Breakout Strategy Portfolio',
'Smart Money Concepts (SMC)','Algorithmic Trading System','Multi-Asset Trading Account'
];

$processingTimes = ['0 Mins', '5 Mins', '15 Mins', '30 Mins', '1 Hour', '3 Hours', '6 Hours', '12 Hours', '1 Day', '2 Days', '3 Days', '5 Days', '7 Days', 'Instant', '2 Hours', '4 Hours', '8 Hours', '16 Hours'];

for ($i = 0; $i < 150; $i++) {
    $randomDays=rand(0, $startDate->diffInDays($endDate));
    $payoutDate = Carbon::now()->subDays($randomDays);
    $firstName = $firstNames[array_rand($firstNames)];
    $lastName = $lastNames[array_rand($lastNames)];
    $fullName = $firstName . ' ' . $lastName;
    $hardcodedId = -($i + 1);
    $amount = rand(5, 50) * 100;
    $plan = $plans[array_rand($plans)];
    $location = $locations[array_rand($locations)];
    $processingTime = $processingTimes[array_rand($processingTimes)];
    $projectedProfit = $amount * 0.25;
    $chartData = [];
    $chartLabels = [];
    for ($j = 30; $j >= 0; $j--) {
    $date = Carbon::now()->subDays($j);
    $chartLabels[] = $date->format('M d');
    $dayProgress = (30 - $j) / 30;
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

    $combinedPayouts = [];
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
    'is_hardcoded' => false
    ];
    }
    usort($combinedPayouts, function($a, $b) {
    return strtotime($b['pay_date']) - strtotime($a['pay_date']);
    });
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
        <div class="container" style="padding: 20px">
            <div class="page-header__accent">
                <span></span>
                <em style="color: white!important;">Live Payouts</em>
            </div>
            <div class="page-header__content" data-aos="fade-right" data-aos-duration="1000">
                <h2 style="color: white!important;"><b style="color: white!important;">Payouts</b></h2>
                <p style="color: white!important;">
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
                <div class="scroll-indicator">
                    <i class="fas fa-arrow-left"></i>&nbsp; Scroll to see more &nbsp;<i class="fas fa-arrow-right"></i>
                </div>

                <div class="instrument__table table-responsive">
                    <table id="payouts_table">
                        <thead>
                            <tr>
                                <th style="color: white !important;">Pay Date</th>
                                <th style="color: white !important;">Name</th>
                                <th style="color: white !important;">Amount</th>
                                <th style="color: white !important;">Processing Time</th>
                                <th style="color: white !important;">Trades</th>
                                <th style="color: white !important;">Account Type</th>
                                <th style="color: white !important;">Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($paginatedPayouts as $payout)
                            <tr data-id="{{ $payout['id'] }}">
                                <td>
                                    <i class="far fa-calendar-alt me-2" style="color: var(--brand-green);"></i>
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
                                        <span style="margin-left:2px; font-size:11px; color:#9EDD05; font-family:'Courier New',monospace;">
                                            View ↗
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    <span style="color: var(--text-secondary);" title="{{ $payout['plan_name'] }}">
                                        @php
                                        $planName = $payout['plan_name'];
                                        if(strlen($planName) > 20) {
                                        $planName = substr($planName, 0, 18) . '…';
                                        }
                                        @endphp
                                        {{ $planName }}
                                    </span>
                                </td>

                                <td>
                                    <i class="fas fa-map-marker-alt me-1" style="color: var(--brand-green);"></i>
                                    @php
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

            <!-- Pagination -->
        <!-- Pagination -->
@if($totalPayouts > $perPage)
<div class="paginations">
    <ul class="lab-ul">
        
        @if($currentPage == 1)
        <li><a href="#"><i class="fas fa-chevron-left"></i></a></li>
        @else
        <li>
            <a href="{{ request()->fullUrlWithQuery(['page' => $currentPage - 1]) }}">
                <i class="fas fa-chevron-left"></i>
            </a>
        </li>
        @endif

        @for($page = max(1, $currentPage - 2); $page <= min($lastPage, $currentPage + 2); $page++)
            @if($page == $currentPage)
                <li><a href="#" class="active">{{ $page }}</a></li>
            @else
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['page' => $page]) }}">
                        {{ $page }}
                    </a>
                </li>
            @endif
        @endfor

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

<style>
    .paginations,
    .paginations a,
    .paginations i {
        color: #fff !important;
    }

    .paginations a.active {
        color: #fff !important;
        background-color: #9EDD05; /* optional highlight */
        border-radius: 5px;
        padding: 5px 10px;
    }
</style>
        </div>
    </section>

    <!-- Chart Popup Modal -->
    <div id="chartPopup" class="chart-popup-overlay">
        <div class="chart-popup-content">
            <div class="chart-popup-header">
                <h3 style="color: white !important;">Trading Performance: <span id="traderName" style="color: white !important;"></span></h3>
                <div class="chart-close-btn" style="color: white !important;" onclick="hideChartPopup()">&times;</div>
            </div>

            <div class="trader-info">
                <div class="info-card">
                    <div class="label" style="color: white !important;">Account Balance</div>
                    <div class="value" id="accountBalance" style="color: white !important;">$0</div>
                    <div class="sub-value" id="balanceDate" style="color: white !important;"></div>
                </div>
                <div class="info-card">
                    <div class="label" style="color: white !important;">Profit &amp; Loss</div>
                    <div class="value positive" id="profitLoss" style="color: white !important;">+$0</div>
                    <div class="sub-value" id="plDate" style="color: white !important;"></div>
                </div>
                <div class="info-card">
                    <div class="label" style="color: white !important;">Win Rate</div>
                    <div class="value" id="winRate" style="color: white !important;">0%</div>
                    <div class="sub-value" style="color: white !important;">Last 30 days</div>
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
                    <div class="stat-label" style="color: white !important;">Total Trades</div>
                    <div class="stat-value" id="totalTrades" style="color: white !important;">0</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label" style="color: white !important;">Winning Trades</div>
                    <div class="stat-value" id="winningTrades" style="color: white !important;">0</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label" style="color: white !important;">Avg. Profit/Trade</div>
                    <div class="stat-value" id="avgProfit" style="color: white !important;">$0</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label" style="color: white !important;">Profit Factor</div>
                    <div class="stat-value" id="profitFactor" style="color: white !important;">0</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label" style="color: white !important;">Payout Date</div>
                    <div class="stat-value" id="payoutDate" style="color: white !important;"></div>
                </div>
                <div class="stat-item">
                    <div class="stat-label" style="color: white !important;">Account Type</div>
                    <div class="stat-value" id="accountType" style="color: white !important;"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Investment data from PHP
        const investmentData = @json($investmentData);
        let tradingChart = null;

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
                const amount = investment.amount;
                const profit = investment.profit;
                const labels = investment.chart_labels;
                const points = labels.length;

                const risingData = labels.map((_, i) => {
                    const progress = i / (points - 1);
                    const noise = (Math.random() - 0.48) * profit * 0.08;
                    return parseFloat((amount + (profit * progress) + noise).toFixed(2));
                });

                risingData[0] = amount;
                risingData[points - 1] = parseFloat((amount + profit).toFixed(2));

                tradingChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Account Balance',
                            data: risingData,
                            borderColor: '#9EDD05',
                            backgroundColor: 'rgba(158,221,5,0.10)',
                            fill: true,
                            tension: 0.4,
                            borderWidth: 2.5,
                            pointRadius: 2,
                            pointHoverRadius: 5,
                            pointBackgroundColor: '#9EDD05',
                            pointBorderColor: '#0C3A30',
                            pointBorderWidth: 1.5
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
                                labels: {
                                    color: '#9EDD05',
                                    font: {
                                        family: 'Courier New',
                                        size: 12
                                    }
                                }
                            },
                            tooltip: {
                                backgroundColor: '#061f19',
                                titleColor: '#9EDD05',
                                bodyColor: '#f0fff4',
                                borderColor: '#9EDD05',
                                borderWidth: 1,
                                padding: 12,
                                callbacks: {
                                    label: ctx => 'Balance: $' + ctx.raw.toLocaleString('en-US', {
                                        minimumFractionDigits: 2
                                    })
                                }
                            }
                        },
                        scales: {
                            y: {
                                suggestedMin: amount * 0.99,
                                suggestedMax: (amount + profit) * 1.02,
                                ticks: {
                                    color: '#a8d4b8',
                                    font: {
                                        family: 'Courier New',
                                        size: 11
                                    },
                                    callback: value => '$' + Number(value).toLocaleString('en-US', {
                                        minimumFractionDigits: 2
                                    })
                                },
                                grid: {
                                    color: 'rgba(158,221,5,0.07)'
                                }
                            },
                            x: {
                                ticks: {
                                    color: '#a8d4b8',
                                    font: {
                                        family: 'Courier New',
                                        size: 10
                                    },
                                    maxTicksLimit: 8
                                },
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }, 200);
        }

        function hideChartPopup() {
            document.getElementById('chartPopup').style.display = 'none';
            if (tradingChart) {
                tradingChart.destroy();
                tradingChart = null;
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') hideChartPopup();
        });

        document.addEventListener('click', function(e) {
            const popup = document.getElementById('chartPopup');
            if (e.target === popup) hideChartPopup();
        });

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
                    countdown.innerHTML = "Offer expired! Check back soon.";
                    clearInterval(interval);
                    return;
                }

                countdown.innerHTML = `
                    <span style="display:flex;justify-content:center;gap:8px;">
                        <span style="background:#9EDD05;color:#0C3A30;padding:6px 14px;border-radius:6px;font-family:'Courier New',monospace;font-weight:800;">${minutes.toString().padStart(2,'0')}m</span>
                        <span style="background:#9EDD05;color:#0C3A30;padding:6px 14px;border-radius:6px;font-family:'Courier New',monospace;font-weight:800;">${seconds.toString().padStart(2,'0')}s</span>
                    </span>
                `;
            }

            updateTimer();
            const interval = setInterval(updateTimer, 1000);
        }

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

    @push('scripts')
    <script>
        if (typeof AOS !== 'undefined') {
            AOS.init({
                once: true,
                duration: 800
            });
        }
    </script>
    @endpush

    @endsection