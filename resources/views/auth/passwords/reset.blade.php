@extends('layouts.app')

@section('content')
<div class="container">

  <div class="columns">
    <div class="column is-one-quarter">

    </div>

    <div class="column">
      <h3>Reset Password</h3>

      <form method="POST" action="/password/reset">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <div class="field">
          <label for="email">E-mail Address</label>
          <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}">

          @if ($errors->has('email'))
          <span class="is-error"> {{ $errors->first('email') }} </span>
          @endif
        </div>

        <div class="field">
          <label for="password">New Password </label>
          <input id="password" type="password" name="password">

          @if ($errors->has('password'))
          <span class="is-error"> {{ $errors->first('password') }} </span>
          @endif
        </div>

        <div class="field">
          <label for="password-confirm">Confirm New Password</label>
          <input id="password-confirm" type="password" name="password_confirmation">
        </div>
        <button type="submit" class="button"> Reset Password </button>
      </form>
    </div>
  </div>

</div>
@endsection