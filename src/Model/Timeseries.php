<?php

namespace Plausible\Model;

use DateTime;

class Timeseries
{
    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public static function fromArray(array $data): self
    {
        $points = [];

        foreach ($data as $point) {
            $points[] = TimeseriesItem::fromArray($point);
        }

        return new self($points);
    }

    public function getItems(): array
    {
        return $this->items;
    }
}