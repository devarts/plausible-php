<?php

namespace Plausible\Model;

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

        if (array_key_exists('date', $data)) {
            $timeseries_item->date = new DateTime($data['date']);
        }

        if (array_key_exists(Metric::BOUNCE_RATE, $data)) {
            $timeseries_item->{Metric::BOUNCE_RATE} = $data[Metric::BOUNCE_RATE];
        }

        if (array_key_exists(Metric::VISIT_DURATION, $data)) {
            $timeseries_item->{Metric::VISIT_DURATION} = $data[Metric::VISIT_DURATION];
        }

        if (array_key_exists(Metric::PAGEVIEWS, $data)) {
            $timeseries_item->{Metric::PAGEVIEWS} = $data[Metric::PAGEVIEWS];
        }

        if (array_key_exists(Metric::VISITS, $data)) {
            $timeseries_item->{Metric::VISITS} = $data[Metric::VISITS];
        }

        if (array_key_exists(Metric::VISITORS, $data)) {
            $timeseries_item->{Metric::VISITORS} = $data[Metric::VISITORS];
        }

        return $timeseries_item;
    }

    public function getSupportedProperties(): array
    {
        return [
            'date',
            Metric::BOUNCE_RATE,
            Metric::VISIT_DURATION,
            Metric::PAGEVIEWS,
            Metric::VISITS,
            Metric::VISITORS,
        ];
    }
}