<?php

namespace Devarts\PlausiblePHP\Request;

class CreateWebsiteRequest extends BaseRequest
{
    private string $domain;
    private ?string $timezone;

    public function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }

    public function setTimezone(?string $timezone): void
    {
        $this->timezone = $timezone;
    }

    public function toRequestPayload(): array
    {
        return array_filter([
            'domain'   => $this->domain ?? null,
            'timezone' => $this->timezone ?? null,
        ]);
    }
}