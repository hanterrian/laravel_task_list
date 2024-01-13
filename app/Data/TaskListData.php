<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Data;

class TaskListData extends Data
{
    public function __construct(
        public int $id,
    ) {
    }
}
