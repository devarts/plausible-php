# Plausible API

[![Latest Version](https://img.shields.io/github/release/thephpleague/plausible-api.svg?style=flat-square)](https://github.com/thephpleague/plausible-api/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/thephpleague/plausible-api/master.svg?style=flat-square)](https://travis-ci.org/thephpleague/plausible-api)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/thephpleague/plausible-api.svg?style=flat-square)](https://scrutinizer-ci.com/g/thephpleague/plausible-api/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/thephpleague/plausible-api.svg?style=flat-square)](https://scrutinizer-ci.com/g/thephpleague/plausible-api)
[![Total Downloads](https://img.shields.io/packagist/dt/league/plausible-api.svg?style=flat-square)](https://packagist.org/packages/league/plausible-api)

A PHP wrapper for using Plausible's API.

## Install

Via Composer

``` bash
$ composer require marko-ogg/plausible-api
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

- [Marko Ognjenović](https://github.com/marko-ogg)
- [All Contributors](https://github.com/marko-ogg/plausible-api/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
