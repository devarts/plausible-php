<?php

namespace Plausible\Support;

class Properties
{
    public const EVENT_NAME = 'event:name';
    public const EVENT_PAGE = 'event:page';
    public const VISIT_ENTRY_PAGE = 'visit:entry_page';
    public const VISIT_EXIT_PAGE = 'visit:exit_page';
    public const VISIT_SOURCE = 'visit:source';
    public const VISIT_REFERRER = 'visit:referrer';
    public const VISIT_UTM_MEDIUM = 'visit:utm_medium';
    public const VISIT_UTM_SOURCE = 'visit:utm_source';
    public const VISIT_UTM_CAMPAIGN = 'visit:utm_campaign';
    public const VISIT_UTM_CONTENT = 'visit:utm_content';
    public const VISIT_UTM_TERM = 'visit:utm_term';
    public const VISIT_DEVICE = 'visit:device';
    public const VISIT_BROWSER = 'visit:browser';
    public const VISIT_BROWSER_VERSION = 'visit:browser_version';
    public const VISIT_OS = 'visit:os';
    public const VISIT_OS_VERSION = 'visit:os_version';
    public const VISIT_COUNTRY = 'visit:country';
    public const VISIT_REGION = 'visit:region';
    public const VISIT_CITY = 'visit:city';

    public const SUPPORTED_PROPERTIES = [
        self::EVENT_NAME,
        self::EVENT_PAGE,
        self::VISIT_ENTRY_PAGE,
        self::VISIT_EXIT_PAGE,
        self::VISIT_SOURCE,
        self::VISIT_REFERRER,
        self::VISIT_UTM_MEDIUM,
        self::VISIT_UTM_SOURCE,
        self::VISIT_UTM_CAMPAIGN,
        self::VISIT_UTM_CONTENT,
        self::VISIT_UTM_TERM,
        self::VISIT_DEVICE,
        self::VISIT_BROWSER,
        self::VISIT_BROWSER_VERSION,
        self::VISIT_OS,
        self::VISIT_OS_VERSION,
        self::VISIT_COUNTRY,
        self::VISIT_REGION,
        self::VISIT_CITY,
    ];

    public static function isValid(string $value): bool
    {
        return in_array($value, self::SUPPORTED_PROPERTIES);
    }
}