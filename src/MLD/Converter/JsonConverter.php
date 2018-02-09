<?php

namespace MLD\Converter;

/**
 * Class JsonConverter
 */
class JsonConverter extends AbstractJsonConverter
{

    /**
     * @param array $countries
     * @return string minified JSON, one country per line
     */
    public function convert(array $countries)
    {
        // TODO move this method in the parent class and create an abstract protected method to JSON encode the countries
        $this->processEmptyArrays();
        return preg_replace('@},{@', "},\n{", json_encode($countries) . "\n");
    }
}