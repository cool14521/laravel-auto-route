<?php

namespace Expendables\AutoRoute\Tests;

use Expendables\AutoRoute\Tests\Stubs\TestsController;

class RouterTest extends TestCase
{
    /** @test */
    public function can_retrieve_unnamed_routes()
    {
        $this->router->get('/', 'Controller@unnamed');

        $results = $this->router->getUnnamedRoutes();

        $this->assertEquals(1, count($results));
        foreach ($results as $result) {
            $this->assertNull($result->getName());
        }
    }

    /** @test */
    public function ignore_named_routes_when_retrieving_unnamed_routes()
    {
        $this->router
            ->get('/', 'Controller@named')
            ->name('some.random.name');

        $results = $this->router->getUnnamedRoutes();

        $this->assertEmpty($results);
    }

    /** @test */
    public function can_refresh_defaults_names_for_unnamed_router()
    {
        $controller = TestsController::class;
        $this->router->get('/', "{$controller}@index");

        $result = $this->router->refreshDefaultNames();

        $route = $this->router->getRoutes()->getRoutes()[0];
        $this->assertEquals('tests.index', $route->getName());
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
    public function can_detected_if_route_is_not_single_action_controller()
    {
        $controller = TestsController::class;
        $this->router->get('/', "{$controller}@index");
        $route = $this->router->getRoutes()->getRoutes()[0];

        $result = $route->isSingleActionController();

        $this->assertFalse($result);
    }
}
