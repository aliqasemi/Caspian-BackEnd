<?php

namespace App\Models;

use App\Helpers\HasComment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Education extends Model
{
    use HasFactory, HasComment;

    public function getTable(): string
    {
        return 'education';
    }

    protected $fillable = ['title', 'content', 'portfolio_id'];

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }
}
