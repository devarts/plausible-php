<?php

namespace Plausible\Test\Model;

use PHPUnit\Framework\TestCase;
use Plausible\Model\Breakdown;

class BreakdownTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_breakdown_from_api_response_for_all_metrics(): void
    {
        $breakdown = Breakdown::fromApiResponse(
            <<<JSON
                {
                  "results": [
                    {
                        "source": "Google",
                        "bounce_rate": 58.0,
                        "visitors": 16909,
                        "pageviews": 567,
                        "visit_duration": 347,
                        "events": 25,
                        "visits": 20000
                    },
                    {
                        "source": "Chrome",
                        "bounce_rate": 23.0,
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

        $item_1 = $breakdown->getItems()[0];

        $this->assertEquals('Google', $item_1->getPropertyValue());
        $this->assertEquals(58.0, $item_1->getBounceRate());
        $this->assertEquals(16909, $item_1->getVisitors());
        $this->assertEquals(567, $item_1->getPageviews());
        $this->assertEquals(347, $item_1->getVisitDuration());
        $this->assertEquals(25, $item_1->getEvents());
        $this->assertEquals(20000, $item_1->getVisits());

        $item_2 = $breakdown->getItems()[1];

        $this->assertEquals('Chrome', $item_2->getPropertyValue());
        $this->assertEquals(23.0, $item_2->getBounceRate());
        $this->assertEquals(10200, $item_2->getVisitors());
        $this->assertEquals(345, $item_2->getPageviews());
        $this->assertEquals(245, $item_2->getVisitDuration());
        $this->assertEquals(19, $item_2->getEvents());
        $this->assertEquals(10200, $item_2->getVisits());
    }

    /**
     * @test
     */
    public function it_should_create_breakdown_from_api_response_for_some_metrics(): void
    {
        $breakdown = Breakdown::fromApiResponse(
            <<<JSON
                {
                  "results": [
                    {
                        "source": "Google",
                        "bounce_rate": 58.0,
                        "visitors": 16909
                    },
                    {
                        "source": "Chrome",
                        "bounce_rate": 23.0,
                        "visitors": 10200
                    }
                  ]
                }
            JSON
        );

        $item_1 = $breakdown->getItems()[0];

        $this->assertEquals('Google', $item_1->getPropertyValue());
        $this->assertEquals(58.0, $item_1->getBounceRate());
        $this->assertEquals(16909, $item_1->getVisitors());
        $this->assertEquals(null, $item_1->getPageviews());
        $this->assertEquals(null, $item_1->getVisitDuration());
        $this->assertEquals(null, $item_1->getEvents());
        $this->assertEquals(null, $item_1->getVisits());

        $item_2 = $breakdown->getItems()[1];

        $this->assertEquals('Chrome', $item_2->getPropertyValue());
        $this->assertEquals(23.0, $item_2->getBounceRate());
        $this->assertEquals(10200, $item_2->getVisitors());
        $this->assertEquals(null, $item_2->getPageviews());
        $this->assertEquals(null, $item_2->getVisitDuration());
        $this->assertEquals(null, $item_2->getEvents());
        $this->assertEquals(null, $item_2->getVisits());
    }
}