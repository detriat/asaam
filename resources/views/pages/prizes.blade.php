@extends('layouts.master')

@section('title', $title)

@section('content')
    <div class="prizes-content">
        <h1 class="title-page">{{$title}}</h1>

        <div class="prize-items">
            <div class="prize-item grand-prize">
                <div class="prize-item__info">
                    <div class="prize-item__image">
                        <div class="grand-image">
                            <img src="/img/grand-prize-phone.png" alt="">
                        </div>
                    </div>
                    <div class="prize-item__info-text">
                        <div class="prize-item__title">Главный приз</div>
                        <div class="prize-item__category">Iphone X, 1 шт</div>
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
                        <div class="prize-item__title">Приз в 100 000 тенге</div>
                        <div class="prize-item__category">Денежный приз</div>
                    </div>
                </div>
                <div class="prize-item__description"></div>
            </div>
            <div class="prize-item">
                <div class="prize-item__info">
                    <div class="prize-item__image">
                        <img src="/img/periodic-prize.png" alt="">
                    </div>
                    <div class="prize-item__info-text">
                        <div class="prize-item__title">Переодические призы</div>
                        <div class="prize-item__category">Годовой запас чая АССАМ, 30 шт</div>
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
                        <img src="/img/prize-money.png" alt="">
                    </div>
                    <div class="prize-item__info-text">
                        <div class="prize-item__title">Утешительные призы</div>
                        <div class="prize-item__category">Брендированный зонт АСААМ - 50шт.</div>
                    </div>
                </div>
                <div class="prize-item__description"></div>
            </div>
        </div>
    </div>
@endsection
