<?php

namespace Plausible\Response;

use DateTime;
use Exception;

/**
 * @property DateTime $date
 * @property int|null $bounce_rate
 * @property int|null $visit_duration
 * @property int|null $pageviews
 * @property int|null $visits
 * @property int|null $visitors
 */
class TimeseriesItem extends BaseObject
{
    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): self
    {
        $timeseries_item = new self();

        $timeseries_item->createProperties($data);

        return $timeseries_item;
    }

    /**
     * @param $name
     * @param $value
     * @return void
     * @throws Exception
     */
    protected function createProperty($name, $value): void
    {
        switch ($name) {
            case 'date':
                $this->$name = new DateTime($value);
                break;
            default:
                parent::createProperty($name, $value);
        }
    }
}