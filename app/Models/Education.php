<?php

namespace App\Models;

use App\Helpers\HasComment;
use App\Helpers\HasMedia as HasMediaTrait;
use App\Helpers\HasTag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia as HasMediaInterface;

class Education extends Model implements HasMediaInterface
{
    use HasFactory, HasComment, HasTag, HasMediaTrait, Searchable;

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
