<?php


namespace App\Helpers;


use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\MediaLibrary\InteractsWithMedia as BasicHasMedia;

trait HasMediaTrait
{
    use BasicHasMedia;

    public function main_image(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')->where('collection_name', 'main_image');
    }
}
