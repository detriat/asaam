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

    <link rel="shortcut icon" href="/img/favicon/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="/img/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/favicon/apple-touch-icon-114x114.png">

    <!-- Header CSS (First Sections of Website: paste after release from header.min.css here) -->
	<style>
		@media screen and (min-width: 1000px) and (max-width: 1600px) {
			html {
				zoom: .67;
			}
		}
		.preloader {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			overflow-x: hidden;
			overflow-y: auto;
			z-index: 99999;
		}
		.preloader::-webkit-scrollbar {
			width: 0;
		}
		.preloader .social {
			text-align: center;
		}
		.preloader .social a {
			margin: 0 35px;
			padding-left: 45px;
		}
		.preloader .child-page-content .container {
			background: none;
			color: #fff;
		}
		.preloader .title-page {
			color: #fff;
		}
		.preloader h2 {
			color: #f5b63b;
			text-align: center;
			margin-bottom: 30px;
		}
		.preloader h2 img {
			margin-bottom: 30px;
		}
		.preloader .child-page-content {
			min-height: 1356px;
			margin: 0;
			padding: 50px 0;
			line-height: 30px!important;
			background: url(/img/preloader-bg.jpg) top;
			background-size: cover;
		}
		.preloader .child-page-content p {
			line-height: 30px!important;
		}
		.preloader .child-page-content__text {
			overflow-x: hidden;
			overflow-y: hidden;
			max-height: 9999px;
			font-size: 18px;
		}
		.preloader ul {
			padding-left: 50px!important;
		}
		.preloader .item {
			margin-bottom: 30px;
			list-style: none;
			position: relative;
		}
		.preloader .item:before {
			content: '';
			position: absolute;
			top: 0;
			left: -50px;
			width: 36px;
			height: 36px;
		}
		.preloader .item-1:before {
			background: url(/img/icon-web-cam.png) center no-repeat;
		}
		.preloader .item-2:before {
			background: url(/img/icon-take-picture.png) center no-repeat;
		}
		.preloader .item-3:before {
			background: url(/img/icon-share.png) center no-repeat;
		}
		.preloader ul ul li {
			color: #f5b63b;
			list-style-type: disc;
		}
		.preloader ul ul li span {
			color: #fff;
		}
		@media screen and (max-width: 768px) {
			.preloader .child-page-content, .social {
				height: auto!important;
			}
			.preloader ul ul {
				padding-left: 20px!important;
				margin-left: -50px;
				margin-top: 5px;
			}
			.social {
				padding-left: 0!important;
				text-align: left!important;
			}
			.social a {
				margin-bottom: 10px!important;
			}
			.preloader .title-page {
				margin-bottom: 15px!important;
			}
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

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-120458217-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-120458217-1');
	</script>
	
</head>
<body class="index-1" style="overflow: hidden;">
	<div class="preloader">
		<div class="child-page-content">
			<div class="container" style="position: relative;">
				<img src="/img/preloader.gif" alt="" style="position: absolute; top: 30px; right: 0; width: 197px; height: 150px;" />
				<h2>
					<img src="/img/logo.png" alt="" /><br/>
					Пожалуйста подождите, идет загрузка...
				</h2>
				<h1 class="title-page">Условия акции</h1>
				<div class="child-page-content__text terms">
					<ul>
						<li class="item item-1">Разрешите подключение web камеры своего устройства к приложению</li>
						<li class="item item-2">Сделайте сэлфи снимок</li>
						<li class="item item-3">Разместите на своей странице пост из promo страницы выбрав один из трех предложенных вариантов: 
							<ul>
								<li><span>vk.com</span></li>
								<li><span>facebook.com</span></li>
								<li><span>для Instagram пользователю необходимо скачать на своё устройство обработанную фотографию и опубликовать ее в своём Instagram с хештегом #селфизапризы #чайАССАМ</span></li>
							</ul>
						</li>
					</ul>
					<p>
						Чтобы принять участие в розыгрыше подпишитесь на страницы чая АССАМ в любой социальной сети:
					</p>
					<div class="social">
						<a href="https://instagram.com/@assam.kazakhstan" title="" class="in">@assam.kazakhstan</a>
						<a href="https://facebook.com/@Assam.Kazakhstan" title="" class="fb">@Assam.Kazakhstan</a>
						<a href="https://vk.com/" title="" class="vk">Assam Kazakhstan</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section>
		<div class="title">
			<h3>ДЛЯ УЧАСТИЯ:</h3>
			<ol>
				<li>Сделай селфи в этом приложении</li>
				<li>Размести селфи на странице Facebook, VK или Instagram</li>
				<li>Подпишись на нашу страничку и следи за розыгрышем!</li>
			</ol>
			<i><small>*В акции участвуют только пользователи с открытыми аккаунтами в выбранной соцсети, выполнившие все условия акции.</small></i>
		</div>
		<div class="header">
			<div class="hd hd-left"></div>
			<div class="hd hd-right"></div>
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-xs-3">
						<div class="row">
							<ul class="nav-1">
								<li>
									<a id="title" href="{{action('HomeController@termsOfAction')}}" title="">Условия</a>
								</li>
								<li><a href="{{action('HomeController@userAgreement')}}" title="">Пользовательское соглашение</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-4 col-xs-6">
						<a href="/" title="" class="logo">
							<img src="/img/logo.png" alt="" />
						</a>
						<button class="burger">☰</button>
						<div class="menu">
							<ul class="nav-mobile">
								<li><a href="{{action('HomeController@termsOfAction')}}" title="">Условия</a></li>
								<li><a href="{{action('HomeController@userAgreement')}}" title="">Пользовательское соглашение</a></li>
								<li><a href="{{action('HomeController@winners')}}" title="" class="icon icon-2">Победители</a></li>
								<li><a href="{{action('HomeController@prizes')}}" title="" class="icon icon-1">Призы</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-4 col-xs-3">
						<div class="row">
							<ul class="nav-2">
								<li><a href="{{action('HomeController@winners')}}" title="" class="icon icon-2">Победители</a></li>
								<li><a href="{{action('HomeController@prizes')}}" title="" class="icon icon-1">Призы</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Контент -->
		@hasSection ('content')
			@yield('content')
		@endif
		<!-- Контент -->
		
		<div class="ft"></div>
	</section>


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
	<div class="overlay" id="warningNotice">
		<div class="window">
			<div class="window-confirm">
				<div class="confirm-title"></div>
				<div class="buttons confirm-btns">
					<a href="#warningNotice" class="btn btn-1 confirm-btn confirmation-confirm"
					   data-action="read-notice">Хорошо</a>
				</div>
			</div>
		</div>
	</div>
</body>

<!--[if lt IE 9]>
<script src="/development/libs/html5shiv/es5-shim.min.js"></script>
<script src="/development/libs/html5shiv/html5shiv.min.js"></script>
<script src="/development/libs/html5shiv/html5shiv-printshiv.min.js"></script>
<script src="/development/libs/respond/respond.min.js"></script>
<![endif]-->
<script
		src="https://code.jquery.com/jquery-2.2.4.min.js"
		integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
		crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });
    function showWarningNotice(message) {

        $('#warningNotice .confirm-title').text(message);
        $('#warningNotice').displayFlex();
    }

    $.fn.displayFlex = function () {
        $(this).css('display', 'flex');
    };

</script>

@hasSection ('extra-scripts')
	@yield('extra-scripts')
@endif

<script src="/js/common.min.js"></script>

</html>