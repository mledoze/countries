<?php

namespace MLD\Converter;

/**
 * Class JsonConverterUnicode
 */
class JsonConverterUnicode extends JsonConverter
{

    /**
     * @return string minified JSON with unescaped characters
     */
    public function convert()
    {
        $this->processEmptyArrays();
        return preg_replace("@},{@", "},\n{", json_encode($this->countries, JSON_UNESCAPED_UNICODE) . "\n");
    }
}