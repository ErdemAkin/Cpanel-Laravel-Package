<?php

namespace Laravel\Cpanel;

use Illuminate\Support\ServiceProvider;
use Laravel\Cpanel\Console\InstallCpanelPackage;

class CpanelServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
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
