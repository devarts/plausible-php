<?php

namespace Plausible\Request;

class RealtimeVisitorsRequest implements ApiPayloadPresentable
{
    private ?string $site_id;

    private function __construct()
    {
        $this->site_id = null;
    }

    public static function create(): self
    {
        return new self();
    }

    public function withSiteId(string $site_id): self
    {
        $request = clone $this;

        $request->site_id = $site_id;

        return $request;
    }

    public function toApiPayload(): array
    {
        $data = [];

        if ($this->site_id) {
            $data['site_id'] = $this->site_id;
        }

        return $data;
    }
}