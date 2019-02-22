<?php

use Illuminate\Database\Seeder;

use TCG\Voyager\Models\User;

class AdminTableSeeder extends Seeder
{

    public function run()
    {
        User::create([
          'name' => 'admin',
          'email'=> 'admin@gmail.com',
          'role_id' => 1,
          'slug' => 'admin',
          'remember_token' => str_random(60),
          'password' => bcrypt('SUper&&4'),
          'avatar' => Gravatar::src('wavatar'),
        ]);
    }

}
