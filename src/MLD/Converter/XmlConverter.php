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

    public function __construct()
    {
        $this->domDocument = new \DOMDocument('1.0', 'UTF-8');
        $this->formatOutput();
        $this->preserveWhiteSpace();
        $this->domDocument->appendChild($this->domDocument->createElement('countries'));
    }

    /**
     * @param array $countries
     * @return string data converted into XML
     */
    public function convert(array $countries)
    {
        array_walk($countries, array($this, 'processCountry'));
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
     * @param array $country
     */
    private function processCountry(array $country)
    {
        $countryNode = $this->domDocument->createElement('country');
        $country = $this->convertArrays($country);
        array_walk($country, function ($value, $key) use ($countryNode) {
            $countryNode->setAttribute($key, $value);
        });
        $this->domDocument->documentElement->appendChild($countryNode);
    }
}