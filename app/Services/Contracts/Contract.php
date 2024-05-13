<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Model;

interface Contract
{

    public function getById(int $id): Model;

    public function getByUuid(string $uuid): Model;
}
