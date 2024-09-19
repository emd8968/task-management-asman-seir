<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskBulkStoreRequest;
use App\Http\Requests\TaskBulkUpdateRequest;
use App\Http\Requests\TaskIndexRequest;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;

class TaskController extends Controller
{

    public function __construct(
        private readonly TaskService $taskService
    )
    {

    }

    public function index(TaskIndexRequest $request)
    {
        $tasks = $this->taskService->all($request->validated());

        return TaskResource::collection($tasks);
    }

    public function store(TaskStoreRequest $request)
    {
        $task = $this->taskService->createTask($request->validated());

        return TaskResource::make($task);
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        $success = $this->taskService->updateTask($task, $request->validated());

        return [
            'success' => $success,
        ];
    }

    public function destroy(Task $task)
    {
        $success = $this->taskService->delete($task);

        return [
            'success' => $success,
        ];
    }

    public function bulkStore(TaskBulkStoreRequest $request)
    {
        $tasks = $request->validated()['tasks'];

        $success = $this->taskService->bulkInsertTasks($tasks);

        return [
            'success' => $success,
        ];
    }

    public function bulkUpdate(TaskBulkUpdateRequest $request)
    {
        $tasks = $request->validated()['tasks'];

        $success = $this->taskService->bulkUpdateTasks($tasks);

        return [
            'success' => $success,
        ];
    }
}
