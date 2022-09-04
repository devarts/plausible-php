<?php

namespace Plausible\Model;

use LogicException;
use Plausible\Support\Metric;
use Plausible\Support\Property;

class BreakdownItem
{
    private string $property_value;

    private ?float $visitors;
    private ?float $pageviews;
    private ?float $bounce_rate;
    private ?float $visit_duration;
    private ?float $events;
    private ?float $visits;

    public function __construct(
        string $property_value,
        ?float $visitors,
        ?float $pageviews,
        ?float $bounce_rate,
        ?float $visit_duration,
        ?float $events,
        ?float $visits
    ) {
        $this->property_value = $property_value;
        $this->visitors = $visitors;
        $this->pageviews = $pageviews;
        $this->bounce_rate = $bounce_rate;
        $this->visit_duration = $visit_duration;
        $this->events = $events;
        $this->visits = $visits;
    }

    public static function fromArray(array $data): self
    {
        foreach (Property::SUPPORTED_PROPERTIES as $property) {
            if (isset($data[$property])) {
                $property_value = $data[$property];
                break;
            }
        }

        if (! isset($property_value)) {
            throw new LogicException('Breakdown item property value not found.');
        }

        return new self(
            $property_value,
            $data[Metric::VISITORS] ?? null,
            $data[Metric::PAGEVIEWS] ?? null,
            $data[Metric::BOUNCE_RATE] ?? null,
            $data[Metric::VISIT_DURATION] ?? null,
            $data[Metric::EVENTS] ?? null,
            $data[Metric::VISITS] ?? null
        );
    }

    public function getPropertyValue(): string
    {
        return $this->property_value;
    }

    public function getVisitors(): ?float
    {
        return $this->visitors;
    }

    public function getPageviews(): ?float
    {
        return $this->pageviews;
    }

    public function getBounceRate(): ?float
    {
        return $this->bounce_rate;
    }

    public function getVisitDuration(): ?float
    {
        return $this->visit_duration;
    }

    public function getEvents(): ?float
    {
        return $this->events;
    }

    public function getVisits(): ?float
    {
        return $this->visits;
    }
}