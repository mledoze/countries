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
     * @param array $input
     * @param string $prefix
     * @param string $keySeparator
     * @return array
     * TODO: handle single element arrays
     */
    protected function flatten(array $input, $prefix = '', $keySeparator = '.')
    {
        $result = [];
        foreach ($input as $key => $value) {
            if (is_array($value)) {
                $result += $this->flatten($value, $prefix . $key . $keySeparator);
            } else {
                $result[$prefix . $key] = $value;
            }
        }
        return $result;
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