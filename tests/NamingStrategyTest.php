<?php

namespace Expendables\AutoRoute\Tests;

use Expendables\AutoRoute\NamingStrategy;

class NamingStrategyTest extends TestCase
{
    /** @test */
    public function can_generate_name_from_classic_naming_strategy()
    {
        $result = NamingStrategy::classic('TestsController', 'index');

        $this->assertEquals('tests.index', $result);
    }
}
