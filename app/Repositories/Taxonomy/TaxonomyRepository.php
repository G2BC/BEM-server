<?php

declare(strict_types=1);

namespace App\Repositories\Taxonomy;

use App\Enum\FungiTaxon\TaxonType;
use App\Models\Taxonomy;
use App\Repositories\BaseRepository;
use Illuminate\Validation\Rules\Exists;

class TaxonomyRepository extends BaseRepository
{
    public function __construct(private Taxonomy $model) {}

    public function create(array $data): Taxonomy
    {
        $this->changeOldMainsToSynonymous($data['scientific_name']);

        $taxonomy = $this->model->newInstance();
        $taxonomy->fill([...$data, 'type' => TaxonType::MAIN]);
        $taxonomy->save();


        return $taxonomy;
    }

    public function changeOldMainsToSynonymous(string $scientificName): void
    {
        $this->model->where('scientific_name', $scientificName)
            ->where('type', TaxonType::MAIN)
            ->update(['type' => TaxonType::SYNONYMOUS]);
    }

    public function firstByScientificName(string $scientificName): Taxonomy|null
    {
        return $this->model->where('scientific_name', $scientificName)->with('fungi')->first();
    }

}
