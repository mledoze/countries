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
        $this->_initializeDomDocument();
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

    private function _initializeDomDocument()
    {
        $this->domDocument = new \DOMDocument('1.0', 'UTF-8');
        $this->domDocument->formatOutput = true;
        $this->domDocument->preserveWhiteSpace = false;
        $this->domDocument->appendChild($this->domDocument->createElement('countries'));
    }

    /**
     * @param array $country
     */
    private function processCountry(array $country)
    {
        $countryNode = $this->domDocument->createElement('country');
        $country = $this->flatten($country);
        array_walk($country, function ($value, $key) use ($countryNode) {
            $countryNode->setAttribute($key, $value);
        });
        $this->domDocument->documentElement->appendChild($countryNode);
    }
}