<?php

namespace Devarts\PlausiblePHP\Request;

class UpdateWebsiteRequest extends BaseRequest
{
    private string $domain;

    public function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }

    public function toRequestPayload(): array
    {
        return array_filter([
            'domain' => $this->domain ?? null,
        ]);
    }
}