<?php


namespace App\Helpers;

use App\Models\tag;

trait HasTag
{
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
