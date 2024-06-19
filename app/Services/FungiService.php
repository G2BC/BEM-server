<?php

namespace App\Services;

use App\Repositories\FungiRepository;
use App\Services\Contracts\FungiContract;
use App\Utils\Enums\BemClassification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class FungiService implements FungiContract
{
    private FungiRepository $repo;

    public function __construct(FungiRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll(): Collection
    {
        try {
            return $this->repo->all();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getById(int $id): Model
    {
        try {

            return $this->repo->find($id)->load('occurrences');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getByUuid(string $uuid): Model
    {
        try {

            return $this->repo->find($uuid)->load('occurrences');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getByTaxonomy(string $taxonomy, ?string $occurrenceStateAcronym, ?string $biome, ?int $bemClassification, ?int $page): LengthAwarePaginator
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

            $data->withCountOccurrences();

            return $data->paginate(20, page: $page);
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

    public function getByBem(int $bem): Collection
    {
        try {

            $data = $this->repo->getByBem($bem);

            return $data->withCountOccurrences()->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function groupedByStateAndClass(): SupportCollection
    {
        try {

            $data = $this->repo->groupedByStateAndClass()->get();

            $data = $data->groupBy('state')->flatMap(function (SupportCollection $stateGroup, $state) {

                return [
                    $state => [
                        'occurrences_count' => $stateGroup->sum(function ($item) {

                            return $item->occurrences_count;
                        }),
                        'classifications_count' => $stateGroup->mapWithKeys(function ($item) {

                            return [BemClassification::from($item->classification)->name => $item->occurrences_count];
                        })
                    ]
                ];
            });

            return $data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
