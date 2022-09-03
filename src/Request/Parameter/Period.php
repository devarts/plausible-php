<?php

namespace Plausible\Request\Parameter;

use DateTime;
use LogicException;
use Plausible\Request\ApiPayloadPresentable;

class Period implements ApiPayloadPresentable
{
    public const MONTHS_12 = '12mo';
    public const MONTHS_6 = '6mo';
    public const MONTH = 'month';
    public const DAYS_30 = '30d';
    public const DAYS_7 = '7d';
    public const DAY = 'day';
    public const CUSTOM = 'custom';

    private string $period;
    private ?DateTime $date_from;
    private ?DateTime $date_to;

    /**
     * @param string $period
     * @param DateTime|null $date_from
     * @param DateTime|null $date_to
     */
    public function __construct(string $period, ?DateTime $date_from = null, ?DateTime $date_to = null)
    {
        $this->period = $period;
        $this->date_from = $date_from;
        $this->date_to = $date_to;
    }


    public static function months12(): self
    {
        return new self(self::MONTHS_12);
    }

    public static function months6(): self
    {
        return new self(self::MONTHS_6);
    }

    public static function month(): self
    {
        return new self(self::MONTH);
    }

    public static function days30(): self
    {
        return new self(self::DAYS_30);
    }

    public static function days7(): self
    {
        return new self(self::DAYS_7);
    }

    public static function day(): self
    {
        return new self(self::DAY);
    }

    public function custom(DateTime $date_from, DateTime $date_to)
    {
        if ($date_from > $date_to) {
            throw new LogicException('Date from cannot be greater than date to.');
        }

        return new self(self::CUSTOM, $date_from, $date_to);
    }

    public function toApiPayload(): array
    {
        $data['period'] = $this->period;

        if ($this->period === self::CUSTOM) {
            $data['date'] = sprintf(
                '%s,%s',
                $this->date_from->format('YYYY-MM-DD'),
                $this->date_to->format('YYYY-MM-DD')
            );
        }

        return $data;
    }
}