<?php

declare(strict_types=1);

namespace App\Data;

use App\Enum\CommentStatus;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;

class CommentData extends Data
{
    public function __construct(
        public int $id,
        public User $owner,
        public Task $task,
        public CommentStatus $status,
        public string $comment,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {
    }
}
