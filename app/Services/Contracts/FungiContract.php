<?php

namespace App\Services\Contracts;

use App\Models\Fungi;
use App\Services\Contracts\Contract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Pagination\LengthAwarePaginator;

interface FungiContract extends Contract
{

    public function getByTaxonomy(string $taxonomy, string|null $occurrenceStateAcronym, string|null $biome, int|null $bemClassification, int|null $page): LengthAwarePaginator;

    public function getByStateAc(string $occurrenceStateAcronym): Collection;

    public function getByBem(int $bem): Collection;

    public function groupedByStateAndClass(): SupportCollection;

    public function getAll(): Collection;

    public function create(array $data): Fungi;

    public function update(string $uuid, array $data): Fungi;

    public function delete(string $uuid): void;

    public function findOrFail(int $id): Fungi;
}
