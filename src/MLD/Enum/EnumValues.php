<?php

namespace MLD\Enum;

trait EnumValues
{
    /**
     * Return the enum values
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}