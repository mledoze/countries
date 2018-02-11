<?php

namespace MLD\Enum;

/**
 * List all output formats
 */
class Formats
{
    const CSV = 'csv';
    const JSON = 'json';
    const JSON_UNESCAPED = 'json_unescaped';
    const XML = 'xml';
    const YAML = 'yml';

    /**
     * @return array
     */
    public static function getAll()
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