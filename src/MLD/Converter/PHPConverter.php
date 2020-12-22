<?php

namespace MLD\Converter;

/**
 * Class CsvConverter
 */
class PHPConverter extends AbstractConverter
{

    /**
     * @var string
     */
    private $prefix = "<?php\nreturn [";

    /**
     * @var string
     */
    private $suffix = '];';
    
    /**
     * @var array
     */
    private $bodyChunks = [];

    /**
     * @return string data converted into CSV
     */
    public function convert()
    {
        array_walk($this->countries, [$this, 'processCountry']);
        return $this->prefix . "\n" . implode(",\n",$this->bodyChunks) . "\n" . $this->suffix;
    }
    
    private function processCountry(&$array)
    {
        $this->bodyChunks[] = 
            "'".$array['cca2'] ."' => " . var_export($array, true);
    }
}