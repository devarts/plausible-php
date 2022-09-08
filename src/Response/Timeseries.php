<?php

namespace Plausible\Response;

use IteratorAggregate;

/**
 * @implements IteratorAggregate<int,TimeseriesItem>
 */
class Timeseries extends BaseArray
{
    /**
     * @param string $json
     * @return static
     */
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