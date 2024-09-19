<?php

namespace App\Services;

use App\Enums\UserRoleTypes;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TaskService
{

    public function __construct(
        private readonly TaskRepository $taskRepository
    )
    {

    }

    public function createTask(array $data): Task
    {
        return $this->taskRepository->create($data);
    }

    public function bulkInsertTasks(array $data): bool
    {
        return $this->taskRepository->bulkInsert($data);
    }

    public function bulkUpdateTasks(array $data): bool
    {
        $user = Auth::user();

        $query =
            Task::query()
                ->whereKey(array_column($data, 'id'));

        if ($user && $user->role === UserRoleTypes::Client->value) {
            $query->where('assigned_to', $user->id);
        }

        $ids = $query->get('id')->pluck('id')->toArray();

        $data = array_filter(
            $data,
            fn ($row) => in_array($row['id'], $ids
            ));

        return $this->taskRepository->bulkUpsert($data);
    }

    public function updateTask($model, array $data): bool
    {
        return $this->taskRepository->update($model, $data);
    }

    public function delete($model): Task
    {
        return $this->taskRepository->delete($model);
    }

    public function all($filters): Collection
    {
        if(!empty($filters)){
            return $this->taskRepository->getAllByFilters($filters);
        }
        return $this->taskRepository->all();
    }

}
