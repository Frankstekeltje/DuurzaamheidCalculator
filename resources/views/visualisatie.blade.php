@extends('layout')

@section('head')
    <meta charset="utf-8">
    <title>Duurzaamheid Calculator</title>
    <style>
            body {margin: 0;}
            canvas {display: block;}
    </style>
@endsection

@section('body')
    <script src="/js/three.js"></script>
@endsection

@section('script')

    var scene, renderer;
    var windowWidth, windowHeight;
    var mouseX = 0, mouseY = 0;

    var views = [
        {
            left: 0,
            bottom: 0,
            width: 1,
            height: 0.5,
            background: new THREE.Color(0.5, 0.5, 0.7),
            eye: [0, 300, 1800],
            up: [0,1,0],
            fov: 30,
            updateCamera: function ( camera, scene, mouseX ) {

                camera.position.x += mouseX * 0.05;
                camera.position.x = Math.max( Math.min( camera.position.x, 2000 ), - 2000 );
                camera.lookAt( scene.position );

            }
        },
        {
            left: 0,
            bottom: 0.5,
            width: 1,
            height: 0.5,
            background: new THREE.Color(0.2, 0.7, 0.5),
            eye: [0, 300, 1800],
            up: [0,1,0],
            fov: 30,
            updateCamera: function ( camera, scene, mouseX ) {

                camera.position.x += mouseX * 0.05;
                camera.position.x = Math.max( Math.min( camera.position.x, 2000 ), - 2000 );
                camera.lookAt( scene.position );

            }
        }
    ];

    init();
    animate();

    function init(){
        for(var i = 0; i < views.length; i++){
            var view = views[i];
            var camera = new THREE.PerspectiveCamera(view.fov, window.innerWidth / window.innerHeight, 1, 10000);
            camera.position.fromArray(view.eye);
            camera.up.fromArray(view.up);
            view.camera = camera;
        }

        scene = new THREE.Scene();

        var geometry = new THREE.BoxGeometry(1, 1, 1);
        var material = new THREE.MeshBasicMaterial({color: 0x00ff00});
        var cube = new THREE.Mesh(geometry, material);
        scene.add(cube);

        renderer = new THREE.WebGLRenderer({antialias: true});
        renderer.setPixelRatio(window.devicePixelRatio);
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.body.appendChild(renderer.domElement);

        document.addEventListener('mousemove', onDocumentMouseMove, false);
    }

    function onDocumentMouseMove(event){
        mouseX = (event.clientX - windowWidth / 2);
        mouseY = (event.clientY - windowHeight / 2);
    }

    function updateSize(){
        if(windowWidth != window.innerWidth || windowHeight != window.innerHeight){
            windowWidth = window.innerWidth;
            windowHeight = window.innerHeight;

            renderer.setSize(windowWidth, windowHeight);
        }
    }

    function animate(){
        render();
        requestAnimationFrame(animate);
    }

    function render() {
        updateSize();

        for(var i = 0; i < views.length; i++){
            var view = views[i];
            var camera = view.camera;

            view.updateCamera(camera, scene, mouseX, mouseY);

            var left = Math.floor(windowWidth * view.left);
            var bottom = Math.floor(windowHeight * view.bottom);
            var width = Math.floor(windowWidth * view.width);
            var height = Math.floor(windowHeight * view.height);

            renderer.setViewport(left, bottom, width, height);
            renderer.setScissor(left, bottom, width, height);
            renderer.setScissorTest(true);
            renderer.setClearColor(view.background);

            camera.aspect = width/height;
            camera.updateProjectionMatrix();

            renderer.render(scene, camera);
        }
    }
@endsection
