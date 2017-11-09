<?php

namespace Expendables\AutoRoute;

class RouterMixin
{
    public function getUnnamedRoutes()
    {
        return function () {
            return array_filter($this->getRoutes()->getRoutes(), function ($route) {
                return ($route->getName() === null);
            });
        };
    }

    public function refreshDefaultNames()
    {
        return function () {
            foreach ($this->getUnnamedRoutes() as $route)
            {
                if ($route->isCallbackAction()) {
                    continue;
                }

                $action = $route->isNotSingleActionController()
                    ? $route->getActionMethod()
                    : '';

                $name = NamingStrategy::classic(
                    $route->getControllerName(), $action
                );

                $route->name($name);
            }
        };
    }
}
