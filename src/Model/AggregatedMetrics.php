<?php

namespace Plausible\Model;

use Plausible\Support\Metric;

/**
 * @property AggregatedMetric $visitors
 * @property AggregatedMetric $pageviews
 * @property AggregatedMetric $bounce_rate
 * @property AggregatedMetric $visit_duration
 * @property AggregatedMetric $events
 * @property AggregatedMetric $visits
 */
class AggregatedMetrics extends BaseObject
{
    public static function fromApiResponse(string $json)
    {
        $data = json_decode($json, true)['results'];

        $aggregated_metrics = new self();

        if (array_key_exists(Metric::VISITORS, $data)) {
            $aggregated_metrics->visitors = AggregatedMetric::fromArray($data[Metric::VISITORS]);
        }

        if (array_key_exists(Metric::PAGEVIEWS, $data)) {
            $aggregated_metrics->pageviews = AggregatedMetric::fromArray($data[Metric::PAGEVIEWS]);
        }

        if (array_key_exists(Metric::BOUNCE_RATE, $data)) {
            $aggregated_metrics->bounce_rate = AggregatedMetric::fromArray($data[Metric::BOUNCE_RATE]);
        }

        if (array_key_exists(Metric::VISIT_DURATION, $data)) {
            $aggregated_metrics->visit_duration = AggregatedMetric::fromArray($data[Metric::VISIT_DURATION]);
        }

        if (array_key_exists(Metric::EVENTS, $data)) {
            $aggregated_metrics->events = AggregatedMetric::fromArray($data[Metric::EVENTS]);
        }

        if (array_key_exists(Metric::VISITS, $data)) {
            $aggregated_metrics->visits = AggregatedMetric::fromArray($data[Metric::VISITS]);
        }

        return $aggregated_metrics;
    }

    public function getSupportedProperties(): array
    {
        return [
            Metric::VISITORS,
            Metric::PAGEVIEWS,
            Metric::BOUNCE_RATE,
            Metric::VISIT_DURATION,
            Metric::EVENTS,
            Metric::VISITS,
        ];
    }
}