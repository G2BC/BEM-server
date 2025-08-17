<?php

namespace App\Services;

use App\Enum\FungiTaxon\TaxonType;
use App\Models\Fungi;
use App\Models\Taxonomy;
use App\Repositories\FungiRepository;
use App\Repositories\Taxonomy\TaxonomyRepository;
use App\Services\Contracts\FungiContract;
use App\Utils\Enums\BemClassification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class FungiService implements FungiContract
{

    public function __construct(
        private FungiRepository $repo,
        private TaxonomyRepository $taxonomy
    ) {}

    public function getAll(): Collection
    {
        try {
            return $this->repo->getAll();
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

            $data = $data->groupBy('state')->filter(function ($values, $stateKey) {

                return !empty(str_replace(' ', '', $stateKey));
            })->flatMap(function (SupportCollection $stateGroup, $state) {

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

    public function create(array $data): Fungi
    {
        try {
            $data['uuid'] = Str::uuid();
            $hasTaxonomy = $this->taxonomy->firstByScientificName($data['scientific_name']);
            $fungi = $hasTaxonomy->fungi ?? $this->repo->create($data);

            $this->taxonomy->create([...$data, 'fungi_id' => $fungi->id]);

            return $fungi->load('taxonomies');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(string $uuid, array $data): Fungi
    {
        try {
            $fungi = $this->repo->find($uuid);

            $fungi->update([
                'inaturalist_taxa' => $data['inaturalist_taxa'] ?? $fungi->inaturalist_taxa,
                'bem' => $data['bem'] ?? $fungi->bem,
                'kingdom' => $data['kingdom'] ?? $fungi->kingdom,
                'phylum' => $data['phylum'] ?? $fungi->phylum,
                'class' => $data['class'] ?? $fungi->class,
                'order' => $data['order'] ?? $fungi->order,
                'family' => $data['family'] ?? $fungi->family,
                'genus' => $data['genus'] ?? $fungi->genus,
                'specie' => $data['specie'] ?? $fungi->specie,
                'scientific_name' => $data['scientific_name'] ?? $fungi->scientific_name,
                'authors' => $data['authors'] ?? $fungi->authors,
                'brazilian_type' => $data['brazilian_type'] ?? $fungi->brazilian_type,
                'brazilian_type_synonym' => $data['brazilian_type_synonym'] ?? $fungi->brazilian_type_synonym,
                'popular_name' => $data['popular_name'] ?? $fungi->popular_name,
                'threatened' => $data['threatened'] ?? $fungi->threatened,
                'description' => $data['description'] ?? $fungi->description
            ]);

            return $fungi;
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

    public function findOrFail(int $id): Fungi
    {
        return $this->repo->findOrFail($id);
    }
}
