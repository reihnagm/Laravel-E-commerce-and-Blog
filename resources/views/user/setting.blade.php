@extends('layouts.app')

@section('content')
<section class="setting">
  <div class="container">
    <div class="columns">

      <div class="column is-one-quarter">
        @include('_includes/menu_user_mobile', [
        "user" => request()->user()
        ])
        @include('_includes/menu_user_profile', [
        "user" => request()->user()
        ])
      </div>

      <div class="column">
        <form action="{{ route('change.user.email.and.password')}}" method="post">
          @csrf
        <div class="field">
          <label for="e-mail">Change E-mail</label>
          <input id="e-mail" type="text" name="e-mail" value="{{ request()->user()->email }}">
          <label for="change-password">Change Password</label>
          <div class="wrapper-input-password">
            <input id="change-password" type="password" name="password">
            <i toggle="#change-password" class="eye-icon"></i>
          </div>
        </div>
        <input class="button" type="submit" name="submit" value="Save Changes">
      </form>
      </div>

    </div>
  </div>
</section>
@endsection
