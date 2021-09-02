<?php

namespace Laravel\Cpanel;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Cpanel\Console\InstallCpanelPackage;

class CpanelServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'cpanel');
    }

    public function boot()
    {
        $this->registerRoutes();

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cpanel');

        // Register the command
        if ($this->app->runningInConsole()) {
            // Publish config
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('cpanel.php'),
            ], 'config');

            // Publish views
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/cpanel'),
            ], 'views');

            $this->commands([
                InstallCpanelPackage::class,
            ]);
        }
    }

    public function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '../../routes/web.php');
        });
    }

    public function routeConfiguration()
    {
        return [
            'prefix'     => config('cpanel.prefix'),
            'middleware' => config('cpanel.middleware'),
        ];
    }
}
