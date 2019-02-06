<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TagTableSeeder extends Seeder
{

    public function run()
    {

        DB::table('tags')->insert([
        'id' => 1,
        'name' => 'Tips',
        ]);
        DB::table('tags')->insert([
        'id' => 2,
        'name' => 'Motivation',
        ]);
        DB::table('tags')->insert([
        'id' => 3,
        'name' => 'Sharing',
        ]);

    }

}
