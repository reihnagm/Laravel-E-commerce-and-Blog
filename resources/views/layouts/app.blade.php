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

  {{-- intl-tel-input css --}}
  <link rel="stylesheet" href="{{ asset('assets/css/intTelInput/intlTelInput.min.css') }}">

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

</head>
<script>
    window.Laravel = @php echo json_encode([
        'token' => csrf_token(),
        'user' => [
          'username' => auth()->check() ? auth()->user()->username : null,
          'id' => auth()->check() ? auth()->user()->id : null,
        ]
    ]); @endphp;
 </script>
<body>
  <div id="app">

    @include('_partials/header')

    @yield('content')

  </div>

  {{-- Main js --}}
  <script src="{{ asset('assets/js/app.js') }}"></script>

  {{-- Toaster render --}}
  {!! Toastr::render() !!}

  {{-- summernote lite js --}}
   <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js"></script>

  {{-- Jquey dialog --}}
  <script src="{{ asset('assets/js/jquery-dialog.js') }}"></script>

  {{-- Jquey mask money --}}
  <script src="{{ asset('assets/js/jquery-mask-money.js') }}"></script>

  {{-- ChartJs --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>


  {{-- Stripe --}}
  {{-- <script src="https://js.stripe.com/v3/"></script> --}}

  <script>
   
    $(document).ready(function() {

    $("#phone").intlTelInput()
    
    // summernote
    $('#summernote').summernote();

    // banner
    $("._banner").slick({
      dots: true,
      adaptiveHeight: true
    });

    // password eye
    $("._eye_icon").click(function() {
      $(this).toggleClass("_eye_icon _eye_icon_slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } 
      else 
      {
        input.attr("type", "password");
      }
    });

    // mode price money input text
    $("input[class='_inputfile']").change(function() {
      $(this).html($(this).val());
    });

    // config jquery mask money
    $("#_price").maskMoney({
        thousands:',',
        decimal:'.',
        affixesStay: false
      });

    });

  </script>
 
  @yield('js')

</body>
</html>
