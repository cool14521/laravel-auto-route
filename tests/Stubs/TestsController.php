<?php

namespace Expendables\AutoRoute\Tests\Stubs;

use Illuminate\Routing\Controller;

class TestsController extends Controller
{
    public function index()
    {
        return true;
    }
}
