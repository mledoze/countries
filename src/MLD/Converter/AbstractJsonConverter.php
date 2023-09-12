<?php

declare(strict_types=1);

namespace MLD\Converter;

use MLD\Enum\Fields;
use stdClass;

/**
 * Class AbstractJsonConverter
 */
abstract class AbstractJsonConverter extends AbstractConverter
{

    /**
     * @inheritdoc
     */
    public function convert(array $countries): string
    {
        $countries = $this->processEmptyArrays($countries);
        return preg_replace(
            '@},{@',
            sprintf('},%s{', PHP_EOL),
            $this->jsonEncode($countries) . PHP_EOL
        );
    }

    /**
     * JSON encode countries data
     */
    abstract protected function jsonEncode(array $countries): string;

    /**
     * Special case for empty arrays that should be encoded as empty JSON objects
     */
    protected function processEmptyArrays(array $countries): array
    {
        return array_map(
            static function ($country) {
                if (isset($country[Fields::LANGUAGES->value]) && empty($country[Fields::LANGUAGES->value])) {
                    $country[Fields::LANGUAGES->value] = new stdClass();
                }

                if (isset($country[Fields::NAME->value][Fields::NAME_NATIVE->value]) && empty($country[Fields::NAME->value][Fields::NAME_NATIVE->value])) {
                    $country[Fields::NAME->value][Fields::NAME_NATIVE->value] = new stdClass();
                }
                return $country;
            },
            $countries
        );
    }
}
