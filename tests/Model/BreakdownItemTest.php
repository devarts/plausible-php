<?php

namespace Plausible\Test\Model;

use LogicException;
use PHPUnit\Framework\TestCase;
use Plausible\Model\AggregatedMetric;
use Plausible\Model\BreakdownItem;

class BreakdownItemTest extends TestCase
{
    /**
     * @test
     * @dataProvider breakdown_items
     */
    public function it_should_create_breakdown_item_from_array(
        array $data,
        ?string $expected_property_value,
        ?float $expected_visitors,
        ?float $expected_pageviews,
        ?float $expected_bounce_rate,
        ?float $expected_visit_duration,
        ?float $expected_events,
        ?float $expected_visits
    ): void {
        $breakdown_item = BreakdownItem::fromArray($data);

        $this->assertEquals($expected_property_value, $breakdown_item->getPropertyValue());
        $this->assertEquals($expected_visitors, $breakdown_item->getVisitors());
        $this->assertEquals($expected_pageviews, $breakdown_item->getPageviews());
        $this->assertEquals($expected_bounce_rate, $breakdown_item->getBounceRate());
        $this->assertEquals($expected_visit_duration, $breakdown_item->getVisitDuration());
        $this->assertEquals($expected_events, $breakdown_item->getEvents());
        $this->assertEquals($expected_visits, $breakdown_item->getVisits());
    }

    /**
     * @test
     * @dataProvider breakdown_items
     */
    public function it_should_throw_exception_when_creating_breakdown_item_with_unsupported_property(): void
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Breakdown item property value not found.');

        BreakdownItem::fromArray([
            'unsupported_property' => 'Google',
            'bounce_rate' => 58.0,
        ]);
    }

    public function breakdown_items()
    {
        return [
            'all_metrics' => [
                [
                    'source' => 'Google',
                    'bounce_rate' => 58.0,
                    'visitors' => 16909,
                    'pageviews' => 567,
                    'visit_duration' => 347,
                    'events' => 25,
                    'visits' => 20000
                ], "Google", 16909, 567, 58.0, 347, 25, 20000
            ],
            'some_metrics' => [
                [
                    'source' => 'Google',
                    'bounce_rate' => 58.0,
                    'visits' => 20000
                ], "Google", null, null, 58.0, null, null, 20000
            ],
        ];
    }
}