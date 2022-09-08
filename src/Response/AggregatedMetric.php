<?php

namespace Plausible\Response;

/**
 * @property int $value
 * @property float $change
 */
class AggregatedMetric extends BaseObject
{
    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): self
    {
        $aggregated_metric = new self();

        $aggregated_metric->createProperties($data);

        return $aggregated_metric;
    }
}