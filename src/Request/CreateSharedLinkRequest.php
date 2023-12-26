<?php

namespace Devarts\PlausiblePHP\Request;

class CreateSharedLinkRequest extends BaseRequest
{
    private string $site_id;
    private string $name;

    public function setSiteId(string $site_id): void
    {
        $this->site_id = $site_id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function toRequestPayload(): array
    {
        return array_filter([
            'site_id' => $this->site_id ?? null,
            'name'    => $this->name ?? null,
        ]);
    }
}