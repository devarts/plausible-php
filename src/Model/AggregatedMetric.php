<?php

namespace Plausible\Model;

class AggregatedMetric
{
    private float $value;
    private ?float $change;

    public function __construct(float $value, ?float $change)
    {
        $this->value = $value;
        $this->change = $change;
    }

    public static function fromArray(array $data): self
    {
        return new self($data['value'], $data['change'] ?? null);
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getChange(): ?float
    {
        return $this->change;
    }
}