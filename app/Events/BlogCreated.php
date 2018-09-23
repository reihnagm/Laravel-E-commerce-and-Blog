<?php

namespace App\Events;

use App\Models\Blog;

use Illuminate\Queue\SerializesModels;
use Illuminate\Session\Store;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BlogCreated 
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

  

    public function __construct()
    {

    

    }

    
   public function handle(Blog $blog)
    {

      
          
    
    }

}
