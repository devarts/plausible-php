<?php

namespace Plausible;

use GuzzleHttp\Client;
use Plausible\Model\AggregatedMetrics;
use Plausible\Model\Breakdown;
use Plausible\Model\Goal;
use Plausible\Model\SharedLink;
use Plausible\Model\Timeseries;
use Plausible\Model\Website;

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

    public function getAggregate(string $site_id, array $extras = []): AggregatedMetrics
    {
        $response = $this->client->get('stats/aggregate', [
            'query' => array_merge(
                $extras,
                [
                    'site_id' => $site_id,
                ]
            ),
        ]);

        return AggregatedMetrics::fromArray(
            json_decode($response->getBody()->getContents(), true)['results']
        );
    }

    public function getTimeseries(string $site_id, array $extras = []): Timeseries
    {
        $response = $this->client->get('stats/timeseries', [
            'query' => array_merge(
                $extras,
                [
                    'site_id' => $site_id,
                ]
            ),
        ]);

        return Timeseries::fromArray(
            json_decode($response->getBody()->getContents(), true)['results']
        );
    }

    public function getBreakdown(string $site_id, string $property, array $extras = []): Breakdown
    {
        $response = $this->client->get('stats/breakdown', [
            'query' => array_merge(
                $extras,
                [
                    'site_id' => $site_id,
                    'property' => $property,
                ]
            ),
        ]);

        return Breakdown::fromArray(
            json_decode($response->getBody()->getContents(), true)['results']
        );
    }

    public function createWebsite(array $payload): Website
    {
        $response = $this->client->post('sites', [
            'form_params' => $payload,
        ]);

        return Website::fromArray(
            json_decode($response->getBody()->getContents(), true)
        );
    }

    public function deleteWebsite(string $site_id): bool
    {
        $response = $this->client->delete('sites/' . $site_id);

        return json_decode($response->getBody()->getContents(), true)['deleted'];
    }

    public function getWebsite(string $site_id): Website
    {
        $response = $this->client->get('sites/' . $site_id);

        return Website::fromArray(
            json_decode($response->getBody()->getContents(), true)
        );
    }

    public function createSharedLink(array $payload): SharedLink
    {
        $response = $this->client->put('sites/shared-links', [
            'form_params' => $payload,
        ]);

        return SharedLink::fromArray(
            json_decode($response->getBody()->getContents(), true)
        );
    }

    public function createGoal(array $payload): Goal
    {
        $response = $this->client->put('sites/goals', [
            'form_params' => $payload,
        ]);

        return Goal::fromArray(
            json_decode($response->getBody()->getContents(), true)
        );
    }

    public function deleteGoal(string $goal_id): bool
    {
        $response = $this->client->delete('sites/goals/' . $goal_id);

        return json_decode($response->getBody()->getContents(), true)['deleted'];
    }
}