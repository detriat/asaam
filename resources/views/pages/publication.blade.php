@extends('layouts.master')

@section('title', $title)


@section('extra-meta')
    <meta property="og:type" content="website">
    <meta property="og:title" content="Асаам дарит подарки за улыбки">
    <meta property="og:description" content="Я сделал сэлфи со слоном что бы выиграть крутые призы! Попробуй и ты! #чайАССАМ  #селфизапризы">
    {{--<meta property="og:url" content="http://example.com/page.html">--}}
    <meta property="og:locale" content="ru_RU">
    <meta property="og:image" content="{{action('HomeController@index')}}/{{$image}}">
    <meta property="og:image:width" content="640">
    <meta property="og:image:height" content="480">
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

                    if (network === 'facebook'){
                        $('.pluso-facebook').trigger('click');
                    }else if (network === 'vkontakte'){
                        $('.pluso-vkontakte').trigger('click');
                    }else if (network === 'instagram'){
                        $('.share-image').click(function () {
                            $(this).find('a')[0].click();
                        });

                        $('.share-image').trigger('click');
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
                <a href="{{action('HomeController@index')}}/{{ $image }}" class="instagram-download-link" {{( session('network') == 'instagram' ) ? 'download' : ''}}>
                    <img src="/{{ $image }}" alt="share-photo">
                </a>
            </div>
            <div class="share-socials">
                
                <ul class="list-social-network">
                    <li><i class="social-icon social-fb"></i><a href="#">Разместить на facebook </a></li>
                    <li><i class="social-icon social-vk"></i><a href="#">Разместить на vk.com</a></li>
                    <li><i class="social-icon social-in"></i><a href="#">Скачать для размещения в инстаграм</a></li>
                </ul>
                <a href="{{action('HomeController@index')}}" class="btn btn-back_prev">Вернуться назад</a>
            </div>
        </div>
    </div>
@endsection

