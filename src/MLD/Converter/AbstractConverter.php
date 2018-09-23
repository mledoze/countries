<?php

namespace MLD\Converter;

/**
 * Class AbstractConverter
 * @package MLD\Converter
 */
abstract class AbstractConverter implements ConverterInterface
{
    /**
     * Converts arrays to comma-separated strings
     * @param array $input
     * @param string $glue
     * @return array
     */
    protected function convertArrays(array $input, $glue = ',')
    {
        return array_map(
            function ($value) use ($glue) {
                return is_array($value) ? $this->recursiveImplode($value, $glue) : $value;
            },
            $input
        );
    }

    /**
     * Recursively implode elements
     * @param array $input
     * @param string $glue
     * @return string the array recursively imploded with the glue
     */
    private function recursiveImplode(array $input, $glue)
    {
        // remove empty strings from the array
        $input = array_filter($input, function ($entry) {
            return $entry !== '';
        });
        $input = array_map(
            function ($value) use ($glue) {
                if (is_array($value)) {
                    $value = $this->recursiveImplode($value, $glue);
                }
                return $value;
            },
            $input
        );
        return implode($glue, $input);
    }
}