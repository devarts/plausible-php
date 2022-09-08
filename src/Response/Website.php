<?php

namespace Plausible\Response;

/**
 * @property string $domain
 * @property string $timezone
 */
class Website extends BaseObject
{
    /**
     * @param string $json
     * @return static
     */
    public static function fromApiResponse(string $json): self
    {
        $data = json_decode($json, true);

        $website = new self();

        $website->createProperties($data);

        return $website;
    }
}