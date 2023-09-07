<?php
namespace wpiservice\WpiService;

use Illuminate\Support\ServiceProvider;

class PerformanceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(IWpiService::class, function ($app) {
            return new WpiService;
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/website-performance.php' => config_path('website-performance.php'),
        ], 'config');
    }
}


