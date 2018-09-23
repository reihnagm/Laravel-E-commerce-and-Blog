<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    
    public function boot()
    {

        Schema::defaultStringLength('191');

        Paginator::defaultView('pagination::default');

    }

    public function register()
    {
        
    }

}
