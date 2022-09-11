<?php

namespace Devarts\PlausiblePHP\Test\Response;

use PHPUnit\Framework\TestCase;
use Devarts\PlausiblePHP\Response\SharedLink;

class SharedLinkTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_shared_link_from_api_response(): void
    {
        $shared_link = SharedLink::fromApiResponse(
            <<<JSON
                {
                    "name": "Wordpress",
                    "url": "https://plausible.io/share/site.com?auth=<random>"
                }
            JSON
        );

        $this->assertEquals('Wordpress', $shared_link->name);
        $this->assertEquals('https://plausible.io/share/site.com?auth=<random>', $shared_link->url);
    }
}