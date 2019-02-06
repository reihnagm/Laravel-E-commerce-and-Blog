<div class="hamburger-menu">
  <span class="bar1"></span>
  <span class="bar2"></span>
  <span class="bar3"></span>
</div>

<div class="mobile-nav-menu">

  <a class="cart hidden-in-mobile" href="{{ route('checkout.index') }}">
    @if(auth()->check())
    <h2 class="cart-count">{{ Cart::instance('default')->count() }}</h2>
    <div class="cart-wrapper">
      <img class="cart-img" src="{{ asset('assets/icon/cart.png')}}">
      @if(!empty(Cart::instance('default')->count()))
      <img class="fill-of-cart" src="{{ asset('assets/icon/sack.png')}}">
      @endif
    </div>
    @endif
  </a>

 <a class="cart hidden-in-mobile" href="{{ route('guestCheckout') }}">
  @if(auth()->guest())
  <h2 class="cart-count"> {{ Cart::instance('guest')->count() }} </h2>
  <div class="cart-wrapper">
    <img class="cart-img" src="{{ asset('assets/icon/cart.png')}}">
    @if(!empty(Cart::instance('guest')->count()))
    <img class="fill-of-cart" src="{{ asset('assets/icon/sack.png')}}">
    @endif
  </div>
  @endif
</a>

  @if(auth()->check())
   @if (empty(auth()->user()->provider))

  <div class="is-left">
    <img class="profile-menu-ava" src="{{ Gravatar::src('wavatar') }}" alt="{{ auth()->user()->name }}">
    <h2 class="profile-menu-users-username"> <a href="{{ route('user.profile') }}"> {{ auth()->user()->name }} </a> </h2>
  </div>

  <ul class="mobile-menu">
    @if(auth()->check())
    <li><a target="_blank" href="{{ route('chat.index') }}"> Chat </a></li>
    <li><a target="_blank" href="{{ route('notifications.index')}}" class="see-notif"> Notification ({{ auth()->user()->notifications->where('seen', 0)->count() }}) </a></li>
    <li><a target="_blank" href="{{ route('product.create') }}"> Create your own Product </a></li>
    <li><a target="_blank" href="{{ route('blog.create') }}"> Create a Blog</a></li>
    @endif
    @if(auth()->guest())
    <li><a href="/"> Back to homepage </a></li>
    @endif
  </ul>

  @else

  <div class="is-left">
    <img class="profile-menu-ava" src="#!" alt="{{ auth()->user()->name }}">
    <h2 class="profile-menu-users-username"> <a href="{{ route('user.profile') }}"> {{ auth()->user()->name }} </a> </h2>
  </div>

  <ul class="mobile-menu">
    @if(auth()->check())
    <li><a href=" {{ route('chat.index') }}" target="_blank"> Chat </a></li>
    <li><a target="_blank" href="{{ route('notifications.index') }}" class="see_notif"> Notification ({{ auth()->user()->notifications->where('seen', 0)->count() }})</a></li>
    <li><a target="_blank" href="{{ route('product.create') }}"> Create your own Product </a></li>
    <li><a target="_blank" href="{{ route('blog.create') }}"> Create a Blog</a></li>
    <li><a target="_blank" href="{{ route('social.logout') }}"> Logout </a></li>
    @endif
    @if(auth()->guest())
    <li><a href="{{ route('home') }}"> Back to homepage </a></li>
    @endif
  </ul>

  @endif
  @else

  <form id="form-login-mobile" action="{{ route('login') }}" method="POST">
    @csrf

    <div class="field">
      <input type="text" name="email" placeholder="E-Mail Address">

      @if ($errors->has('email'))
      <span class="is-error">{{ $errors->first('email') }}</span>
      @endif

      <div class="wrapper-input-password">
        <input id="password-field-mobile" type="password" name="password" placeholder="Password"> <i toggle="#password_field_mobile" class="_eye_icon"> </i>
      </div>

      @if ($errors->has('password'))
      <span class="is-error">{{ $errors->first('password') }}</span>
      @endif
      <br>
      <a class="button" onclick="event.preventDefault(); document.getElementById('form-login-mobile').submit();">Login </a>
    </div>

    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
    <label for="remember"> Remember Me </label>
  </form>

  <span> don't have a account? </span>

  <div class="panel">
    <form action="{{ route('register')}}" method="POST">
      @csrf

      <div class="field">
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Name">

        @if ($errors->has('name'))
        <span class="is-error">{{ $errors->first('username') }}</span>
        @endif

        <input type="text" name="email" value="{{ old('email') }}" placeholder="E-Mail Address">

        @if ($errors->has('email'))
        <span class="is-error">{{ $errors->first('email') }}</span>
        @endif

        <div class="wrapper-input-password">
          <input id="password-field-register-mobile" type="password" name="password" placeholder="Password"> <i toggle="#password_field_register_mobile" class="eye-icon"> </i>
        </div>

        @if ($errors->has('password'))
        <span class="is-invalid">{{ $errors->first('password') }}</span>
        @endif

        <div class="wrapper-input_password">
          <input id="password-field-confirmation-mobile" type="password" name="password-confirmation" placeholder="Password Confirmation"> <i toggle="#password-field-confirmation-mobile" class="eye-icon"> </i>
        </div>

        @if ($errors->has('password-confirmation'))
        <span class="is-error">{{ $errors->first('password-confirmation') }}</span>
        @endif

        <input class="button" type="submit" value="Submit Register">
      </div>

    </form>
  </div>

  <a id="trigger-button-register" class="accordion button"> Register </a>
  <br>
  <a id="google-wrapper" class="button" href="redirect/google"><i id="google-icon"></i>Log in with Google</a>
  <a id="facebook-wrapper" class="button" href="redirect/facebook"> <i id="facebook-icon"></i>Log in with Facebook</a>
  @endif

</div>
