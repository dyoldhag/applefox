@extends('fronts.layouts.master', ['page_class' => 'test'])
@section('meta-title', 'Test | Quench Your Curiosity')
@section('meta-description', '')

@section('header')
<div class="logo text-center"><a href="{{ url('/QuenchYourCuriosity') }}"><img src="{{ asset('/images/logo-black.svg') }}" alt="Applefox"></a></div>
@stop
@section('main')
<section id="static">
  <div class="size"></div>
</section>
@stop

@push('scripts')
<script src="{{ asset('/js/jquery.sumoselect.min.js') }}"></script>
<script>
  $(document).ready(function () {
    $('.size').html($( window ).width() +"x"+$( window ).height());
  })
</script>

@endpush