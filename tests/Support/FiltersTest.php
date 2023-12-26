<?php

namespace Devarts\PlausiblePHP\Test\Support;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Devarts\PlausiblePHP\Support\Filters;
use Devarts\PlausiblePHP\Support\Property;

class FiltersTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_stringify_filters(): void
    {
        $filter = Filters::create()
            ->add(Property::VISIT_BROWSER, ['Chrome', 'Firefox'])
            ->add(Property::EVENT_NAME, 'Signup')
            ->add(Property::VISIT_COUNTRY, 'Germany', Filters::NOT_EQUAL)
            ->add(Property::VISIT_OS_VERSION, 2.2)
            ->add('event:props:custom', 'custom_value');

        $this->assertEquals(
            'visit:browser==Chrome|Firefox;event:name==Signup;visit:country!=Germany;visit:os_version==2.2;event:props:custom==custom_value',
            $filter->toString()
        );

        $filter = Filters::create()
            ->addVisitBrowser(['Chrome', 'Firefox'])
            ->addEventName('Signup')
            ->addVisitCountry('Germany', Filters::NOT_EQUAL)
            ->addVisitOsVersion(2.2)
            ->addEventCustomProperty('custom', 'custom_value');

        $this->assertEquals(
            'visit:browser==Chrome|Firefox;event:name==Signup;visit:country!=Germany;visit:os_version==2.2;event:props:custom==custom_value',
            $filter->toString()
        );
    }

    /**
     * @test
     */
    public function it_should_stringify_empty_filters(): void
    {
        $filter = Filters::create();

        $this->assertEquals('', $filter->toString());
    }

    /**
     * @test
     */
    public function it_should_throw_exception_when_filtering_multiple_values_with_not_equal_comparison(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot filter multiple values with `!=` comparison');

        Filters::create()->add(Property::VISIT_CITY, ['Prague', 'Vienna'], Filters::NOT_EQUAL);
    }

    /**
     * @test
     */
    public function it_should_throw_exception_when_adding_filter_with_value_of_invalid_type(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Value must be either array or scalar');

        Filters::create()->add(Property::VISIT_SOURCE, (object) ['property' => 'value']);
    }

    /**
     * @test
     */
    public function it_should_add_custom_property(): void
    {
        $filter = Filters::create()->add('custom_property', 'custom_value');

        $this->assertEquals(
            'custom_property==custom_value',
            $filter->toString()
        );
    }

    /**
     * @test
     */
    public function it_should_throw_exception_when_adding_filter_with_unsupported_comparison(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported comparison provided: `>`');

        Filters::create()->add(Property::VISIT_SOURCE, 'Chrome', '>');
    }
}