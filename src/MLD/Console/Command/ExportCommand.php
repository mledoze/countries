<?php
namespace MLD\Console\Command;

use MLD\Converter\AbstractConverter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ExportCommand
 * @package MLD\Console\Command
 */
class ExportCommand extends Command {

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
		'json_unescaped' => ['class' => '\MLD\Converter\JsonConverterUnicode', 'output_file' => 'countries-unescaped.json'],
		'csv' => ['class' => '\MLD\Converter\CsvConverter', 'output_file' => 'countries.csv'],
		'xml' => ['class' => '\MLD\Converter\XmlConverter', 'output_file' => 'countries.xml'],
		'yml' => ['class' => '\MLD\Converter\YamlConverter', 'output_file' => 'countries.yml'],
	];

	/**
	 * @var
	 */
	private $outputFieldsCache;

	/**
	 * @param string $inputFile Full path and filename of the input country data JSON file.
	 * @param string $defaultOutputDirectory Full path to output directory for converted files.
	 * @param string|null $name
	 */
	public function __construct($inputFile, $defaultOutputDirectory, $name = 'convert') {
		$this->inputFile = $inputFile;
		$this->defaultOutputDirectory = $defaultOutputDirectory;

		parent::__construct($name);
	}

	/**
	 * @inheritdoc
	 */
	protected function configure() {
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
	 * @return int|null|void
	 */
	protected function execute(InputInterface $input, OutputInterface $output) {
		$countries = json_decode(file_get_contents($this->inputFile), true);
		$excludeFields = $input->getOption('exclude-field');
		$includeFields = $input->getOption('include-field');
		$formats = $input->getOption('format');
		$outputDirectory = $input->getOption('output-dir');

		foreach ($formats as $format) {
			$c = $this->converters[$format];
			if ($output->isVerbose()) {
				$output->writeln('Converting to ' . $format);
			}

			/** @var AbstractConverter $converter */
			$converter = new $c['class']($countries);
			$fields = $this->getOutputFields($converter->getFields(), $excludeFields, $includeFields);

			$converter
				->setOutputDirectory($outputDirectory)
				->setFields($fields)
				->save($c['output_file']);
		}

		$output->writeln('Converted data for <info>' . count($countries) . '</info> countries into <info>' . count($this->converters) . '</info> formats.');
	}

	/**
	 * @param $baseFields
	 * @param $excludeFields
	 * @return array
	 */
	private function getOutputFields($baseFields, $excludeFields, $includeFields) {
		if ($this->outputFieldsCache) {
			return $this->outputFieldsCache;
		}

		if (!empty($excludeFields)) {
			$this->outputFieldsCache = array_diff($baseFields, $excludeFields);
		} elseif (!empty($includeFields)) {
			$this->outputFieldsCache = array_intersect($baseFields, $includeFields);
		} else {
			$this->outputFieldsCache = $baseFields;
		}

		return $this->outputFieldsCache;
	}
}
