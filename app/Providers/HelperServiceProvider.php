<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\DateHelper;
use App\Helpers\CountHelper;
use App\Helpers\CoverHelper;

class HelperServiceProvider extends ServiceProvider
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
        $this->app->bind('DateHelper', function()
        {
            return new DateHelper;
        });
        $this->app->bind('CountHelper', function()
        {
            return new CountHelper;
        });
        $this->app->bind('CoverHelper', function()
        {
            return new CoverHelper;
        });
    }
}
