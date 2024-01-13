<?php

declare(strict_types=1);

namespace App\Data;

use App\Enum\TaskStatus;
use Carbon\Carbon;
use Spatie\LaravelData\Data;

class TaskListData extends Data
{
    public function __construct(
        public int $id,
        public TaskStatus $status,
        public int $priority,
        public string $title,
        public string $description,
        public ?Carbon $created_at,
        public ?Carbon $completed_at,
    ) {
    }
}
