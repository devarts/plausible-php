<?php

namespace Plausible\Response;

use IteratorAggregate;

/**
 * @implements IteratorAggregate<int, BreakdownItem>
 */
class Breakdown extends BaseArray
{
    public static function fromApiResponse(string $json): self
    {
        $data = json_decode($json, true)['results'];

        $breakdown = new self();

        foreach ($data as $item) {
            $breakdown->items[] = BreakdownItem::fromArray($item);
        }

        return $breakdown;
    }
}