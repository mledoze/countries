<?php
require_once "vendor/autoload.php";

/**
 * Tools to convert countries in different formats
 * @author mledoze
 * @see https://github.com/mledoze/countries
 * @require PHP 5.4+
 */

use MLD\CountryData as CD;

$aCountriesSrc = json_decode(file_get_contents('countries.json'), true);
(new CD\JsonConverter($aCountriesSrc))->save('countries.json');
(new CD\JsonConverterUnicode($aCountriesSrc))->save('countries-unescaped.json');
(new CD\CsvConverter($aCountriesSrc))->save('countries.csv');
(new CD\XmlConverter($aCountriesSrc))->save('countries.xml');
(new CD\YamlConverter($aCountriesSrc))->save('countries.yml');