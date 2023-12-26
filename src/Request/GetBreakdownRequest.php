<?php

namespace Devarts\PlausiblePHP\Request;

use Devarts\PlausiblePHP\Support\Filters;
use Devarts\PlausiblePHP\Support\Metrics;

class GetBreakdownRequest extends BaseRequest
{
    private string $site_id;
    private string $property;
    private ?string $period;
    private ?Metrics $metrics;
    private ?Filters $filters;
    private ?int $limit;
    private ?int $page;

    public function setSiteId(string $site_id): void
    {
        $this->site_id = $site_id;
    }

    public function setProperty(string $property): void
    {
        $this->property = $property;
    }

    public function setPeriod(?string $period): void
    {
        $this->period = $period;
    }

    public function setMetrics(?Metrics $metrics): void
    {
        $this->metrics = $metrics;
    }

    public function setFilters(?Filters $filters): void
    {
        $this->filters = $filters;
    }

    public function setLimit(?int $limit): void
    {
        $this->limit = $limit;
    }

    public function setPage(?int $page): void
    {
        $this->page = $page;
    }

    public function toRequestPayload(): array
    {
        return array_filter([
            'site_id'  => $this->site_id ?? null,
            'property' => $this->property ?? null,
            'period'   => $this->period ?? null,
            'metrics'  => $this->metrics?->toString(),
            'filters'  => $this->filters?->toString(),
            'limit'    => $this->limit ?? null,
            'page'     => $this->page ?? null,
        ]);
    }
}