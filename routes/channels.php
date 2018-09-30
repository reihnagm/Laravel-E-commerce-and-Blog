<?php


Broadcast::channel('channel-chat', function ($user) {
    return [
        'id' => $user->id, 
        'username' => $user->username,
        'slug' => $user->slug
    ];

   
});
