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

class TaskData extends Data
{
    public function __construct(
        public int $id,
        public UserData $owner,
        public ?Task $parent,
        public TaskStatus $status,
        public int $priority,
        public string $title,
        public string $description,
        #[DataCollectionOf(TaskChildrenData::class), MapName('subTasks')]
        public ?DataCollection $children,
        #[DataCollectionOf(CommentData::class), MapName('comments')]
        public ?DataCollection $comments,
        public ?Carbon $created_at,
        public ?Carbon $completed_at,
    ) {
    }

    public static function fromModel(Task $task): self
    {
        return new self(
            id: $task->id,
            owner: $task->owner->getData(),
            parent: $task->parent?->getData(),
            status: $task->status,
            priority: $task->priority,
            title: $task->title,
            description: $task->description,
            children: TaskChildrenData::collection($task->children),
            comments: CommentData::collection($task->comments),
            created_at: $task->created_at,
            completed_at: $task->completed_at,
        );
    }
}
