<?php

namespace App\Helpers;

use App\Models\tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

trait HasTag
{
    private $new_tags = [];
    private $sync_tag = [];

    /**
     * @param mixed $tagRequest
     */
    private function setTagSync($tagRequest): void
    {
        foreach ($tagRequest as $tag) {
            if (!is_numeric($tag)) {
                $newTag = tag::create([
                    'name' => $tag,
                    'user_id' => Auth::id()
                ]);
                $this->new_tags[] = $newTag;
                $this->sync_tag[] = $newTag->id;
            } else {
                $this->sync_tag[] = $tag;
            }
        }

        $this->sync();
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function syncTag()
    {
        $this->validate(request()->get('tags'));
        $this->setTagSync(request()->get('tags'));
    }

    private function sync(){
        $this->tags()->saveMany($this->new_tags);
        $this->tags()->sync($this->sync_tag);
    }

    private function validate($tags)
    {
        Validator::make($tags, [
            'tags' => 'nullable|array',
            'tags.*' => 'required|string|distinct',
        ])->validate();
    }
}
