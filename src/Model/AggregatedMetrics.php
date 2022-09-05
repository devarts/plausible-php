<?php

namespace Plausible\Model;

use Plausible\Support\Metric;

class AggregatedMetrics
{
    private ?AggregatedMetric $visitors;
    private ?AggregatedMetric $pageviews;
    private ?AggregatedMetric $bounce_rate;
    private ?AggregatedMetric $visit_duration;
    private ?AggregatedMetric $events;
    private ?AggregatedMetric $visits;

    public function __construct(
        ?AggregatedMetric $visitors,
        ?AggregatedMetric $pageviews,
        ?AggregatedMetric $bounce_rate,
        ?AggregatedMetric $visit_duration,
        ?AggregatedMetric $events,
        ?AggregatedMetric $visits
    ) {
        $this->visitors = $visitors;
        $this->pageviews = $pageviews;
        $this->bounce_rate = $bounce_rate;
        $this->visit_duration = $visit_duration;
        $this->events = $events;
        $this->visits = $visits;
    }

    public static function fromApiResponse(string $json)
    {
        $data = json_decode($json, true)['results'];

        return new self(
            isset($data[Metric::VISITORS])
                ? AggregatedMetric::fromArray($data[Metric::VISITORS])
                : null,
            isset($data[Metric::PAGEVIEWS])
                ? AggregatedMetric::fromArray($data[Metric::PAGEVIEWS])
                : null,
            isset($data[Metric::BOUNCE_RATE])
                ? AggregatedMetric::fromArray($data[Metric::BOUNCE_RATE])
                : null,
            isset($data[Metric::VISIT_DURATION])
                ? AggregatedMetric::fromArray($data[Metric::VISIT_DURATION])
                : null,
            isset($data[Metric::EVENTS])
                ? AggregatedMetric::fromArray($data[Metric::EVENTS])
                : null,
            isset($data[Metric::VISITS])
                ? AggregatedMetric::fromArray($data[Metric::VISITS])
                : null
        );
    }

    public function getVisitors(): ?AggregatedMetric
    {
        return $this->visitors;
    }

    public function getPageviews(): ?AggregatedMetric
    {
        return $this->pageviews;
    }

    public function getBounceRate(): ?AggregatedMetric
    {
        return $this->bounce_rate;
    }

    public function getVisitDuration(): ?AggregatedMetric
    {
        return $this->visit_duration;
    }

    public function getEvents(): ?AggregatedMetric
    {
        return $this->events;
    }

    public function getVisits(): ?AggregatedMetric
    {
        return $this->visits;
    }
}