<?php

namespace App\Repositories;

use App\Models\Fungi;

class FungiRepository extends BaseRepository
{
    public function __construct(private Fungi $model)
    {
        $this->setModel($model);
        $this->setQuery($model->query());
    }

    public function create (array $data): Fungi
    {
        $fungi = $this->model->newInstance();
        $fungi->fill($data);
        $fungi->save();

        return $fungi;
    }

    public function getAll()
    {
        return $this->model->with('taxonomies')->get();
    }

    public function specieLike(string $specie, string $boolOperator = 'and')
    {
        if ($boolOperator == 'or') {
            $this->orLike('specie', $specie);
        } else {

            $this->ilike('specie', $specie);
        }
        return $this;
    }

    public function popularNameLike(string $name, string $boolOperator = 'and')
    {
        if ($boolOperator == 'or') {
            $this->orLike('popular_name', $name);
        } else {

            $this->ilike('popular_name', $name);
        }

        return $this;
    }

    public function kingdomLike(string $kingdom, string $boolOperator = 'and')
    {
        if ($boolOperator == 'or') {
            $this->orLike('kingdom', $kingdom);
        } else {

            $this->ilike('kingdom', $kingdom);
        }

        return $this;
    }

    public function phylumLike(string $phylum, string $boolOperator = 'and')
    {
        if ($boolOperator == 'or') {
            $this->orLike('phylum', $phylum);
        } else {

            $this->ilike('phylum', $phylum);
        }

        return $this;
    }

    public function classLike(string $class, string $boolOperator = 'and')
    {
        if ($boolOperator == 'or') {
            $this->orLike('class', $class);
        } else {

            $this->ilike('class', $class);
        }

        return $this;
    }

    public function orderLike(string $order, string $boolOperator = 'and')
    {
        if ($boolOperator == 'or') {
            $this->orLike('order', $order);
        } else {

            $this->ilike('order', $order);
        }

        return $this;
    }

    public function familyLike(string $family, string $boolOperator = 'and')
    {
        if ($boolOperator == 'or') {
            $this->orLike('family', $family);
        } else {

            $this->ilike('family', $family);
        }

        return $this;
    }

    public function genusLike(string $genus, string $boolOperator = 'and')
    {
        if ($boolOperator == 'or') {
            $this->orLike('genus', $genus);
        } else {

            $this->ilike('genus', $genus);
        }

        return $this;
    }

    public function scientificNameLike(string $name, string $boolOperator = 'and')
    {
        if ($boolOperator == 'or') {
            $this->orLike('scientific_name', $name);
        } else {

            $this->ilike('scientific_name', $name);
        }

        return $this;
    }

    public function getByBem(int $bem)
    {
        $this->where('bem', $bem);

        return $this;
    }

    public function getByStateAcronym(string $ac)
    {

        $this->getQuery()->whereRelation('occurrences', 'state_acronym', '=', $ac);

        return $this;
    }

    public function getByBiome(string $biome)
    {

        $this->getQuery()->whereRelation('occurrences', 'habitat', '=', $biome);

        return $this;
    }

    public function withOccurrences()
    {
        $this->getQuery()->with('occurrences');

        return $this;
    }

    public function withCountOccurrences()
    {
        $this->getQuery()->withCount('occurrences');

        return $this;
    }

    public function getByTaxonomy(string $taxonomy)
    {
        $this->getQuery()->whereAny([
            'specie',
            'popular_name',
            'kingdom',
            'phylum',
            'class',
            'order',
            'family',
            'genus',
            'scientific_name'
        ], 'ILIKE', $taxonomy);

        return $this;
    }

    public function groupedByStateAndClass()
    {
        $this->getQuery()
            ->join('fungi_occurrence', 'fungi.id', '=', 'fungi_occurrence.fungi_id')
            ->join('occurrence', 'fungi_occurrence.occurrence_id', '=', 'occurrence.id')
            ->select('occurrence.state_acronym as state', 'fungi.bem as classification')
            ->selectRaw('COUNT(*) as occurrences_count')
            ->groupBy('occurrence.state_acronym', 'fungi.bem');

        return $this;
    }

    public function getBrasilianTypeAndBrasilianTypeSynomyn()
    {
        return $this
            ->where('brazilian_type', 'T')
            ->orWhere('brazilian_type_synonym', 'TS')
            ->get();
    }

    public function getEdibleSpecies()
    {
        return Fungi::where('bem', '>=', 1)
            ->orWhere('bem', '<=', 10)
            ->get();
    }

    public function getThreatenedSpecies()
    {
        return Fungi::where('threatened', '>=', 3)->get();
    }

    public function findOrFail(int $id): Fungi
    {
        return $this->model->with('taxonomies')->findOrFail($id);
    }
}
