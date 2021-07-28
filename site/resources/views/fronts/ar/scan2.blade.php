@extends('fronts.ar.master', ['page_class' => 'ar-scan'])
@section('meta-title', 'Applefox - AR')
@section('meta-description', '')

@section('header')
<div class="logo text-center"><a href="{{ url('/foxit') }}"><img src="{{ asset('/images/ar/logo-black.svg') }}" alt="Applefox"></a></div>
@stop


@section('external-scripts')
  <script type="text/javascript">
    window.onload = function () {
      window.addEventListener('camera-init', (data) => {
          // console.log('camera-init', data);
          $('.arjs-loader').addClass('hidden');
      })

      window.addEventListener('camera-error', (error) => {
          // console.log('camera-error', error);
      })

    };
  </script>
@stop

@section('preload')
<script src="//cdn.8thwall.com/web/aframe/8frame-0.9.0.min.js"></script>

<!-- XR Extras - provides utilities like load screen, almost there, and error handling.
       See github.com/8thwall/web/xrextras -->
<script src="//cdn.8thwall.com/web/xrextras/xrextras.js"></script>

<!-- 8thWall Web - Replace the app key here with your own app key -->
<script src="//apps.8thwall.com/xrweb?appKey=XXXXXXXXX"></script>

@stop 

@section('ar-scan')
<!-- 
<div class="arjs-loader">
  <div>Loading, please wait...</div>
</div>
 -->
<a-scene
  xrextras-gesture-detector
  xrextras-almost-there
  xrextras-loading
  xrextras-runtime-error
  xrweb="disableWorldTracking: true">

  <a-assets>
    <!-- Credit to Poly by Google for the model: https://poly.google.com/view/dA5osnS0Rzj -->
    <a-asset-item id="jelly-glb" src="{{ asset('/demo-ar/scan2/jellyfish-model.glb') }}"></a-asset-item>
    <img id="jelly-thumb" src="{{ asset('/demo-ar/scan2/targets/video-target.jpg') }}">
    <video
      id="jelly-video"
      autoplay
      muted
      crossorigin="anonymous"
      loop="true"
      src="jellyfish-video.mp4">
    </video>
  </a-assets>

  <a-camera
    position="0 4 10"
    raycaster="objects: .cantap"
    cursor="fuse: false; rayOrigin: mouse;">
  </a-camera>

  <a-light type="directional" intensity="0.5" position="1 1 1"></a-light>

  <a-light type="ambient" intensity="1"></a-light>

  <!-- Note: "name:" must be set to the name of the image target uploaded to the 8th Wall Console -->
  <a-entity
    xrextras-named-image-target="name: video-target"
    xrextras-play-video="video: #jelly-video; thumb: #jelly-thumb; canstop: true"
    geometry="primitive: plane; height: 1; width: 0.79;">
  </a-entity>

  <!-- Note: "name:" must be set to the name of the image target uploaded to the 8th Wall Console -->
  <a-entity xrextras-named-image-target="name: model-target">
    <!-- Add a child entity that can be rotated independently of the image target. -->
    <a-entity xrextras-one-finger-rotate gltf-model="#jelly-glb"></a-entity>
  </a-entity>

</a-scene>

<a class="btn btn-black" href="{{ url('/foxit-answer') }}">Continue</a>
@stop

