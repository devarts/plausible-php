<?php

namespace Plausible\Request;

use Plausible\Request\Parameter\Filters;
use Plausible\Request\Parameter\Metrics;
use Plausible\Request\Parameter\Period;

class BreakdownRequest implements ApiPayloadPresentable
{
    private string $site_id;
    private string $property;
    private ?Period $period;
    private ?Metrics $metrics;
    private ?Filters $filters;
    private int $limit;
    private int $page;

    public function __construct(
        string $site_id,
        string $property,
        ?Period $period,
        ?Metrics $metrics,
        ?Filters $filters,
        ?int $limit,
        ?int $page
    ) {
        $this->site_id = $site_id;
        $this->property = $property;
        $this->period = $period;
        $this->metrics = $metrics;
        $this->filters = $filters;
        $this->limit = $limit;
        $this->page = $page;
    }

    public function toApiPayload(): array
    {
        $data = [
            'site_id' => $this->site_id,
            'property' => $this->property,
        ];

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