<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'message' => $this->message,
            'created_at' => $this->created_at,
            'parent_id' => $this->parent_id,
            'children' => CommentResource::collection($this->whenLoaded('children')),
            'descendants' => CommentResource::collection($this->whenLoaded('descendants')),
            'owner' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
