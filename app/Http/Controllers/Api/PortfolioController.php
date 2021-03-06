<?php

namespace App\Http\Controllers\Api;

use App\Helpers\SearchInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\PortfolioStoreRequest;
use App\Http\Requests\Portfolio\PortfolioUpdateRequest;
use App\Http\Requests\Search\SearchModelRequest;
use App\Http\Resources\PortfolioResource;
use App\Models\Portfolio;
use Illuminate\Support\Arr;

class PortfolioController extends Controller implements SearchInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $this->authorize('view', Portfolio::class);

        return PortfolioResource::collection(
            Portfolio::with(['transplantation', 'transplantation.user', 'tags', 'comments', 'media'])
                ->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return PortfolioResource
     */
    public function store(PortfolioStoreRequest $request)
    {
        $this->authorize('create', Portfolio::class);

        $data = $request->all();

        $portfolio = Portfolio::create([
            'title' => Arr::get($data, 'title'),
            'description' => Arr::get($data, 'description'),
            'transplantation_id' => Arr::get($data, 'transplantation_id')
        ]);

        if (Arr::has($data, 'image')) {
            $portfolio->addMedia(Arr::get($data, 'image'))->toMediaCollection('main_image');
        }

        $portfolio->save();

        if (Arr::has($data, 'tags'))
            $portfolio->syncTag();

        $portfolio->load(['transplantation', 'transplantation.user', 'tags', 'media']);

        return new PortfolioResource(
            $portfolio
        );
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Portfolio $portfolio
     * @return PortfolioResource
     */
    public function show(Portfolio $portfolio)
    {
        $this->authorize('view', Portfolio::class);

        $portfolio = Portfolio::findOrFail($portfolio->id);

        $portfolio->load(['transplantation', 'transplantation.user', 'tags', 'comments', 'media']);

        return new PortfolioResource(
            $portfolio
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Portfolio $portfolio
     * @return PortfolioResource
     */
    public function update(PortfolioUpdateRequest $request, Portfolio $portfolio)
    {
        $this->authorize('update', Portfolio::class);

        $data = $request->all();

        $portfolio = Portfolio::findOrFail($portfolio->id);

        $portfolio->fill($data);

        if (Arr::has($data, 'image')) {
            $portfolio->addMedia(Arr::get($data, 'image'))->toMediaCollection('main_image');
        }

        $portfolio->save();

        if (Arr::has($data, 'tags'))
            $portfolio->syncTag();

        $portfolio->load(['transplantation', 'transplantation.user', 'tags', 'comments', 'media']);

        return new PortfolioResource(
            $portfolio
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Portfolio $portfolio
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Portfolio $portfolio)
    {
        $this->authorize('delete', Portfolio::class);

        $response = Portfolio::destroy([$portfolio->id]);

        if ($response == true)
            return response()->json('عملیات با موفقیت انجام شد');
    }

    public function search(SearchModelRequest $request)
    {
        return PortfolioResource::collection(
            Portfolio::search($request->keyword)->get()
        );
    }
}
