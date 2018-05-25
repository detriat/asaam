var video    = document.getElementById('video'),
    canvas   = document.getElementById('canvas'),
    context  = canvas.getContext('2d');

var center_x = $('#container').width() / 2;
var center_y = $('#container').height() / 2;


/*for Iphone*/
video.style.width = '640px';
video.style.height = '640px';
video.setAttribute('autoplay', '');
video.setAttribute('muted', '');
video.setAttribute('playsinline', '');

function init() {

    //startTracking();
    var constraints = { video: true, audio: false, facingMode: 'user' };
    navigator.mediaDevices.getUserMedia( constraints ).then( function( stream ) {

        video.srcObject = stream;
        video.onloadedmetadata = function () {
            video.play();
            playGif();
            draw(this, context, 640, 640);
        };

    } ).catch( function( error ) {

        console.error( 'Unable to access the camera/webcam.', error );
        showWarningNotice('Мы не получили доступ к вашей камере!');

    } );

}

function draw(video, context, width, height) {
    context.drawImage(video, 0, 0, width, height);
    setTimeout(draw, 10, video, context, width, height);
}

function startTracking() {
    var tracker = new tracking.ObjectTracker('face');
    tracker.setInitialScale(4);
    tracker.setStepSize(2);
    tracker.setEdgesDensity(0.1);
    tracker.setScaleFactor(1.1);

    tracking.track('#video', tracker, {camera: true});

    setTimeout(function(){
        video.play();
        resizeVideo();
        playGif();
    }, 1000);

    tracker.on('track', function (event) {

        //$('.elefant').hide();
        event.data.forEach(function (rect) {

            $('#elefant')
                .css('left', rect.x);

            var square_center_x = rect.x + rect.width / 2;
            var square_center_y = rect.y + rect.height / 2;

            var lucky_square = (square_center_x > center_x - 50)
                && (square_center_x < center_x + 50)
                && (square_center_y > center_y - 50)
                && (square_center_y < center_y + 50);

            if (lucky_square) {
                //console.log('Время для фото');
            } else if (square_center_x < center_x && square_center_y < center_y) {
                //console.log('Левый верхний угол');
                //$('#elefant').css('right', '-200px');

            } else if (square_center_x > center_x && square_center_y < center_y) {
                //console.log('Правый верхний угол');
                //$('#elefant').css('left', '-200px');
            } else if (square_center_x < center_x && square_center_y > center_y) {
                //console.log('Левый нижний угол')
               // $('#elefant').css('right', '-200px');

            } else if (square_center_x > center_x && square_center_y > center_y) {
                //$('#elefant').css('left', '-200px');
            }

        });
    });
}

function clearResults() {
    var modal = $('#confirmAction');

    modal.find('.confirmation-confirm').attr('data-action', 'confirm-action');
    modal.displayFlex();
}

function take_snapshot() {
    // take snapshot and get image data

    playShot();
    $('.preload').displayFlex();
    var img = canvas.toDataURL('image/jpeg', 1.0);

    $('#results')
        .empty()
        .append('<img class="position-model" src="'+img+'">');

    html2canvas(document.querySelector("#e_screen"), {
        backgroundColor: null
    }).then(function(canvas){

    var canvas_img = canvas.toDataURL('image/png', 1.0);
    $('#results')
        .append('<img class="position-canvas__img" src="'+canvas_img+'">');

    takeFinalPhoto();
    });

    $('.snapshot-btn').hide();
    $('.snapshot-form').displayFlex();

}

function takeFinalPhoto() {
    html2canvas(document.querySelector("#results")).then(function(canvas){

        var canvas_img = canvas.toDataURL('image/jpeg', 1.0);
        $('#results')
            .empty()
            .append('<img src="'+canvas_img+'">');

        $('.preload').hide();
    });
}

function playShot() {
    var audio = new Audio('/media/shutter.mp3');
    audio.play();
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
    $('#elefant').attr('src', canvas_frame.toDataURL());
}

function playGif() {

    var frame_rgb, frame_a, frame;
    var img = $('#elefant');
    var f = 0;
    var fps = 24;
    var length = $('#animations img').length - 2;

    setInterval(function () {

        if (f < length){
            f++;
        }else{
            f = 0;
        }

        frame = $('.frame'+f).attr('src');
        img.attr('src', frame);

        /*frame_rgb = $('#animations .frame'+f).attr('src');
        frame_a = $('#animations_a .frame'+f).attr('src');

        loadRGBA(frame_rgb, frame_a);*/

    }, 1000 / fps);
}



