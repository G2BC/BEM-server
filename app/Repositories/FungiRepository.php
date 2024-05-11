<?php

namespace App\Repositories;

use App\Models\Fungi;

class FungiRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = Fungi::class;
    }

    public function find(int|string $key)
    {
        if (is_int($key)) {

            return $this->findId($key);
        } else if (is_string($key)) {

            return $this->findUuid($key);
        }
    }

    public function specieLike(string $specie)
    {
        return $this->ilike('specie', $specie);
    }

    public function popularNameLike(string $name)
    {
        return $this->ilike('popular_name', $name);
    }

    public function kingdomLike(string $kingdom)
    {
        return $this->ilike('kingdom', $kingdom);
    }

    public function phylumLike(string $phylum)
    {
        return $this->ilike('phylum', $phylum);
    }

    public function classLike(string $class)
    {
        return $this->ilike('class', $class);
    }

    public function orderLike(string $order)
    {
        return $this->ilike('order', $order);
    }

    public function familyLike(string $family)
    {
        return $this->ilike('family', $family);
    }

    public function genusLike(string $genus)
    {
        return $this->ilike('genus', $genus);
    }

    public function scientificNameLike(string $name)
    {
        return $this->ilike('scientific_name', $name);
    }

    public function getByStateAcronym(string $ac)
    {

        return $this->where('state_acronym', $ac);
    }

    public function getByBiome(string $biome)
    {

        return $this->where('biome', $biome);
    }

    public function getByBem(int $bem)
    {
        return $this->where('bem', $bem);
    }
}
