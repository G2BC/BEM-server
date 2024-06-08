<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        $this->setModel($model);
        $this->setQuery($model->query());
    }
}
