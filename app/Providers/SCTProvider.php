<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SCTProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

       $this->app->bind('SCT', function(){
            return new \App\Classes\SCT;
        });
    }
}
