<?php

namespace Expendables\AutoRoute;

use ReflectionClass;
use Illuminate\Routing\{Router, Route};
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;
use Laravel\Lumen\Application as LumenApplication;
use Illuminate\Foundation\Application as LaravelApplication;

class AutoRouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath($raw = __DIR__.'/../config/autoroute.php') ?: $raw;

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('autoroute.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('autoroute');
        }

        $this->mergeConfigFrom($source, 'autoroute');

        Router::mixin(new RouterMixin);

        Route::mixin(new RouteMixin);

        $this->app->booted(function () {
            $this->app['router']->generateDefaults();
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
