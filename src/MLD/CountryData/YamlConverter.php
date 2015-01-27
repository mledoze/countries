<?php
namespace MLD\CountryData;

/**
 * Class YamlConverter
 */
class YamlConverter extends AbstractConverter {

    /**
     * @return string data converted to Yaml
     */
    public function convert() {
        $dumper = new \Symfony\Component\Yaml\Dumper();
        $inlineLevel = 1;

        return $dumper->dump($this->aCountries, $inlineLevel);
    }
}