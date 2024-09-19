<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository extends BaseRepository
{
    protected string $model = Task::class;


    public function getAllByFilters($filters): Collection
    {
        $query = Task::query();

        if ($filters['status']){
            $query->where('status', $filters['status']);
        }

        return $query->get();
    }
}
