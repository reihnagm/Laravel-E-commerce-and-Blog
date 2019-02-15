@extends('layouts.app')

@section('content')
<section class="container">
  <div class="columns">

    <div class="column is-one-quarter">
      @include('_includes/menu_user_mobile', [
      "user" => auth()->user()
      ])
      @include('_includes/menu_user_profile',[
      "user" => auth()->user()
      ])
    </div>

    <div class="column" style="margin-top: 12.5%;">
      <table>
        <thead>
          <tr>
            <th> Title </th>
            <th> Desc </th>
            <th> Caption </th>
            <th> Img </th>
            <th> Tags </th>
            <th> Date </th>
            <th> Option </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($blogs as $blog)
          <tr>
            <td> {{ $blog['title'] }} </td>
            <td> {!! $blog['desc'] !!} </td>
            <td> {{ $blog['caption'] }} </td>
            <td> <img src="{{ showImage($blog['img']) }}" alt="{{ $blog['title'] }}" style="width: 50px;"> </td>
            @foreach($blog->tags as $tag)
              <td> {{ $tag['name'] }} </td>
              @endforeach
              <td> {!! showDate($blog['created_at']) !!} </td>
              <td>
                <form action="{{ route('blog.publish') }}" method="post">
                  @csrf
                  <input class="button" type="submit" value="Publish">
                </form> <br>
                <a class="button" href="{{ route('blog.edit', $blog['slug']) }}"> Edit </a> <br> <br>
                <form action="{{ route('blog.destroy', $blog['id']) }}" method="post">
                  @csrf
                  {{ method_field('DELETE') }}
                  <input class="button" type="submit" value="Delete">
                </form>

              </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="column is-fullWidth">
        {{ $blogs->links() }}
      </div>

    </div>

  </div>
</section>
@endsection
