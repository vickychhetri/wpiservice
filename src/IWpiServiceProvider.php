<?php
namespace wpiservice\WpiService;
use Illuminate\Support\ServiceProvider;
use wpiservice\WpiService\IWpiService;
class IWpiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind(IWpiService::class, WpiService::class);

    }


 /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/app.php' => config_path('app.php'),
        ], 'config');
    }
}
