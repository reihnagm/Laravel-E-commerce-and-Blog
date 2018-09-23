@extends('app-admin.app')
@section('content')
<div class="_container">
  <div class="_columns">
    <div class="_column">
      <form method="POST" action="{{ route('admin.password.email') }}">
        @csrf
        <div class="_field">
          <label for="email">E-Mail Address</label>
          <input class="_has_small_padding" id="email" type="email" name="email" value="{{ old('email') }}">
          <button type="submit" class="_button _success _has_small_vm _is_gray">
          Send Reset Password Link
        </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
