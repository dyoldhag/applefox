<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="8thwall:renderer" content="aframe:1.0.4">
  <meta name="8thwall:package" content="@8thwall.xrextras">

  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

  <title>Apple Fox</title>

  <link rel="stylesheet" href="{{ asset('css/app-ar.css') }}">
  <style>
    body .btn {
      line-height: 50px;
    }

    body .btn-black {
      color: #000000;
      background: #FFF8E6;
    }

    .arjs-loader {
    height: 100%;
    width: 100%;
    min-height: 100vh; 
    position: absolute;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .arjs-loader img {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
  }
   .btn-list {
     position: fixed;
     bottom: 35px;
     width: 300px;
     left: calc(50% - 150px);
     z-index: 1000;
   }

   .scan {
      position: fixed;
      top: 50%;
      left: 50%;
      width: calc(100% - 16px);
      height: calc(100% - 90px);
      z-index: 1000;
      transform: translate(-50%, calc(-50% - 40px));
      opacity: 0.9;
    }

    .scan img{
      width: 80px;
    }

    .scan .topleft{
      position: absolute;
      top: 0;
      left: 0;
    }
    .scan .topright{
      position: absolute;
      top: 0;
      right: 0;
      transform: rotate(90deg);
    }
    .scan .bottomleft {
      position: absolute;
      bottom: 0;
      left: 0;
      transform: rotate(-90deg);
    }
    .scan .bottomright{
      position: absolute;
      bottom: 0;
      right: 0;
      transform: rotate(180deg);
    }
    .poweredby-img {
      display: none !important;
    }
 </style>

  <!-- We've included a slightly modified version of A-Frame, which fixes some polish concerns -->
  <script src="//cdn.8thwall.com/web/aframe/8frame-0.9.2.min.js"></script>
  <script defer src="//cdn.8thwall.com/web/aframe/aframe-animation-component-5.1.2.min.js"></script>
  <!-- <script src="//cdn.8thwall.com/web/aframe/aframe-extras-4.2.0.min.js"></script> -->
  <script src="//cdn.8thwall.com/web/aframe/aframe-extras-6.1.0.min.js"></script>

  <!-- XR Extras - provides utilities like load screen, almost there, and error handling.
       See github.com/8thwall/web/xrextras -->
  <script src="//cdn.8thwall.com/web/xrextras/xrextras.js"></script>

  <!-- 8thWall Web - Replace the app key here with your own app key -->
  <script async
    src="//apps.8thwall.com/xrweb?appKey=5wY8TBj264PctLHPUP3WPQPOucmItXAnevHCoMVgRdLjfkEdhtmDlV0fmQE82EARb3oWip"></script>

  <script>
    AFRAME.registerComponent('hider-material', {
      init() {
        const mesh = this.el.getObject3D('mesh')
        mesh.material.colorWrite = false
      },
    });

    AFRAME.registerComponent('control-animation', {
      init: function () {
        console.log("init");
        var appleModel = document.getElementById('apple-model');
        var textModel = document.getElementById('text-model');
        var door = document.getElementById('door');
        //animation="property: rotation; to: 0 130 0; loop: true; dur: 2000"
        appleModel.object3D.visible = false
        textModel.object3D.visible = false
        door.object3D.visible = false
        var loader = document.getElementById('loader');
        loader.setAttribute('style', 'display: none;')
        var listBtn = document.getElementById('listBtn');
        var isFirst = true;

        var handleCameraStatusChange = function handleCameraStatusChange(event) {
          console.log('status change', event.detail.status);

          switch (event.detail.status) {
            case 'hasStream':
              var scanLayer = document.getElementById('scan');
              scanLayer.removeAttribute('style')
              break;
          }
        };
        let scene = this.el.sceneEl
        scene.addEventListener('camerastatuschange', handleCameraStatusChange)

        const showImage = ({ detail }) => {
          door.object3D.visible = true
          // door.setAttribute('rotation', "0 0 0");
          door.setAttribute('animation', 'property: rotation; to: 0 180 0; loop: false; dur: 500');
          setTimeout(() => {
            appleModel.setAttribute('animation-mixer', {
              clip: '*',
              loop: 'repeat',
            });
            textModel.setAttribute('animation-mixer', {
              clip: '*',
              loop: 'repeat',
            });
            appleModel.object3D.visible = true
            textModel.object3D.visible = true
          }, 500);

          if(isFirst) {
            setTimeout(() => {
              listBtn.removeAttribute('style')
              isFirst = false
            }, 11000);
          }
        }

        const hideImage = ({detail}) => {
          appleModel.object3D.visible = false
          textModel.object3D.visible = false
          door.object3D.visible = false
        }

        this.el.sceneEl.addEventListener('xrimagefound', showImage)
        this.el.sceneEl.addEventListener('xrimagelost', hideImage)
      }
    });

    AFRAME.registerComponent('cylinder-image-geometry', {
      init() {
        const constructGeometry = ({ detail }) => {
          var hiderWalls = document.getElementsByClassName("hider-walls");
          var radius = detail.radiusTop * 10;
          var radiusHider = radius + 0.05;
          console.log(radius);
          for (var i = 0; i < hiderWalls.length; i++) {
            var hider = hiderWalls[i];
            hider.setAttribute('radius', radiusHider);
          }

          var cylinderInside = document.getElementsByClassName("cylinder-inside");
          var radiusInside = radius - 0.01;
          for (i = 0; i < cylinderInside.length; i++) {
            var inside = cylinderInside[i];
            inside.setAttribute('radius', radiusInside);
          }

          var circles = document.getElementsByClassName("circleTopBottom");
          var radiusCircle = radius;
          for (i = 0; i < circles.length; i++) {
            var circle = circles[i];
            circle.setAttribute('radius', radiusCircle);
          }

          var cylinderWindow = document.getElementsByClassName("has-window");
          var windowLength = 130;
          var thetaStart = windowLength / 2;
          var thetaLength = 360 - windowLength;
          for (i = 0; i < cylinderWindow.length; i++) {
            var w = cylinderWindow[i];
            w.setAttribute('theta-start', thetaStart);
            w.setAttribute('theta-length', thetaLength);
          }

          var modelInside = document.getElementById('apple-model');
          var radiusModel = 4;
          var scaleDefault = 0.00084;
          var scaleModel = radius * scaleDefault / radiusModel;
          modelInside.setAttribute('scale', `${scaleModel} ${scaleModel} ${scaleModel}`)
        }

        // this.el.sceneEl.addEventListener('xrimagefound', constructGeometry)

        this.el.parentNode.addEventListener('xrextrasimagegeometry', constructGeometry)
      },
    })
  </script>
</head>

<body>
  <!-- minimal loader shown until image descriptors are loaded -->
  <div id="loader" class="arjs-loader">
    <div><img src="{{ asset('/demo-ar/images/loading.gif') }}"></div>
  </div>
  <!-- Add the 'xrweb' attribute to your scene to make it an 8th Wall Web A-FRAME scene. -->
  <a-scene control-animation xrextras-almost-there xrextras-loading xrextras-runtime-error shadow="type: pcfsoft"
    renderer="colorManagement: true; physicallyBasedRendering: true;" xrweb="disableWorldTracking: true">
    <a-assets>
      <a-asset-item id="apple-glb" src="{{ asset('demo-ar/models/APPLES.glb') }}"></a-asset-item>
      <a-asset-item id="text-glb" src="{{ asset('demo-ar/models/BLACK_SUPER.glb') }}"></a-asset-item>
    </a-assets>
    <a-camera position="0 1 1" raycaster="objects: .cantap" cursor="fuse: false; rayOrigin: mouse;">
    </a-camera>
    <!--<a-entity light="type:directional; castShadow:true;" position="0.1 0.3 -0.2"></a-entity>-->
    <a-entity light="type: point;
                   castShadow: true;
                   intensity: 0.4;
                   shadowCameraVisible: false;" position="0.5 0.4 1"></a-entity>
    <a-light type="directional" intensity="1" position="0.1 0.3 -0.2"></a-light>
    <a-light type="ambient" intensity="0.2"></a-light>

    <!-- COFFEE SLEEVE (Conical): 3D models inside and outside container -->
    <xrextras-named-image-target name="applefox-label">
      <!--<a-box scale="0.1 0.1 0.1" position="0.1 0.3 -0.2"></a-box>-->
      <!-- Hider walls -->
      <a-entity id="hider-walls" scale="0.1 0.1 0.1">
        <a-cylinder class="hider-walls" color="green" open-ended="true" height="10" position="0 9.2 0" hider-material>
        </a-cylinder>
        <a-cylinder class="hider-walls" color="green" open-ended="true" height="10" position="0 -10 0" hider-material>
        </a-cylinder>
        <a-cylinder class="hider-walls" id="door" color="green" open-ended="true" height="10" position="0 0 0"
          theta-start="-90" theta-length="180" hider-material></a-cylinder>
        <a-cylinder class="hider-walls has-window" color="green" open-ended="true" height="15" hider-material>
        </a-cylinder>
      </a-entity>
      <a-entity scale="0.1 0.1 0.1" position="0 0 0" shadow="cast: false; receive: true;">
        <!--  <a-cylinder color="#9c9c9c" open-ended="true" height="18" radius="4" position="0 0 0" -->
        <!--  material="side: double"-->
        <!--  theta-start="52" theta-length="256"></a-cylinder>-->

        <a-circle class="circleTopBottom" color="#7a7a7a" rotation="-90 0 0" position="0 -6.4 0"></a-circle>

        <a-cylinder class="cylinder-inside has-window" color="#9c9c9c" open-ended="true" height="18" position="0 0 0"
          material="side: double"></a-cylinder>

        <a-cylinder class="cylinder-inside" color="#9c9c9c" open-ended="true" height="3" position="0 -6.5 0"
          material="side: double"></a-cylinder>
        <a-cylinder class="cylinder-inside" color="#9c9c9c" open-ended="true" height="3.5" position="0 6 0"
          material="side: double"></a-cylinder>

        <a-cylinder class="cylinder-inside" color="#9c9c9c" open-ended="true" height="11" position="0 0 0"
          theta-start="-90" theta-length="180" material="side: back"></a-cylinder>
      </a-entity>

      <a-entity scale="0.1 0.1 0.1">
        <!--  <a-ring color="#7a7a7a" radius-inner="3.91" radius-outer="3.99" rotation="-90 0 0" position="0 -5 0"></a-ring>-->
        <!--  <a-ring color="#7a7a7a" radius-inner="3.91" radius-outer="3.99" rotation="90 0 0" position="0 4.2 0"></a-ring>-->

        <a-circle class="circleTopBottom" color="#7a7a7a" rotation="90 0 0" position="0 6.4 0"></a-circle>
      </a-entity>
      <xrextras-curved-target-container cylinder-image-geometry position="0 -0.06 0" color="#9c9c9c" width="0.6"
        height="1.2"></xrextras-curved-target-container>
      <a-entity gltf-model="#apple-glb" id="apple-model" position="0 -0.64 0" rotation="0 20 0" shadow="receive: false">
      </a-entity>
      <a-entity gltf-model="#text-glb" id="text-model" position="0 -0.64 0.25" scale="0.001 0.001 0.001">
        <a-light type="directional" intensity="1" position="0.1 0.8 3"></a-light>
        <!--<a-light type="ambient" intensity="0.3"></a-light>-->
      </a-entity>
    </xrextras-named-image-target>
  </a-scene>
  <div id="scan" class="scan" style="display: none;">
    <img src="{{ asset('images/ic_scan.png') }}" class="topleft" />
    <img src="{{ asset('images/ic_scan.png') }}" class="topright" />
    <img src="{{ asset('images/ic_scan.png') }}" class="bottomleft" />
    <img src="{{ asset('images/ic_scan.png') }}" class="bottomright" />
  </div>
  <div id='listBtn' class='btn-list' style="display: none">
    <a class="btn btn-black" href="{{ url('/foxit-congrats') }}" onclick="window.location.href=">CLAIM YOUR FREE APPLE FOX CIDER</a>
  </div>
</body>

</html>