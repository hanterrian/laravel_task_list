<?php

namespace App\Data;

use App\Enum\CommentStatus;
use App\Models\Comment;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;

class CommentData extends Data
{
    public function __construct(
        public int $id,
        public UserData $owner,
        public CommentStatus $status,
        public string $comment,
        public ?Carbon $created_at,
        public ?Carbon $updated_at,
    ) {
    }

    public static function fromModel(Comment $comment): self
    {
        return new self(
            id: $comment->id,
            owner: $comment->owner->getData(),
            status: $comment->status,
            comment: $comment->comment,
            created_at: $comment->created_at,
            updated_at: $comment->updated_at,
        );
    }
}
