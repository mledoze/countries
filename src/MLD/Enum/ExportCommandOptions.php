<?php

declare(strict_types=1);

namespace MLD\Enum;

/**
 * List the available options for the export command
 */
enum ExportCommandOptions: string
{

    case OUTPUT_DIR = 'output-dir';
    case FORMAT = 'format';
    case INCLUDE_FIELD = 'include-field';
    case EXCLUDE_FIELD = 'exclude-field';
}