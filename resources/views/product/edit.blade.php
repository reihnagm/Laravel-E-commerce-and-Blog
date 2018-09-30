@extends('layouts.app')

@section('content')
<div class="_container">
  <div class="_columns">

     @component('components/menu_in_profile_user/content') @endcomponent

    {{-------------------------------------------------------------------}}

  <div class="_column">
    <form action="{{ route('product.update', $product->id)}}" method="post" enctype="multipart/form-data">
    {{-- CSRF --}}
    @csrf

    {{-- METHOD_FIELD --}}    
    {{ method_field('PUT') }}

    <div class="_field">
    <label for="_name">Name* :</label>
    <input type="text" name="name" value="{{ $product->name }}" id="_name">
    @if($errors->has('name'))
        <p class="_is_invalid"> {{ $errors->first('name') }}</p>
    @endif
    
    <label> (MAX 1 GB / JPG, GIF, PNG, JPEG, BMP)* : </label>
    <input id="_file" class="_inputfile" type="file" name="img">
    @if($errors->has('img'))
    <p class="_is_invalid"> {{ $errors->first('img') }}</p>
    @endif

    <label for="_desc">Desc* :</label>
    <textarea name="desc" id="_desc">{{ $product->desc }}</textarea>
    @if($errors->has('desc'))
        <p class="_is_invalid"> {{ $errors->first('desc') }}</p>
    @endif
    
     {{-- old select --}}
    
    <select id="_category" name="categories[]" multiple>
        @foreach ($categories as $category)
        @foreach ($product->categories as $oldcategory)
        <option value="{{ $category->id }}"
            @if( $category->id == $oldcategory->id)
                selected
            @endif
            >
            {{ $category->name }}
        </option>
        @endforeach
        @endforeach
    </select>
    
     @if($errors->has('categories'))
        <p class="_is_invalid _has_range_bottom"> {{ $errors->first('categories') }} </p>
     @endif

     <div class="_field">
        <label for="_price">Price* :</label>
        <input id="_price" type="currency" name="price" value="{{ $product->price }}">
     </div>

     @if($errors->has('price'))
         <p class="_is_invalid _has_range_bottom"> {{ $errors->first('price') }} </p>
     @endif

    <input class="_button" type="submit" value="Add Product">
    
    </form> 
   </div>
   
  </div>
</div>   
@endsection


