<?php

namespace App\Repositories;

use App\Models\Occurrence;

class OccurrenceRepository extends BaseRepository
{
    public function __construct(Occurrence $model)
    {
        $this->setModel($model);
        $this->setQuery($model->query());
    }
}
