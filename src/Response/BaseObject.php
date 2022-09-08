<?php

namespace Plausible\Response;

abstract class BaseObject
{
    /**
     * @param array $data
     * @return void
     */
    protected function createProperties(array $data): void
    {
        foreach ($data as $name => $value) {
            $this->createProperty($name, $value);
        }
    }

    /**
     * @param $name
     * @param $value
     * @return void
     */
    protected function createProperty($name, $value): void
    {
        $this->$name = $value;
    }
}