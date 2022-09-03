<?php

namespace Plausible\Request\Parameter;

use LogicException;
use Plausible\Request\ApiPayloadPresentable;
use Plausible\Support\Property;

class Filters implements ApiPayloadPresentable
{
    public const EQUAL = '=';
    public const NOT_EQUAL = '!=';

    public const SUPPORTED_COMPARISONS = [
        self::EQUAL,
        self::NOT_EQUAL,
    ];

    private array $filters;

    private function __construct()
    {
        $this->filters = [];
    }

    public static function create(): self
    {
        return new self();
    }

    public function withEventName(array $values, string $comparison): self
    {
        return $this->withFilter(Property::EVENT_NAME, $values, $comparison);
    }

    public function withEventPage(array $values, string $comparison): self
    {
        return $this->withFilter(Property::EVENT_PAGE, $values, $comparison);
    }

    public function withEntryPage(array $values, string $comparison): self
    {
        return $this->withFilter(Property::VISIT_ENTRY_PAGE, $values, $comparison);
    }

    public function withExitPage(array $values, string $comparison): self
    {
        return $this->withFilter(Property::VISIT_EXIT_PAGE, $values, $comparison);
    }

    public function withSource(array $values, string $comparison): self
    {
        return $this->withFilter(Property::VISIT_SOURCE, $values, $comparison);
    }

    public function withReferrer(array $values, string $comparison): self
    {
        return $this->withFilter(Property::VISIT_REFERRER, $values, $comparison);
    }

    public function withUtmMedium(array $values, string $comparison): self
    {
        return $this->withFilter(Property::VISIT_UTM_MEDIUM, $values, $comparison);
    }

    public function withUtmSource(array $values, string $comparison): self
    {
        return $this->withFilter(Property::VISIT_UTM_SOURCE, $values, $comparison);
    }

    public function withUtmCampaign(array $values, string $comparison): self
    {
        return $this->withFilter(Property::VISIT_UTM_CAMPAIGN, $values, $comparison);
    }

    public function withUtmContent(array $values, string $comparison): self
    {
        return $this->withFilter(Property::VISIT_UTM_CONTENT, $values, $comparison);
    }

    public function withUtmTerm(array $values, string $comparison): self
    {
        return $this->withFilter(Property::VISIT_UTM_TERM, $values, $comparison);
    }

    public function withDevice(array $values, string $comparison): self
    {
        return $this->withFilter(Property::VISIT_DEVICE, $values, $comparison);
    }

    public function withBrowser(array $values, string $comparison): self
    {
        return $this->withFilter(Property::VISIT_BROWSER, $values, $comparison);
    }

    public function withBrowserVersion(array $values, string $comparison): self
    {
        return $this->withFilter(Property::VISIT_BROWSER_VERSION, $values, $comparison);
    }

    public function withOS(array $values, string $comparison): self
    {
        return $this->withFilter(Property::VISIT_OS, $values, $comparison);
    }

    public function withOSVersion(array $values, string $comparison): self
    {
        return $this->withFilter(Property::VISIT_OS_VERSION, $values, $comparison);
    }

    public function withCountry(array $values, string $comparison): self
    {
        return $this->withFilter(Property::VISIT_COUNTRY, $values, $comparison);
    }

    public function withRegion(array $values, string $comparison): self
    {
        return $this->withFilter(Property::VISIT_REGION, $values, $comparison);
    }

    public function withCity(array $values, string $comparison): self
    {
        return $this->withFilter(Property::VISIT_CITY, $values, $comparison);
    }

    public function withFilter(string $name, array $values, string $comparison): self
    {
        if (! in_array($comparison, self::SUPPORTED_COMPARISONS)) {
            throw new LogicException('Provided comparison is not supported.');
        }

        $filters = clone $this;

        $filters->filters[] = $name . ($comparison === self::EQUAL ? '=' : '!=') . implode('|', $values);

        return $filters;
    }

    public function toApiPayload(): array
    {
        return [
            'filters' => implode(';', $this->filters)
        ];
    }
}