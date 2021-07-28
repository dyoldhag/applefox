@extends('fronts.layouts.master', ['page_class' => 'home'])
@section('meta-title', 'Quench Your Curiosity')
@section('meta-description', '')

@section('main')
<ul id="menu">
	<li class="active"><a alt="#section1" onclick="BackToDiv('#section1');">Home</a></li>
	{{-- <li><a alt="#winafridge" onclick="BackToDiv('#winafridge');">Win a fridge</a></li> --}}
  <li><a alt="#confirmwin" onclick="BackToDiv('#confirmwin');">Confirm win</a></li>
  <li><a alt="#baggiveaway" onclick="BackToDiv('#baggiveaway');">Bag giveaway</a></li>
  <li><a alt="#drinkiesdeals" onclick="BackToDiv('#drinkiesdeals');">Drinkies deals</a></li>
</ul>
<div id="fullpage">
	<div class="section" id="section1">
    <div class="logo text-center"><a href="{{ url('/QuenchYourCuriosity') }}"><img src="{{ asset('/images/logo.svg') }}" alt="Applefox"></a></div>
    <img class="d-none d-md-block" style="opacity: 0;width: 100%;" src="{{ asset('/images/section-1.jpg') }}" alt="section1">
    <img class="d-md-none" style="opacity: 0;width: 100%;" src="{{ asset('/images/section-1-m.jpg') }}" alt="section1">
    <div class="section-home section1-content">
      <img class="d-none d-md-inline-block section1-title" src="{{ asset('/images/section1-title.png') }}" alt="section1">
      <img class="d-md-none" src="{{ asset('/images/section1-title-m.png') }}" alt="section1">
      <div class="section-home-preview">{!!html_entity_decode($setting->section1_preview)!!}</div>
      <a class="scroll-down" href="javascript:" onclick="BackToDiv('#confirmwin');">
        <span>SCROLL DOWN</span>
        <img src="{{ asset('/images/down.png') }}" alt="down">
      </a>
    </div>
	</div>
	{{-- <div class="section" id="winafridge">
    <img class="d-none d-md-block" style="opacity: 0;width: 100%;" src="{{ asset('/images/section-2.jpg') }}" alt="section2">
    <img class="d-md-none" style="opacity: 0;width: 100%;" src="{{ asset('/images/section-2-m.jpg') }}" alt="section2">
    <div class="section-home section2-content">
      <h2>{!!html_entity_decode($setting->section2_title)!!}</h2>
      <div class="section-home-preview">{!!html_entity_decode($setting->section2_preview)!!}</div>
      <a class="btn btn-black" href="{{ url('/winfridge') }}">START</a>
      <div class="section-home-note">{!!html_entity_decode($setting->section2_note)!!}</div>
    </div>
	</div> --}}
	<div class="section" id="confirmwin">
    <img class="d-none d-md-block" style="opacity: 0;width: 100%;" src="{{ asset('/images/section-3.jpg') }}" alt="section3">
    <img class="d-md-none" style="opacity: 0;width: 100%;" src="{{ asset('/images/section-3-m.jpg') }}" alt="section3">
    <div class="section-home section3-content">
      <h2>{!!html_entity_decode($setting->section3_title)!!}</h2>
      <div class="section-home-preview">{!!html_entity_decode($setting->section3_preview)!!}</div>
      <a class="btn btn-black" href="{{ url('/confirmwin') }}">SUBMIT RECEIPT</a>
      <div class="section-home-note">{!!html_entity_decode($setting->section3_note)!!}</div>
    </div>
  </div>
  <div class="section" id="baggiveaway">
    <img class="d-none d-md-block" style="opacity: 0;width: 100%;" src="{{ asset('/images/section-4.jpg') }}" alt="section4">
    <img class="d-md-none" style="opacity: 0;width: 100%;" src="{{ asset('/images/section-4-m.jpg') }}" alt="section4">
    <div class="section-home section4-content">
      <h2>{!!html_entity_decode($setting->section4_title)!!}</h2>
      <div class="section-home-preview">{!!html_entity_decode($setting->section4_preview)!!}</div>
      <a class="btn btn-black" href="{{ url('/freebag') }}">SEE PARTICIPATING OUTLETS</a>
      <div class="section-home-note">{!!html_entity_decode($setting->section4_note)!!}</div>
    </div>
  </div>
  <div class="section" id="drinkiesdeals">
    <img class="d-none d-md-block" style="opacity: 0;width: 100%;" src="{{ asset('/images/section-5.jpg') }}" alt="section5">
    <img class="d-md-none" style="opacity: 0;width: 100%;" src="{{ asset('/images/section-5-m.jpg') }}" alt="section5">
    <div class="section-home section5-content">
      <h2>{!!html_entity_decode($setting->section5_title)!!}</h2>
      <div class="section-home-preview">{!!html_entity_decode($setting->section5_preview)!!}</div>
      @if($setting->section5_comingsoon)
        <a class="btn btn-black">{{ $setting->section5_comingsoon }}</a>
      @else
        <a class="btn btn-black" href="{{ $setting->section5_link }}" target="_bank">Order now</a>
      @endif
      <div class="section-home-note">{!!html_entity_decode($setting->section5_note)!!}</div>
    </div>
	</div>
</div>
<div class="page-footer">
  <div class="page-footer-first">
    <img class="d-none d-md-inline-block" src="{{ asset('/images/home-footer.png') }}" alt="Applefox product">
    <img class="d-md-none" src="{{ asset('/images/home-footer-m.png') }}" alt="Applefox product">
  </div>
</div>
<div class="page-footer-second text-center">ENJOY APPLE FOX™ RESPONSIBLY 
  <a href="{{ url('/'.$setting->terms_link) }}">{{ $setting->terms_name }}</a>
</div>
@stop


@push('scripts')
<script>
  function BackToDiv(div){
    $('html,body').animate({
        scrollTop: $(div).offset().top + 1
    }, 'slow');
    if(jQuery(window).width() <= 767){
      jQuery('body').removeClass('show-menu');
    }
  }

  // Cache selectors
  var lastId,
  topMenu = $("#menu"),
  topMenuHeight = topMenu.outerHeight()+15,
  // All list items
  menuItems = topMenu.find("a"),
  // Anchors corresponding to menu items
  scrollItems = menuItems.map(function(){
    var item = $($(this).attr("alt"));
    if (item.length) { return item; }
  });


  // Bind to scroll
  $(window).scroll(function(){
    var fromTop = $(this).scrollTop()+topMenuHeight;
    var cur = scrollItems.map(function(){
      if ($(this).offset().top < fromTop)
        return this;
    });
    cur = cur[cur.length-1];
    var id = cur && cur.length ? cur[0].id : "";
    if (lastId !== id) {
        lastId = id;
        menuItems
          .parent().removeClass("active")
          .end().filter("[alt='#"+id+"']").parent().addClass("active");
    }                   
  });
</script>
@endpush