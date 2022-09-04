<?php

namespace Plausible\Model;

class Breakdown
{
    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public static function fromArray(array $data): self
    {
        $items = [];

        foreach ($data as $item) {
            $items[] = BreakdownItem::fromArray($item);
        }

        return new self($items);
    }

    public function getItems(): array
    {
        return $this->items;
    }
}