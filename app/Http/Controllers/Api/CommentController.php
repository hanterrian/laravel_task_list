<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Data\CommentData;
use App\Enum\CommentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentStoreRequest;
use App\Http\Requests\Comment\CommentUpdateRequest;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\LaravelData\DataCollection;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;

class CommentController extends Controller
{
    public function index(Task $task, Request $request): DataCollection
    {
        $items = Comment::where([
            'task_id' => $task->id,
        ])
            ->where(function (Builder $builder) use ($request) {
                return $builder->where('status', CommentStatus::PUBLISH)
                    ->orWhereRaw("(comments.owner_id = ? AND comments.status = ?)", [
                        $request->user()->id,
                        CommentStatus::DRAFT,
                    ])
                    ->orWhereRaw("(comments.owner_id = ? AND comments.status = ?)", [
                        $request->user()->id,
                        CommentStatus::HIDE,
                    ]);
            })
            ->get();

        return CommentData::collection($items);
    }

    public function show(Task $task, Comment $comment): CommentData
    {
        if ($task->isDone()) {
            throw new NotAcceptableHttpException('Task is already completed.');
        }

        return CommentData::from($comment);
    }

    public function store(Task $task, CommentStoreRequest $request): CommentData
    {
        if ($task->isDone()) {
            throw new NotAcceptableHttpException('Task is already completed.');
        }

        $model = Comment::create(array_merge($request->all(), [
            'owner_id' => $request->user()->id,
            'task_id' => $task->id,
        ]));

        return CommentData::from($model);
    }

    public function update(Task $task, Comment $comment, CommentUpdateRequest $request): Response
    {
        if ($task->isDone()) {
            throw new NotAcceptableHttpException('Task is already completed.');
        }

        $comment->update($request->all());

        return response()->noContent();
    }

    public function destroy(Task $task, Comment $comment): Response
    {
        if ($task->isDone()) {
            throw new NotAcceptableHttpException('Task is already completed.');
        }

        $comment->delete();

        return response()->noContent();
    }
}
