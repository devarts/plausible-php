<?php

namespace Plausible;

use GuzzleHttp\Client;

abstract class PlausibleAPI
{
    private Client $client;

    public function __construct(string $token)
    {
        $this->client = new Client([
          'base_uri' => 'https://plausible.io/api/v1/',
          'headers'  => [
            'Authorization' => sprintf('Bearer %s', $token),
          ],
        ]);
    }
}