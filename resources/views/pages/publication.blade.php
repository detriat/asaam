@extends('layouts.master')

@section('title', $title)


@section('extra-meta')
    {{--<meta property="og:url"                content="{{action('HomeController@index')}}" />--}}
    <meta property="og:type"               content="website" />
    <meta property="og:title"              content="Asaam" />
    <meta property="og:description"        content="#asaam" />
    <meta property="og:image"              content="{{action('HomeController@index')}}/{{ $image }}" />
@endsection

@section('extra-fonts')
    <link rel="stylesheet" href="/fonts/DSIzmir/dsi.css">
@endsection

@if (session('network'))
    @section('extra-scripts')
        <script>
            $(document).ready(function () {
                setTimeout(function(){
                    var network = '{{session('network')}}';
                    console.log(network);
                    if (network === 'facebook'){

                        $('.pluso-facebook').trigger('click');

                        /*window.fbAsyncInit = function() {
                            FB.init({
                                appId            : '157954035054756',
                                autoLogAppEvents : true,
                                xfbml            : true,
                                version          : 'v3.0'
                            });
                            FB.ui({
                                method: 'share',
                                href: '{{action('HomeController@index')}}'
                            }, function(response){
                                console.log(response);
                            });
                        };

                        (function(d, s, id){
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) {return;}
                            js = d.createElement(s); js.id = id;
                            js.src = "https://connect.facebook.net/en_US/sdk.js";
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));
*/
                    }else if (network === 'vkontakte'){
                        $('.pluso-vkontakte').trigger('click');
                    }else if (network === 'instagram'){
                        $('.instagram-download-link').trigger('click');
                    }
                }, 1000);
            });
        </script>
    @endsection
@endif

@section('content')

    @include('auth.social')
    @include('auth.share_images')

    <div class="publication-content bottom-box-effect">
        <div class="dsi-title">Отличный снимок!</div>
        <div class="publication-description">
            Теперь выберите способ публикации вашего селфи
        </div>

        <div class="share-block">
            <div class="share-image">
                <img src="/{{ $image }}" alt="share-photo">
            </div>
            <div class="share-socials">
                
                <ul class="list-social-network">
                    <li><i class="social-icon social-fb"></i><a href="/socialite/facebook">Разместить на facebook </a></li>
                    <li><i class="social-icon social-vk"></i><a href="/socialite/vkontakte">Разместить на vk.com</a></li>
                    <li><i class="social-icon social-in"></i><a href="/socialite/instagram" class="instagram-download-link" {{( session('network') == 'instagram' ) ? 'download' : ''}}>Скачать для размещения в инстаграм</a></li>
                </ul>
                <a href="{{action('HomeController@index')}}" class="btn btn-back_prev">Вернуться назад</a>
            </div>
        </div>
    </div>
@endsection

