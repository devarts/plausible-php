# Plausible PHP

[![Build Status](https://github.com/devarts/plausible-php/actions/workflows/ci.yml/badge.svg?branch=master)](https://github.com/devarts/plausible-php/actions?query=branch%3Amaster)
[![Latest Stable Version](https://poser.pugx.org/devarts/plausible-php/v/stable.svg)](https://packagist.org/packages/devarts/plausible-php)
[![License](https://poser.pugx.org/devarts/plausible-php/license.svg)](https://packagist.org/packages/devarts/plausible-php)

The library provides access to the Plausible API from applications written in the PHP language. 
It includes a pre-defined set of classes for API resources that initialize themselves from API responses.

## Requirements

PHP 7.4 and later.

## Install

Via Composer

``` bash
$ composer require devarts/plausible-php
```

## Usage

Simple usage looks like:

``` php
use Devarts\PlausiblePHP\PlausibleAPI;
use Devarts\PlausiblePHP\Support\Period;
use Devarts\PlausiblePHP\Support\Metric;
use Devarts\PlausiblePHP\Support\Filter;

$plausible = new PlausibleAPI('{plausible_api_token}');

$timeseries = $plausible->getTimeseries('example.com', [
    'period' => Period::DAYS_30,
    'metrics' => Metric::create()->addBounceRate()->addVisitors()->toString(),
    'filters' => Filter::create()->addVisitBrowser('Chrome', Filter::NOT_EQUAL)->toString(),
]);

foreach ($timeseries as $timepoint) {
    echo "{$timepoint->date->format('Y-m-d')} | {$timepoint->bounce_rate} | {$timepoint->visitors}";
}
```

## Credits

- [Marko Ognjenović](https://github.com/marko-ogg)
- [All Contributors](https://github.com/devarts/plausible-php/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
