<?php

namespace Plausible\Support;

use InvalidArgumentException;

class Metric
{
    public const VISITORS = 'visitors';
    public const PAGEVIEWS = 'pageviews';
    public const BOUNCE_RATE = 'bounce_rate';
    public const VISIT_DURATION = 'visit_duration';
    public const EVENTS = 'events';
    public const VISITS = 'visits';

    public const SUPPORTED_METRICS = [
        self::VISITORS,
        self::PAGEVIEWS,
        self::BOUNCE_RATE,
        self::VISIT_DURATION,
        self::EVENTS,
        self::VISITS,
    ];

    /**
     * @var string[]
     */
    private array $metrics = [];

    public static function create(): self
    {
        return new self();
    }

    public function add(string $metric): self
    {
        if (! in_array($metric, self::SUPPORTED_METRICS)) {
            throw new InvalidArgumentException("Unsupported metric provided: `$metric`");
        }

        $metrics = clone $this;

        $metrics->metrics[] = $metric;

        return $metrics;
    }

    public function toString(): string
    {
        return implode(',', $this->metrics);
    }

    public function __toString()
    {
        return $this->toString();
    }
}