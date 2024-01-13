<?php

declare(strict_types=1);

namespace App\Enum;

enum CommentStatus: string
{
    case DRAFT = 'draft';
    case PUBLISH = 'publish';
    case HIDE = 'hide';
}
