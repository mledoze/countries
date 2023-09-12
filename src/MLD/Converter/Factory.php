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
            Formats::CSV->value => new CsvConverter(),
            Formats::JSON->value => new JsonConverter(),
            Formats::JSON_UNESCAPED->value => new JsonConverterUnicode(),
            Formats::XML->value => new XmlConverter(),
            Formats::YAML->value => new YamlConverter(),
            default => throw new InvalidArgumentException(sprintf('Unsupported format %s', $format)),
        };
    }
}