
var container, stats, clock, controls;
var camera, scene, renderer, mixer;

var center_x = $('#container').width() / 2;
var center_y = $('#container').height() / 2;

$(window).resize(function () {
    center_x = $('#container').width() / 2;
    center_y = $('#container').height() / 2;
});

function init() {

    var video = document.getElementById( 'video' );
    var tracker = new tracking.ObjectTracker('face');
    tracker.setInitialScale(4);
    tracker.setStepSize(2);
    tracker.setEdgesDensity(0.1);
    tracker.setScaleFactor(1.1);

    tracking.track('#video', tracker, { camera: true });
    tracker.on('track', function(event) {

        $('.elefant').hide();
        event.data.forEach(function(rect) {
            $('.elefant')
                .css('display', 'block')
                .css('left', rect.x)
                .css('top', rect.y)
                .css('width', rect.width)
                .css('height', rect.height);

            var square_center_x = rect.x + rect.width / 2;
            var square_center_y = rect.y + rect.height / 2;

            var lucky_square =   (square_center_x > center_x - 50)
                &&(square_center_x < center_x + 50)
                &&(square_center_y > center_y - 50)
                &&(square_center_y < center_y + 50);

            if ( lucky_square ){
                console.log('Время для фото');
            }else if ( square_center_x < center_x && square_center_y < center_y  ){
                console.log('Левый верхний угол');
            }else if ( square_center_x > center_x && square_center_y < center_y ){
                console.log('Правый верхний угол');
            }else if ( square_center_x < center_x && square_center_y > center_y ){
                console.log('Левый нижний угол')
            }else if ( square_center_x > center_x && square_center_y > center_y ){
                console.log('Правый нижний угол');
            }
        });
    });

    container = document.getElementById( 'container' );

    camera = new THREE.PerspectiveCamera( 25, window.innerWidth / window.innerHeight, 1, 10000 );
    camera.position.set( 15, 10, - 15 );

    scene = new THREE.Scene();

    var vidTexture = new THREE.VideoTexture(video);
    vidTexture.minFilter = THREE.LinearFilter;
    scene.background = vidTexture;

    clock = new THREE.Clock();

    // collada

    var loader = new THREE.ColladaLoader();
    loader.load( 'model/stormtrooper.dae', function ( collada ) {
        var animations = collada.animations;

        var avatar = collada.scene;
        mixer = new THREE.AnimationMixer( avatar );
        var action = mixer.clipAction( animations[ 0 ] ).play();

        scene.add( avatar );
    } );

    var ambientLight = new THREE.AmbientLight( 0xffffff, 0.2 );
    scene.add( ambientLight );

    var directionalLight = new THREE.DirectionalLight( 0xffffff, 0.8 );
    directionalLight.position.set( 1, 1, - 1 );
    scene.add( directionalLight );

    //

    renderer = new THREE.WebGLRenderer({
        antialias: true,
        transparent: true,
        alpha: true,
        preserveDrawingBuffer: true
    });
    renderer.setPixelRatio( window.devicePixelRatio );
    renderer.setSize( $('#container').width(), $('#container').height() );
    renderer.setClearColor(0x000000, 0);
    container.appendChild( renderer.domElement );

    //

    controls = new THREE.OrbitControls( camera, renderer.domElement );
    controls.target.set( 0, 2, 0 );
    controls.update();

    //

    stats = new Stats();
    container.appendChild( stats.dom );

    //

    window.addEventListener( 'resize', onWindowResize, false );

}

function onWindowResize() {

    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();

    renderer.setSize( window.innerWidth, window.innerHeight );

}

function animate() {

    requestAnimationFrame( animate );

    render();
    stats.update();

}

function render() {

    var delta = clock.getDelta();

    if ( mixer !== undefined ) {

        mixer.update( delta );

    }

    renderer.render( scene, camera );
}
