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
                    return;
                }

                $name = $route->getControllerName();

                if (! $route->isSingleActionController()) {
                    $name .= '.' . $route->getActionMethod();
                }

                $route->name($name);
            }
        };
    }
}
