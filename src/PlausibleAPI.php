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

    public function createWebsite(array $payload): void
    {
        $this->client->post('sites', [
            'form_params' => $payload,
        ]);
    }

    public function deleteWebsite(string $site_id): void
    {
        $this->client->delete('sites/' . $site_id);
    }

    public function getWebsite(string $site_id): array
    {
        $response = $this->client->get('sites/' . $site_id);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function createSharedLink(array $payload): array
    {
        $response = $this->client->put('sites/shared-links', [
            'form_params' => $payload,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function createGoal(array $payload): array
    {
        $response = $this->client->put('sites/goals', [
            'form_params' => $payload,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function deleteGoal(string $goal_id, array $payload): void
    {
        $this->client->delete('sites/goals/' . $goal_id);
    }
}