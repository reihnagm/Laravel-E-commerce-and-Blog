@extends('layouts.app')

@section('content')

<div class="container">
  <div class="columns">

    <div class="column is-one-quarter">
      @include('_includes/menu_user_mobile')
      @include('_includes/menu_user_profile')
    </div>

    <div class="column">
      <form action="{{ route('product.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="field">
          <label for="name">Name* :</label>
          <input type="text" name="name" value="{{old('name')}}" id="name">

          @if($errors->has('name'))
            <p class="is-error"> {{ $errors->first('name') }}</p>
            @endif

            <label> (MAX 1 GB / JPG, GIF, PNG, JPEG, BMP)* : </label>
            <input id="file" type="file" name="img">

            @if($errors->has('img'))
              <p class="is-error"> {{ $errors->first('img') }}</p>
              @endif

              <label for="desc">Desc* :</label>
              <textarea name="desc" class="richTextBox" id="desc"> {{old('desc')}}</textarea>
              @if($errors->has('desc'))
                <p class="is-error"> {{ $errors->first('desc') }} </p>
                @endif

                <label for="price">Price* :</label>
                @foreach(\App\Models\Currency::all() as $currency)
                @if($currency['name'] == "USD" && $currency['active'])
                <input type="text" id="price-usd" name="price" value="{{ old('price') }}">
                @elseif($currency['name'] == "IDR" && $currency['active'])
                <input type="text" id="price-idr" name="price" value="{{ old('price') }}">
                @endif
                @endforeach

                <label for="categories"> Category* (Max: 1) :</label>

                {{-- OLD SELECT --}}
                @if (old('categories'))
                <div class="field">
                  <select id="categories" name="categories[]" multiple>
                    @for ($i=0; $i
                    <count(old('categories')); $i++) @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if(old('categories.'.$i) == $category->id)
                    selected="selected"
                    @endif>
                      {{ $category->name }}
                      </option>
                      @endforeach
                      @endfor
                  </select>
                </div>
                @else

                {{-- DEFAULT SELECT --}}
                <div class="field">
                  <select name="categories[]" multiple>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}"> {{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
                @endif

                @if($errors->has('categories'))
                  <p class="is-error"> {{ $errors->first('categories') }} </p>
                  @endif

        </div>

        <input class="button" type="submit" value="Add Product">

      </form>

    </div>
  </div>

</div>
</div>

@endsection