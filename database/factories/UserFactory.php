<?php

use Faker\Generator as Faker;

use App\Models\Message;

$factory->define(App\Models\Message::class, function (Faker $faker) {
    return [
        'subject' => $faker->sentence(6),
        'user_id' => function () {
            return Factory(App\Models\User::class)->create()->id;
        }
        
    ];
});


