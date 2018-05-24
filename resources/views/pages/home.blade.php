@extends('layouts.master')

@section('title', $title)

@section('content')
    <div class="work_zone bottom-box-effect">
        <div id="container">
            <div class="tracking">
                <video id="video" autoplay muted crossOrigin="anonymous" webkit-playsinline style="visibility:visible;"></video>
            </div>
            <div class="gif-position"></div>
            <div class="elefant" id="e_screen"><img src="/img/elefant/1.png" alt="" id="elefant"></div>
            <div id="results"></div>
        </div>
        <div class="btn snapshot-btn" onclick="take_snapshot()">Сделать снимок</div>
        <div class="snapshot-form">
            <div class="btn continue-stream" onclick="clearResults()">Сделать ещё раз</div>
            <a href="#" class="btn" id="uploadBase64Image">Далее</a>
        </div>
    </div>

    @include('sequences.elefant')
@endsection

@section('overlay')
    <div class="overlay" id="startStream">
        <div class="window-confirm">
            <div class="confirm-title">Подключить web-камеру устройства?</div>
            <div class="confirm-btns">
                <a href="#startStream" class="btn confirm-btn confirmation-confirm" data-action="start-stream">Да</a>
                <a href="#startStream" class="btn confirm-btn cancel-confirm">Нет</a>
            </div>
        </div>
    </div>

    <div class="overlay" id="warningNotice">
        <div class="window-confirm">
            <div class="confirm-title"></div>
            <div class="confirm-btns">
                <a href="#warningNotice" class="btn confirm-btn confirmation-confirm" data-action="read-notice">Хорошо</a>
            </div>
        </div>
    </div>

    <div class="overlay" id="confirmAction">
        <div class="window-confirm">
            <div class="confirm-title">Вы уверены?</div>
            <div class="confirm-btns">
                <a href="#confirmAction" class="btn confirm-btn confirmation-confirm" data-action="confirm-action">Да</a>
                <a href="#confirmAction" class="btn confirm-btn cancel-confirm">Нет</a>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="/libs/html2canvas/html2canvas.min.js"></script>
    <script src="/js/webcam.min.js"></script>
    <script src="/js/main.js"></script>
    <script>
        $(document).ready(function () {
            $('#uploadBase64Image').click(function (e) {
                e.preventDefault();
                e.stopPropagation();

                var $this = $(this);
                var href  = $this.attr('href');
                var base64Image = $('#results').find('img').attr('src');

                $.post('{{action('ImageEditor@uploadBase64Image')}}', {
                    base64Image: base64Image
                }, function (res) {

                    if (res['redirect']){
                        window.location = res['redirect'];
                    }

                    if (res['error']){
                        showWarningNotice(res['error']);
                    }

                });
            });


            $(window).resize(function () {
                resizeVideo();
            });
        });

    </script>
@endsection