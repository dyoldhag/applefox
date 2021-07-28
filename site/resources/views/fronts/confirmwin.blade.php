@extends('fronts.layouts.master', ['page_class' => 'confirmwin'])
@section('meta-title', 'Confirm Win | Quench Your Curiosity')
@section('meta-description', '')

@section('header')
<div class="logo text-center"><a href="{{ url('/QuenchYourCuriosity') }}"><img src="{{ asset('/images/logo.svg') }}" alt="Applefox"></a></div>
@stop
@section('main')
<div id="confirmwin">
  <div class="board text-center">
    <div class="board-text">
      <label>CONFIRM Win<sup>*</sup></label>
      <span>with</span>Apple fox
    </div>
    @if($prizes)
    <ul class="board-prizes">
      @foreach($prizes as $index => $value)
      <li class="board-prizes-{{ $index }}">
        <div class="board-prizes-img board-prizes-img{{ $index }}"><img src="{{ asset($value['image']) }}" alt="{{ $value['name'] }}"></div>
        <label>{{ $value['name'] }}</label>
      </li>
      @endforeach
    </ul>
    @endif
    <div class="board-preview">{!!html_entity_decode($setting->confirmwin_board_preview)!!}</div>
    <div class="board-note">{!!html_entity_decode($setting->confirmwin_board_note)!!}</div>
  </div>
  <div class="content text-center">
    <div class="wrap">
      <h1>{{ $setting->confirmwin_title }}</h1>
      <div class="title-note">{!!html_entity_decode($setting->confirmwin_preview)!!}</div>
      <form class="needs-validation submit-form" novalidate action="{{ url('/confirmwin') }}" method="POST" role="form" enctype="multipart/form-data" autocomplete="off">
      {{ csrf_field()}}
        <div class="form-row">
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="name" class="form-label">FULL NAME</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="John Doe" autocomplete="off" value="{{old('name')}}" required>
              <div class="invalid-feedback">Name is required</div>
              @if ($errors->has('name'))
                <span class="invalid-message">{{ $errors->first('name') }} </span>
              @endif
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="icnumber" class="form-label">IC Number</label>
              <input type="text" class="form-control" name="icnumber" id="icnumber" placeholder="XXXXXX-XX-XXXX" pattern=".{14,}" maxlength="14" autocomplete="off" value="{{old('icnumber')}}" required>
              <div class="invalid-feedback invalid-feedback-icnumber">IC Number is required</div>
              @if ($errors->has('icnumber'))
                <span class="invalid-message">{{ $errors->first('icnumber') }} </span>
              @endif
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="phone" class="form-label">Mobile Number</label>
              <input type="text" class="form-control" name="phone" id="phone" placeholder="012-3456789" pattern=".{11,}" maxlength="12" autocomplete="off" value="{{old('phone')}}" required>
              <div class="invalid-feedback invalid-feedback-phone">Mobile number is required</div>
              @if ($errors->has('phone'))
                <span class="invalid-message">{{ $errors->first('phone') }} </span>
              @endif
            </div>
          </div>
          <div class="col-12 col-md-6">
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
          <div class="col-12 col-md-6">
            <div class="form-group">
              <input type="text" class="form-control" name="city" id="city" placeholder="City / Township" autocomplete="off" value="{{old('city')}}" required>
              <div class="invalid-feedback">City / Township is required</div>
              @if ($errors->has('city'))
                <span class="invalid-message">{{ $errors->first('city') }} </span>
              @endif
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Postcode" autocomplete="off" value="{{old('postcode')}}" required>
              <div class="invalid-feedback">Postcode is required</div>
              @if ($errors->has('postcode'))
                <span class="invalid-message">{{ $errors->first('postcode') }} </span>
              @endif
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <label class="form-label">upload receipt</label>
              <div class="upload-note">File must be less than 6MB and in a .jpeg, .jpg or .png format.</div>
              <label for="image" class="choose-file"></label>
              <input type="file" name="image" id="image" accept="image/*" onchange="ShowPreviewImg(this)" autocomplete="off" value="{{old('image')}}" required>

              <div class="invalid-feedback invalid-feedback-file">File is required</div>
            </div>
            <div class="box-picture">
              <img id="PictureView" src="{{ asset('/images/apple.svg') }}" />
            </div>
          </div>

          
          <div class="col-12 text-center submit-note">{!!html_entity_decode($setting->confirmwin_note)!!}</div>
          <div class="col-12"><button type="submit" class="btn btn-black">Submit</button></div>
        </div>

      </form>

      <div class="confirmwin-footer">
        <img src="{{ asset('/images/confirmwin-footer.png') }}" alt="Applefox product">
      </div>
    </div>
  </div>
</div>

<div class="page-footer-second text-center">ENJOY APPLE FOX™ RESPONSIBLY 
  <a href="{{ url('/'.$setting->terms_link) }}">{{ $setting->terms_name }}</a>
</div>
@stop

@push('scripts')
<script src="{{ asset('/js/confirmwin.js') }}"></script>
<script>
  function ShowPreviewImg(picture)
  {
    if(picture.files[0].size>6291456) {
      $(".invalid-feedback-file").html("File size is greater than 2MB").show();
      $("#image").val("");
      $('#PictureView').attr('src', '/images/apple.svg');
      return false;
    } 
    var ext = picture.value.split(".");
    ext = ext[ext.length-1].toLowerCase();  
    var arrayExtensions = ["jpg" , "jpeg", "png"];
    if (arrayExtensions.lastIndexOf(ext) == -1) {
      $('.invalid-feedback-file').html('Wrong extension type.').show();
      $("#image").val("");
      $('#PictureView').attr('src', '/images/apple.svg');
      return false;
    }

    $('#PictureView').attr('src', picture.value);
    if (picture.files && picture.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#PictureView').attr('src', e.target.result);
      }
      reader.readAsDataURL(picture.files[0]);
      $('.invalid-feedback-file').hide();
    }
  }
</script>
@endpush