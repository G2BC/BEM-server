<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFungiRequest;
use App\Http\Requests\ListFungiRequest;
use App\Http\Requests\UpdateFungiRequest;
use App\Jobs\UpdateOccurrences;
use App\Services\Contracts\FungiContract;

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
        $page = array_key_exists('page', $data) ? $data['page'] : null;

        try {
            $paginatedResults = $this->service->getByTaxonomy($taxonomy, $stateAc, $biome, $bem, $page);
            return response()->json($paginatedResults);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getByStateAc(string $stateAc)
    {
        //TODO: verificar estado valido dentro das opções utilizando enum, tratar erro com exception customizada
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
        //TODO: verificar classificação valida dentro das opções utilizando enum, tratar erro com exception customizada
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

    public function getAll()
    {
        try {
            return $this->service->getAll();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getByUuid(string $uuid)
    {
        try {

            return $this->service->getByUuid($uuid);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function updateObservations()
    {
        try {
            UpdateOccurrences::dispatchSync();

            return response()->json(['message' => 'Atualização das observações iniciada']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create(CreateFungiRequest $request)
    {
        try {
            $data = $request->validated();

            return $this->service->create($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(string $uuid, UpdateFungiRequest $request)
    {
        try {
            $data = $request->validated();

            return $this->service->update($uuid, $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete(string $uuid)
    {
        try {

            $this->service->delete($uuid);

            return response()->json(['message' => 'Espécie removida']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
