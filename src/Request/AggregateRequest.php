<?php

namespace Plausible\Request;

use Plausible\Request\Parameter\Filters;
use Plausible\Request\Parameter\Metrics;
use Plausible\Request\Parameter\Period;

class AggregateRequest implements ApiPayloadPresentable
{
    private string $site_id;
    private ?Period $period;
    private ?Metrics $metrics;
    private ?bool $compare;
    private ?Filters $filters;

    public function __construct(
        string $site_id,
        ?Period $period,
        ?Metrics $metrics,
        ?bool $compare,
        ?Filters $filters
    ) {
        $this->site_id = $site_id;
        $this->period = $period;
        $this->metrics = $metrics;
        $this->compare = $compare;
        $this->filters = $filters;
    }

    public function toApiPayload(): array
    {
        $data = [
            'site_id' => $this->site_id,
        ];

        if ($this->compare) {
            $data['compare'] = 'previous_period';
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