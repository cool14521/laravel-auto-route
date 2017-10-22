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
        $this->app['router']->get('/', 'Controller@unnamed');

        $results = $this->app['router']->getUnnamedRoutes();

        $this->assertEquals(1, count($results));
        foreach ($results as $result) {
            $this->assertNull($result->getName());
        }
    }

    /** @test */
    public function ignore_named_routes_when_retrieving_unnamed_routes()
    {
        $this->app['router']
            ->get('/', 'Controller@named')
            ->name('some.random.name');

        $results = $this->app['router']->getUnnamedRoutes();

        $this->assertEmpty($results);
    }
}
