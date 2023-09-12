<?php

declare(strict_types=1);

namespace MLD\Enum;

/**
 * List all output formats
 */
enum Formats: string
{
    use EnumValues;

    case CSV = 'csv';
    case JSON = 'json';
    case JSON_UNESCAPED = 'json_unescaped';
    case XML = 'xml';
    case YAML = 'yml';

}