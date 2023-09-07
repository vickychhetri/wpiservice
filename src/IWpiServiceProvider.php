<?php

namespace wpiservice\WpiService;

use Illuminate\Support\ServiceProvider;
use wpiservice\WpiService\IWpiService;



class WebServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind(IWpiService::class, WpiService::class);

    }


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}