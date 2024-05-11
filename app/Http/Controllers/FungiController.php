<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListFungiRequest;
use App\Services\Contracts\FungiContract;
use App\Services\FungiService;
use Illuminate\Http\Request;

class FungiController extends Controller
{
    private FungiService $service;

    public function __construct()
    {
        $this->service = FungiContract::class;
    }

    public function getByTaxonomy(ListFungiRequest $request)
    {
        $request->validated();

        $taxonomy = $request->taxonomy;
        $stateAc = $request->stateAc;
        $bem = $request->bem;
        $biome = $request->biome;

        try {
            return $this->service->getByTaxonomy($taxonomy, $stateAc, $biome, $bem)->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
