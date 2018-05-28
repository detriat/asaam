@extends('layouts.master')

@section('title', $title)


@section('extra-meta')
    <meta property="og:type" content="website">
    <meta property="og:title" content="Асаам дарит подарки за улыбки">
    <meta property="og:description" content="Я сделал сэлфи со слоном что бы выиграть крутые призы! Попробуй и ты! #чайАССАМ  #селфизапризы">
    <meta property="og:url" content="{{action('HomeController@index')}}/publication/{{$id_image}}">
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
				$("body").attr("class", "index-2");
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
		<div class="publication publication-content">
			<div class="container">
				<h1>отличный снимок!</h1>
				<p>Теперь выберите способ публикации вашего селфи</p>
				<div class="row">
					<div class="col-md-6">
						<div class="image share-image">
							<a href="{{action('HomeController@index')}}/{{ $image }}" class="instagram-download-link" {{( session('network') == 'instagram' ) ? 'download' : ''}}>
								<img src="/{{ $image }}" alt="" />
							</a>
						</div>
					</div>
					<div class="col-md-5 col-md-offset-1 share-socials">
						<a href="#" title="" class="social social-fb fb">Разместить на facebook</a>
						<a href="#" title="" class="social social-vk vk">Разместить на vk.com</a>
						<a href="#" title="" class="social social-in in">Скачать для размещения в instagram<span>Чтобы разметстить фото в инстаграм, скачайте фото на устройство. Не забудьте разместить хэштег #попробуйсам </span></a>
						<a href="{{action('HomeController@index')}}" title="" class="btn btn-1">Вернуться назад</a>
					</div>
				</div>
			</div>
		</div>
		
@endsection

