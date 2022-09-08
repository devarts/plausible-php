<?php

namespace Plausible\Response;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

class Breakdown implements IteratorAggregate
{
    protected array $items = [];

    /**
     * @return BreakdownItem[]
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public static function fromApiResponse(string $json): self
    {
        $data = json_decode($json, true)['results'];

        $breakdown = new self();

        foreach ($data as $item) {
            $breakdown->items[] = BreakdownItem::fromArray($item);
        }

        return $breakdown;
    }
}