<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    
    public function boot()
    {

        Schema::defaultStringLength('191');

        Paginator::defaultView('pagination::default');

         if(env('REDIRECT_HTTPS')) {
            $url->formatScheme('https');
        }

    }

    public function register()
    {

         if(env('REDIRECT_HTTPS')) {
            $this->app['request']->server->set('HTTPS', true);
        }
        
    }

}
