<?php

namespace App\Events;

use App\Models\BlogComment;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewComment implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;

    public function __construct(BlogComment $comment)
    {
        $this->comment = $comment;
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->comment->id,
            'subject' => $this->comment->subject,
            'likes_count' => 0,
            'unlikes_count' => 0,
            'user' => [
                'avatar' => auth()->user()->avatar ?  $this->comment->user->avatar : Gravatar::src('wavatar'), 
                'name' => $this->comment->user->name,
                'id' => $this->comment->user->id,
            ],
        ];
    }

    public function broadcastOn()
    {
        return new PresenceChannel('channel-comment');
    }    
}
