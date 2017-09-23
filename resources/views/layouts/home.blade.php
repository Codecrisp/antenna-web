<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT-SYSTEMS</title>
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/icons/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body data-offset="65" data-spy="scroll" data-target="#nav">
<header id="header-full">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div id="header">
                    <a href="{{ url('/') }}" class="logo">PT-SYSTEMS<!--<span>APP</span>--></a>
                    <a href="#nav" class="nav-toggle"><span class="icon-layout"></span></a>
                    <nav id="nav">
                        <ul class="nav nav-links">
                            <li class="hidden"><a href="#intro"><span></span></a></li>
                            <li><a href="{{ Route::is('home') ? '#features' : url('/') }}">FEATURES</a></li>
                            <li><a href="{{ Route::is('home') ? '#purchase' : url('/') }}">PRE-ORDER</a></li>
                            {{-- <li><a href="{{ Route::is('home') ? '#gps' : url('/') }}">GPS</a></li> --}}
                            <li><a href="{{ Route::is('home') ? '#contact' : url('/') }}">CONTACT</a></li>

                            @if(Auth::user())
                                <li><a href="{{ route('dashboard.home') }}">DASHBOARD</a></li>
                                {{-- <li><a href="{{ route('uploadFile') }}">UPLOAD</a></li>
                                <li><a href="{{ route('mail') }}">MAIL</a></li>
                                <li><a href="{{ route('preorder.list') }}">LISTS</a></li>
                                <li><a href="{{ route('prospects') }}">PROSPECTS</a></li> --}}
                            @else
                                <li><a href="{{ Route::is('login') ? '#' : url('login') }}">LOGIN</a></li>
                            @endif
                            <li{!! \App::getLocale() == 'en' ? ' class="topborder"' : '' !!}><a href="{{ route('locale', 'en') }}"><img src="{{ asset('img/gb.svg') }}" height="15px"></a></li>
                            <li{!! \App::getLocale() == 'nl' ? ' class="topborder"' : ''!!}><a href="{{ route('locale', 'nl') }}"><img src="{{ asset('img/nl.svg') }}" height="15px"></a></li>
                        </ul>
                    </nav>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</header>

@yield('content')

<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p class="copyright">
                    © 2016 PT-Systems. All rights reserved.</br>
                    Created by <a href="http://codecrisp.com/">Codecrisp</a>
                </p>
                <p class="social">
                    <a href="{{ url('privacy-policy') }}" class="delay">Privacy Policy</a>
                    <a href="{{ url('terms-of-service') }}" class="delay">Terms and Conditions</a>
                    <!--<a href="#" class="delay"><i class="icon-facebook3"></i></a>
                    <a href="#" class="delay"><i class="icon-twitter"></i></a>
                    <a href="#" class="delay"><i class="icon-instagram"></i></a>
                    <a href="#" class="delay"><i class="icon-pinterest"></i></a>-->
                </p>
                <p class="" style="margin:0 220px 0 110px; padding-left:250px;font-size:14px;">
                    PT-Systems</br>
                    Molenaarsbreed 2</br>
                    9201EH Drachten</br>
                    The Netherlands</br>
                    Chamber of Commerce: 52441873
                </p>
            </div>
        </div>
    </div>
</footer>

<a class="scrollup delay" href="JavaScript:void(0)"><i class="icon-arrow-up4"></i></a>

<!-- JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/modernizr.custom.js') }}"></script>
<script src="{{ asset('assets/js/placeholder.min.js') }}"></script>
<script src="{{ asset('assets/js/classie.js') }}"></script>
<!--
<script src="{{ asset('assets/js/stepsform.min.js') }}"></script>
-->
<script src="{{ asset('assets/js/sticky.js') }}"></script>
<script src="{{ asset('assets/js/pageslide.min.js') }}"></script>
<script src="{{ asset('assets/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
<script src="{{ asset('assets/sweetalert/sweetalert.min.js') }}"></script>
@include('layouts.partials.tawk')
@yield('footer')
</body>
</html>
