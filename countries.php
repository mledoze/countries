<?php

/**
 * Tools to convert countries in different formats
 * @author mledoze
 * @see https://github.com/mledoze/countries
 * @require PHP 5.4+
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

	/**
	 * Save the converted data to the disk
	 * @return mixed
	 */
	public function save();
}

/**
 * Class AbstractConverter
 */
abstract class AbstractConverter implements Converter {

	/** @var array */
	protected $aCountries;

	/**
	 * @var string path of the output directory
	 */
	private $sOutputDirectory;

	/** @var array defines the fields to keep */
	private $aFields;

	/**
	 * @param array $aCountries
	 */
	public function __construct(array $aCountries) {
		$this->aCountries = $aCountries;
	}

	/**
	 * Save the data to disk
	 * @param string $sOutputFile name of the output file
	 * @return int|bool
	 */
	public function save($sOutputFile = '') {
		if (empty($this->sOutputDirectory)) {
			$this->setDefaultOutputDirectory();
		}
		if (!is_dir($this->sOutputDirectory)) {
			mkdir($this->sOutputDirectory);
		}
		if (empty($sOutputFile)) {
			$sTempFile = date('Ymd-His', time()) . '-countries';
			$sOutputFile = $sTempFile;
		}
		if (!empty($this->aFields)) {
			foreach ($this->aCountries as &$aCountry) {
				foreach ($aCountry as $iKey => $value) {
					if (!in_array($iKey, $this->aFields)) {
						unset($aCountry[$iKey]);
					}
				}
			}
		}
		return file_put_contents($this->sOutputDirectory . $sOutputFile, $this->convert());
	}

	/**
	 * Defines the fields to keep
	 * @param array $aFields
	 */
	public function setFields(array $aFields) {
		$this->aFields = $aFields;
	}

	/**
	 * Converts arrays to comma-separated strings
	 * @param array $aInput
	 * @param string $sGlue
	 * @return array
	 */
	protected function convertArrays(array &$aInput, $sGlue = ',') {
		$aInput = array_map(function ($value) use ($sGlue) {
			if (is_array($value)) {
				return implode($sGlue, $value);
			}
			return $value;
		}, $aInput);
		return $aInput;
	}

	/**
	 * Set the default output directory
	 */
	private function setDefaultOutputDirectory() {
		$this->sOutputDirectory = __DIR__ . DIRECTORY_SEPARATOR . 'dist' . DIRECTORY_SEPARATOR;
	}
}

/**
 * Class JsonConverter
 */
class JsonConverter extends AbstractConverter {

	/**
	 * @return string minified JSON, one country per line
	 */
	public function convert() {
		return preg_replace("@},{@", "}," . PHP_EOL . "{", json_encode($this->aCountries) . PHP_EOL);
	}
}

/**
 * Class JsonConverterUnicode
 */
class JsonConverterUnicode extends JsonConverter {

	/**
	 * @return string minified JSON with unescaped characters
	 */
	public function convert() {
		return preg_replace("@},{@", "}," . PHP_EOL . "{", json_encode($this->aCountries, JSON_UNESCAPED_UNICODE) . PHP_EOL);
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
	 * @return string data converted into CSV
	 */
	public function convert() {
		array_walk($this->aCountries, array($this, 'processCountry'));
		$sHeaders = '"' . implode($this->sGlue, array_keys($this->aCountries[0])) . '"';
		return $sHeaders . PHP_EOL . $this->sBody;
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
		$this->formatOutput();
		$this->preserveWhiteSpace();
		$this->oDom->appendChild($this->oDom->createElement('countries'));
		parent::__construct($aCountries);
	}

	/**
	 * @return string data converted into XML
	 */
	public function convert() {
		array_walk($this->aCountries, array($this, 'processCountry'));
		return $this->oDom->saveXML();
	}

	/**
	 * @param bool $bFormatOutput
	 * @see \DOMDocument::$formatOutput
	 */
	public function formatOutput($bFormatOutput = true) {
		$this->oDom->formatOutput = $bFormatOutput;
	}

	/**
	 * @param bool $bPreserveWhiteSpace
	 * @see \DOMDocument::$preserveWhiteSpace
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
(new JsonConverter($aCountriesSrc))->save('countries.json');
(new JsonConverterUnicode($aCountriesSrc))->save('countries-unescaped.json');
(new CsvConverter($aCountriesSrc))->save('countries.csv');
(new XmlConverter($aCountriesSrc))->save('countries.xml');