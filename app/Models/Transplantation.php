<?php

namespace App\Models;

use App\Helpers\HasMedia as HasMediaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia as HasMediaInterface;

class Transplantation extends Model implements HasMediaInterface
{
    use HasFactory, HasMediaTrait;

    public function getTable(): string
    {
        return 'transplantation';
    }

    protected $fillable = ['name', 'category', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function portfolios(): HasMany{
        return $this->hasMany(Portfolio::class);
    }

}
