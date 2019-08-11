<?php

namespace MLD\Converter;

/**
 * Class JsonConverter
 */
class JsonConverter extends AbstractJsonConverter
{

    /**
     * @return string minified JSON, one country per line
     */
    public function convert()
    {
        /*
        $this->processEmptyArrays();
        return preg_replace("@},{@", "},\n{", json_encode($this->countries) . "\n");
            */
            $countries = array();
            foreach ($this->countries as $key => $value) {
                $ucid = $key + 1;
                $value["ucid"] = $ucid;
                array_push ($countries, $value);
            }
            return json_encode($countries);

    }
}