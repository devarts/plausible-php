<?php

namespace Plausible\Response;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

abstract class BaseArray implements IteratorAggregate
{
    protected array $items = [];

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }
}