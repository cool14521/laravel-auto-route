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

    /** @test */
    public function can_generate_name_for_single_action_controller_from_classic_naming_strategy()
    {
        $result = NamingStrategy::classic('TestsController');

        $this->assertEquals('tests', $result);
    }

    /** @test */
    public function can_extract_controller_name_without_trailing_controller_keyword()
    {
        $result = NamingStrategy::getControllerName('TestsController');

        $this->assertEquals('tests', $result);
    }

    /** @test */
    public function should_work_if_no_trailing_controller_in_controller_name()
    {
        $result = NamingStrategy::getControllerName('Tests');

        $this->assertEquals('tests', $result);
    }

    /** @test */
    public function all_name_generated_are_in_lowercase()
    {
        $result = NamingStrategy::getControllerName('TeSTs');

        $this->assertEquals('tests', $result);
    }
}
