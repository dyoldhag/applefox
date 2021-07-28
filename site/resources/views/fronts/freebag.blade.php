@extends('fronts.layouts.master', ['page_class' => 'freebag'])
@section('meta-title', 'Free Bag | Quench Your Curiosity')
@section('meta-description', '')

@section('header')
<div class="logo text-center"><a href="{{ url('/QuenchYourCuriosity') }}"><img src="{{ asset('/images/logo.svg') }}" alt="Applefox"></a></div>
@stop
@section('main')
<div id="freebag">
  <div class="freebag-board">
    <img class="d-none d-md-block" style="opacity: 0;width: 100%;" src="{{ asset('/images/freebag-tmp.jpg') }}" alt="freebag-tmp">
    <img class="d-md-none" style="opacity: 0;width: 100%;" src="{{ asset('/images/freebag-m-tmp.jpg') }}" alt="freebag-m-tmp">
  </div>
  <div class="content">
    <div class="wrap">
      <img class="freebag-bag" src="{{ asset('/images/freebag-bag.png') }}" alt="freebag-bag">
      <div class="preview">{!!html_entity_decode($setting->baggiveaway_preview)!!}</div>
      <h2><span>{{ $setting->baggiveaway_title }}</span></h2>
      <div class="wrap-outlet">
        <div class="outlet">
          @if($datafreeBag)
              @php $i = 0; @endphp
              <div class="row">
                <div class="col-12 col-md-6">
                  @foreach ($datafreeBag['col1'] as $item)
                  <span>{{ $item }}</span>
                  @endforeach
                </div>
                @if($datafreeBag['col2'])
                <div class="col-12 col-md-6">
                  @foreach ($datafreeBag['col2'] as $item)
                  <span>{{ $item }}</span>
                  @endforeach
                </div>
                @endif
            </div>
          @endif
        </div>
      </div>
      <div class="text-center">
        <a class="btn btn-black" target="_blank" href="https://wa.me/60172819512">SUBMIT RECEIPT</a><a class="btn btn-black btn-spacing" href="{{ url('/QuenchYourCuriosity') }}">home</a><br />
        <img class="mb-3" src="{{ asset('/images/winfridge-footer-m.png') }}" alt="winfridge-footer-m">
      </div>
    </div>
  </div>
</div>
<div class="page-footer-second text-center">ENJOY APPLE FOX™ RESPONSIBLY 
  <a href="{{ url('/'.$setting->terms_link) }}">{{ $setting->terms_name }}</a>
</div>
@stop