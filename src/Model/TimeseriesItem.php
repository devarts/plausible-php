<?php

namespace Plausible\Model;

use DateTime;
use LogicException;
use Plausible\Support\Metric;

class TimeseriesItem
{
    private DateTime $date;
    private int $value;

    public function __construct(DateTime $date, int $value)
    {
        $this->date = $date;
        $this->value = $value;
    }

    public static function fromArray(array $data): self
    {
        foreach (Metric::SUPPORTED_METRICS as $metric) {
            if (isset($data[$metric])) {
                $value = $data[$metric];
                break;
            }
        }

        if (! isset($value)) {
            throw new LogicException('Timeseries item metric value not found.');
        }

        return new self(new DateTime($data['date']), $value);
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}