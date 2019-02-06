@extends('layouts.app')

@section('content')
<div class="container">
  <div class="columns">

    <div class="column is-one-quarter">
      @include('_includes/menu_user_mobile')
      @include('_includes/menu_user_profile')
    </div>

    <div class="column">
      <div class="container-box-notif">
        <div class="box-notif">
          @forelse($notifications as $notification)
            <p class="{{ $notification->seen ? 'mark-as-read' : 'get-notif' }}" notif-id="{{ $notification->id }}">
              <a style="color: #2a397a;" href="{{ route('blog.show', $notification->blog->slug) }}">{{ $notification->subject }} </a>
            </p>
          @empty
          <p> There are no notification found.</p>
          @endforelse
          {{ $notifications->links() }}
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
