<?php

namespace Plausible\Response;

/**
 * @property string $name
 * @property string $url
 */
class SharedLink extends BaseObject
{
    /**
     * @param string $json
     * @return static
     */
    public static function fromApiResponse(string $json): self
    {
        $data = json_decode($json, true);

        $shared_link = new self();

        $shared_link->createProperties($data);

        return $shared_link;
    }
}