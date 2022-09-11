<?php

namespace Plausible\Response;

/**
 * @property int $value
 * @property int $change
 */
class AggregatedMetric extends BaseObject
{
    public static function fromArray(array $data): self
    {
        $aggregated_metric = new self();

        $aggregated_metric->createProperties($data);

        return $aggregated_metric;
    }
}