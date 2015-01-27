<?php
namespace MLD\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ExportCommand extends Command
{
    private $inputFile;
    private $outputDirectory;
    private $converters = array(
        'json'           => array('class' => '\MLD\CountryData\JsonConverter',        'output_file' => 'countries.json'),
        'json_unescaped' => array('class' => '\MLD\CountryData\JsonConverterUnicode', 'output_file' => 'countries-unescaped.json'),
        'csv'            => array('class' => '\MLD\CountryData\CsvConverter',         'output_file' => 'countries.csv'),
        'xml'            => array('class' => '\MLD\CountryData\XmlConverter',         'output_file' => 'countries.xml'),
        'yml'            => array('class' => '\MLD\CountryData\YamlConverter',        'output_file' => 'countries.yml'),
    );
    private $outputFieldsCache;
    
    /**
     * @param string      $inputFile       Full path and filename of the input country data JSON file.
     * @param string      $outputDirectory Full path to output directory for converted files.
     * @param string|null $name
     */
    public function __construct($inputFile, $outputDirectory, $name = null) {
        $this->inputFile       = $inputFile;
        $this->outputDirectory = $outputDirectory;
        
        parent::__construct($name);
    }
    
    protected function configure()
    {
        $this
            ->setName('convert')
            ->setDescription('Converts source country data to various output formats')
            ->addOption(
               'exclude-field',
               'x',
               InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED,
               'If set, excludes top-level field with the given name from the output',
               array()
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $countries     = json_decode(file_get_contents($this->inputFile), true);
        $excludeFields = $input->getOption('exclude-field');
        
        foreach ($this->converters as $format => $c) {
            if ($output->isVerbose()) {
                $output->writeln('Converting to '.$format);
            }
            
            $converter = new $c['class']($countries);
            $fields    = $this->getOutputFields($converter->getFields(), $excludeFields);
            
            $converter
                ->setOutputDirectory($this->outputDirectory)
                ->setFields($fields)
                ->save($c['output_file'])
            ;
        }

        $output->writeln('Converted data for <info>'.count($countries).'</info> countries into <info>'.count($this->converters).'</info> formats.');
    }
    
    private function getOutputFields($baseFields, $excludeFields)
    {
        if ($this->outputFieldsCache) {
            return $this->outputFieldsCache;
        }
        
        $this->outputFieldsCache = array_diff($baseFields, $excludeFields);
        
        return $this->outputFieldsCache;
    }
}