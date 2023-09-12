<?php

declare(strict_types=1);

namespace MLD\Converter;

use DOMDocument;
use DOMException;

/**
 * Class XmlConverter
 */
class XmlConverter extends AbstractConverter
{

    private DOMDocument $domDocument;

    /**
     * @throws DOMException
     */
    public function __construct()
    {
        $this->initializeDomDocument();
    }

    /**
     * @param array $countries
     * @return string data converted into XML
     */
    public function convert(array $countries): string
    {
        array_walk($countries, [$this, 'processCountry']);
        return $this->domDocument->saveXML();
    }

    /**
     * @throws DOMException
     */
    private function initializeDomDocument(): void
    {
        $this->domDocument = new DOMDocument('1.0', 'UTF-8');
        $this->domDocument->formatOutput = true;
        $this->domDocument->preserveWhiteSpace = false;
        $this->domDocument->appendChild($this->domDocument->createElement('countries'));
    }

    /**
     * @throws DOMException
     */
    private function processCountry(array $country): void
    {
        $countryNode = $this->domDocument->createElement('country');
        $country = $this->flatten($country);
        array_walk($country, static function ($value, $key) use ($countryNode) {
            $countryNode->setAttribute($key, (string)$value);
        });
        $this->domDocument->documentElement->appendChild($countryNode);
    }
}