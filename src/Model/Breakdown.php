<?php

namespace Plausible\Model;

/**
 * @property BreakdownItem[] $items
 */
class Breakdown extends BaseObject
{
    public static function fromApiResponse(string $json): self
    {
        $data = json_decode($json, true)['results'];

        $breakdown = new self();

        $items = [];

        foreach ($data as $item) {
            $items[] = BreakdownItem::fromArray($item);
        }

        $breakdown->items = $items;

        return $breakdown;
    }

    public function getSupportedProperties(): array
    {
        return [
            'items',
        ];
    }
}