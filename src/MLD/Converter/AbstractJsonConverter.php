<?php

namespace MLD\Converter;

use MLD\Enum\Fields;

/**
 * Class AbstractJsonConverter
 */
abstract class AbstractJsonConverter extends AbstractConverter
{

    /**
     * Special case for empty arrays that should be encoded as empty JSON objects
     */
    protected function processEmptyArrays()
    {
        array_walk($this->countries, function (&$country) {
            if (isset($country[Fields::LANGUAGES]) && empty($country[Fields::LANGUAGES])) {
                $country[Fields::LANGUAGES] = new \stdClass();
            }
        });
    }
}
