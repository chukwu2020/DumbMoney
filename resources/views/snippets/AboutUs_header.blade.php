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

    /* Team Cards */
    .team {
        background: rgba(255,255,255,0.05);
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
    }

    .team:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px -15px rgba(139,201,5,0.2);
    }

    .team__image {
        width: 100%;
        height: 300px;
        overflow: hidden;
    }

    .team__image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .team:hover .team__image img {
        transform: scale(1.05);
    }

    .team__info {
        padding: 25px;
    }

    .team__info-header h2 {
        font-size: 1.4rem;
        font-weight: 700;
        color: white;
        margin-bottom: 5px;
    }

    .team__info-header h2 span {
        color: #8BC905;
    }

    .team__info-header p {
        color: #8BC905;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 15px;
    }

    .team__info-content p {
        color: rgba(255,255,255,0.7);
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .team__info-action a {
        color: #8BC905;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: gap 0.3s ease;
    }

    .team__info-action a:hover {
        gap: 12px;
        color: white;
    }

    /* Team Details Modal */
    .team-details {
        display: none;
        margin-top: 40px;
        padding: 40px;
        background: rgba(255,255,255,0.02);
        border-radius: 24px;
        border: 1px solid rgba(139,201,5,0.2);
        position: relative;
    }

    .team-details.active {
        display: block;
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .team-details__close {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(139,201,5,0.1);
        border: 1px solid rgba(139,201,5,0.2);
        color: #8BC905;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .team-details__close:hover {
        background: #8BC905;
        color: #000;
        transform: rotate(90deg);
    }

    .team-details__inner {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        align-items: center;
    }

    .team-details__image {
        flex: 0 0 200px;
    }

    .team-details__image img {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #8BC905;
    }

    .team-details__content {
        flex: 1;
    }

    .team-details__content h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 5px;
    }

    .team-details__content h2 span {
        color: #8BC905;
    }

    .team-details__content .role {
        color: #8BC905;
        font-size: 1.1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 10px;
    }

    .team-details__content .title {
        color: rgba(255,255,255,0.7);
        font-size: 1rem;
        margin-bottom: 20px;
        font-style: italic;
    }

    .team-details__content .bio {
        color: rgba(255,255,255,0.9);
        font-size: 1rem;
        line-height: 1.8;
        margin-bottom: 20px;
    }

    .team-details__nav {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }

    .team-details__nav button {
        background: transparent;
        border: 1px solid rgba(139,201,5,0.3);
        color: white;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .team-details__nav button:hover {
        background: #8BC905;
        color: #000;
        border-color: #8BC905;
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
        
        .team-details__inner {
            flex-direction: column;
            text-align: center;
        }
        
        .team-details__nav {
            justify-content: center;
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
                    At ChartMasters Circle, we developed the technology powering some of the world's most successful
                    funding companies. We're building a community that's transforming the trading landscape by 
                    offering unmatched tools, education, and support for traders at every level. Our mission is 
                    simple: to empower traders worldwide with the knowledge, resources, and capital needed to 
                    achieve true financial freedom.
                </p>
                
                <blockquote class="about-section__quote">
                    <p>
                        "My passion for empowering individuals inspired me to create this community to level the
                        playing field, giving every aspiring trader, regardless of background or financial status, 
                        a fair shot at success in the futures markets."
                    </p>
                    <cite class="about-section__quote-author">
                        <img src="{{ asset('assets/images/team/team-image-1.jpg') }}" alt="Leo Riot">
                        <span><strong>Leo Riot</strong> - Founder &amp; CTO</span>
                    </cite>
                </blockquote>
                
                <p class="about-section__description">
                    Built by an elite team of world-class software engineers and professional traders
                    at the forefront of the industry, ChartMasters Circle is a vibrant global community driven by a
                    shared commitment to success. We provide personalized support and cutting-edge proprietary
                    technology engineered to enhance your trading performance. Every element of our platform is
                    built with precision, transparency, and integrity, ensuring our goals stay aligned with yours
                    and unlocking your full trading potential.
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

<!-- ===============>> Team Section Start <<================= -->
<section class="team-section padding-bottom padding-top bg-black">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="team-section__content">
                    <h2>Our <span>Team</span></h2>
                    <p>We're a dynamic group of industry leaders dedicated to empowering traders to grow and succeed.
                        Together, we reach new heights.</p>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row g-4 gy-5 justify-content-center" id="teamGrid">
                    <!-- Leo Riot - team-image-1.jpg -->
                    <div class="col-sm-6 col-md-6">
                        <div class="team" onclick="showTeamDetails('leo')">
                            <div class="team__image">
                                <img src="{{ asset('assets/images/team/team-image-1.jpg') }}" alt="Leo Riot">
                            </div>
                            <div class="team__info">
                                <div class="team__info-header">
                                    <h2>Leo <span>Riot</span> - Founder + CTO</h2>
                                    <p>Taking Tech to the Edge</p>
                                </div>
                                <div class="team__info-content">
                                    <p>
                                        Pro-skater turned tech virtuoso, Leo Riot codes groundbreaking trading platforms
                                        as ChartMasters Circle CTO. His software powered $500M+ in revenue, while he still shreds vert ramps in
                                        Vegas.
                                    </p>
                                </div>
                                <div class="team__info-action">
                                    <a href="javascript:void(0)" onclick="event.stopPropagation(); showTeamDetails('leo')">Read bio <i class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Martin Montaño - team-image-2.jpg -->
                    <div class="col-sm-6 col-md-6">
                        <div class="team" onclick="showTeamDetails('martin')">
                            <div class="team__image">
                                 <img src="{{ asset('assets/images/team/team-image-5.jpg') }}" alt="Kha-Yen"> 
                            </div>
                            <div class="team__info">
                                <div class="team__info-header">
                                    <h2>Martin <span>Montaño</span> - Co-Founder + COO</h2>
                                    <p>Financial Technology & Trading Infrastructure Exec.</p>
                                </div>
                                <div class="team__info-content">
                                    <p>
                                        Designing operational systems, trader programs, and risk frameworks that support the firm's global trading
                                        community. Building scalable structures that allow both traders and
                                        the company to grow responsibly.
                                    </p>
                                </div>
                                <div class="team__info-action">
                                    <a href="javascript:void(0)" onclick="event.stopPropagation(); showTeamDetails('martin')">Read bio <i class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Juan-Carlos Muñoz - team-image-3.jpg -->
                    <div class="col-sm-6 col-md-6">
                        <div class="team" onclick="showTeamDetails('juan')">
                            <div class="team__image">
                                <img src="{{ asset('assets/images/team/team-image-3.jpg') }}" alt="Juan-Carlos Muñoz">
                            </div>
                            <div class="team__info">
                                <div class="team__info-header">
                                    <h2>Juan-Carlos <span>Muñoz</span> - CHRO</h2>
                                    <p>Excelling and Giving Back</p>
                                </div>
                                <div class="team__info-content">
                                    <p>
                                        Miami-born finance expert turned philanthropist, Juan-Carlos Muñoz now serves
                                        ChartMasters Circle as Chief Human Resources Officer. He balances coral reef restoration with compassionate
                                        management.
                                    </p>
                                </div>
                                <div class="team__info-action">
                                    <a href="javascript:void(0)" onclick="event.stopPropagation(); showTeamDetails('juan')">Read bio <i class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sebastian Brenes - team-image-4.jpg -->
                    <div class="col-sm-6 col-md-6">
                        <div class="team" onclick="showTeamDetails('sebastian')">
                            <div class="team__image">
                                <img src="{{ asset('assets/images/team/team-image-4.jpg') }}" alt="Sebastian Brenes">
                            </div>
                            <div class="team__info">
                                <div class="team__info-header">
                                    <h2>Sebastian <span>Brenes</span> - Director of Support</h2>
                                    <p>Trading Support with Passion and Precision</p>
                                </div>
                                <div class="team__info-content">
                                    <p>
                                        Combines trading expertise with a passion for problem-solving and adventure. A
                                        skydiver and traveler, he ensures seamless support while driving growth and
                                        trust for traders worldwide.
                                    </p>
                                </div>
                                <div class="team__info-action">
                                    <a href="javascript:void(0)" onclick="event.stopPropagation(); showTeamDetails('sebastian')">Read bio <i class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Kha-Yen Bataineh - team-image-5.jpg -->
                    <div class="col-sm-6 col-md-6">
                        <div class="team" onclick="showTeamDetails('khayen')">
                            <div class="team__image">
                              <img src="{{ asset('assets/images/team/team-image-2.jpg') }}" alt="Martin Montaño">
                            </div>
                            <div class="team__info">
                                <div class="team__info-header">
                                    <h2>Kha-Yen <span>Bataineh</span> - Director of Operations</h2>
                                    <p>Trading Ahead, Leading Together!</p>
                                </div>
                                <div class="team__info-content">
                                    <p>
                                        Known for her robust operational leadership and team management. Outside work,
                                        she is a passionate kickboxer, talented in special FX makeup, and fluent in five
                                        languages, enhancing her global business acumen.
                                    </p>
                                </div>
                                <div class="team__info-action">
                                    <a href="javascript:void(0)" onclick="event.stopPropagation(); showTeamDetails('khayen')">Read bio <i class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Garrett Russell - team-image-6.jpg -->
                    <div class="col-sm-6 col-md-6">
                        <div class="team" onclick="showTeamDetails('garrett')">
                            <div class="team__image">
                                <img src="{{ asset('assets/images/team/team-image-6.jpg') }}" alt="Garrett">
                            </div>
                            <div class="team__info">
                                <div class="team__info-header">
                                    <h2>Garrett <span>Russell</span> - Director of Risk</h2>
                                    <p>Risk Architect & Fraud Shield</p>
                                </div>
                                <div class="team__info-content">
                                    <p>
                                        As a math enthusiast and back-wood skier, Garrett has a palate for analysis and
                                        discovery. As the Director of Risk, he safeguards ChartMasters Circle's financial and
                                        operational security.
                                    </p>
                                </div>
                                <div class="team__info-action">
                                    <a href="javascript:void(0)" onclick="event.stopPropagation(); showTeamDetails('garrett')">Read bio <i class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Team Details Container -->
                <div id="teamDetailsContainer" class="team-details">
                    <div class="team-details__close" onclick="hideTeamDetails()">
                        <i class="fas fa-times"></i>
                    </div>
                    
                    <!-- Leo Riot Details -->
                    <div id="leo-details" class="team-details-content" style="display: none;">
                        <div class="team-details__inner">
                            <div class="team-details__image">
                                <img src="{{ asset('assets/images/team/team-image-1.jpg') }}" alt="Leo Riot">
                            </div>
                            <div class="team-details__content">
                                <h2>Leo <span>Riot</span></h2>
                                <div class="role">Founder & CTO</div>
                                <div class="title">Taking Tech to the Edge</div>
                                <div class="bio">
                                    <p>Leo Riot stands at the forefront of innovation in both cutting-edge technology and vert skating. As a seasoned entrepreneur and expert software engineer, Riot began his programming journey in 1998, earning a strong reputation in the futures trading industry. His visionary contributions were instrumental in developing the software for the largest futures funding company, helping drive over half a billion dollars in revenue within three years. Riot's leadership and technical expertise continue to push boundaries in both the tech and trading worlds.</p>
                                    <p>As CTO of ChartMasters Circle, Riot drives forward-thinking advancements in educational platforms and funding solutions for day traders. His leadership is pivotal in crafting sophisticated web infrastructures, optimizing database management, and engineering systems that elevate operational efficiency. With a focus on building a seamless, high-performance environment, Riot ensures smooth operations while fostering a culture of quality and stress-free collaboration, reflecting his commitment to technological innovation and organizational excellence.</p>
                                    <p>Outside of tech, Riot was a professional vert skater, turning pro in 2006. His adventurous spirit also leads him to outdoor activities like wake surfing at Lake Mead in Las Vegas.</p>
                                </div>
                                <div class="team-details__nav">
                                    <button onclick="navigateTeam('prev', 'leo')"><i class="fas fa-chevron-left"></i></button>
                                    <button onclick="hideTeamDetails()"><i class="fas fa-times"></i></button>
                                    <button onclick="navigateTeam('next', 'leo')"><i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Martin Montaño Details -->
                    <div id="martin-details" class="team-details-content" style="display: none;">
                        <div class="team-details__inner">
                            <div class="team-details__image">
                                     <img src="{{ asset('assets/images/team/team-image-5.jpg') }}" alt="Kha-Yen">
                            </div>
                            <div class="team-details__content">
                                <h2>Martin <span>Montaño</span></h2>
                                <div class="role">Co-Founder & COO</div>
                                <div class="title">Financial Technology & Trading Infrastructure Exec.</div>
                                <div class="bio">
                                    <p>Martin Montaño is the Co-Founder and Chief Operating Officer of ChartMasters Circle, where he leads the development of the company's infrastructure, risk management systems, and operational framework. From the beginning, Martin has played a central role in building the systems that power ChartMasters Circle, including trader evaluation models, internal risk monitoring tools, and affiliate integration systems designed to support both traders and partners on the platform.</p>
                                    <p>Martin began trading in his teenage years in Miami, entering the financial markets before finishing high school. Over time, he developed a strong understanding of the trading ecosystem from both the trader and operator perspective. This hands-on experience has been critical in shaping the firm's approach to risk management, trader evaluation, and sustainable growth.</p>
                                    <p>Before founding ChartMasters Circle, Martin became one of the youngest yacht captains in Miami and built several successful businesses within the luxury yacht industry. His companies provided white-glove services for high-end clientele and partnered with prominent hotels and residential properties across South Florida, delivering innovative experiences within the luxury market. Martin also founded a digital marketing company focused on the trading industry, where he scaled affiliate campaigns spending hundreds of thousands of dollars per month in advertising. His company quickly became the top affiliate for one of the largest futures funding firms in the world, giving him a deep understanding of trader acquisition, affiliate ecosystems, and the broader prop trading landscape.</p>
                                    <p>Outside of his professional work, Martin is an accomplished off-road dirt bike racer, having won multiple state championships and AMA-sanctioned events. His competitive mindset and dedication to continuous improvement carry through both his personal pursuits and his leadership at ChartMasters Circle.</p>
                                </div>
                                <div class="team-details__nav">
                                    <button onclick="navigateTeam('prev', 'martin')"><i class="fas fa-chevron-left"></i></button>
                                    <button onclick="hideTeamDetails()"><i class="fas fa-times"></i></button>
                                    <button onclick="navigateTeam('next', 'martin')"><i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Juan-Carlos Muñoz Details -->
                    <div id="juan-details" class="team-details-content" style="display: none;">
                        <div class="team-details__inner">
                            <div class="team-details__image">
                                <img src="{{ asset('assets/images/team/team-image-3.jpg') }}" alt="Juan-Carlos Muñoz">
                            </div>
                            <div class="team-details__content">
                                <h2>Juan-Carlos <span>Muñoz</span></h2>
                                <div class="role">CHRO</div>
                                <div class="title">Excelling and Giving Back</div>
                                <div class="bio">
                                    <p>Juan-Carlos Muñoz is the Chief Human Resources Officer (CHRO) at ChartMasters Circle, where he contributes his wide range of dynamic expertise to the leadership team. A native of Miami, Juan-Carlos has built a versatile career with a strong foundation in finance, focusing on Letters of Credit and international steel trading. In addition to his work in the logistics and financial sector, Juan-Carlos has significant experience managing a state-regulated aquaculture facility, where he oversaw operations with the cultivation of moon jellyfish (Aurelia aurita) and managed various unique projects, including live coral aquaculture, the herpetology trade, and CITES-regulated import and export operations.</p>
                                    <p>Beyond his professional endeavors in finance and aquaculture management, Juan-Carlos plays a key role in working with philanthropic organizations. Acting as a project manager and logistics coordinator, he assists in advancing impactful projects that focus on science education programs in schools, coral reef restoration in South Florida, and initiatives at children's cancer hospitals. His ability to execute complex projects enables him to ensure operations run smoothly and efficiently to drive meaningful, positive outcomes in the nonprofit sector.</p>
                                    <p>Juan-Carlos's unique blend of expertise in corporate operations, human relations, and nonprofit initiatives brings a valuable perspective to his role at ChartMasters Circle, where he supports and enhances the company's mission through his leadership and dedication.</p>
                                </div>
                                <div class="team-details__nav">
                                    <button onclick="navigateTeam('prev', 'juan')"><i class="fas fa-chevron-left"></i></button>
                                    <button onclick="hideTeamDetails()"><i class="fas fa-times"></i></button>
                                    <button onclick="navigateTeam('next', 'juan')"><i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sebastian Brenes Details -->
                    <div id="sebastian-details" class="team-details-content" style="display: none;">
                        <div class="team-details__inner">
                            <div class="team-details__image">
                                <img src="{{ asset('assets/images/team/team-image-4.jpg') }}" alt="Sebastian Brenes">
                            </div>
                            <div class="team-details__content">
                                <h2>Sebastian <span>Brenes</span></h2>
                                <div class="role">Director of Support</div>
                                <div class="title">Trading Support with Passion and Precision</div>
                                <div class="bio">
                                    <p>Sebastian is a seasoned professional with a deep passion for trading and an unwavering dedication to customer success. As the Director of Customer Support at ChartMasters Circle, he leverages his extensive expertise in technology and exceptional problem-solving skills to ensure every trader's journey is seamless and rewarding.</p>
                                    <p>Known for his innovative approach, Sebastian thrives on helping traders navigate complex scenarios, empowering them to stay focused on achieving their goals. His commitment to excellence is fueled by his adventurous spirit as an experienced skydiver and coach, where he draws inspiration from the thrill of the skies to think creatively and lead with confidence.</p>
                                    <p>Beyond his professional and adventurous pursuits, Sebastian is an avid traveler and outdoor enthusiast who values exploration and learning from diverse cultures. This drive for personal growth mirrors his dedication to fostering a supportive and enriching experience for traders, making ChartMasters Circle a trusted partner for trading success worldwide.</p>
                                </div>
                                <div class="team-details__nav">
                                    <button onclick="navigateTeam('prev', 'sebastian')"><i class="fas fa-chevron-left"></i></button>
                                    <button onclick="hideTeamDetails()"><i class="fas fa-times"></i></button>
                                    <button onclick="navigateTeam('next', 'sebastian')"><i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Kha-Yen Bataineh Details -->
                    <div id="khayen-details" class="team-details-content" style="display: none;">
                        <div class="team-details__inner">
                            <div class="team-details__image">
                               <img src="{{ asset('assets/images/team/team-image-2.jpg') }}" alt="Martin Montaño">
                            </div>
                            <div class="team-details__content">
                                <h2>Kha-Yen <span>Bataineh</span></h2>
                                <div class="role">Director of Operations</div>
                                <div class="title">Trading Ahead, Leading Together!</div>
                                <div class="bio">
                                    <p>Kha-Yen is the Director of Operations at ChartMasters Circle, where she brings a wealth of experience and leadership to the company's operations. Drawing on her prior experience managing a support team of nearly 70 individuals, Kha-Yen has been instrumental in shaping the company's structure and processes, implementing best practices learned from years in the industry. Her focus on clear communication, people management, and operational excellence ensures ChartMasters Circle continues to thrive in the competitive futures trading space.</p>
                                    <p>Outside of her professional life, Kha-Yen is a passionate kickboxer, a talented special FX makeup artist, and an avid futures trader. She also enjoys traveling, seeking out new experiences and perspectives that fuel her creativity and personal growth. These diverse interests reflect her dynamic approach to both work and life, driving her to excel in every endeavor.</p>
                                    <p>After moving to Houston from Germany in 2017, Kha-Yen further broadened her global perspective by mastering five languages, which enhances her ability to connect with diverse teams and clients. Her exceptional skills in structuring teams, fostering collaboration, and driving results with a blend of compassion and determination make her a cornerstone of the company's leadership team.</p>
                                </div>
                                <div class="team-details__nav">
                                    <button onclick="navigateTeam('prev', 'khayen')"><i class="fas fa-chevron-left"></i></button>
                                    <button onclick="hideTeamDetails()"><i class="fas fa-times"></i></button>
                                    <button onclick="navigateTeam('next', 'khayen')"><i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Garrett Russell Details -->
                    <div id="garrett-details" class="team-details-content" style="display: none;">
                        <div class="team-details__inner">
                            <div class="team-details__image">
                                <img src="{{ asset('assets/images/team/team-image-6.jpg') }}" alt="Garrett Russell">
                            </div>
                            <div class="team-details__content">
                                <h2>Garrett <span>Russell</span></h2>
                                <div class="role">Director of Risk</div>
                                <div class="title">Risk Architect & Fraud Shield</div>
                                <div class="bio">
                                    <p>Garrett is the Director of Risk at ChartMasters Circle, serving as the front-line defense against fraudulent activities and financial threats. A prop firm veteran with a focus on analytics, efficiency, and fraud protection, he utilizes data-driven strategies to safeguard the firm's integrity. His investigative acumen allows him to identify risks, develop robust defenses, and ensure a fair trading environment.</p>
                                    <p>Garrett's commitment to excellence extends beyond his professional role. As an accomplished tutor in advanced mathematics, including calculus, linear algebra, and differential equations, he applies his mathematical expertise to cutting-edge data analytics, using insights to enhance efficiency and refine decision-making across the organization.</p>
                                    <p>Known for his dynamic and adventurous spirit, Garrett balances his professional pursuits with a passion for food, video games, surfing, and skiing. Whether riding waves, backcountry skiing, or exploring new cuisines, his multifaceted approach to life reflects his commitment to innovation and security.</p>
                                </div>
                                <div class="team-details__nav">
                                    <button onclick="navigateTeam('prev', 'garrett')"><i class="fas fa-chevron-left"></i></button>
                                    <button onclick="hideTeamDetails()"><i class="fas fa-times"></i></button>
                                    <button onclick="navigateTeam('next', 'garrett')"><i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ===============>> Team Section End <<================= -->

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

<script>
    // Team members in order
    const teamMembers = ['leo', 'martin', 'juan', 'sebastian', 'khayen', 'garrett'];
    
    function showTeamDetails(memberId) {
        // Hide all details
        document.querySelectorAll('.team-details-content').forEach(el => {
            el.style.display = 'none';
        });
        
        // Show selected member details
        document.getElementById(memberId + '-details').style.display = 'block';
        
        // Show the container
        document.getElementById('teamDetailsContainer').classList.add('active');
        
        // Scroll to details
        setTimeout(() => {
            document.getElementById('teamDetailsContainer').scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 100);
    }
    
    function hideTeamDetails() {
        document.getElementById('teamDetailsContainer').classList.remove('active');
    }
    
    function navigateTeam(direction, currentMember) {
        const currentIndex = teamMembers.indexOf(currentMember);
        let newIndex;
        
        if (direction === 'prev') {
            newIndex = (currentIndex - 1 + teamMembers.length) % teamMembers.length;
        } else {
            newIndex = (currentIndex + 1) % teamMembers.length;
        }
        
        showTeamDetails(teamMembers[newIndex]);
    }
    
    // Close details when clicking outside (optional)
    document.addEventListener('click', function(event) {
        const container = document.getElementById('teamDetailsContainer');
        const isClickInside = container?.contains(event.target);
        const isCardClick = event.target.closest('.team');
        const isReadBioClick = event.target.closest('.team__info-action a');
        
        if (container?.classList.contains('active') && !isClickInside && !isCardClick && !isReadBioClick) {
            hideTeamDetails();
        }
    });
</script>

@endsection