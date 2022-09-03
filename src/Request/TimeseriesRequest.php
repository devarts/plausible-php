<?php

namespace Plausible\Request;

use Plausible\Request\Parameter\Filters;
use Plausible\Request\Parameter\Interval;
use Plausible\Request\Parameter\Metrics;
use Plausible\Request\Parameter\Period;

class TimeseriesRequest implements ApiPayloadPresentable
{
    private string $site_id;
    private ?Period $period;
    private ?Filters $filters;
    private ?Metrics $metrics;
    private ?Interval $interval;

    public function __construct(
        string $site_id,
        ?Period $period,
        ?Filters $filters,
        ?Metrics $metrics,
        ?Interval $interval
    ) {
        $this->site_id = $site_id;
        $this->period = $period;
        $this->filters = $filters;
        $this->metrics = $metrics;
        $this->interval = $interval;
    }

    public function toApiPayload(): array
    {
        $data = [
            'site_id' => $this->site_id,
        ];

        if ($this->metrics) {
            $data = array_merge(
                $data,
                $this->metrics->toApiPayload()
            );
        }

        if ($this->period) {
            $data = array_merge(
                $data,
                $this->period->toApiPayload()
            );
        }

        if ($this->filters) {
            $data = array_merge(
                $data,
                $this->filters->toApiPayload()
            );
        }

        if ($this->interval) {
            $data = array_merge(
                $data,
                $this->interval->toApiPayload()
            );
        }

        return $data;
    }
}