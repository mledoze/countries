<?php

declare(strict_types=1);

namespace MLD\Converter;

use InvalidArgumentException;
use MLD\Enum\Formats;

/**
 * Create converters based on their format
 */
class Factory
{

    /**
     * @throws InvalidArgumentException
     */
    public function create(string $format): ConverterInterface
    {
        return match ($format) {
            Formats::CSV => new CsvConverter(),
            Formats::JSON => new JsonConverter(),
            Formats::JSON_UNESCAPED => new JsonConverterUnicode(),
            Formats::XML => new XmlConverter(),
            Formats::YAML => new YamlConverter(),
            default => throw new InvalidArgumentException(sprintf('Unsupported format %s', $format)),
        };
    }
}