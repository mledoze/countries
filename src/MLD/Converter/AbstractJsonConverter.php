<?php

namespace MLD\Converter;

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
            if (isset($country['languages']) && empty($country['languages'])) {
                $country['languages'] = new \stdClass();
            }

            if (isset($country['name']['native']) && empty($country['name']['native'])) {
                $country['name']['native'] = new \stdClass();
            }
        });
    }
}
