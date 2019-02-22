<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
      // !IMPORTANT : PLACING MUST SUIT RULE,
      //  1  $this->call(DataTypesTableSeeder::class);
      //  2  $this->call(DataRowsTableSeeder::class);
      //  3  $this->call(DataTypesTableSeeder::class);
      //  4  $this->call(DataRowsTableSeeder::class);
      //  5  $this->call(DataRowsTableSeeder::class);
      //  6  $this->call(PermissionsTableSeeder::class);
      //  7 $this->call(PermissionRoleTableSeeder::class);
      $this->call(RolesTableSeeder::class); // MUST PLACE FIRST, BECAUSE WILL BE CONFLICT, PLACE BEFORE PermissionsTableSeeder
      $this->call(DataTypesTableSeeder::class);
      $this->call(DataRowsTableSeeder::class);
      $this->call(MenusTableSeeder::class);
      $this->call(MenuItemsTableSeeder::class);
      $this->call(UsersTableSeeder::class);
      $this->call(AdminTableSeeder::class);
      $this->call(PermissionsTableSeeder::class);
      $this->call(PermissionRoleTableSeeder::class);
      $this->call(TagTableSeeder::class);
      $this->call(ExportTableSeeder::class);
      $this->call(BlogTableSeeder::class);
      $this->call(CategoryTableSeeder::class);
      $this->call(ProductTableSeeder::class);
      $this->call(EmotionListTableSeeder::class);
      $this->call(CouponsTableSeeder::class);
	    $this->call(CurrencyTableSeeder::class);
      $this->call(SettingsTableSeeder::class);
    }

}
