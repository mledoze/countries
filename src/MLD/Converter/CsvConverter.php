<?php

namespace MLD\Converter;

/**
 * Converts countries data to CSV format
 */
class CsvConverter extends AbstractConverter
{

    /**
     * @var string
     */
    private $glue = '","';

    /**
     * @param array $countries
     * @return string data converted into CSV
     */
    public function convert(array $countries)
    {
        $headers = $this->buildHeadersLine($countries);
        $body = $this->buildBody($countries);
        return $headers . PHP_EOL . $body;
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
     * @param array $countries
     * @return string
     */
    private function buildHeadersLine(array $countries)
    {
        return sprintf('"%s"', implode($this->glue, array_keys($countries[0])));
    }

    /**
     * @param array $countries
     * @return string
     */
    private function buildBody(array $countries)
    {
        $lines = array_map(
            function ($country) {
                return sprintf('"%s"', implode($this->glue, $this->convertArrays($country)));
            },
            $countries
        );
        return implode(PHP_EOL, $lines) . PHP_EOL;
    }
}