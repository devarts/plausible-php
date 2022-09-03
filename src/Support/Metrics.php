<?php

namespace Plausible\Support;

class Metrics
{
    private array $metrics;

    private function __construct()
    {
        $this->metrics = [];
    }

    public static function create(): self
    {
        return new self();
    }

    public function add(string $metric): self
    {

        $metrics = clone $this;

        $metrics->metrics[] = $metric;

        return $metrics;
    }

    public function __toString()
    {
        return implode(',', $this->metrics);
    }
}