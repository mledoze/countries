<?php
namespace MLD\Converter;
use DOMDocument;

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
		$this->oDom = new \DOMDocument('1.0', 'UTF-8');
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