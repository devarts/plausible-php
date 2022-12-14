<?php

namespace Devarts\PlausiblePHP\Test\Response;

use PHPUnit\Framework\TestCase;
use Devarts\PlausiblePHP\Response\BreakdownCollection;

class BreakdownCollectionTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_breakdown_from_api_response_for_all_metrics(): void
    {
        $breakdown = BreakdownCollection::fromApiResponse(
            <<<JSON
                {
                  "results": [
                    {
                        "source": "Google",
                        "bounce_rate": 58,
                        "visitors": 16909,
                        "pageviews": 567,
                        "visit_duration": 347,
                        "events": 25,
                        "visits": 20000
                    },
                    {
                        "source": "Chrome",
                        "bounce_rate": 23,
                        "visitors": 10200,
                        "pageviews": 345,
                        "visit_duration": 245,
                        "events": 19,
                        "visits": 10200
                    }
                  ]
                }
            JSON
        );

        $item_1 = $breakdown->current();

        $this->assertEquals('Google', $item_1->source);
        $this->assertEquals(58, $item_1->bounce_rate);
        $this->assertEquals(16909, $item_1->visitors);
        $this->assertEquals(567, $item_1->pageviews);
        $this->assertEquals(347, $item_1->visit_duration);
        $this->assertEquals(25, $item_1->events);
        $this->assertEquals(20000, $item_1->visits);

        $breakdown->next();

        $item_2 = $breakdown->current();

        $this->assertEquals('Chrome', $item_2->source);
        $this->assertEquals(23, $item_2->bounce_rate);
        $this->assertEquals(10200, $item_2->visitors);
        $this->assertEquals(345, $item_2->pageviews);
        $this->assertEquals(245, $item_2->visit_duration);
        $this->assertEquals(19, $item_2->events);
        $this->assertEquals(10200, $item_2->visits);
    }

    /**
     * @test
     */
    public function it_should_create_breakdown_from_api_response_for_some_metrics(): void
    {
        $breakdown = BreakdownCollection::fromApiResponse(
            <<<JSON
                {
                  "results": [
                    {
                        "source": "Google",
                        "bounce_rate": 58,
                        "visitors": 16909
                    },
                    {
                        "source": "Chrome",
                        "bounce_rate": 23,
                        "visitors": 10200
                    }
                  ]
                }
            JSON
        );

        $this->assertEquals(2, count($breakdown));

        $item_1 = $breakdown->current();

        $this->assertEquals('Google', $item_1->source);
        $this->assertEquals(58.0, $item_1->bounce_rate);
        $this->assertEquals(16909, $item_1->visitors);

        $this->assertFalse(property_exists($item_1, 'visits'));
        $this->assertFalse(property_exists($item_1, 'pageviews'));
        $this->assertFalse(property_exists($item_1, 'visit_duration'));
        $this->assertFalse(property_exists($item_1, 'events'));

        $breakdown->next();

        $item_2 = $breakdown->current();

        $this->assertEquals('Chrome', $item_2->source);
        $this->assertEquals(23, $item_2->bounce_rate);
        $this->assertEquals(10200, $item_2->visitors);

        $this->assertFalse(property_exists($item_2, 'visits'));
        $this->assertFalse(property_exists($item_2, 'pageviews'));
        $this->assertFalse(property_exists($item_2, 'visit_duration'));
        $this->assertFalse(property_exists($item_2, 'events'));
    }
}