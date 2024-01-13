<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Data\TaskData;
use App\Data\TaskListData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskFilterRequest;
use App\Http\Requests\Task\TaskStoreRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(TaskFilterRequest $request)
    {
        $items = Task::with(['owner']);

        if ($request->status) {
            $items->status($request->status);
        }

        if ($request->priority) {
            $items->priority($request->priority);
        }

        if ($request->title) {
            $items->title($request->title);
        }

        if ($request->description) {
            $items->description($request->description);
        }

        if ($request->sort) {
            $items->sort($request->sort);
        }

        return TaskListData::collection($items->get());
    }

    public function show(Task $task)
    {
        return TaskData::from($task);
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
