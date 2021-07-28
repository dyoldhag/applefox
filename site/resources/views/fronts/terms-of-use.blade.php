@extends('fronts.layouts.master', ['page_class' => 'static-page'])
@section('meta-title', $setting->terms_of_use_title.' | Quench Your Curiosity')
@section('meta-description', '')

@section('header')
<div class="logo text-center"><a href="{{ url('/QuenchYourCuriosity') }}"><img src="{{ asset('/images/logo-black.svg') }}" alt="Applefox"></a></div>
@stop
@section('main')
<section id="static">
  <div class="content">
    <h1 class="text-center">{{ $setting->terms_of_use_title }}</h1>
    <div class="preview">
      {!!html_entity_decode($setting->terms_of_use_content)!!}
    </div>
  </div>
</section>
@stop