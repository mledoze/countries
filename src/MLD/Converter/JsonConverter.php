<?php

namespace MLD\Converter;

/**
 * Convert countries data to JSON format
 */
class JsonConverter extends AbstractJsonConverter
{
    /**
     * @inheritDoc
     */
    protected function jsonEncode(array $countries)
    {
        return json_encode($countries);
    }
}