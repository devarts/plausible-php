<?php

namespace Devarts\PlausiblePHP\Request;

class DeleteGoalRequest extends BaseRequest
{
    private string $site_id;

    public function setSiteId(string $site_id): void
    {
        $this->site_id = $site_id;
    }

    public function toRequestPayload(): array
    {
        return array_filter([
            'site_id' => $this->site_id ?? null,
        ]);
    }
}