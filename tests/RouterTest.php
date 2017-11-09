<?php

namespace Expendables\AutoRoute\Tests;

use Expendables\AutoRoute\Tests\Stubs\TestsController;

class RouterTest extends TestCase
{
    /** @test */
    public function can_retrieve_unnamed_routes()
    {
        $this->router->get('/', 'Controller@unnamed');

        $results = $this->router->getAnonymousRoutes();

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

        $results = $this->router->getAnonymousRoutes();

        $this->assertEmpty($results);
    }

    /** @test */
    public function can_refresh_defaults_names_for_unnamed_route()
    {
        $controller = TestsController::class;
        $this->router->get('/', "{$controller}@index");

        $result = $this->router->generateDefaults();

        $route = $this->router->getRoutes()->getRoutes()[0];
        $this->assertEquals('tests.index', $route->getName());
    }

    /** @test */
    public function can_refresh_default_names_for_unnamed_route_using_single_action_controller()
    {
        $controller = TestsController::class;
        $this->router->get('/', "{$controller}");

        $result = $this->router->generateDefaults();

        $route = $this->router->getRoutes()->getRoutes()[0];
        $this->assertEquals('tests', $route->getName());
    }

    /** @test */
    public function ignore_callback_route_for_being_named()
    {
        $this->router->get('/to-ignore', function () {
            return true;
        });
        $controller = TestsController::class;
        $this->router->get('/valid', "{$controller}@index");

        $result = $this->router->generateDefaults();

        $route = $this->router->getRoutes()->getRoutes()[1];
        $this->assertEquals('tests.index', $route->getName());
        $route = $this->router->getRoutes()->getRoutes()[0];
        $this->assertNull($route->getName());
    }

    /** @test */
    public function doesnt_override_manually_affected_routes()
    {
        $controller = TestsController::class;
        $this->router
            ->get('/has-name', "{$controller}@index")
            ->name('something');

        $result = $this->router->generateDefaults();

        $this->assertEquals('something', $this->firstRouteName());
    }

    private function firstRoute()
    {
        return $this->router->getRoutes()->getRoutes()[0];
    }

    private function firstRouteName()
    {
        return $this->firstRoute()->getName();
    }
}
