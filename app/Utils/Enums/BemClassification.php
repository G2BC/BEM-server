<?php

namespace App\Utils\Enums;

enum BemClassification: int
{
    case BEM1 = 1;
    case BEM2 = 2;
    case BEM3 = 3;
    case BEM4 = 4;
    case BEM5 = 5;
    case BEM6 = 6;
    case BEM7 = 7;
    case BEM8 = 8;
    case BEM9 = 9;
    case BEM10 = 10;
    case P1 = 11;
    case P2 = 12;

    public static function getValueByName(string $bem): int
    {

        return collect(BemClassification::cases())->first(function ($item) use ($bem) {
            return $item->name == $bem;
        })->value;
    }
}
