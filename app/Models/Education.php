<?php

namespace App\Models;

use App\Helpers\HasComment;
use App\Helpers\HasMedia as HasMediaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia as HasMediaInterface;

class Education extends Model implements  HasMediaInterface
{
    use HasFactory, HasComment, HasMediaTrait;

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
