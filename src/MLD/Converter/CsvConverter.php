<?php

namespace MLD\Converter;

/**
 * Class CsvConverter
 */
class CsvConverter extends AbstractConverter
{

    /**
     * @var string
     */
    private $glue = '","';

    /**
     * @var string
     */
    private $body = '';

    /**
     * @return string data converted into CSV
     */
    public function convert()
    {
        array_walk($this->countries, [$this, 'processCountry']);
        $headers = '"' . implode($this->glue, array_keys($this->countries[0])) . '"';
        return $headers . "\n" . $this->body;
    }

    /**
     * @return string
     */
    public function getGlue()
    {
        return $this->glue;
    }

    /**
     * @param string $glue
     */
    public function setGlue($glue)
    {
        $this->glue = $glue;
    }

    /**
     * Processes a country.
     * @param $array
     */
    private function processCountry(&$array)
    {
        $this->body .= '"' . implode($this->glue, $this->convertArrays($array)) . "\"\n";
    }
}