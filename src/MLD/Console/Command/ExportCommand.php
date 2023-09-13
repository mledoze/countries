<?php

declare(strict_types=1);

namespace MLD\Console\Command;

use JsonException;
use MLD\Converter\Factory;
use MLD\Enum\ExportCommandOptions;
use MLD\Enum\Fields;
use MLD\Enum\Formats;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use function count;

/**
 * Command to export countries data to various formats.
 * @package MLD\Console\Command
 */
class ExportCommand extends Command
{
    private const BASE_OUTPUT_FILENAME = 'countries';
    private const EXIT_FAILURE = 1;
    private const EXIT_SUCCESS = 0;

    private string $inputFile;

    private ?string $outputDirectory;

    private Factory $converterFactory;

    /**
     * @param string $inputFile Full path and filename of the input country data JSON file.
     * @param string $defaultOutputDirectory Full path to output directory for converted files.
     * @param string|null $name Name of the export command
     * @throws LogicException
     */
    public function __construct($inputFile, string $defaultOutputDirectory, string|null $name = 'convert')
    {
        $this->inputFile = $inputFile;
        $this->outputDirectory = $defaultOutputDirectory;
        $this->converterFactory = $this->createConverterFactory();

        parent::__construct($name);
    }

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    protected function configure(): void
    {
        $this
            ->setDescription('Converts source country data to various output formats')
            ->addOption(
                ExportCommandOptions::EXCLUDE_FIELD->value,
                'x',
                InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED,
                'If set, excludes top-level field with the given name from the output. Cannot be used with --include-field',
                []
            )
            ->addOption(
                ExportCommandOptions::INCLUDE_FIELD->value,
                'i',
                InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED,
                'If set, include only these top-level fields with the given name from the output. Cannot be used with --exclude-field',
                Fields::values()
            )
            ->addOption(
                ExportCommandOptions::FORMAT->value,
                'f',
                InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED,
                'Output formats',
                Formats::values()
            )
            ->addOption(
                ExportCommandOptions::OUTPUT_DIR->value,
                null,
                InputOption::VALUE_OPTIONAL | InputOption::VALUE_REQUIRED,
                'Directory where you want to put output files',
                $this->outputDirectory
            );
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->setOutputDirectory($input);
        $this->createOutputDirectory($output);

        try {
            $countries = $this->decodeInputFile();
        } catch (JsonException $exception) {
            $output->writeln(sprintf('Failed to decode input countries file: %s', $exception->getMessage()));
            return self::EXIT_FAILURE;
        }

        $countries = $this->generateCallingCodes($countries);

        $outputFields = $this->getOutputFields($input, $countries);
        if ($output->isVerbose()) {
            $output->writeln(sprintf('Output fields: %s', implode(',', $outputFields)));
        }

        $countries = $this->filterFields($countries, $outputFields);
        $formats = $this->getFormats($input);
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
        return self::EXIT_SUCCESS;
    }

    /**
     * @param InputInterface $input
     * @return array
     */
    protected function getFormats(InputInterface $input): array
    {
        return $input->getOption(ExportCommandOptions::FORMAT->value);
    }

    /**
     * @codeCoverageIgnore cannot be tested through unit tests
     */
    protected function saveConversion(string $filename, string $conversionResult): bool
    {
        $outputFile = $this->outputDirectory . DIRECTORY_SEPARATOR . $filename;
        $bytesWritten = file_put_contents($outputFile, $conversionResult);
        return $bytesWritten !== false;
    }

    /**
     * @return Factory
     */
    private function createConverterFactory(): Factory
    {
        return new Factory();
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
            static fn($country) => array_intersect_key($country, $flippedOutputFields),
            $countries
        );
    }

    /**
     * @param InputInterface $input
     * @param array $countries
     * @return array
     * @throws InvalidArgumentException
     */
    private function getOutputFields(InputInterface $input, array $countries): array
    {
        $baseFields = array_keys(reset($countries));
        $excludeFields = $input->getOption(ExportCommandOptions::EXCLUDE_FIELD->value);
        $includeFields = $input->getOption(ExportCommandOptions::INCLUDE_FIELD->value);

        $outputFields = $baseFields;
        if (!empty($excludeFields)) {
            $outputFields = array_diff($baseFields, $excludeFields);
        } elseif (!empty($includeFields)) {
            $outputFields = array_intersect($baseFields, $includeFields);
        }

        return $outputFields;
    }

    /**
     * @return array
     * @throws JsonException
     */
    private function decodeInputFile(): array
    {
        return json_decode(file_get_contents($this->inputFile), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @param OutputInterface $output
     * @param array $countries
     * @param array $formats
     */
    private function printResult(OutputInterface $output, array $countries, array $formats): void
    {
        $formatsCount = count($formats);
        $output->writeln(
            sprintf(
                ngettext(
                    'Converted data for <info>%d</info> countries into <info>%d</info> format.',
                    'Converted data for <info>%d</info> countries into <info>%d</info> formats.',
                    $formatsCount
                ),
                count($countries),
                $formatsCount
            )
        );
    }

    /**
     * @param OutputInterface $output
     */
    private function createOutputDirectory(OutputInterface $output): void
    {
        if (is_dir($this->outputDirectory) === false) {
            if ($output->isVerbose()) {
                $output->writeln(sprintf('Creating directory %s', $this->outputDirectory));
            }
            mkdir($this->outputDirectory);
        }

        $this->outputDirectory = realpath($this->outputDirectory);
    }

    /**
     * @param string $format
     * @return string
     */
    private function generateFilename(string $format): string
    {
        $baseFilename = self::BASE_OUTPUT_FILENAME;

        // special case for JSON unespaced
        if ($format === Formats::JSON_UNESCAPED->value) {
            $baseFilename .= '-unescaped';
            $format = Formats::JSON->value;
        }

        return sprintf('%s.%s', $baseFilename, $format);
    }

    /**
     * @param InputInterface $input
     * @throws InvalidArgumentException
     */
    private function setOutputDirectory(InputInterface $input): void
    {
        $this->outputDirectory = trim(
            $input->getOption(ExportCommandOptions::OUTPUT_DIR->value) ?? $this->outputDirectory
        );
    }

    /**
     * Generate calling codes from the "idd" property
     */
    private function generateCallingCodes(array $countries): array
    {
        $generateCallingCodes = static function ($country) {
            $country[Fields::CALLING_CODES->value] = array_map(
                static fn($suffix): string => $country[Fields::IDD->value][Fields::IDD_ROOT->value] . $suffix,
                $country[Fields::IDD->value][Fields::IDD_SUFFIXES->value]
            );
            return $country;
        };
        return array_map($generateCallingCodes, $countries);
    }
}
