<?php

namespace Devarts\PlausiblePHP\Response;

/**
 * @property string $name
 * @property string $url
 */
class SharedLink extends BaseObject
{
    public static function fromApiResponse(string $json): self
    {
        $data = json_decode($json, true);

        $shared_link = new self();

        $shared_link->createProperties($data);

        return $shared_link;
    }
}