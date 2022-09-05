<?php

namespace Plausible\Test\Model;

use PHPUnit\Framework\TestCase;
use Plausible\Model\AggregatedMetrics;

class AggregatedMetricsTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_aggregated_metrics_from_api_response_for_all_metrics(): void
    {
        $metrics = AggregatedMetrics::fromApiResponse(
            <<<JSON
                {
                  "results": {
                    "bounce_rate": {
                        "value": 53.0
                    },
                    "pageviews": {
                        "value": 673814,
                        "change": 123
                    },
                    "visit_duration": {
                        "value": 86.0
                    },
                    "visitors": {
                        "value": 201524,
                        "change": -23.77
                    },
                    "events": {
                        "value": 132
                    },
                    "visits": {
                        "value": 1002
                    }
                  }
                }
            JSON
        );

        $this->assertEquals(53.0, $metrics->getBounceRate()->getValue());
        $this->assertEquals(null, $metrics->getBounceRate()->getChange());

        $this->assertEquals(673814, $metrics->getPageviews()->getValue());
        $this->assertEquals(123, $metrics->getPageviews()->getChange());

        $this->assertEquals(86.0, $metrics->getVisitDuration()->getValue());
        $this->assertEquals(null, $metrics->getVisitDuration()->getChange());

        $this->assertEquals(201524, $metrics->getVisitors()->getValue());
        $this->assertEquals(-23.77, $metrics->getVisitors()->getChange());

        $this->assertEquals(132, $metrics->getEvents()->getValue());
        $this->assertEquals(null, $metrics->getEvents()->getChange());

        $this->assertEquals(1002, $metrics->getVisits()->getValue());
        $this->assertEquals(null, $metrics->getVisits()->getChange());
    }

    /**
     * @test
     */
    public function it_should_create_aggregated_metrics_from_api_response_for_some_metrics(): void
    {
        $metrics = AggregatedMetrics::fromApiResponse(
            <<<JSON
                {
                  "results": {
                    "bounce_rate": {
                        "value": 53.0
                    },
                    "visitors": {
                        "value": 201524,
                        "change": -23.77
                    }
                  }
                }
            JSON
        );

        $this->assertEquals(53.0, $metrics->getBounceRate()->getValue());
        $this->assertEquals(null, $metrics->getBounceRate()->getChange());

        $this->assertEquals(201524, $metrics->getVisitors()->getValue());
        $this->assertEquals(-23.77, $metrics->getVisitors()->getChange());

        $this->assertNull($metrics->getPageviews());
        $this->assertNull($metrics->getVisitDuration());
        $this->assertNull($metrics->getEvents());
        $this->assertNull($metrics->getVisits());
    }
}