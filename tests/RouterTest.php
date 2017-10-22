<?php

namespace Expendables\AutoRoute\Tests;

use Orchestra\Testbench\TestCase;
use Expendables\AutoRoute\AutoRouteServiceProvider;

class RouterTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [AutoRouteServiceProvider::class];
    }

    /** @test */
    public function can_retrieve_unnamed_routes()
    {
        $this->app['router']->get('/', 'TestsController@unnamed');

        $results = $this->app['router']->getUnnamedRoutes();

        $this->assertEquals(1, count($results));
        foreach ($results as $result) {
            $this->assertNull($result->getName());
        }
    }
}
