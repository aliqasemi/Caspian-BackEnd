<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentIndexRequest;
use App\Http\Requests\Comment\CommentStoreRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CommentIndexRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(CommentIndexRequest $request)
    {
        $data = $request->all();

        $model = config('comment-models.models.' . Arr::get($data, 'commentable_type'));
        $resource = config('comment-resource.resource.' . Arr::get($data, 'commentable_type'));

        return $resource::collection(
            $model::with(['comments' => function($query){
                $query->with('descendants');
            }])->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return CommentResource
     */
    public function store(CommentStoreRequest $request)
    {
        $data = $request->all();

        Arr::set($data, 'user_id', Auth::id());

        Arr::set($data, 'commentable_type', config('comment-models.models.' . Arr::get($data, 'commentable_type')));

        if (is_null(Arr::get($data, 'commentable_type'))) {
            throw new ErrorException('Model is Not define');
        }

        $comment = new Comment($data);

        if (Arr::get($data, 'parent.connect') and $parent = Comment::findOrFail(Arr::get($data, 'parent.connect'))) {
            $comment->parent()->associate($parent);
        }

        $comment->save();

        return new CommentResource(
          $comment
        );

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Comment $comment
     * @return CommentResource
     */
    public function show(Comment $comment)
    {
        return new CommentResource(
            Comment::descendantsAndSelf($comment)->toTree()->first()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return CommentResource
     */
    public function update(Request $request, Comment $comment)
    {
        $data = $request->all();

        $comment->fill($data);

        if (Arr::get($data, 'parent.connect') and $parent = Comment::findOrFail(Arr::get($data, 'parent.connect'))) {
            $comment->parent()->associate($parent);
        }

        $comment->save();

        return new CommentResource(
            $comment
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
