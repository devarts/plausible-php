<?php

namespace Plausible;

use GuzzleHttp\Client;

class PlausibleAPI
{
    protected Client $client;

    public function __construct(string $token)
    {
        $this->client = new Client([
          'base_uri' => 'https://plausible.io/api/v1/',
          'headers'  => [
            'Authorization' => sprintf('Bearer %s', $token),
          ],
        ]);
    }

    public function getRealtimeVisitors(string $site_id): int
    {
        $response = $this->client->get('stats/realtime/visitors', [
            'query' => [
                'site_id' => $site_id,
            ],
        ]);

        return (int) $response->getBody()->getContents();
    }

    public function getAggregate(string $site_id, array $payload = []): array
    {
        $response = $this->client->get('stats/aggregate', [
            'query' => array_merge([
                'site_id' => $site_id,
            ], $payload),
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getTimeseries(string $site_id, array $payload = []): array
    {
        $response = $this->client->get('stats/timeseries', [
            'query' => array_merge([
                'site_id' => $site_id,
            ], $payload),
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getBreakdown(string $site_id, string $property, array $payload = []): array
    {
        $response = $this->client->get('stats/breakdown', [
            'query' => array_merge([
                'site_id' => $site_id,
                'property' => $property,
            ], $payload),
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}