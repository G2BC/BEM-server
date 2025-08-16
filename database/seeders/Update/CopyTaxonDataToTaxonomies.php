<?php

namespace Database\Seeders\Update;

use App\Enum\FungiTaxon\TaxonType;
use App\Models\Fungi;
use App\Models\Taxonomy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CopyTaxonDataToTaxonomies extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Taxonomy $taxonomy): void
    {
        Fungi::all()->each(function ($fungi) use ($taxonomy) {
            $data = [
                ...$fungi->toArray(),
                'fungi_id' => $fungi->id,
                'type' => TaxonType::MAIN
            ];

            $newTaxonomy = $taxonomy->newInstance();
            $newTaxonomy->fill(Arr::only($data, [
                'kingdom',
                'phylum',
                'class',
                'order',
                'family',
                'genus',
                'specie',
                'authors',
                'scientific_name',
                'type',
                'fungi_id',
            ]));
            $newTaxonomy->save();
        });
    }
}
