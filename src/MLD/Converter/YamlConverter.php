<?php

namespace MLD\Converter;

use Symfony\Component\Yaml\Dumper;

/**
 * Class YamlConverter
 */
class YamlConverter extends AbstractConverter
{
    const INLINE_LEVEL = 1;

    /**
     * @param array $countries
     * @return string data converted to Yaml
     * @throws \InvalidArgumentException
     */
    public function convert(array $countries)
    {
        $dumper = new Dumper();

        return $dumper->dump($countries, self::INLINE_LEVEL);
    }
}