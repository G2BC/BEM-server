<?php

namespace App\Utils\Enums;

enum RedListClassification: int
{
    case NA = 0; //NOT ALLOWED -> nenhuma informação na IUCN API
    case NE = 1; //NOT EVALUATED
    case DD = 2; //DATA DEFICIENT
    case LC = 3; //LAST CONCERN
    case NT = 4; //NEAR THREATENED
    case VU = 5; //VULNERABLE
    case EN = 6; //ENDANGERED
    case CR = 7; //CRITICALLY ENGANGERED
    case EW = 8; //EXTINCT IN THE WILD
    case EX = 9; //EXTINCT

    public static function getValueByName(string $bem): int
    {

        return collect(RedListClassification::cases())->first(function ($item) use ($bem) {
            return $item->name == $bem;
        })->value;
    }
}
