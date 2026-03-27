@extends('layout.app')

@section('content')

<style>
    /* Press Page Specific Styles */
    .page-header {
        background: linear-gradient(145deg, #0C3A30, #062018);
        padding: 80px 0;
        margin-bottom: 60px;
        border-bottom: 3px solid #8BC905;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -150px;
        right: -100px;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(139,201,5,0.1) 0%, transparent 70%);
        pointer-events: none;
    }

    .page-header h2 {
        color: white;
        font-size: 3.2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .page-header h2 b {
        color: #8BC905;
        font-weight: 800;
    }

    .page-header p {
        font-size: 1.2rem;
        color: rgba(255,255,255,0.9);
        max-width: 600px;
    }

    /* Press Cards */
    .press-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 40px -15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        margin-bottom: 2rem;
        border: 1px solid rgba(139,201,5,0.1);
    }

    .press-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 50px -20px rgba(139,201,5,0.2);
        border-color: #8BC905;
    }

    .press-card-inner {
        display: flex;
        flex-wrap: wrap;
    }

    .press-thumb {
        flex: 0 0 300px;
        background: linear-gradient(145deg, #f8fff8, #f0f9f0);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        border-right: 1px solid rgba(139,201,5,0.2);
    }

    .press-thumb img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
    }

    .press-content {
        flex: 1;
        padding: 2rem;
    }

    .press-content h5 {
        color: #0C3A30;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
        line-height: 1.4;
    }

    .press-content h5 .fw-light {
        font-weight: 400;
        color: #6c7c7a;
    }

    .press-content h5 span {
        color: #8BC905;
    }
.breadcrumb-item::after,
.breadcrumb-item::before,
.breadcrumb li::after,
.breadcrumb li::before {
    content: none !important;
    display: none !important;
}
    .press-content p {
        color: #4A5C5A;
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }

    .press-meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 0.8rem;
    }

    .press-meta-tag {
        background: rgba(139,201,5,0.1);
        color: #8BC905;
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .press-meta-tag:hover {
        background: #8BC905;
        color: #0C3A30;
        transform: translateY(-2px);
    }

    .dropdown-toggle {
        background: rgba(139,201,5,0.1);
        color: #8BC905;
        border: none;
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .dropdown-toggle:hover {
        background: #8BC905;
        color: #0C3A30;
    }

    .dropdown-menu {
        background: white;
        border: 1px solid rgba(139,201,5,0.2);
        border-radius: 16px;
        padding: 0.5rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .dropdown-item {
        color: #4A5C5A;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background: rgba(139,201,5,0.1);
        color: #8BC905;
    }

    @media (max-width: 991px) {
        .page-header h2 {
            font-size: 2.5rem;
        }
        .press-card-inner {
            flex-direction: column;
        }
        .press-thumb {
            flex: none;
            border-right: none;
            border-bottom: 1px solid rgba(139,201,5,0.2);
        }
    }

    @media (max-width: 767px) {
        .page-header {
            padding: 60px 0;
        }
        .page-header h2 {
            font-size: 2rem;
        }
        .press-content {
            padding: 1.5rem;
        }
        .press-content h5 {
            font-size: 1.3rem;
        }
    }
</style>

<!-- Page Header -->
<section class="page-header bg--cover">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" style="color: rgba(255,255,255,0.7);">Home</a></li>
                        <li class="breadcrumb-item separator" style="color: rgba(255,255,255,0.4);">/</li>
                        <li class="breadcrumb-item active" style="color: #8BC905;" aria-current="page">Press Releases</li>
                    </ol>
                </nav>
                <h2>Press & <br> <b>Media Releases</b></h2>
                <p>Stay up to date with the latest DayTraders.com news, platform launches, and company achievements.</p>
            </div>
        </div>
    </div>
</section>

<!-- Press Releases Section -->
<section class="padding-bottom padding-top bg-black">
    <div class="container">
        <div class="press-wrapper">
            
            <!-- Press Release 1 -->
            <div class="press-card" data-aos="fade-up" data-aos-duration="800">
                <div class="press-card-inner">
                    <div class="press-thumb">
                        <img src="{{ asset('assets/images/blog/1.png') }}" alt="ProjectX Launch">
                    </div>
                    <div class="press-content">
                        <h5><span class="fw-light">Launch of</span> <span>ProjectX – Advanced Futures Trading Platform</span></h5>
                        <p><b>DayTraders.com Launches ProjectX</b>: Discover our advanced futures trading platform powered by TradingView. ProjectX offers cutting-edge charting, analytics, and a seamless trading experience for professional and retail traders.</p>
                        
                        <div class="press-meta">
                            <a href="https://finance.yahoo.com/news/daytraders-com-launches-projectx-advanced-130000584.html" class="press-meta-tag" target="_blank">Yahoo! Finance</a>
                            <a href="https://apnews.com/press-release/pr-newswire/daytraders-com-launches-projectx-an-advanced-futures-trading-platform-powered-by-tradingview-301b623cde9b0dc24708f440ef68baed" class="press-meta-tag" target="_blank">AP News</a>
                           
                            <a href="https://www.prnewswire.com/news-releases/daytraderscom-launches-projectx-an-advanced-futures-trading-platform-powered-by-tradingview-302478788.html" class="press-meta-tag" target="_blank">PR Newswire</a>

                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    View More Coverage
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="https://seekingalpha.com/pr/20112093-daytraders-com-hits-1-million-in-payouts-raising-the-bar-for-futures-funding-and-trader" target="_blank">Seeking Alpha</a></li>
                                    <li><a class="dropdown-item" href="https://newsblaze.com/pr-newswire/?rkey=20250611LA07329&filter=12684" target="_blank">NewsBlaze</a></li>
                                    <li><a class="dropdown-item" href="https://northeast.newschannelnebraska.com/story/52843067/daytraderscom-launches-projectx-an-advanced-futures-trading-platform-powered-by-tradingview" target="_blank">News Channel Nebraska</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Press Release 2 -->
            <div class="press-card" data-aos="fade-up" data-aos-duration="800">
                <div class="press-card-inner">
                    <div class="press-thumb">
                        <img src="{{ asset('assets/images/blog/2.png') }}" alt="$1 Million Payouts">
                    </div>
                    <div class="press-content">
                        <h5><span class="fw-light">Milestone:</span> <span>$1 Million in Trader Payouts</span></h5>
                        <p><b>DayTraders.com Surpasses $1M in Payouts</b>: Celebrating over $1,000,000 paid out to traders—proving our commitment to transparency, fairness, and innovation in the prop trading funding industry.</p>
                        
                        <div class="press-meta">
                            <a href="https://finance.yahoo.com/news/daytraders-com-hits-1-million-130000801.html" class="press-meta-tag" target="_blank">Yahoo! Finance</a>
                            <a href="https://apnews.com/press-release/pr-newswire/daytraders-com-hits-1-million-in-payouts-raising-the-bar-for-futures-funding-and-trader-technology-469b7f041fdd18aff842dfa19469d5e6" class="press-meta-tag" target="_blank">AP News</a>
                            <a href="https://www.benzinga.com/pressreleases/25/05/n45541162/daytraders-com-hits-1-million-in-payouts-raising-the-bar-for-futures-funding-and-trader-technology" class="press-meta-tag" target="_blank">Benzinga</a>
                            <a href="https://www.prnewswire.com/news-releases/daytraderscom-hits-1-million-in-payouts-raising-the-bar-for-futures-funding-and-trader-technology-302461220.html" class="press-meta-tag" target="_blank">PR Newswire</a>

                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    View More Coverage
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="https://seekingalpha.com/pr/20112093-daytraders-com-hits-1-million-in-payouts-raising-the-bar-for-futures-funding-and-trader" target="_blank">Seeking Alpha</a></li>
                                    <li><a class="dropdown-item" href="https://www.morningstar.com/news/pr-newswire/20250521la92825/daytraderscom-hits-1-million-in-payouts-raising-the-bar-for-futures-funding-and-trader-technology" target="_blank">Morningstar</a></li>
                                    <li><a class="dropdown-item" href="https://newsblaze.com/pr-newswire/?rkey=20250521LA92825&filter=12684" target="_blank">NewsBlaze</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Remove or comment out any old commented sections -->

@endsection