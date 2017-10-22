<?php

namespace Expendables\AutoRoute;

use ReflectionClass;
use Illuminate\Routing\{Router, Route};
use Illuminate\Support\ServiceProvider;

class AutoRouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Router::mixin(new RouterMixin);
        Route::mixin(new RouteMixin);

        $this->app->booted(function () {
            $this->app['router']->refreshDefaultNames();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
