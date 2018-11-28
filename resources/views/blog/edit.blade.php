@extends('layouts.app')

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


 <div class="_column">
    <form action="/blog/{{ $blog->id }}" method="post" enctype="multipart/form-data">  
        {{-- CSRF --}}
        @csrf

        {{-- METHOD_FIELD --}}
        {{ method_field('PUT') }}
        
        <div class="_field">

        <label for="title">Title* :</label>
        <input type="text" name="title" value="{{ $blog->title }}" id="_title">
        
        @if($errors->has('title'))
        <p class="_is_invalid"> {{ $errors->first('title') }}</p>
        @endif

        <label> (MAX 1 GB / JPG, GIF, PNG, JPEG, BMP)* : </label>
        <input id="_file" class="_inputfile" type="file" name="img">

        <label> Caption Image* </label>
        <textarea name="caption">{{ $blog->caption }}</textarea>

        @if($errors->has('img'))
        <p class="_is_invalid"> {{ $errors->first('img') }}</p>
        @endif
        
        <label for="_desc">Desc* :</label>
        <textarea id="summernote" name="desc" id="_desc">{{ $blog->desc }}</textarea>
        
        @if($errors->has('desc'))
        <p class="_is_invalid"> {{ $errors->first('desc') }}</p>
        @endif

         {{-- old select --}}
     
        <select id="_tags" name="tags[]" multiple> 
            @foreach ($tags as $tag)      
             @foreach ($blog->tags as $oldtag)
                <option value="{{ $tag->id }}" 
                    @if($oldtag->id == $tag->id)
                    selected
                    @endif
                    > 
                    {{ $tag->name }}
                </option>       
             @endforeach
            @endforeach     
        </select>
    
         {{-- default select --}}
            {{-- <select name="tags[]" multiple>
                @foreach ($tags as $tag)
                <option value="{{ $tag->id }}"> {{ $tag->name }} </option>
                @endforeach
            </select> --}}
      
        @if($errors->has('tags'))
        <p class="_is_invalid"> {{ $errors->first('tags') }}</p>
        @endif

        <input class="_button" type="submit" value="Save Edit">

        </div> 
    </form> 
   </div>
 
  </div>
 </div>
@endsection