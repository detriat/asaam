@extends('layouts.master')

@section('title', $title)


@section('extra-meta')
    <meta property="og:type" content="website">
    <meta property="og:title" content="Ассам дарит подарки за улыбки">
    <meta property="og:description" content="Я сделал сэлфи со слоном что бы выиграть крутые призы! Попробуй и ты! #чайАССАМ  #селфизапризы">
    <meta property="og:url" content="{{action('HomeController@index')}}/publication/{{$id_image}}">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:image" content="{{action('HomeController@index')}}/{{$image}}">
    <meta property="vk:image" content="{{action('HomeController@index')}}/{{$image}}">
    <meta property="fb:app_id" content="157954035054756">
@endsection


@section('extra-fonts')
    <link rel="stylesheet" href="/fonts/DSIzmir/dsi.css">
@endsection

@section('content')
    {{--@include('auth.share_images')--}}
		<div class="publication publication-content">
			<div class="container">
				<h1>отличный снимок!</h1>
				<p>Теперь выберите способ публикации вашего селфи</p>
				<div class="row">
					<div class="col-md-6">
						<div class="image share-image">
							<a href="{{action('HomeController@index')}}/{{ $image }}" class="instagram-download-link">
								<img src="/{{ $image }}" alt="" />
							</a>
						</div>
					</div>
					<div class="col-md-5 col-md-offset-1">
                        @include('auth.social')
						<a href="{{action('HomeController@index')}}" title="" class="btn btn-1">Вернуться назад</a>
					</div>
				</div>
			</div>
		</div>
		
@endsection
