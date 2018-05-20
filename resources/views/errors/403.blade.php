@extends('layouts.error')

@section('title', 'Доступ запрещён!')

@section('content')
    <div class="page-error error-403">
        <div class="page-error__content">
            <div class="error-title">Доступ запрещён!</div>
            <div class="error-notice">Ошибка</div>

            <div class="error-image"><img src="/img/error-403.png" alt=""></div>

            <a href="{{action('HomeController@index')}}" class="btn btn-back_prev error-btn">Вернуться на главную</a>
        </div>
    </div>
@endsection