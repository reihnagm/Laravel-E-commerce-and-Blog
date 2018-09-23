<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class BlogSeeder extends Seeder
{
  
    public function run()
    {

      $faker = Faker::create();
        foreach (range(1, 5) as $index) {
            DB::table('blogs')->insert([
            'title' => $faker->name,
            'img' => $faker->imageUrl(400, 200, 'cats'), 
            'caption' => $faker->text,
            'desc' => $faker->text,
            'user_id' => 1
        ]);
       }

    }

}
