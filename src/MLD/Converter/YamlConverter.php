<?php

declare(strict_types=1);

namespace MLD\Converter;

use Symfony\Component\Yaml\Dumper;

/**
 * Convert countries data into YAML format
 */
class YamlConverter extends AbstractConverter
{
    private const INLINE_LEVEL = 1;

    /**
     * @inheritdoc
     */
    public function convert(array $countries): string
    {
        $dumper = new Dumper();

        return $dumper->dump($countries, self::INLINE_LEVEL);
    }
}