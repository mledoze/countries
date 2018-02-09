<?php

namespace MLD\Converter;

/**
 * Class JsonConverterUnicode
 */
class JsonConverterUnicode extends JsonConverter
{

    /**
     * @param array $countries
     * @return string minified JSON with unescaped characters
     */
    public function convert(array $countries)
    {
        $this->processEmptyArrays();
        return preg_replace('@},{@', "},\n{", json_encode($countries, JSON_UNESCAPED_UNICODE) . "\n");
    }
}