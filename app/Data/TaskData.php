<?php

declare(strict_types=1);

namespace App\Data;

use App\Enum\TaskStatus;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class TaskData extends Data
{
    public function __construct(
        public int $id,
        public User $owner,
        public ?Task $parent,
        public TaskStatus $status,
        public int $priority,
        public string $title,
        public string $description,
        public ?DataCollection $children,
        public ?Carbon $createdAt,
        public ?Carbon $completedAt,
    ) {
    }
}
