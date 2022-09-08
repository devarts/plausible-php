<?php

namespace Plausible\Response;

/**
 * @property string $domain
 * @property string $id
 * @property string $goal_type
 * @property string|null $event_name
 * @property string|null $page_path
 */
class Goal extends BaseObject
{
    /**
     * @param string $json
     * @return static
     */
    public static function fromApiResponse(string $json): self
    {
        $data = json_decode($json, true);

        $goal = new self();

        $goal->createProperties($data);

        return $goal;
    }
}