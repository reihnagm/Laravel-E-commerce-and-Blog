  <div class="_column _is_one_quarter">
      <a href="{{ route('cart.index') }}" id="_cart">
        @if($user->isOwner()) 
        <h2>{{ Cart::count() }}</h2>
        @elseif(!$user->isOwner())
        <h2>{{ Cart::count() }}</h2>
        @endif

        <div id="_cart_wrapper">
            <img src="{{ asset('assets/icon/cart.png')}}">
            @if(!empty(Cart::count()))
            <img id="_fill_of_cart" src="{{ asset('assets/icon/sack.png')}}">
            @endif
        </div>
      </a>

      <div id="_profile_menu">

      @if (!$user->provider)

      {{-- LOGIN WITHOUT SOCIAL MEDIA --}}

      <div class="_is_left">
          <img src="{{ Gravatar::src('wavatar') }}" alt="{{ $user->username }}">
          <h2>{{ $user->username }}</h2>
      </div>

      <ul>
      @if($user->isOwner()) 
      <li><a href="#"> Messages (0)</a></li>
      @forelse ($user->notifications as $notification)
      <li><a href="#"> Notification ({{ $notification->count() }})</a></li>
      @empty
      <li><a href="#"> Notification (0)</a></li>
      @endforelse
      <li><a  target="_blank" href="{{ route('product.create') }}"> Make a Product </a></li>     
      <li><a  target="_blank" href="{{ route('blog.create') }}"> Create a Blog</a></li>
      @endif
      <li><a href="{{route('app.index')}}"> Back to homepage </a></li>
      <li><a href="/social/account/logout/"> Logout </a></li>
      </ul>

      @else

      {{-- LOGIN WITH SOCIAL MEDIA  --}}

      <div class="_is_left">
          <img src="{{ $user->avatar}}" alt="{{ $user->username}}">
          <h2>{{ $user->username }}</h2>
      </div>

      <ul>
        @if($user->isOwner())
        <li><a href="#!"> Messages (0)</a></li>
         @forelse ($notifications as $notification)
         <li><a href="#"> Notification ({{ $notification->count() }})</a></li>
         @empty
         <li><a href="#"> Notification (0)</a></li>
         @endforelse 
         <li><a target="_blank" href="{{ route('product.create') }}"> Make a Product </a></li>     
         <li><a target="_blank" href="{{ route('blog.create') }}"> Create a Blog</a></li>
         @endif
         <li><a href="{{ route('app.index') }}"> Back to homepage </a></li>
         <li><a href="/social/account/logout/"> Logout </a></li>
      </ul>

      @endif 

   </div> {{-- end of PROFILE MENU --}}
  </div> {{-- end of COLUMN --}}