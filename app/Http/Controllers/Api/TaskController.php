<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Data\TaskData;
use App\Data\TaskListData;
use App\Enum\TaskStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskFilterRequest;
use App\Http\Requests\Task\TaskStoreRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Models\Task;
use Illuminate\Http\Response;
use Spatie\LaravelData\DataCollection;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;

class TaskController extends Controller
{
    public function index(TaskFilterRequest $request): DataCollection
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

    public function show(Task $task): TaskData
    {
        return TaskData::from($task);
    }

    public function store(TaskStoreRequest $request): TaskData
    {
        $model = Task::create(array_merge($request->all(), [
            'owner_id' => $request->user()->id,
        ]));

        return TaskData::from($model);
    }

    public function update(Task $task, TaskUpdateRequest $request): Response
    {
        $task->update($request->all());

        return response()->noContent();
    }

    public function complete(Task $task): Response
    {
        $this->authorize('complete', $task);

        if ($task->isDone()) {
            throw new NotAcceptableHttpException('Task is already completed.');
        }

        $exists = Task::whereParentId($task->id)->todos()->exists();

        if ($exists) {
            throw new NotAcceptableHttpException('You cannot finish a task until you have completed all sub-tasks.');
        }

        $task->update(['status' => TaskStatus::DONE]);

        return response()->noContent();
    }

    public function destroy(Task $task): Response
    {
        if ($task->isDone()) {
            throw new NotAcceptableHttpException('You cannot delete a task that has already been completed.');
        }

        $task->delete();

        return response()->noContent();
    }
}
