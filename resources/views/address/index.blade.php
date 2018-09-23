@extends('layouts.app')

@section('content')
  <div class="_container">
    <div class="_columns _is_center">
      <div class="_column _is_half">

          <form action="{{ route('address.store') }}" method="post">
            {{-- @CSRF --}}
              @csrf

            {{-- Address Line --}}
            <div class="_field">
              <label for="_address"> Address Line </label>
              <input id="_address" type="text" name="addressline" value="">
            </div>

              @if ($errors->has('addressline'))
              <h2 class="_is_invalid"> {{ $errors->first('addressline') }} </h2>
              @endif

            {{-- City --}}
            <div class="_field">
              <label for="_city"> City </label>
              <input id="_city" type="text" name="city" value="">
            </div>

            @if ($errors->has('city'))
              <h2 class="_is_invalid"> {{ $errors->first('city') }} </h2>
            @endif

            {{-- State --}}
            <div class="_field">
              <label for="_state"> State / Country </label>
              <input id="_state" type="text" name="state" value="">
            </div>

            @if ($errors->has('state'))
            <h2 class="_is_invalid"> {{ $errors->first('state') }} </h2>
            @endif

            {{-- Zip --}}
            <div class="_field">
              <label for="_zip">Zip / Postal Code </label>
              <input id="_zip" type="number" name="zip" value="">
            </div>

            @if ($errors->has('zip'))
            <h2 class="_is_invalid"> {{ $errors->first('zip') }} </h2>
            @endif

            {{-- Phone --}}
            <div class="_field">
              <label for="phone">Phone</label>
              <input id="phone" type="tel" name="phone">
            </div>

            @if ($errors->has('phone'))
            <h2 class="_is_invalid"> {{ $errors->first('phone') }} </h2>
            @endif

            <div class="_has_range_top">
              <input class="_button" type="submit" name="submit" value="Send">
            </div>

          </form>

      </div>
    </div>
  </div>
@endsection
