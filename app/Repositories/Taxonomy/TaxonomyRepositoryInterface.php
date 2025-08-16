<?php

declare(strict_types=1);

use App\Models\Taxonomy;

interface TaxonomyRepositoryInterface
{
    public function create(array $data): Taxonomy;

    public function changeOldMainsToSynonymous(string $scientificName): void;

    public function firstByScientificName(string $scientificName): ?Taxonomy;
}
