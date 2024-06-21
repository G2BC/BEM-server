<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOccurrenceRequest;
use App\Http\Requests\UpdateOccurrenceRequest;
use App\Services\Contracts\OccurrenceContract;
use Illuminate\Http\Request;

class OccurrenceController extends Controller
{
    private OccurrenceContract $service;

    public function __construct(OccurrenceContract $service)
    {
        $this->service = $service;
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

    public function create(string $fungiUuid, CreateOccurrenceRequest $request)
    {
        try {
            $data = $request->validated();

            return $this->service->create($fungiUuid, $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(string $uuid, UpdateOccurrenceRequest $request)
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

            return response()->json(['message' => 'Observação de Ocorrência removida']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
