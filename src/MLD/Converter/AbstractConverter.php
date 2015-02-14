<?php
namespace MLD\Converter;

/**
 * Class AbstractConverter
 * @package MLD\Converter
 */
abstract class AbstractConverter implements ConverterInterface {

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
			$sOutputFile = date('Ymd-His', time()) . '-countries';
		}

		// keep only the specified fields
		if (!empty($this->aFields)) {
			$aFields = $this->aFields;
			array_walk($this->aCountries, function (&$aCountry) use ($aFields) {
				$aCountry = array_intersect_key($aCountry, array_flip($aFields));
			});
		}
		return file_put_contents($this->sOutputDirectory . $sOutputFile, $this->convert());
	}

	/**
	 * Set the directory to which output will be written.
	 *
	 * @param string $sOutputDirectory
	 * @return $this
	 */
	public function setOutputDirectory($sOutputDirectory) {
		if (substr($sOutputDirectory, strlen($sOutputDirectory) - 1, 1) !== DIRECTORY_SEPARATOR) {
			$sOutputDirectory .= DIRECTORY_SEPARATOR;
		}

		$this->sOutputDirectory = $sOutputDirectory;

		return $this;
	}

	/**
	 * Defines the fields to keep
	 * @param array $aFields
	 * @return $this
	 */
	public function setFields(array $aFields) {
		$this->aFields = $aFields;

		return $this;
	}

	/**
	 * Gets fields that will currently be output.
	 * @return array A list of field names.
	 */
	public function getFields() {
		if ($this->aFields !== null) {
			return $this->aFields;
		}

		if (empty($this->aCountries)) {
			return array();
		}

		return array_keys($this->aCountries[0]);
	}

	/**
	 * Converts arrays to comma-separated strings
	 * @param array $aInput
	 * @param string $sGlue
	 * @return array
	 */
	protected function convertArrays(array &$aInput, $sGlue = ',') {
		return array_map(function ($value) use ($sGlue) {
			return is_array($value) ? $this->recursiveImplode($value, $sGlue) : $value;
		}, $aInput);
	}

	/**
	 * Set the default output directory
	 */
	private function setDefaultOutputDirectory() {
		$this->sOutputDirectory = __DIR__ . DIRECTORY_SEPARATOR . 'dist' . DIRECTORY_SEPARATOR;
	}

	/**
	 * Recursively implode elements
	 * @param array $aInput
	 * @param $sGlue
	 * @return string the array recursively imploded with the glue
	 */
	private function recursiveImplode(array $aInput, $sGlue) {
		// remove empty strings from the array
		$aInput = array_filter($aInput, function ($entry) {
			return $entry !== '';
		});
		array_walk($aInput, function (&$value) use ($sGlue) {
			if (is_array($value)) {
				$value = $this->recursiveImplode($value, $sGlue);
			}
		});
		return implode($sGlue, $aInput);
	}
}