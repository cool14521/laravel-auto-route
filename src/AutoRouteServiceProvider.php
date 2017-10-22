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

        Route::macro('getControllerName', function () {
            $controllerName = (new ReflectionClass($this->getController()))->getShortName();

            preg_match('/(\w+)Controller/', $controllerName, $matches);

            return strtolower($matches[1]);
        });

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
