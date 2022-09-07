<?php

namespace Plausible\Test\Response;

use PHPUnit\Framework\TestCase;
use Plausible\Response\Website;

class WebsiteTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_website_from_api_response(): void
    {
        $website = Website::fromApiResponse(
            <<<JSON
                {
                    "domain": "test-domain.com",
                    "timezone": "Europe/London"
                }
            JSON
        );

        $this->assertEquals('test-domain.com', $website->domain);
        $this->assertEquals('Europe/London', $website->timezone);
    }
}