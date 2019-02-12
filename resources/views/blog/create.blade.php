@extends('layouts.app')

@section('author', 'Basuketto, basuketto')

@section('description', 'Create blog website Basuketto')

@section('title', 'Basuketto | Create Blog')

@section('content')
<div class="container">
 <div class="columns">

    <div class="column is-one-quarter">
        @include('_includes/menu_user_mobile')
        @include('_includes/menu_user_profile')
    </div>

  <div class="column">
    <form action="{{ route('blog.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="field">
          <label for="title">Title* :</label>
          <input type="text" name="title" value="{{ old('title') }}" id="title">

          @if($errors->has('title'))
          <p class="is-error"> {{ $errors->first('title') }}</p>
          @endif

          <label for="file"> (MAX 1 GB / JPG, GIF, PNG, JPEG, BMP)* : </label>
          <input id="file" class="input-file" type="file" name="img">

          @if($errors->has('img'))
          <p class="is-error"> {{ $errors->first('img') }}</p>
          @endif

          <label> Caption Image </label>
          <textarea name="caption">{{ old('caption') }}</textarea>

          <label for="desc">Desc* :</label>
          <textarea class="richTextBox" name="desc" id="desc">{{ old('desc') }}</textarea>

          @if($errors->has('desc'))
          <p class="is-error"> {{ $errors->first('desc') }}</p>
          @endif

          {{-- OLD SELECT --}}
          @if (old('tags'))
          <select id="tags" name="tags[]">
              <option value="0"> Select Tag* : </option>
              @for ($i=0; $i<count(old('tags')); $i++)
              @foreach ($tags as $tag)
                  <option value="{{ $tag->id }}"
                  @if(old('tags.'.$i) == $tag->id)
                      selected="selected"
                  @endif>
                      {{ $tag->name }}
                  </option>
               @endforeach
              @endfor
          </select>
          @else

          {{-- DEFAULT SELECT --}}
          <label> Tags *(MAX 1)</label>
          <select name="tags[]">
          @foreach ($tags as $tag)
              <option value="{{ $tag->id }}"> {{ $tag->name }} </option>
          @endforeach
          </select>
          @endif

          @if($errors->has('tags'))
          <p class="is-error"> {{ $errors->first('tags') }}</p>
          @endif

         <input class="button" name="publish" type="submit" value="Publish">
         <input class="button" name="draft" type="submit" value="Save to Draft">

        </div>
    </form>

  </div>

 </div>
</div>
@endsection
