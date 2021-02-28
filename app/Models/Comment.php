<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory;

    public function getTable(): string
    {
        return 'comment';
    }

    protected $fillable = [
        'message', 'commentable_id', 'commentable_type', 'user_id'
    ];

    public function commentable() :MorphTo
    {
        return $this->morphTo();
    }
}
