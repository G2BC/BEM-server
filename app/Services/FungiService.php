<?php

namespace App\Services;

use App\Repositories\FungiRepository;
use App\Services\Contracts\FungiContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FungiService implements FungiContract
{
    private FungiRepository $repo;

    public function __construct(FungiRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getById(int $id): Model
    {
        try {

            return $this->repo->find($id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getByUuid(string $uuid): Model
    {
        try {

            return $this->repo->find($uuid);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getByTaxonomy(string $taxonomy, ?string $occurrenceStateAcronym, ?string $biome, ?int $bemClassification): Collection
    {
        try {

            $data = $this->repo->getByTaxonomy($taxonomy);

            if (!is_null($bemClassification)) {
                $data->getByBem($bemClassification);
            }

            if (!is_null($occurrenceStateAcronym)) {
                $data->getByStateAcronym($occurrenceStateAcronym);
            }

            if (!is_null($biome)) {
                $data->getByBiome($biome);
            }

            return $data->withCountOccurrences()->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    public function getByStateAc(string $occurrenceStateAcronym): Collection
    {
        try {

            $data = $this->repo->getByStateAcronym($occurrenceStateAcronym);

            return $data->withCountOccurrences()->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
