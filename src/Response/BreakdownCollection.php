<?php

namespace Devarts\PlausiblePHP\Response;

class BreakdownCollection extends BaseCollection
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

    public function current(): BreakdownItem
    {
        return $this->items[$this->position];
    }
}