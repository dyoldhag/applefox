@extends('fronts.ar.master', ['page_class' => 'page-ar-template'])
@section('meta-title', 'Applefox')
@section('meta-description', '')

@section('header')
<div class="logo text-center"><a href="{{ url('/foxit') }}"><img src="{{ asset('/images/ar/logo-black.svg') }}" alt="Applefox"></a></div>
@stop
@section('main')
<section id="Confirmation" class="d-flex  justify-content-center page-ar-template-content">
  <div class="content text-center">
  <h1>YOUR VOUCHER IS ON THE WAY!</h1>
<h3 style="font-size: 20px;    font-family: Veneer, sans-serif;    margin-bottom: 10px;">Keep an eye out for an email/text message containing your voucher code.<h3>
    <div class="col-12-div-text">
        <form id="form-redeem-now" action="{{ url('/foxit-confirmation-code') }}" method="POST" role="form" autocomplete="off">
             {{ csrf_field()}}
            <div class="congrats-item-field confirmation-ar2-code"> 
                    
                    
            </div> 
            <div class="confirmation-ar2-text">
                 <label class="preview">Still waiting? Don't forget to check your junk or spam folders too!</label>
                <a href="{{ url('redeem') }}" id="redemption-submit" class="btn btn-black" >Redeem now</a>
                <a class="btn transparent black" href="https://www.drinkies.my/cider">SEE OTHER PROMOS</a> 
            </div> 
        </form>
    </div> 

  
  </div>
</section>
<div class="footer"> 
        <div class="text-center">ENJOY APPLE FOX™ RESPONSIBLY 
        <div class="footer-policy"><a href="{{ url('privacy-policy') }}">PRIVACY POLICY</a> <span class="footer-policy-border">|</span> <a href="{{ url('/'.$setting->terms_link) }}">{{ $setting->terms_name }}</a></div>
        </div>
    </div>
@stop