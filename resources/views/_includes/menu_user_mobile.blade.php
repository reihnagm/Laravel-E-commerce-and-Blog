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

    @endif
</div>
