<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\Contracts\UserContract;
use Illuminate\Database\Eloquent\Model;

class UserService implements UserContract
{
    private UserRepository $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getById(int $id): Model
    {
        try {

            return $this->repo->find($id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getByUuid(string $uuid): Model
    {
        try {

            return $this->repo->find($uuid);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
