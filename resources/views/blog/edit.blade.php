@extends('layouts.app')

@section('author', 'Basuketto, basuketto')

@section('description', 'Edit blog website Basuketto')

@section('title', 'Basuketto | Edit Blog')

@section('content')
<div class="container">
 <div class="columns">

    <div class="column is-one-quarter">
        @include('_includes/menu_user_mobile')
        @include('_includes/menu_user_profile')
    </div>

  <div class="column">
    <form action="{{ route('blog.update', $blog['id']) }} " method="post" enctype="multipart/form-data">
        @csrf

        {{ method_field('PUT') }}

        <div class="field">

        <label for="title">Title* :</label>
        <input type="text" name="title" value="{{ $blog->title }}" id="title">

        @if($errors->has('title'))
        <p class="is-error"> {{ $errors->first('title') }}</p>
        @endif

        <label> (MAX 1 GB / JPG, GIF, PNG, JPEG, BMP)* : </label>
        <input id="file" type="file" name="img">

        @if($errors->has('img'))
        <p class="is-error"> {{ $errors->first('img') }}</p>
        @endif

        <label> Caption Image </label>
        <textarea name="caption">{!! $blog->caption !!}</textarea>

        <label for="desc">Desc* :</label>
        <textarea class="richTextBox" name="desc" id="desc">{!! $blog['desc'] !!}</textarea>

        @if($errors->has('desc'))
        <p class="is-error"> {{ $errors->first('desc') }}</p>
        @endif

        {{-- OLD SELECT --}}
        <select id="tags" name="tags[]" multiple>
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

        @if($errors->has('tags'))
        <p class="is-error"> {{ $errors->first('tags') }}</p>
        @endif

        <input class="button" type="submit" value="Save Edit">

        </div>
    </form>
   </div>

  </div>
 </div>
@endsection
