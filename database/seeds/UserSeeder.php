<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
  
    public function run()
    {

      $faker = Faker::create();
      foreach (range(1, 10) as $index) {
          DB::table('users')->insert([
         'username' => $faker->name,
         'slug' => $faker->slug,
         'email'=> $faker->email,
         'remember_token' => str_random(10),
         'password' => bcrypt('password'),
         'avatar' => Gravatar::src('wavatar'),
         'created_at' => $faker->dateTime('now'),
         'updated_at' => $faker->dateTime('now')
     ]);
      }

  }

}
