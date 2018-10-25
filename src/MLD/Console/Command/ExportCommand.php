<?php

declare(strict_types=1);

namespace MLD\Console\Command;

use MLD\Converter\Factory;
use MLD\Enum\ExportCommandOptions;
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
    private const BASE_OUTPUT_FILENAME = 'countries';

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
     * @param string|null $name Name of the export command
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
                ExportCommandOptions::EXCLUDE_FIELD,
                'x',
                InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED,
                'If set, excludes top-level field with the given name from the output. Cannot be used with --include-field',
                []
            )
            ->addOption(
                ExportCommandOptions::INCLUDE_FIELD,
                'i',
                InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED,
                'If set, include only these top-level fields with the given name from the output. Cannot be used with --exclude-field',
                []
            )
            ->addOption(
                ExportCommandOptions::FORMAT,
                'f',
                InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED,
                'Output formats',
                Formats::getAll()
            )
            ->addOption(
                ExportCommandOptions::OUTPUT_DIR,
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
        $formats = $input->getOption(ExportCommandOptions::FORMAT);

        foreach ($formats as $format) {
            if ($output->isVerbose()) {
                $output->writeln(sprintf('Converting to %s', $format));
            }

            try {
                $converter = $this->converterFactory->create($format);
            } catch (\InvalidArgumentException $exception) {
                $output->writeln(sprintf('Skipping %s format: %s', $format, $exception->getMessage()));
                continue;
            }

            $conversionResult = $converter->convert($countries);

            $filename = $this->generateFilename($format);
            $this->saveConversion($filename, $conversionResult);
        }

        $this->printResult($output, $countries, $formats);
    }

    /**
     * @param array $countries
     * @param array $outputFields
     * @return array
     */
    private function filterFields(array $countries, array $outputFields): array
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
    private function getOutputFields(InputInterface $input, array $countries): array
    {
        $baseFields = array_keys(reset($countries));
        $excludeFields = $input->getOption(ExportCommandOptions::EXCLUDE_FIELD);
        $includeFields = $input->getOption(ExportCommandOptions::INCLUDE_FIELD);

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
    private function createConverterFactory(): Factory
    {
        return new Factory();
    }

    /**
     * @return array
     */
    private function decodeInputFile(): array
    {
        return json_decode(file_get_contents($this->inputFile), true);
    }

    /**
     * @param OutputInterface $output
     * @param array $countries
     * @param array $formats
     */
    private function printResult(OutputInterface $output, array $countries, array $formats): void
    {
        $formatsCount = \count($formats);
        $output->writeln(
            sprintf(
                ngettext(
                    'Converted data for <info>%d</info> countries into <info>%d</info> format.',
                    'Converted data for <info>%d</info> countries into <info>%d</info> formats.',
                    $formatsCount
                ),
                \count($countries),
                $formatsCount
            )
        );
    }

    /**
     * @param string $filename
     * @param string $conversionResult
     */
    private function saveConversion($filename, $conversionResult): void
    {
        $outputFile = $this->outputDirectory . DIRECTORY_SEPARATOR . $filename;
        file_put_contents($outputFile, $conversionResult);
    }

    /**
     * @param OutputInterface $output
     */
    private function createOutputDirectory(OutputInterface $output): void
    {
        if (is_dir($this->outputDirectory) === false) {
            if ($output->isVerbose()) {
                $output->writeln('Creating directory %s', $this->outputDirectory);
            }
            mkdir($this->outputDirectory);
        }

        $this->outputDirectory = realpath($this->outputDirectory);
    }

    /**
     * @param string $format
     * @return string
     */
    private function generateFilename($format): string
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
    private function setOutputDirectory(InputInterface $input): void
    {
        $this->outputDirectory = trim($input->getOption(ExportCommandOptions::OUTPUT_DIR) ?? $this->outputDirectory);
    }
}
