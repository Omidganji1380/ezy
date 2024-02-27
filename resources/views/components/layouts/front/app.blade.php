<!DOCTYPE html>
<html lang="fa">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <!-- Meta -->

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Title -->
    <title>{{\App\Models\Option::query()->where('option','title')->first()->value}}</title>
    <link rel="shortcut icon" href="{{asset('storage/favicon/favicon.png')}}">

    <!-- CSS Plugins -->
    <link rel="stylesheet" href="{{asset('front/css/plugins/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/plugins/simplebar.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/plugins/feather.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/plugins/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/plugins/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/plugins/magnific-popup.css')}}">

    <!-- CSS Base -->
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
    <link rel="stylesheet" class="box-st" href="{{asset('front/css/settings/title.css')}}">
    <link rel="stylesheet" class="theme-color" href="{{asset('front/css/settings/green-color.css')}}">

    <link rel="stylesheet" href="{{asset('front/setting/style-demo.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('css')
    @livewireStyles
</head>

<body id="bodyTag">
@if(Request::routeIs('index'))
    <!--Theme Options Start-->
    @livewire('front.theme-option')

    <!-- Preloader -->
    @livewire('front.preload')
@endif
<!-- Wrap Start -->
<div class="wrap">

    <div class="page-wrap animate-none">
        {{$slot}}
    </div>
</div>

<!-- Cursor -->
<div class="cursor" id="cursor"></div>
<div class="cursor-border" id="cursor-border"></div>
@if(Request::routeIs('index') && !Auth::user())
    <!-- auth Block -->
    @livewire('front.auth')
@endif
<!-- All Script -->
<script src="{{asset('front/js/plugins/jquery.min.js')}}"></script>
<script src="{{asset('front/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{asset('front/js/plugins/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('front/js/plugins/simplebar.js')}}"></script>
<script src="{{asset('front/js/plugins/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('front/js/plugins/swiper.min.js')}}"></script>
<script src="{{asset('front/js/plugins/TweenMax.min.js')}}"></script>
<script src="{{asset('front/js/plugins/jquery.validation.js')}}"></script>
<script src="{{asset('front/js/main.js')}}"></script>
<script src="{{asset('front/js/menu.js')}}"></script>
<script src="{{asset('front/js/plugins/tilt.js')}}"></script>
<script src="https://maps.google.com/maps/api/js?sensor=false"></script>

<script src="{{asset('front/setting/main-demo.js')}}"></script>

<script>
    $(window).on("load", function () {

        /* -----------------------------------
                01. Music Background
        ----------------------------------- */
        $('body')
            .append('<audio loop autoplay volume="1" id="audio-player"><source src="{{asset('storage/favicon/music.mp3')}}" type="audio/mpeg"></audio>');
        var audio    = document.getElementById("audio-player");
        audio.volume = 0.2;

        if ($(window).length) {
            $('.music-bg').css({'visibility': 'visible'});
            $('body').addClass("audio-off");
            if ($('body').hasClass('audio-off')) {
                $('body').removeClass('audio-on');
            }
            $(".music-bg").on('click', function () {
                $('body').toggleClass("audio-on audio-off");
                if ($('body').hasClass('audio-off')) {
                    audio.pause();
                }
                if ($('body').hasClass('audio-on')) {
                    audio.play();
                }
            });
        }
    })
</script>
@stack('js')
@livewireScripts
</body>

</html>
