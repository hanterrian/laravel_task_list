<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentStoreRequest;
use App\Http\Requests\Comment\CommentUpdateRequest;
use App\Models\Comment;
use App\Models\Task;

class CommentController extends Controller
{
    public function index(Task $task)
    {
    }

    public function show(Task $task, Comment $comment)
    {
    }

    public function store(Task $task, Comment $comment, CommentStoreRequest $request)
    {
    }

    public function update(Task $task, Comment $comment, CommentUpdateRequest $request)
    {
    }

    public function destroy(Task $task, Comment $comment)
    {
    }
}
