 <div class="_column _is_one_quarter">

        <div class="_hamburger_menu">
          <span class="bar1"></span> 
          <span class="bar2"></span>
          <span class="bar3"></span>
        </div>

        <div class="_mobile_nav_menu">
     
             <a href="{{ route('cart.index') }}" class="_cart">
                @if($user['id'] === Auth::user()->id) 
                 <h2 class="_cart_count">{{ Cart::count() }}</h2>
                @elseif(!$user->isOwner())
                 <h2 class="_cart_count">{{ Cart::count() }}</h2>
                @endif

                <div class="_cart_wrapper">
                      <img class="_cart_img" src="{{ asset('assets/icon/cart.png')}}">
                    @if(!empty(Cart::count()))
                      <img class="_fill_of_cart" src="{{ asset('assets/icon/sack.png')}}">
                    @endif
                </div>
              </a> 

             <hr>

           @if (!$user['provider'])

            {{-- LOGIN WITHOUT SOCIAL MEDIA --}}

            <div class="_is_left">
              <img class="_profile_menu_ava" src="{{ Gravatar::src('wavatar') }}" alt="{{ $user['username'] }}">
               <h2  class="_profile_menu_users_username">
                <a href="{{ route('user.profile') }}"> {{ $user['username'] }} </a>
              </h2>
            </div>  

            <ul>
              @if($user->id === Auth::user()->id) 
              <li><a href="/chat" target="_blank"> Chat </a></li> <br>
              <li><a class="_see_Notif" target="_blank" href="{{ route('notifications.index')}}"> Notification ({{ Auth::user()->notifications->where('seen', 0)->count() }})</a></li>
              <li><a  target="_blank" href="{{ route('product.create') }}" style="line-height: 30px;"> Create your own Product </a></li>   
              <li><a  target="_blank" href="{{ route('blog.create') }}"> Create a Blog</a></li>
              @endif
              <li><a href="{{ route('app.index') }}"> Back to homepage </a></li> 
              <li><a href="/social/account/logout/"> Logout </a></li> 
             </ul>

            @else

            {{-- LOGIN WITH SOCIAL MEDIA  --}}

            <div class="_is_left">
                <img class="_profile_menu_ava" src="{{ $user['avatar'] }}" alt="{{ $user['username']}}">
              <h2  class="_profile_menu_users_username">
                <a href="{{ route('user.profile') }}"> {{ $user['username'] }} </a>
              </h2>
            </div>

            <ul>
              @if($user['id'] === Auth::user()->id)
              <li><a href="/chat" target="_blank"> Chat </a></li>
              <li><a class="_see_Notif" target="_blank" href="/notification"> Notification ({{ Auth::user()->notifications->where('seen', 0)->count() }})</a></li>
              <li><a target="_blank" href="{{ route('product.create') }}" style="line-height: 30px;"> Create your own Product </a></li>     
              <li><a target="_blank" href="{{ route('blog.create') }}"> Create a Blog</a></li>
              @endif
              <li><a href="{{ route('app.index') }}"> Back to homepage </a></li>
              <li><a href="/social/account/logout/"> Logout </a></li>
            </ul>
           @endif 
                 
       </div>

      <a class="_cart _hidden_in_mobile" href="{{ route('cart.index') }}">
       @auth
         <h2 class="_cart_count">{{ Cart::count() }}</h2>

          <div class="_cart_wrapper">
            <img class="_cart_img" src="{{ asset('assets/icon/cart.png')}}">
            @if(!empty(Cart::count()))
            <img class="_fill_of_cart" src="{{ asset('assets/icon/sack.png')}}">
            @endif
          </div>
        @endauth
        @guest
          <h2 class="_cart_count"> 0 </h2>

          <div class="_cart_wrapper">
            <img class="_cart_img" src="{{ asset('assets/icon/cart.png')}}">
          </div>
        @endguest
      </a> 

      <hr class="_hidden_in_mobile">

      <div class="_profile_menu">

        @if (!$user['provider'])

          {{-- LOGIN WITHOUT SOCIAL MEDIA --}}

          <div class="_is_left">
            <img class="_profile_menu_ava" src="{{ Gravatar::src('wavatar') }}" alt="{{ $user['username'] }}">
            <h2  class="_profile_menu_users_username">
              <a href="{{ route('user.profile') }}"> {{ $user['username'] }} </a>
            </h2>
          </div>

          <ul>
            @if($user['id'] === Auth::user()->id) 
            <li><a href="/chat" target="_blank"> Chat </a></li>
            <li><a class="_see_Notif" target="_blank" href="{{ route('notifications.index')}}"> Notification ({{ Auth::user()->notifications->where('seen', 0)->count() }})</a></li>
            <li><a  target="_blank" href="{{ route('product.create') }}" style="line-height: 30px;"> Create your own Product </a></li>     
            <li><a  target="_blank" href="{{ route('blog.create') }}"> Create a Blog</a></li>
            @endif
            <li><a href="{{ route('app.index') }}"> Back to homepage </a></li>
            <li><a href="/social/account/logout/"> Logout </a></li>
          </ul>

        @else

          {{-- LOGIN WITH SOCIAL MEDIA  --}}

          <div class="_is_left">
              <img class="_profile_menu_ava" src="{{ $user['avatar'] }}" alt="{{ $user['username']}}">
              <h2  class="_profile_menu_users_username">
                <a href="{{ route('user.profile') }}"> {{ $user['username'] }} </a>
              </h2>
          </div>

          <ul>
            @if($user['id'] === Auth::user()->id)
            <li><a href="/chat" target="_blank"> Chat </a></li>
            <li><a class="_see_Notif" target="_blank" href="/notification"> Notification ({{ Auth::user()->notifications->where('seen', 0)->count() }})</a></li>
            <li><a target="_blank" href="{{ route('product.create') }}" style="line-height: 30px;"> Create your own Product </a></li>     
            <li><a target="_blank" href="{{ route('blog.create') }}"> Create a Blog</a></li>
            @endif
            <li><a href="{{ route('app.index') }}"> Back to homepage </a></li>
            <li><a href="/social/account/logout/"> Logout </a></li>
          </ul>
        @endif 

      </div> {{-- end of PROFILE MENU --}}
  </div> {{-- end of COLUMN --}}