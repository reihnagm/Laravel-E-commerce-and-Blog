<?php

use Illuminate\Database\Seeder;

class ExportTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('exports')->insert([
      'id' => 1,
      'type' => 'EXCEL',
      'active' => 1,
      ]);
        DB::table('exports')->insert([
      'id' => 2,
      'type' => 'PDF',
      'active' => 0
      ]);
        DB::table('exports')->insert([
      'id' => 3,
      'type' => 'CSV',
      'active' => 0
      ]);
    }
}
