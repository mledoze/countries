<?php

namespace MLD\Converter;

/**
 * Class AbstractConverter
 * @package MLD\Converter
 */
abstract class AbstractConverter implements ConverterInterface
{

    /**
     * @var string path of the output directory
     */
    private $outputDirectory;

    /** @var array defines the fields to keep */
    private $fields;

    /** @var array */
    protected $countries;

    /**
     * @param array $countries
     */
    public function __construct(array $countries)
    {
        $this->countries = $countries;
    }

    /**
     * Save the data to disk
     * @param string $outputFile name of the output file
     * @return int|bool
     */
    public function save($outputFile = '')
    {
        if (empty($this->outputDirectory)) {
            $this->setDefaultOutputDirectory();
        }
        if (!is_dir($this->outputDirectory)) {
            mkdir($this->outputDirectory);
        }
        if (empty($outputFile)) {
            $outputFile = date('Ymd-His', time()) . '-countries';
        }

        // keep only the specified fields
        if (!empty($this->fields)) {
            array_walk($this->countries, function (&$country) {
                $country = array_intersect_key($country, array_flip($this->fields));
            });
        }
        return file_put_contents($this->outputDirectory . $outputFile, $this->convert());
    }

    /**
     * Set the directory to which output will be written.
     *
     * @param string $outputDirectory
     * @return $this
     */
    public function setOutputDirectory($outputDirectory)
    {
        if (substr($outputDirectory, strlen($outputDirectory) - 1, 1) !== DIRECTORY_SEPARATOR) {
            $outputDirectory .= DIRECTORY_SEPARATOR;
        }

        $this->outputDirectory = $outputDirectory;

        return $this;
    }

    /**
     * Defines the fields to keep
     * @param array $fields
     * @return $this
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Gets fields that will currently be output.
     * @return array A list of field names.
     */
    public function getFields()
    {
        if ($this->fields !== null) {
            return $this->fields;
        }

        if (empty($this->countries)) {
            return array();
        }

        return array_keys($this->countries[0]);
    }

    /**
     * Converts arrays to comma-separated strings
     * @param array $input
     * @param string $glue
     * @return array
     */
    protected function convertArrays(array &$input, $glue = ',')
    {
        return array_map(function ($value) use ($glue) {
            return is_array($value) ? $this->recursiveImplode($value, $glue) : $value;
        }, $input);
    }

    /**
     * Set the default output directory
     */
    private function setDefaultOutputDirectory()
    {
        $this->outputDirectory = __DIR__ . DIRECTORY_SEPARATOR . 'dist' . DIRECTORY_SEPARATOR;
    }

    /**
     * Recursively implode elements
     * @param array $input
     * @param string $glue
     * @return string the array recursively imploded with the glue
     */
    private function recursiveImplode(array $input, $glue)
    {
        // remove empty strings from the array
        $input = array_filter($input, function ($entry) {
            return $entry !== '';
        });
        array_walk($input, function (&$value) use ($glue) {
            if (is_array($value)) {
                $value = $this->recursiveImplode($value, $glue);
            }
        });
        return implode($glue, $input);
    }
}