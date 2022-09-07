<?php

namespace Plausible\Response;

use DateTime;
use LogicException;
use Plausible\Support\Metric;

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
    public static function fromArray(array $data): self
    {
        $timeseries_item = new self();

        $timeseries_item->createProperties($data);

        return $timeseries_item;
    }
}