<?php

declare(strict_types=1);

namespace MLDTests\Converter;

use MLD\Converter\YamlConverter;
use PHPUnit\Framework\TestCase;

class YamlConverterTest extends TestCase
{

    /**
     * @var YamlConverter
     */
    private $converter;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->converter = new YamlConverter();
    }

    public function testConvert(): void
    {
        $country = [
            'name' => [
                'common' => 'Venezuela',
                'official' => 'Bolivarian Republic of Venezuela',
                'native' =>
                    [
                        'spa' =>
                            [
                                'official' => 'República Bolivariana de Venezuela',
                                'common' => 'Venezuela',
                            ],
                    ],
            ],
            'independent' => true,
            'status' => 'officially-assigned',
            'currencies' => [
                'VES' => [
                    'name' => 'Venezuelan bolívar soberano',
                    'symbol' => 'Bs.S.',
                ],
            ],
            'idd' => [
                'root' => '+5',
                'suffixes' => [
                    '8',
                ],
            ],
            'altSpellings' => [
                'VE',
                'Bolivarian Republic of Venezuela',
                'Venezuela, Bolivarian Republic of',
                'República Bolivariana de Venezuela',
            ],
            'languages' =>
                [
                    'spa' => 'Spanish',
                ],
            'translations' =>
                [

                    'kor' =>
                        [
                            'official' => '베네수엘라 볼리바르 공화국',
                            'common' => '베네수엘라',
                        ],
                    'nld' =>
                        [
                            'official' => 'Bolivariaanse Republiek Venezuela',
                            'common' => 'Venezuela',
                        ],
                    'pol' =>
                        [
                            'official' => 'Boliwariańska Republika Wenezueli',
                            'common' => 'Wenezuela',
                        ],

                ],
            'latlng' =>
                [
                    8,
                    -66,
                ],
            'demonym' => 'Venezuelan',
            'landlocked' => false,
            'borders' => [
                'BRA',
                'COL',
                'GUY',
            ],
            'area' => 916445,
            'flag' => '🇻🇪',
        ];

        $expectedYaml = <<<YAML
- { name: { common: Venezuela, official: 'Bolivarian Republic of Venezuela', native: { spa: { official: 'República Bolivariana de Venezuela', common: Venezuela } } }, independent: true, status: officially-assigned, currencies: { VES: { name: 'Venezuelan bolívar soberano', symbol: Bs.S. } }, idd: { root: '+5', suffixes: ['8'] }, altSpellings: [VE, 'Bolivarian Republic of Venezuela', 'Venezuela, Bolivarian Republic of', 'República Bolivariana de Venezuela'], languages: { spa: Spanish }, translations: { kor: { official: '베네수엘라 볼리바르 공화국', common: 베네수엘라 }, nld: { official: 'Bolivariaanse Republiek Venezuela', common: Venezuela }, pol: { official: 'Boliwariańska Republika Wenezueli', common: Wenezuela } }, latlng: [8, -66], demonym: Venezuelan, landlocked: false, borders: [BRA, COL, GUY], area: 916445, flag: 🇻🇪 }

YAML;

        $conversionResult = $this->converter->convert([$country]);

        $this->assertSame($expectedYaml, $conversionResult);
    }
}