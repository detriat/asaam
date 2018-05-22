@extends('layouts.master')

@section('title', $title)

@section('content')
    <div class="child-page-content">
        <h1 class="title-page">{{$title}}</h1>

       <div class="child-page-content__text scroll-line terms">
			<p>
				Участниками акции становятся пользователи, которые перешли на страницу promo.assamtea.kz (рабочее название) и произвели следующие действия: 
			</p>
			<ul>
				<li>Разрешили подключение web камеры своего устройства к promo-странице </li>
				<li>Сделали сэлфи снимок: 
					<ul>
						<li>Разрешить доступ к web камере вашего устройства </li>
						<li>Подождать пока загрузится анимация </li>
						<li>Нажать на «Сделать снимок». </li>
						<li>Нажать на «Далее» если считаете, что снимок вышел удачным. </li>
						<li>Нажать на «Сделать еще раз» если хотите попробовать еще один снимок. </li>
					</ul>
				</li>
				<li>Разместить на своей странице пост из promo страницы выбрав один из трех предложенных вариантов: 
					<ul>
						<li>vk.com </li>
						<li>facebook.com </li>
						<li>для Instagram пользователю необходимо скачать на своё устройство обработанную фотографию и опубликовать ее в своём Instagram с хештегом #селфизапризы #чайАССАМ </li>
					</ul>
				</li>
			</ul>
			<p>
				Мы определяем победителей среди тех участников, которые наберут наибольшее количество лайков на размещенный пост. Promo акция предусматривает 5 категорий победителей и призов: 
			</p>
			<ul>
				<li>Главный приз Iphone X. Разыгрывается среди участников, которые наберут более 40 лайков на свой пост. </li>
				<li>Приз за второе место – 100 000 тенге. Разыгрывается среди участников, которые наберут более 30 лайков на своей пост. </li>
				<li>Приз за третье место – годовой запас чая. Разыгрывается среди участников, которые наберут более 20 лайков на свой пост. </li>
				<li>Поощрительные призы – разыгрывается среди участников, которые наберут более 5 лайков на свой пост и 10 лайков на свой пост.</li>
			</ul>
       </div>
    </div>
@endsection

