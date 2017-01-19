<?php

namespace Leafr\Portfolio\Providers;

use Illuminate\Support\ServiceProvider;

class PortfolioServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom( __DIR__ . '/../Database/Migrations' );
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'leafr.portfolio');

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

    }
}
