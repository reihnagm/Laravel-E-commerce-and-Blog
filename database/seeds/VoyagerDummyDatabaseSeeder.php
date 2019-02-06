<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Traits\Seedable;

class VoyagerDummyDatabaseSeeder extends Seeder
{
    use Seedable;

    protected $seedersPath;


    public function run()
    {
        $this->seedersPath = database_path('seeds').'/';
        // $this->seed('CategoriesTableSeeder');
        // $this->seed('UsersTableSeeder');
        // $this->seed('PostsTableSeeder');
        // $this->seed('PagesTableSeeder');
        $this->seed('TranslationsTableSeeder');
        // $this->seed('PermissionRoleTableSeeder');
    }
}
