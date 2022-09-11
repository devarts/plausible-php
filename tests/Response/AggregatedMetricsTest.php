<?php

namespace Devarts\PlausiblePHP\Test\Response;

use PHPUnit\Framework\TestCase;
use Devarts\PlausiblePHP\Response\AggregatedMetrics;

class AggregatedMetricsTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_aggregated_metrics_from_api_response(): void
    {
        $metrics = AggregatedMetrics::fromApiResponse(
            <<<JSON
                {
                  "results": {
                    "bounce_rate": {
                        "value": 53,
                        "change": -2.002
                    },
                    "pageviews": {
                        "value": 673814,
                        "change": 123
                    },
                    "visit_duration": {
                        "value": 86,
                        "change": -7
                    },
                    "visitors": {
                        "value": 201524,
                        "change": -23.77
                    },
                    "events": {
                        "value": 132,
                        "change": -2144.23
                    },
                    "visits": {
                        "value": 1002,
                        "change": 0
                    }
                  }
                }
            JSON
        );

        $this->assertEquals(53, $metrics->bounce_rate->value);
        $this->assertEquals(-2.002, $metrics->bounce_rate->change);

        $this->assertEquals(673814, $metrics->pageviews->value);
        $this->assertEquals(123, $metrics->pageviews->change);

        $this->assertEquals(86, $metrics->visit_duration->value);
        $this->assertEquals(-7, $metrics->visit_duration->change);

        $this->assertEquals(201524, $metrics->visitors->value);
        $this->assertEquals(-23.77, $metrics->visitors->change);

        $this->assertEquals(132, $metrics->events->value);
        $this->assertEquals(-2144.23, $metrics->events->change);

        $this->assertEquals(1002, $metrics->visits->value);
        $this->assertEquals(0, $metrics->visits->change);
    }

    /**
     * @test
     */
    public function it_should_create_aggregated_metrics_from_api_response_without_change_property(): void
    {
        $metrics = AggregatedMetrics::fromApiResponse(
            <<<JSON
                {
                  "results": {
                    "bounce_rate": {
                        "value": 53
                    },
                    "pageviews": {
                        "value": 673814
                    },
                    "visit_duration": {
                        "value": 86
                    },
                    "visitors": {
                        "value": 201524
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

        $this->assertEquals(53, $metrics->bounce_rate->value);
        $this->assertFalse(property_exists($metrics->bounce_rate, 'change'));

        $this->assertEquals(673814, $metrics->pageviews->value);
        $this->assertFalse(property_exists($metrics->pageviews, 'change'));

        $this->assertEquals(86, $metrics->visit_duration->value);
        $this->assertFalse(property_exists($metrics->visit_duration, 'change'));

        $this->assertEquals(201524, $metrics->visitors->value);
        $this->assertFalse(property_exists($metrics->visitors, 'change'));

        $this->assertEquals(132, $metrics->events->value);
        $this->assertFalse(property_exists($metrics->events, 'change'));

        $this->assertEquals(1002, $metrics->visits->value);
        $this->assertFalse(property_exists($metrics->visits, 'change'));
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
                        "value": 53,
                        "change": 1235
                    },
                    "visitors": {
                        "value": 201524,
                        "change": -23.77
                    }
                  }
                }
            JSON
        );

        $this->assertEquals(53, $metrics->bounce_rate->value);
        $this->assertEquals(1235, $metrics->bounce_rate->change);

        $this->assertEquals(201524, $metrics->visitors->value);
        $this->assertEquals(-23.77, $metrics->visitors->change);

        $this->assertFalse(property_exists($metrics, 'pageviews'));
        $this->assertFalse(property_exists($metrics, 'visit_duration'));
        $this->assertFalse(property_exists($metrics, 'events'));
        $this->assertFalse(property_exists($metrics, 'visits'));
    }
}