<?php

namespace Expendables\AutoRoute\Tests;

use Expendables\AutoRoute\Tests\Stubs\TestsController;

class RouteTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->controller = TestsController::class;
        $this->router->get('/', "{$this->controller}@index");
        $this->route = $this->app['router']->getRoutes()->getRoutes()[0];
    }

    /** @test */
    public function can_get_controller_name()
    {
        $res = $this->route->getControllerName();

        $this->assertEquals('tests', $res);
    }

    /** @test */
    public function can_get_controller_short_name()
    {
        $result = $this->route->getControllerShortName();

        $this->assertEquals('TestsController', $result);
    }

    /** @test */
    public function can_detect_if_route_is_a_single_action_controller()
    {
        $controller = TestsController::class;
        $this->router->get('/', $controller);
        $route = $this->router->getRoutes()->getRoutes()[0];

        $result = $route->isSingleActionController();

        $this->assertTrue($result);
    }

    /** @test */
    public function can_detect_if_route_is_not_a_single_action_controller()
    {
        $controller = TestsController::class;
        $this->router->get('/', "{$controller}@index");
        $route = $this->router->getRoutes()->getRoutes()[0];

        $result = $route->isNotSingleActionController();

        $this->assertTrue($result);
    }

    /** @test */
    public function can_detected_if_route_is_not_single_action_controller()
    {
        $controller = TestsController::class;
        $this->router->get('/', "{$controller}@index");
        $route = $this->router->getRoutes()->getRoutes()[0];

        $result = $route->isSingleActionController();

        $this->assertFalse($result);
    }

    public function can_detect_if_route_is_using_callback_action()
    {
        $this->router->get('/', function () {
            return true;
        });
        $route = $this->router->getRoutes()->getRoutes()[0];

        $result = $route->isCallbackAction();

        $this->assertTrue($result);
    }

    public function can_detect_if_route_is_not_using_callback_action()
    {
        $controller = TestsController::class;
        $this->router->get('/', "{$controller}@index");
        $route = $this->router->getRoutes()->getRoutes()[0];

        $result = $route->isCallbackAction();

        $this->assertFalse($result);
    }
}
