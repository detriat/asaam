var video    = document.getElementById('video'),
    canvas   = document.getElementById('canvas'),
    context  = canvas.getContext('2d');

var center_x = $('#container').width() / 2;
var center_y = $('#container').height() / 2;



video.style.width = '640px';
video.style.height = '480px';
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
            draw(this, context, 640, 480);
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
    });
}

function playShot() {
    var audio = new Audio('/media/shutter.mp3');
    audio.play();
}

function playGif() {

    var frame;
    var img = $('#elefant');
    var i = 1;
    var fps = 24;

    img.css('visibility', 'visible');

    setInterval(function () {

        if (i < 187){
            i++;
        }else{
            i = 1;
        }

        frame = $('.frame'+i).attr('src');
        img.attr('src', frame);

    }, 1000 / fps);

}

