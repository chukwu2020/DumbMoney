@extends('layout.app')

@section('content')

<style>
    /* About Page Styles */
    .about-section {
        padding: 80px 0;
        background: linear-gradient(145deg, #ffffff, #f8fafc);
    }

    .about-section__title {
        font-size: 3rem;
        font-weight: 700;
        color: #0C3A30;
        margin-bottom: 30px;
    }

    .about-section__title span {
        color: #8BC905;
        position: relative;
        display: inline-block;
    }

    .about-section__title span::after {
        content: '';
        position: absolute;
        bottom: 5px;
        left: 0;
        width: 100%;
        height: 8px;
        background: rgba(139, 201, 5, 0.2);
        border-radius: 30px;
        z-index: -1;
    }

    .about-section__description {
        color: #4A5C5A;
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 30px;
    }

    .about-section__quote {
        background: rgba(139, 201, 5, 0.05);
        border-left: 4px solid #8BC905;
        padding: 30px;
        border-radius: 12px;
        margin: 30px 0;
    }

    .about-section__quote p {
        font-size: 1.1rem;
        font-style: italic;
        color: #0C3A30;
        margin-bottom: 20px;
    }

    .about-section__quote-author {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .about-section__quote-author img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #8BC905;
    }

    .about-section__quote-author strong {
        color: #0C3A30;
        font-size: 1.1rem;
    }

    .about-section__quote-author span {
        color: #4A5C5A;
    }

    /* Team Section */
    .team-section {
        padding: 80px 0;
        background: #000000;
    }

    .team-section__content h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 20px;
    }

    .team-section__content h2 span {
        color: #8BC905;
    }

    .team-section__content p {
        color: rgba(255,255,255,0.8);
        font-size: 1.1rem;
        line-height: 1.7;
    }

    /* Founder Card */
    .founder {
        background: rgba(255,255,255,0.05);
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        max-width: 500px;
        margin: 0 auto;
    }

    .founder:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px -15px rgba(139,201,5,0.2);
    }

    .founder__image {
        width: 100%;
        height: 350px;
        overflow: hidden;
    }

    .founder__image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .founder:hover .founder__image img {
        transform: scale(1.05);
    }

    .founder__info {
        padding: 30px;
    }

    .founder__info-header h2 {
        font-size: 1.6rem;
        font-weight: 700;
        color: white;
        margin-bottom: 5px;
    }

    .founder__info-header h2 span {
        color: #8BC905;
    }

    .founder__info-header p {
        color: #8BC905;
        font-size: 1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .founder__info-content p {
        color: rgba(255,255,255,0.7);
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 20px;
    }

    .founder__stats {
        display: flex;
        gap: 20px;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid rgba(139,201,5,0.2);
    }

    .founder__stat {
        flex: 1;
        text-align: center;
    }

    .founder__stat-number {
        font-size: 1.8rem;
        font-weight: 700;
        color: #8BC905;
        display: block;
    }

    .founder__stat-label {
        font-size: 0.8rem;
        color: rgba(255,255,255,0.6);
    }

    .founder__social {
        margin-top: 20px;
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .founder__social a {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(139,201,5,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #8BC905;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .founder__social a:hover {
        background: #8BC905;
        color: #000;
        transform: translateY(-3px);
    }

    /* Package Section */
    .package {
        padding: 80px 0;
        background: linear-gradient(145deg, #f8fafc, #ffffff);
    }

    .package-item {
        background: white;
        border: 1px solid rgba(139,201,5,0.1);
        border-radius: 16px;
        padding: 30px;
        height: 100%;
        transition: all 0.3s ease;
    }

    .package-item:hover {
        transform: translateY(-10px);
        border-color: #8BC905;
        box-shadow: 0 20px 40px -15px rgba(139,201,5,0.15);
    }

    .package-item__icon {
        width: 70px;
        height: 70px;
        background: rgba(139,201,5,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
    }

    .package-item__icon i {
        font-size: 2rem;
        color: #8BC905;
    }

    .package-item__content h4 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #0C3A30;
        margin-bottom: 15px;
    }

    .package-item__content p {
        color: #4A5C5A;
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* CTA Section */
    .cta {
        padding: 80px 0;
        background: linear-gradient(145deg, #f8fafc, #ffffff);
    }

    .cta__content h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #0C3A30;
        margin-bottom: 20px;
    }

    .cta__content h2 span {
        color: #8BC905;
    }

    .cta__content p {
        color: #4A5C5A;
        font-size: 1.1rem;
        margin-bottom: 30px;
    }

    .cta__content .text-btn {
        color: #0C3A30;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        transition: gap 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .cta__content .text-btn:hover {
        gap: 12px;
        color: #8BC905;
    }

    .cta__thumb {
        text-align: right;
    }

    .cta__thumb img {
        max-width: 100%;
        height: auto;
    }

    @media (max-width: 991px) {
        .about-section__title {
            font-size: 2.5rem;
        }
        
        .team-section__content {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .cta__thumb {
            text-align: center;
            margin-top: 40px;
        }
        
        .founder {
            max-width: 100%;
        }
    }
</style>

<!-- ===============>> About Section Start <<================= -->
<section class="about-section padding-top padding-bottom">
    <div class="container">
    <div class="row g-5 align-items-center justify-content-between">
        <!-- Left Column - Content -->
        <div class="col-lg-6">
            <div class="about-section__content pe-lg-4" data-aos="fade-right">
                <h2 class="about-section__title">
                    About <span>Us</span>
                </h2>
                
                <p class="about-section__description">
                    At Dumb Money, we built the technology powering some of the world's most successful
                    funding companies. We're building a community that's transforming the trading landscape by 
                    offering unmatched tools, education, and support for traders at every level. Our mission is 
                    simple: to empower traders worldwide with the knowledge, resources, and capital needed to 
                    achieve true financial freedom.
                </p>
                
                <blockquote class="about-section__quote">
                    <p>
                        "After mentoring over 90,000 traders across 50+ countries, I realized that access to capital was the biggest barrier to success. I created Dumb Money to level the playing field and give every aspiring trader a fair shot at financial freedom."
                    </p>
                    <cite class="about-section__quote-author">
                        <img src="{{ asset('assets/images/dumbmoneyadmin.jpeg') }}" alt="CN 🍞（笨錢社群管理員&客服）">
                        <span><strong>CN 🍞（笨錢社群管理員&客服）</strong> - Founder &amp; Master Trader</span>
                    </cite>
                </blockquote>
                
                <p class="about-section__description">
                    Built by one of the world's most respected professional traders, Dumb Money represents a lifetime of market mastery. Our founder has personally mentored over 90,000 traders globally through our Discord community, sharing proven strategies that have consistently delivered results. We provide cutting-edge technology, personalized support, and an education system engineered to transform beginners into consistently profitable traders.
                </p>
            </div>
        </div>
        
        <!-- Right Column - Image -->
        <div class="col-lg-6">
            <div class="about-section__image text-center ps-lg-4" data-aos="fade-left">
                <img src="{{ asset('assets1/images/others/4.png') }}" 
                     alt="Trading Technology" 
                     class="img-fluid rounded-4 shadow"
                     onerror="this.src='https://via.placeholder.com/500x400/0C3A30/8BC905?text=Trading+Technology'"
                     style="max-width: 100%; height: auto;">
            </div>
        </div>
    </div>
</div>
</section>
<!-- ===============>> About Section End <<================= -->

<!-- ===============>> Founder Section Start <<================= -->
<section class="team-section padding-bottom padding-top bg-black">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="team-section__content">
                    <h2>Meet Our <span>Founder</span></h2>
                    <p>A visionary trader who has transformed the lives of over 90,000 members worldwide through expert mentorship and innovative trading solutions.</p>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="founder">
                            <div class="founder__image">
                                <img src="{{ asset('assets/images/dumbmoneyadmin.jpeg') }}" alt="CN 🍞（笨錢社群管理員&客服） - Founder & Master Trader">
                            </div>
                            <div class="founder__info">
                                <div class="founder__info-header">
                                    <h2>CN 🍞 <span>（笨錢社群管理員&客服）</span></h2>
                                    <p>Founder & Master Professional Trader</p>
                                </div>
                                <div class="founder__info-content">
                                    <p>
                                        CN 🍞（笨錢社群管理員&客服）is a legendary figure in the global trading community. With over 15 years of professional trading experience across futures, forex, and cryptocurrency markets, he has built an unparalleled track record of consistency and profitability.
                                    </p>
                                    <p>
                                        His journey began in the bustling trading floors of Asia, where he quickly rose to prominence by developing unique trading methodologies that combine technical analysis with market psychology. Recognizing the lack of quality education, he dedicated himself to mentoring the next generation of traders through his Discord community, "笨錢" (Dumb Money).
                                    </p>
                                    <p>
                                        To date, CN 🍞 has built and mentored an incredible community of over <strong>90,000 members on Discord</strong>, making it one of the largest and most respected trading communities in Asia. His students range from complete beginners to seasoned professionals, with many becoming consistently profitable traders under his guidance.
                                    </p>
                                    <p>
                                        His proprietary trading system, developed over a decade of market observation and backtesting, has been adopted by numerous prop trading firms worldwide. As the founder of Dumb Money, he now combines his trading expertise with cutting-edge technology to provide traders with the ultimate funding solution and community support.
                                    </p>
                                </div>
                                <div class="founder__stats">
                                    <div class="founder__stat">
                                        <span class="founder__stat-number">90,000+</span>
                                        <span class="founder__stat-label">Discord Members</span>
                                    </div>
                                    <div class="founder__stat">
                                        <span class="founder__stat-number">50+</span>
                                        <span class="founder__stat-label">Countries</span>
                                    </div>
                                </div>
                              <div class="founder__social">
    <a href="https://discord.gg/dumbmoney" style="color: #5865F2;" target="_blank">
        <i class="fab fa-discord"></i>
    </a>
</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ===============>> Founder Section End <<================= -->

<!-- ===============>> Package Section Start <<================= -->
<section class="package padding-bottom padding-top">
    <div class="container">
        <div class="section-header d-flex flex-wrap gap-2 justify-content-between align-items-center">
            <div>
                <h2 class="mb-0 mt-minus-15"><span>Funding Traders</span></h2>
                <h2 class="mb-3">Worldwide</h2>
                <p class="mb-0">
                    Trusted by industry leaders, our technology is the backbone of top funding companies.
                </p>
            </div>
            <div>
                <a href="{{ route('plans.header') }}" class="text-btn"><i class="fa-solid fa-angle-right ms-0 me-2"></i> Explore plans</a>
            </div>
        </div>
        <div class="row g-5 justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="package-item">
                    <div class="package-item__icon">
                        <span>
                            <i class="fa-solid fa-bolt"></i>
                        </span>
                    </div>
                    <div class="package-item__content">
                        <h4>See Profit in Days!</h4>
                        <p>
                            Turn your trades into profits fast with our streamlined evaluation. Get a funded account
                            quickly by proving your skills. Whether you're experienced or new, start capitalizing on your
                            strategies today and see results within days.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="package-item">
                    <div class="package-item__icon">
                        <span>
                            <i class="fa-solid fa-users"></i>
                        </span>
                    </div>
                    <div class="package-item__content">
                        <h4>Created By Industry Pros</h4>
                        <p>
                            Created by a team of experienced professionals. Our platform combines professional
                            experience with intuitive tools and robust risk management. Join a community designed to support your
                            trading success at every level.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="package-item">
                    <div class="package-item__icon">
                        <span>
                            <i class="fa-solid fa-arrow-up-short-wide"></i>
                        </span>
                    </div>
                    <div class="package-item__content">
                        <h4>More Freedom, Less Rules</h4>
                        <p>
                            Trade your way with minimal rules and maximum freedom. Our platform gives you the autonomy
                            to execute strategies without micromanagement or unnecessary restrictions. Focus on what matters:
                            making successful trades.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ===============>> Package Section End <<================= -->

<!-- ========== CTA Section Start ========== -->
<section class="cta padding-top padding-bottom">
    <div class="container">
        <div class="cta__wrapper">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="cta__content aos-init aos-animate" data-aos="fade-right" data-aos-duration="800">
                        <div class="cta__content-inner">
                            <h2><span>Ready to</span> Start Trading?</h2>
                            <p>Take control of your financial future with our tools, education and thriving community.
                            </p>
                            <a href="{{ route('signup') }}" class="text-btn"> <i class="fa-solid fa-chevron-right ms-0 me-2"></i>
                                Sign Up Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cta__thumb aos-init aos-animate" data-aos="fade-left" data-aos-duration="800">
                <img src="{{ asset('assets/images/others/3.png') }}" alt="cta-image" onerror="this.src='https://via.placeholder.com/400x300/0C3A30/8BC905?text=Start+Trading'">
            </div>
        </div>
    </div>
</section>
<!-- ========== CTA Section End ========== -->

@endsection