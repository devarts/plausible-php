<?php

namespace Plausible\Test\Response;

use PHPUnit\Framework\TestCase;
use Plausible\Response\Goal;

class GoalTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_goal_from_api_response(): void
    {
        $goal = Goal::fromApiResponse(
            <<<JSON
                {
                    "domain": "test-domain.com",
                    "id": "1",
                    "goal_type": "event",
                    "event_name": "Signup",
                    "page_path": null
                }
            JSON
        );

        $this->assertEquals('test-domain.com', $goal->domain);
        $this->assertEquals('1', $goal->id);
        $this->assertEquals('event', $goal->goal_type);
        $this->assertEquals('Signup', $goal->event_name);
        $this->assertEquals(null, $goal->page_path);

        $this->assertTrue(property_exists($goal,'page_path'));
    }
}