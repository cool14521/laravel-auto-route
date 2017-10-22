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
    public function cannot_pass_controller_class_without_trailing_controller_word()
    {
        //
    }

    /** @test */
    public function can_get_controller_short_name()
    {
        $result = $this->route->getControllerShortName();

        $this->assertEquals('TestsController', $result);
    }
}
