<?php

namespace Devarts\PlausiblePHP\Request;

class CreateGoalRequest extends BaseRequest
{
    private string $site_id;
    private string $goal_type;
    private string $event_name;
    private string $page_path;

    public function setSiteId(string $site_id): void
    {
        $this->site_id = $site_id;
    }

    public function setGoalType(string $goal_type): void
    {
        $this->goal_type = $goal_type;
    }

    public function setEventName(string $event_name): void
    {
        $this->event_name = $event_name;
    }

    public function setPagePath(string $page_path): void
    {
        $this->page_path = $page_path;
    }

    public function toRequestPayload(): array
    {
        return array_filter([
            'site_id'    => $this->site_id ?? null,
            'goal_type'  => $this->goal_type ?? null,
            'event_name' => $this->event_name ?? null,
            'page_path'  => $this->page_path ?? null,
        ]);
    }
}