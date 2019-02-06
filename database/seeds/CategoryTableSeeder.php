<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{

    public function run()
    { 

          DB::table('category')->insert([
          'id' => 1,
          'name' => 'Fashion',
          ]);
          DB::table('category')->insert([
          'id' => 2,
          'name' => 'Electronic',
          ]);
          DB::table('category')->insert([
          'id' => 3,
          'name' => 'Sport',
          ]);

    }

}
