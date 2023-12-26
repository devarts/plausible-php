<?php

namespace Devarts\PlausiblePHP\Request;

use Devarts\PlausiblePHP\Support\Filters;
use Devarts\PlausiblePHP\Support\Metrics;

class GetAggregateRequest extends BaseRequest
{
    private string $site_id;
    private ?string $period;
    private ?string $compare;
    private ?Metrics $metrics;
    private ?Filters $filters;

    public function setSiteId(string $site_id): void
    {
        $this->site_id = $site_id;
    }

    public function setPeriod(?string $period): void
    {
        $this->period = $period;
    }

    public function setCompare(?string $compare): void
    {
        $this->compare = $compare;
    }

    public function setMetrics(?Metrics $metrics): void
    {
        $this->metrics = $metrics;
    }

    public function setFilters(?Filters $filters): void
    {
        $this->filters = $filters;
    }

    public function toRequestPayload(): array
    {
        return array_filter([
            'site_id' => $this->site_id ?? null,
            'period'  => $this->period ?? null,
            'compare' => $this->compare ?? null,
            'metrics' => $this->metrics?->toString(),
            'filters' => $this->filters?->toString(),
        ]);
    }
}