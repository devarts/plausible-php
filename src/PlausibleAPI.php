<?php

namespace Plausible;

use GuzzleHttp\Client;
use Plausible\Response\AggregatedMetrics;
use Plausible\Response\Breakdown;
use Plausible\Response\Goal;
use Plausible\Response\SharedLink;
use Plausible\Response\Timeseries;
use Plausible\Response\Website;

class PlausibleAPI
{
    /**
     * @var Client
     */
    protected Client $client;

    /**
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->client = new Client([
            'base_uri' => 'https://plausible.io/api/v1/',
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $token),
            ],
            'http_errors' => true,
        ]);
    }

    /**
     * @param string $site_id
     * @return int
     */
    public function getRealtimeVisitors(string $site_id): int
    {
        $response = $this->client->get('stats/realtime/visitors', [
            'query' => [
                'site_id' => $site_id,
            ],
        ]);

        return (int) $response->getBody()->getContents();
    }

    /**
     * @param string $site_id
     * @param array $extras
     * @return AggregatedMetrics
     */
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

        return AggregatedMetrics::fromApiResponse($response->getBody()->getContents());
    }

    /**
     * @param string $site_id
     * @param array $extras
     * @return Timeseries
     */
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

        return Timeseries::fromApiResponse($response->getBody()->getContents());
    }

    /**
     * @param string $site_id
     * @param string $property
     * @param array $extras
     * @return Breakdown
     */
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

        return Breakdown::fromApiResponse($response->getBody()->getContents());
    }

    /**
     * @param array $payload
     * @return Website
     */
    public function createWebsite(array $payload): Website
    {
        $response = $this->client->post('sites', [
            'form_params' => $payload,
        ]);

        return Website::fromApiResponse($response->getBody()->getContents());
    }

    /**
     * @param string $site_id
     * @return bool
     */
    public function deleteWebsite(string $site_id): bool
    {
        $response = $this->client->delete('sites/' . $site_id);

        return json_decode($response->getBody()->getContents(), true)['deleted'];
    }

    /**
     * @param string $site_id
     * @return Website
     */
    public function getWebsite(string $site_id): Website
    {
        $response = $this->client->get('sites/' . $site_id);

        return Website::fromApiResponse($response->getBody()->getContents());
    }

    /**
     * @param array $payload
     * @return SharedLink
     */
    public function createSharedLink(array $payload): SharedLink
    {
        $response = $this->client->put('sites/shared-links', [
            'form_params' => $payload,
        ]);

        return SharedLink::fromApiResponse($response->getBody()->getContents());
    }

    /**
     * @param array $payload
     * @return Goal
     */
    public function createGoal(array $payload): Goal
    {
        $response = $this->client->put('sites/goals', [
            'form_params' => $payload,
        ]);

        return Goal::fromApiResponse($response->getBody()->getContents());
    }

    /**
     * @param string $goal_id
     * @return bool
     */
    public function deleteGoal(string $goal_id): bool
    {
        $response = $this->client->delete('sites/goals/' . $goal_id);

        return json_decode($response->getBody()->getContents(), true)['deleted'];
    }
}