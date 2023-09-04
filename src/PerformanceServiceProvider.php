<?php
namespace wpiservice\WpiService;

use Illuminate\Support\ServiceProvider;

class PerformanceServiceProvider extends ServiceProvider
{
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WpiService::class, function ($app) {
            return new WpiService;
        });
    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/website-performance.php' => config_path('website-performance.php'),
        ], 'config');
    }
}



