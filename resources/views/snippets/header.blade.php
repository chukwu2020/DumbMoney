<!-- ===============>> Header section start here <<================= -->
<header class="header-section header-section--style2">
    <div class="header-bottom w-full">
        <div class="header-container">
            <div class="header-wrapper">
                <div class="logo">
                    <a href="/">
                        <img src="{{ asset('assets/images/chartmasterbrandname1.png') }}" alt="Market Mind Logo">
                    </a>
                </div>

                <div class="menu-area">
                    <ul id="menu" class="menu menu--style1">
                        <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                        <li><a href="{{ route('about.us') }}" class="{{ Route::is('about.us') ? 'active' : '' }}">About</a></li>
                        <li><a href="{{ route('affiliates') }}" class="{{ Route::is('affiliates') ? 'active' : '' }}">Affiliates</a></li>
                        <li><a href="{{ route('payouts') }}" class="{{ Route::is('payouts') ? 'active' : '' }}">Payouts</a></li>
                        <li><a href="{{ route('helpdesk') }}" target="_blank">Help Desk</a></li>

                        <li class="menu-item-has-children">
                            <a href="javascript:void(0);">Learn</a>
                            <ul class="submenu">
                                <li class="menu-item-has-children">
                                    <a href="javascript:void(0);">Trading Basics</a>
                                    <ul class="submenu">
                                        <li><a href="{{route('education.funding')}}">Funding Explained</a></li>
                                        <li><a href="{{route('education.evaluations')}}">How Evaluations Work</a></li>
                                        <li><a href="{{route('education.prop-firms')}}">Are Trading platform Legit?</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="javascript:void(0);">Rules and Risk</a>
                                    <ul class="submenu">
                                        <li><a href="{{route('education.trailing-drawdown')}}">Trailing Drawdown Explained</a></li>
                                        <li><a href="{{route('education.consistency-rules')}}">Consistency Rules Explained</a></li>
                                        <li><a href="{{route('education.challenge-cost-vs-risk')}}">Challenge Cost vs Real Risk</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="javascript:void(0);">Trader Psychology</a>
                                    <ul class="submenu">
                                        <li><a href="{{route('education.psychology1')}}">Psychology and Risk Control</a></li>
                                        <li><a href="{{route('education.psychology2')}}">Why Traders Fail Evaluations</a></li>
                                        <li><a href="{{route('education.make-living-trading')}}">Can You Make a Living Trading?</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="javascript:void(0);">Company</a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('terms.privacy') }}">Terms & Privacy</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    
                    <!-- Mobile Menu Buttons - Added for mobile view -->
                    <div class="mobile-menu-buttons">
                        <a href="{{ route('login') }}" class="mobile-login-btn">
                            <i class="fa-solid fa-sign-in-alt"></i>
                            Login
                        </a>
                        <a href="{{ route('signup') }}" class="mobile-signup-btn">
                            <i class="fa-solid fa-user-plus"></i>
                            Sign Up
                        </a>
                    </div>
                </div>

                <div class="header-action">
                    <div class="header-btn login-btn">
                        <a class="trk-btn trk-btn--small trk-btn--outline" href="{{ route('login') }}">
                            Login <i class="fa-solid fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="header-btn signup-btn">
                        <a class="trk-btn trk-btn--small trk-btn--primary" href="{{ route('signup') }}">
                            Sign Up <i class="fa-solid fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="header-bar d-xl-none header-bar--style1">
                        <span></span><span></span><span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    /* Header Section Styles */
    .header-section--style2 {
        position: sticky;
        top: 0;
        width: 100%;
        background: #ffffff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        z-index: 10000;
        border-bottom: 2px solid #f0f0f0;
    }

    .header-bottom {
        width: 100%;
        background: transparent;
    }

    .header-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 30px;
    }

    .header-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-height: 85px;
    }

    .logo {
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    .logo:hover {
        transform: scale(1.02);
    }

    .logo a {
        display: inline-block;
        text-decoration: none;
    }

    .logo img {
        max-height: 52px;
        width: auto;
        transition: all 0.3s ease;
    }

    .menu-area {
        display: flex;
        align-items: center;
        margin: 0 20px;
    }

    .menu {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 2px;
    }

    .menu > li {
        position: relative;
        margin: 0;
    }

    .menu > li > a {
        display: block;
        padding: 10px 18px;
        color: #2d3436;
        font-weight: 500;
        font-size: 15px;
        text-decoration: none;
        transition: all 0.3s ease;
        border-radius: 6px;
        letter-spacing: 0.3px;
    }

    .menu > li > a:hover {
        color: #9edd05;
        background: rgba(158, 221, 5, 0.05);
    }

    .menu > li > a.active {
        color: #9edd05;
        font-weight: 600;
        position: relative;
    }

    .menu > li > a.active::after {
        content: '';
        position: absolute;
        bottom: 5px;
        left: 18px;
        right: 18px;
        height: 2px;
        background: #9edd05;
        border-radius: 2px;
    }

    .menu-item-has-children {
        position: relative;
    }

    .menu-item-has-children > a {
        position: relative;
        padding-right: 32px !important;
    }

    .menu-item-has-children > a:after {
        content: "\f107";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 12px;
        color: #888;
        transition: all 0.3s ease;
    }

    .menu-item-has-children:hover > a:after {
        transform: translateY(-50%) rotate(180deg);
        color: #9edd05;
    }

    .submenu {
        position: absolute;
        top: 100%;
        left: 0;
        min-width: 250px;
        background: #ffffff;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        border-radius: 12px;
        padding: 10px 0;
        opacity: 0;
        visibility: hidden;
        transform: translateY(15px);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        z-index: 1000;
        list-style: none;
        margin: 0;
        border: 1px solid rgba(0, 0, 0, 0.04);
    }

    .submenu:before {
        content: '';
        position: absolute;
        top: -6px;
        left: 25px;
        width: 12px;
        height: 12px;
        background: #ffffff;
        transform: rotate(45deg);
        border-left: 1px solid rgba(0, 0, 0, 0.04);
        border-top: 1px solid rgba(0, 0, 0, 0.04);
    }

    .menu-item-has-children:hover > .submenu {
        opacity: 1;
        visibility: visible;
        transform: translateY(5px);
    }

    .submenu li {
        position: relative;
        width: 100%;
    }

    .submenu li a {
        display: block;
        padding: 10px 25px;
        color: #4a5568;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        white-space: nowrap;
        line-height: 1.5;
    }

    .submenu li a:hover {
        background: rgba(158, 221, 5, 0.08);
        color: #9edd05;
        padding-left: 30px;
    }

    .submenu .menu-item-has-children {
        position: relative;
    }

    .submenu .menu-item-has-children > a {
        position: relative;
        padding-right: 35px;
    }

    .submenu .menu-item-has-children > a:after {
        content: "\f105";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 12px;
        color: #888;
        transition: all 0.3s ease;
    }

    .submenu .menu-item-has-children:hover > a:after {
        color: #9edd05;
        right: 18px;
    }

    .submenu .menu-item-has-children .submenu {
        top: -10px;
        left: 100%;
        transform: translateX(10px);
        margin-left: 5px;
    }

    .submenu .menu-item-has-children .submenu:before {
        left: -6px;
        top: 20px;
        transform: rotate(45deg);
        border-right: 1px solid rgba(0, 0, 0, 0.04);
        border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        border-left: none;
        border-top: none;
    }

    .submenu .menu-item-has-children:hover > .submenu {
        transform: translateX(0);
    }

    .header-action {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }

    .header-btn {
        display: flex;
        align-items: center;
    }

    .trk-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 22px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 14px;
        border: 2px solid transparent;
        letter-spacing: 0.3px;
        line-height: 1.4;
        cursor: pointer;
    }

    .trk-btn--small {
        padding: 8px 18px;
        font-size: 13px;
    }

    .trk-btn--outline {
        background: transparent;
        border-color: #9edd05;
        color: #9edd05;
    }

    .trk-btn--outline:hover {
        background: #9edd05;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(158, 221, 5, 0.3);
    }

    .trk-btn--primary {
        background: #9edd05;
        color: #ffffff;
        border-color: #9edd05;
    }

    .trk-btn--primary:hover {
        background: #7cc300;
        border-color: #7cc300;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(124, 195, 0, 0.3);
    }

    .fa-arrow-right {
        font-size: 12px;
        margin-left: 6px;
        transition: transform 0.3s ease;
    }

    .trk-btn:hover .fa-arrow-right {
        transform: translateX(4px);
    }

    /* Mobile Menu Buttons */
    .mobile-menu-buttons {
        display: none;
        flex-direction: column;
        gap: 12px;
        margin-top: 20px;
        padding: 15px;
        border-top: 1px solid #e5e7eb;
    }

    .mobile-login-btn,
    .mobile-signup-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
        text-align: center;
    }

    .mobile-login-btn {
        background: transparent;
        border: 2px solid #9edd05;
        color: #9edd05;
    }

    .mobile-login-btn:hover {
        background: #9edd05;
        color: #ffffff;
    }

    .mobile-signup-btn {
        background: #9edd05;
        color: #ffffff;
        border: 2px solid #9edd05;
    }

    .mobile-signup-btn:hover {
        background: #7cc300;
        border-color: #7cc300;
    }

    .header-bar {
        display: none;
        flex-direction: column;
        width: 40px;
        cursor: pointer;
        padding: 5px;
        
    }

    .header-bar span {
        width: 100%;
        height: 3px;
        background: #333;
        margin: 3px 0;
        border-radius: 3px;
        transition: all 0.3s ease;
    }

    .header-bar:hover span {
        background: #9edd05;
    }

    .header-bar.active span:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }

    .header-bar.active span:nth-child(2) {
        opacity: 0;
    }

    .header-bar.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -7px);
    }

    @media (max-width: 1399.98px) {
        .menu > li > a {
            padding: 8px 14px;
            font-size: 14px;
        }
    }

    @media (max-width: 1199.98px) {
        .header-container {
            padding: 0 20px;
        }

        .menu-area {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: #ffffff;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-top: 2px solid #9edd05;
            margin: 0;
            z-index: 1000;
            flex-direction: column;
        }

        .menu-area.active {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .menu {
            flex-direction: column;
            gap: 0;
        }

        .menu > li {
            width: 100%;
            margin: 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .menu > li:last-child {
            border-bottom: none;
        }

        .menu > li > a {
            padding: 14px 20px;
            border-radius: 6px;
        }

        .menu > li > a.active::after {
            display: none;
        }

        .submenu {
            position: static;
            opacity: 1;
            visibility: visible;
            transform: none;
            box-shadow: none;
            border: none;
            background: #f8f9fa;
            margin: 5px 0 5px 15px;
            padding: 5px 0;
            display: none;
            width: auto;
        }

        .submenu:before {
            display: none;
        }

        .menu-item-has-children.active > .submenu {
            display: block;
            animation: slideDown 0.3s ease;
        }

        .submenu .submenu {
            margin-left: 15px;
            background: #f1f3f5;
        }

        .submenu li a {
            padding: 10px 20px;
            white-space: normal;
        }

        /* Show mobile buttons when menu is open */
        .menu-area.active .mobile-menu-buttons {
            display: flex;
        }

        .header-bar {
            display: flex;
        }
    }

    @media (max-width: 767.98px) {
        .header-container {
            padding: 0 15px;
        }

        .header-wrapper {
            min-height: 70px;
            gap: 8px;
        }

        .logo img {
            max-height: 40px;
        }

        .header-action {
            gap: 4px;
            margin-left: auto;
        }
        
        .signup-btn {
            display: none;
        }
        
        .login-btn {
            display: flex;
        }
        
        .header-bar {
            margin-left: 0;
        }
        
        .trk-btn--outline {
            padding: 5px 10px;
            font-size: 12px;
            min-width: auto;
        }
        
        .login-btn .trk-btn {
            margin-right: 0;
        }
    }

    @media (max-width: 480px) {
        .trk-btn--outline {
            padding: 4px 8px;
            font-size: 11px;
        }
        
        .header-action {
            gap: 3px;
        }
        
        .mobile-login-btn,
        .mobile-signup-btn {
            padding: 10px 16px;
            font-size: 13px;
        }
    }

    .w-full {
        width: 100%;
    }

    .d-xl-none {
        display: none;
    }

    @media (max-width: 1199.98px) {
        .d-xl-none {
            display: flex;
        }
    }

    .me-xl-4 {
        margin-right: 1.5rem;
    }

    .ms-1 {
        margin-left: 0.25rem;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.header-bar');
    const menuArea = document.querySelector('.menu-area');
    
    if (menuToggle && menuArea) {
        menuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            this.classList.toggle('active');
            menuArea.classList.toggle('active');
        });
    }

    const menuItems = document.querySelectorAll('.menu-item-has-children > a');
    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            if (window.innerWidth <= 1199) {
                e.preventDefault();
                const parent = this.parentElement;
                parent.classList.toggle('active');
            }
        });
    });

    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 1199) {
            const menuArea = document.querySelector('.menu-area');
            const menuToggle = document.querySelector('.header-bar');
            
            if (menuArea && menuArea.classList.contains('active') && 
                !menuArea.contains(e.target) && 
                !menuToggle.contains(e.target)) {
                menuArea.classList.remove('active');
                menuToggle.classList.remove('active');
            }
        }
    });
});
</script>