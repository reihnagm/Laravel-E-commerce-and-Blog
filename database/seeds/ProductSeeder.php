<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
  
    public function run()
    {

      $faker = Faker::create();
        foreach (range(1, 5) as $index) {
            DB::table('products')->insert([
            'name' => $faker->name,
            'img' => $faker->imageUrl(400, 200, 'cats'), 
            'desc' => $faker->text,
            'price' => 4.00,
            'user_id' => 1
        ]);
       }

    }

}
