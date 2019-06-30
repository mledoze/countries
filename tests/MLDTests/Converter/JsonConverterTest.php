<?php

declare(strict_types=1);

namespace MLDTests\Converter;

use MLD\Converter\JsonConverter;
use PHPUnit\Framework\TestCase;

class JsonConverterTest extends TestCase
{

    /**
     * @var JsonConverter
     */
    private $converter;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->converter = new JsonConverter();
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
[{"name":{"common":"Kosovo","official":"Republic of Kosovo","native":{"sqi":{"official":"Republika e Kosov\u00ebs","common":"Kosova"},"srp":{"official":"\u0420\u0435\u043f\u0443\u0431\u043b\u0438\u043a\u0430 \u041a\u043e\u0441\u043e\u0432\u043e","common":"\u041a\u043e\u0441\u043e\u0432\u043e"}}},"tld":[],"cca2":"XK","ccn3":"","cca3":"UNK","cioc":"KOS","independent":null,"status":"user-assigned","currency":["EUR"],"callingCode":["383"],"capital":["Pristina"],"altSpellings":["XK","\u0420\u0435\u043f\u0443\u0431\u043b\u0438\u043a\u0430 \u041a\u043e\u0441\u043e\u0432\u043e"],"region":"Europe","subregion":"Eastern Europe","languages":{"sqi":"Albanian","srp":"Serbian"},"latlng":[42.666667,21.166667],"demonym":"Kosovar","landlocked":true,"borders":["ALB","MKD","MNE","SRB"],"area":10908,"flag":"\ud83c\uddfd\ud83c\uddf0"}]

JSON;

        $conversionResult = $this->converter->convert([$country]);

        $this->assertSame($expectedJson, $conversionResult);
    }

    public function testConvertWithNoLanguages(): void
    {
        $country = [
            'name' => 'Paradise',
            'languages' => []
        ];

        $expectedJson = <<<JSON
[{"name":"Paradise","languages":{}}]

JSON;
        $conversionResult = $this->converter->convert([$country]);

        $this->assertSame($expectedJson, $conversionResult);
    }

    public function testConvertWithNoNativeNames(): void
    {
        $country = [
            'name' => [
                'common' => 'Paradise',
                'native' => []
            ],
            'languages' => []
        ];

        $expectedJson = <<<JSON
[{"name":{"common":"Paradise","native":{}},"languages":{}}]

JSON;
        $conversionResult = $this->converter->convert([$country]);

        $this->assertSame($expectedJson, $conversionResult);
    }
}