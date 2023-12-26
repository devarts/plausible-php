<?php

namespace Devarts\PlausiblePHP\Request;

use Devarts\PlausiblePHP\Support\Filters;
use Devarts\PlausiblePHP\Support\Metrics;

class GetTimeseriesRequest extends BaseRequest
{
    private string $site_id;
    private ?string $period;
    private ?Filters $filters;
    private ?Metrics $metrics;
    private ?string $interval;

    public function setSiteId(string $site_id): void
    {
        $this->site_id = $site_id;
    }

    public function setPeriod(?string $period): void
    {
        $this->period = $period;
    }

    public function setFilters(?Filters $filters): void
    {
        $this->filters = $filters;
    }

    public function setMetrics(?Metrics $metrics): void
    {
        $this->metrics = $metrics;
    }

    public function setInterval(?string $interval): void
    {
        $this->interval = $interval;
    }

    public function toRequestPayload(): array
    {
        return array_filter([
            'site_id'  => $this->site_id ?? null,
            'period'   => $this->period ?? null,
            'filters'  => $this->filters?->toString(),
            'metrics'  => $this->metrics?->toString(),
            'interval' => $this->interval ?? null,
        ]);
    }
}