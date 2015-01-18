<?php
namespace MLD\CountryData;

/**
 * Interface Converter
 */
interface Converter {

    /**
     * Convert into a new format
     * @return string
     */
    public function convert();

    /**
     * Save the converted data to the disk
     * @return mixed
     */
    public function save();
}