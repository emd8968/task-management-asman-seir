<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TaskRepository extends BaseRepository
{
    protected string $model = Task::class;


    public function getAllByFilters($filters): Collection
    {
        $query = Task::query();

        if ($filters['status']) {
            $query->where('status', $filters['status']);
        }

        return $query->get();
    }


    public function tasksCount($userId, $status)
    {
        return (int)DB::selectOne("SELECT task_count($userId,'$status') as task_count")->task_count;
    }
}
