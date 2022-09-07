<?php

namespace Plausible\Response;

/**
 * @property BreakdownItem[] $items
 */
class Breakdown extends BaseObject
{
    public static function fromApiResponse(string $json): self
    {
        $data = json_decode($json, true)['results'];

        $breakdown = new self();

        $breakdown->createProperties($data);

        return $breakdown;
    }

    protected function createProperty($name, $value): void
    {
        $this->items[] = BreakdownItem::fromArray($value);
    }
}