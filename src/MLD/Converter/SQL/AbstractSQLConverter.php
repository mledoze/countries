<?php

namespace MLD\Converter\SQL;

use MLD\Converter\AbstractConverter;
use MLD\Converter\SQL\UniversalCountryId;
use Exception;

const UCID = "ucid";
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
const FLAG = "flag";

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

    private function ucidValidation(int $currentUcid, string $common, string $official, string $tld = null)
    {

        if(isset(UniversalCountryId::COMMON_MAP[$common])) {
            $previousUcid = UniversalCountryId::COMMON_MAP[$common];
            if ($previousUcid == $currentUcid) {
                return;
            } else {
                throw new Exception('Universal country ID from "' . $common . '", did change from "' . $previousUcid . '" to "' . $currentUcid . '"!');
            }
        }

        if (isset(UniversalCountryId::OFFICIAL_MAP[$official])) {
            $previousUcid = UniversalCountryId::OFFICIAL_MAP[$official];
            if ($previousUcid == $currentUcid) {
                return;
            } else {
                throw new Exception('Universal country ID from "' . $official . '", did change from "' . $previousUcid . '" to "' . $currentUcid . '"!');
            }
        }
        
        if (isset(UniversalCountryId::TLD_MAP[$tld])) {
            $previousUcid = UniversalCountryId::TLD_MAP[$tld];
            if ($previousUcid == $currentUcid) {
                return;
            } else {
                throw new Exception('Universal country ID from "' . $tld . '", did change from "' . $previousUcid . '" to "' . $currentUcid . '"!');
            }
        }

        throw new Exception('Country "' . $common . ', ' . $official . ', ' . $tld . '" does not have an universal country ID!');
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
      
        $primaryKey = $data[UCID]; 
        if(!isset($primaryKey)) {
            return;
        }

        $values = array();
        $values[PRIMARYKEY] = $primaryKey;
        $values[NAME] = $data['name']['common'];
        $values[OFFICIAL] = $data['name']['official'];  
        
        if (isset($data['tld'][0])) {
            $values[TLD] = $data['tld'][0];
            $this->ucidValidation($values[PRIMARYKEY], $values[NAME], $values[OFFICIAL], $values[TLD]);
        } else {
            $this->ucidValidation($values[PRIMARYKEY], $values[NAME], $values[OFFICIAL]);
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
        if (isset($data['flag'])) {
            $values[FLAG] = $this->unicode_encode($data['flag']);
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

    private function unicode_encode(string $value) 
    {
        $str = json_encode($value);
        return trim($str, '"');
    }

    /**
     * Generate a statement from an array of values.
     * @param $array
     */
    abstract protected function generateStatement(string $table, array $values, string $primaryKeyColumn = null, int $primaryKey = -1);
}