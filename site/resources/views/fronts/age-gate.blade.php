@extends('fronts.layouts.master', ['page_class' => 'agegate'])
@section('meta-title', 'Applefox')
@section('meta-description', '')

@section('header')
<div class="logo text-center"><a href="{{ url('/QuenchYourCuriosity') }}"><img src="{{ asset('/images/logo.svg') }}" alt="Applefox"></a></div>
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
      <div class="note">
        {!!html_entity_decode($setting->agegate_note)!!}
      </div>
      <div class="errors">You are not old enough to enter this site.</div>
      <button class="btn" type="submit">ENTER</button>
    </form>
    <div class="agegate-footer">{!!html_entity_decode($setting->agegate_footer)!!}</div>
    <div class="agegate-footer-second text-center">ENJOY APPLE FOX™ RESPONSIBLY 
        <a href="{{ url('/'.$setting->terms_link) }}">{{ $setting->terms_name }}</a>
    </div>
  </div>
</section>
@stop