<?php

namespace Plausible\Model;

class Goal
{
    private string $domain;
    private string $id;
    private string $goal_type;
    private ?string $event_name;
    private ?string $page_path;

    public function __construct(string $domain, string $id, string $goal_type, ?string $event_name, ?string $page_path)
    {
        $this->domain = $domain;
        $this->id = $id;
        $this->goal_type = $goal_type;
        $this->event_name = $event_name;
        $this->page_path = $page_path;
    }

    public static function fromApiResponse(string $json): self
    {
        $data = json_decode($json, true);

        return new self(
            $data['domain'],
            $data['id'],
            $data['goal_type'],
            $data['event_name'],
            $data['page_path']
        );
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getGoalType(): string
    {
        return $this->goal_type;
    }

    public function getEventName(): ?string
    {
        return $this->event_name;
    }

    public function getPagePath(): ?string
    {
        return $this->page_path;
    }
}