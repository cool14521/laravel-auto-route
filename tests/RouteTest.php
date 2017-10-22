<?php

namespace Expendables\AutoRoute\Tests;

use Expendables\AutoRoute\Tests\Stubs\TestsController;

class RouteTest extends TestCase
{
    /** @test */
    public function can_get_controller_name()
    {
        $controller = TestsController::class;
        $this->app['router']->get('/', "{$controller}@index");
        $route = $this->app['router']->getRoutes()->getRoutes()[0];

        $res = $route->getControllerName();

        $this->assertEquals('tests', $res);
    }
}
