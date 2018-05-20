var container, stats, clock, controls;
var camera, scene, renderer, mixer;

var raycaster = new THREE.Raycaster();
var points = new THREE.Vector2();

var center_x = $('#container').width() / 2;
var center_y = $('#container').height() / 2;

var elefant_geometry, elefant_material, elefant, elefant_texture, loader_model;

var test = {
    positionX: 0,
    positionY: 0,
    positionZ: 0,
    rotationX: 0,
    rotationY: 0,
    rotationZ: 0,
    cameraX: 0,
    cameraY: 0,
    cameraZ: 0
};

function init() {

    var video = document.getElementById( 'video' );
    navigator.getUserMedia({ audio: true, video: { width: 640, height: 480 } },
        function(stream) {
            video.srcObject = stream;
            video.onloadedmetadata = function(e) {
                video.play();
            };
        },
        function(err) {
            console.log("The following error occurred: " + err.name);
        }
    );
    /*var tracker = new tracking.ObjectTracker('face');
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
                //console.log('Время для фото');
            }else if ( square_center_x < center_x && square_center_y < center_y  ){
                //console.log('Левый верхний угол');
                movementModel(540, 480);
            }else if ( square_center_x > center_x && square_center_y < center_y ){
                //console.log('Правый верхний угол');
                movementModel(100, 480);
            }else if ( square_center_x < center_x && square_center_y > center_y ){
                //console.log('Левый нижний угол')
                movementModel(540, 480);
            }else if ( square_center_x > center_x && square_center_y > center_y ){
                movementModel(100, 480);
            }

        });
    });*/

    container = document.getElementById( 'container' );

    camera = new THREE.PerspectiveCamera( 25, window.innerWidth / window.innerHeight, 1, 1000 );
    camera.position.z = -15;
    scene = new THREE.Scene();

    var vidTexture = new THREE.VideoTexture(video);
    vidTexture.minFilter = THREE.LinearFilter;
    scene.background = vidTexture;

    clock = new THREE.Clock();

    //Create Object Elefant
    elefant_texture  = new THREE.Texture();
    loader_model     = new THREE.ImageLoader();

    loader_model.load('model/texture.jpg', function(image){
        elefant_texture.image       = image;
        elefant_texture.needsUpdate = true;
    });

    elefant_material = new THREE.MeshBasicMaterial({
        map: elefant_texture,
        overdraw: true
    });

    // collada

    var loader = new THREE.ColladaLoader();
    /*loader.load('model/EL.DAE', function (collada) {
        console.log(collada);
        elefant = collada.scene;
        elefant.traverse(function (child) {
            if (child instanceof THREE.Mesh) {
                child.material = elefant_material;
            }
        });

        movementModel(100, 480);

        scene.add(elefant);
    });*/
    loader.load( 'model/stormtrooper.dae', function ( collada ) {


        var animations = collada.animations;
        elefant = collada.scene;

        mixer = new THREE.AnimationMixer( elefant );
        var action = mixer.clipAction( animations[ 0 ] ).play();

        movementModel(100, 480);

        scene.add( elefant );
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
    renderer.setSize( $('#container').width(), $('#container').height(), false );
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



    /*var gui = new dat.GUI();

    gui.add(test, 'positionX').min(-10).max(10).step(0.1);
    gui.add(test, 'positionY').min(-100).max(100).step(0.1);
    gui.add(test, 'positionZ').min(-10).max(10).step(0.1);

    gui.add(test, 'rotationX').min(-1).max(1).step(0.1);
    gui.add(test, 'rotationY').min(-1).max(1).step(0.1);
    gui.add(test, 'rotationZ').min(-1).max(1).step(0.1);*/

}

function onWindowResize() {

    center_x = $('#container').width() / 2;
    center_y = $('#container').height() / 2;

    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();

    renderer.setSize( window.innerWidth, window.innerHeight );

}

function animate() {
    requestAnimationFrame( animate );

    /*if (elefant){
        elefant.position.x = test.positionX;
        elefant.position.y = test.positionY;
        elefant.position.z = test.positionZ;

        elefant.rotation.x = test.rotationX;
        elefant.rotation.y = test.rotationY;
        elefant.rotation.z = test.rotationZ;
    }*/

    render();
    stats.update();
}

function convertPoints( x, y ) {
    points.x = ( x / $('#container').width() ) * 2 - 1;
    points.y = - ( y / $('#container').height() ) * 2 + 1;

    console.log(points);
}

function movementModel(x, y) {
    if (elefant){
        convertPoints(x, y);
        var plane = new THREE.Plane().setFromNormalAndCoplanarPoint(new THREE.Vector3(0, 0, 1), scene.position); // будем искать пересечение луча с этой плоскостью
        raycaster.setFromCamera(points, camera);
        var pointOfIntersection = new THREE.Vector3();
        raycaster.ray.intersectPlane(plane, pointOfIntersection);
        elefant.position.copy(pointOfIntersection);
    }
}

function render() {

    var delta = clock.getDelta();

    if ( mixer !== undefined ) {

        mixer.update( delta );

    }
    renderer.render( scene, camera );
}
