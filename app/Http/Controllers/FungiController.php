<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListFungiRequest;
use App\Services\Contracts\FungiContract;
// use App\Services\FungiService;
use Illuminate\Http\Request;

class FungiController extends Controller
{
    private FungiContract $service;

    public function __construct(FungiContract $service)
    {
        $this->service = $service;
    }

    public function getByTaxonomy(ListFungiRequest $request)
    {
        $data = $request->validated();

        $taxonomy = $data['taxonomy'];
        $stateAc = array_key_exists('stateAc', $data) ? $data['stateAc'] : null;
        $bem = array_key_exists('bem', $data) ? $data['bem'] : null;
        $biome = array_key_exists('biome', $data) ? $data['biome'] : null;

        try {
            return $this->service->getByTaxonomy($taxonomy, $stateAc, $biome, $bem);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
