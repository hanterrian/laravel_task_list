<?php

declare(strict_types=1);

namespace App\Data;

use App\Enum\TaskStatus;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class TaskChildrenData extends Data
{
    public function __construct(
        public int $id,
        public TaskStatus $status,
        public int $priority,
        public string $title,
        public string $description,
        public ?Carbon $createdAt,
        public ?Carbon $completedAt,
    ) {
    }

    public static function fromModel(Task $task): self
    {
        return new self(
            id: $task->id,
            status: $task->status,
            priority: $task->priority,
            title: $task->title,
            description: $task->description,
            createdAt: $task->created_at,
            completedAt: $task->completed_at,
        );
    }
}
