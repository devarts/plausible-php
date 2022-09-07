<?php

namespace Plausible\Test\Response;

use PHPUnit\Framework\TestCase;
use Plausible\Response\TimeseriesItem;

class TimeseriesItemTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_timeseries_item_from_array(): void {
        $timeseries_item = TimeseriesItem::fromArray([
            'date' => '2020-12-01',
            'bounce_rate' => 58,
            'visitors' => 16909,
            'pageviews' => 567,
            'visit_duration' => 347,
            'visits' => 20000
        ]);

        $this->assertEquals('2020-12-01', $timeseries_item->date->format('Y-m-d'));
        $this->assertEquals(58, $timeseries_item->bounce_rate);
        $this->assertEquals(16909, $timeseries_item->visitors);
        $this->assertEquals(567, $timeseries_item->pageviews);
        $this->assertEquals(347, $timeseries_item->visit_duration);
        $this->assertEquals(20000, $timeseries_item->visits);
    }

    /**
     * @test
     */
    public function it_should_create_timeseries_item_from_array_when_not_all_metrics_provided(): void {
        $timeseries_item = TimeseriesItem::fromArray([
            'date' => '2020-12-01',
            'bounce_rate' => 58,
            'visits' => 20000
        ]);

        $this->assertEquals('2020-12-01', $timeseries_item->date->format('Y-m-d'));
        $this->assertEquals(58, $timeseries_item->bounce_rate);
        $this->assertEquals(20000, $timeseries_item->visits);

        $this->assertFalse(property_exists($timeseries_item, 'visitors'));
        $this->assertFalse(property_exists($timeseries_item, 'pageviews'));
        $this->assertFalse(property_exists($timeseries_item, 'visit_duration'));
    }
}