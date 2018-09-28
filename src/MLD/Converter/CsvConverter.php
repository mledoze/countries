<?php

declare(strict_types=1);

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
     * @inheritdoc
     */
    public function convert(array $countries): string
    {
        $headers = $this->buildHeadersLine($countries);
        $body = $this->buildBody($countries);
        return $headers . PHP_EOL . $body;
    }

    /**
     * @param array $countries
     * @return string
     */
    private function buildHeadersLine(array $countries): string
    {
        $firstEntry = $this->flatten($countries[0]);
        return sprintf('"%s"', implode($this->glue, array_keys($firstEntry)));
    }

    /**
     * @param array $countries
     * @return string
     */
    private function buildBody(array $countries): string
    {
        $lines = array_map(
            function ($country) {
                return sprintf('"%s"', implode($this->glue, $this->flatten($country)));
            },
            $countries
        );
        return implode(PHP_EOL, $lines) . PHP_EOL;
    }
}