<?php

declare(strict_types=1);

namespace App\Models\Scopes;

use App\Enum\TaskStatus;
use Illuminate\Database\Eloquent\Builder;

trait TaskScope
{
    public function scopeTodos(Builder $builder): void
    {
        $builder->where('status', TaskStatus::TODO);
    }

    public function scopeDone(Builder $builder): void
    {
        $builder->where('status', TaskStatus::DONE);
    }

    public function scopeStatus(Builder $builder, TaskStatus $status): void
    {
        $builder->where('status', $status);
    }

    public function scopePriority(Builder $builder, int $priority): void
    {
        $builder->where('priority', $priority);
    }

    public function scopeTitle(Builder $builder, string $title): void
    {
        $builder->whereFullText('title', $title);
    }

    public function scopeDescription(Builder $builder, string $description): void
    {
        $builder->whereFullText('description', $description);
    }

    public function scopeSort(Builder $builder, array $sort): void
    {
        $allowedSortColumnMap = [
            'createdAt' => 'created_at',
            'completedAt' => 'completed_at',
            'priority' => 'priority',
        ];

        foreach ($sort as $sortColumn => $direction) {
            $sortColumn = trim($sortColumn);
            $sortColumn = ltrim($sortColumn, '-');

            $direction = trim($direction);
            $direction = strtolower($direction);

            if (isset($allowedSortColumnMap[$sortColumn]) && in_array($direction, ['asc', 'desc'])) {
                $builder->orderBy($allowedSortColumnMap[$sortColumn], $direction);
            }
        }
    }
}
