@extends('layouts.master')

@section('title', $title)

@section('content')

    <div class="main work_zone">
        <div class="container">
            <div class="row">
                <div class="col-md-9 pull-xs-none">
                    <div id="container">
                        <div class="tracking">
                            <video id="video" width="320" height="240" autoplay loop preload crossOrigin="anonymous" webkit-playsinline></video>
                            <canvas id="canvas" width="640" height="480"></canvas>
                        </div>
                        <div class="elefant" id="e_screen">
                            <img src="#" alt="" id="elefant" class="rotate {{(isset($isSecond)) ? 'ht100' : ''}}">
                            <div class="game-objects">
                                <img src="/img/pixel.png" alt="swag" class="swag">
                            </div>
                        </div>
                        <div id="results"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="buttons">
        <div class="step-1">
            <button class="btn btn-1 snapshot-btn" onclick="take_snapshot()">Сделать снимок</button>
            <button class="btn btn-2 snapshot-btn">Что еще умеет слон?</button>
        </div>
        <div class="step-2 snapshot-form">
            <button class="btn btn-1 continue-stream" onclick="clearResults()">Сделать ещё раз</button>
            <a href="#" class="btn btn-2" id="uploadBase64Image">Далее</a>
        </div>
    </div>
    <div class="pr pr-left"></div>
    <div class="pr pr-right"></div>

    @if (isset($isSecond))
        @include('sequences.second')
    @else
        @include('sequences.elefant')
    @endif
@endsection

@section('overlay')
    <div class="overlay" id="startStream">
        <div class="window">
            <div class="window-confirm">
                <div class="confirm-title">Подключить web-камеру устройства?</div>
                <div class="buttons confirm-btns">
                    <a href="#startStream" class="btn btn-1 confirm-btn confirmation-confirm"
                       data-action="start-stream">Да</a>
                    <a href="#startStream" class="btn btn-1 confirm-btn cancel-confirm">Нет</a>
                </div>
            </div>
        </div>
    </div>

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

    <div class="overlay" id="confirmAction">
        <div class="window">
            <div class="window-confirm">
                <div class="confirm-title">Вы уверены?</div>
                <div class="buttons confirm-btns">
                    <a href="#confirmAction" class="btn btn-1 confirm-btn confirmation-confirm"
                       data-action="confirm-action">Да</a>
                    <a href="#confirmAction" class="btn btn-1 confirm-btn cancel-confirm">Нет</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="/libs/html2canvas/html2canvas.min.js"></script>
    <script src="/libs/tracking/tracking-min.js"></script>
    <script src="/libs/tracking/face-min.js"></script>
    @if (isset($isSecond))
        <script src="/js/second.js"></script>
    @else
        <script src="/js/main.js"></script>
    @endif
    <script>
        $(document).ready(function () {
            $('#uploadBase64Image').click(function (e) {
                e.preventDefault();
                e.stopPropagation();

                const $this = $(this);
                const href = $this.attr('href');
                const base64Image = $('#results').find('img').attr('src');

                $.post('{{action('ImageEditor@uploadBase64Image')}}', {
                    base64Image: base64Image
                }, function (res) {

                    if (res['redirect']) {
                        window.location = res['redirect'];
                    }

                    if (res['error']) {
                        showWarningNotice(res['error']);
                    }

                });
            });
        });
    </script>
@endsection