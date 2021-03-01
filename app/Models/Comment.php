<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Kalnoy\Nestedset\NodeTrait;

class Comment extends Model
{
    use HasFactory, NodeTrait;

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

    public function parent() : BelongsTo
    {
        return $this->belongsTo(get_class($this), $this->getParentIdName())
            ->setModel($this);
    }

    public function children() : HasMany
    {
        return $this->hasMany(get_class($this), $this->getParentIdName())
            ->setModel($this);
    }

}
