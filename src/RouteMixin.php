<?php

namespace Expendables\AutoRoute;

use ReflectionClass;

class RouteMixin
{
    public function getControllerName() {
        return function () {
            return NamingStrategy::getControllerName(
                $this->getControllerShortName()
            );
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

    public function isNotSingleActionController()
    {
        return function () {
            return (! $this->isSingleActionController());
        };
    }

    public function isCallbackAction()
    {
        return function () {
            return (! $this->isControllerAction());
        };
    }
}
