@extends('fronts.layouts.master', ['page_class' => 'confirmwin confirmwinresult'])
@section('meta-title', 'Confirm Win Result | Quench Your Curiosity')
@section('meta-description', '')

@section('header')
<div class="logo text-center"><a href="{{ url('/QuenchYourCuriosity') }}"><img src="{{ asset('/images/logo.svg') }}" alt="Applefox"></a></div>
@stop
@section('main')
<div id="confirmwin">
  <div class="board board-result-prize text-center">
    <div class="board-result-prize-id">Submission ID: {{ $prize['confirmwin'] }}</div>
    <div class="board-result-prize-img"><img src="{{ asset($prize['image']) }}" alt="{{ $prize['name'] }}"></div>
    <div class="board-result-prize-description">{!!html_entity_decode($prize->description)!!}</div>
    <div class="board-result-prize-content">{!!html_entity_decode($prize->content)!!}</div>
    <div class="text-center">
      <a class="btn" href="{{ url('/confirmwin') }}">Redeem again</a>&nbsp;&nbsp;&nbsp;&nbsp;
      <a class="btn" href="{{ url('/QuenchYourCuriosity') }}">home</a>
    </div>
    <div class="note text-center">{!!html_entity_decode($setting->winfridge_result_note)!!}</div>
  </div>
  <div class="content text-center confirmwin-result">
    <div class="confirmwin-result-footer">
      <img class="d-none d-md-block" src="{{ asset('/images/confirmwin-result.png') }}" alt="Applefox product">
      <img class="d-md-none" src="{{ asset('/images/confirmwin-result-m.png') }}" alt="Applefox product">
    </div>
  </div>
</div>
<div class="page-footer-second text-center">ENJOY APPLE FOX™ RESPONSIBLY 
  <a href="{{ url('/'.$setting->terms_link) }}">{{ $setting->terms_name }}</a>
</div>
@stop