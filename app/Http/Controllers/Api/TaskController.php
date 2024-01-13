<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskFilterRequest;
use App\Http\Requests\Task\TaskStoreRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(TaskFilterRequest $request)
    {
    }

    public function show(Task $task)
    {
    }

    public function store(Task $task, TaskStoreRequest $request)
    {
    }

    public function update(Task $task, TaskUpdateRequest $request)
    {
    }

    public function complete(Task $task)
    {
        $this->authorize('complete', $task);
    }

    public function destroy(Task $task)
    {
    }
}
