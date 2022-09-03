# Plausible API

[![Latest Version](https://img.shields.io/github/release/hallowed/plausible-api.svg?style=flat-square)](https://github.com/hallowed/plausible-api/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/hallowed/plausible-api/master.svg?style=flat-square)](https://travis-ci.org/hallowed/plausible-api)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/hallowed/plausible-api.svg?style=flat-square)](https://scrutinizer-ci.com/g/hallowed/plausible-api/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/hallowed/plausible-api.svg?style=flat-square)](https://scrutinizer-ci.com/g/hallowed/plausible-api)
[![Total Downloads](https://img.shields.io/packagist/dt/league/plausible-api.svg?style=flat-square)](https://packagist.org/packages/league/plausible-api)

A PHP wrapper for using Plausible's API.

## Install

Via Composer

``` bash
$ composer require hallowed/plausible-api
```

## Usage

``` php
$plausible = new Plausible\PlausibleAPI();
echo $plausible->getRealtimeVisitors(['site_id' => 'example.com']);
```

## Testing

``` bash
$ phpunit
```

## Credits

- [Marko Ognjenović](https://github.com/hallowed)
- [All Contributors](https://github.com/hallowed/plausible-api/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
