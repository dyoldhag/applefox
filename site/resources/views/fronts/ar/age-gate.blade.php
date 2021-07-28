@extends('fronts.ar.master', ['page_class' => 'agegate'])
@section('meta-title', 'Applefox')
@section('meta-description', '')

@section('header')
<div class="logo text-center"><a href="{{ url('/foxit') }}"><img src="{{ asset('/images/ar/logo-black.svg') }}" alt="Applefox"></a></div>
@stop
@section('main')
<section id="agegate" class="d-flex align-items-end justify-content-center">{{--   --}}
  <div class="content text-center">
    <h1>{!!html_entity_decode($setting->agegate_title)!!}</h1>
    <form id="agegatefrm" method="post">
      <div class="agecheck">
        <input type="text" name="age-dd" id="age-dd" placeholder="DD" maxlength="2" autocomplete="off">
        <input type="text" name="age-mm" id="age-mm" placeholder="MM" maxlength="2" autocomplete="off">
        <input type="text" name="age-yy" id="age-yy" placeholder="YYYY" maxlength="4" autocomplete="off">
      </div>
      <div class="note">{!!html_entity_decode($setting->agegate_note)!!}</div>
      <div class="errors">You are not old enough to enter this site.</div>
      <button class="btn btn-black" type="submit">ENTER</button>
      <div class="by-click">{!!html_entity_decode($setting->agegate_footer)!!}</div>
    </form>
    <div class="footer">
        <img class="tagline-white" src="{{ asset('/images/ar/tagline-white.png') }}" alt="Quench Your Curiosity">
        <div class="text-center">ENJOY APPLE FOX™ RESPONSIBLY 
        <div class="footer-policy"><a href="{{ url('privacy-policy') }}">PRIVACY POLICY</a> <span class="footer-policy-border">|</span> <a href="{{ url('/'.$setting->terms_link) }}">{{ $setting->terms_name }}</a></div>
        </div>
    </div>
  </div>
</section>
@stop