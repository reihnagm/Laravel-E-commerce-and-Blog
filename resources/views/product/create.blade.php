 @extends('layouts.app')

 @section('content')
 
 <div class="_container">
    <div class="_columns">
    
  @component('components/menu_in_profile_user/content',[
    'user' => $user,
    'notifications' => $notifications
  ]); 
  @endcomponent
  
  {{------------------------------------------------------------------------}}
  <div class="_column">
  <form action="{{ route('product.store')}}" method="post" enctype="multipart/form-data">
     {{-- CSRF --}}
     @csrf
 
     <div class="_field">
      <label for="_name">Name* :</label>
      <input type="text" name="name" value="{{old('name')}}" id="_name">
      @if($errors->has('name'))
        <p class="_is_invalid"> {{ $errors->first('name') }}</p>
      @endif
      
      <label> (MAX 1 GB / JPG, GIF, PNG, JPEG, BMP)* : </label>
      <input id="_file" class="_inputfile" type="file" name="img">
      @if($errors->has('img'))
      <p class="_is_invalid"> {{ $errors->first('img') }}</p>
      @endif

      <label for="_desc">Desc* :</label>
      <textarea name="desc" id="_desc">{{old('desc')}}</textarea>
      @if($errors->has('desc'))
        <p class="_is_invalid"> {{ $errors->first('desc') }}</p>
      @endif
     
      <label for="_category"> Category* :</label>
      {{-- old select --}}
      @if (old('categories'))
      <div class="_field">
       <select id="_category" name="categories[]" multiple>
          @for ($i=0; $i<count(old('categories')); $i++)
          @foreach ($categories as $cat)
              <option value="{{ $cat->id }}"
              @if(old('categories.'.$i) == $cat->id)
                  selected="selected"
              @endif>
                  {{ $cat->name }}
              </option>
          @endforeach
          @endfor
       </select>
       </div>
      @else

       {{-- default select --}}
       <div class="_field">
        <select name="categories[]" class="_has_range_bottom" multiple>
          @foreach ($categories as $cat)
           <option value="{{ $cat->id }}"> {{ $cat->name }}</option>
          @endforeach
         </select>
        </div>
        @endif

        @if($errors->has('categories'))
          <p class="_is_invalid _has_range_bottom"> {{ $errors->first('categories') }} </p>
        @endif

        <div class="_field">
          <label for="_price">Price* :</label>
          <input id="_price" type="currency" name="price">
        </div>

        @if($errors->has('price'))
          <p class="_is_invalid _has_range_bottom"> {{ $errors->first('price') }} </p>
        @endif
      </div>
      
       <input class="_button" type="submit" value="Add Product">
      
    </form> 
  </div> {{-- end of MAKEAPRODUCT --}}
 </div> {{-- end of COLUMN --}}

 </div> {{-- end of COLUMNS --}}
</div> {{-- end of CONTAINER --}}

@endsection