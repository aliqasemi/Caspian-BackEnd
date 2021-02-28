<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\MorphToMany;

class tag extends Model
{
    use HasFactory;

    public function getTable()
    {
        return "tags";
    }

    protected $fillable = ['name', 'user_id'];

    public function transplantation(): MorphToMany
    {
        return $this->morphedByMany(Transplantation::class, 'taggable');
    }

    public function educations(): MorphToMany
    {
        return $this->morphedByMany(Education::class, 'taggable');
    }

    public function portfolio() :MorphToMany
    {
        return $this->morphedByMany(Portfolio::class, 'taggable');
    }
}
