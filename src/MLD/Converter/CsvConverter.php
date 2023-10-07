<?php

declare(strict_types=1);

namespace MLD\Converter;

use MLD\Enum\Fields;

/**
 * Converts countries data to CSV format
 */
class CsvConverter extends AbstractConverter
{

    private string $glue = '","';

    /**
     * @inheritdoc
     */
    public function convert(array $countries): string
    {
        $headers = $this->buildHeadersLine($countries);
        $body = $this->buildBody($countries);
        return $headers . PHP_EOL . $body;
    }

    private function buildHeadersLine(array $countries): string
    {
        // special case for currencies, use keys only
        $firstEntry = $this->extractCurrencyCodes($countries[0]);
        $firstEntry = $this->removeNativeNames($firstEntry);
        $flattenedFirstEntry = $this->flatten($firstEntry);
        return sprintf('"%s"', implode($this->glue, array_keys($flattenedFirstEntry)));
    }

    private function buildBody(array $countries): string
    {
        $lines = array_map(
            function ($country) {
                $country = $this->extractCurrencyCodes($country);
                $country = $this->removeNativeNames($country);
                return sprintf('"%s"', implode($this->glue, $this->flatten($country)));
            },
            $countries
        );
        return implode(PHP_EOL, $lines) . PHP_EOL;
    }

    private function extractCurrencyCodes(array $country): array
    {
        if (isset($country[Fields::CURRENCIES->value])) {
            $country[Fields::CURRENCIES->value] = array_keys($country[Fields::CURRENCIES->value]);
        }

        return $country;
    }

    /**
     * Remove `name.native` field to prevent inconsistent column count between countries
     */
    private function removeNativeNames(array $country): array
    {
        if (isset($country[Fields::NAME->value][Fields::NAME_NATIVE->value])) {
            unset($country[Fields::NAME->value][Fields::NAME_NATIVE->value]);
        }
        return $country;
    }
}