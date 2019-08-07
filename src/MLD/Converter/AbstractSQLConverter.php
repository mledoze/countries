<?php

namespace MLD\Converter;

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
     * @return string data converted to Yaml
     */
    public function convert()
    {
        print_r($this->countries[0]);
        array_walk($this->countries, [$this, 'processCountry']);
        return $this->body;
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
        $values = array();
        $values[NAME] = $data['name']['common'];
        $values[OFFICIAL] = $data['name']['official'];
        
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
        $this->body .= $this->generateStatement("country", $values). ";\n";

        if (is_array($data['translations']) && count($data['translations']) > 0) {
            array_walk($data['translations'], [$this, 'processTranslationsForCountry']);
        }
    }

    /**
     * Processes all the translations for a country.
     * @param $array
     */
    private function processTranslationsForCountry($value, $key) 
    {
        if (!is_array($value)) {
            return;
        }
        $translation = array();
        $translation[LANGUAGE] = $key;
        $translation[OFFICIAL] = $value['official'];
        $translation[COMMON] = $value['common'];
        $this->body .= $this->generateStatement("country_translations", $translation). ";\n";
    }

    /**
     * Generate a statement from an array of values.
     * @param $array
     */
    abstract protected function generateStatement(string $table, array $values);
}