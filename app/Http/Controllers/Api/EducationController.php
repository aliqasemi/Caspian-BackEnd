<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Education\EducationStoreRequest;
use App\Http\Requests\Education\EducationUpdateRequest;
use App\Http\Resources\EducationResource;
use App\Models\Education;
use Illuminate\Support\Arr;

class EducationController extends Controller
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
            Education::with(['portfolio.transplantation.user'])
                ->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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

        $education->save();

        $education->load(['portfolio.transplantation.user']);

        return new EducationResource(
            $education
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Education  $education
     * @return EducationResource
     */
    public function show(Education $education)
    {
        $this->authorize('view', Education::class);

        $education = Education::findOrFail($education->id);

        $education->load(['portfolio.transplantation.user']);

        return new EducationResource(
            $education
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(EducationUpdateRequest $request, Education $education)
    {
        $this->authorize('update', Education::class);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education $education)
    {
        $this->authorize('delete', Education::class);

    }
}
