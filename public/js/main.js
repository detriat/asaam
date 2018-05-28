var video    = document.getElementById('video');

var container_width = $('#container').width();
var container_height = $('#container').height();
var center_x = container_width / 2;
var center_y = container_height / 2;

var video_w = 640,
    video_h = 640;

var distance = {
    small: 300,
    normal: 250,
    big: 180
};

var buffer = [];

/*for Iphone*/
video.style.width = video_w+'px';
video.style.height = video_h+'px';
video.setAttribute('autoplay', '');
video.setAttribute('muted', '');
video.setAttribute('playsinline', '');

//запуска приложения
function init() {

    /*startTracking();*/
    var constraints = { video: true, audio: false, facingMode: 'user' };
    navigator.mediaDevices.getUserMedia( constraints ).then( function( stream ) {

        video.srcObject = stream;
        video.onloadedmetadata = function () {
            video.play();
        };

    } ).catch( function( error ) {

        console.error( 'Unable to access the camera/webcam.', error );
        showWarningNotice('Мы не получили доступ к вашей камере!');

    } );

}

//рисование на канвасе
function draw(video, context, width, height) {
    context.drawImage(video, 0, 0, width, height);
    setTimeout(draw, 10, video, context, width, height);
}

//возвращает url снимка текущего кадра видео
function getImageURL() {
    var c = document.createElement("canvas");
    var ctx = c.getContext("2d");
    c.width = video_w;
    c.height = video_h;
    ctx.drawImage(video, 0, 0, c.width, c.height);

    return c.toDataURL('image/jpeg', 1.0);
}

//включает трекинг лица
function startTracking() {

    var tracker = new tracking.ObjectTracker('face');
    tracker.setInitialScale(4);
    tracker.setStepSize(2);
    tracker.setEdgesDensity(0.15);
    tracker.setScaleFactor(1.1);

    tracking.track('#video', tracker, {camera: true});



    tracker.on('track', function (event) {

        event.data.forEach(function (rect) {

            var square_center_x = rect.x + rect.width / 2;
            var square_center_y = rect.y + rect.height / 2;

            scaleAndPositionElefant(rect.width);

            /*var lucky_square = (square_center_x > center_x - 50)
                && (square_center_x < center_x + 50)
                && (square_center_y > center_y - 50)
                && (square_center_y < center_y + 50);*/
            /*if (lucky_square) {
                //console.log('Время для фото');
            } else if (square_center_x < center_x && square_center_y < center_y) {
                //console.log('Левый верхний угол');
                $('#elefant').css('right', 0);

            } else if (square_center_x > center_x && square_center_y < center_y) {
                //console.log('Правый верхний угол');
                $('#elefant').css('right', '200px');
            } else if (square_center_x < center_x && square_center_y > center_y) {
                //console.log('Левый нижний угол')
                $('#elefant').css('right', 0);

            } else if (square_center_x > center_x && square_center_y > center_y) {
                $('#elefant').css('right', '200px');
            }*/

        });
    });
}


function scaleAndPositionElefant(size){
    var scale = 1;

    //Учитываем +- 5% от нормального расстояния.
    // Если больше или меньше 5 то делаем scale
    if ( size < distance.normal*95/100 || size > distance.normal*105/100 ){
        scale = (size * 100 / 250).toFixed(0);
        scale /= 100;
    }
console.log(scale);
    $('#elefant').css('transform', 'scale('+scale+')');
};

function clearResults() {
    var modal = $('#confirmAction');

    modal.find('.confirmation-confirm').attr('data-action', 'confirm-action');
    modal.displayFlex();
}

//делает снимок
function take_snapshot() {

    playShot();

    $('.preloader').show();

    var img = getImageURL();

    $('#results')
        .empty()
        .append('<img class="position-model" src="'+img+'">');

    html2canvas(document.querySelector("#e_screen"), {
        backgroundColor: null
    })
    .then(function(canvas){

        var canvas_img = canvas.toDataURL('image/png', 1.0);
        $('#results')
            .append('<img class="position-canvas__img" src="'+canvas_img+'">');

        //$('.preloader').hide();
        takeFinalPhoto();
    });

    $('.buttons .step-1').hide();
    $('.buttons .step-2').show();

}

//делает финальное изображение
function takeFinalPhoto() {
    html2canvas(document.querySelector("#results")).then(function(canvas){

        var canvas_img = canvas.toDataURL('image/jpeg', 1.0);
        $('#results')
            .empty()
            .append('<img src="'+canvas_img+'">');

        $('.preloader').hide();
    });
}


//запускает звук камеры
function playShot() {
    var audio = new Audio('/media/shutter.mp3');
    audio.play();
}


//магия
function compileRGBA(raw_rgb, raw_alpha){

    if (!raw_rgb.width || !raw_rgb.height || !raw_alpha.width || !raw_alpha.height){
        return;
    }

    if (raw_rgb.width !== raw_alpha.width || raw_rgb.height !== raw_alpha.height){
        alert('Размеры RGB и прозрачности не сходятся')
        return;
    }

    var canvas_rgb = document.createElement("canvas");
    var canvas_alpha = document.createElement("canvas");
    var canvas_frame = document.createElement("canvas");

    var context_rgb = canvas_rgb.getContext('2d');
    var context_alpha = canvas_alpha.getContext('2d');
    var context_frame = canvas_frame.getContext('2d');

    if (  !canvas_rgb   || !context_rgb
        || !canvas_alpha || !context_alpha
        || !canvas_frame || !context_frame  ){
        alert('Та-а-а-а-а, насяльника... та-а-а-а, канва, насяльника');
        return;
    }

    canvas_rgb.width    = raw_rgb.width;
    canvas_rgb.height   = raw_rgb.height;
    canvas_alpha.width  = raw_alpha.width;
    canvas_alpha.height = raw_alpha.height;
    canvas_frame.width  = 640;
    canvas_frame.height = 640;

    context_rgb.drawImage(raw_rgb, 0, 0);
    context_alpha.drawImage(raw_alpha, 0, 0);

    var pix_rgb = context_rgb.getImageData(0, 0, raw_rgb.width, raw_rgb.height);
    var pix_alpha = context_alpha.getImageData(0, 0, raw_alpha.width, raw_alpha.height);

    for (var i = 3, n = pix_rgb.width * pix_rgb.height * 4; i < n; i += 4){
        pix_rgb.data[i] = pix_alpha.data[i-3];
    }

    context_rgb.putImageData(pix_rgb, 0, 0);


    var frame = context_rgb.getImageData(0, 0, canvas_rgb.width, canvas_rgb.height);

    delete pix_rgb;
    delete pix_alpha;
    delete context_rgb;
    delete canvas_rgb;
    delete context_alpha;
    delete canvas_alpha;

    context_frame.putImageData(frame, 0, 0);
    var base64_string = canvas_frame.toDataURL();
    /*$('#elefant').attr('src', canvas_frame.toDataURL());*/
    buffer.push(base64_string);
}
function loadRGBA(url_rgb, url_alpha){

    var img_rgb = new Image(),
        img_alpha = new Image(),
        img_count = 0;

    img_rgb.src = url_rgb;
    img_alpha.src = url_alpha;

    img_rgb.onload = function(){
        ++img_count;
        if(img_count === 2){
            compileRGBA(img_rgb, img_alpha);
        }
    };

    img_alpha.onload = function(){
        ++img_count;
        if(img_count === 2){
            compileRGBA(img_rgb, img_alpha);
        }
    };
}

function playAnimation(animations){

    var img = $('#elefant');
    var i = 0;
    var fps = 24;

    setInterval(function () {
        if (i < animations.length){
            img.attr('src', animations[i]['url']);
            i++
        }else{
            i = 0;
        }
    }, 1000/24);

}

//Начинает анимировать слона
function createAnimationBuffer() {

    var frame_rgb, frame_a, frame;
    var img = $('#elefant');
    var f = 0;
    var fps = 24;
    var length = $('#animations img').length - 2;

    var frameId = setInterval(function () {

        if (f < length){
            frame_rgb = $('#animations .frame'+f).attr('src');
            frame_a = $('#animations_a .frame'+f).attr('src');
            loadRGBA(frame_rgb, frame_a);
            f++;
        }else{
            playAnimation();
            clearInterval(frameId);
        }
    }, 1000 / fps);
}







