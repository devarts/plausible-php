<?php

namespace Plausible\Test\Support;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Plausible\Support\Metric;

class MetricTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_stringify_metrics(): void
    {
        $metric = Metric::create()
            ->add(Metric::VISITS)
            ->add(Metric::VISIT_DURATION);

        $this->assertEquals(
            'visits,visit_duration',
            $metric->toString()
        );
    }

    /**
     * @test
     */
    public function it_should_stringify_empty_metrics(): void
    {
        $metric = Metric::create();

        $this->assertEquals('', $metric->toString());
    }

    /**
     * @test
     */
    public function it_should_throw_exception_when_adding_filter_for_unsupported_property(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported metric provided: `unsupported_metric`');

        Metric::create()->add('unsupported_metric');
    }
}