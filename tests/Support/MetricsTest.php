<?php

namespace Devarts\PlausiblePHP\Test\Support;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Devarts\PlausiblePHP\Support\Metrics;

class MetricsTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_stringify_metrics(): void
    {
        $metric = Metrics::create()
            ->add(Metrics::VISITS)
            ->add(Metrics::VISIT_DURATION);

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
        $metric = Metrics::create();

        $this->assertEquals('', $metric->toString());
    }

    /**
     * @test
     */
    public function it_should_add_custom_metric(): void
    {
        $metric = Metrics::create()->add('custom_metric');

        $this->assertEquals(
            'custom_metric',
            $metric->toString()
        );
    }
}