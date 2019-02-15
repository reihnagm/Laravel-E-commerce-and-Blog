<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <title> @yield('title') </title>

  <meta name="author" content="@yield('author')">

  <meta name="description" content="@yield('description')">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  @yield('css')

  <link rel="stylesheet" href="{{ asset('assets/slick/slick-theme.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/slick/slick.css') }}">

  {{-- WITHOUT BOOTSTRAP --}}
  <link rel="stylesheet" href="{{ asset('assets/summernote/dist/summernote-lite.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/css/main/main.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/css/main/css-reset.css') }}">

  <link rel="shortcut icon" href="{{ asset('assets/logo/logo.ico') }}" type="image/x-icon">



  <script>
    window.Laravel = @php echo json_encode([
        'csrfToken' => csrf_token(),
        'auth' => auth() -> check() ? auth() -> check() : null, // CHECK LOGIN
        'auth_id' => auth() -> check() ? auth() -> user() -> id : null, // AUTH USER ID
        'user' => [
          'name' => auth() -> check() ? auth() -> user() -> name : null
        ]
      ]); @endphp

  </script>

</head>

<body>

  <div id="app">
    {{-- HEADER --}}
    @include('_partials/header')

    {{-- CONTENT --}}
    @yield('content')

    {{-- FOOTER --}}
    @include('_partials/footer')
  </div>




  <script src="{{ asset('assets/js/app.js') }}"></script>

  @yield('js')

  <script src="{{ asset('assets/js/main.js') }}"></script>

  {{-- WITHOUT BOOTSTRAP --}}
  <script src="{{ asset('assets/summernote/dist/summernote-lite.js') }}"></script>

  {{-- <script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}"></script> --}}

  <script src="{{ asset('assets/js/jquery-mask-money.js') }}"></script>

  <script src="{{ asset('assets/js/jquery.ticker.min.js') }}"></script>

  {!! Toastr::render() !!}

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

</body>

</html>
