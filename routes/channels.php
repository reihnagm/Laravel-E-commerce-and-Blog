<?php

Broadcast::channel('channel-chat', function ($user) {
    return $user;

    // IF WANT SELECT CERTAIN QUERY
    // return [
    //     'id' => $user->id,
    //     'name' => $user->name,
    //     'slug' => $user->slug
    // ];
});

Broadcast::channel('channel-comment', function ($user) {
    return [
        'id' => $user->id, 
        'name' => $user->name
    ];
});

