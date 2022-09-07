<?php

namespace Plausible\Response;

/**
 * @property BreakdownItem[] $items
 */
class Breakdown extends BaseArray
{
    public static function fromApiResponse(string $json): self
    {
        $data = json_decode($json, true)['results'];

        $breakdown = new self();

        $breakdown->parseValues($data);

        return $breakdown;
    }

    protected function parseValue($value)
    {
        return BreakdownItem::fromArray($value);
    }
}