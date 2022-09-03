<?php

namespace Plausible\Request;

use Plausible\Request\Parameter\Filters;
use Plausible\Request\Parameter\Metrics;
use Plausible\Request\Parameter\Period;

class TimeseriesRequest implements ApiPayloadPresentable
{
    private ?string $site_id;
    private ?Period $period;
    private ?Filters $filters;
    private ?Metrics $metrics;
    private ?string $interval;

    private function __construct()
    {
        $this->site_id = null;
        $this->period = null;
        $this->filters = null;
        $this->metrics = null;
        $this->interval = null;
    }


    public static function create(): self
    {
        return new self();
    }

    public function withSiteId(string $site_id): self
    {
        $request = clone $this;

        $request->site_id = $site_id;

        return $request;
    }

    public function withPeriod(Period $period): self
    {
        $request = clone $this;

        $request->period = $period;

        return $request;
    }

    public function withFilters(Filters $filters): self
    {
        $request = clone $this;

        $request->filters = $filters;

        return $request;
    }

    public function withMetrics(Metrics $metrics): self
    {
        $request = clone $this;

        $request->metrics = $metrics;

        return $request;
    }

    public function withInterval(string $interval): self
    {
        $request = clone $this;

        $request->interval = $interval;

        return $request;
    }

    public function toApiPayload(): array
    {
        $data = [];

        if ($this->site_id) {
            $data['site_id'] = $this->site_id;
        }

        if ($this->interval) {
            $data['interval'] = $this->interval;
        }

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

        return $data;
    }
}