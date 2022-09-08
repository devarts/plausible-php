<?php

namespace Plausible\Response;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

class Timeseries implements IteratorAggregate
{
    protected array $items = [];

    /**
     * @return TimeseriesItem[]
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public static function fromApiResponse(string $json): self
    {
        $data = json_decode($json, true)['results'];

        $timeseries = new self();

        foreach ($data as $item) {
            $timeseries->items[] = TimeseriesItem::fromArray($item);
        }

        return $timeseries;
    }
}