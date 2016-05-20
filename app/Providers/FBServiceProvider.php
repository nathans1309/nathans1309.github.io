<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FBService;

class FBServiceProvider extends ServiceProvider
{
    // protected $defer = true;
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
        $this->app->bind('App\Services\IFBService', function($app){
            return new FBService();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['App\Services\FBService'];
    }
}


