<?php

namespace MLD\Converter;

const NAME = "name";
const OFFICIAL = "official";
const TLD = "tld";
const CCA2 = "cca2";
const CCN3 = "ccn3";
const CCA3 = "cca3";
const CIOC = "cioc";
const CAPITAL = "capital";

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
    private function processCountry(&$data)
    {
      //  if (isset($data['currencies'])) {
      //      $data['currencies'] = array_keys($data['currencies']);
      //  }
        $values[NAME] = $data['name']['common'];
        $values[OFFICIAL] = $data['name']['official'];
        
        if (isset($data['tld'][0])) {
            $values[TLD] = $data['tld'][0];
        } else {
            $values[TLD] = "";
        }
        if (isset($data['cca2'])) {
            $values[CCA2] = $data['cca2'];
        } else {
            $values[CCA2] = "";
        }
        if (isset($data['ccn3'])) {
            $values[CCN3] = $data['ccn3'];
        } else {
            $values[CCN3] = "";
        }
        if (isset($data['cca3'])) {
            $values[CCA3] = $data['cca3'];
        } else {
            $values[CCA3] = "";
        }
        if (isset($data['cioc'])) {
            $values[CIOC] = $data['cioc'];
        } else {
            $values[CIOC] = "";
        }
        if (isset($data['capital'][0])) {
            $values[CAPITAL] = $data['capital'][0];
        } else {
            $values[CAPITAL] = "";
        }

        $stmt = $this->generateStatement($values);
        $this->body .= $stmt . ";\n";
    }

    /**
     * Generate a statement from an array of values.
     * @param $array
     */
    abstract protected function generateStatement(array $values);
}