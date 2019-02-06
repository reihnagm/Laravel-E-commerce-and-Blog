<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencyTableSeeder extends Seeder
{
   
    public function run()
    {
	
		DB::table('currencies')->insert([
		'id' => 1,
		'name' => 'IDR',
		'active' => 0
		]);
		
		DB::table('currencies')->insert([
		'id' => 2,
		'name' => 'USD',
		'active' => 1
		]);
	
      }
	  
	
}
