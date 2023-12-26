<?php

namespace Devarts\PlausiblePHP;

use Devarts\PlausiblePHP\Request\CreateGoalRequest;
use Devarts\PlausiblePHP\Request\CreateSharedLinkRequest;
use Devarts\PlausiblePHP\Request\CreateWebsiteRequest;
use Devarts\PlausiblePHP\Request\DeleteGoalRequest;
use Devarts\PlausiblePHP\Request\GetAggregateRequest;
use Devarts\PlausiblePHP\Request\GetBreakdownRequest;
use Devarts\PlausiblePHP\Request\GetRealtimeVisitorsRequest;
use Devarts\PlausiblePHP\Request\GetTimeseriesRequest;
use Devarts\PlausiblePHP\Request\UpdateWebsiteRequest;
use GuzzleHttp\Client;
use Devarts\PlausiblePHP\Response\AggregatedMetrics;
use Devarts\PlausiblePHP\Response\BreakdownCollection;
use Devarts\PlausiblePHP\Response\Goal;
use Devarts\PlausiblePHP\Response\SharedLink;
use Devarts\PlausiblePHP\Response\TimeseriesCollection;
use Devarts\PlausiblePHP\Response\Website;

class PlausibleAPI
{
    protected Client $client;

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

    public function getRealtimeVisitors(GetRealtimeVisitorsRequest $request): int
    {
        $response = $this->client->get('stats/realtime/visitors', [
            'query' => $request->toRequestPayload(),
        ]);

        return (int) $response->getBody()->getContents();
    }

    public function getAggregate(GetAggregateRequest $request): AggregatedMetrics
    {
        $response = $this->client->get('stats/aggregate', [
            'query' => $request->toRequestPayload(),
        ]);

        return AggregatedMetrics::fromApiResponse($response->getBody()->getContents());
    }

    public function getTimeseries(GetTimeseriesRequest $request): TimeseriesCollection
    {
        $response = $this->client->get('stats/timeseries', [
            'query' => $request->toRequestPayload(),
        ]);

        return TimeseriesCollection::fromApiResponse($response->getBody()->getContents());
    }

    public function getBreakdown(GetBreakdownRequest $request): BreakdownCollection
    {
        $response = $this->client->get('stats/breakdown', [
            'query' => $request->toRequestPayload(),
        ]);

        return BreakdownCollection::fromApiResponse($response->getBody()->getContents());
    }

    public function createWebsite(CreateWebsiteRequest $request): Website
    {
        $response = $this->client->post('sites', [
            'form_params' => $request->toRequestPayload(),
        ]);

        return Website::fromApiResponse($response->getBody()->getContents());
    }

    public function updateWebsite(string $site_id, UpdateWebsiteRequest $request): Website
    {
        $response = $this->client->put('sites/' . urlencode($site_id), [
            'form_params' => $request->toRequestPayload(),
        ]);

        return Website::fromApiResponse($response->getBody()->getContents());
    }

    public function deleteWebsite(string $site_id): bool
    {
        $response = $this->client->delete('sites/' . urlencode($site_id));

        return json_decode($response->getBody()->getContents(), true)['deleted'];
    }

    public function getWebsite(string $site_id): Website
    {
        $response = $this->client->get('sites/' . urlencode($site_id));

        return Website::fromApiResponse($response->getBody()->getContents());
    }

    public function createSharedLink(CreateSharedLinkRequest $request): SharedLink
    {
        $response = $this->client->put('sites/shared-links', [
            'form_params' => $request->toRequestPayload(),
        ]);

        return SharedLink::fromApiResponse($response->getBody()->getContents());
    }

    public function createGoal(CreateGoalRequest $request): Goal
    {
        $response = $this->client->put('sites/goals', [
            'form_params' => $request->toRequestPayload(),
        ]);

        return Goal::fromApiResponse($response->getBody()->getContents());
    }

    public function deleteGoal(int $goal_id, DeleteGoalRequest $request): bool
    {
        $response = $this->client->delete('sites/goals/' . urlencode((string) $goal_id), [
            'form_params' => $request->toRequestPayload(),
        ]);

        return json_decode($response->getBody()->getContents(), true)['deleted'];
    }
}