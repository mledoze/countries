<?php

namespace MLD\Console\Command;

use MLD\Converter\Factory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ExportCommand
 * @package MLD\Console\Command
 */
class ExportCommand extends Command
{

    /**
     * @var string
     */
    private $inputFile;

    /**
     * @var string
     */
    private $defaultOutputDirectory;

    /**
     * @var array
     */
    private $converters = [
        'json' => ['class' => '\MLD\Converter\JsonConverter', 'output_file' => 'countries.json'],
        'json_unescaped' => [
            'class' => '\MLD\Converter\JsonConverterUnicode',
            'output_file' => 'countries-unescaped.json'
        ],
        'csv' => ['class' => '\MLD\Converter\CsvConverter', 'output_file' => 'countries.csv'],
        'xml' => ['class' => '\MLD\Converter\XmlConverter', 'output_file' => 'countries.xml'],
        'yml' => ['class' => '\MLD\Converter\YamlConverter', 'output_file' => 'countries.yml'],
    ];

    /**
     * @param string $inputFile Full path and filename of the input country data JSON file.
     * @param string $defaultOutputDirectory Full path to output directory for converted files.
     * @param string|null $name
     */
    public function __construct($inputFile, $defaultOutputDirectory, $name = 'convert')
    {
        $this->inputFile = $inputFile;
        $this->defaultOutputDirectory = $defaultOutputDirectory;

        parent::__construct($name);
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setDescription('Converts source country data to various output formats')
            ->addOption(
                'exclude-field',
                'x',
                InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED,
                'If set, excludes top-level field with the given name from the output. Cannot be used with --include-field',
                []
            )
            ->addOption(
                'include-field',
                'i',
                InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED,
                'If set, include only these top-level fields with the given name from the output. Cannot be used with --exclude-field',
                []
            )
            ->addOption(
                'format',
                'f',
                InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED,
                'Output formats',
                array_keys($this->converters)
            )
            ->addOption(
                'output-dir',
                null,
                InputOption::VALUE_OPTIONAL | InputOption::VALUE_REQUIRED,
                'Directory where you want to put output files',
                $this->defaultOutputDirectory
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws \InvalidArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $factory = $this->createConverterFactory();

        $countries = $this->decodeInputFile();
        $countries = $this->filterFields($countries, $input);

        /** @var array $formats */
        $formats = $input->getOption('format');
        $outputDirectory = $input->getOption('output-dir');

        foreach ($formats as $format) {
            if ($output->isVerbose()) {
                $output->writeln('Converting to ' . $format);
            }

            $converter = $factory->create($format);

            $conversionResult = $converter->convert($countries);
            // TODO save the result of the conversion
        }

        // TODO move this to another method
        $output->writeln(
            sprintf(
                '<info>Converted data for %d countries into %d formats.</info>',
                count($countries), count($this->converters)
            )
        );
    }

    /**
     * @param array $countries
     * @param InputInterface $input
     * @return array
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    private function filterFields(array $countries, InputInterface $input)
    {
        $baseFields = array_keys(reset($countries));
        $excludeFields = $input->getOption('exclude-field');
        $includeFields = $input->getOption('include-field');

        $outputFields = $this->getOutputFields($baseFields, $excludeFields, $includeFields);

        if (empty($outputFields)) {
            return $countries;
        }

        return array_map(
            function ($country) use ($outputFields) {
                return array_intersect_key($country, array_flip($outputFields));
            },
            $countries
        );
    }

    /**
     * @param array $baseFields
     * @param array $excludeFields
     * @param array $includeFields
     * @return array
     */
    private function getOutputFields($baseFields, $excludeFields, $includeFields)
    {
        $outputFields = $baseFields;

        if (!empty($excludeFields)) {
            $outputFields = array_diff($baseFields, $excludeFields);
        } elseif (!empty($includeFields)) {
            $outputFields = array_intersect($baseFields, $includeFields);
        }

        return $outputFields;
    }

    /**
     * @return Factory
     */
    private function createConverterFactory()
    {
        return new Factory();
    }

    /**
     * @return array
     */
    private function decodeInputFile()
    {
        return json_decode(file_get_contents($this->inputFile), true);
    }
}
