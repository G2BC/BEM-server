<?php

namespace App\Services\Contracts;

use App\Services\Contracts\Contract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

interface FungiContract extends Contract
{

    public function getByTaxonomy(string $taxonomy, string|null $occurrenceStateAcronym, string|null $biome, int|null $bemClassification): Collection;

    public function getByStateAc(string $occurrenceStateAcronym): Collection;

    public function getByBem(int $bem): Collection;

    public function groupedByStateAndClass(): SupportCollection;

    public function getAll(): Collection;
}
