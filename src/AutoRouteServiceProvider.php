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
        Router::macro('getUnnamedRoutes', function () {
            return array_filter($this->getRoutes()->getRoutes(), function ($route) {
                return ($route->getName() === null);
            });
        });

        Route::macro('getControllerName', function () {
            $controllerName = (new ReflectionClass($this->getController()))->getShortName();

            preg_match('/(\w+)Controller/', $controllerName, $matches);

            return strtolower($matches[1]);
        });

        Router::macro('refreshDefaultNames', function () {
            foreach ($this->getUnnamedRoutes() as $route)
            {
                $name = $route->getControllerName();

                $method = $route->getActionMethod();

                $route->name("{$name}.{$method}");
            }
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
