<?php


namespace App\Helpers;


use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasComment {

    public function comments() : MorphMany
    {
        return $this->morphMany(...config('common.morph_models.comment'));
    }

}
