<?php

declare(strict_types=1);

namespace MLDTests\Console\Command;

use Exception;
use MLD\Console\Command\ExportCommand;
use MLD\Enum\ExportCommandOptions;
use MLD\Enum\Formats;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Output\Output;

class ExportCommandTest extends TestCase
{

    /**
     * @var MockObject|ExportCommand
     */
    private $commandDouble;

    /**
     * @var MockObject|Input
     */
    private $inputDouble;

    /**
     * @var MockObject|Output
     */
    private $outputDouble;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->inputDouble = $this->createInputDouble();
        $this->outputDouble = $this->createOutputDouble();
        $this->commandDouble = $this->createExportCommandDouble();
    }

    /**
     * @throws Exception
     */
    public function testCommandConvertCountriesData(): void
    {
        $exitCode = $this->commandDouble->run($this->inputDouble, $this->outputDouble);
        $this->assertEquals(0, $exitCode);
    }

    /**
     * @throws Exception
     */
    public function testConversionWithInvalidFormat(): void
    {
        $commandDouble = $this->getMockBuilder(ExportCommand::class)
            ->setMethods([
                'configure',
                'getFormats',
                'saveConversion',
            ])
            ->enableOriginalConstructor()
            ->setConstructorArgs(['countries.json', 'dist'])
            ->getMock();

        $commandDouble->method('configure')
            ->willReturn(true);

        $commandDouble->method('saveConversion')
            ->willReturn(true);

        $invalidFormat = '__invalid__';
        $commandDouble->method('getFormats')
            ->willReturn([$invalidFormat]);

        $errorMessage = sprintf('Unsupported format %s', $invalidFormat);
        $this->outputDouble->method('writeln')
            ->withConsecutive(
                [sprintf('Skipping %s format: %s', $invalidFormat, $errorMessage)],
                ['Converted data for <info>250</info> countries into <info>1</info> format.']
            );

        $exitCode = $commandDouble->run($this->inputDouble, $this->outputDouble);
        $this->assertEquals(0, $exitCode);
    }

    /**
     * @throws Exception
     */
    public function testCommandWhenVerboseOptionIsActive(): void
    {
        $this->outputDouble->method('isVerbose')
            ->willReturn(true);

        $this->outputDouble->method('writeln')
            ->withConsecutive(
                ['Output fields: name,tld,cca2,ccn3,cca3,cioc,independent,status,currencies,idd,capital,altSpellings,region,subregion,languages,translations,latlng,demonym,landlocked,borders,area,flag'],
                ['Converting to csv'],
                ['Converting to json'],
                ['Converting to json_unescaped'],
                ['Converting to xml'],
                ['Converting to yml'],
                ['Converted data for <info>250</info> countries into <info>5</info> formats.']
            );

        $exitCode = $this->commandDouble->run($this->inputDouble, $this->outputDouble);
        $this->assertEquals(0, $exitCode);
    }

    /**
     * @return ExportCommand|MockObject
     */
    private function createExportCommandDouble()
    {
        $double = $this->getMockBuilder(ExportCommand::class)
            ->setMethods([
                'configure',
                'saveConversion',
            ])
            ->enableOriginalConstructor()
            ->setConstructorArgs(['countries.json', 'dist'])
            ->getMock();

        $double->method('configure')
            ->willReturn(true);

        $double->method('saveConversion')
            ->willReturn(true);

        return $double;
    }

    /**
     * @return MockObject|Input
     */
    private function createInputDouble()
    {
        $double = $this->getMockBuilder(Input::class)
            ->setMethods(['getOption'])
            ->getMockForAbstractClass();

        $double->method('getOption')
            ->willReturnMap([
                [ExportCommandOptions::FORMAT, Formats::getAll()],
                [ExportCommandOptions::EXCLUDE_FIELD, ''],
                [ExportCommandOptions::INCLUDE_FIELD, ''],
                [ExportCommandOptions::OUTPUT_DIR, 'output-dir'],
            ]);

        return $double;
    }

    /**
     * @return MockObject|Output
     */
    protected function createOutputDouble()
    {
        return $this->getMockBuilder(Output::class)
            ->disableOriginalConstructor()
            ->setMethods(['writeLn', 'isVerbose'])
            ->getMockForAbstractClass();
    }
}
