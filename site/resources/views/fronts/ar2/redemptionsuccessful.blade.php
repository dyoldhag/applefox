@extends('fronts.ar.master', ['page_class' => 'page-ar-template redemption'])
@section('meta-title', 'Applefox')
@section('meta-description', '')

@section('header')
<div class="logo text-center"><a href="{{ url('/foxit') }}"><img src="{{ asset('/images/ar/logo-black.svg') }}" alt="Applefox"></a></div>
@stop
@section('main')
<section id="redemption" class="d-flex align-items-end justify-content-center page-ar-template-content">
  <div class="content text-center">
    <h1>AWESOME!
ENJOY YOUR FREE
APPLE FOX CIDER.</h1>     
    <h3 class="h3-title">Show off your free treat, tag <br>
@applefox_my and hashtag #FOXIT and <br>
#QuenchYourCuriosity.</h3>
 
      <div class="col-12"><a href="{{ url('foxit') }}"  class="btn btn-black">GO TO HOME</a></div>
 

  </div>
</section>
<div class="footer">
        <div class="text-center">ENJOY APPLE FOX™ RESPONSIBLY 
        <div class="footer-policy"><a href="{{ url('privacy-policy') }}">PRIVACY POLICY</a> <span class="footer-policy-border">|</span> <a href="{{ url('/'.$setting->terms_link) }}">{{ $setting->terms_name }}</a></div>
        </div>
    </div>
@stop