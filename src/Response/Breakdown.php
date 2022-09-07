<?php

namespace Plausible\Response;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

/**
 * @template IteratorAggregate<BreakdownItem>
 */
class Breakdown implements IteratorAggregate
{
    private array $items = [];

    public static function fromApiResponse(string $json): self
    {
        $data = json_decode($json, true)['results'];

        $breakdown = new self();

        foreach ($data as $item) {
            $breakdown->items[] = BreakdownItem::fromArray($item);
        }

        return $breakdown;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }
}