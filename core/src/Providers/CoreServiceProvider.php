<?php

namespace Leafr\Core\Providers;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom( __DIR__ . '/../Database/Migrations' );
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'leafr.core');

        if (! $this->app->routesAreCached()) {

            require __DIR__.'/../Routes/web.php';

        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('flash', function()
        {
            return $this->app->make('Leafr\Core\Support\FlashNotifier');
        });
    }
}
