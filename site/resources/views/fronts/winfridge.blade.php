@extends('fronts.layouts.master', ['page_class' => 'confirmwin winfridge'])
@section('meta-title', 'Win Fridge | Quench Your Curiosity')
@section('meta-description', '')

@section('header')
<div class="logo text-center"><a href="{{ url('/QuenchYourCuriosity') }}"><img src="{{ asset('/images/logo.svg') }}" alt="Applefox"></a></div>
@stop
@section('main')
<div id="winfridge">
  <div class="board text-center">
    <h1>{!!html_entity_decode($setting->winfridge_title)!!}</h1>
    <div class="preview">{!!html_entity_decode($setting->winfridge_preview)!!}</div>

    <form class="needs-validation submit-form" novalidate action="{{ url('/winfridge') }}" method="POST" role="form">
      {{ csrf_field()}}


      <div class="form-group mb-0">
        <input type="text" name="number" id="number" placeholder="000" autocomplete="off" maxlength="5" value="{{old('number')}}" required>
        <label for="number" class="form-label">apple fox ciders</label>
        @if ($errors->has('number'))
          <span class="invalid-message">{{ $errors->first('number') }} </span>
        @endif
      </div>

      <button type="submit" class="btn">Submit</button>
    </form>
  </div>

  <div class="content text-center">
    <div class="winfridge-done-footer">
      <img class="d-none d-md-block" src="{{ asset('/images/winfridge-footer.png') }}" alt="Applefox product">
      <img class="d-md-none" src="{{ asset('/images/winfridge-footer-m.png') }}" alt="Applefox product">
    </div>
  </div>
</div>
<div class="page-footer-second text-center">ENJOY APPLE FOX™ RESPONSIBLY 
  <a href="{{ url('/'.$setting->terms_link) }}">{{ $setting->terms_name }}</a>
</div>
@stop


@push('scripts')
<script>
  window.addEventListener('load', function(e) {
  jQuery('#number').on('change keypress keyup', function(e) {
    if(jQuery.isNumeric(e.target.value) == false){
      var y = e.target.value.replace(/[A-Za-z]/g, '');
      e.target.value = y
    }
  });
  var forms = document.getElementsByClassName('needs-validation');
  var validation = Array.prototype.filter.call(forms, function(form) {
    form.addEventListener('submit', function(event) {
      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
      }else{
        $('.btn-submit').attr("disabled", true);
      }
      $('.invalid-message').hide();
      form.classList.add('was-validated');
    }, false);
  });
  }, false);
</script>
@endpush