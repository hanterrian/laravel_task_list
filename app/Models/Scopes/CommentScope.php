<?php

declare(strict_types=1);

namespace App\Models\Scopes;

use App\Enum\CommentStatus;
use Illuminate\Database\Query\Builder;

trait CommentScope
{
    public function scopeDraft(Builder $builder): void
    {
        $builder->where('status', CommentStatus::DRAFT);
    }

    public function scopePublished(Builder $builder): void
    {
        $builder->where('status', CommentStatus::PUBLISH);
    }

    public function scopeHidden(Builder $builder): void
    {
        $builder->where('status', CommentStatus::HIDE);
    }
}
