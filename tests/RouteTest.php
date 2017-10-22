<?php

namespace Expendables\AutoRoute\Tests;

use Expendables\AutoRoute\Tests\Stubs\TestsController;

class RouteTest extends TestCase
{
    /** @test */
    public function can_get_controller_name()
    {
        $controller = TestsController::class;
        $this->router->get('/', "{$controller}@index");
        $route = $this->app['router']->getRoutes()->getRoutes()[0];

        $res = $route->getControllerName();

        $this->assertEquals('tests', $res);
    }

    /** @test */
    public function can_get_controller_short_name()
    {
        $controller = TestsController::class;
        $this->router->get('/', "{$controller}@index");
        $route = $this->router->getRoutes()->getRoutes()[0];

        $result = $route->getControllerShortName();

        $this->assertEquals('TestsController', $result);
    }
}
