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

    public function getRealtimeVisitors(array $payload): int
    {
        $response = $this->client->get('stats/realtime/visitors', [
            'query' => $payload,
        ]);

        return (int) $response->getBody()->getContents();
    }

    public function getAggregate(array $payload): array
    {
        $response = $this->client->get('stats/aggregate', [
            'query' => $payload,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getTimeseries(array $payload): array
    {
        $response = $this->client->get('stats/timeseries', [
            'query' => $payload,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getBreakdown(array $payload): array
    {
        $response = $this->client->get('stats/breakdown', [
            'query' => $payload,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function createEvent(array $payload, array $headers = []): void
    {
        $this->client->post('stats/breakdown', [
            'headers' => $headers,
            'form_params' => $payload,
        ]);
    }
}