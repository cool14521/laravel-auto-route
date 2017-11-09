<?php

namespace Expendables\Autoroute;

class NamingStrategy
{
    public static function classic($controller, $action = '')
    {
        $data = [self::getControllerName($controller), $action];


        return implode(
            '.', array_filter([self::getControllerName($controller), $action])
        );
    }

    public static function getControllerName($controllerName)
    {
        preg_match('/(\w+)Controller|(\w+)/', $controllerName, $matches);

        $controller = array_key_exists(2, $matches) ? $matches[2] : $matches[1];

        return strtolower($controller);
    }
}
