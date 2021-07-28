<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1, maximum-scale=1, minimum-scale=1, shrink-to-fit=no">

      <title>@yield('meta-title')</title>
      <meta name="description" content="@yield('meta-description')"/>

      <meta property="og:url" content="{{ asset('/') }}" />
      <meta property="og:type" content="article" />
      <meta property="og:title" content="" />
      <meta property="og:description" content="" />
      <meta property="og:image" content="{{ asset('/images/shared-fb-img.jpg') }}" />
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      @yield('preload')
      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
      <link rel="shortcut icon" href="{{ asset('/public/favicon.ico') }}" type="image/x-icon"/>
      {{-- Style partials --}}
      @yield('styles')

      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-168089385-1"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-168089385-1'); // UA-168089385-1
      </script>
    </head>
    <body class="{{$page_class or ''}}">
      @empty (Request::is('age-gate'))
        @include('fronts.partials._menu')
      @endempty
      
      <div class="background">
        {{-- Include header --}}
        @include('fronts.partials._header')

        {{-- Main section --}}
        @yield('main')

        {{-- Include footer --}}
        @include('fronts.partials._footer')
      </div>
      @yield('modal')
      {{-- Scripts section --}}
      @yield('external-scripts')
      <script src="{{ asset('js/app.js') }}"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
      @stack('scripts')
    </body>
</html>
