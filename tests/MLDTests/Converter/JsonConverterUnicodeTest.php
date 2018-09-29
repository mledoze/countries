<?php

declare(strict_types=1);

namespace MLDTests\Converter;

use MLD\Converter\JsonConverterUnicode;
use PHPUnit\Framework\TestCase;

class JsonConverterUnicodeTest extends TestCase
{
    /**
     * @var JsonConverterUnicode
     */
    private $converter;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->converter = new JsonConverterUnicode();
    }

    public function testConvert(): void
    {
        $country = [
            'name' => [
                'common' => 'Kosovo',
                'official' => 'Republic of Kosovo',
                'native' => [
                    'sqi' => [
                        'official' => 'Republika e Kosovës',
                        'common' => 'Kosova',
                    ],
                    'srp' => [
                        'official' => 'Република Косово',
                        'common' => 'Косово',
                    ],
                ],
            ],
            'tld' => [],
            'cca2' => 'XK',
            'ccn3' => '',
            'cca3' => 'UNK',
            'cioc' => 'KOS',
            'independent' => null,
            'status' => 'user-assigned',
            'currency' => ['EUR'],
            'callingCode' => ['383'],
            'capital' => ['Pristina'],
            'altSpellings' => ['XK', 'Република Косово'],
            'region' => 'Europe',
            'subregion' => 'Eastern Europe',
            'languages' =>
                [
                    'sqi' => 'Albanian',
                    'srp' => 'Serbian',
                ],
            'latlng' => [42.666667, 21.166667],
            'demonym' => 'Kosovar',
            'landlocked' => true,
            'borders' => ['ALB', 'MKD', 'MNE', 'SRB'],
            'area' => 10908,
            'flag' => '🇽🇰',
        ];

        $expectedJson = <<<JSON
[{"name":{"common":"Kosovo","official":"Republic of Kosovo","native":{"sqi":{"official":"Republika e Kosovës","common":"Kosova"},"srp":{"official":"Република Косово","common":"Косово"}}},"tld":[],"cca2":"XK","ccn3":"","cca3":"UNK","cioc":"KOS","independent":null,"status":"user-assigned","currency":["EUR"],"callingCode":["383"],"capital":["Pristina"],"altSpellings":["XK","Република Косово"],"region":"Europe","subregion":"Eastern Europe","languages":{"sqi":"Albanian","srp":"Serbian"},"latlng":[42.666667,21.166667],"demonym":"Kosovar","landlocked":true,"borders":["ALB","MKD","MNE","SRB"],"area":10908,"flag":"🇽🇰"}]

JSON;

        $conversionResult = $this->converter->convert([$country]);

        $this->assertSame($expectedJson, $conversionResult);
    }
}