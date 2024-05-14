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

    public function getByStateAc(string $stateAc)
    {
        if (is_null($stateAc))
            throw new \Exception('Estado vazio');

        try {
            return $this->service->getByStateAc($stateAc);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getByBem(int $bem)
    {
        if (is_null($bem))
            throw new \Exception('Classificação BEM vazia');

        try {
            return $this->service->getByBem($bem);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function heatMap()
    {
        try {
            return $this->service->groupedByStateAndClass();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
