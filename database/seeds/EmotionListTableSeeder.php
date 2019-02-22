<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class EmotionListTableSeeder extends Seeder
{

    public function run()
    {

      $faker = Faker::create();
      foreach (range(1, 6) as $index) {
         switch ($index) {
          case 1:
          DB::table('emotion_lists')->insert([
          'id' => 1,
          'name' => 'happy',
          ]);
          break;
          case 2:
          DB::table('emotion_lists')->insert([
          'id' => 2,
          'name' => 'sad',
          ]);
          break;
          case 3:
          DB::table('emotion_lists')->insert([
          'id' => 3,
          'name' => 'angry',
          ]);
          break;
          case 4:
          DB::table('emotion_lists')->insert([
          'id' => 4,
          'name' => 'amazing',
          ]);
          break;
          case 5:
          DB::table('emotion_lists')->insert([
          'id' => 5,
          'name' => 'fear',
          ]);
          break;
          case 6:
          DB::table('emotion_lists')->insert([
          'id' => 6,
          'name' => 'doubt',
          ]);
          break;
       }
     }

    }

}
