<?php

declare(strict_types=1);

namespace MLDTests\Converter;

use MLD\Converter\XmlConverter;
use PHPUnit\Framework\TestCase;

class XmlConverterTest extends TestCase
{

    /**
     * @var XmlConverter
     */
    private $converter;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->converter = new XmlConverter();
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

        $expectedJson = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<countries>
  <country name.common="Kosovo" name.official="Republic of Kosovo" name.native.sqi.official="Republika e Kosovës" name.native.sqi.common="Kosova" name.native.srp.official="Република Косово" name.native.srp.common="Косово" cca2="XK" ccn3="" cca3="UNK" cioc="KOS" independent="" status="user-assigned" currency="EUR" callingCode="383" capital="Pristina" altSpellings="XK,Република Косово" region="Europe" subregion="Eastern Europe" languages.sqi="Albanian" languages.srp="Serbian" latlng="42.666667,21.166667" demonym="Kosovar" landlocked="1" borders="ALB,MKD,MNE,SRB" area="10908" flag="🇽🇰"/>
</countries>

XML;

        $conversionResult = $this->converter->convert([$country]);

        $this->assertSame($expectedJson, $conversionResult);
    }
}
