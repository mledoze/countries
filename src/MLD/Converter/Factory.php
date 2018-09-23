<?php

namespace MLD\Converter;

use MLD\Enum\Formats;

/**
 * Create converters based on their format
 */
class Factory
{

    /**
     * @param string $format
     * @return ConverterInterface
     * @throws \InvalidArgumentException
     */
    public function create($format)
    {
        switch ($format) {
            case Formats::CSV:
                $converter = new CsvConverter();
                break;
            case Formats::JSON:
                $converter = new JsonConverter();
                break;
            case Formats::JSON_UNESCAPED:
                $converter = new JsonConverterUnicode();
                break;
            case Formats::XML:
                $converter = new XmlConverter();
                break;
            case Formats::YAML:
                $converter = new YamlConverter();
                break;
            default:
                throw new \InvalidArgumentException(sprintf('Unsupported format %s', $format));
        }
        return $converter;
    }
}