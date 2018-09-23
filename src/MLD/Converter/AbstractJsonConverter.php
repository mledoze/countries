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
     * @param array $countries
     */
    protected function processEmptyArrays(array $countries)
    {
        array_walk($countries, function (&$country) {
            if (isset($country[Fields::LANGUAGES]) && empty($country[Fields::LANGUAGES])) {
                $country[Fields::LANGUAGES] = new \stdClass();
            }
        });
    }
}
