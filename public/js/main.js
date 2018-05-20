var video = document.getElementById('video');

function init() {

    Webcam.attach( '#video' );

    var constraints = { video: true };
    navigator.mediaDevices.getUserMedia( constraints ).then( function( stream ) {

        video.srcObject = stream;
        video.onloadedmetadata = function (e) {
            video.play();
            resizeVideo();
            playGif('e');
        };

    } ).catch( function( error ) {

        console.error( 'Unable to access the camera/webcam.', error );
        showWarningNotice('Мы не получили доступ к вашей камере!');

    } );

}

function startTracking() {
    var tracker = new tracking.ObjectTracker('face');
    tracker.setInitialScale(4);
    tracker.setStepSize(2);
    tracker.setEdgesDensity(0.1);
    tracker.setScaleFactor(1.1);

    tracking.track('#video', tracker, {camera: true});

    setTimeout(function(){
        resizeVideo();
        playGif();
    }, 1000);

    tracker.on('track', function (event) {

        $('.elefant').hide();
        event.data.forEach(function (rect) {
            $('.elefant')
                .css('display', 'block')
                .css('left', rect.x)
                .css('top', rect.y)
                .css('width', rect.width)
                .css('height', rect.height);

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

            } else if (square_center_x > center_x && square_center_y < center_y) {
                //console.log('Правый верхний угол');

            } else if (square_center_x < center_x && square_center_y > center_y) {
                //console.log('Левый нижний угол')

            } else if (square_center_x > center_x && square_center_y > center_y) {

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

    Webcam.snap(function (img) {
        $('#results')
            .empty()
            .append('<img class="position-model" src="'+img+'">');

        playShot();
    });



    $('.snapshot-btn').hide();
    $('.snapshot-form').displayFlex();

}

function playShot() {
    var audio = new Audio('/media/shutter.mp3');
    audio.play();
}

function playGif(name) {
    $('.gif-position')
        .empty()
        .append('<img src="/img/'+name+'.gif" alt="">');
}

function resizeVideo(){
    var video = $('#video');
    var canvas = $('#canvas');
    var container = $('#container');

    container.css('height', video.height() + 'px');
    canvas.css('height', video.height() + 'px');
}