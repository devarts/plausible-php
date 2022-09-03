<?php

namespace Plausible\Model;

class AggregatedMetric
{
    private float $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public static function fromApiResponse(array $data)
    {
        return new self($data['value']);
    }

    public function getValue(): float
    {
        return $this->value;
    }
}