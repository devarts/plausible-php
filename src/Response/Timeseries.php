<?php

namespace Plausible\Response;

/**
 * @property TimeseriesItem[] $items
 */
class Timeseries extends BaseArray
{
    public static function fromApiResponse(string $json): self
    {
        $data = json_decode($json, true)['results'];

        $timeseries = new self();

        $timeseries->parseValues($data);

        return $timeseries;
    }

    protected function parseValue($value)
    {
        return TimeseriesItem::fromArray($value);
    }
}