@extends('fronts.ar.master', ['page_class' => 'answer'])
@section('meta-title', 'Applefox')
@section('meta-description', '')

@section('header')
<div class="logo text-center"><a href="{{ url('/foxit') }}"><img src="{{ asset('/images/ar/logo-black.svg') }}" alt="Applefox"></a></div>
@stop
@section('main')
<section id="answer" class="d-flex align-items-end justify-content-center">
  <div class="content text-center">
    <h3 style=" margin: 0; font-size: 20px;    font-family: Veneer, sans-serif;">FOLLOW ON TO WIN A PRIZE! BUT FIRST:</h3>
    <h1>HOW MANY FOXES DID YOU SPOT
    IN THE CIDER FACTORY?</h1>   
    <div class="preview">(Don’t miss out the one big fox!)</div>
    <img src="{{ asset('/images/ar/fox.svg') }}" alt="Fox">
    
    <form class="needs-validation submit-form" novalidate action="{{ url('/foxit-answer') }}" method="POST" role="form" autocomplete="off">
      {{ csrf_field()}}
      <div class="col-12">
        <div class="input-group input-number">
          <input type="button" value="-" class="button-minus" data-field="fox">
          <input type="number" step="1" max="" value="1" name="fox" class="fox-field">
          <input type="button" value="+" class="button-plus" data-field="fox">
        </div>
      </div>
      <div class="col-12"><button type="submit" class="btn btn-black">Next</button></div>
    </form>

    <div class="footer">
        <img class="tagline-white" src="{{ asset('/images/ar/tagline-black.png') }}" alt="Quench Your Curiosity">
        <div class="text-center">ENJOY APPLE FOX™ RESPONSIBLY 
        <div class="footer-policy"><a href="{{ url('privacy-policy') }}">PRIVACY POLICY</a> <span class="footer-policy-border">|</span> <a href="{{ url('/'.$setting->terms_link) }}">{{ $setting->terms_name }}</a></div>
        </div>
    </div>
  </div>
</section>
@stop