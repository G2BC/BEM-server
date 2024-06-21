<?php

namespace App\Services;

use App\Models\Occurrence;
use App\Repositories\FungiRepository;
use App\Repositories\OccurrenceRepository;
use App\Services\Contracts\OccurrenceContract;
use App\Utils\Enums\OccurrenceTypes;
use App\Utils\Enums\StatesAcronyms;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OccurrenceService implements OccurrenceContract
{
    private OccurrenceRepository $repo;
    private FungiRepository $fungiRepo;

    public function __construct(OccurrenceRepository $repo, FungiRepository $fungiRepo)
    {
        $this->repo = $repo;
        $this->fungiRepo = $fungiRepo;
    }

    public function getAll(?bool $curation): Collection
    {
        try {

            if (is_null($curation)) {
                return $this->repo->all();
            } else {
                return $this->repo->getByCuration($curation)->get();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
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

    public function create(string $fungiUuid, array $data): Occurrence
    {
        try {
            $data['uuid'] = Str::uuid();
            $data['type'] = OccurrenceTypes::Literature;
            $data['curation'] = true;
            $data['state_name'] = StatesAcronyms::getStateByAcronym($data['state_acronym']);

            $fungi = $this->fungiRepo->find($fungiUuid);

            DB::beginTransaction();
            $occurrence = $this->repo->getModel()->create($data);
            $fungi->occurrences()->add($occurrence->id);

            DB::commit();
            return $occurrence;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(string $uuid, array $data): Occurrence
    {
        try {
            $occurrence = $this->repo->find($uuid);

            $occurrence->update([
                'state_acronym' => $data['state_acronym'] ?? $occurrence->state_acronym,
                'state_name' => !is_null($data['state_acronym']) ? StatesAcronyms::getStateByAcronym($data['state_acronym']) : $occurrence->state_name,
                'habitat' => $data['habitat'] ?? $occurrence->habitat,
                'literature_reference' => $data['literature_reference'] ?? $occurrence->literature_reference,
                'latitude' => $data['latitude'] ?? $occurrence->latitude,
                'longitude' => $data['longitude'] ?? $occurrence->longitude,
                'curation' => $data['curation'] ?? $occurrence->curation
            ]);

            return $occurrence;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete(string $uuid): void
    {
        try {
            $fungi = $this->repo->find($uuid);

            $fungi->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
