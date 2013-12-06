<?php

/**
 * Tools to convert countries in different formats
 * @author mledoze
 * @see https://github.com/mledoze/countries
 */

/**
 * Interface Converter
 */
interface Converter {

	/**
	 * Convert into a new format
	 * @return string
	 */
	public function convert();
}

/**
 * Class AbstractConverter
 */
abstract class AbstractConverter implements Converter {

	/**
	 * @var array
	 */
	protected $aCountries;

	/**
	 * @param array $aCountries
	 */
	public function __construct(array $aCountries) {
		$this->aCountries = $aCountries;
	}

	/**
	 * Converts arrays to comma-separated strings
	 * @param array $aInput
	 * @return array
	 */
	protected function convertArrays(array &$aInput) {
		$aInput = array_map(function ($value) {
			if (is_array($value)) {
				return implode(',', $value);
			}
			return $value;
		}, $aInput);
		return $aInput;
	}
}

/**
 * Class CsvConverter
 */
class CsvConverter extends AbstractConverter {

	/**
	 * @var
	 */
	private $sGlue = '";"';
	/**
	 * @var string
	 */
	private $sBody = '';

	/**
	 * Convert into a new format
	 * @return string
	 */
	public function convert() {
		array_walk($this->aCountries, array($this, 'processCountry'));
		return $this->getHeaders() . PHP_EOL . $this->sBody;
	}

	/**
	 * @return string
	 */
	private function getHeaders() {
		return !empty($this->aCountries) ? '"' . implode($this->sGlue, array_keys($this->aCountries[0])) . '"' : '';
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
		$this->sBody .= '"' . implode($this->sGlue, $this->convertArrays($array)) . '"' . PHP_EOL;
	}
}

/**
 * Class XmlConverter
 */
class XmlConverter extends AbstractConverter {

	/** @var DOMDocument $oDom */
	private $oDom;

	/**
	 * @param array $aCountries
	 */
	public function __construct(array $aCountries) {
		$this->oDom = new DOMDocument('1.0', 'UTF-8');
		$this->oDom->appendChild($this->oDom->createElement('countries'));
		parent::__construct($aCountries);
	}

	/**
	 * Convert into a new format
	 * @return string
	 */
	public function convert() {
		array_walk($this->aCountries, array($this, 'processCountry'));
		return $this->oDom->saveXML();
	}

	/**
	 * @param bool $bFormatOutput
	 */
	public function formatOutput($bFormatOutput = true) {
		$this->oDom->formatOutput = $bFormatOutput;
	}

	/**
	 * @param bool $bPreserveWhiteSpace
	 */
	public function preserveWhiteSpace($bPreserveWhiteSpace = false) {
		$this->oDom->preserveWhiteSpace = $bPreserveWhiteSpace;
	}

	/**
	 * @param $array
	 */
	private function processCountry(&$array) {
		$oCountryNode = $this->oDom->createElement('country');
		$array = $this->convertArrays($array);
		array_walk($array, function ($value, $key) use ($oCountryNode) {
			$oCountryNode->setAttribute($key, $value);
		});
		$this->oDom->documentElement->appendChild($oCountryNode);
	}
}

$aCountriesSrc = json_decode(file_get_contents('countries.json'), true);

// convert to CSV
$oCsvConverter = new CsvConverter($aCountriesSrc);
$sCsvContent = $oCsvConverter->convert();
file_put_contents('countries.csv', $sCsvContent);

// convert to XML
$oXmlConverter = new XmlConverter($aCountriesSrc);
$oXmlConverter->formatOutput();
$oXmlConverter->preserveWhiteSpace();
$sXmlContent = $oXmlConverter->convert();
file_put_contents('countries.xml', $sXmlContent);