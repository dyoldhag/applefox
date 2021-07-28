@extends('fronts.ar.master', ['page_class' => 'winner-page-ar-template winner'])
@section('meta-title', 'Applefox')
@section('meta-description', '')

@section('header')
<div class="logo text-center"><a href="{{ url('/foxit') }}"><img src="{{ asset('/images/ar/logo-black.svg') }}" alt="Applefox"></a></div>
@stop
@section('main')
<section id="winner" class="d-flex align-items-end justify-content-center">
  <div class="content text-center">
    <h1>YOUR DEETS PLEASE...</h1>    
    
    <form class="needs-validation submit-form foxit-submitdetail-form" enctype="multipart/form-data" novalidate action="{{ url('/foxit-submitdetail') }}" method="POST" role="form" autocomplete="off">
      {{ csrf_field()}}
      <div class="col-12">
        <div class="form-group">
          <label for="name" class="form-label">FULL NAME</label>
          <input type="text" class="form-control" name="name" id="name" placeholder="John Doe" autocomplete="off" value="{{old('name')}}" required>
          <div class="invalid-feedback">Name is required</div>
          @if ($errors->has('name'))
            <span class="invalid-message">{{ $errors->first('name') }} </span>
          @endif
        </div>
      </div>
      <div class="col-12">
        <div class="form-group">
          <label for="icnumber" class="form-label">IC/PASSPORT NUMBER</label>
          <input type="text" class="form-control" name="icnumber" id="icnumber" placeholder="XXXXXX-XX-XXXX"  maxlength="12" autocomplete="off" value="{{old('icnumber')}}" >
          <div class="invalid-feedback invalid-feedback-icnumber">IC Number is required</div>
          @if ($errors->has('icnumber'))
            <span class="invalid-message">{{ $errors->first('icnumber') }} </span>
          @endif
        </div>
      </div>
      <div class="col-12">
        <div class="form-group">
          <label for="phone" class="form-label">Mobile Number</label>
          <div class="input-phonenumber">
            <div class="valuephone-placeholder"><span>(+60)</span><span class="placeholdervalue" >0123456789</span></div>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="0123456789"   maxlength="11" autocomplete="off" value="{{old('phone')}}" required>
          </div>
             
          <div class="invalid-feedback invalid-feedback-phone">Mobile number is required</div>
          @if ($errors->has('phone'))
            <span class="invalid-message">Oops! Mobile number not recognised, please try again.</span>
          @endif
          @if (Session::has('sendSms')) <span class="invalid-message"> {{ Session::get('sendSms') }} </span> @endif 
           
        </div>
      </div>
      <div class="col-12">
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
          <label for="preferred" class="form-label">Mailing Address</label>
          <input type="text" class="form-control" name="street" id="street" placeholder="Street Name" autocomplete="off" value="{{old('street')}}" required>
          <div class="invalid-feedback">Street Name is required</div>
          @if ($errors->has('street'))
            <span class="invalid-message">{{ $errors->first('street') }} </span>
          @endif
        </div>
      </div>
      <div class="col-12">
        <div class="form-group">
          <input type="text" class="form-control" name="city" id="city" placeholder="City / Township" autocomplete="off" value="{{old('city')}}" required>
          <div class="invalid-feedback">City / Township is required</div>
          @if ($errors->has('city'))
            <span class="invalid-message">{{ $errors->first('city') }} </span>
          @endif
        </div>
      </div>
      <div class="col-12">
        <div class="form-group">
          <input type="text" class="fieldnumber form-control" name="postcode" id="postcode" maxlength="6" placeholder="Postcode" autocomplete="off" value="{{old('postcode')}}" required>
          <div class="invalid-feedback">Postcode is required</div>
          @if ($errors->has('postcode'))
            <span class="invalid-message">{{ $errors->first('postcode') }} </span>
          @endif
        </div>
      </div>
 
      
      <div class="col-12 text-center submit-note">By clicking Submit, you agree to our Terms and Conditions and that you
        have read our Privacy Policy. For non-Muslims aged 21 and above only.</div>
      <div class="col-12"><button type="submit" class="btn btn-black">Submit</button></div>
    </form>

    <div class="footer">
        <div class="text-center">ENJOY APPLE FOX™ RESPONSIBLY 
        <div class="footer-policy"><a href="{{ url('privacy-policy') }}">PRIVACY POLICY</a> <span class="footer-policy-border">|</span> <a href="{{ url('/'.$setting->terms_link) }}">{{ $setting->terms_name }}</a></div>
        </div>
    </div>
  </div>
</section>
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
  jQuery('.uploadfiles').on('change keypress keyup', function(e) { 
      valuesite = jQuery('.uploadfiles').val();  
      if(valuesite != '') {
        jQuery(this).hide();
      } else {
        jQuery(this).show();
      }
      // console.log(valuesite); 
      var htmlineinsert = '' ;
      $.each($('.uploadfiles').prop("files"), function(k,v){
         console.log(k); 
         console.log(v); 
          var filename = v['name'];
          htmlineinsert = htmlineinsert+'<div>'+filename +'<span class="removeimage"  data-fclass=".uploadfiles">x</span></div>';
      });
      jQuery('.form-group-uploadfile .list-uploadfiles').append(htmlineinsert);
  });
  jQuery('.uploadfiles2').on('change keypress keyup', function(e) { 
      valuesite = jQuery('.uploadfiles2').val();  
      if(valuesite != '') {
        jQuery(this).hide();
      } else {
        jQuery(this).show();
      }
      // console.log(valuesite); 
      var htmlineinsert = '' ;
      $.each($('.uploadfiles2').prop("files"), function(k,v){
         console.log(k); 
         console.log(v); 
          var filename = v['name'];
          htmlineinsert = htmlineinsert+'<div>'+filename +'<span class="removeimage"  data-fclass=".uploadfiles2">x</span></div>';
      });
      jQuery('.form-group-uploadfile .list-uploadfiles').append(htmlineinsert);
  });

  jQuery(document).on('click','.form-group-uploadfile .list-uploadfiles div .removeimage' , function(e) { 
      valuesite = jQuery(this).data('fclass');  
      jQuery(valuesite).val('');  
      jQuery(valuesite).show();  
      jQuery(this).parent().remove();
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