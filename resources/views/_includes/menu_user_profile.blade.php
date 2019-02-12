@include('_includes/menu_user_mobile')

@php
  $draft = \App\Models\Blog::where("user_id", auth()->user()->id)->where("draft", 1)->count();
@endphp

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

<hr class="hidden-in-mobile">

<div class="profile-menu">

 @if(empty($user['provider']))

    @if(auth()->check())
    <div class="is-left">
     <avatar :auth_user="{{ auth()->check() }}" :avatar_user="{{ "'". showImage($user['avatar']) ."'" }}" :avatar_gravatar="{{ "'". Gravatar::src('wavatar') ."'" }}" :user_id="{{ $user['id'] }}"></avatar>
    </div>
    <ul>
      @if(Auth::user()->id == $user['id'])
      <li> <h3> <a href="{{ route('user.profile') }}"> {{ $user['name'] }}  </a></h3> </li>
      <br>
      <li><a href="{{ route('chat.index') }}" target="_blank"> Chat </a></li>
      <li><a href="{{ route('order.index') }}" target="_blank"> Orders </a></li>
      <li><a href="{{ route('notifications.index')}}" target="_blank" class="see-notif"> Notification ({{ Auth::user()->notifications->where('seen', 0)->count() }})</a></li>
      <li><a href="{{ route('product.create') }}" target="_blank"> Create your own Product </a></li>
      <li><a href="{{ route('blog.create') }}" target="_blank"> Create a Blog</a></li>

      <li><a href="{{ route('blog.draft') }}" target="_blank"> Draft ({{$draft}}) </a></li>
      <li><a href="{{ route('home') }}" target="_blank"> Back to homepage </a></li>
      <li><a href="{{ route('social.logout') }}"> Logout </a></li>
      @endif
    @endif
    @if(auth()->guest())
    <avatar :avatar_user="{{ "'". showImage($user['avatar']) ."'" }}" :avatar_gravatar="{{ "'". Gravatar::src('wavatar') ."'" }}" :user_id="{{ $user['id'] }}"></avatar>
    <li> <h3> {{ $user['name'] }} </h3> </li>
    <li><a href="{{ route('home') }}"> Back to homepage </a></li>
    @endif
   </ul>

  @else

  <div class="is-left">
  <avatar :auth_user="{{ auth()->check() }}" :avatar_user="{{ "'". showImage($user['avatar']) ."'" }}" :avatar_gravatar="{{ "'". Gravatar::src('wavatar') ."'" }}" :user_id="{{ $user['id'] }}"></avatar>
  </div>
  @if(auth()->check())
  <ul>
    @if(Auth::user()->id == $user['id'])
    <li> <h3> <a href="{{ route('user.profile') }}"> {{ $user['name'] }}  </a> </h3> </li>
    <li><a href="{{ route('chat.index') }}" target="_blank"> Chat </a></li>
    <li><a href="{{ route('notifications.index')}}" target="_blank" class="see-notif"> Notification ({{ auth()->user()->notifications->where('seen', 0)->count() }})</a></li>
    <li><a href="{{ route('product.create') }}" target="_blank"> Create your own Product </a></li>
    <li><a href="{{ route('blog.create') }}" target="_blank"> Create a Blog</a></li>
    <li><a href="{{ route('blog.draft') }}" target="_blank"> Draft ({{$draft}}) </a></li>
    <li><a href="{{ route('home') }}" target="_blank"> Back to homepage </a></li>
    <li><a href="{{ route('social.logout') }}"> Logout </a></li>
    @endif
   @if(auth()->guest())
   <avatar :auth_user="{{ auth()->check() }}" :avatar_user="{{ "'". showImage($user['avatar']) ."'" }}" :avatar_gravatar="{{ "'". Gravatar::src('wavatar') ."'" }}" :user_id="{{ $user['id'] }}"></avatar>
   <li> <h3> {{ $user['name'] }} </h3> </li>
   <li><a href="{{ route('home') }}" target="_blank"> Back to homepage </a></li>
   @endif
  </ul>
  @endif

  @endif

</div>
