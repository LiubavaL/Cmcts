<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            '*', 'App\Http\ViewComposers\UserComposer'
        );
        View::composer(
            'layouts.app', 'App\Http\ViewComposers\NotificationComposer'
        );
        View::composer(
            'layouts.app', 'App\Http\ViewComposers\ComicComposer'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
