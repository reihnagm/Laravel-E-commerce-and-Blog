@extends('layouts.app')

@section('content')
<div class="_container">
  <div class="_columns">

    @component('components/menu_in_profile_user/content',[
        'user' => $user
        ]); 
    @endcomponent

    <div class="_column">
        <div class="_wrapper_box_Notif">
            <div class="_box_Notif">
            @forelse($notifications as $notif)
                <div style="display: flex; aligns-item: center;">
                <p class="{{ $notif->seen ? '_mark_as_readed' : '_mark_as_read' }}" notif-id="{{ $notif->id }}">
                <a style="color: #2a397a;" href="{{ route('blog.show', $notif->blog->slug) }}" >{{ $notif->subject }} </a> 
                </p>
                </div>
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