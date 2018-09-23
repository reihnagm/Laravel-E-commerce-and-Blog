<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
  
    protected $listen = [
        'App\Events\BlogCreated' => [
            'App\Listeners\SendUserEmailAfterBlogPublished',
        ],
        'App\Events\ViewBlogHandler' => [
            'App\Listeners\ManyUserViewBlog',
        ],
    ];

   
    public function boot()
    {
    
        parent::boot();
    
    }
}
