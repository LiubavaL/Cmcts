<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ComicService;
use Debugbar;

class ComicServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

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
        Debugbar::info('sart bind comic service');

        $this->app->bind('App\Services\ComicService', function(){
            return new ComicService();
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        Debugbar::info('return comic service');
        return ['App\Services\ComicService'];
    }
}
