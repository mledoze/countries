<?php
namespace MLD\Converter;

/**
 * Class JsonConverter
 */
class JsonConverter extends AbstractJsonConverter {

	/**
	 * @return string minified JSON, one country per line
	 */
	public function convert() {
		$this->processEmptyArrays();
		return preg_replace("@},{@", "},\n{", json_encode($this->aCountries) . "\n");
	}
}