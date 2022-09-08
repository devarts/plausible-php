<?php

namespace Plausible\Support;

use InvalidArgumentException;

class Filter
{
    public const EQUAL = '==';
    public const NOT_EQUAL = '!=';

    public const SUPPORTED_COMPARISONS = [
        self::EQUAL,
        self::NOT_EQUAL,
    ];

    /**
     * @var string[]
     */
    private array $filters = [];

    public static function create(): self
    {
        return new self();
    }

    /**
     * @param scalar|array $value
     * @throws InvalidArgumentException
     */
    public function add(string $name, $value, string $comparison = self::EQUAL): self
    {
        if (! is_array($value) && ! is_scalar($value)) {
            throw new InvalidArgumentException('Value must be either array or scalar');
        }

        if (is_array($value) && $comparison === self::NOT_EQUAL) {
            throw new InvalidArgumentException('Cannot filter multiple values with `!=` comparison');
        }

        if (! in_array($name, Property::SUPPORTED_PROPERTIES)) {
            throw new InvalidArgumentException("Unsupported property provided: `$name`");
        }

        if (! in_array($comparison, self::SUPPORTED_COMPARISONS)) {
            throw new InvalidArgumentException("Unsupported comparison provided: `$comparison`");
        }

        $filters = clone $this;

        $filters->filters[] = $name . $comparison . (is_array($value) ? implode('|', $value) : $value);

        return $filters;
    }

    public function toString(): string
    {
        return implode(';', $this->filters);
    }

    public function __toString()
    {
        return $this->toString();
    }
}