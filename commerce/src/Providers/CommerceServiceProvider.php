<?php

namespace Leafr\Commerce\Providers;

use Illuminate\Support\ServiceProvider;

class CommerceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom( __DIR__ . '/../Database/Migrations' );
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'leafr.commerce');

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
        $this->app->singleton('cart', function() 
        {
            return $this->app->make('Leafr\Commerce\Support\ShoppingCart');
        });
    }
}
