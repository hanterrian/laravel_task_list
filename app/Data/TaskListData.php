<?php

declare(strict_types=1);

namespace App\Data;

use App\Enum\TaskStatus;
use App\Models\Task;
use Carbon\Carbon;
use Spatie\LaravelData\Data;

class TaskListData extends Data
{
    public function __construct(
        public int $id,
        public UserData $owner,
        public TaskStatus $status,
        public int $priority,
        public string $title,
        public string $description,
        public ?Carbon $created_at,
        public ?Carbon $completed_at,
    ) {
    }

    public static function fromModel(Task $task): self
    {
        return new self(
            id: $task->id,
            owner: $task->owner->getData(),
            status: $task->status,
            priority: $task->priority,
            title: $task->title,
            description: $task->description,
            created_at: $task->created_at,
            completed_at: $task->completed_at,
        );
    }
}
