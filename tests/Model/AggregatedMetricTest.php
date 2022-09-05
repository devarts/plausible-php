<?php

namespace Plausible\Test\Model;

use LogicException;
use PHPUnit\Framework\TestCase;
use Plausible\Model\AggregatedMetric;

class AggregatedMetricTest extends TestCase
{
    /**
     * @test
     * @dataProvider aggregated_metrics
     */
    public function it_should_create_aggregated_metric_from_array(array $data, ?float $expected_value, ?float $expected_change): void
    {
        $metric = AggregatedMetric::fromArray($data);

        $this->assertEquals($expected_value, $metric->getValue());
        $this->assertEquals($expected_change, $metric->getChange());
    }

    /**
     * @test
     */
    public function it_should_throw_exception_when_creating_aggregated_metric_from_array_without_value(): void
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Missing parameter `value`.');

        AggregatedMetric::fromArray([]);
    }

    public function aggregated_metrics()
    {
        return [
            'only_value' => [['value' => 23.5], 23.5, null],
            'value_and_change' => [['value' => 23.5, 'change' => -32.2], 23.5, -32.2],
        ];
    }
}