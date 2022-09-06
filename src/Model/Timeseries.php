<?php

namespace Plausible\Model;

/**
 * @property TimeseriesItem[] $items
 */
class Timeseries extends BaseObject
{
    public static function fromApiResponse(string $json): self
    {
        $data = json_decode($json, true)['results'];

        $timeseries = new self();

        $items = [];

        foreach ($data as $item) {
            $items[] = TimeseriesItem::fromArray($item);
        }

        $timeseries->items = $items;

        return $timeseries;
    }

    public function getSupportedProperties(): array
    {
        return [
            'items',
        ];
    }
}