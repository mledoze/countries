<?php

namespace MLD\Converter\SQL;

use MLD\Converter\AbstractConverter;
use MLD\Converter\SQL\Countries;

const PRIMARYKEY = "id";
const COUNTRY_PRIMARYKEY = "country_id";
const NAME = "name";
const OFFICIAL = "official";
const COMMON = "common";
const TLD = "tld";
const CCA2 = "cca2";
const CCN3 = "ccn3";
const CCA3 = "cca3";
const CIOC = "cioc";
const INDEPENDENT = "independent";
const STATUS = "status";
const CAPITAL = "capital";
const REGION = "region";
const SUBREGION = "subregion";
const IDD = "idd";
const LATITUDE = "lat";
const LONGITUDE = "lng";
const LANGUAGE = "language";

/**
 * Class AbstractSQLConverter
 */
abstract class AbstractSQLConverter extends AbstractConverter
{
    /**
     * @var string
     */
    private $body = '';

    /**
     * @var int
     */
    private $translationPrimaryKey = 1;

    /**
     * @return string data converted to Yaml
     */
    public function convert()
    {
        # print_r($this->countries[0]);
        array_walk($this->countries, [$this, 'processCountry']);
        return $this->body;
    }

    private function getIDForOfficialCountryName($official)
    {
        if (in_array($official, Countries::MAP)) { 
            return Countries::MAP[$official];
        } 
        throw new Exception('ID for country not found: "' . $official . '"!');
    }

    /**
     * Processes a country.
     * @param $array
     */
    private function processCountry($data, $key)
    {
      //  if (isset($data['currencies'])) {
      //      $data['currencies'] = array_keys($data['currencies']);
      //  }
        $offical = $data['name']['official'];  

        $values = array();
        $primaryKey = $this->getIDForOfficialCountryName($offical);
        $values[PRIMARYKEY] = $primaryKey;
        $values[NAME] = $data['name']['common'];
        $values[OFFICIAL] = $offical;

        if (isset($data['tld'][0])) {
            $values[TLD] = $data['tld'][0];
        }
        if (isset($data['cca2'])) {
            $values[CCA2] = $data['cca2'];
        }
        if (isset($data['ccn3'])) {
            $values[CCN3] = $data['ccn3'];
        }
        if (isset($data['cca3'])) {
            $values[CCA3] = $data['cca3'];
        }
        if (isset($data['cioc'])) {
            $values[CIOC] = $data['cioc'];
        } else {
            $values[CIOC] = "";
        }
        if (isset($data['independent'])) {
            $values[INDEPENDENT] = $data['independent'];
        }
        if (isset($data['status'])) {
            $values[STATUS] = $data['status'];
        }
        if (isset($data['capital'][0])) {
            $values[CAPITAL] = $data['capital'][0];
        }
        if (isset($data['region'])) {
            $values[REGION] = $data['region'];
        }
        if (isset($data['subregion'])) {
            $values[SUBREGION] = $data['subregion'];
        }
        $values[IDD] = $data['idd']['root'];
        if (isset($data['idd']['suffixes'])) {
           $values[IDD] = implode(',', $data['idd']['suffixes']);;
        }
        if (is_array($data['latlng']) && count($data['latlng']) == 2) {
           $values[LATITUDE] = $data['latlng'][0];
           $values[LONGITUDE] = $data['latlng'][1];
        }
        $stmt = $this->generateStatement("country", $values, PRIMARYKEY, $primaryKey);
        if($stmt == null) {
            return;
        }
        $this->body .=  $stmt . ";\n";
        if (is_array($data['translations']) && count($data['translations']) > 0) {
            array_walk($data['translations'], [$this, 'processTranslationsForCountry'], $primaryKey);
        }
    }

    /**
     * Processes all the translations for a country.
     * @param $array
     */
    private function processTranslationsForCountry($value, $key, $countryPrimaryKey) 
    {
        if (!is_array($value)) {
            return;
        }
        $translation = array();
        $translation[COUNTRY_PRIMARYKEY] = $countryPrimaryKey;
        $translation[LANGUAGE] = $key;
        $translation[OFFICIAL] = $value['official'];
        $translation[COMMON] = $value['common'];
        $stmt = $this->generateStatement("country_translations", $translation);
        if($stmt == null) {
            return;
        }
        $this->body .=  $stmt . ";\n";
        $this->translationPrimaryKey++;
    }

    /**
     * Generate a statement from an array of values.
     * @param $array
     */
    abstract protected function generateStatement(string $table, array $values, string $primaryKeyColumn = null, int $primaryKey = -1);
}