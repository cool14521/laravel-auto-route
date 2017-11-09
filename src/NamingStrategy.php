<?php

namespace Expendables\Autoroute;

class NamingStrategy
{
    public static function classic($controller, $action)
    {
        return implode('.', [self::getControllerName($controller), $action]);
    }

    public static function getControllerName($controllerName) {
        preg_match('/(\w+)Controller/', $controllerName, $matches);

        return strtolower($matches[1]);
    }
}
