<?php

namespace Plausible\Request\Parameter;

use LogicException;
use Plausible\Request\ApiPayloadPresentable;

class Metrics implements ApiPayloadPresentable
{
    public const VISITORS = 'visitors';
    public const PAGEVIEWS = 'pageviews';
    public const BOUNCE_RATE = 'bounce_rate';
    public const VISIT_DURATION = 'visit_duration';
    public const EVENTS = 'events';
    public const VISITS = 'visits';

    private array $metrics;

    private function __construct()
    {
        $this->metrics = [];
    }

    public static function create(): self
    {
        return new self();
    }

    public function withVisitors(): self
    {
        return $this->withMetric(self::VISITORS);
    }

    public function withPageviews(): self
    {
        return $this->withMetric(self::PAGEVIEWS);
    }

    public function withBounceRate(): self
    {
        return $this->withMetric(self::BOUNCE_RATE);
    }

    public function withVisitDuration(): self
    {
        return $this->withMetric(self::VISIT_DURATION);
    }

    public function withEvents(): self
    {
        return $this->withMetric(self::EVENTS);
    }

    public function withVisits(): self
    {
        return $this->withMetric(self::VISITS);
    }

    public function withMetric(string $name): self
    {
        $metrics = clone $this;

        $metrics->metrics[] = $name;

        return $metrics;
    }

    public function toApiPayload(): array
    {
        return [
            'metrics' => implode(',', array_unique($this->metrics)),
        ];
    }
}