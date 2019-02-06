<?php

use Illuminate\Database\Seeder;

use TCG\Voyager\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {

          User::create([
             'name' => 'User',
             'email'=> 'user@user.user',
             'role_id' => 2,
             'slug' => 'User',
             'remember_token' => str_random(60),
             'password' => bcrypt('SUper&&4'),
             'avatar' => Gravatar::src('wavatar'),
           ]);

         User::create([
           'name' => 'John Doe',
           'email'=> 'johndoe@gmail.com',
           'role_id' => 2,
           'slug' => 'John Doe',
           'remember_token' => str_random(60),
           'password' => bcrypt('SUper&&4'),
           'avatar' => Gravatar::src('wavatar'),
          ]);

    }
}
