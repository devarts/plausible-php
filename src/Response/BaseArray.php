<?php

namespace Plausible\Response;

abstract class BaseArray
{
    public array $items = [];

    protected function parseValues(array $data): void
    {
        foreach ($data as $value) {
            $this->items[] = $this->parseValue($value);
        }
    }

    protected function parseValue($value)
    {
        return $value;
    }
}