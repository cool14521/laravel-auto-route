<?php

namespace Expendables\AutoRoute\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Expendables\AutoRoute\AutoRouteServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [AutoRouteServiceProvider::class];
    }
}
