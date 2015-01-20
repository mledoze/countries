<?php
namespace MLD\Console\Command;

use MLD\CountryData as CD;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ExportCommand extends Command
{
    private $inputFile;
    private $outputDirectory;
    
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
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $countries = json_decode(file_get_contents($this->inputFile), true);
        (new CD\JsonConverter($countries))->setOutputDirectory($this->outputDirectory)->save('countries.json');
        (new CD\JsonConverterUnicode($countries))->setOutputDirectory($this->outputDirectory)->save('countries-unescaped.json');
        (new CD\CsvConverter($countries))->setOutputDirectory($this->outputDirectory)->save('countries.csv');
        (new CD\XmlConverter($countries))->setOutputDirectory($this->outputDirectory)->save('countries.xml');
        (new CD\YamlConverter($countries))->setOutputDirectory($this->outputDirectory)->save('countries.yml');

        $output->writeln('Converted data for <info>'.count($countries).'</info> countries');
    }
}