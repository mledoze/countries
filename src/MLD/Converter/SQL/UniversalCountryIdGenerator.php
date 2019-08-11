<?php

namespace MLD\Converter\SQL;

use MLD\Converter\AbstractConverter;

/**
 * Class SQLIDGenerator, maps countries to a dedicated ID
 */
class UniversalCountryIdGenerator extends AbstractConverter
{
    /**
     * @var string
     */
    private $body = '';

    /**
     * @return string data converted to PHP
     */
    public function convert()
    {
        $officialMap = "\tconst OFFICIAL_MAP = array(\n";
        $commonMap = "\tconst COMMON_MAP = array(\n";
        $tldMap = "\tconst TLD_MAP = array(\n";

        foreach ($this->countries as $value) {
            $ucid = $value["ucid"];
            $official = $value["name"]["official"];
            if(isset($official)) {
                $officialMap .= "\t\t\"" . addslashes($official) . "\" => " . $ucid . ",\n";
            }
            $common = $value["name"]["common"];
            if(isset($common)) {
                $commonMap .= "\t\t\"" . addslashes($common) . "\" => " . $ucid . ",\n";
            }
            $tld = $value["tld"][0];
            if(isset($tld)) {
                $tldMap .= "\t\t\"" . addslashes($tld) . "\" => " . $ucid . ",\n";
            }
        }
        $officialMap .= "\t);\n\n";
        $commonMap .= "\t);\n\n";
        $tldMap .= "\t);\n\n";

        $this->body  = "<?php\n\n";
        $this->body .= "namespace MLD\Converter\SQL;\n\n";
        $this->body .= "class UniversalCountryId {\n\n";
        $this->body .= $officialMap;
        $this->body .= $commonMap;
        $this->body .= $tldMap;
        $this->body .= "}\n?>";
        return $this->body;
    }
}