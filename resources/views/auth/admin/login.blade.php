@extends('layouts.app')
@section('content')

<div class="_container">
  <div class="_columns">
    <div class="_column">
      
      <form class="_admin_login_page" method="POST" action="{{ route('admin.login.submit') }}">
        @csrf

        <div class="_is_right">
          <img class="_image_small" src="{{ asset('assets/icon/lock.png') }}">
        </div>

         @if($errors->has('email'))
            <span class="_is_invalid"> {{ $errors->first('email') }} </span>
          @endif

         <div class="_field">
          <label class="label" for="email"> E-Mail Address </label>
          <input id="email" type="email" name="email" value="{{ old('email') }}">

          @if($errors->has('password'))
            <span class="_is_invalid"> {{ $errors->first('password') }} </span>
          @endif

          <label class="label" for="password"> Password </label>
          <div class="_wrapper_input_password">
            <input id="password_field_admin" type="password" name="password"> <i toggle="#password_field_admin" class="_eye_icon"> </i>
          </div>
         </div>
      
        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="_text_gray" for="remember"> Remember Me </label>

        <a onclick="event.preventDefault(); document.getElementsByClassName('_admin_login_page')[0].submit();" class="_button"> Login </a>
        <a class="_button _has_range_left" href="{{ route('admin.password.request') }}"> Forgot Your Password ?</a>

      </form>
      
      
    </div>
  </div>
</div>

@endsection
