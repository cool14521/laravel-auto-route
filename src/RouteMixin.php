<?php

namespace Expendables\AutoRoute;

use ReflectionClass;

class RouteMixin
{
    public function getControllerName() {
        return function () {
            preg_match('/(\w+)Controller/', $this->getControllerShortName(), $matches);

            return strtolower($matches[1]);
        };
    }

    public function getControllerShortName()
    {
        return function () {
            return (new ReflectionClass($this->getController()))->getShortName();
        };
    }

    public function isSingleActionController()
    {
        return function () {
            return (get_class($this->getController()) === $this->getActionMethod());
        };
    }
}
