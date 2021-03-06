const $video = $('#video');
const $elefant = $('#elefant');
const $confetti = $('#confetti');
const audio = new Audio('/media/shutter.mp3');
const $results = $('#results');
const $preloader = $('.preloader');

const $confirmAction = $('#confirmAction');
const $e_screen = $("#e_screen")[0];
const $step1 = $('.buttons .step-1');
const $step2 = $('.buttons .step-2');

const $canvas = $('#canvas');
const $context = $canvas[0].getContext('2d');

let x = 2; //множитель для трекинга

let video_w = 320;
let video_h = 240;

if ($(window).width() <= 768){

    video_h = video_w * 4 / 3;

    $canvas.attr({
        width: video_w,
        height: video_h
    });
    x = 1;
}

$video.attr({
    width: video_w,
    height: video_h,
    autoplay: true,
    muted: true,
    preload: true
});

const distance = {
    small: 300,
    normal: 250,
    big: 180
};

 // 0 - кадр анимации с которого начнёться игра. 1 кадр на котором закончится
//  где 0, 1 это индексы массива
const animation_areas = {
    top: [0, 72],
    center: [72, 144],
    bottom: [144, 216]
};

const fps = 24;
let count_frameId;
let count_frame = 0;
let trackerTask;
let buffer = [];

function init() {
    const constraints = {
        video: true,
        audio: false,
        facingMode: 'user'
    };


    $video.on('loadedmetadata', function(){
        $video[0].play();
        $elefant.attr('src', buffer[0]);

        if ($(window).width() > 768){
            drawVideoToCanvas();
        }

        startTracking();
    });

    navigator.mediaDevices.getUserMedia(constraints)
        .then(function (stream){
            $video[0].srcObject = stream;
        })
        .catch(function (error){
            console.error('Unable to access the camera/webcam.', error);
            showWarningNotice('Мы не получили доступ к вашей камере! Возможно Вам следует обновить Ваш браузер новой версии.');
        });
}

//возвращает url снимка текущего кадра видео
const c = document.createElement("canvas");
const ctx = c.getContext("2d");

function getImageURL() {
    c.width = video_w;
    c.height = video_h;
    ctx.drawImage(video, 0, 0, c.width, c.height);

    return c.toDataURL('image/jpeg', 1.0);
}

const $face_square = $('.face-square');
let square_center_x, square_center_y, stopped = 0, trackerTask_status = true, loopTimer;
//включает трекинг лица
function startTracking() {

    const tracker = new tracking.ObjectTracker('face');
    tracker.setInitialScale(4);
    tracker.setStepSize(2);
    tracker.setEdgesDensity(0.1);

    let rect, top, bottom, center, temp_segment;

    const segment = $video.height() / 3;

    trackerTask = tracking.track('#video', tracker);

    tracker.on('track', (event) => {
        if (event.data.length && trackerTask_status) {

            trackerTask_status = false;

            rect = event.data[0];
            setTimeout(() => {
                trackerTask.stop();
            }, 0);

            setTimeout(() => {

                rect = event.data[0];


                square_center_x = rect.x + rect.width / 2;
                square_center_y = rect.y + rect.height / 2;

                top     = square_center_y < segment;
                center  = (square_center_y > segment) && (square_center_y < segment * 2);
                bottom  = square_center_y > segment * 2;


                if (top){

                    if (temp_segment === 'top'){

                        loopAnimation();

                    }else{
                        playAnimation(animation_areas.top)
                    }

                    temp_segment = 'top';
                }
                if (center){

                    if (temp_segment === 'center'){

                        loopAnimation();

                    }else{
                        playAnimation(animation_areas.center)
                    }

                    temp_segment = 'center';

                }
                if (bottom){

                    if (temp_segment === 'bottom'){

                        loopAnimation();

                    }else{
                        playAnimation(animation_areas.bottom)
                    }

                    temp_segment = 'bottom';
                }

            }, 100);
        }
    });
}

function playAnimation(areas) {

    let check_confetti = false;
    const size_monitor = $(window).width();
    count_frame = areas[0];
    count_frameId = setInterval(() => {
        if (count_frame < areas[1] - 24) {

            if (count_frame === 105 && !check_confetti){
                check_confetti = true;

                if (size_monitor <= 768){
                    $confetti.show();
                }
            }

            if (check_confetti && count_frame + 112 < buffer.length){
                $confetti.attr('src', buffer[count_frame + 112])
            }

            $elefant.attr('src', buffer[count_frame]);
            count_frame++;
        } else {
            $confetti.hide();
            count_frameId = clearInterval(count_frameId);
            trackerTask_status = true;
            trackerTask.run();
        }
    }, 1000 / fps);

}

function loopAnimation() {

    const current_frame = count_frame;
    let loop_status = false;

    console.log(current_frame);

     loopTimer = setInterval(() => {

        if (count_frame > current_frame - 12 && !loop_status){
            $elefant.attr('src', buffer[--count_frame]);
        }else{
            loop_status = true;
            $elefant.attr('src', buffer[++count_frame]);
            if (count_frame === current_frame){
                clearInterval(loopTimer);
                trackerTask_status = true;
                trackerTask.run();
            }
        }


     }, 1000 / fps);

}


function draw(video, context, width, height) {
    context.clearRect(0, 0, width, height);
    context.drawImage(video, 0, 0, width, height);
}

function drawVideoToCanvas() {
    setInterval(() => {
        draw($video[0], $context, $canvas.width(), $canvas.height());
    }, 0);
}

function clearResults() {

    $confirmAction
        .find('.confirmation-confirm')
        .attr('data-action', 'confirm-action');
    $confirmAction.show();
}

//делает снимок
function take_snapshot() {

    $preloader.show();
    playShot();
    let img = getImageURL();

    $results
        .empty()
        .append('<img class="position-model" src="' + img + '">');

    html2canvas($e_screen, {
        backgroundColor: null
    })
        .then(function (canvas) {

            let canvas_img = canvas.toDataURL('image/png', 1.0);
            $results
                .append('<img class="position-canvas__img" src="' + canvas_img + '">');

            takeFinalPhoto();
            $step1.hide();
            $step2.show();
            $preloader.hide();
        });
}

//делает финальное изображение
function takeFinalPhoto() {
    html2canvas($results[0]).then(function (canvas) {

        let canvas_img = canvas.toDataURL('image/jpeg', 1.0);
        $results
            .empty()
            .append('<img src="' + canvas_img + '">');

        $preloader.hide();
    });
}

//запускает звук камеры
function playShot() {
    audio.play();
}


//магия
const canvas_rgb = document.createElement("canvas");
const canvas_alpha = document.createElement("canvas");
const canvas_frame = document.createElement("canvas");

const context_rgb = canvas_rgb.getContext('2d');
const context_alpha = canvas_alpha.getContext('2d');
const context_frame = canvas_frame.getContext('2d');

canvas_rgb.width = video_w * x;
canvas_rgb.height = video_h * x;
canvas_alpha.width = video_w * x;
canvas_alpha.height = video_h * x;
canvas_frame.width = video_w * x;
canvas_frame.height = video_h * x;

function compileRGBA(raw_rgb, raw_alpha) {

    if (!canvas_rgb || !context_rgb || !canvas_alpha || !context_alpha || !canvas_frame || !context_frame) {
        console.warn('Не найден контекст консоли');
        return;
    }

    context_rgb.drawImage(raw_rgb, 0, 0);
    context_alpha.drawImage(raw_alpha, 0, 0);

    let pix_rgb = context_rgb.getImageData(0, 0, raw_rgb.width, raw_rgb.height);
    let pix_alpha = context_alpha.getImageData(0, 0, raw_alpha.width, raw_alpha.height);

    for (let i = 3, n = pix_rgb.width * pix_rgb.height * 4; i < n; i += 4) {
        pix_rgb.data[i] = pix_alpha.data[i - 3];
    }

    context_rgb.putImageData(pix_rgb, 0, 0);

    const frame = context_rgb.getImageData(0, 0, canvas_rgb.width, canvas_rgb.height);

    context_frame.putImageData(frame, 0, 0);
    const base64_string = canvas_frame.toDataURL();
    buffer.push(base64_string);
}
function loadRGBA(url_rgb, url_alpha) {

    const img_rgb = new Image(),
        img_alpha = new Image();

    let img_count = 0;

    img_rgb.src = url_rgb;
    img_alpha.src = url_alpha;

    img_rgb.onload = function () {
        ++img_count;
        if (img_count === 2) {
            compileRGBA(img_rgb, img_alpha);
        }
    };

    img_alpha.onload = function () {
        ++img_count;
        if (img_count === 2) {
            compileRGBA(img_rgb, img_alpha);
        }
    };
}

function createAnimationBuffer() {
    let frame_rgb, frame_a;
    let f = 0;

    let $animationFrames = $('#animations img');
    let $animationAlphaFrames = $('#animations_a img');

    const timerId = setInterval(() => {
        if ($animationFrames.length == 0 && $animationAlphaFrames.length == 0){
            $animationFrames = $('#animations img');
            $animationAlphaFrames = $('#animations_a img');
        }else{
            clearInterval(timerId);

            const frameId = setInterval(() => {
                if (f < $animationFrames.length) {
                    frame_rgb = $animationFrames.eq(f).attr('src');
                    frame_a = $animationAlphaFrames.eq(f).attr('src');

                    loadRGBA(frame_rgb, frame_a);
                    f++;
                } else {
                    $('.preloader').hide();
                    $('.page-content').fadeIn();
                    clearInterval(frameId);
                }
            }, 1000 / fps);

        }
    }, 10);
}

