<?php

namespace MLD\Console\Command;

use MLD\Converter\Factory;
use MLD\Enum\Formats;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command to export countries data to various formats.
 * @package MLD\Console\Command
 */
class ExportCommand extends Command
{
    const BASE_OUTPUT_FILENAME = 'countries';

    const OPTION_EXCLUDE_FIELD = 'exclude-field';
    const OPTION_INCLUDE_FIELD = 'include-field';
    const OPTION_FORMAT = 'format';
    const OPTION_OUTPUT_DIR = 'output-dir';

    /**
     * @var string
     */
    private $inputFile;

    /**
     * @var string
     */
    private $outputDirectory;

    /**
     * @var Factory
     */
    private $converterFactory;

    /**
     * @param string $inputFile Full path and filename of the input country data JSON file.
     * @param string $defaultOutputDirectory Full path to output directory for converted files.
     * @param string|null $name
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    public function __construct($inputFile, $defaultOutputDirectory, $name = 'convert')
    {
        parent::__construct($name);

        $this->inputFile = $inputFile;
        $this->outputDirectory = $defaultOutputDirectory;
        $this->converterFactory = $this->createConverterFactory();
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setDescription('Converts source country data to various output formats')
            ->addOption(
                self::OPTION_EXCLUDE_FIELD,
                'x',
                InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED,
                'If set, excludes top-level field with the given name from the output. Cannot be used with --include-field',
                []
            )
            ->addOption(
                self::OPTION_INCLUDE_FIELD,
                'i',
                InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED,
                'If set, include only these top-level fields with the given name from the output. Cannot be used with --exclude-field',
                []
            )
            ->addOption(
                self::OPTION_FORMAT,
                'f',
                InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED,
                'Output formats',
                Formats::getAll()
            )
            ->addOption(
                self::OPTION_OUTPUT_DIR,
                null,
                InputOption::VALUE_OPTIONAL | InputOption::VALUE_REQUIRED,
                'Directory where you want to put output files',
                $this->outputDirectory
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws \InvalidArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->setOutputDirectory($input);
        $this->createOutputDirectory($output);

        $countries = $this->decodeInputFile();

        $outputFields = $this->getOutputFields($input, $countries);
        if ($output->isVerbose()) {
            $output->writeln(sprintf('Output fields: %s', implode(',', $outputFields)));
        }

        $countries = $this->filterFields($countries, $outputFields);

        /** @var array $formats */
        $formats = $input->getOption(self::OPTION_FORMAT);

        foreach ($formats as $format) {
            if ($output->isVerbose()) {
                $output->writeln('Converting to ' . $format);
            }

            try {
                $converter = $this->converterFactory->create($format);
            } catch (\InvalidArgumentException $exception) {
                $output->writeln(sprintf("Skipping format '%s': %s", $format, $exception->getMessage()));
                continue;
            }

            $conversionResult = $converter->convert($countries);

            $filename = $this->generateFilename($format);
            $this->saveConversion($filename, $conversionResult);
        }

        $count = count($formats);
        $output->writeln('Converted data for <info>' . count($countries) . '</info> countries into <info>' . $count . '</info> ' . ($count == 1 ? 'format.' : 'formats.'));
    }

    /**
     * @param array $countries
     * @param array $outputFields
     * @return array
     */
    private function filterFields(array $countries, array $outputFields)
    {
        if (empty($outputFields)) {
            return $countries;
        }

        $flippedOutputFields = array_flip($outputFields);
        return array_map(
            function ($country) use ($flippedOutputFields) {
                return array_intersect_key($country, $flippedOutputFields);
            },
            $countries
        );
    }

    /**
     * @param InputInterface $input
     * @param array $countries
     * @return array
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    private function getOutputFields(InputInterface $input, array $countries)
    {
        $baseFields = array_keys(reset($countries));
        $excludeFields = $input->getOption(self::OPTION_EXCLUDE_FIELD);
        $includeFields = $input->getOption(self::OPTION_INCLUDE_FIELD);

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

    /**
     * @param OutputInterface $output
     * @param array $countries
     * @param array $formats
     */
    private function printResult(OutputInterface $output, array $countries, array $formats)
    {
        $formatsCount = count($formats);
        $output->writeln(
            sprintf(
                ngettext(
                    '<info>Converted data for %d countries into %d format.</info>',
                    '<info>Converted data for %d countries into %d formats.</info>',
                    $formatsCount
                ),
                count($countries),
                $formatsCount
            )
        );
    }

    /**
     * @param string $filename
     * @param string $conversionResult
     */
    private function saveConversion($filename, $conversionResult)
    {
        $outputFile = $this->outputDirectory . DIRECTORY_SEPARATOR . $filename;
        file_put_contents($outputFile, $conversionResult);
    }

    /**
     * @param OutputInterface $output
     */
    private function createOutputDirectory(OutputInterface $output)
    {
        if (is_dir($this->outputDirectory) === false) {
            if ($output->isVerbose()) {
                $output->writeln('Creating directory %s', $this->outputDirectory);
            }
            mkdir($this->outputDirectory);

            // TODO maybe move this line after the if?
            $this->outputDirectory = realpath($this->outputDirectory);
        }
    }

    /**
     * @param string $format
     * @return string
     */
    private function generateFilename($format)
    {
        $baseFilename = self::BASE_OUTPUT_FILENAME;

        // special case for JSON unespaced
        if ($format === Formats::JSON_UNESCAPED) {
            $baseFilename .= '-unescaped';
            $format = Formats::JSON;
        }

        return sprintf('%s.%s', $baseFilename, $format);
    }

    /**
     * @param InputInterface $input
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    private function setOutputDirectory(InputInterface $input)
    {
        $this->outputDirectory = trim($input->getOption(self::OPTION_OUTPUT_DIR)) ?: $this->outputDirectory;
    }
}
