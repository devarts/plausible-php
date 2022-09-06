<?php

namespace Plausible\Model;

use Plausible\Support\Metric;
use Plausible\Support\Property;

/**
 * @property string $name
 * @property string $page
 * @property string $entry_page
 * @property string $exit_page
 * @property string $source
 * @property string $referrer
 * @property string $utm_medium
 * @property string $utm_source
 * @property string $utm_campaign
 * @property string $utm_content
 * @property string $utm_term
 * @property string $device
 * @property string $browser
 * @property string $browser_version
 * @property string $os
 * @property string $os_version
 * @property string $country
 * @property string $region
 * @property string $city
 * @property int|null $visitors
 * @property int|null $pageviews
 * @property int|null $bounce_rate
 * @property int|null $visit_duration
 * @property int|null $events
 * @property int|null $visits
 */
class BreakdownItem extends BaseObject
{
    public static function fromArray(array $data): self
    {
        $breakdown_item = new self();

        foreach (Property::SUPPORTED_PROPERTIES as $property) {
            $property = explode(':', $property)[1];

            if (array_key_exists($property, $data)) {
                $breakdown_item->$property = $data[$property];
            }
        }

        if (array_key_exists(Metric::VISITORS, $data)) {
            $breakdown_item->{Metric::VISITORS} = $data[Metric::VISITORS];
        }

        if (array_key_exists(Metric::PAGEVIEWS, $data)) {
            $breakdown_item->{Metric::PAGEVIEWS} = $data[Metric::PAGEVIEWS];
        }

        if (array_key_exists(Metric::BOUNCE_RATE, $data)) {
            $breakdown_item->{Metric::BOUNCE_RATE} = $data[Metric::BOUNCE_RATE];
        }

        if (array_key_exists(Metric::VISIT_DURATION, $data)) {
            $breakdown_item->{Metric::VISIT_DURATION} = $data[Metric::VISIT_DURATION];
        }

        if (array_key_exists(Metric::EVENTS, $data)) {
            $breakdown_item->{Metric::EVENTS} = $data[Metric::EVENTS];
        }

        if (array_key_exists(Metric::VISITS, $data)) {
            $breakdown_item->{Metric::VISITS} = $data[Metric::VISITS];
        }

        return $breakdown_item;
    }

    public function getSupportedProperties(): array
    {
        return [
            ...array_map(
                fn ($property) => explode(':', $property)[1],
                Property::SUPPORTED_PROPERTIES
            ),
            Metric::VISITORS,
            Metric::PAGEVIEWS,
            Metric::BOUNCE_RATE,
            Metric::VISIT_DURATION,
            Metric::EVENTS,
            Metric::VISITS,
        ];
    }
}