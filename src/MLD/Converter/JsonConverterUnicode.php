<?php

declare(strict_types=1);

namespace MLD\Converter;

/**
 * Convert countries data to JSON format with unescaped characters
 */
class JsonConverterUnicode extends AbstractJsonConverter
{
    /**
     * @inheritdoc
     */
    protected function jsonEncode(array $countries): string
    {
        return json_encode($countries, JSON_UNESCAPED_UNICODE);
    }
}