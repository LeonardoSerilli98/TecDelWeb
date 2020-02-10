<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"

    <link rel="icon" href="{{ asset('img/core-img/favicon.ico') }}">

    <link href="{{ asset('css/myStyle.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/responsive/responsive.css') }}" rel="stylesheet" type="text/css">
    <!-- Jquery-2.2.4 js -->
    <script src="{{ asset('js/jquery/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://kit.fontawesome.com/58f01e1ae9.js" crossorigin="anonymous"></script>


    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: black;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<!-- Preloader Start -->
<div id="preloader">
    <div class="yummy-load"></div>
</div>


<!-- ****** Top Header Area Start ****** -->
<div class="top_header_area d-flex flex-row flex-center justify-content-between mioHeader">
    <div class="pl-3">
        <ul class=" login-register">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>

    <div class="pr-3">
        <div class="">
            <div class="d-flex flex-row flex-center">

                <form action="{{route('search')}}" method="get" class="form_ricerca" >
                    <input type="search" name="q" class="barraRicerca" id="search-anything" placeholder="Cerca un libro... ">
                    <input type="submit" value="" class="d-none">

                    <button type="submit" class="btn ricerca bottone">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </button>
                </form>

                <a class="bottone" href="/cart"> <i class="fas fa-shopping-cart pr-3"></i> </a>

                <button type="button" class="btn profilo bottone" id="login-btn">
                    <i class="fas fa-user"></i>
                </button>
            </div>
        </div>
    </div>


</div>
<!-- ****** Top Header Area End ****** -->
<a href="/" class="titolo">saaaaaaaaaas</a>
<!-- ****** Header Area Start ****** -->
<header class="header_area">
    <div class="container">
        <div class="row">
            <!-- Logo Area Start -->
            <div class="col-12">
                <div class="logo_area text-center">
                    <a href="/" class="yummy-logo"></a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#yummyfood-nav" aria-controls="yummyfood-nav" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars" aria-hidden="true"></i> Menu</button>
                    <!-- Menu Area Start -->
                    <div class="collapse navbar-collapse justify-content-center" id="yummyfood-nav">
                        <ul class="navbar-nav" id="yummy-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/">Home </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/authors">Autori</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/categories">Categorie</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/collections">Raccolte</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/whishlist">Wishlist</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/boughts">I Miei Libri</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ****** Header Area End ****** -->

@yield('content')

<!-- ****** Footer Social Icon Area Start ****** -->
<!--
<div class="social_icon_area clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer-social-area d-flex">
                    <div class="single-icon">
                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i><span>facebook</span></a>
                    </div>
                    <div class="single-icon">
                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i><span>Twitter</span></a>
                    </div>
                    <div class="single-icon">
                        <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i><span>GOOGLE+</span></a>
                    </div>
                    <div class="single-icon">
                        <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i><span>linkedin</span></a>
                    </div>
                    <div class="single-icon">
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i><span>Instagram</span></a>
                    </div>
                    <div class="single-icon">
                        <a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i><span>VIMEO</span></a>
                    </div>
                    <div class="single-icon">
                        <a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i><span>YOUTUBE</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
-->
<!-- ****** Footer Social Icon Area End ****** -->

<!-- ****** Footer Menu Area Start ****** -->
<footer class="footer_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer-content">

                    <!-- Menu Area Start -->
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#yummyfood-footer-nav" aria-controls="yummyfood-footer-nav" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars" aria-hidden="true"></i> Menu</button>
                        <!-- Menu Area Start -->
                        <div class="collapse navbar-collapse justify-content-center" id="yummyfood-footer-nav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="/">Home </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/authors">Autori</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/categories">Categorie</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="/collections">Raccolte</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link link_utente" href="/whishlist">Wishlist</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link link_utente" href="/boughts">I Miei Libri</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>


</footer>

<!-- ****** Footer Menu Area End ****** -->


<!-- Popper js -->
<script src="{{ asset('js/bootstrap/popper.min.js') }}"></script>
<!-- Bootstrap-4 js -->
<script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
<!-- All Plugins JS -->
<script src="{{ asset('js/others/plugins.js') }}"></script>
<!-- Active JS -->
<script src="{{ asset('js/active.js') }}"></script>
</body>
</html>
