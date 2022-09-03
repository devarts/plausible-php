<?php

namespace Plausible\Request;

use Plausible\Request\Parameter\Filters;
use Plausible\Request\Parameter\Metrics;
use Plausible\Request\Parameter\Period;

class BreakdownRequest implements ApiPayloadPresentable
{
    private ?string $site_id;
    private ?string $property;
    private ?Period $period;
    private ?Metrics $metrics;
    private ?Filters $filters;
    private ?int $limit;
    private ?int $page;

    private function __construct()
    {
        $this->site_id = null;
        $this->property = null;
        $this->period = null;
        $this->metrics = null;
        $this->filters = null;
        $this->limit = null;
        $this->page = null;
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

    public function withProperty(string $property): self
    {
        $request = clone $this;

        $request->property = $property;

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

    public function withLimit(int $limit): self
    {
        $request = clone $this;

        $request->limit = $limit;

        return $request;
    }

    public function withPage(int $page): self
    {
        $request = clone $this;

        $request->page = $page;

        return $request;
    }

    public function toApiPayload(): array
    {
        $data = [];

        if ($this->site_id) {
            $data['site_id'] = $this->site_id;
        }

        if ($this->property) {
            $data['property'] = $this->property;
        }

        if ($this->limit) {
            $data['limit'] = $this->limit;
        }

        if ($this->page) {
            $data['page'] = $this->page;
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