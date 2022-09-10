<?php

namespace Plausible\Test\Response;

use PHPUnit\Framework\TestCase;
use Plausible\Response\TimeseriesCollection;

class TimeseriesCollectionTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_timeseries_from_api_response_for_all_metrics(): void
    {
        $timeseries = TimeseriesCollection::fromApiResponse(
            <<<JSON
                {
                  "results": [
                    {
                        "date": "2020-12-01",
                        "bounce_rate": 58,
                        "visitors": 16909,
                        "pageviews": 567,
                        "visit_duration": 347,
                        "visits": 20000
                    },
                    {
                        "date": "2020-12-02",
                        "bounce_rate": 23,
                        "visitors": 10200,
                        "pageviews": 345,
                        "visit_duration": 245,
                        "visits": 10200
                    }
                  ]
                }
            JSON
        );

        $item_1 = $timeseries->current();

        $this->assertEquals('2020-12-01', $item_1->date->format('Y-m-d'));
        $this->assertEquals(58, $item_1->bounce_rate);
        $this->assertEquals(16909, $item_1->visitors);
        $this->assertEquals(567, $item_1->pageviews);
        $this->assertEquals(347, $item_1->visit_duration);
        $this->assertEquals(20000, $item_1->visits);

        $timeseries->next();

        $item_2 = $timeseries->current();

        $this->assertEquals('2020-12-02', $item_2->date->format('Y-m-d'));
        $this->assertEquals(23, $item_2->bounce_rate);
        $this->assertEquals(10200, $item_2->visitors);
        $this->assertEquals(345, $item_2->pageviews);
        $this->assertEquals(245, $item_2->visit_duration);
        $this->assertEquals(10200, $item_2->visits);
    }

    /**
     * @test
     */
    public function it_should_create_timeseries_from_api_response_for_some_metrics(): void
    {
        $timeseries = TimeseriesCollection::fromApiResponse(
            <<<JSON
                {
                  "results": [
                    {
                        "date": "2020-12-01",
                        "bounce_rate": 58,
                        "visitors": 16909
                    },
                    {
                        "date": "2020-12-02",
                        "bounce_rate": 23,
                        "visitors": 10200
                    }
                  ]
                }
            JSON
        );

        $this->assertEquals(2, count($timeseries));

        $item_1 = $timeseries->current();

        $this->assertEquals('2020-12-01', $item_1->date->format('Y-m-d'));
        $this->assertEquals(58.0, $item_1->bounce_rate);
        $this->assertEquals(16909, $item_1->visitors);

        $this->assertFalse(property_exists($item_1, 'visits'));
        $this->assertFalse(property_exists($item_1, 'pageviews'));
        $this->assertFalse(property_exists($item_1, 'visit_duration'));

        $timeseries->next();

        $item_2 = $timeseries->current();

        $this->assertEquals('2020-12-02', $item_2->date->format('Y-m-d'));
        $this->assertEquals(23, $item_2->bounce_rate);
        $this->assertEquals(10200, $item_2->visitors);

        $this->assertFalse(property_exists($item_2, 'visits'));
        $this->assertFalse(property_exists($item_2, 'pageviews'));
        $this->assertFalse(property_exists($item_2, 'visit_duration'));
    }
}