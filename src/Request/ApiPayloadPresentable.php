<?php

namespace Plausible\Request;

interface ApiPayloadPresentable
{
    public function toApiPayload(): array;
}