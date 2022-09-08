<?php

namespace Plausible\Response;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

class BaseArray implements IteratorAggregate
{
    /**
     * @var array
     */
    protected array $items = [];

    /**
     * @return Traversable
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }
}