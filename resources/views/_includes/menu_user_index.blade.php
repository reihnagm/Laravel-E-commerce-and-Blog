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

<br>

@if(!empty(Cart::count()) && auth()->guest())
	<a href="{{ route('guestCheckout') }}" class="checkout-as-guest"> Checkout as guest </a>
@endif

<hr class="hidden-in-mobile">

@if(auth()->check())
<nav class="nav">
  @if(empty(auth()->user()->provider))
  <ul>
    <li>
      @if(auth()->user()->avatar)
      <img class="profile-menu-ava" src="{{ showImage(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}" style="width:100px">
      @else
      <img class="profile-menu-ava" src="{{ Gravatar::src('wavatar') }}" alt="{{ auth()->user()->name }}">
      @endif
    </li>
    <li><a href="{{ route('user.profile') }}">My Profile</a></li>
    <li><a href="{{ route('social.logout') }}">Logout</a></li>
  </ul>

  @else
  <ul>
    <li><img class="profile-menu-ava" src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}"></li>
    <li><a href="{{ route('user.profile') }}">My Profile</a></li>
    <li><a href="{{ route('social.logout') }}">Logout</a></li>
  </ul>
</nav>
@endif

@else

<nav class="nav">
  <login></login>

  <a href="{{ route('password.request') }}">Forgot your Password ?</a>
  <br> <br>
  <span> Don't have a Account ? </span> <br>

  <register></register>

  <a id="google-wrapper" class="button" href="redirect/google"> <i id="google-icon"></i>Log in with Google</a>
  <a id="facebook-wrapper" class="button" href="redirect/facebook"> <i id="facebook-icon"></i>Log in with Facebook</a>
</nav>

@endif

</div>
