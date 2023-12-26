<?php

namespace Devarts\PlausiblePHP\Request;

interface Request
{
    public function toRequestPayload(): array;
}