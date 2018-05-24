<!DOCTYPE html>
<html lang="ru" prefix="og: http://ogp.me/ns#">
<head>

    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    @hasSection('extra-meta')
        @yield('extra-meta')
    @endif

    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="img/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-touch-icon-114x114.png">

    <!-- Header CSS (First Sections of Website: paste after release from header.min.css here) -->
    <style>
        .preload img{
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
            max-width: 100%;
        }
        .preload{
            position: fixed;
            height: 100%;
            width: 100%;
            background: #ffffff;
            left: 0;
            top: 0;
            /*display: flex;
            align-items: center;
            justify-content: center;*/
            z-index: 999;
        }
        #animations{
            display: none;
        }

    </style>

    <!-- Load CSS, CSS Localstorage & WebFonts Main Function -->
    <script>!function(e){"use strict";function t(e,t,n){e.addEventListener?e.addEventListener(t,n,!1):e.attachEvent&&e.attachEvent("on"+t,n)}function n(t,n){return e.localStorage&&localStorage[t+"_content"]&&localStorage[t+"_file"]===n}function a(t,a){if(e.localStorage&&e.XMLHttpRequest)n(t,a)?o(localStorage[t+"_content"]):l(t,a);else{var s=r.createElement("link");s.href=a,s.id=t,s.rel="stylesheet",s.type="text/css",r.getElementsByTagName("head")[0].appendChild(s),r.cookie=t}}function l(e,t){var n=new XMLHttpRequest;n.open("GET",t,!0),n.onreadystatechange=function(){4===n.readyState&&200===n.status&&(o(n.responseText),localStorage[e+"_content"]=n.responseText,localStorage[e+"_file"]=t)},n.send()}function o(e){var t=r.createElement("style");t.setAttribute("type","text/css"),r.getElementsByTagName("head")[0].appendChild(t),t.styleSheet?t.styleSheet.cssText=e:t.innerHTML=e}var r=e.document;e.loadCSS=function(e,t,n){var a,l=r.createElement("link");if(t)a=t;else{var o;o=r.querySelectorAll?r.querySelectorAll("style,link[rel=stylesheet],script"):(r.body||r.getElementsByTagName("head")[0]).childNodes,a=o[o.length-1]}var s=r.styleSheets;l.rel="stylesheet",l.href=e,l.media="only x",a.parentNode.insertBefore(l,t?a:a.nextSibling);var c=function(e){for(var t=l.href,n=s.length;n--;)if(s[n].href===t)return e();setTimeout(function(){c(e)})};return l.onloadcssdefined=c,c(function(){l.media=n||"all"}),l},e.loadLocalStorageCSS=function(l,o){n(l,o)||r.cookie.indexOf(l)>-1?a(l,o):t(e,"load",function(){a(l,o)})}}(this);</script>

    @hasSection ('extra-css')
        @yield('extra-css')
    @endif

    <!-- Load CSS Start -->
    @hasSection ('extra-fonts')
        @yield('extra-fonts')
    @endif
    <script>loadCSS( "/css/header.min.css?ver=1.0.0", false, "all" );</script>
    <script>loadCSS( "/css/reset.min.css?ver=1.0.0", false, "all" );</script>
    <script>loadCSS( "/css/main.min.css?ver=1.0.0", false, "all" );</script>
    <script>loadCSS( "/css/responsive.min.css?ver=1.0.0", false, "all" );</script>
    <!-- Load CSS End -->

    <!-- Load CSS Compiled without JS -->
    <noscript>
        <link rel="stylesheet" href="/css/fonts.min.css">
        <link rel="stylesheet" href="/css/main.min.css">
    </noscript>

</head>
<body>
<div class="preload">
    <img src="/img/elefant.gif" alt="">
</div>
<div class="page-content {{ (!isset($isHome)) ? 'childPage' : '' }}">
    <!-- ШАпка -->
    <header>
        <div class="container">
            <div class="header-content">
                <div class="header-left">
                    <ul class="header-links">
                        <li><a href="{{action('HomeController@termsOfAction')}}" class="{{ (isset($terms)) ? 'active' : '' }}">Условия</a></li>
                        <li><a href="{{action('HomeController@userAgreement')}}" class="{{ (isset($agreement)) ? 'active' : '' }}">Соглашение с пользователем</a></li>
                    </ul>
                </div>
                <div class="header-center">
                    <a href="/" class="logo"><img src="/img/logo.png" alt=""></a>
                </div>
                <div class="header-right">
                    <ul class="header-links">
                        <li>
                            <i><img src="/img/icons/prize.png" alt=""></i>
                            <a href="{{action('HomeController@prizes')}}" class="{{ (isset($prizes)) ? 'active' : '' }}">
                                Призы
                            </a>
                        </li>
                        <li>
                            <i><img src="/img/icons/winners.png" alt=""></i>
                            <a href="{{action('HomeController@winners')}}" class="{{ (isset($winners)) ? 'active' : '' }}">
                                Победители
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="burger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <nav class="menu">
                    <ul>
                        <li><a href="{{action('HomeController@termsOfAction')}}" class="{{ (isset($terms)) ? 'active' : '' }}">Условия</a></li>
                        <li><a href="{{action('HomeController@userAgreement')}}" class="{{ (isset($agreement)) ? 'active' : '' }}">Соглашение с пользователем</a></li>
                        <li><a href="{{action('HomeController@prizes')}}" class="{{ (isset($prizes)) ? 'active' : '' }}">Призы</a></li>
                        <li><a href="{{action('HomeController@winners')}}" class="{{ (isset($winners)) ? 'active' : '' }}">Победители</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <!-- ШАпка -->

    <!-- Контент -->
    <div class="wrapper-content">
        <div class="container">
            @hasSection ('bread-crumbs')
                @yield('bread-crumbs')
            @endif

            @hasSection ('content')
                @yield('content')
            @endif
        </div>
    </div>
    <!-- Контент -->

    <!--Подвал -->
    <footer>
        <div class="bottom-left-uzor"></div>
        <div class="bottom-left-uzor1"></div>

        <div class="bottom-right-uzor"></div>
        <div class="bottom-right-uzor2"></div>
    </footer>
    <!--Подвал -->
</div>

<div class="top-uzor-small"></div>
<div class="top-left-uzor"></div>
<div class="big-elefant"></div>


<!--[if lt IE 9]>
<script src="/development/libs/html5shiv/es5-shim.min.js"></script>
<script src="/development/libs/html5shiv/html5shiv.min.js"></script>
<script src="/development/libs/html5shiv/html5shiv-printshiv.min.js"></script>
<script src="/development/libs/respond/respond.min.js"></script>
<![endif]-->
<script src="/js/libs.min.js"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>

@hasSection ('extra-scripts')
    @yield('extra-scripts')
@endif

<script src="/js/common.min.js"></script>
@if ($errors->any())
    <div class="alert alert-danger" style="position:fixed;top:30px;right:30px;z-index:99999;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('success_messages'))
    <div class="alert alert-success" style="position:fixed;top:30px;right:30px;z-index:99999;">
        <ul>
            @foreach (session('success_messages') as $message)
                <li>{!! $message !!}</li>
            @endforeach
        </ul>
    </div>
@endif

@yield('overlay')
</body>
</html>