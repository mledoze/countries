<?php
namespace MLD\Converter;

/**
 * Class AbstractJsonConverter
 */
abstract class AbstractJsonConverter extends AbstractConverter {

	/**
	 * Special case for empty arrays that should be encoded as empty JSON objects
	 */
	protected function processEmptyArrays() {
		array_walk($this->aCountries, function (&$aCountry) {
			if (isset($aCountry['languages']) && empty($aCountry['languages'])) {
				$aCountry['languages'] = new \stdClass();
			}
		});
	}
}
