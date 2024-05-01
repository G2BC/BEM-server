<?php

namespace App\Utils\Enums;
 
enum OccurrenceTypes:int {
    case Literature = 1;
    case iNaturalist = 2;
    case SpeciesLink = 3;

    public static function getValueByName(string $type): int {

        return collect(OccurrenceTypes::cases())->first(function ($item) use ($type) {
            return $item->name == $type;
        })->value;
    }
}