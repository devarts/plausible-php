<?php

namespace Plausible\Model;

/**
 * @property int $value
 * @property float $change
 */
class AggregatedMetric extends BaseObject
{
    public static function fromArray(array $data): self
    {
        $aggregated_metric = new self();

        if (array_key_exists('value', $data)) {
            $aggregated_metric->value = $data['value'];
        }

        if (array_key_exists('change', $data)) {
            $aggregated_metric->change = $data['change'];
        }

        return $aggregated_metric;
    }

    public function getSupportedProperties(): array
    {
        return [
            'value',
            'change',
        ];
    }
}