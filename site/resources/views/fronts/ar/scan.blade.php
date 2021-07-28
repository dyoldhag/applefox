@extends('fronts.ar.master',['page_class' => 'scanpage']) 
@section('meta-title', 'Applefox - AR')
@section('meta-description', '')

@section('header')
@stop


@section('external-scripts')

@stop
@php
    $nameserveruser =  $_SERVER['HTTP_USER_AGENT'];
    $browser = get_browser(null, true);
    
    if ($browser['browser'] == 'Chrome' && ( strpos($nameserveruser, 'iPhone') || strpos($nameserveruser, 'iPad') || strpos($nameserveruser, 'Mac OS') || strpos($nameserveruser, 'iPhone OS') ) ) {
          $error_scan = true;
      } else {
          $error_scan = false;
    }
@endphp

@section('preload')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
<script src='https://cdn.jsdelivr.net/gh/aframevr/aframe@1c2407b26c61958baa93967b5412487cd94b290b/dist/aframe-master.min.js'></script>
<script src="{{ asset('js/ar/aframe-ar-nft.js') }}"></script>
<style>
   .arjs-loader {
    height: 100%;
    width: 100%;
    min-height: 100vh; 
    position: absolute;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  body.scanpage {
    color:#212529;
  }
  .arjs-loader img {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
  }

  .bg-video {
    position: fixed; top: 0; left: 0;
    min-width: 100%; min-height: 100%;
    background-color: #FFFADA;
    z-index: 100;
    background-size: cover;
  }

  .video {
    position: fixed; right: 0; bottom: 0;
    min-width: 100%; min-height: 100%;
    width: 100%; height: 100%;
    z-index: 100;
    background-size: cover;
  }

  .btn-list {
    position: fixed;
    bottom: 35px;
    width: 300px;
    left: calc(50% - 150px);
    z-index: 1000;
  }

  .btn-vols {
    position: fixed;
    top: 0px;
    right: 10px;
    z-index: 1000;
  }

  .btn-vols .btn.btn-vol {
    float: right;
    border: none;
    background: none;
    text-align: right;
  }

  .btn-list .btn-replay {
    float: left;
    width: 50px;
  }

  .btn-list .btn-continue {
    float: right;
    width: 240px;
  }

  body {
    overflow: hidden;
  }
</style>


<script>
  AFRAME.registerComponent('markerhandler', {
    init: function () {
      this.el.sceneEl.addEventListener('markerFound', () => {
        document.getElementById('scene').remove()
        document.getElementById('bg-video').setAttribute('class', 'bg-video');
        var el = document.getElementById("vid");
        el.setAttribute("class", "video");
        el.hidden = false;
        document.getElementById('listBtnVol').hidden = false;
        el.currentTime = '0';
        setTimeout(() => {
          el.play();
        }, 1000);
        el.onended = function() {
          document.getElementById('listBtn').hidden = false;
        };
      });
    }
  })
  
  function startup() {
    var setMute = function(muted) {
      document.getElementById("btnVolMute").hidden = !muted;
      document.getElementById("btnVolUp").hidden = muted;
      document.getElementById("vid").muted = muted;
    }

    document.getElementById('replayBtn').onclick = function (){
      var curVid = document.getElementById("vid");
      curVid.pause();
      curVid.currentTime = '0';
      setMute(false);
      curVid.play();
    }

    document.getElementById("btnVolMute").onclick = function () {
      setMute(false);
    }

    document.getElementById("btnVolUp").onclick = function () {
      setMute(true);
    }

    document.ontouchstart = function() {
      var curVid = document.getElementById("vid");
      if(curVid.hidden) {
        curVid.autoplay = false;
        curVid.pause();
        setMute(false);
      }
      document.ontouchstart = null;
    }
  }

  document.addEventListener("DOMContentLoaded", startup);
</script>

@if ($error_scan)
        <div class="error-text-container error-margin-top-5">
          <span id="error_text_header_unknown" class="open-header-unknown">
            <h2>Open in Safari<br> to view AR</h2>
          </span>
          <img id="app_img" class="app-header-img unknown foreground-image" src="{{ asset('/images/ar/safari-fallback.png') }}"> 
          <br>
          <span id="app_link" class="desktop-home-link mobile">{{ url('/foxit-animation') }}</span>
          <input type="text" value="{{ url('/foxit-animation') }}" id="myInputurlscan">
          <button id="error_copy_link_btn" class="copy-link-btn">Copy Link</button> 
        </div>
  @else 
    @section('foxit-animation')

@stop 
    
        <!-- minimal loader shown until image descriptors are loaded -->
        <div class="arjs-loader">
          <div><img src="{{ asset('/demo-ar/images/loading.gif') }}"></div>
        </div>

        <div id='bg-video'>    
        </div>

        <video id='vid' src="{{ asset('/demo-ar/fox.mp4') }}" hidden playsinline muted autoplay>
            <p>Your browser does not support HTML5 video.</p>
        </video>

        <a-scene
          id='scene'
          vr-mode-ui='enabled: false;'
          renderer="logarithmicDepthBuffer: true;"
          embedded arjs='trackingMethod: best; sourceType: webcam; debugUIEnabled: false;'>

          <!-- use rawgithack to retrieve the correct url for nft marker (see 'pinball' below) -->
          <a-nft
              markerhandler
              type='nft' url="{{ asset('/demo-ar/fox') }}"
              smooth='true' smoothCount='10' smoothTolerance='0.01' smoothThreshold='5'>
          </a-nft>
          <a-entity camera></a-entity>
        </a-scene>

        <div id='listBtnVol' class='btn-vols' hidden>
          <a id="btnVolMute" class="btn btn-vol" href='#'><i class="fas fa-volume-mute"></i></a>
          <a id="btnVolUp" class="btn btn-vol" href="#" hidden><i class="fas fa-volume-up"></i></a>
        </div>

        <div id='listBtn' class='btn-list' hidden>
          <a id="replayBtn" class="btn btn-black btn-replay" href='#'><i class="fas fa-undo"></i></a>   
          <a id="continueBtn" class="btn btn-black btn-continue" href="{{ url('/foxit-answer') }}" >Continue</a>
        </div>
@stop


@endif  
