<?php

namespace Plausible\Model;

class Website
{
    private string $domain;
    private string $timezone;

    public function __construct(string $domain, string $timezone)
    {
        $this->domain = $domain;
        $this->timezone = $timezone;
    }

    public static function fromArray(array $data): self
    {
        return new self($data['domain'], $data['timezone']);
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }
}