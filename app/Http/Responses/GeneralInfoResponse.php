<?php

namespace App\Http\Responses;

class GeneralInfoResponse {
    public int $threatened;
    public int $occurrences;
    public int $edible_species;
    public int $brasilian_type_species;

    public static function buildGeneralInfo(
        int $threatened, 
        int $occurrences, 
        int $edible_species, 
        int $brasilian_type_species): GeneralInfoResponse
    {
        $generalInfo = new GeneralInfoResponse();
        $generalInfo->threatened = $threatened;
        $generalInfo->occurrences = $occurrences;
        $generalInfo->edible_species = $edible_species;
        $generalInfo->brasilian_type_species = $brasilian_type_species;

        return $generalInfo;
    }
}