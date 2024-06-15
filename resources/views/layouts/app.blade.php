<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Cake Template">
    <meta name="keywords" content="Cake, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cake Shop</title>

    <!-- Google Font -->
    <link href="{{ asset('users/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('users/css/flaticon.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('users/css/barfiller.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('users/css/magnific-popup.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('users/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('users/css/elegant-icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('users/css/nice-select.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('users/css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('users/css/slicknav.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('users/css/style.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    @include('components.nav')


    @yield('content')



    <!-- Footer Section Begin -->
    <footer class="footer set-bg" data-setbg="{{ asset('users/img/footer-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>WORKING HOURS</h6>
                        <ul>
                            <li>Monday - Friday: 08:00 am – 08:30 pm</li>
                            <li>Saturday: 10:00 am – 16:30 pm</li>
                            <li>Sunday: 10:00 am – 16:30 pm</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="{{ asset('users/img/footer-logo.png') }}" alt=""></a>
                        </div>
                        <p>Lorem ipsum dolor amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore dolore magna aliqua.</p>
                        <div class="footer__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__newslatter">
                        <h6>Subscribe</h6>
                        <p>Get latest updates and offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Email">
                            <button type="submit"><i class="fa fa-send-o"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="{{ asset('users/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('users/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('users/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('users/js/jquery.barfiller.js') }}"></script>
    <script src="{{ asset('users/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('users/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('users/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('users/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('users/js/main.js') }}"></script>
</body>

</html>
