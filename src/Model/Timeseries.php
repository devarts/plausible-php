<?php

namespace Plausible\Model;

use DateTime;

class Timeseries
{
    private array $points;

    public function __construct(array $points)
    {
        $this->points = $points;
    }

    public static function fromArray(array $data): self
    {
        $points = [];

        foreach ($data as $point) {
            $points[] = TimeseriesPoint::fromArray($point);
        }

        return new self($points);
    }

    public function getPoints(): array
    {
        return $this->points;
    }
}