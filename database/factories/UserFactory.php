<?php

use Faker\Generator as Faker;

// use App\Models\Message;
use App\Models\User;

$factory->define(App\Models\User::class, function (Faker $faker) {
  static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(60),
        // 'user_id' => function () {
        //     return Factory(App\Models\User::class)->create()->id;
        // }
    ];
});


$factory->define(App\Models\Blog::class, function (Faker $faker) {

  $title = $faker->sentence()

    return [
        'slug' => str_slug($title),
        'caption' => $faker->paragraph,
        'desc' => $faker->paragraph,
        'user_id' => function() {
          return factory('App\Models\User')->create()->id;
        }
    ];
});
