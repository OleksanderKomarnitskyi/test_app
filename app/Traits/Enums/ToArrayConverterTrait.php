<?php

namespace App\Traits\Enums;

use ReflectionClass;

trait ToArrayConverterTrait
{
    public static function toArray(): array
    {
        $reflectionClass = new ReflectionClass(self::class);
        $constants = $reflectionClass->getConstants();
        $values = array_column($constants, 'value');
        return $values;
    }

    public static function fromValue(string $value): ?self
    {
        $reflectionClass = new ReflectionClass(self::class);
        $constants = $reflectionClass->getConstants();

        foreach ($constants as $enum) {
            if ($enum->value === $value) {
                return $enum;
            }
        }

        return null;
    }
}
