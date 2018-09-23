<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
  
    public function run()
    {

      $faker = Faker::create();
        foreach (range(1, 5) as $index) {
            DB::table('categories')->insert([
            'name' => $faker->jobTitle,
        ]);
       }

    }

}
