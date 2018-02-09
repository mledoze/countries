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
        $countries = [];
        // TODO remove this $countries variables from all converters constructors
        switch ($format) {
            case Formats::CSV:
                $converter = new CsvConverter($countries);
                break;
            case Formats::JSON:
                $converter = new JsonConverter($countries);
                break;
            case Formats::JSON_UNESCAPED:
                $converter = new JsonConverterUnicode($countries);
                break;
            case Formats::XML:
                $converter = new XmlConverter($countries);
                break;
            case Formats::YAML:
                $converter = new YamlConverter($countries);
                break;
            default:
                throw new \InvalidArgumentException(sprintf('Unsupported format %s', $format));
        }
        return $converter;
    }
}