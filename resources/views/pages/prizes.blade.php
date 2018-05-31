@extends('layouts.master')

@section('title', $title)

@section('content')
    <div class="child-page-content prizes-content">
		<div class="container">
			<h1 class="title-page">{{$title}}</h1>

			<div class="child-page-content__text scroll-line">
				<div class="prize-items">
					<div class="prize-item grand-prize">
						<div class="prize-item__info">
							<div class="prize-item__image">
								<div class="grand-image">
									<img src="/img/grand-prize-phone.png" alt="">
								</div>
							</div>
							<div class="prize-item__info-text">
								<div class="prize-item__title">Приз №1</div>
								<div class="prize-item__category">Iphone X - 1 шт.</div>
							</div>
						</div>
						<div class="prize-item__description"></div>
					</div>

					<div class="prize-item">
						<div class="prize-item__info">
							<div class="prize-item__image">
								<img src="/img/prize-money.png" alt="">
							</div>
							<div class="prize-item__info-text">
								<div class="prize-item__title">Приз №2</div>
								<div class="prize-item__category">100 000 тенге - 1 шт.</div>
							</div>
						</div>
						<div class="prize-item__description"></div>
					</div>
					<div class="prize-item">
						<div class="prize-item__info">
							<div class="prize-item__image">
								<img src="/img/prize-tea.png" alt="">
							</div>
							<div class="prize-item__info-text">
								<div class="prize-item__title">Приз №3</div>
								<div class="prize-item__category">Годовой запас чая АССАМ - 30 шт</div>
							</div>
						</div>
						<div class="prize-item__description">
							Годовой запас чая <br>
							1 приз  включает - 20 пачек чая АССАМ черный по 100 чайных пакетиков в каждой пачке.
						</div>
					</div>
					<div class="prize-item">
						<div class="prize-item__info">
							<div class="prize-item__image">
								<img src="/img/periodic-prize.png" alt="">
							</div>
							<div class="prize-item__info-text">
								<div class="prize-item__title">Приз №4</div>
								<div class="prize-item__category">Подарочные наборы чая - 45 шт.</div>
							</div>
						</div>
						<div class="prize-item__description"></div>
					</div>
					<div class="prize-item">
						<div class="prize-item__info">
							<div class="prize-item__image">
								<img src="/img/umbrella-prize.png" alt="">
							</div>
							<div class="prize-item__info-text">
								<div class="prize-item__title">Приз №5</div>
								<div class="prize-item__category">Брендированный зонт АСААМ - 50 шт.</div>
							</div>
						</div>
						<div class="prize-item__description"></div>
					</div>
				</div>
			</div>
		</div>
    </div>
@endsection
