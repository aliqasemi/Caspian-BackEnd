<?php

namespace App\Models;

use App\Helpers\HasComment;
use App\Helpers\HasMedia as HasMediaTrait;
use App\Helpers\HasTag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia as HasMediaInterface;

class Portfolio extends Model implements HasMediaInterface
{
    use HasFactory, HasComment, HasTag, HasMediaTrait;

    public function getTable(): string
    {
        return 'portfolio';
    }

    protected $fillable = ['title', 'description', 'transplantation_id'];

    public function transplantation(): BelongsTo
    {
        return $this->belongsTo(Transplantation::class);
    }

    public function educations(): HasMany
    {
        return $this->hasMany(Education::class);
    }

}
