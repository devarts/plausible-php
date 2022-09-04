<?php

namespace Plausible\Model;

class SharedLink
{
    private string $name;
    private string $url;

    public function __construct(string $name, string $url)
    {
        $this->name = $name;
        $this->url = $url;
    }

    public static function fromArray(array $data): self
    {
        return new self($data['name'], $data['url']);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}