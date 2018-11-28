<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <title> @yield('title') </title>

  <meta name="description" content="@yield('desc')">

  <meta name="author" content=" @yield('author')">

  <meta name="token" content="{{ csrf_token() }}">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

   @yield('css')

  <link rel="stylesheet" href="https://unpkg.com/nprogress@0.2.0/nprogress.css">

  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" >

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css" >

  <link rel="stylesheet" href="{{ asset('assets/slick/slick-theme.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/slick/slick.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/css/main/main.css') }}"> 

  <link rel="stylesheet" href="{{ asset('assets/css/main/css-reset.css') }}">
 
  <link rel="icon" href="{{ asset('assets/logo/logo.ico') }}">

  <script src="https://js.stripe.com/v3/"></script>

  <script>
      window.Laravel = {!! json_encode([
            'token' => csrf_token(),
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
    @include('_partials/footer')
  </div>

  @yield('js')
  
  <script src="{{ asset('assets/js/app.js') }}"></script>
  
  <script src="{{ asset('assets/js/main.js') }}"></script>

  <script src="{{ asset('assets/js/jquery-mask-money.js') }}"></script>
   
  <script src="{{ asset('assets/js/jquery.ticker.min.js') }}"></script>

  {!! Toastr::render() !!}

  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" ></script>

  <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>

 </body>
</html>
