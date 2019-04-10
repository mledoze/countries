<?php

declare(strict_types=1);

namespace MLD\Converter;

use MLD\Enum\Fields;

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
        // special case for currencies, use keys only
        $firstEntry = $this->extractCurrencies($countries[0]);

        $flattenedFirstEntry = $this->flatten($firstEntry);
        return sprintf('"%s"', implode($this->glue, array_keys($flattenedFirstEntry)));
    }

    /**
     * @param array $countries
     * @return string
     */
    private function buildBody(array $countries): string
    {
        $lines = array_map(
            function ($country) {
                $country = $this->extractCurrencies($country);
                return sprintf('"%s"', implode($this->glue, $this->flatten($country)));
            },
            $countries
        );
        return implode(PHP_EOL, $lines) . PHP_EOL;
    }

    /**
     * @param array $country
     * @return array
     */
    private function extractCurrencies(array $country): array
    {
        $country[Fields::CURRENCIES] = array_keys($country[Fields::CURRENCIES]);

        return $country;
    }
}