@extends('fronts.ar.master', ['page_class' => 'home'])
@section('meta-title', 'Applefox')
@section('meta-description', '')

@section('header')
<div class="logo text-center"><a href="{{ url('/foxit') }}"><img src="{{ asset('/images/ar/logo-black.svg') }}" alt="Applefox"></a></div>
@stop
@section('main')
<section id="home" class="d-flex align-items-end justify-content-center">
  <div class="content text-center">
    <div class="col-12">  
      <label class="preview">Done with 2020? Well, FOX IT!<br />
      Just follow the fox and find fun. A golden  
      reward may just be yours.</label>
      <a class="btn btn-black" href="{{ url('/foxit-animation') }}">Scan the fox</a>
      <div class="note">(Remember to get an Apple Fox can or bottle ready before you begin.)</div>
      <a class="btn transparent" data-toggle="modal" data-target="#exampleModalCenter">What can I win?</a>
    </div>
    <!-- Modal -->
    <div class="modal fade modal-popup-howtowin" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body ">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            <h2>FOX IT! FOR <br>
              A CHANCE TO WIN!</h2> 
              <div class="gold-fox"><img   src="{{ asset('/images/ar/gold-fox.png') }}" alt="gold fox"></div>
              <div class="gold-fox-title"><h3>3 x gold fox WORTH</h3> <h2>RM6,888<sup>*</sup></h2></div>
              <div class="gold-fox-list">

                <div class="gold-fox-list-item">
                      <div class="gold-fox-item-image"><img   src="{{ asset('/images/ar/popup1.png') }}" alt="popup1.png" width="100"></div>
                      <div class="gold-fox-item-text"> <h3>1000 X</h3> <h2>Tote<br> bag</h2> </div>
                </div>
                <div class="gold-fox-list-item">
                      <div class="gold-fox-item-image"><img   src="{{ asset('/images/ar/popup2.png') }}" alt="popup2.png" width="124"></div>
                      <div class="gold-fox-item-text"> <h3>600 X</h3> <h2>duffel<br> bag</h2> </div>
                </div>
                <div class="gold-fox-list-item">
                      <div class="gold-fox-item-image"><img   src="{{ asset('/images/ar/popup3.png') }}" alt="popup3.png" width="140"></div>
                      <div class="gold-fox-item-text"> <h3>300 X</h3> <h2>Trolley<br> bag</h2> </div>
                </div> 
                <div class="gold-fox-list-item">
                      <div class="gold-fox-item-image"><img   src="{{ asset('/images/ar/popup4.png') }}" alt="popup4.png" width="145"></div>
                      <div class="gold-fox-item-text"><h2><span>3x</span> LG InstaView Fridge </h2> <h4>filled with Apple Fox</h4>
                      <p>Exclusive to<br>
                        <img   src="{{ asset('/images/ar/popup4-1.png') }}" alt="popup4-1.png" width="124">
                        <br>customers.</p>
                      </div>
                </div> 
                <p class="t-c-apply">*Terms & Conditions Apply</p>
              </div>

              <div class="popup-how-to-win"> 
                      <h2>HOW TO WIN: </h2>

                      <div class="popup-how-to-win-item"> 
                            <h3>1. Scan the fox on our<br> can or bottle.</h3>
                            <div class="how-to-win-item-image"><img   src="{{ asset('/images/ar/popup-scan.png') }}" alt="scan" width="84"></div>
                      </div>
                      <div class="popup-how-to-win-item"> 
                            <h3>2. Count the number<br> of foxes.</h3>
                            <div class="how-to-win-item-image"><img   src="{{ asset('/images/ar/popup-icon-count.png') }}" alt="icon-count" width="124"></div>
                      </div>
                      <div class="popup-how-to-win-item"> 
                            <h3>3. Fill in your details and<br> upload your receipt.</h3>
                            <p>(Double your number of entries with every purchase of 2 Apple Fox!)</p>
                            <div class="how-to-win-item-image"><img   src="{{ asset('/images/ar/popup-icon-details.png') }}" alt="icon-details" width="90"></div>
                      </div>

                </div>


          </div>
        </div>
      </div>
    </div>


    <div class="footer">
        <img class="tagline-white" src="{{ asset('/images/ar/tagline-white.png') }}" alt="Quench Your Curiosity">
        <div class="text-center">ENJOY APPLE FOX™ RESPONSIBLY 
        <div class="footer-policy"><a href="{{ url('privacy-policy') }}">PRIVACY POLICY</a> <span class="footer-policy-border">|</span> <a href="{{ url('/'.$setting->terms_link) }}">{{ $setting->terms_name }}</a></div>
        </div>
    </div>
  </div>
</section>
@stop