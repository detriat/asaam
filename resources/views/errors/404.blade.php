@extends('layouts.error')

@section('title', 'Страница не найдена!')

@section('content')
    <div class="page-error error-404">
        <div class="page-error__content">
            <div class="error-title">Страница не найдена</div>
            <div class="error-notice">Ошибка</div>

            <div class="error-image"><img src="/img/error-404.png" alt=""></div>

            <a href="{{action('HomeController@index')}}" class="btn btn-back_prev error-btn">Вернуться на главную</a>
        </div>
    </div>
@endsection