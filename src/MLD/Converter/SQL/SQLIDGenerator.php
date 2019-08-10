<?php

namespace MLD\Converter\SQL;

use MLD\Converter\AbstractConverter;

/**
 * Class SQLIDGenerator, maps countries to a dedicated ID
 */
class SQLIDGenerator extends AbstractConverter
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
        $this->body  = "<?php\n\n";
        $this->body .= "namespace MLD\Converter\SQL;\n\n";
        $this->body .= "class Countries {\n";
        $this->body .= "\tconst MAP = array(\n";
        
        foreach ($this->countries as $key => $value) {
            $official = $value["name"]["official"];
            $this->body .= "\t\t\"" . addslashes($official) . "\" => " .  $key. ",\n";
        }
        $this->body .= "\t);\n";
        $this->body .= "}\n?>";
        return $this->body;
    }
}