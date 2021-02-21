<?php

namespace App\Models;

use App\Helpers\HasComment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory, HasComment;

    public function getTable(): string
    {
        return 'comment';
    }

    protected $fillable = [
        'message', 'commentable_id', 'commentable_type'
    ];

    public function commentable() :MorphTo
    {
        return $this->morphTo();
    }
}
