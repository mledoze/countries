<?php
namespace MLD\Converter;

/**
 * Interface Converter
 */
interface ConverterInterface {

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