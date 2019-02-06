@extends('layouts.app')

@section('content')
<div class="container">
  <div class="columns">

    <div class="column is-one-quarter">
      @include('_includes/menu_user_mobile')
      @include('_includes/menu_user_profile')
    </div>

    <div class="column">
      <form action="{{ route('product.update', $product['id'] ) }}" method="post" enctype="multipart/form-data">
        @csrf

        {{ method_field('PUT') }}

        <div class="field">
          <label for="name">Name* :</label>
          <input type="text" name="name" value="{{ $product['name'] }}" id="name">
          @if($errors->has('name'))
            <p class="is-error"> {{ $errors->first('name') }}</p>
            @endif

            <label for="file"> (MAX 1 GB / JPG, GIF, PNG, JPEG, BMP)* : </label>
            <input id="file" type="file" name="img">
            @if($errors->has('img'))
              <p class="is-error"> {{ $errors->first('img') }}</p>
              @endif

              <label for="desc">Desc* :</label>
              <textarea name="desc" class="richTextBox" id="desc"> {{ $product['desc'] }} </textarea>

              @if($errors->has('desc'))
                <p class="is-error"> {{ $errors->first('desc') }}</p>
                @endif

                <label for="price">Price* :</label>
                @foreach(\App\Models\Currency::all() as $currency)
                @if($currency['name'] == "USD" && $currency['active'])
                <input type="text" id="price-usd" name="price" value="{{ $product['desc'] }}">
                @elseif($currency['name'] == "IDR" && $currency['active'])
                <input type="text" id="price-idr" name="price" value="{{ $product['desc'] }}">
                @endif
                @endforeach

                {{-- OLD SELECT --}}
                <select id="category" name="categories[]" multiple>
                  @foreach ($categories as $category)
                  @foreach ($product->category as $oldcategory)
                  <option value="{{ $category['id'] }}" @if($oldcategory->id == $category['id'])
                    selected
                    @endif
                    >
                    {{ $category['name'] }}
                  </option>
                  @endforeach
                  @endforeach
                </select>

                @if($errors->has('categories'))
                  <p class="is-error"> {{ $errors->first('categories') }} </p>
                  @endif

                  <input class="button" type="submit" value="Edit Product">

      </form>
    </div>
  </div>

</div>
</div>
@endsection
