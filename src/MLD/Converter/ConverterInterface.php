<?php

namespace MLD\Converter;

/**
 * Interface for all converters
 */
interface ConverterInterface
{

    /**
     * Convert countries into a new format
     * @param array $countries
     * @return string
     */
    public function convert(array $countries);

    /**
     * Save the converted data to the disk
     * @return mixed
     */
    public function save();
}