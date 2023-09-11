<?php

declare(strict_types=1);

namespace MLD\Converter;

use function is_array;

/**
 * Base class for converters
 * @package MLD\Converter
 */
abstract class AbstractConverter implements ConverterInterface
{

    protected function flatten(array $input, string $prefix = '', string $keySeparator = '.'): array
    {
        $result = [];
        foreach ($input as $key => $value) {
            if (is_array($value)) {
                // handle arrays with numeric keys
                if (isset($value[0])) {
                    $result[$prefix . $key] = implode(',', $value);
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