<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    use HasFactory;

    public function getTable(): string
    {
        return 'media';
    }

    public function getThumbnailAddressAttribute(): string
    {
        return $this->getUrl('thumbnail');
    }

    public function assign($model, $collectionName)
    {
        $this->collection_name = $collectionName;
        $model->media()->save($this);
    }
}
