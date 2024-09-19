<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

class BaseRepository
{
    protected string $model;

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function bulkInsert(array $data)
    {
        return $this->model::insert($data);
    }

    public function bulkUpsert(array $data, $unique = ['id'])
    {
        return $this->model::upsert($data, $unique);
    }

    public function update($model, array $data)
    {
        return $model->update($data);
    }

    public function delete($model)
    {
        return $model->delete();
    }

    public function find($id)
    {
        return $this->model::find($id);
    }

    public function all(): Collection
    {
        return $this->model::all();
    }
}
