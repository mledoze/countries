<?php

declare(strict_types=1);

namespace MLD\Converter;

use JsonException;

/**
 * Convert countries data to JSON format with unescaped characters
 */
class JsonConverterUnicode extends AbstractJsonConverter
{
    /**
     * @inheritdoc
     * @throws JsonException
     */
    protected function jsonEncode(array $countries): string
    {
        return json_encode($countries, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
    }
}