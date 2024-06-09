<?php

namespace App\Utils\Enums;
 
enum UserTypes:int {
    case Admin = 1;
    case Specialist = 2;
    case Commom = 3;

    public static function getValueByName(string $type): int {

        return collect(OccurrenceTypes::cases())->first(function ($item) use ($type) {
            return $item->name == $type;
        })->value;
    }
}