<?php

namespace Devarts\PlausiblePHP\Test\Response;

use PHPUnit\Framework\TestCase;
use Devarts\PlausiblePHP\Response\AggregatedMetric;

class AggregatedMetricTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_aggregated_metric_from_array_without_change_property(): void
    {
        $metric = AggregatedMetric::fromArray([
            'value' => 23,
        ]);

        $this->assertEquals(23, $metric->value);
        $this->assertFalse(property_exists($metric, 'change'));
    }

    /**
     * @test
     */
    public function it_should_create_aggregated_metric_from_array(): void
    {
        $metric = AggregatedMetric::fromArray([
            'value' => 23,
            'change' => -32.2
        ]);

        $this->assertEquals(23, $metric->value);
        $this->assertEquals(-32.2, $metric->change);
    }
}