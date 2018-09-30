<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

  <title> @yield('title') </title>

  <meta name="description" content="@yield('desc')">

  <meta name="author" content=" @yield('author')">

  {{-- CSRF TOKEN --}}
  <meta name="token" content="{{ csrf_token() }}">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

   @yield('css')

  {{-- slick theme css --}}
  <link rel="stylesheet" href="{{ asset('assets/slick/slick-theme.css') }}">

  {{-- slick css --}}
  <link rel="stylesheet" href="{{ asset('assets/slick/slick.css') }}">

  <!--  summernote lite css  -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css" rel="stylesheet">

  {{-- main css --}}
  <link rel="stylesheet" href="{{ asset('assets/css/main/main.css') }}"> 

  {{-- css reset --}}
  <link rel="stylesheet" href="{{ asset('assets/css/main/css-reset.css') }}">

  {{-- favicon --}}
  <link rel="icon" href="{{ asset('assets/logo/logo.png') }}">


  <script>
      window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => [
                'username' => auth()->check() ? auth()->user()->username : null
            ]
        ]) !!};
  </script>

</head>

<body>

  <div id="app">
 
    @include('_partials/header')

    @yield('content')
    
  </div>

  {{-- App js --}}
  <script src="{{ asset('assets/js/app.js') }}"></script>

  {{-- Main js --}}
  <script src="{{ asset('assets/js/main.js') }}"></script>

  {{-- Toaster render --}}
  {!! Toastr::render() !!}

  {{-- summernote lite js --}}
   <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js"></script>

  {{-- Jquey mask money --}}
  <script src="{{ asset('assets/js/jquery-mask-money.js') }}"></script>

  
  {{-- Jquey Ticker --}}
  <script src="{{ asset('assets/js/jquery.ticker.min.js') }}"></script>


  {{-- ChartJs --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

  {{-- Stripe --}}
  {{-- <script src="https://js.stripe.com/v3/"></script> --}}
   
  @yield('js')

 </body>
</html>
