<?php

namespace App\Models;

use App\Helpers\HasMedia as HasMediaTrait;
use App\Helpers\HasTag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia as HasMediaInterface;

class Transplantation extends Model implements HasMediaInterface
{
    use HasFactory, HasTag, HasMediaTrait, Searchable;

    public function getTable(): string
    {
        return 'transplantation';
    }

    protected $fillable = ['name', 'category', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }

}
