<?php

namespace Plausible\Model;

use DateTime;

class TimeseriesItem
{
    private DateTime $date;
    private int $visitors;

    public function __construct(DateTime $date, int $visitors)
    {
        $this->date = $date;
        $this->visitors = $visitors;
    }

    public static function fromArray(array $data): self
    {
        return new self(new DateTime($data['date']), $data['visitors']);
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function getVisitors(): int
    {
        return $this->visitors;
    }
}