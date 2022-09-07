<?php

namespace Plausible\Test\Response;

use PHPUnit\Framework\TestCase;
use Plausible\Response\BreakdownItem;

class BreakdownItemTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_breakdown_item_from_array(): void {
        $breakdown_item = BreakdownItem::fromArray([
            'source' => 'Google',
            'bounce_rate' => 58,
            'visitors' => 16909,
            'pageviews' => 567,
            'visit_duration' => 347,
            'events' => 25,
            'visits' => 20000
        ]);

        $this->assertEquals('Google', $breakdown_item->source);
        $this->assertEquals(58, $breakdown_item->bounce_rate);
        $this->assertEquals(16909, $breakdown_item->visitors);
        $this->assertEquals(567, $breakdown_item->pageviews);
        $this->assertEquals(347, $breakdown_item->visit_duration);
        $this->assertEquals(25, $breakdown_item->events);
        $this->assertEquals(20000, $breakdown_item->visits);

        $this->assertFalse(property_exists($breakdown_item, 'page'));
        $this->assertFalse(property_exists($breakdown_item, 'browser_version'));
    }

    /**
     * @test
     */
    public function it_should_create_breakdown_item_from_array_when_not_all_metrics_provided(): void {
        $breakdown_item = BreakdownItem::fromArray([
            'source' => 'Google',
            'bounce_rate' => 58,
            'visits' => 20000
        ]);

        $this->assertEquals('Google', $breakdown_item->source);
        $this->assertEquals(58, $breakdown_item->bounce_rate);
        $this->assertEquals(20000, $breakdown_item->visits);

        $this->assertFalse(property_exists($breakdown_item, 'visitors'));
        $this->assertFalse(property_exists($breakdown_item, 'pageviews'));
        $this->assertFalse(property_exists($breakdown_item, 'visit_duration'));
        $this->assertFalse(property_exists($breakdown_item, 'events'));
        $this->assertFalse(property_exists($breakdown_item, 'page'));
        $this->assertFalse(property_exists($breakdown_item, 'browser_version'));
    }
}