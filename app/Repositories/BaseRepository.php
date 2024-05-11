<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class BaseRepository
{
    protected Model $model;
    protected Builder $query;

    public function __construct(
        Model $model
    ) {
        $this->model = $model;
        $this->query = $model->query();
    }

    protected function whereId(int $id)
    {
        return $this->query->where('id', $id);
    }

    protected function whereUuid(string $uuid)
    {
        return $this->query->where('uuid', $uuid);
    }

    protected function findId(int $id)
    {
        return $this->query->find($id);
    }

    protected function findUuid(string $uuid)
    {
        return $this->query->where('uuid', $uuid)->first();
    }

    protected function ilike(string $fieldName, $value)
    {
        return $this->query->where($fieldName, 'LIKE', $value);
    }

    protected function where(string $fieldName, $value, $operator = '=')
    {
        return $this->query->where($fieldName, $operator, $value);
    }

    protected function orWhere(string $fieldName, $value, $operator = '=')
    {
        return $this->query->orWhere($fieldName, $operator, $value);
    }

    protected function orLike(string $fieldName, $value)
    {
        return $this->orWhere($fieldName, $value, 'LIKE');
    }

    protected function greaterOrEqualDate(string $fieldName, string|Carbon $date)
    {
        return $this->query->whereDate($fieldName, $date);
    }

    protected function betweenDates(string $fieldName, string|Carbon $firstDate, string|Carbon $lastDate)
    {
        return $this->greaterOrEqualDate($fieldName, $firstDate)->lessOrEqualDate($fieldName, $lastDate);
    }

    protected function lessOrEqualDate(string $fieldName, string|Carbon $date)
    {
        return $this->query->whereDate($fieldName, $date);
    }

    protected function get(array $columns = ['*'])
    {
        return $this->query->get($columns);
    }

    protected function all(array $columns = ['*'])
    {
        return $this->model->all($columns);
    }
}
