<?php

namespace MLD\Converter;

use DOMDocument;

/**
 * Class XmlConverter
 */
class XmlConverter extends AbstractConverter
{

    /**
     * @var DOMDocument
     */
    private $domDocument;

    /**
     * @param array $countries
     */
    public function __construct(array $countries)
    {
        $this->domDocument = new \DOMDocument('1.0', 'UTF-8');
        $this->formatOutput();
        $this->preserveWhiteSpace();
        $this->domDocument->appendChild($this->domDocument->createElement('countries'));
        parent::__construct($countries);
    }

    /**
     * @return string data converted into XML
     */
    public function convert()
    {
        array_walk($this->countries, array($this, 'processCountry'));
        return $this->domDocument->saveXML();
    }

    /**
     * @param bool $formatOutput
     * @see \DOMDocument::$formatOutput
     */
    public function formatOutput($formatOutput = true)
    {
        $this->domDocument->formatOutput = $formatOutput;
    }

    /**
     * @param bool $preserveWhiteSpace
     * @see \DOMDocument::$preserveWhiteSpace
     */
    public function preserveWhiteSpace($preserveWhiteSpace = false)
    {
        $this->domDocument->preserveWhiteSpace = $preserveWhiteSpace;
    }

    /**
     * @param $array
     */
    private function processCountry(&$array)
    {
        $countryNode = $this->domDocument->createElement('country');
        $array = $this->convertArrays($array);
        array_walk($array, function ($value, $key) use ($countryNode) {
            $countryNode->setAttribute($key, $value);
        });
        $this->domDocument->documentElement->appendChild($countryNode);
    }
}