<?php

namespace Plausible\Model;

class Breakdown
{
    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public static function fromApiResponse(string $json): self
    {
        $data = json_decode($json, true)['results'];

        $items = [];

        foreach ($data as $item) {
            $items[] = BreakdownItem::fromArray($item);
        }

        return new self($items);
    }

    /**
     * @return BreakdownItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}