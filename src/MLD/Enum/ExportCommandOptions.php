<?php

declare(strict_types=1);

namespace MLD\Enum;

/**
 * List the available options for the export command
 */
class ExportCommandOptions
{

    public const OUTPUT_DIR = 'output-dir';
    public const INCLUDE_FIELD = 'include-field';
    public const EXCLUDE_FIELD = 'exclude-field';
    public const FORMAT = 'format';
}