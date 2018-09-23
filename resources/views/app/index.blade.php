@extends('layouts.app')

@section('title', 'Basuketto')

@section('content')

  {{-- REGISTER FORM DIALOG JQUERY --}}

  <div id="register-form" title="Register Form" style="display:none;">

    <p class="validateTips" style="padding:8px; color:rgba(37, 37, 37, 0.7);"></p>

    <form id="form-register" method="POST" action="{{ route('register') }}">
    {{-- CSRF --}}
    @csrf

    <fieldset>

      {{-- username --}}
      <div class="_field">
        <label for="username">username (Username may consist of a-z, 0-9, allow underscores without spaces and must begin with a lowercase letter)</label>
        <input id="username" type="text" name="username" value="{{ old('username') }}">
      </div>

      {{-- email address --}}
      <div class="_field">
       <label for="email"> E-mail Address </label>
       <input id="email" type="email" name="email" value="{{ old('email') }}">
     </div>

      {{-- password --}}
      <div class="_field">
       <label for="password">Password (Minimum 6 characters, at least one uppercase letter, one lowercase letter, one number and one special character)</label>
       <input name="password" id="password" type="password">
     </div>

     {{-- confirm password --}}
     <div class="_field">
       <label for="password-confirm">Confirm Password</label>
       <input id="password-confirm" type="password" name="password_confirmation">
     </div>

    <input type="checkbox" id="showPassword" style="color: rgba(37, 37, 37, 0.7);">Show Password

    </fieldset>

  </form>
</div>


  <div class="_container">
    <div class="_columns _is_multiline">

      <div class="_column _is_one_quarter">

        <nav>
            {{-- CART --}}
            <a href="{{ route('cart.index') }}" id="_cart">
              <h2> {{ Cart::count() }}</h2>

              <div id="_cart_wrapper">
                <img src="{{ asset('assets/icon/cart.png')}}">
                    @if(!empty(Cart::count()))
                      <img id="_fill_of_cart" src="{{ asset('assets/icon/sack.png')}}">
                    @endif
              </div>
             </a>

          @if(Auth::check()) 

            @if(Auth::check() != Auth::user()->provider) 
            
            {{-- LOGIN WITHOUT SOCIAL MEDIA --}}

            <img class="_image_small _has_range_top" src="{{ Gravatar::src('wavatar') }}" text="{{ Auth::user()->name }}" alt="{{ Auth::user()->name }}">
           
             <div>
              <a class="_button _has_range_top" href="{{ route('user.profile')}}">My Profile </a> 
             </div>
             <div>
               <a class="_button _has_range_top" href="social/account/logout/">Logout</a>
              </div>
            @else 

            {{-- LOGIN WITH SOCIAL MEDIA --}}

            <img class="_image_small _has_range_top" src="{{ Auth::user()->avatar }}" text="{{ Auth::user()->name }}" alt="{{ Auth::user()->name }}">

             <div>
              <a class="_button _has_range_top" href="{{ route('user.profile')}}">My Profile </a> 
             </div>
              <div>
               <a class="_button _has_range_top" href="social/account/logout/">Logout</a>
              </div>
          
            @endif 

          @else  

          <form id="_form_login" action="{{ route('login') }}" method="POST">
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
                <input id="password_field" type="password" name="password" placeholder="Password"> <i toggle="#password_field" class="_eye_icon"> </i>
              </div>

              {{-- event trigger submit --}}
              <a onclick="event.preventDefault(); document.getElementById('_form_login').submit();" class="_button">Login </a>
            </div> {{-- end of FIELD --}}

            {{-- remmember me  --}}
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label id="_remember_label" for="remember"> Remember Me </label>

          </form> 

          <div class="_text_gray _has_range_top"> don't have a account? </div>

          <a id="trigger-button-register" class="_button _has_range_top _has_range_bottom"> Register </a>

          {{-- login use Gmail  --}}
          <a id="google_wrapper" class="_button" href="redirect/google"><i class="_has_range_right" id="google_icon"></i>Log in with Google</a>

          {{-- login use Facebook --}}
          <a id="facebook_wrapper" class="_button" href="redirect/facebook"> <i class="_has_range_right" id="facebook_icon"></i>Log in with Facebook</a>

        </nav>
        @endif
      </div> {{-- end of NAV --}}

      {{---------------------------------------------------------------------------------------------------------------}}

       <div class="_column">
        <div class="_has_large_padding _back_gray">

         {{-- search --}}
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
                 <a class="_text_gray" href="{{ route('product.filter', $category->name) }}"> {{ $category->name }} </a>      
                @endforeach 
                <div>
                 Filter Blog Category :
                 @foreach ($tags as $tag) /
                  <a class="_text_gray" href="{{ route('blog.filter', $tag->name) }}"> {{ $tag->name }} </a>    
                 @endforeach 
                </div>
            </form>
          </div>

          {{----------------------------------------------------------------------------------------------------}}

          {{-- banner --}}
          <div class="_banner">
            @foreach ($products as $product)
            <div style="position: relative;">
              <img height="390" src="{{ asset('storage/products/images/'. $product->img )}}" alt=" {{ $product->name }}" />
              <p>{{ $product->name }}</p>
            </div>
             
             @endforeach
          </div>

           <div class="_columns _is_multiline">
            @forelse ($products->chunk(4) as $chunk)
              @foreach ($chunk as $product)
                <div class="_column _is_one_quarter">
                 <div class="_product">
                   <img src="{{ asset('storage/products/images/'. $product->img) }}" alt="{{ $product->name }}">
                    <div id="_wrapper_price">
                      <img id="_board_price_img" src="{{ asset('/assets/icon/board-price.jpg')}}">
                      <p id="_desc_price"> {{ money($product->price, 'USD') }}</p>
                    </div>
                   <h1> {{ $product->name }}</h1>
                   <div> {{ $product->user->username }}</div>
                   <div> {{ date(str_replace("-", " ",'d-F-Y'), strtotime($product->created_at)) }}</div>
                    @foreach ($product->categories as $category)
                      <span> {{  $category->name }} </span>
                    @endforeach
                    <p>{{ $product->desc }}</p>

                    <a class="_button _has_range_left _has_range_bottom" href="{{ route('cart.add', $product->id) }}"> add to cart </a>

                   @if(Auth::check()) 
                    @if(Auth::user()->id == $product->user->id)
                      <a href="#!" class="_button _has_range_left _has_range_bottom" href="#!">edit</a>
                    @endif
                   @endif
                    
                    <form action="{{ route('product.update', $product->id)}}" method="post">
                      {{-- CSRF --}}
                      @csrf

                      {{-- METHOD_FIELD --}}
                      {{ method_field('DELETE') }}
                     @if(Auth::check()) 
                      @if(Auth::user()->id == $product->user->id)
                        <input class="_button _has_range_left _has_range_bottom" type="submit" value="delete">
                      @endif
                    @endif 

                    </form>
                  </div>
               </div>
              @endforeach
              @empty
              no product found
            @endforelse
          </div> {{-- end of PRODUCT --}}

           {{ $products->links() }}

        {{-----------------------------------------------------------------------------------}}
        
          <div class="_columns _is_multiline">
            @forelse ($blogs->chunk(4) as $chunk)
              @foreach ($chunk as $blog)
                <div class="_column _is_one_quarter">
                  <div class="_blog">
                   <h2> {{ $blog->title }}</h2>
                    @foreach ($blog->tags as $tag)
                     <span>   {{  $tag->name }}  </span>
                    @endforeach 
                    <div>
                     <span> {{ date(str_replace("-", " ",'d-F-Y'), strtotime($blog->created_at)) }}</span>
                    </div>
                   <span> Author : {{ $blog->user->username }}</span>
                   <img src="{{ asset('storage/blogs/images/'. $blog->img) }}" alt="{{ $blog->title }}">
                  <p> {!! str_limit($blog->desc, 300) !!} .. </p>
                  <a class="_button" href="#!"> Continue read </a>
                 </div>


                <style>
                  ._blog div span {
                    margin: 6px 0; 
                    display: inline-block;
                  }
                </style>


               </div>
              @endforeach
              @empty
              no blog found
            @endforelse
          </div> {{-- end of BLOG --}}

          {{ $blogs->links() }}

        </div> {{-- end of BACKGROUND GRAY --}}


        {{-----------------------------------------------------------}}

    
        {{-- FOOTER --}}
         <div class="_footer">
            <p>
              Community to every writter and a merchantman.
            </p>
           <p> &copy; Basuketto {{ date('Y') }} </p>
         </div> 

       </div> {{-- end of COLUMN --}}

  </div> 
</div>

@endsection
