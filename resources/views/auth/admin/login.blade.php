@extends('layouts.app')
@section('content')
<div class="_container">
  <div class="_columns">
    <div class="_column">
      
      <form id="_admin_login" method="POST" action="{{ route('admin.login.submit') }}">
        @csrf

        <div class="_is_right">
          <img class="_image_small" src="{{ asset('assets/icon/lock.png') }}">
        </div>

        <div class="_field">
          <label class="label" for="email"> E-Mail Address </label>
          <input id="email" type="email" name="email" value="{{ old('email') }}">

          <label class="label" for="password"> Password </label>
          <div class="_wrapper_input_password">
            <input id="password_field" type="password" name="password"> <i toggle="#password_field" class="_eye_icon"> </i>
          </div>
         </div>
      
        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label for="remember"> Remember Me </label>

        <a onclick="event.preventDefault(); document.getElementById('_admin_login').submit();" class="_button _inline_block _text_gray"> Login </a>
        <a class="_button _text_gray _has_range_left" href="{{ route('admin.password.request') }}"> Forgot Your Password ?</a>

      </form>

    </div>
  </div>
</div>
@endsection
