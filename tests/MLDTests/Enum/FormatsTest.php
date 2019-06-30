<?php

declare(strict_types=1);

namespace MLDTests\Enum;

use MLD\Enum\Formats;
use PHPUnit\Framework\TestCase;

class FormatsTest extends TestCase
{

    public function testGetAll(): void
    {
        $expectedFormats = [
            'csv',
            'json',
            'json_unescaped',
            'xml',
            'yml'
        ];
        $formats = Formats::getAll();

        $this->assertSame($expectedFormats, $formats);
    }
}