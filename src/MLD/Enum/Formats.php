<?php

declare(strict_types=1);

namespace MLD\Enum;

/**
 * List all output formats
 */
class Formats
{
    public const CSV = 'csv';
    public const JSON = 'json';
    public const JSON_UNESCAPED = 'json_unescaped';
    public const XML = 'xml';
    public const YAML = 'yml';

    /**
     * @return array
     */
    public static function getAll(): array
    {
        return [
            self::CSV,
            self::JSON,
            self::JSON_UNESCAPED,
            self::XML,
            self::YAML
        ];
    }
}