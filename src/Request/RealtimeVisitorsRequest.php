<?php

namespace Plausible\Request;

class RealtimeVisitorsRequest implements ApiPayloadPresentable
{
    private string $site_id;

    private function __construct(string $site_id)
    {
        $this->site_id = $site_id;
    }

    public static function create(string $site_id): self
    {
        return new self($site_id);
    }

    public function toApiPayload(): array
    {
        return [
            'site_id' => $this->site_id
        ];
    }
}