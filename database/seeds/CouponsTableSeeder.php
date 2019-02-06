<?php

use Illuminate\Database\Seeder;

use App\Models\Coupon;

class CouponsTableSeeder extends Seeder
{

    public function run()
    {
      
      Coupon::create([
        'code' => 'ABC123',
        'type' => 'fixed',
        'value' => 30
      ]);
      Coupon::create([
        'code' => 'DEF123',
        'type' => 'percent',
        'percent_off' => 50
      ]);
      
    }

}
