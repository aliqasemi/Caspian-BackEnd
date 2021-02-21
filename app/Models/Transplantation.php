<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transplantation extends Model
{
    use HasFactory;

    public function getTable(): string
    {
        return 'transplantation';
    }

    protected $fillable = ['name', 'category', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function portfolio(): HasMany{
        return $this->hasMany(Portfolio::class);
    }

}
