<?php


namespace App\Helpers;


use App\Models\tag;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasTag
{
    public function tags() : MorphMany
    {
        return $this->morphMany(tag::class, 'tagable');
    }
}
