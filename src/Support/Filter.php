<?php

namespace Devarts\PlausiblePHP\Support;

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
    public function by(string $name, $value, string $comparison = self::EQUAL): self
    {
        if (! is_array($value) && ! is_scalar($value)) {
            throw new InvalidArgumentException('Value must be either array or scalar');
        }

        if (is_array($value) && $comparison === self::NOT_EQUAL) {
            throw new InvalidArgumentException('Cannot filter multiple values with `!=` comparison');
        }

        if (! in_array($comparison, self::SUPPORTED_COMPARISONS)) {
            throw new InvalidArgumentException("Unsupported comparison provided: `$comparison`");
        }

        $filters = clone $this;

        $filters->filters[] = $name . $comparison . (is_array($value) ? implode('|', $value) : $value);

        return $filters;
    }

    public function byEventName($value, string $comparison = self::EQUAL): self
    {
        return $this->by(Property::EVENT_NAME, $value, $comparison);
    }

    public function byEventPage($value, string $comparison = self::EQUAL): self
    {
        return $this->by(Property::EVENT_PAGE, $value, $comparison);
    }

    public function byEventCustomProperty(string $property, $value, string $comparison = self::EQUAL): self
    {
        return $this->by("event:props:$property", $value, $comparison);
    }

    public function byVisitEntryPage($value, string $comparison = self::EQUAL): self
    {
        return $this->by(Property::VISIT_ENTRY_PAGE, $value, $comparison);
    }

    public function byVisitExitPage($value, string $comparison = self::EQUAL): self
    {
        return $this->by(Property::VISIT_EXIT_PAGE, $value, $comparison);
    }

    public function byVisitSource($value, string $comparison = self::EQUAL): self
    {
        return $this->by(Property::VISIT_SOURCE, $value, $comparison);
    }

    public function byVisitReferrer($value, string $comparison = self::EQUAL): self
    {
        return $this->by(Property::VISIT_REFERRER, $value, $comparison);
    }

    public function byVisitUtmMedium($value, string $comparison = self::EQUAL): self
    {
        return $this->by(Property::VISIT_UTM_MEDIUM, $value, $comparison);
    }

    public function byVisitUtmSource($value, string $comparison = self::EQUAL): self
    {
        return $this->by(Property::VISIT_UTM_SOURCE, $value, $comparison);
    }

    public function byVisitUtmCampaign($value, string $comparison = self::EQUAL): self
    {
        return $this->by(Property::VISIT_UTM_CAMPAIGN, $value, $comparison);
    }

    public function byVisitUtmContent($value, string $comparison = self::EQUAL): self
    {
        return $this->by(Property::VISIT_UTM_CONTENT, $value, $comparison);
    }

    public function byVisitUtmTerm($value, string $comparison = self::EQUAL): self
    {
        return $this->by(Property::VISIT_UTM_TERM, $value, $comparison);
    }

    public function byVisitDevice($value, string $comparison = self::EQUAL): self
    {
        return $this->by(Property::VISIT_DEVICE, $value, $comparison);
    }

    public function byVisitBrowser($value, string $comparison = self::EQUAL): self
    {
        return $this->by(Property::VISIT_BROWSER, $value, $comparison);
    }

    public function byVisitBrowserVersion($value, string $comparison = self::EQUAL): self
    {
        return $this->by(Property::VISIT_BROWSER_VERSION, $value, $comparison);
    }

    public function byVisitOs($value, string $comparison = self::EQUAL): self
    {
        return $this->by(Property::VISIT_OS, $value, $comparison);
    }

    public function byVisitOsVersion($value, string $comparison = self::EQUAL): self
    {
        return $this->by(Property::VISIT_OS_VERSION, $value, $comparison);
    }

    public function byVisitCountry($value, string $comparison = self::EQUAL): self
    {
        return $this->by(Property::VISIT_COUNTRY, $value, $comparison);
    }

    public function byVisitRegion($value, string $comparison = self::EQUAL): self
    {
        return $this->by(Property::VISIT_REGION, $value, $comparison);
    }

    public function byVisitCity($value, string $comparison = self::EQUAL): self
    {
        return $this->by(Property::VISIT_CITY, $value, $comparison);
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