<?php

namespace Expendables\AutoRoute;

use ReflectionClass;

class RouteMixin
{
    public function getControllerName() {
        return function () {
            $controllerName = (new ReflectionClass($this->getController()))->getShortName();

            preg_match('/(\w+)Controller/', $controllerName, $matches);

            return strtolower($matches[1]);
        };
    }
}
