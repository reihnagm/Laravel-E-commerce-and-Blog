<?php

namespace App\Listeners;

use App\Events\ViewBlogHandler;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ManyUserViewBlog
{
    
    public function __construct()
    {
        
    }

    
    public function handle(ViewBlogHandler $event)
    {
      
    }
}
