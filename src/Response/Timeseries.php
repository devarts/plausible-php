<?php

namespace Plausible\Response;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

/**
 * @implements IteratorAggregate<TimeseriesItem>
 */
class Timeseries implements IteratorAggregate
{
    private array $items = [];

    public static function fromApiResponse(string $json): self
    {
        $data = json_decode($json, true)['results'];

        $timeseries = new self();

        foreach ($data as $item) {
            $timeseries->items[] = TimeseriesItem::fromArray($item);
        }

        return $timeseries;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }
}