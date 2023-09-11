<?php

declare(strict_types=1);

namespace MLD\Converter;

use JsonException;

/**
 * Convert countries data to JSON format
 */
class JsonConverter extends AbstractJsonConverter
{
    /**
     * @inheritDoc
     * @throws JsonException
     */
    protected function jsonEncode(array $countries): string
    {
        return json_encode($countries, JSON_THROW_ON_ERROR);
    }
}