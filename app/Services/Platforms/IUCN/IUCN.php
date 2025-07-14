<?php

declare(strict_types=1);

namespace App\Services\Platforms\IUCN;

use Illuminate\Support\Facades\Http;

class IUCN
{
    public function __construct() {}

    public function getByScientificName($genus, $species): array
    {
        return $this->request("/taxa/scientific_name", 'GET', ['genus_name' => $genus, 'species_name' => $species])
            ->throw()
            ->json();
    }

    private function request(string $path, string $method = 'GET', array $data = [])
    {
        return Http::withHeaders(['Authorization' => 'Bearer ' . config('services.iucn.key')])
            ->{$method}(config('services.iucn.endpoint') . $path, $data);
    }
}
