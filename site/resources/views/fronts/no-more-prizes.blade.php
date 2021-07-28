@extends('fronts.layouts.master', ['page_class' => 'confirmwin nomoreprize'])
@section('meta-title', 'No More Prizes | Quench Your Curiosity')
@section('meta-description', '')

@section('header')
<div class="logo text-center"><a href="{{ url('/QuenchYourCuriosity') }}"><img src="{{ asset('/images/logo.svg') }}" alt="Applefox"></a></div>
@stop
@section('main')
<div id="confirmwin">
  <div class="board text-center">
    <img class="d-none d-md-inline-block" src="{{ asset('/images/no-more-prize-content.png') }}" alt="Applefox no more prize">
    <img class="d-md-none" src="{{ asset('/images/no-more-prize-content-m.png') }}" alt="Applefox no more prize">
    <div class="text-center"><a class="btn" href="{{ url('/') }}">Go to home</a></div>
  </div>
  <div class="content text-center">
    <div class="nomoreprize-footer">
      <img class="d-none d-md-block" src="{{ asset('/images/no-more-prize-footer.png') }}" alt="Applefox product">
      <img class="d-md-none" src="{{ asset('/images/no-more-prize-footer-m.png') }}" alt="Applefox product">
    </div>
  </div>
</div>
<div class="page-footer-second text-center">ENJOY APPLE FOX™ RESPONSIBLY 
  <a href="{{ url('/'.$setting->terms_link) }}">{{ $setting->terms_name }}</a>
</div>
@stop