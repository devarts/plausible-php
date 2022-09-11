<?php

namespace Plausible\Response;

/**
 * @property int $id
 * @property string $domain
 * @property string $goal_type
 * @property string|null $event_name
 * @property string|null $page_path
 */
class Goal extends BaseObject
{
    public static function fromApiResponse(string $json): self
    {
        $data = json_decode($json, true);

        $goal = new self();

        $goal->createProperties($data);

        return $goal;
    }
}