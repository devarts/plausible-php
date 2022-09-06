<?php

namespace Plausible\Test\Model;

use PHPUnit\Framework\TestCase;
use Plausible\Model\AggregatedMetric;

class AggregatedMetricTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_aggregated_metric_from_array_without_change_property(): void
    {
        $metric = AggregatedMetric::fromArray([
            'value' => 23.5,
        ]);

        $this->assertEquals(23.5, $metric->value);
        $this->assertFalse(property_exists($metric, 'change'));
    }

    /**
     * @test
     */
    public function it_should_create_aggregated_metric_from_array(): void
    {
        $metric = AggregatedMetric::fromArray([
            'value' => 23.5,
            'change' => -32.2
        ]);

        $this->assertEquals(23.5, $metric->value);
        $this->assertEquals(-32.2, $metric->change);
    }
}