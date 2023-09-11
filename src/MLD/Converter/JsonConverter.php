<?php

declare(strict_types=1);

namespace MLD\Converter;

/**
 * Convert countries data to JSON format
 */
class JsonConverter extends AbstractJsonConverter
{
    /**
     * @inheritDoc
     */
    protected function jsonEncode(array $countries): string
    {
        return json_encode($countries);
    }
}