@extends('layouts.app')

@section('content')
  <div class="_container">
    <div class="_columns _is_center">
      <div class="_column _is_half">

          <form action="{{ route('address.store') }}" method="post">
             {{-- CSRF --}}
              @csrf

            <div class="_field">
              <label for="_address"> Address </label>
              <input id="_address" type="text" name="address" value="">
            </div>

              @if ($errors->has('address'))
              <h2 class="_is_invalid"> {{ $errors->first('address') }} </h2>
              @endif

            <div class="_field">
              <label for="_city"> City </label>
              <input id="_city" type="text" name="city" value="">
            </div>

            @if ($errors->has('city'))
              <h2 class="_is_invalid"> {{ $errors->first('city') }} </h2>
            @endif

            <div class="_field">
              <label for="_state"> State / Country </label>
              <input id="_state" type="text" name="state" value="">
            </div>

            @if ($errors->has('state'))
            <h2 class="_is_invalid"> {{ $errors->first('state') }} </h2>
            @endif

            <div class="_field">
              <label for="_zip">Zip / Postal Code </label>
              <input id="_zip" type="number" name="zip" value="">
            </div>

            @if ($errors->has('zip'))
            <h2 class="_is_invalid"> {{ $errors->first('zip') }} </h2>
            @endif

            <div class="_field">
              <label for="phone">Phone</label>
              <input id="phone" type="number" name="phone">
            </div>

            @if ($errors->has('phone'))
            <h2 class="_is_invalid"> {{ $errors->first('phone') }} </h2>
            @endif

            <div class="_has_range_top">
              <input class="_button" type="submit" name="submit" value="Submit">
            </div>

          </form>

      </div>
    </div>
  </div>
@endsection
