@extends('fronts.layouts.master', ['page_class' => 'winfridge-detail'])
@section('meta-title', 'Win Fridge Detail | Quench Your Curiosity')
@section('meta-description', '')

@section('header')
<div class="logo text-center"><a href="{{ url('/QuenchYourCuriosity') }}"><img src="{{ asset('/images/logo-black.svg') }}" alt="Applefox"></a></div>
@stop
@section('main')
<div id="winfridge-detail">
  <div class="content text-center">
    <h1>{{ $setting->winfridge_detail_title }}</h1>
    <div class="preview">{!!html_entity_decode($setting->winfridge_detail_preview)!!}</div>
    <form class="needs-validation submit-form" novalidate action="{{ url('/winfridge-detail') }}" method="POST" role="form" autocomplete="off">
    {{ csrf_field()}}
      <div class="form-row">
        <div class="col-12 col-md-6 mb-md-2">
          <div class="form-group">
            <label for="name" class="form-label">FULL NAME</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="John Doe" autocomplete="off" value="{{old('name')}}" required>
            <div class="invalid-feedback">Name is required</div>
            @if ($errors->has('name'))
              <span class="invalid-message">{{ $errors->first('name') }} </span>
            @endif
          </div>
        </div>
        <div class="col-12 col-md-6 mb-md-2">
          <div class="form-group">
            <label for="icnumber" class="form-label">IC Number</label>
            <input type="text" class="form-control" name="icnumber" id="icnumber" placeholder="XXXXXX-XX-XXXX" pattern=".{14,}" maxlength="14" autocomplete="off" value="{{old('icnumber')}}" required>
            <div class="invalid-feedback invalid-feedback-icnumber">IC Number is required</div>
            @if ($errors->has('icnumber'))
              <span class="invalid-message">{{ $errors->first('icnumber') }} </span>
            @endif
          </div>
        </div>
        <div class="col-12 col-md-6 mb-md-2">
          <div class="form-group">
            <label for="phone" class="form-label">Mobile Number</label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="012-3456789" pattern=".{11,}" maxlength="12" autocomplete="off" value="{{old('phone')}}" required>
            <div class="invalid-feedback invalid-feedback-phone">Mobile number is required</div>
            @if ($errors->has('phone'))
              <span class="invalid-message">{{ $errors->first('phone') }} </span>
            @endif
          </div>
        </div>
        <div class="col-12 col-md-6 mb-md-2">
          <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" name="email" id="email" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="email@gmail.com" autocomplete="off" value="{{old('email')}}" required>
            <div class="invalid-feedback invalid-feedback-email">Email is required</div>
            @if ($errors->has('email'))
              <span class="invalid-message">{{ $errors->first('email') }} </span>
            @endif
            @if(session()->has('message'))
              <span class="invalid-message">{{ session()->get('message') }}</span>
            @endif
          </div>
        </div>
        <div class="col-12">
          <div class="form-group">
            <label for="preferred" class="form-label">PICK YOUR PREFERRED LOCATION</label>
            <select class="form-control select-custom" id="preferred" name="preferred">
              <option>Jaya Grocer Starling Mall</option>
              <option>Jaya Grocer Ipoh Parade</option>
              <option>Jaya Grocer Gurney Paragon</option>
            </select>
          </div>
        </div>
        <div class="col-12 text-center note">{!!html_entity_decode($setting->winfridge_detail_note)!!}</div>
        <div class="col-12"><button type="submit" class="btn btn-black">Submit</button></div>
      </div>

    </form>

  </div>
</div>
<div class="page-footer-second text-center">ENJOY APPLE FOX™ RESPONSIBLY 
  <a href="{{ url('/'.$setting->terms_link) }}">{{ $setting->terms_name }}</a>
</div>
@stop

@push('scripts')
<script src="{{ asset('/js/jquery.sumoselect.min.js') }}"></script>
<script src="{{ asset('/js/winfridge.js') }}"></script>
@endpush