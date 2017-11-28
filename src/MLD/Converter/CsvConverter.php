<?php
namespace MLD\Converter;

/**
 * Class CsvConverter
 */
class CsvConverter extends AbstractConverter {

	/**
	 * @var
	 */
	private $sGlue = '","';

	/**
	 * @var string
	 */
	private $sBody = '';

	/**
	 * @return string data converted into CSV
	 */
	public function convert() {
		array_walk($this->aCountries, [$this, 'processCountry']);
		$sHeaders = '"' . implode($this->sGlue, array_keys($this->aCountries[0])) . '"';
		return $sHeaders . "\n" . $this->sBody;
	}

	/**
	 * @return string
	 */
	public function getGlue() {
		return $this->sGlue;
	}

	/**
	 * @param string $sGlue
	 */
	public function setGlue($sGlue) {
		$this->sGlue = $sGlue;
	}

	/**
	 * Processes a country.
	 * @param $array
	 */
	private function processCountry(&$array) {
		$this->sBody .= '"' . implode($this->sGlue, $this->convertArrays($array)) . "\"\n";
	}
}