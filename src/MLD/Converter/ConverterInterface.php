<?php

declare(strict_types=1);

namespace MLD\Converter;

/**
 * Interface for all converters
 */
interface ConverterInterface
{

    /**
     * Convert countries data into a new format
     * @param array $countries
     * @return string
     */
    public function convert(array $countries): string;
}