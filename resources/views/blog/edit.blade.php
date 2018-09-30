@extends('layouts.app')

@section('content')
<div class="_container">
 <div class="_columns">

    @component('components/menu_in_profile_user/content', [
      'user' =>  $user 
    ])
        
    @endcomponent

    {{--------------------------------------------------------------------------------------------}}

 <div class="_column">
    <form action="/blog/{{ $blog->id }}" method="post" enctype="multipart/form-data">  
        {{-- CSRF --}}
        @csrf

        {{-- METHOD_FIELD --}}
        {{ method_field('PUT') }}
        
        <div class="_field">

        <label for="title">Title* :</label>
        <input type="text" name="title" value="{{ $blog->title }}" id="_title">
        
        @if($errors->has('title'))
        <p class="_is_invalid"> {{ $errors->first('title') }}</p>
        @endif

        <label> (MAX 1 GB / JPG, GIF, PNG, JPEG, BMP)* : </label>
        <input id="_file" class="_inputfile" type="file" name="img">

        <label> Caption Image* </label>
        <textarea name="caption">{{ $blog->caption }}</textarea>

        @if($errors->has('img'))
        <p class="_is_invalid"> {{ $errors->first('img') }}</p>
        @endif
        
        <label for="_desc">Desc* :</label>
        <textarea id="summernote" name="desc" id="_desc">{{ $blog->desc }}</textarea>
        
        @if($errors->has('desc'))
        <p class="_is_invalid"> {{ $errors->first('desc') }}</p>
        @endif

         {{-- old select --}}
     
        <select id="_tags" name="tags[]" multiple> 
            @foreach ($tags as $tag)      
             @foreach ($blog->tags as $oldtag)
                <option value="{{ $tag->id }}" 
                    @if($oldtag->id == $tag->id)
                    selected
                    @endif
                    > 
                    {{ $tag->name }}
                </option>       
             @endforeach
            @endforeach     
        </select>
    
         {{-- default select --}}
            {{-- <select name="tags[]" multiple>
                @foreach ($tags as $tag)
                <option value="{{ $tag->id }}"> {{ $tag->name }} </option>
                @endforeach
            </select> --}}
      
        @if($errors->has('tags'))
        <p class="_is_invalid"> {{ $errors->first('tags') }}</p>
        @endif

        <input class="_button" type="submit" value="Save Edit">

        </div> 
    </form> 
   </div>
 
  </div>
 </div>
@endsection