<?php

namespace Plausible\Response;

/**
 * @property TimeseriesItem[] $items
 */
class Timeseries extends BaseObject
{
    public static function fromApiResponse(string $json): self
    {
        $data = json_decode($json, true)['results'];

        $timeseries = new self();

        $timeseries->createProperties($data);

        return $timeseries;
    }

    protected function createProperty($name, $value): void
    {
        $this->items[] = TimeseriesItem::fromArray($value);
    }
}