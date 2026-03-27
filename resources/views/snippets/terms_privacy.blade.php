@extends('layout.app')

@section('content')

<style>
    /* Privacy Page Specific Styles */
    .page-header {
        background: linear-gradient(145deg, #0C3A30, #062018);
        padding: 80px 0 60px;
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

    .page-header h1 {
        color: white;
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .page-header .breadcrumb {
        background: transparent;
        padding: 0;
        margin: 0;
    }

    .page-header .breadcrumb-item a {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
    }

    .page-header .breadcrumb-item.active {
        color: #8BC905;
    }

    .page-header .breadcrumb-item.separator {
        color: rgba(255,255,255,0.4);
        margin: 0 8px;
    }

    /* Privacy Content */
    .privacy-section {
        background: white;
        border-radius: 24px;
        padding: 3rem;
        box-shadow: 0 20px 40px -15px rgba(0,0,0,0.1);
        margin: 3rem 0;
    }

    .privacy-content {
        max-width: 900px;
        margin: 0 auto;
    }

    .privacy-item {
        margin-bottom: 2.5rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid rgba(139,201,5,0.2);
    }

    .privacy-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .privacy-item h2 {
        color: #0C3A30;
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        position: relative;
        padding-left: 1rem;
        border-left: 4px solid #8BC905;
    }

    .privacy-item h3 {
        color: #0C3A30;
        font-size: 1.6rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .privacy-item h4 {
        color: #0C3A30;
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 0.8rem;
    }

    .privacy-item p {
        color: #4A5C5A;
        line-height: 1.8;
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    .privacy-item ul, .privacy-item ol {
        color: #4A5C5A;
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }

    .privacy-item li {
        margin-bottom: 0.5rem;
        line-height: 1.6;
    }

    .privacy-item a {
        color: #8BC905;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .privacy-item a:hover {
        text-decoration: underline;
    }

    .highlight-box {
        background: rgba(139,201,5,0.05);
        border-radius: 16px;
        padding: 1.5rem;
        margin: 1.5rem 0;
        border-left: 4px solid #8BC905;
    }

    .highlight-box p:last-child {
        margin-bottom: 0;
    }

    .section-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 2rem;
        border-bottom: 2px solid rgba(139,201,5,0.2);
        padding-bottom: 1rem;
    }

    .tab-link {
        color: #4A5C5A;
        text-decoration: none;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }
.breadcrumb-item::after,
.breadcrumb-item::before,
.breadcrumb li::after,
.breadcrumb li::before {
    content: none !important;
    display: none !important;
}
    .tab-link:hover {
        color: #8BC905;
        background: rgba(139,201,5,0.05);
    }

    .tab-link.active {
        background: #8BC905;
        color: #0C3A30;
    }

    @media (max-width: 991px) {
        .page-header h1 {
            font-size: 2.5rem;
        }
        .privacy-section {
            padding: 2rem;
        }
        .privacy-item h2 {
            font-size: 1.8rem;
        }
        .privacy-item h3 {
            font-size: 1.4rem;
        }
    }

    @media (max-width: 767px) {
        .page-header {
            padding: 60px 0 40px;
        }
        .page-header h1 {
            font-size: 2rem;
        }
        .privacy-section {
            padding: 1.5rem;
        }
        .section-tabs {
            flex-direction: column;
            gap: 0.5rem;
        }
        .tab-link {
            text-align: center;
        }
    }
</style>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item separator">/</li>
                        <li class="breadcrumb-item active" aria-current="page">Privacy & Terms</li>
                    </ol>
                </nav>
                <h1>Privacy Policy & Terms of Use</h1>
                <p class="text-white-50" style="font-size: 1.2rem;">Your data, security, and legal information</p>
            </div>
        </div>
    </div>
</section>

<!-- Privacy Content Section -->
<section class="padding-bottom">
    <div class="container">
        <div class="privacy-section">
            
            <!-- Section Tabs -->
            <div class="section-tabs">
                <a href="#privacy" class="tab-link active">Privacy Policy</a>
                <a href="#terms" class="tab-link">Terms of Use</a>
                <a href="#eu-data" class="tab-link">EU & UK Data</a>
                <a href="#cookies" class="tab-link">Cookies</a>
            </div>

            <div class="privacy-content">

                <!-- PRIVACY SECTION -->
                <div id="privacy" class="privacy-item">
                    <h2>Privacy</h2>
                    <p>Please read the following terms and conditions carefully before using this Web site or any of our other Web sites. By accessing or using our sites, you agree to the following terms and conditions. You should review these terms and conditions regularly as they may change at any time at our sole discretion. If you do not agree to any term or condition, you should not access or otherwise use our sites. The following terms and conditions apply to all of our Web sites, including any Web sites owned, operated or sponsored by any of our subsidiaries or affiliates. "Content" refers to any materials, documents, images, graphics, logos, design, audio, video and any other information provided from or on our Web sites.</p>
                </div>

                <div class="privacy-item">
                    <h3>1. We Provide Our Web Site For Your Convenience Only</h3>
                    <p>Our Web site is provided to you without charge as a convenience and for your information only. By merely providing access to our Web site content, we do not warrant or represent that:</p>
                    <ul>
                        <li>the content is accurate or complete;</li>
                        <li>the content is up-to-date or current;</li>
                        <li>we have a duty to update any content;</li>
                        <li>the content is free from technical inaccuracies or typographical errors;</li>
                        <li>the content is free from changes caused by third party; and</li>
                        <li>your access to our Web site will be free from interruptions, errors, computer viruses or other harmful components.</li>
                    </ul>
                    <p>We do not assume any liability for these matters. In other words, you use our Web site at your own risk. Under no circumstances, including, but not limited to, negligence, shall we be liable for any direct or indirect, special, incidental or consequential damages. This includes loss of data or profit arising out of the use or the inability to use the content of this Web site, even if one of our representatives has been advised of the possibility of your damages. If your use of our Web site results in your need to service, repair or correct equipment or data, you assume the costs to the extent the law allows. Some jurisdictions do not allow the exclusion or limitation of liability for consequential or incidental damages. In such jurisdictions, our liability is limited to the greatest extent permitted by law.</p>
                </div>

                <div class="privacy-item">
                    <h3>2. We Provide Our Web Site "As Is" and Disclaim All Warranties</h3>
                    <p>Our Web site content is provided "as is" and without warranties of any kind, either express or implied. We disclaim all warranties, express or implied, including, but not limited to, implied warranties and merchantability and fitness for a particular purpose.</p>
                </div>

                <div class="privacy-item">
                    <h3>3. We Do Not Have Responsibility for Links to Third Party Content</h3>
                    <p>We may provide hyperlinks or pointers to other Web sites maintained by third parties or may provide third party content on our Web site by framing or other methods. The links to third party Web sites are provided for your convenience and information only. The content in any linked Web sites is not under our control so we are not responsible for the content, including any further links in a third party site. If you decide to access any of the third party sites linked to our Web site, you do this entirely at your own risk. It is up to you to take precautions to ensure that the third party you link to for your use is free of computer viruses, worms, trojan horses and other items of a destructive nature.</p>
                </div>

                <div class="privacy-item">
                    <h3>4. If We Provide a Link, We Do Not Necessarily Endorse A Third Party</h3>
                    <p>We reserve the right to terminate a link to a third party Web site at any time. The fact that we provide a link to a third party Web site does not mean that we endorse, authorize or sponsor that Web site. It also does not mean that we are affiliated with the third party Web site's owners or sponsors.</p>
                </div>

                <div class="privacy-item">
                    <h3>5. If a Third Party Links to Our Web Site, It is Not An Endorsement</h3>
                    <p>If a third party links to our Web site, it is not necessarily an indication of an endorsement, authorization, sponsorship, affiliation, joint venture, or partnership by or with us. In most cases, we are not aware that a third party has linked to our Web site.</p>
                    <p>A Web site that links to our Web site:</p>
                    <ul>
                        <li>May link to, but not replicate, our content;</li>
                        <li>Should not create a browser, border environment, or frame our content;</li>
                        <li>Should not imply that we are endorsing it or its products;</li>
                        <li>Should not misrepresent its relationship with us;</li>
                        <li>Should not present false information about our products or services; and</li>
                        <li>Should not contain content that could be construed as distasteful, offensive, or controversial, and should contain only content that is appropriate for all age groups.</li>
                    </ul>
                </div>

                <div class="privacy-item">
                    <h3>6. If You Transmit or Provide Data to Us, It is Non-Confidential</h3>
                    <p>We do not want to receive confidential or proprietary information from you through our Web site. If you transmit to or post on our Web site any material, data, information or idea by any means, it will be treated as non-confidential and non-proprietary and may be disseminated or used by us for any purpose. Personal data provided to us will be handled in accordance with our policies regarding privacy. You are not authorized to post on or transmit to or from our Web site any unlawful, threatening, libelous, defamatory, obscene, scandalous, inflammatory, pornographic, or profane material, or any other content that could give rise to any civil or criminal liability under the law.</p>
                </div>

                <div class="privacy-item">
                    <h3>7. Your Use of Our Web Site is Restricted</h3>
                    <p>Our Web site and its content are owned and operated by us. Our Web site's content is copyrighted and protected by U.S. and worldwide copyright laws and treaty provisions. In addition, our Web site content is protected by trademark laws, the laws of privacy and publicity, and communications regulations and statutes.</p>
                    <p>No content from daytraders.com, or any other Web site owned, operated, licensed, or controlled by us may be copied, reproduced, republished, modified, uploaded, posted, transmitted, or distributed in any way. You also may not, without our permission, "mirror" any material contained on our Web site on any other server.</p>
                    <p>The sole exceptions to these restrictions are:</p>
                    <ul>
                        <li>You obtain written permission from us to waive these restrictions; or</li>
                        <li>You may download one copy of the content on a single computer for informational, non-commercial, and personal use only, provided you keep intact all copyright and other proprietary notices and do not modify, and will not copy or post, the content on any network computer or broadcast in any media.</li>
                    </ul>
                    <p>Violation of these restrictions will be a violation of one or more laws and is expressly prohibited by law. If you violate these restrictions, you may be subject to civil and criminal penalties. If we grant you permission to waive these restrictions, the permission terminates automatically if you breach any of these terms or conditions. Upon termination, you must immediately destroy any downloaded materials and printed materials.</p>
                </div>

                <div class="privacy-item">
                    <h3>8. By Providing Content, We Do Not Allow You to Use Our Trademarks</h3>
                    <p>The trademarks, service marks and logos of chartmasters circle used and displayed on our Web site are our registered and unregistered trademarks. Nothing on this Web site should be construed as granting, by implication, estoppel, or otherwise, any license or right to use any of our trademarks without our written permission. Requests to use trademarks owned by other companies which may be mentioned on this Web site should be directed to such other companies. We aggressively enforce our intellectual property rights. The name of chartmasters circle or our logo may not be used in any way, including in advertising or publicity pertaining to distribution of materials on our Web site, without prior written permission. You are not authorized to use our logo as a hyperlink to our Web site unless you obtain our written permission in advance.</p>
                </div>

                <div class="privacy-item">
                    <h3>9. Trading Disclaimer and Forward-Looking Information</h3>
                    <p>Trading stocks, options, and other financial instruments involves substantial risk of loss and is not suitable for every investor. The valuation of stocks, options, and other financial instruments may fluctuate, and, as a result, clients may lose more than their original investment. The impact of seasonal and geopolitical events may have a significant impact on trading conditions and prices. The information provided on our website is not intended as financial advice and should not be relied upon as such. Past performance is not indicative of future results.</p>
                </div>

                <div class="privacy-item">
                    <h3>10. You Must Obey Local Laws in Accessing Our Web Site</h3>
                    <p>This site is controlled by us from our offices within the United States of America. We make no representation that content or materials in the site are appropriate or available for use in other jurisdictions. Access to our Web site content or materials from jurisdictions where such access is illegal or prohibited. If you choose to access this site from other jurisdictions, you do so on your own initiative and are responsible for compliance with applicable local laws. We are not responsible for any law violations. You may not use or export the materials in this site in violation of U.S. export laws and regulations. Any claims relating to our Web site and its content and materials shall be governed by the laws of the State of Delaware without giving effect to any principles of conflicts of laws. You agree that any legal action or proceeding between us for any purpose concerning this Agreement or the parties' obligations shall be brought exclusively in a federal or state court in Delaware.</p>
                </div>

                <div class="privacy-item">
                    <h3>11. You are Bound by Changes in this Agreement's Terms and Conditions</h3>
                    <p>We may at any time revise these terms and conditions by updating this posting. By using our Web site, you agree to be bound by any such revisions and should therefore periodically visit this page to determine the then current chartmasters circle Web Site User Agreement and Disclaimers to which you are bound. Certain provisions of these terms and conditions may be superseded by other legal notices or terms located on parts of our Web site. In the event of a conflict between the terms and conditions of this Agreement and the terms and conditions of any other written agreement between chartmasters circle and its customers or vendors, the express terms and conditions of the latter agreement shall prevail.</p>
                </div>

                <div class="privacy-item">
                    <h3>12. You Agree to Indemnify Us for Using Our Web Site</h3>
                    <p>You agree to indemnify, defend and hold harmless DayTraders, its officers, directors, employees, agents, licensors, suppliers and any third party information providers to us from and against all losses, expenses, damages and costs, including reasonable attorneys' fees, resulting from any violation of this Agreement by you.</p>
                </div>

                <div class="privacy-item">
                    <h3>13. Third Parties May Have Rights Under This Agreement</h3>
                    <p>Some of the provisions of this Agreement are for the benefit of chartmasters circle and its officers, directors, employees, agents, licensors, and suppliers. Each of these individuals or entities shall have the right to assert and enforce those provisions directly against you on its own behalf.</p>
                </div>

                <div class="privacy-item">
                    <h3>14. How This Agreement May Be Terminated</h3>
                    <p>This Agreement may be terminated by either party without notice at any time for any reason; provided that you may no longer use our Web site after you have terminated this Agreement. Provisions 2, 6, 7, 8, 12, 14, and 15 of this Agreement shall survive any termination of this Agreement.</p>
                </div>

                <div class="privacy-item">
                    <h3>15. Miscellaneous</h3>
                    <p>Our failure to insist upon or enforce strict performance of any provision of this Agreement shall not be construed as a waiver of any provision or right. Neither the course of conduct between the parties nor trade practice shall act to modify any provision of this Agreement. We may assign our rights and duties under this Agreement to any party at any time without notice to you.</p>
                </div>

                <!-- TERMS OF USE SECTION -->
                <div id="terms" class="privacy-item">
                    <h2>Terms Of Use</h2>
                    
                    <h3>Website Privacy Notice</h3>
                    <p>chartmasters circle and its affiliates (collectively referred to as "DayTraders", "we", "us") takes its data protection and privacy responsibilities seriously. This privacy notice explains how we collect, use and share your personal information as a result of your use of our web sites, including:</p>
                    <ul>
                        <li>What personal information we collect and when and why we use it.</li>
                        <li>Sharing your personal information</li>
                        <li>Transferring personal information globally</li>
                        <li>How we protect and store personal information</li>
                        <li>European Union</li>
                        <li>California</li>
                        <li>Australia</li>
                         <li>China</li>
                          <li>Taiwan</li> 
                        <li>How you can contact us</li>
                        <li>Changes to this Privacy Notice</li>
                    </ul>

                    <h4>Intranet Disclosure</h4>
                    <p>Some of chartmasters circle websites, that provide employees and retirees access to personnel and benefits information from the Internet, may provide more detailed privacy or disclaimer notices or policies, in which case they take priority over this notice. To make this Privacy Notice easy to find, we make it available in the footer of every web page where it applies. Employees, Applicants and others with access to the chartmasters circle internal Intranet should note that this privacy notice will apply if linked directly from there; otherwise, our internal privacy policies will apply as defined.</p>

                    <h4>Links to other websites</h4>
                    <p>You might find external links to third-party websites on our website. This privacy notice only applies to personal data collected on this website and does not apply to your use of a third-party site. We have no influence or control over linked third-party websites and your use of other sites is at your own risk and is subject to their privacy statements and policies.</p>

                    <h4>How We Collect Your Information</h4>
                    <p>We collect information about you if you register with or use one of our website(s). We will collect your personal data via the following methods:</p>
                    <ul>
                        <li>By recording details you provide to us - e.g. in responding to trading account applications, your communications with us through emails or calls; and/or</li>
                        <li>By observing your use of our products and services and our website.</li>
                    </ul>

                    <h4>Categories of Personal Information</h4>
                    <ul>
                        <li><strong>Contact information:</strong> Names, postal addresses, email address, telephone numbers</li>
                        <li><strong>Financial information:</strong> Employment status, education history, investment experience, trading history, financial statements, bank account information</li>
                        <li><strong>Demographic Information:</strong> Gender, Ethnicity, Veteran Status, Disability Status</li>
                        <li><strong>IP Address and Technical Details:</strong> IP address, location information, device and browser information</li>
                        <li><strong>Trading Information:</strong> Trading activity, account balances, trading patterns, and risk profile</li>
                    </ul>

                    <h4>How We Use Your Information</h4>
                    <ul>
                        <li>Fulfill or meet the reason you provided the information</li>
                        <li>Communicate with you about programs, offers, surveys and market research</li>
                        <li>Respond to your inquiries</li>
                        <li>Process trading account applications</li>
                        <li>Evaluate potential partners</li>
                        <li>Perform data analyses</li>
                        <li>Protect against fraud and security events</li>
                        <li>Comply with legal requirements</li>
                    </ul>

                    <h4>Sharing Your Information</h4>
                    <ul>
                        <li>Within DayTraders</li>
                        <li>With third parties who help manage our business and deliver services</li>
                        <li>In aggregate, statistical form with partners and advertisers</li>
                        <li>In the event of a business transfer or sale</li>
                        <li>With regulators and law enforcement</li>
                    </ul>

                    <p>You have a right to contact us at <a href="mailto:privacy@daytraders.com">privacy@daytraders.com</a> for more information about the safeguards we have put in place.</p>
                </div>

                <!-- EU AND UK DATA SECTION -->
                <div id="eu-data" class="privacy-item">
                    <h2>EU and UK Data Protection Notice</h2>
                    <p>(EU-US DPF Privacy Notice)</p>
                    <p>chartmasters circle takes its data protection and privacy responsibilities seriously.</p>

                    <div class="highlight-box">
                        <p>We may amend this notice from time to time to keep it up to date with legal requirements and the way we operate our business. Please regularly check these pages for the latest version of this notice. If we make significant changes to this privacy notice, we will seek to inform you by notice on our website or email.</p>
                    </div>

                    <h3>How We Collect Your Information</h3>
                    <ul>
                        <li>By recording details you provide to us</li>
                        <li>By observing your use of our products and services</li>
                    </ul>

                    <h3>Legal Basis for Processing Your Personal Data</h3>
                    <ul>
                        <li>You have consented to us using the personal data</li>
                        <li>Our use is in our legitimate interest as a commercial organization</li>
                        <li>Our use is necessary to perform a contract with you</li>
                        <li>Our use is necessary to comply with a legal obligation</li>
                    </ul>

                    <h3>Your Rights Regarding Personal Data</h3>
                    <ul>
                        <li>Right to access your personal data</li>
                        <li>Right to rectify inaccurate personal data</li>
                        <li>Right to erasure in certain circumstances</li>
                        <li>Right to restrict processing</li>
                        <li>Right to data portability</li>
                        <li>Right to object to processing</li>
                    </ul>
                </div>

                <!-- COOKIES SECTION -->
                <div id="cookies" class="privacy-item">
                    <h2>Cookies</h2>
                    
                    <p>A cookie is a small text file that is placed on a computer or other device and is used to identify the user or device and to collect information. Cookies are typically assigned to one of four categories, depending on their function and intended purpose: absolutely necessary cookies, performance cookies, functional cookies, and cookies for marketing purposes.</p>

                    <h3>Types Of Cookies and Why We Use Them</h3>

                    <h4>Absolutely necessary cookies</h4>
                    <p>These cookies are essential to enable you to move around a website and use its features. For trading platforms like ours, these cookies help maintain secure sessions and prevent fraudulent use.</p>

                    <h4>Performance/Analytical cookies</h4>
                    <p>These cookies collect information about how you use our websites. Information collected includes, for example, the Internet browsers and operating systems used, the domain name of the website previously visited, the number of visits, average duration of visit, and pages viewed.</p>

                    <h4>Functionality cookies</h4>
                    <p>These cookies allow the website to remember choices you make (such as your username or ID, language preference, trading preferences, or the area or region you are in) and provide enhanced, more personal features.</p>

                    <h4>Targeting and advertising cookies</h4>
                    <p>These cookies track browsing habits and are used to deliver targeted (interest-based) advertising. They are also used to limit the number of times you see an ad and to measure the effectiveness of advertising campaigns.</p>

                    <h3>Cookies We Use</h3>
                    <ul>
                        <li>Advertising cookies</li>
                        <li>Analytics cookies</li>
                        <li>Social Media cookies</li>
                        <li>Survey cookies</li>
                        <li>Trading platform cookies</li>
                        <li>Security and fraud prevention cookies</li>
                    </ul>

                    <h3>Third Party Tools</h3>
                    <p>We use cookies and pixels from third-party services such as Google Analytics, LinkedIn Insight Tag, Facebook Pixel, and Twitter Pixel to help enhance your experience and improve security.</p>

                    <h3>Disabling Cookies</h3>
                    <p>You can manage website cookies in your browser settings, and you always have the choice to change these settings by accepting, rejecting, or deleting cookies. If you choose to change your settings, you may find that certain functions and features on this website will not work as intended, including some trading platform features that require cookies for security purposes.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Remove or comment out any old duplicate sections -->

<script>
    // Simple tab functionality
    document.addEventListener('DOMContentLoaded', function() {
        const tabLinks = document.querySelectorAll('.tab-link');
        
        tabLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all tabs
                tabLinks.forEach(l => l.classList.remove('active'));
                
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Get target section
                const targetId = this.getAttribute('href');
                const targetSection = document.querySelector(targetId);
                
                // Scroll to section
                if (targetSection) {
                    targetSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
</script>

@endsection