@extends('fronts.ar.master', ['page_class' => 'page-ar-template redemption'])
@section('meta-title', 'Applefox')
@section('meta-description', '')

@section('header')
<div class="logo text-center"><a href="{{ url('/foxit') }}"><img src="{{ asset('/images/ar/logo-black.svg') }}" alt="Applefox"></a></div>
@stop
@section('main')
<section id="redemption" class="d-flex align-items-end justify-content-center page-ar-template-content">
  <div class="content text-center">
    <h1>Ready to claim your free Apple Fox Cider?</h1>     
 
    <form id="form-redemption" class="needs-validation submit-form" novalidate action="{{ url('/redeem') }}" method="POST" role="form" autocomplete="off">
      {{ csrf_field()}}
      <div class="container-full">
        <div class="input-group-congrats">
              <div class="congrats-item-field-container">
                <label>Your voucher code</label>
                    <div class="congrats-item-field">
                        <input type="text" class="fieldnumber @if (Session::has('error')) {{Session::get('error')}} @endif " id="voucher" name="voucher" value="" maxlength="6" placeholder="6-digit code"> 
                    </div>
              </div>
              <div class="congrats-item-field-container">
                <label>Outlet code</label>
                    <div class="congrats-item-field">
                        <input type="text" class="fieldnumber @if (Session::has('error')) {{Session::get('error')}} @endif " id="outletcode" name="outletcode" value="" maxlength="6" placeholder="6-digit code"> 
                    </div>
              </div>
        </div>
      </div>
      <div  class="preview">(Contact outlet staff for code.)  </div>
      <div class="col-12"><span   id="submit-redemption" class="btn btn-black">SUBMIT</span></div>

       @if (Session::has('error')) <p class="redemption-error">Oops! Invalid code.</p> @endif 
    </form>


  </div>
</section>
<div class="footer">
        <div class="text-center">ENJOY APPLE FOX™ RESPONSIBLY 
        <div class="footer-policy"><a href="{{ url('privacy-policy') }}">PRIVACY POLICY</a> <span class="footer-policy-border">|</span> <a href="{{ url('/'.$setting->terms_link) }}">{{ $setting->terms_name }}</a></div>
        </div>
    </div>
@stop