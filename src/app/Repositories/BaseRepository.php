<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function index(User $user)
    {
        return $this->model->get();
    }

    public function show(Model $model): Model
    {
        return $this->model->find($model->id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(Model $entity, array $data): Model
    {
        $entity->update($data);
        return $entity;
    }

    public function delete(Model $entity): void
    {
        $entity->delete();
    }
}
