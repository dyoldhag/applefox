@extends('fronts.ar.master', ['page_class' => 'confirmation'])
@section('meta-title', 'Applefox')
@section('meta-description', '')

@section('header')
<div class="logo text-center"><a href="{{ url('/foxit') }}"><img src="{{ asset('/images/ar/logo-black.svg') }}" alt="Applefox"></a></div>
@stop
@section('main')
<section id="Confirmation" class="d-flex  justify-content-center">
  <div class="content text-center">
  <h1>YOU FOX-ED IT!</h1>
    <div class="col-12-div-text">
     
      <label class="preview">Stay tuned for our updates via WhatsApp and keep foxing to up your chances of winning!</label>
      <a class="btn btn-black" href="https://www.drinkies.my/apple-fox-cider">Order Apple Fox</a>
       
    </div> 

    <div class="footer">
        <img class="tagline-white" src="{{ asset('/images/ar/tagline-white.png') }}" alt="Quench Your Curiosity">
        <div class="text-center">ENJOY APPLE FOX™ RESPONSIBLY 
        <div class="footer-policy"><a href="{{ url('privacy-policy') }}">PRIVACY POLICY</a> <span class="footer-policy-border">|</span> <a href="{{ url('/'.$setting->terms_link) }}">{{ $setting->terms_name }}</a></div>
        </div>
    </div>
  </div>
</section>
@stop