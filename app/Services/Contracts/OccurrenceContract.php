<?php

namespace App\Services\Contracts;

use App\Models\Occurrence;
use Illuminate\Database\Eloquent\Collection;

interface OccurrenceContract extends Contract
{
    public function getAll(): Collection;

    public function create(string $fungiUuid, array $data): Occurrence;

    public function update(string $uuid, array $data): Occurrence;

    public function delete(string $uuid): void;
}
