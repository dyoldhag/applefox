<div class="header">
  <div class="bar collapsed" data-toggle="collapse" data-target="#navbarSupportedContent"></div>
  <nav class="navbar navbar-light"><!-- navbar-expand-md -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav m-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{ url('/QuenchYourCuriosity') }}">Home <span class="sr-only">Home</span></a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" href="{{ url('/winfridge') }}">Win a fridge</a>
        </li> --}}
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/confirmwin') }}">Confirm win</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/freebag') }}">Bag giveaway</a>
        </li>
        @if(empty($setting->section5_comingsoon))
        <li class="nav-item">
          <a class="nav-link" href="{{ $setting->section5_link }}" target="_bank">Drinkies deals</a>
        </li>
        @endif
      </ul>
      <div class="nav-bottom">
          ENJOY APPLE FOX™ RESPONSIBLY<br />
          <a href="{{ url('/'.$setting->terms_link) }}">{{ $setting->terms_name }}</a>
      </div>
    </div>
  </nav>
</div>