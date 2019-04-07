<?php

declare(strict_types=1);

namespace MLDTests\Converter;

use MLD\Converter\CsvConverter;
use MLD\Converter\Factory;
use MLD\Converter\JsonConverter;
use MLD\Converter\JsonConverterUnicode;
use MLD\Converter\XmlConverter;
use MLD\Converter\YamlConverter;
use MLD\Enum\Formats;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{

    /**
     * @var Factory
     */
    private $_factory;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->_factory = new Factory();
    }

    /**
     * @dataProvider provideFormats
     * @param string $format
     * @param string $expectedConverterClass
     */
    public function testCreate(string $format, string $expectedConverterClass): void
    {
        $converter = $this->_factory->create($format);
        $this->assertInstanceOf($expectedConverterClass, $converter);
    }

    public function testCreateThrowsInvalidArgumentExceptionWhenFormatIsInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->_factory->create('invalid_format');
    }

    /**
     * @return \Generator
     */
    public function provideFormats(): \Generator
    {
        yield 'Format CSV' => [Formats::CSV, CsvConverter::class];
        yield 'Format JSON' => [Formats::JSON, JsonConverter::class];
        yield 'Format JSON_UNESCAPED' => [Formats::JSON_UNESCAPED, JsonConverterUnicode::class];
        yield 'Format XML' => [Formats::XML, XmlConverter::class];
        yield 'Format YAML' => [Formats::YAML, YamlConverter::class];
    }
}
