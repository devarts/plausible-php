<?php

namespace Plausible\Request\Parameter;

use Plausible\Request\ApiPayloadPresentable;

class Interval implements ApiPayloadPresentable
{
    public const DATE = 'date';
    public const MONTH = 'month';

    private string $interval;

    private function __construct(string $interval)
    {
        $this->interval = $interval;
    }

    public static function date(): self
    {
        return new self(self::DATE);
    }

    public static function month(): self
    {
        return new self(self::MONTH);
    }

    public function toApiPayload(): array
    {
        return [
            'interval' => $this->interval,
        ];
    }
}