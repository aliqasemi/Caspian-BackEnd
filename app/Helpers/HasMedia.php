<?php


namespace App\Helpers;


use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\MediaLibrary\InteractsWithMedia as BasicHasMedia;

trait HasMedia
{
    use BasicHasMedia;

    public function main_image(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')->where('collection_name', 'main_image');
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addMediaCollection('main_image')
            ->withResponsiveImages()
            ->singleFile();
    }

    public function registerMediaCollections(): void
    {
        $size = request('crop');
        $this->addMediaConversion('thumb')
            ->width($size ? $size['width'] : 368)
            ->height($size ? $size['height'] : 232)
            ->quality(80);
    }
}
