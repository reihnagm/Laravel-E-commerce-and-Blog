<?php

use Illuminate\Database\Seeder;

use TCG\Voyager\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
             'name' => 'tony',
             'email'=> 'tony@gmail.com',
             'role_id' => 2,
             'slug' => 'tony',
             'remember_token' => str_random(60),
             'password' => bcrypt('SUper&&4'),
             'avatar' => Gravatar::src('wavatar'),
           ]);

        User::create([
           'name' => 'darco',
           'email'=> 'darco@gmail.com',
           'role_id' => 2,
           'slug' => 'darco',
           'remember_token' => str_random(60),
           'password' => bcrypt('SUper&&4'),
           'avatar' => Gravatar::src('wavatar'),
          ]);

        User::create([
            'name' => 'daniel',
            'email'=> 'daniel@gmail.com',
            'role_id' => 2,
            'slug' => 'daniel',
            'remember_token' => str_random(60),
            'password' => bcrypt('SUper&&4'),
            'avatar' => Gravatar::src('wavatar'),
           ]);
    }
}
