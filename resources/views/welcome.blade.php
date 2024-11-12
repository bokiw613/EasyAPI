<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from exill.dk/demo/kitzu/template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Sep 2020 16:59:42 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
  <!-- Required meta tags-->
  <meta charset="utf-8">
  <!-- Title-->
  <title>Citarum - BBWS </title>
  <!-- Description-->
  <meta name="description" content="Personal Portfolio Template">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicons-->
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo-pu.jpeg') }}">
  <!-- Web fonts-->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i&amp;display=swap" rel="stylesheet">
  <!-- CSS vendors-->
  <link rel="stylesheet" href="{{ asset('css_lp/bootstrap-custom.css') }}">
  <link rel="stylesheet" href="{{ asset('css_lp/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css_lp/tiny-slider.css') }}">
  <link rel="stylesheet" href="{{ asset('css_lp/lity.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css_lp/simplebar.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css_lp/jquery.mb.YTPlayer.min.css') }}">
  <!-- Main CSS-->
  <link rel="stylesheet" href="{{ asset('css_lp/main.css') }}">
  <link rel="stylesheet" href="{{ asset('css_lp/bg.css') }}">
  <!-- CSS Color scheme-->
  <link id="color-scheme" rel="stylesheet" href="{{ asset('css_lp/colors/main-darkgreen.css') }}">
  <!-- Custom CSS (Add your custom CSS styles to this file)-->
  <link rel="stylesheet" href="{{ asset('css_lp/custom.css') }}">
  <!-- removeIf(customizerDist) -->
  <link rel="stylesheet" href="{{ asset('../customizer/main.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  
  <!-- endremoveIf(customizerDist)-->
</head>

<body class="theme-dark">
  <!-- Preloader-->
  <div class="preloader">
    <div class="preloader-block">
      <div class="preloader-icon"><span class="loading-dot loading-dot-1"></span><span class="loading-dot loading-dot-2"></span><span class="loading-dot loading-dot-3"></span></div>
    </div>
  </div>
  <div id="overlay-effect"></div>
  <!-- Navbar-->
  <nav class="navbar-expand-md navbar fixed-top" id="navbar"><a class="navbar-brand" data-scroll="" href="#home-area">
      <!-- Navbar Logo-->
      <img class="img-fluid" src="img/img-kitzu-logo.png" style="visibility: hidden;" alt="Logo"></a>
    <span class="navbar-menu ml-auto" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" role="button"><span class="btn-line"></span></span>
    <div class="collapse navbar-collapse order-1 order-lg-0 d-flex justify-content-between" id="navbarSupportedContent">
    <!-- Logo besar di ujung kiri -->
    <div class="navbar-brand">
        <img src="{{ asset('images/logo-pu.jpeg') }}" alt="Logo" style="height: 50px; width: auto;">
    </div>

    <!-- Navbar menu di ujung kanan -->
    <ul class="navbar-nav ml-auto">
        @if (Route::has('login'))
            @auth
                <!-- Jika sudah login, tampilkan link dashboard dengan ikon -->
                <li class="nav-item">
                    <a class="nav-link font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" href="{{ url('/dashboard') }}">
                        Dashboard <i class="fas fa-tachometer-alt ml-2"></i>
                    </a>
                </li>
            @else
                <!-- Jika belum login, tampilkan link login dan register dengan ikon -->
                <li class="nav-item">
                    <a class="nav-link font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" href="{{ route('login') }}">
                        Log in <i class="fas fa-sign-in-alt ml-2"></i>
                    </a>
                </li>

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" href="{{ route('register') }}">
                            Register <i class="fas fa-user-plus ml-2"></i>
                        </a>
                    </li>
                @endif
            @endauth
        @endif
    </ul>
</div>


  </nav>
<!-- Home -->
<section class="home-area element-cover-bg" id="home">
  <video autoplay muted loop playsinline class="video-bg">
    <source src="{{ asset('images/bgv_3.mp4') }}" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <div class="container h-100">
    <div class="row h-100 align-items-center justify-content-center">
      <div class="col-12 col-lg-8 home-content text-center">
        <h1 class="home-name">Citarum <span>BBWS</span></h1>
        <h4 class="cd-headline clip home-headline">Adalah <span class="cd-words-wrapper single-headline"><b class="is-visible">Sungai Terpanjang di Jawa Barat</b><b>Balai Irigasi Pertanian</b><b>Sungai Terpanjang di Jawa</b></span></h4>
      </div>
    </div>
  </div>
  <div class="fixed-wrapper">
    <!-- Languages list -->
    <div class="fixed-block block-left">
      <ul class="list-unstyled languages-list">
        <li><a href="#0"><span class="single-language">ENG</span></a></li>
        <li><a href="#0"><span class="single-language">IDN</span></a></li>
      </ul>
    </div>
    <!-- Social media icons -->
    <div class="fixed-block block-right">
      <ul class="list-unstyled social-icons">
        
      <li><a href="https://www.facebook.com/pupr.sda.citarum/"><i class="icon ion-logo-facebook"></i></a></li>
<li><a href="https://x.com/satgascitarum?lang=en"><i class="icon ion-logo-twitter"></i></a></li>


        <li><a href="https://id.linkedin.com/company/kementerian-pekerjaan-umum-dan-perumahan-rakyat-pupr"><i class="icon ion-logo-linkedin"></i></a></li>
        <li><a href="https://www.instagram.com/kemenpupr/?hl=en"><i class="icon ion-logo-instagram"></i></a></li>
      </ul>
    </div>
  </div>
</section>

  <!-- Scripts-->
  <script src="{{ asset('js_lp/jquery.min.js') }}"></script>
  <script src="{{ asset('js_lp/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js_lp/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('js_lp/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('js_lp/animatedModal.js') }}"></script>
  <script src="{{ asset('js_lp/tiny-slider.js') }}"></script>
  <script src="{{ asset('js_lp/lity.min.js') }}"></script>
  <script src="{{ asset('js_lp/simplebar.min.js') }}"></script>
  <script src="{{ asset('js_lp/jquery.mb.YTPlayer.min.js') }}"></script>
  <script src="{{ asset('js_lp/main.js') }}"></script>
  <!-- Custom JS (Add your custom JS scripts to this file)-->
  <script src="{{ asset('js_lp/custom.js') }}"></script>
  <!-- removeIf(customizerDist) -->
  <script src="{{ asset('../customizer/main.js') }}"></script>
  
  <!-- endremoveIf(customizerDist)-->
</body>


<!-- Mirrored from exill.dk/demo/kitzu/template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Sep 2020 17:00:43 GMT -->
</html>