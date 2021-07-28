@extends('fronts.ar.master', ['page_class' => 'page-ar-template home'])
@section('meta-title', 'Applefox')
@section('meta-description', '')

@section('header')
<div class="logo text-center"><a href="{{ url('/foxit') }}"><img src="{{ asset('/images/ar/logo-black.svg') }}" alt="Applefox"></a></div>
@stop
@section('main')
<section id="home" class="d-flex align-items-end justify-content-center">
  <div class="content text-center">
    <div class="col-12">  
      <label class="preview" style=" font-size: 16px;  line-height: 22px;">2020 feeling meh? FOX IT! It’s Apple Day and as a cider with wayyyy more apples, we’re going big to celebrate this super amazing fruit. So follow the fox for a rewarding treat!</label>
      <a class="btn btn-black" href="{{ url('/foxit-ar') }}">Scan the fox</a>
      <div class="note">(For the best experience, scan the fox on our can or bottle.)</div> 
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