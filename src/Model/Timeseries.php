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

    public static function fromApiResponse(string $json): self
    {
        $data = json_decode($json, true)['results'];

        $items = [];

        foreach ($data as $item) {
            $items[] = TimeseriesItem::fromArray($item);
        }

        return new self($items);
    }

    /**
     * @return TimeseriesItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}