<?php

namespace App\Enums;

enum CityClassifier: string
{
    case MOSCOW = 'Moscow';
    case KAZAN  = 'Kazan';
    case NONE   = 'none';

    static function forSelect(): array{
        $cases = [];
        foreach (self::cases() as $case){
            $cases[$case->value] = $case->value;
        }
        return $cases;
    }
}
