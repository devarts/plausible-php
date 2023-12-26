<?php

namespace Devarts\PlausiblePHP\Support;

class Metrics
{
    public const VISITORS = 'visitors';
    public const PAGEVIEWS = 'pageviews';
    public const BOUNCE_RATE = 'bounce_rate';
    public const VISIT_DURATION = 'visit_duration';
    public const EVENTS = 'events';
    public const VISITS = 'visits';
    public const VIEWS_PER_VISIT = 'views_per_visit';

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
        $metrics = clone $this;

        $metrics->metrics[] = $metric;

        return $metrics;
    }

    public function addVisitors(): self
    {
        return $this->add(self::VISITORS);
    }

    public function addPageviews(): self
    {
        return $this->add(self::PAGEVIEWS);
    }

    public function addBounceRate(): self
    {
        return $this->add(self::BOUNCE_RATE);
    }

    public function addVisitDuration(): self
    {
        return $this->add(self::VISIT_DURATION);
    }

    public function addEvents(): self
    {
        return $this->add(self::EVENTS);
    }

    public function addVisits(): self
    {
        return $this->add(self::VISITS);
    }

    public function addViewsPerVisit(): self
    {
        return $this->add(self::VIEWS_PER_VISIT);
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