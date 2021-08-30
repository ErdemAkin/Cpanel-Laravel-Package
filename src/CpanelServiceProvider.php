<?php

namespace Laravel\Cpanel;

use Illuminate\Support\ServiceProvider;
use Laravel\Cpanel\Console\InstallCpanelPackage;

class CpanelServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'cpanel');
    }

    public function boot()
    {
        // Register the command
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCpanelPackage::class,
            ]);
        }
    }
}
