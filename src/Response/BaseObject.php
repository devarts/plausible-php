<?php

namespace Plausible\Response;

use stdClass;

abstract class BaseObject extends stdClass
{
    protected function __construct() {}

    protected function createProperties(array $data): void
    {
        foreach ($data as $name => $value) {
            $this->createProperty($name, $value);
        }
    }

    protected function createProperty($name, $value): void
    {
        $this->$name = $value;
    }
}