<?php

declare(strict_types=1);

namespace MLD\Converter;

/**
 * Class AbstractConverter
 * @package MLD\Converter
 */
abstract class AbstractConverter implements ConverterInterface
{

    /**
     * @param array $input
     * @param string $prefix
     * @param string $keySeparator
     * @return array
     */
    protected function flatten(array $input, $prefix = '', $keySeparator = '.'): array
    {
        $result = [];
        foreach ($input as $key => $value) {
            if (\is_array($value)) {
                // handle arrays with numeric keys
                if (isset($value[0])) {
                    $result[$key] = implode(',', $value);
                } else {
                    $result += $this->flatten($value, $prefix . $key . $keySeparator);
                }
            } else {
                $result[$prefix . $key] = $value;
            }
        }
        return $result;
    }
}