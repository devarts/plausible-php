<?php

namespace Devarts\PlausiblePHP\Request;

abstract class BaseRequest implements Request
{
    public static function create(): self
    {
        return new static();
    }
}