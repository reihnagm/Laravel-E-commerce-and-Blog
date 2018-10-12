@extends('layouts.app')

@section('title', 'Basuketto')

@section('content')

  <div class="_container">
    <div class="_columns _is_multiline">

      <div class="_column _is_one_quarter">

        <div class="_hamburger_menu">
          <span class="bar1"></span> 
          <span class="bar2"></span>
          <span class="bar3"></span>
        </div>

        <div class="_mobile_nav_menu">
          
             <a class="_cart" href="{{ route('cart.index') }}">
              <h2 class="_cart_count"> {{ Cart::count() }}</h2>

              <div class="_cart_wrapper">
                  <img class="_cart_img" src="{{ asset('assets/icon/cart.png')}}">
                @if(!empty(Cart::count()))
                  <img class="_fill_of_cart" src="{{ asset('assets/icon/sack.png')}}">
                @endif
              </div>
             </a>

             <hr>
             
              @if(Auth::check()) 

                @if(empty($user['provider'])) 

                {{-- LOGIN WITHOUT SOCIAL MEDIA --}}

                <img style="padding: 5px 5px;" src="{{ Gravatar::src('wavatar') }}" text="{{ $user['name'] }}" alt="{{ $user['name'] }}"> 
              
                  <div>
                    <a style="margin: 5px 0;" class="_button" href="{{ route('user.profile') }}">My Profile </a> 
                  </div>
                    <div>
                    <a style="margin: 5px 0;" class="_button" href="social/account/logout/">Logout</a> 
                  </div>
              
                @else 

                {{-- LOGIN WITH SOCIAL MEDIA --}}

                <img style="padding: 5px 5px;" src="{{ $user['avatar'] }}" text="{{ $user['name'] }}" alt="{{ $user['name'] }}"> 

                  <div>
                    <a style="margin: 5px 0;" class="_button" href="{{ route('user.profile') }}">My Profile </a> 
                  </div>
                  <div>
                    <a style="margin: 5px 0;" class="_button" href="social/account/logout/">Logout</a> 
                  </div>

                @endif 

              @else  

              <form id="_form_login_desktop" action="{{ route('login') }}" method="POST">
                {{-- CSRF --}}
                @csrf

                <div class="_field">
                  {{-- email address  --}}
                  <input type="text" name="email" placeholder="E-Mail Address">

                  @if ($errors->has('email'))
                  <span class="_is_invalid">{{ $errors->first('email') }}</span>
                  @endif

                  {{-- password --}}
                  <div class="_wrapper_input_password">
                    <input id="password_field_m" type="password" name="password" placeholder="Password" style="margin-bottom: 5px;"> <i toggle="#password_field_m" class="_eye_icon"> </i>
                  </div>

                  @if ($errors->has('password'))
                  <span class="_is_invalid">{{ $errors->first('password') }}</span>
                  @endif

                  {{-- event trigger submit --}}
                  <a onclick="event.preventDefault(); document.getElementById('_form_login_desktop').submit();" class="_button">Login </a>
                </div>

                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label id="_remember_label" class="_text_gray" for="remember"> Remember Me </label>

              </form> 

              <br>
              <div class="_text_gray"> don't have a account? </div>

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
                      <input id="password_field_register_m" type="password" name="password" placeholder="Password"> <i toggle="#password_field_register_m" class="_eye_icon"> </i>
                    </div>

                    @if ($errors->has('password'))
                      <span class="_is_invalid">{{ $errors->first('password') }}</span>
                    @endif

                    <div class="_wrapper_input_password">
                      <input id="password_field_confirmation_m" type="password" name="password_confirmation" placeholder="Password Confirmation"> <i toggle="#password_field_confirmation_m" class="_eye_icon"> </i>
                    </div>

                    @if ($errors->has('password_confirmation'))
                    <span class="_is_invalid">{{ $errors->first('password_confirmation') }}</span>
                    @endif

                      <input class="_button" type="submit" value="Submit Register">
                 </div>

                </form>
              </div>

                <a id="trigger-button-register" class="accordion _button _has_range_top _has_range_bottom"> Register </a>
                <br>
                {{-- login use Gmail  --}}
                <a id="google_wrapper" class="_button" href="redirect/google"><i class="_has_range_right" id="google_icon"></i>Log in with Google</a>

                {{-- login use Facebook --}}
                <a id="facebook_wrapper" class="_button" href="redirect/facebook"> <i class="_has_range_right" id="facebook_icon"></i>Log in with Facebook</a>

                @endif

        </div> 

        {{--------------------------------MOBILE MENU-----------------------------------------------------------}}

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

        <nav class="nav">

          @if(Auth::check()) 

            @if(empty($user['provider'])) 
            
            {{-- LOGIN WITHOUT SOCIAL MEDIA --}}

            <img style="padding: 5px 5px;" src="{{ Gravatar::src('wavatar') }}" text="{{ $user['name'] }}" alt="{{ $user['name'] }}">
           
            <div>
              <a style="margin: 5px 0;" class="_button" href="{{ route('user.profile') }}">My Profile </a> 
            </div>
            <div>
              <a style="margin: 5px 0;" class="_button" href="social/account/logout/">Logout</a> 
            </div>

            @else 

            {{-- LOGIN WITH SOCIAL MEDIA --}}

            <img style="padding: 5px 5px;" src="{{ $user['avatar'] }}" text="{{ $user['name'] }}" alt="{{ $user['name'] }}"> 

            <div>
              <a style="margin: 5px 0;" class="_button" href="{{ route('user.profile') }}">My Profile </a> 
            </div>
            <div>
              <a style="margin: 5px 0;" class="_button" href="social/account/logout/">Logout</a> 
            </div>
             
            @endif 

          @else  

          <form id="_form_login_mobile" action="{{ route('login') }}" method="POST">
            {{-- CSRF --}}
            @csrf

            <div class="_field">
              {{-- email address  --}}
              <input type="text" name="email" placeholder="E-Mail Address">

              @if ($errors->has('email'))
              <span class="_is_invalid">{{ $errors->first('email') }}</span>
              @endif

              {{-- password --}}
              <div class="_wrapper_input_password">
                <input id="password_field" type="password" name="password" placeholder="Password" style="margin-bottom: 5px;"> <i toggle="#password_field" class="_eye_icon"> </i>
              </div>

              @if ($errors->has('password'))
               <span class="_is_invalid">{{ $errors->first('password') }}</span>
              @endif

              {{-- event trigger submit --}}
              <a onclick="event.preventDefault(); document.getElementById('_form_login_mobile').submit();" class="_button">Login </a>
            </div> {{-- end of FIELD --}}

            {{-- remmember me  --}}
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label id="_remember_label" class="_text_gray" for="remember"> Remember Me </label>

          </form> 
           
           <br>
           <div class="_text_gray"> don't have a account? </div>

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

          <a id="trigger-button-register" class="accordion _button _has_range_top _has_range_bottom"> Register </a>
          <br>
          {{-- login use Gmail  --}}
          <a id="google_wrapper" class="_button" href="redirect/google"><i class="_has_range_right" id="google_icon"></i>Log in with Google</a>

          {{-- login use Facebook --}}
          <a id="facebook_wrapper" class="_button" href="redirect/facebook"> <i class="_has_range_right" id="facebook_icon"></i>Log in with Facebook</a>

        </nav>
        @endif
      </div> {{-- end of NAV --}}

      {{-------------------------------------------SEARCH--------------------------------------------------------------------}}

       <div class="_column">
        <div class="_has_large_padding _back_gray">

          <div class="_field">
            <form id="_submit_search" action="{{ route('blog.and.product.search') }}" method="get">
              <input type="search" name="search">
        
               <div class="_is_left">
                <a onclick="event.preventDefault(); document.getElementById('_submit_search').submit()" class="_has_range_top" href="#"> <i class="_search _button"></i> </a>
               </div>
                 
                 <div>
                 <a class="_text_gray" href="/"> All  </a>
                 </div>
                 Filter Product Category : 
                @foreach ($categories as $category) /
                 <a class="_text_gray" href="{{ route('product.filter', $category['name']) }}"> {{ $category['name'] }} </a>      
                @endforeach 
                <div>
                 Filter Blog Category :
                 @foreach ($tags as $tag) /
                  <a class="_text_gray" href="{{ route('blog.filter', $tag['name']) }}"> {{ $tag['name'] }} </a>    
                 @endforeach 
                </div>
            </form>
          </div>

          {{----------------------------------------------BANNER------------------------------------------------------}}

          {{-- <div class="_slick" style="max-width: 500px;">
            @foreach ($products as $product)
             <div style="position: relative;">
              <img  style="height: 100px;" src="{{ asset('storage/products/images/'. $product->img )}}" alt=" {{ $product->name }}" />
              <p style="margin-top: 8px;">{{ $product->name }}</p>
             </div>
             @endforeach
             </div> --}}
           
          {{-------------------------------------------------PRODUCTS----------------------------------------------------}}

            <h2> All Products </h2>
            <hr>

             @forelse ($products->chunk(4) as $chunk)
             <div class="_columns _is_multiline">
              @foreach ($chunk as $product)
                <div class="_column _is_one_quarter">

                  <div class="_products">
                      <img src="{{ asset('storage/products/images/'. $product['img']) }}" alt="{{ $product['name'] }}">
                      
                      <div class="_products_wrapper_price">
                        <img class="_products_img_price" src="{{ asset('/assets/icon/board-price.jpg')}}">
                        <p class="_products_desc_price">Rp {{ number_format($product['price'],2,",",".") }} </p>
                      </div> <br>

                      <h1 class="_products_name"> {{ title_case($product['name']) }} </h1> <br> 
                  
                      <span class="_products_users_username"> Owner :  {{ $product['user']['username'] }} </span> <br> <br>
                      <span class="_products_date"> {{ date(str_replace("-", " ",'d-F-Y'), strtotime($product['created_at']))  }} </span> <br> <br>
                    
                      @foreach ($product->categories as $category)
                      <span class="_products_categories"> {{ $category['name'] }} </span> <br> <br>
                      @endforeach 

                      <p class="_products_desc"> {{ $product['desc'] }} </p> <br>

                       <form class="_cart_add" action="{{ route('cart.add')}}" method="post">
                          @csrf
                        {{-- CSRF --}}

                        <input type="hidden" name="id" value="{{ $product['id']}}">
                        <input type="hidden" name="name" value="{{ $product['name']}}">
                        <input type="hidden" name="price" value="{{ $product['price']}}">
                        <input type="hidden" name="img" value="{{ $product['img']}}">

                        <input class="_button _products_add_to_cart"  type="submit" value="Add To Cart"> <br> <br>
                       </form>
                      
                    @auth
                    @if(Auth::user()->id === $product['user']['id'])
                    <a class="_button _products_edit" target="_blank" href="{{ route('product.edit', $product['id']) }}">Edit</a> <br> <br> 
                  
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

           {{ $products->links() }}

        {{------------------------------------------BLOGS-----------------------------------------}}

          <h2> All Blogs </h2>
          <hr>

        @forelse ($blogs->chunk(4) as $chunk)
          <div class="_columns _is_multiline">
              @foreach ($chunk as $blog)
                <div class="_column _is_one_quarter">

                 <div class="_blogs_homepage">
                   <h2 class="_blogs_homepage_title"> {{ $blog['title'] }}</h2>
                   <br>
                    @foreach ($blog->tags as $tag)
                     <span class="_blogs_homepage_tags"> {{  $tag['name'] }} </span>
                    @endforeach 
                    <br> <br>
                   <span class="_blogs_homepage_date"> {{ date(str_replace("-", " ",'d-F-Y'), strtotime($blog['created_at'])) }}</span>
                    <br> <br>
                   <span class="_blogs_homepage_author"> Author : {{ $blog['user']['username'] }}</span> <br> <br>
                   <img src="{{ asset('storage/blogs/images/'. $blog['img']) }}" alt="{{ $blog['title'] }}">
                   <br>      
                   <a class="_button" target="_blank" href="{{ route('blog.show', $blog['slug'])}}"> Read more </a>
                 </div>
                
               </div>
              @endforeach
              @empty
              <div> 
            </div>
           @endforelse
          </div> 

          {{ $blogs->links() }}

        </div> 

        {{-----------------------------------------------------------}}

        <div class="_column _is_fullWidth">
         <div class="_footer">
            <p>
              Community to every writter and a merchantman.
            </p>
           <p> &copy; Basuketto {{ date('Y') }} </p>
         </div> 
        </div>
        

       </div> {{-- end of COLUMN --}}

  </div>  {{-- end of COLUMNS --}}
</div>  {{-- end of COLUMN --}}

@endsection
