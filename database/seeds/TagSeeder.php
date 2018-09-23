<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class TagSeeder extends Seeder
{
  
    public function run()
    {

      $faker = Faker::create();
        foreach (range(1, 5) as $index) {
            DB::table('tags')->insert([
            'name' => $faker->jobTitle,
        ]);
       }

    }

}
