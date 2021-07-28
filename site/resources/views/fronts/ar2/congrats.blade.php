@extends('fronts.ar.master', ['page_class' => 'page-ar-template congrats'])
@section('meta-title', 'Applefox')
@section('meta-description', '')

@section('header')
<div class="logo text-center"><a href="{{ url('/foxit') }}"><img src="{{ asset('/images/ar/logo-black.svg') }}" alt="Applefox"></a></div>
@stop
@section('main')
<section id="congrats" class="d-flex align-items-end justify-content-center page-ar-template-content">
  <div class="content text-center">
    <h1>FOX IT! CLAIM YOUR
FREE APPLE FOX CIDER.</h1>    
<h3 style="font-size: 20px;    font-family: Veneer, sans-serif;">Where would you like to redeem from?</h3>
      
<?php 
    // print_r($outlets);
    $stringvar = '';
    $ii = 0 ;
    foreach ($outlets as $outlet)  {
        //echo $outlet->name ; 
        if($ii == 0) {
            $stringvar .= "{'name' : '".$outlet->name."','hmb_region' : '".$outlet->hmb_region."', 'state' : '".$outlet->state."' , 'outlet_code' : '".$outlet->outlet_code."' }"; 
            $ii++; 
        } else {
            $stringvar .= ",{'name' : '".$outlet->name."','hmb_region' : '".$outlet->hmb_region."', 'state' : '".$outlet->state."' , 'outlet_code' : '".$outlet->outlet_code."' }"; 
        } 
    }  
?> 
<script>
    var data_outlets = [
        <?php echo $stringvar; ?>
    ];
   // console.log(data_outlets);
</script>    
    <form id="form-congrats" class="needs-validation submit-form" novalidate action="{{ url('/foxit-congrats') }}" method="POST" role="form" autocomplete="off">
      {{ csrf_field()}}
      <div class="container-full">
        <div class="input-group-congrats">
              @if (Session::has('voucher_limited_msg')) <span class="invalid-message"> {{ Session::get('voucher_limited_msg') }} </span> @endif 
              <div class="congrats-item-field-container">
                <label>STATE</label>
                    <div class="congrats-item-field">
                        <input type="text" id="state" name="state" value="" placeholder="select state" readonly>
                        <span class="dropdownlist"></span>
                        <div id="state-list" class="dropdownlist-content">
                            
                        </div>
                    </div>
              </div>
              <div class="congrats-item-field-container">
                <label>OUTLET</label>
                    <div class="congrats-item-field">
                        <input type="text" id="outlet" name="outlet" value="" placeholder="select outlet" readonly>
                        <span class="dropdownlist"></span>
                        <div id="outlets-list" class="dropdownlist-content">
                          
                        </div>
                    </div>
              </div>
        </div>
      </div>
      <div  class="preview">Redemption dates:<br>
      24–25 October: Hypermarkets & Supermarkets<br>
      23–25 October: Pubs, Bars & Restaurants<br><br>

      "Pssst! Some rules are not meant to be bent. Don't forget to follow all SOPs for areas under CMCO and stay safe!"<br>
      </div>
      <div class="col-12"><span   id="submit-congrats" class="btn btn-black">CONTINUE</span></div>
    </form>


  </div>
</section>
<div class="footer">
        <div class="text-center">ENJOY APPLE FOX™ RESPONSIBLY 
        <div class="footer-policy"><a href="{{ url('privacy-policy') }}">PRIVACY POLICY</a> <span class="footer-policy-border">|</span> <a href="{{ url('/'.$setting->terms_link) }}">{{ $setting->terms_name }}</a></div>
        </div>
    </div>
@stop