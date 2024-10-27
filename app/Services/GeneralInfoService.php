<?php

namespace App\Services;

use App\Repositories\FungiRepository;
use App\Repositories\OccurrenceRepository;
use App\Http\Responses\GeneralInfoResponse;
use App\Services\Contracts\GeneralInfoContract;


class GeneralInfoService implements GeneralInfoContract
{
    private FungiRepository $fungiRepo;
    private OccurrenceRepository $occurencyRepo;

    public function __construct(OccurrenceRepository $occurencyRepo, FungiRepository $fungiRepo)
    {
        $this->fungiRepo = $fungiRepo;
        $this->occurencyRepo = $occurencyRepo;
    }

    public function getGeneralInfo(): GeneralInfoResponse
    {
        try {
            $occurrences = $this->occurencyRepo->all()->count();

            $brasilian_type_species = $this->fungiRepo->getBrasilianTypeAndBrasilianTypeSynomyn()->count();

            $edible_species = $this->fungiRepo->getEdibleSpecies()->count();
            
            $threatened = $this->fungiRepo->getThreatenedSpecies()->count();

            return GeneralInfoResponse::buildGeneralInfo($threatened, $occurrences, $edible_species, $brasilian_type_species);
           
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
