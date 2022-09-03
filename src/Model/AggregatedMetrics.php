<?php

namespace Plausible\Model;

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

    public static function fromApiResponse(array $data)
    {
        return new self(
            isset($data['visitors'])
                ? AggregatedMetric::fromApiResponse($data['visitors'])
                : null,
            isset($data['pageviews'])
                ? AggregatedMetric::fromApiResponse($data['pageviews'])
                : null,
            isset($data['bounce_rate'])
                ? AggregatedMetric::fromApiResponse($data['bounce_rate'])
                : null,
            isset($data['visit_duration'])
                ? AggregatedMetric::fromApiResponse($data['visit_duration'])
                : null,
            isset($data['events'])
                ? AggregatedMetric::fromApiResponse($data['events'])
                : null,
            isset($data['visits'])
                ? AggregatedMetric::fromApiResponse($data['visits'])
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