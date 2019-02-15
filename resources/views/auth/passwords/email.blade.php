@extends('layouts.app')

@section('content')
<div class="container">

  <div class="columns">

    <div class="column is-one-quarter">
      @include('_includes/menu_user_mobile', [
      "user" => request()->user(),
      "blog_user_id" =>  null,
      "blog_user_name" => null,
      "blog_user_avatar" => null
      ])
      @include('_includes/menu_user_profile',[
      "user" => request()->user(),
      "blog_user_id" => null,
      "blog_user_name" =>  null,
      "blog_user_avatar" =>   null
      ])
    </div>

    <div class="column">
      <h3>Reset Password</h3>
      <br>
        <form method="POST" action="{{ route('password.email') }}">
          @csrf
          <div class="field">
            <label for="email">E-mail Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}">
            @if ($errors->has('email'))
              <span class="is-error"> {{ $errors->first('email') }} </span>
            @endif
          </div>
          <button type="submit" class="button"> Send Password Reset Link </button>
        </form>
     </div>

  </div>

</div>
@endsection
