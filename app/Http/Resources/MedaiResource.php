<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MedaiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'collection_name' => $this->collection_name,
            'thumbnail' => $this->getUrl('thumb'),
            'image' => $this->getUrl(),
            'mime_type' => $this->mime_type,
            'file_name' => $this->file_name,
            'size' => $this->size,
        ];
    }
}
