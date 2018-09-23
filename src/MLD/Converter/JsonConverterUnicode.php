<?php

namespace MLD\Converter;

/**
 * Convert countries data to JSON format with unescaped characters
 */
class JsonConverterUnicode extends AbstractJsonConverter
{
    /**
     * @inheritdoc
     */
    protected function jsonEncode(array $countries)
    {
        return json_encode($countries, JSON_UNESCAPED_UNICODE);
    }
}