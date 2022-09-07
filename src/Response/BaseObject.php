<?php

namespace Plausible\Response;

abstract class BaseObject
{
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