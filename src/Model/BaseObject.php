<?php

namespace Plausible\Model;

use LogicException;

abstract class BaseObject
{
    public function __get($name)
    {
        return $$name;
    }

    public function __set($name, $value)
    {
        if (! in_array($name, $this->getSupportedProperties())) {
            throw new LogicException("Parameter `$name` is not supported.");
        }
        $this->$name = $value;
    }

    public function __isset($name)
    {
        return isset($this->$name);
    }

    /**
     * @return string[]
     */
    public abstract function getSupportedProperties(): array;
}