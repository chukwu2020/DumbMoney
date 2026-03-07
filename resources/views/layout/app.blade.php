<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>MarketMind Investments</title>

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/mymarketmindmainicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/mymarketmindmainicon.png') }}" sizes="180x180">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/scrollCue.css">
    <link rel="stylesheet" href="assets/css/remixicon.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- SEO Tags -->
<meta name="description" content="MarketMind Investments empowers traders worldwide with expert copy trading services, seamless global payments, and real-time learning opportunities. Copy top-performing traders, grow your skills, and trade with confidence.">
<link rel="canonical" href="https://marketmindinvestments.com/">

<!-- Open Graph / Social Sharing -->
<meta property="og:title" content="MarketMind Investments – Global Copy Trading & Financial Growth">
<meta property="og:description" content="Join MarketMind Investments to mirror top traders, access seamless global payments, and learn to trade confidently. Our innovative platform helps beginners and experienced traders alike maximize success.">
<meta property="og:url" content="https://marketmindinvestments.com/">
<meta property="og:type" content="website">
<meta property="og:image" content="https://marketmindinvestments.com/assets/images/social-share-image.jpg">

<!-- Twitter Cards -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="MarketMind Investments – Copy Trading & Global Payments">
<meta name="twitter:description" content="Mirror expert traders, make secure global transactions, and develop your trading skills with MarketMind Investments. Start your copy trading journey today.">
<meta name="twitter:image" content="https://marketmindinvestments.com/assets/images/social-share-image.jpg">
</head>


<body class="bg-white text-neutral-900 !dark:bg-white !dark:text-neutral-900">


    <!-- Preloader -->
    <div class="preloader-area" id="preloader">
        <div class="loader-container">
            <div class="gradient-ring"></div>
            <div class="logo-pulse">
                <img src="assets/images/mymarketmindmainicon.png" alt="MarketMind Logo" class="logo-img" />
            </div>
        </div>
    </div>

    <style>
        .preloader-area {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.98);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            backdrop-filter: blur(2px);
        }

        .loader-container {
            position: relative;
            width: 200px;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gradient-ring {
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #0C3A30;
            border-right-color: #9EDD05;
            animation: rotate 1.5s linear infinite;
            z-index: 1;
        }

        .gradient-ring::before {
            content: '';
            position: absolute;
            inset: 8px;
            border-radius: 50%;
            background: white;
            z-index: 1;
        }

        .logo-pulse {
            z-index: 2;
            animation: pulse 2s infinite ease-in-out;
        }



        .logo-img {
            width: 120px;
            height: 120px;
            object-fit: contain;
            filter: drop-shadow(0 0 10px rgba(12, 58, 48, 0.1));
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(0.95);
                opacity: 0.9;
            }

            50% {
                transform: scale(1);
                opacity: 1;
            }

            100% {
                transform: scale(0.95);
                opacity: 0.9;
            }
        }

        @media (max-width: 768px) {
            .loader-container {
                width: 200px;
                height: 200px;
            }

            .logo-img {
                width: 100px;
                height: 100px;
            }
        }
    </style>

    <script>
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                preloader.style.transition = 'opacity 0.5s ease';
                preloader.style.opacity = '0';
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 500);
            }
        });
    </script>

    @include('snippets.top-header')
    @include('snippets.header')

    <!-- Search Modal -->
    <div class="search-modal modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header position-relative">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form class="popup-form">
                        <input type="text" class="form-control" placeholder="Search here">
                        <button type="submit" class="popup-btn">
                            <i class="ri-search-line"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @yield('content')

    @include('snippets.footer')

    <!-- Go Top -->
    <div class="go-top">
        <i class="ri-arrow-up-fill"></i>
    </div>

    <!-- WhatsApp Widget -->
    <script type="text/javascript">
        (function() {
            var options = {
                whatsapp: "+44 (774) 266‑3627",
                call_to_action: "Contact us!",
                position: "left",
            };
            var proto = document.location.protocol,
                host = "getbutton.io",
                url = proto + "//static." + host;
            var s = document.createElement("script");
            s.type = "text/javascript";
            s.async = true;
            s.src = url + "/widget-send-button/js/init.js";
            s.onload = function() {
                WhWidgetSendButton.init(host, proto, options);
            };
            var x = document.getElementsByTagName("script")[0];
            x.parentNode.insertBefore(s, x);
        })();
    </script>

    <!-- Scripts -->
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/fslightbox.min.js"></script>
    <script src="assets/js/smooth-scroll.js"></script>
    <script src="assets/js/scrollCue.min.js"></script>
    <script src="assets/js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('message'))
    <script>
        swal("Successful!", "{{ session('message') }}!", "success");
    </script>
    @endif
    @if (session('error'))
    <script>
        swal("Error!", "{{ session('error') }}!", "warning");
    </script>
    @endif
    @if (Session::has('success'))
    <script>
        swal("Successful!", "{{ Session::get('success') }}!", "success");
    </script>
    @endif
    @if (Session::has('error'))
    <script>
        swal("Error!", "{{ Session::get('error') }}!", "warning");
    </script>
    @endif

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = 'ab7d8d57178631b207de871d693c62b0c7e5d44e';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>
<noscript>Powered by <a href="https://www.smartsupp.com" target="_blank">Smartsupp</a></noscript>






</body>

</html>