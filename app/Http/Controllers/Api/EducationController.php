<?php

namespace App\Http\Controllers\Api;

use App\Helpers\SearchInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Education\EducationStoreRequest;
use App\Http\Requests\Education\EducationUpdateRequest;
use App\Http\Requests\Search\SearchModelRequest;
use App\Http\Resources\EducationResource;
use App\Models\Education;
use Illuminate\Support\Arr;

class EducationController extends Controller implements SearchInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $this->authorize('view', Education::class);

        return EducationResource::collection(
            Education::with(['portfolio.transplantation.user', 'tags', 'comments', 'media'])
                ->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return EducationResource
     */
    public function store(EducationStoreRequest $request)
    {
        $this->authorize('create', Education::class);

        $data = $request->all();

        $education = Education::create([
            'title' => Arr::get($data, 'title'),
            'content' => Arr::get($data, 'content'),
            'portfolio_id' => Arr::get($data, 'portfolio_id')
        ]);

        if (Arr::has($data, 'image')) {
            $education->addMedia(Arr::get($data, 'image'))->toMediaCollection('main_image');
        }

        $education->save();

        if (Arr::has($data, 'tags'))
            $education->syncTag();

        $education->load(['portfolio.transplantation.user', 'tags']);

        return new EducationResource(
            $education
        );
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Education $education
     * @return EducationResource
     */
    public function show(Education $education)
    {
        $this->authorize('view', Education::class);

        $education = Education::findOrFail($education->id);

        $education->load(['portfolio.transplantation.user', 'tags', 'comments', 'media']);

        return new EducationResource(
            $education
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Education $education
     * @return EducationResource
     */
    public function update(EducationUpdateRequest $request, Education $education)
    {
        $this->authorize('update', Education::class);

        $data = $request->all();

        $education = Education::findOrFail($education->id);

        $education->fill($data);

        if (Arr::has($data, 'image')) {
            $education->addMedia(Arr::get($data, 'image'))->toMediaCollection('main_image');
        }

        $education->save();

        if (Arr::has($data, 'tags'))
            $education->syncTag();

        $education->load(['portfolio.transplantation.user', 'tags', 'comments', 'media']);

        return new EducationResource(
            $education
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Education $education
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Education $education)
    {
        $this->authorize('delete', Education::class);

        $response = Education::destroy([$education->id]);

        if ($response == true)
            return response()->json('عملیات با موفقیت انجام شد');
    }

    public function search(SearchModelRequest $request)
    {
        return EducationResource::collection(
            Education::search($request->keyword)
                ->get()
        );
    }
}
