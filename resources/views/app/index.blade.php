@extends('layouts.app')

@section('title', 'Basuketto')

@section('content')

  <div class="_container">
    <div class="_columns">
       <div class="_column _is_one_quarter">

      <div class="_hamburger_menu">
        <span class="bar1"></span> 
        <span class="bar2"></span>
        <span class="bar3"></span>
      </div>

      <div class="_mobile_nav_menu">
        <a class="_cart" href="{{ route('cart.index') }}">
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

     @if(Auth::check())   
        @if (empty($user['provider']))
         
        <div class="_is_left">
          <img class="_profile_menu_ava" src="{{ Gravatar::src('wavatar') }}" alt="{{ $user['username'] }}">
          <h2  class="_profile_menu_users_username"> <a href="{{ route('user.profile') }}"> {{ $user['username'] }} </a> </h2>
         </div>  
        
        <ul class="_mobile_menu">
          @if($user['id'] === Auth::user()->id) 
            <li><a target="_blank" href="/chat"> Chat </a></li> 
            <li><a target="_blank" href="{{ route('notifications.index')}}" class="_see_Notif"> Notification ({{ Auth::user()->notifications->where('seen', 0)->count() }})</a></li>
            <li><a target="_blank" href="{{ route('product.create') }}"> Create your own Product </a></li>   
            <li><a target="_blank" href="{{ route('blog.create') }}"> Create a Blog</a></li>
          @endif
          <li><a href="{{ route('app.index') }}"> Back to homepage </a></li> 
          <li><a href="/social/account/logout/"> Logout </a></li> 
        </ul>
        
        @else 

        <div class="_is_left">
          <img class="_profile_menu_ava" src="" alt="{{ $user['username'] }}">
          <h2 class="_profile_menu_users_username"> <a href="{{ route('user.profile') }}"> {{ $user['username'] }} </a> </h2>
        </div>

        <ul class="_mobile_menu">
        @if($user['id'] === Auth::user()->id)
          <li><a href="/chat" target="_blank"> Chat </a></li>
          <li><a target="_blank" href="/notification" class="_see_Notif"> Notification ({{ Auth::user()->notifications->where('seen', 0)->count() }})</a></li>
          <li><a target="_blank" href="{{ route('product.create') }}"> Create your own Product </a></li>     
          <li><a target="_blank" href="/blog/create"> Create a Blog</a></li>
        @endif
        <li><a href="/"> Back to homepage </a></li>
        <li><a href="/social/account/logout/"> Logout </a></li>
        </ul> 

        @endif
       @else

      <form id="_form_login_mobile" action="{{ route('login') }}" method="POST">
        {{-- CSRF --}}
        @csrf

        <div class="_field">
        <input type="text" name="email" placeholder="E-Mail Address">

        @if ($errors->has('email'))
        <span class="_is_invalid">{{ $errors->first('email') }}</span>
        @endif

        <div class="_wrapper_input_password">
        <input id="password_field_mobile" type="password" name="password" placeholder="Password"> <i toggle="#password_field_mobile" class="_eye_icon"> </i>
        </div>

        @if ($errors->has('password'))
        <span class="_is_invalid">{{ $errors->first('password') }}</span>
        @endif
        <br> 
        <a  class="_button" onclick="event.preventDefault(); document.getElementById('_form_login_mobile').submit();">Login </a> 
        </div> 
      
        <input type="checkbox" name="remember" id="remember_label_mobile" {{ old('remember') ? 'checked' : '' }}>
        <label id="_remember_label_mobile"  for="remember"> Remember Me </label>
      </form> 

        <span class="_dont_have_account"> don't have a account? </span>

        <div class="panel">
          <form action="{{ route('register')}}" method="POST">
              {{-- CSRF --}}
              @csrf

              <div class="_field">
                <input type="text" name="username" value="{{ old('username') }}" placeholder="Username">
                
                @if ($errors->has('username'))
                  <span class="_is_invalid">{{ $errors->first('username') }}</span>
                @endif

                <input type="text" name="email" value="{{ old('email') }}" placeholder="E-Mail Address">
        
                @if ($errors->has('email'))
                  <span class="_is_invalid">{{ $errors->first('email') }}</span>
                @endif

                <div class="_wrapper_input_password">
                  <input id="password_field_register_mobile" type="password" name="password" placeholder="Password"> <i toggle="#password_field_register_mobile" class="_eye_icon"> </i>
                </div>

                @if ($errors->has('password'))
                  <span class="_is_invalid">{{ $errors->first('password') }}</span>
                @endif

                <div class="_wrapper_input_password">
                  <input id="password_field_confirmation_mobile" type="password" name="password_confirmation" placeholder="Password Confirmation"> <i toggle="#password_field_confirmation_mobile" class="_eye_icon"> </i>
                </div>

                @if ($errors->has('password_confirmation'))
                <span class="_is_invalid">{{ $errors->first('password_confirmation') }}</span>
                @endif

                <input class="_button" type="submit" value="Submit Register">
              </div>

            </form>
          </div>

          <a id="trigger-button-register" class="accordion _button"> Register </a>
          <br>
          {{-- login use Gmail  --}}
          <a id="google_wrapper" class="_button" href="redirect/google"><i class="_has_range_right" id="google_icon"></i>Log in with Google</a>

          {{-- login use Facebook --}}
          <a id="facebook_wrapper" class="_button" href="redirect/facebook"> <i class="_has_range_right" id="facebook_icon"></i>Log in with Facebook</a>
          @endif
        
        </div>

      {{-- MOBILE --}}
  
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

      @if(Auth::check())
        @if(empty($user['provider']))
        <nav class="nav">
          <ul>
            <li><img src="" alt=""></li>
            <li><a href="{{ route('user.profile') }}">My Profile</a></li>
            <li><a href="{{ route('social.logout') }}">Logout</a></li>
          </ul>
          @else 
          <ul>
            <li><img src="" alt=""></li>
            <li><a href="{{ route('user.profile') }}">My Profile</a></li>
            <li><a href="{{ route('social.logout') }}">Logout</a></li>
          </ul>
         </nav>
        @endif
      @else 

      <nav class="nav">
       <form id="_form_login" action="{{ route('login') }}" method="POST">
          {{-- CSRF --}}
          @csrf

        <div class="_field">
          <input type="text" name="email" placeholder="E-Mail Address">

          @if ($errors->has('email'))
           <span class="_is_invalid">{{ $errors->first('email') }}</span>
          @endif

          <div class="_wrapper_input_password">
           <input id="password_field" type="password" name="password" placeholder="Password"> <i toggle="#password_field" class="_eye_icon"> </i>
          </div>

          @if ($errors->has('password'))
           <span class="_is_invalid">{{ $errors->first('password') }}</span>
          @endif

          <br> 
          <a class="_button" onclick="event.preventDefault(); document.getElementById('_form_login').submit();">Login </a> 
        </div> 
        
          <input type="checkbox" name="remember" id="remember_label_mobile" {{ old('remember') ? 'checked' : '' }}>
          <label id="_remember_label_mobile"  for="remember"> Remember Me </label> <br> <br>
       </form> 
       
        <span class="_dont_have_account"> don't have a account? </span>  <br>

          <div class="panel">
            <form action="{{ route('register')}}" method="POST">
                {{-- CSRF --}}
                @csrf

                <div class="_field">
                  <input type="text" name="username" value="{{ old('username') }}" placeholder="Username">
                  
                    @if ($errors->has('username'))
                    <span class="_is_invalid">{{ $errors->first('username') }}</span>
                  @endif

                  <input type="text" name="email" value="{{ old('email') }}" placeholder="E-Mail Address">
          
                  @if ($errors->has('email'))
                    <span class="_is_invalid">{{ $errors->first('email') }}</span>
                  @endif

                  <div class="_wrapper_input_password">
                    <input id="password_field_register" type="password" name="password" placeholder="Password"> <i toggle="#password_field_register" class="_eye_icon"> </i>
                  </div>

                  @if ($errors->has('password'))
                    <span class="_is_invalid">{{ $errors->first('password') }}</span>
                  @endif

                <div class="_wrapper_input_password">
                  <input id="password_field_confirmation" type="password" name="password_confirmation" placeholder="Password Confirmation"> <i toggle="#password_field_confirmation" class="_eye_icon"> </i>
                </div>

                  @if ($errors->has('password_confirmation'))
                  <span class="_is_invalid">{{ $errors->first('password_confirmation') }}</span>
                  @endif

                  <input class="_button" type="submit" value="Submit Register">
              </div>

              </form>
            </div>
            
          <a id="trigger-button-register" class="accordion _button"> Register </a>
          <br> <br>
          {{-- login use Gmail  --}}
          <a id="google_wrapper" class="_button" href="redirect/google"><i class="_has_range_right" id="google_icon"></i>Log in with Google</a>

          {{-- login use Facebook --}}
          <a id="facebook_wrapper" class="_button" href="redirect/facebook"> <i class="_has_range_right" id="facebook_icon"></i>Log in with Facebook</a>
          </nav>

          @endif

         </div>
      
      {{---------------------------SEARCH--------------------------}}

       <div class="_column">
        <div class="_has_large_padding _back_gray">

          <div class="_field">
            <form id="_submit_search" action="{{ route('blog.and.product.search') }}" method="get">
              <input type="search" name="search">
        
               <div class="_is_left">
                <a onclick="event.preventDefault(); document.getElementById('_submit_search').submit()" class="_has_range_top" href="#"> <i class="_search _button"></i> </a>
               </div>
                 
                <br>
                <a href="{{ route('app.index') }}"> All  </a> <br> <br>
                 Filter Product Category : 
                @foreach ($categories as $category) /
                 <a href="{{ route('product.filter', $category['name']) }}"> {{ $category['name'] }} </a>      
                @endforeach 
                <div>
                 Filter Blog Category :
                 @foreach ($tags as $tag) /
                  <a href="{{ route('blog.filter', $tag['name']) }}"> {{ $tag['name'] }} </a>    
                 @endforeach 
                </div>
            </form>
          </div>

          {{------------------------------BANNER--------------------------------------}}

          {{-- <div class="_slick" style="max-width: 500px;">
            @foreach ($products as $product)
             <div style="position: relative;">
              <img  style="height: 100px;" src="{{ asset('storage/products/images/'. $product->img )}}" alt=" {{ $product->name }}" />
              <p style="margin-top: 8px;">{{ $product->name }}</p>
             </div>
             @endforeach
             </div> --}}
           
          {{-------------------------------PRODUCTS-----------------------------------}}

            <h2> All Products </h2>
            
            <hr>

             @forelse ($products->chunk(4) as $chunk)
              <div class="_columns _is_multiline">
               @foreach ($chunk as $product)
                 <div class="_column _is_one_quarter">

                   <div class="_products">
                      <img src="{{ asset('storage/products/images/'. $product['img']) }}" alt="{{ $product['name'] }}">
                      
                      <div class="_products_wrapper_price">
                        <p class="_products_desc_price">Rp {{ number_format($product['price'],2,",",".") }} </p>
                      </div> 

                      <h1 class="_products_name"> {{ title_case($product['name']) }} </h1> 
                  
                      <span class="_products_users_username"> Owner :  {{ $product['user']['username'] }} </span> 
                      <span class="_products_date"> {{ date(str_replace("-", " ",'d-F-Y'), strtotime($product['created_at']))  }} </span>
                    
                      @foreach ($product->categories as $category)
                      <span class="_products_categories"> {{ $category['name'] }} </span>
                      @endforeach 

                      <p class="_products_desc"> {{ $product['desc'] }} </p>

                       <form class="_cart_add" action="{{ route('cart.add')}}" method="post"> 
                          @csrf
                        {{-- CSRF --}}

                        <input type="hidden" name="id" value="{{ $product['id']}}">
                        <input type="hidden" name="name" value="{{ $product['name']}}">
                        <input type="hidden" name="price" value="{{ $product['price']}}">
                        <input type="hidden" name="img" value="{{ $product['img']}}">

                        <input class="_button _products_add_to_cart"  type="submit" value="Add To Cart"> <br><br>
                       </form>
                        
                        @auth
                          @if(Auth::user()->id === $product['user']['id'])
                          <a class="_button _products_edit" target="_blank" href="{{ route('product.edit', $product['id']) }}">Edit</a> 
                            <form class="_form_products_delete" action="{{ route('product.update', $product['id']) }}" method="post">
                              {{-- CSRF --}}
                              @csrf

                              {{-- METHOD_FIELD --}}
                              {{ method_field('DELETE') }}

                              <input class="_button _products_delete" type="submit" value="Delete">
                            </form> <br>
                          @endif
                        @endauth
                    
                    </div>

                   </div>
                  @endforeach 
                 </div>
                @empty
              @endforelse

           {{-- PAGINATION --}}
           
           {{ $products->links() }}

        {{---------------------------------------BLOGS-------------------------------------}}

         <h2> All Blogs </h2>

         <hr>

         @forelse ($blogs->chunk(4) as $chunk)
          <div class="_columns _is_multiline">
              @foreach ($chunk as $blog)
                <div class="_column _is_one_quarter">

                 <div class="_blogs_homepage">
                   <h2 class="_blogs_homepage_title"> {{ $blog['title'] }}</h2>
                 
                    @foreach ($blog->tags as $tag)
                     <span class="_blogs_homepage_tags"> {{  $tag['name'] }} </span>
                    @endforeach 
                  
                   <span class="_blogs_homepage_date"> {{ date(str_replace("-", " ",'d-F-Y'), strtotime($blog['created_at'])) }}</span>
                  
                   <span class="_blogs_homepage_author"> Author : {{ $blog['user']['username'] }}</span> 
                   <img src="{{ asset('storage/blogs/images/'. $blog['img']) }}" alt="{{ $blog['title'] }}">
                  
                   <a class="_button" target="_blank" href="{{ route('blog.show', $blog['slug'])}}"> Read more </a>   
                  </div>
                
               </div>
              @endforeach
              @empty
           </div>
          @endforelse
      

          {{-- PAGINATION --}}

          {{ $blogs->links() }}
         </div>
    

      </div>
    </div> 
   </div>
  </div>
@endsection
